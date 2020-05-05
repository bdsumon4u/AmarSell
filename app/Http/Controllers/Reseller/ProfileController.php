<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use App\Reseller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request, Reseller $reseller)
    {
        return view('reseller.profile.show')->withReseller($reseller);
    }
}
