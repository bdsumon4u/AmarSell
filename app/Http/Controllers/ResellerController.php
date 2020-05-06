<?php

namespace App\Http\Controllers;

use App\Reseller;
use Illuminate\Http\Request;

class ResellerController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return view('admin.resellers')->withResellers(Reseller::all());
    }
}
