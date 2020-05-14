<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Reseller;
use App\Transaction;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $status, ?Reseller $reseller)
    {
        if($reseller->getKey()) {
            $orders = $reseller->transactions()->getQuery();
        } else {
            $orders = Transaction::query();
        }
        if ($request->ajax()) {
            return Datatables::of($orders->status($status)->latest()->with('reseller')->get())
                    ->addIndexColumn()
                    ->addColumn('empty', function($row){
                        return '';
                    })
                    ->addColumn('reseller', function($row){
                        return '<a href="' .  route('reseller.profile.show', $row->reseller->id ?? 0) . '">
                            <strong>Name:</strong>' . ($row->reseller->name ?? '') . '
                            <br>
                            <strong>Phone:</strong>' . ($row->reseller->phone ?? '') . '
                        </a>';
                    })
                    ->addColumn('date', function($row){
                        return $row->created_at->format('F j, Y');
                    })
                    ->addColumn('way', function($row){
                        $ret = "<strong>Method:</strong> " . $row->method;
                        if($row->method == 'Bank')
                        $ret .= "<br>
                        <strong>Bank Name:</strong> " . $row->bank_name .
                        "<br>
                        <strong>Account Name:</strong> " . $row->account_name .
                        "<br>
                        <strong>Branch:</strong> " . $row->branch .
                        "<br>
                        <strong>Routing No:</strong> " . $row->routing_no;
                        return $ret;
                    })
                    ->rawColumns(['reseller', 'way'])
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
