<?php

namespace App\Http\Controllers;

use App\Events\TransactionCompleted;
use App\Order;
use App\Reseller;
use App\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Container\Container;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Redirect;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $transactions = Transaction::with('reseller')->where('status', 'paid')->get();
        return view('admin.transactions.index', compact('transactions'));
    }

    /**
     * Pay
     */
    public function pay()
    {
        $fOfMonth = now()->firstOfMonth();
        $mOfMonth = $fOfMonth->copy()->addDays(15);
        $lOfMonth = now()->lastOfMonth();

        $timezone = date('d') >= 1 && date('d') <= 15 ? [
            $mOfMonth->toDateTimeString(), $lOfMonth->toDateTimeString()
        ] : [
            $fOfMonth->toDateTimeString(), $mOfMonth->toDateTimeString()
        ];


        $resellers = Reseller::with(['transactions', 'orders'])->get()->sortByDesc('balance');
        $resellers = $resellers->filter(function (Reseller $reseller) use ($timezone) {
            if(! is_null($reseller->payment) && ( is_null($c_a = $reseller->lastPaid->created_at) || $c_a <= $timezone[0] )) {
                if($reseller->balance > 0) {
                    $reseller->payNow = $reseller->orders()
                                        ->withinDT($timezone)
                                        ->get()
                                        ->sum(function (Order $item) {
                                            return $item->data['profit'] - $item->data['advanced'];
                                        });
                    if ($reseller->payNow > 0) {
                        return $reseller;
                    }
                }
            }
        });

        // $resellers = $this->paginate($resellers, $resellers->count(), 10);
        return view('admin.transactions.pay', compact('resellers'));
    }

    public function paginate(Collection $results, $total, $pageSize)
    {
        $page = Paginator::resolveCurrentPage('page');

        return $this->paginator($results->forPage($page, $pageSize), $total, $pageSize, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);

    }

    /**
     * Create a new length-aware paginator instance.
     *
     * @param  \Illuminate\Support\Collection  $items
     * @param  int  $total
     * @param  int  $perPage
     * @param  int  $currentPage
     * @param  array  $options
     * @return \Illuminate\Pagination\LengthAwarePaginator
     */
    protected function paginator($items, $total, $perPage, $currentPage, $options)
    {
        return Container::getInstance()->makeWith(LengthAwarePaginator::class, compact(
            'items', 'total', 'perPage', 'currentPage', 'options'
        ));
    }

    /**
     * Pay To Reseller
     */
    public function payToReseller(Reseller $reseller)
    {
        return view('admin.transactions.payment-form', compact('reseller'));
    }

    /**
     * Store
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'reseller_id' => 'required|integer',
            'amount' => 'required|integer',
            'method' => 'required',
            'bank_name' => 'nullable',
            'account_name' => 'nullable',
            'branch' => 'nullable',
            'routing_no' => 'nullable',
            'account_type' => 'required',
            'account_number' => 'required',
            'transaction_number' => 'nullable',
        ]);

        $transaction_type = null;
        if($id = $request->transaction_id) {
            $transaction = Transaction::findOrFail($id);
            $transaction->update([
                'transaction_number' => $request->transaction_number,
                'status' => 'paid',
            ]);
            $transaction_type = 'request';
        } else $transaction = Transaction::create($data + ['status' => 'paid']);

        event(new TransactionCompleted($transaction, $transaction_type));

        return Redirect::back()->with('success', 'Transaction Details Stored.');
    }

    public function requests()
    {
        $transactions = Transaction::with('reseller')->where('status', 'pending')->get();
        return view('admin.transactions.requests', compact('transactions'));
    }
}
