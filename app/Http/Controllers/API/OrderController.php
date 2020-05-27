<?php

namespace App\Http\Controllers\API;

use App\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Reseller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;
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
                        return '<a href="' .  route('reseller.profile.show', $row->reseller->id) . '">
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
                        <strong>Buy:</strong> " . theMoney($row->data['price']) . "
                        <br>";
                        if($row->status == 'pending') {
                            $current_price = $row->current_price();
                            if($row->data['price'] != $current_price) {
                                $ret .= "<strong>Current:</strong> " . theMoney($current_price) . "
                                <br>";
                            }
                        }
                        return $ret;
                    })
                    ->addColumn('status', function($row){
                        return '<span class="badge badge-square badge-' . ($row->status == 'pending' ? 'primary' : 'success') . ' text-uppercase">' . $row->status . '</span>';
                    })
                    ->addColumn('ordered_at', function($row){
                        return $row->created_at->format('F j, Y');
                    })
                    ->addColumn('action', function($row){
                        $btn = '<a class="btn btn-sm btn-block btn-primary" target="_blank" href="' . route('admin.order.show', $row->id) . '">View</a>';
                        return $btn;
                    })
                    ->rawColumns(['reseller', 'customer', 'status', 'price', 'action'])
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
    public function reseller(Request $request, $status = null, ?Reseller $reseller)
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
                    ->addColumn('customer', function($row){
                        return '<strong>Name:</strong>' . $row->data['customer_name'] . '
                            <br>
                            <strong>Phone:</strong>' . $row->data['customer_phone'];
                    })
                    ->addColumn('price', function($row){
                        $ret = "
                        <strong>Buy:</strong> " . theMoney($row->data['price']) . "
                        <br>";
                        if($row->status == 'pending') {
                            $current_price = $row->current_price();
                            if($row->data['price'] != $current_price) {
                                $ret .= "<strong>Current:</strong> " . theMoney($current_price) . "
                                <br>";
                            }
                        }
                        return $ret;
                    })
                    ->addColumn('status', function($row){
                        return '<span class="badge badge-square badge-' . ($row->status == 'pending' ? 'primary' : 'success') . ' text-uppercase">' . $row->status . '</span>';
                    })
                    ->addColumn('ordered_at', function($row){
                        return $row->created_at->format('F j, Y');
                    })
                    ->addColumn('action', function($row){
                        if ($row->status == 'pending') {
                            $btn = '<a class="btn btn-sm btn-danger" href="' . route('reseller.order.cancel', $row->id) . '">Cancel</a>';
                        } else {
                            $btn = '<a class="btn btn-sm btn-primary" target="_blank" href="' . route('reseller.order.show', $row->id) . '">View</a>';
                        }
                        return $btn;
                    })
                    ->rawColumns(['customer', 'status', 'price', 'action'])
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
