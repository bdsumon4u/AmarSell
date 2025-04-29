<?php

namespace App\Http\Controllers;

use App\Events\OrderStatusChanged;
use App\Order;
use App\Product;
use Darryldecode\Cart\Facades\CartFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $filter = $request->filter ?? [];

        $orders = Order::where($filter)->latest()->get();

        return view('admin.orders.list', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        switch ($order->status) {
            case 'pending':
                $variant = 'secondary';
                break;
            case 'processing':
                $variant = 'warning';
                break;
            case 'shipping':
                $variant = 'primary';
                break;
            case 'completed':
                $variant = 'success';
                break;
            case 'returned':
                $variant = 'danger';
                break;

            default:
                # code...
                break;
        }
        $products = Product::withTrashed()->whereIn('id', array_keys($order->data['products']))->get();
        $cp = $order->current_price();
        return view('admin.orders.show', compact('order', 'products', 'cp', 'variant'));
    }

    public function invoice(Order $order)
    {
        switch ($order->status) {
            case 'pending':
                $variant = 'secondary';
                break;
            case 'processing':
                $variant = 'warning';
                break;
            case 'shipping':
                $variant = 'primary';
                break;
            case 'completed':
                $variant = 'success';
                break;
            case 'returned':
                $variant = 'danger';
                break;

            default:
                # code...
                break;
        }
        return view('admin.orders.invoice', compact('order', 'variant'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        // dump($order->data);
        if($order->status == 'completed' || $order->status == 'returned') {
            return back()->with('error', 'Order Can\'t be Updated');
        }

        tap($request->validate([
            'customer_name' => 'required|string',
            'customer_email' => 'nullable',
            'customer_phone' => 'required',
            'customer_address' => 'required|string',
            'delivery_method' => 'required|string',
            'note' => 'nullable',
            'shipping' => 'required',
            'advanced' => 'required',
            'buy_price' => 'required',
            'payable' => 'required',
            'profit' => 'required',
            'packaging' => 'required',
            'delivery_charge' => 'required',
            'cod_charge' => 'required',
            'sell' => 'required',
            'delivery_method' => 'required',
            'booking_number' => 'nullable',
            'status' => 'required',
            'city_id' => 'required|integer',
            'zone_id' => 'required|integer',
        ]), function($data) use($order, $request): void{
            $before = $order->status;
            $data['profit'] = $data['sell'] - $data['buy_price'] - ($data['packaging'] + $data['delivery_charge'] + $data['cod_charge']) + $data['shipping'];
            $order->status = $data['status'];
            $data['completed_at'] = $data['status'] == 'completed' ? now()->toDateTimeString() : NULL;
            $data['returned_at'] = $data['status'] == 'returned' ? now()->toDateTimeString() : NULL;
            unset($data['status']);
            foreach($order->data as $key => $val) {
                $data[$key] = $data[$key] ?? $val;
            }
            // dd($data);
            $order->data = $data;
            if($order->save()) {
                event(new OrderStatusChanged(['order' => $order, 'before' => $before]));
                foreach($order->data['products'] as $item) {
                    $product = Product::findOrFail($item['id']);
                    $product->stock = is_numeric($product->stock) ? $product->stock + $item['quantity'] : $product->stock;
                    $product->save();
                }
            }
        });

        return back()->with('success', 'Order Updated');
    }

    public function cancel(Order $order)
    {
        if (in_array($order->status, ['completed', 'returned'])) {
            return redirect()->back()->with('error', "Order Can\'t be Cancelled.");
        }

        foreach($order->data['products'] as $item) {
            $product = Product::findOrFail($item['id']);
            $product->stock = is_numeric($product->stock) ? $product->stock + $item['quantity'] : $product->stock;
            $product->save();
        }
        $order->delete();
        return redirect()->back()->with('success', 'Order Cancelled');
    }

    /**
     * Print selected orders
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function print(Request $request)
    {
        $orders = Order::whereIn('id', explode(',', $request->ids))->get();
        
        return view('admin.orders.print', compact('orders'));
    }

    public function booking(Request $request)
    {
        $request->validate([
            'order_ids' => 'required',
            'courier_provider' => 'nullable|string'
        ]);

        $booked = 0;
        $error = false;

        if ($request->courier_provider == 'Stead Fast') {
            try {
                $booked = $this->steadFast($request->order_ids);
            } catch (\Exception $e) {
                // return redirect()->back()->withDanger($e->getMessage());
                Log::error($e->getMessage());
                $error = true;
            }
        } else if ($request->courier_provider == 'Pathao') {
            foreach (Order::whereIn('id', $request->order_ids)->get() as $order) {
                try {
                    $this->pathao($order);
                    $booked++;
                } catch (\App\Pathao\Exceptions\PathaoException $e) {
                    $errors = collect($e->errors)->values()->flatten()->toArray();
                    $message = $errors[0] ?? $e->getMessage();
                    if ($message == 'Too many attempts') {
                        $message = 'Booked '.$booked.' out of '.count($request->order_ids).' orders. Please try again later.';
                    }

                    // return back()->withDanger($message);
                    Log::error($e->getMessage());
                    Log::error($message);
                    $error = true;
                } catch (\Exception $e) {
                    // return back()->withDanger($e->getMessage());
                    Log::error($e->getMessage());
                    $error = true;
                }
            }
        } else {
            try {
                $booked = $this->steadFast($request->order_ids, true);
            } catch (\Exception $e) {
                // return redirect()->back()->withDanger($e->getMessage());
                Log::error($e->getMessage());
                $error = true;
            }

            foreach (Order::whereIn('id', $request->order_ids)->where('data->delivery_method', 'Pathao')->get() as $order) {
                try {
                    $this->pathao($order);
                    $booked++;
                } catch (\App\Pathao\Exceptions\PathaoException $e) {
                    $errors = collect($e->errors)->values()->flatten()->toArray();
                    $message = $errors[0] ?? $e->getMessage();
                    if ($message == 'Too many attempts') {
                        $message = 'Booked '.$booked.' out of '.count($request->order_ids).' orders. Please try again later.';
                    }

                    // return back()->withDanger($message);
                    Log::error($e->getMessage());
                    Log::error($message);
                    $error = true;
                } catch (\Exception $e) {
                    // return back()->withDanger($e->getMessage());
                    Log::error($e->getMessage());
                    $error = true;
                }
            }
        }

        // if (setting('Redx')->enabled ?? config('redx.enabled')) {
        //     foreach (Order::whereIn('id', $order_ids)->where('data->courier', 'Redx')->get() as $order) {
        //         try {
        //             $this->redx($order);
        //             $booked++;
        //         } catch (\App\Redx\Exceptions\RedxException $e) {
        //             $errors = collect($e->errors)->values()->flatten()->toArray();
        //             $message = $errors[0] ?? $e->getMessage();
        //             if ($message == 'Too many attempts') {
        //                 $message = 'Booked '.$booked.' out of '.count($order_ids).' orders. Please try again later.';
        //             }

        //             // return back()->withDanger($message);
        //             Log::error($e->getMessage());
        //             Log::error($message);
        //             $error = true;
        //         } catch (\Exception $e) {
        //             // return back()->withDanger($e->getMessage());
        //             Log::error($e->getMessage());
        //             $error = true;
        //         }
        //     }
        // }

        if ($error) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to book orders to courier: ' . $e->getMessage() . ' Booked '.$booked.' out of '.count($request->order_ids).' orders. Please try again later.'
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Orders booked to courier successfully'
        ]);
    }

    private function steadFast($order_ids, bool $only = false): int
    {
        $orders = Order::whereIn('id', $order_ids)->when($only, function ($query) {
            $query->where('data->delivery_method', 'Stead Fast');
        })->get()->map(function ($order) {
            $data = $order->data;
            return [
                'invoice' => $order->id,
                'recipient_name' => $data['customer_name'] ?? 'N/A',
                'recipient_address' => $data['customer_address'] ?? 'N/A',
                'recipient_phone' => $data['customer_phone'] ?? '',
                'cod_amount' => intval($data['payable']),
                'note' => $data['note'],
            ];
        })->toJson();

        $response = Http::withHeaders([
            'Api-Key' => config('steadfast.key'),
            'Secret-Key' => config('steadfast.secret'),
            'Content-Type' => 'application/json',
        ])->post('https://portal.steadfast.com.bd/api/v1/create_order/bulk-order', [
            'data' => $orders,
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        foreach ($data['data'] ?? [] as $item) {
            if (! $order = Order::find($item['invoice'])) {
                continue;
            }

            $order->update([
                'status' => 'shipping',
                'data' => [
                    'delivery_method' => 'SteadFast',
                    'consignment_id' => $item['consignment_id'],
                    'tracking_code' => $item['tracking_code'],
                ],
            ]);
        }

        return count($data['data'] ?? []);
    }

    private function pathao($order): void
    {
        $data = $order->data;
        $data = [
            'store_id' => config('pathao.store_id'), // Find in store list,
            'merchant_order_id' => $order->id, // Unique order id
            'recipient_name' => $data['customer_name'] ?? 'N/A', // Customer name
            'recipient_phone' => Str::after($data['customer_phone'], '+88') ?? '', // Customer phone
            'recipient_address' => $data['customer_address'] ?? 'N/A', // Customer address
            'recipient_city' => $data['city_id'], // Find in city method
            'recipient_zone' => $data['zone_id'], // Find in zone method
            // "recipient_area"      => "", // Find in Area method
            'delivery_type' => 48, // 48 for normal delivery or 12 for on demand delivery
            'item_type' => 2, // 1 for document, 2 for parcel
            'special_instruction' => $data['note'],
            'item_quantity' => 1, // item quantity
            'item_weight' => $data['weight'] ?? 0.5, // parcel weight
            'amount_to_collect' => intval($data['payable']), // - $order->deliveryCharge, // amount to collect
            // "item_description"    => $this->getProductsDetails($order->id), // product details
        ];

        $data = \App\Pathao\Facade\Pathao::order()->create($data);

        $order->update([
            'status' => 'shipping',
            'data' => [
                'delivery_method' => 'Pathao',
                'consignment_id' => $data->consignment_id,
            ],
        ]);
    }

    private function redx($order): void
    {
        $data = [
            'pickup_store_id' => config('redx.store_id'), // Find in store list,
            'merchant_invoice_id' => strval($order->id), // Unique order id
            'customer_name' => $order->name ?? 'N/A', // Customer name
            'customer_phone' => Str::after($order->phone, '+88') ?? '', // Customer phone
            'customer_address' => $order->address ?? 'N/A', // Customer address
            'delivery_area' => $order->data['area_name'], // Find in city method
            'delivery_area_id' => $order->data['area_id'], // Find in zone method
            // "customer_area"      => "", // Find in Area method
            // 'delivery_type' => 48, // 48 for normal delivery or 12 for on demand delivery
            // 'item_type' => 2, // 1 for document, 2 for parcel
            'instruction' => $order->note,
            'is_closed_box' => false,
            'value' => 100,
            // 'item_quantity' => 1, // item quantity
            'parcel_weight' => $order->data['weight'] ?? 500, // parcel weight
            'cash_collection_amount' => intval($order->data['shipping_cost']) + intval($order->data['subtotal']) - intval($order->data['advanced'] ?? 0) - intval($order->data['discount'] ?? 0), // - $order->deliveryCharge, // amount to collect
            // "item_description"    => $this->getProductsDetails($order->id), // product details
            'parcel_details_json' => [],
        ];

        $data = \App\Redx\Facade\Redx::order()->create($data);

        $order->update([
            'status' => 'SHIPPING',
            'status_at' => now()->toDateTimeString(),
            'data' => [
                'consignment_id' => $data->tracking_id,
            ],
        ]);
    }

    /**
     * Book selected orders to courier
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function bookCourier(Request $request)
    {
        $request->validate([
            'order_ids' => 'required|array',
            'order_ids.*' => 'exists:orders,id',
            'courier_provider' => 'required|string'
        ]);

        try {
            $orders = Order::whereIn('id', $request->order_ids)->get();
            $courierProvider = $request->courier_provider;
            
            foreach ($orders as $order) {
                // Get courier booking number from API
                $bookingNumber = $this->getCourierBookingNumber($order, $courierProvider);
                
                if (!$bookingNumber) {
                    throw new \Exception("Failed to get booking number for order #{$order->id}");
                }

                $order->data = array_merge($order->data ?? [], [
                    'courier_provider' => $courierProvider,
                    'booking_number' => $bookingNumber,
                    'shipped_at' => now()->toDateTimeString()
                ]);
                $order->status = 'shipping';
                $order->save();
            }

            return response()->json([
                'success' => true,
                'message' => 'Orders booked to courier successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to book orders to courier: ' . $e->getMessage()
            ], 500);
        }
    }
}
