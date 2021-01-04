<?php

namespace App\Http\Controllers\API;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reseller;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function admin(Request $request, $status = null, ?Reseller $reseller)
    {
        if($reseller->getKey()) {
            $orders = $reseller->orders()->getQuery();
        } else {
            $orders = Order::query();
        }
        if ($request->ajax()) {
            return Datatables::of($orders->status($status)->latest()->with('reseller')->get())
                    ->addIndexColumn()
                    ->addColumn('empty', function($row){
                        return '';
                    })
                    ->addColumn('reseller', function($row){
                        return '<a href="' .  route('admin.resellers.show', $row->reseller->id) . '">
                            <strong>Name:</strong>' . $row->reseller->name . '
                            <br>
                            <strong>Phone:</strong>' . $row->reseller->phone . '
                        </a>';
                    })
                    ->addColumn('customer', function($row){
                        return '<strong>Name:</strong>' . $row->data['customer_name'] . '
                            <br>
                            <strong>Phone:</strong>' . $row->data['customer_phone'];
                    })
                    ->addColumn('price', function($row){
                        $ret = "
                        <strong style=\"white-space: nowrap;\">Buy:</strong> " . theMoney($row->status == 'pending' ? $row->data['price'] : $row->data['buy_price']) . "
                        <br>";
                        if($row->status == 'pending') {
                            $current_price = $row->current_price();
                            if($row->data['price'] != $current_price) {
                                $ret .= "<strong style=\"white-space: nowrap;\">Current:</strong> " . theMoney($current_price) . "
                                <br>";
                            }
                        } else if ($row->data['price'] != $row->data['buy_price']) {
                            $ret .= "<del style=\"white-space: nowrap;\"><strong>Order:</strong> " . theMoney($row->data['price']) . "</del>
                            <br>";
                        }
                        $ret .= "<strong style=\"white-space: nowrap;\">Sell:</strong> " . theMoney($row->data['sell']) . "
                            <br>";
                        return $ret;
                    })
                    ->addColumn('status', function($row){
                        switch ($row->status) {
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
                        return '<span class="badge badge-square badge-' . $variant . ' text-uppercase">' . $row->status . '</span>';
                    })
                    ->addColumn('ordered_at', function($row){
                        return '<span style="white-space: nowrap;">'.$row->created_at->format('d-M-Y').'</span><br><span>'.$row->created_at->format('h:i A').'</span>';
                    })
                    ->addColumn('completed_returned_at', function($row){
                        $col = $row->status == 'returned' ? 'returned_at' : 'completed_at';
                        return isset($row->data[$col]) ? date('d-M-Y', strtotime($row->data[$col])) : 'N/A';
                    })
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group btn-group-sm d-flex justify-content-between">
                            <a class="btn btn-sm btn-primary" target="_blank" href="' . route('admin.order.show', $row->id) . '" noclick="window.open(\'' . route('reseller.order.show', $row->id) . '\', \'popup\', \'width=`100%`, height=`100%`\')">View</a>';
                        in_array($row->status, ['completed', 'returned']) || $btn .= '<a class="btn btn-sm btn-danger" href="' . route('admin.order.cancel', $row->id) . '" onclick="return confirm(\'Are You Sure\');">Cancel</a>'; 
                        $btn .= '</div>';
                        return $btn;
                    })
                    ->rawColumns(['reseller', 'customer', 'status', 'price', 'ordered_at', 'action'])
                    ->setRowAttr([
                        'data-entry-id' => function($row) {
                            return $row->id;
                        },
                    ])
                    ->make(true);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function reseller(Request $request, ?Reseller $reseller, $status = null)
    {
        if($reseller->getKey()) {
            $orders = $reseller->orders()->getQuery();
        } else {
            return false;
        }

        if ($request->ajax()) {
            return Datatables::of($orders->status($status)->latest()->with('reseller')->get())
                    ->addIndexColumn()
                    ->addColumn('empty', function($row){
                        return '';
                    })
                    ->addColumn('customer', function($row){
                        return '<strong>Name:</strong>' . $row->data['customer_name'] . '
                            <br>
                            <strong>Phone:</strong>' . $row->data['customer_phone'];
                    })
                    ->addColumn('price', function($row){
                        $ret = "
                        <strong style=\"white-space: nowrap;\">Buy:</strong> " . theMoney($row->status == 'pending' ? $row->data['price'] : $row->data['buy_price']) . "
                        <br>";
                        if($row->status == 'pending') {
                            $current_price = $row->current_price();
                            if($row->data['price'] != $current_price) {
                                $ret .= "<strong style=\"white-space: nowrap;\">Current:</strong> " . theMoney($current_price) . "
                                <br>";
                            }
                        } else if ($row->data['price'] != $row->data['buy_price']) {
                            $ret .= "<del style=\"white-space: nowrap;\"><strong>Order:</strong> " . theMoney($row->data['price']) . "</del>
                            <br>";
                        }
                        $ret .= "<strong style=\"white-space: nowrap;\">Sell:</strong> " . theMoney($row->data['sell']) . "
                            <br>";
                        return $ret;
                    })
                    ->addColumn('status', function($row){
                        switch ($row->status) {
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
                        return '<span class="badge badge-square badge-' . $variant . ' text-uppercase">' . $row->status . '</span>';
                    })
                    ->addColumn('ordered_at', function($row){
                        return '<span style="white-space: nowrap;">'.$row->created_at->format('d-M-Y').'</span><br><span>'.$row->created_at->format('h:i A').'</span>';
                    })
                    ->addColumn('completed_returned_at', function($row){
                        $col = $row->status == 'returned' ? 'returned_at' : 'completed_at';
                        return isset($row->data[$col]) ? date('d-M-Y', strtotime($row->data[$col])) : 'N/A';
                    })
                    ->addColumn('action', function($row){
                        $btn = '<div class="btn-group btn-group-sm d-flex justify-content-between">
                            <a class="btn btn-sm btn-primary" target="_blank" href="' . route('reseller.order.show', $row->id) . '" noclick="window.open(\'' . route('reseller.order.show', $row->id) . '\', \'popup\', \'width=`100%`, height=`100%`\')">View</a>';
                        $row->status == 'pending' && $btn .= '<a class="btn btn-sm btn-danger" href="' . route('reseller.order.cancel', $row->id) . '" onclick="return confirm(\'Are You Sure\');">Cancel</a>'; 
                        $btn .= '</div>';
                        return $btn;
                    })
                    ->rawColumns(['customer', 'status', 'price', 'ordered_at', 'action'])
                    ->setRowAttr([
                        'data-entry-id' => function($row) {
                            return $row->id;
                        },
                    ])
                    ->make(true);
        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
