<?php

namespace App\Http\Controllers;

use App\Order;
use App\Reseller;
use App\Transaction;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $orders = Order::whereHas('reseller')->with('reseller')->status('pending')->latest()->take(10)->get();
        $transactions = Transaction::whereHas('reseller')->with('reseller')->status('paid')->latest()->take(10)->get();
        $resellers = Reseller::whereNull('verified_at')->take(10)->get();
        return view('admin.dashboard', compact('orders', 'transactions', 'resellers'));
    }
}
