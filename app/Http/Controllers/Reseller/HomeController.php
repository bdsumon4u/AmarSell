<?php

namespace App\Http\Controllers\Reseller;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use LaravelDaily\LaravelCharts\Classes\LaravelChart;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:reseller');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $chart_options = [
            'chart_title' => 'Users by months',
            'report_type' => 'group_by_date',
            'model' => 'App\Order',
            'group_by_field' => 'created_at',
            'group_by_period' => 'month',
            'chart_type' => 'bar',
        ];
        $chart1 = new LaravelChart($chart_options);
        
        $chart_options = [
            'chart_title' => 'Transactions by user',
            'chart_type' => 'line',
            'report_type' => 'group_by_relationship',
            'model' => 'App\Transaction',
            
            'relationship_name' => 'reseller', // represents function user() on Transaction model
            'group_by_field' => 'name', // users.name
        
            'aggregate_function' => 'sum',
            'aggregate_field' => 'amount',
            
            'filter_field' => 'created_at',
            'filter_days' => 30, // show only transactions for last 30 days
            'filter_period' => 'week', // show only transactions for this week
        ];
        $chart2 = new LaravelChart($chart_options);
        
        return view('reseller.dashboard', compact('chart1', 'chart2'));
    }
}
