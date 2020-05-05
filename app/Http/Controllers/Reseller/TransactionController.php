<?php

namespace App\Http\Controllers\Reseller;

use App\Transaction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = auth('reseller')->user()->transactions;
        return view('reseller.transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function request()
    {
        $reseller = auth('reseller')->user();
        return view('reseller.transactions.request', compact('reseller'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $reseller = auth('reseller')->user();
        $data = $request->validate([
            'amount' => 'required|integer',
            'method' => 'required',
            'bank_name' => 'nullable',
            'account_name' => 'nullable',
            'branch' => 'nullable',
            'routing_no' => 'nullable',
            'account_type' => 'required',
            'account_number' => 'nullable',
        ]);
        $data['reseller_id'] = $reseller->id;
        
        Transaction::create($data);
        return redirect()->back()->with('success', 'Money Request Sent.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function show(Transaction $transaction)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaction $transaction)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaction $transaction)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Transaction  $transaction
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaction $transaction)
    {
        //
    }
}
