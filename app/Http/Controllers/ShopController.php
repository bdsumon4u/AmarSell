<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Shop Index
     */
    public function index()
    {
        return view('resellers.shop.index');
    }
}
