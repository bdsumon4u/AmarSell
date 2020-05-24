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
    public function index(Request $request)
    {
        return view('admin.resellers.index')
            // ->withResellers(Reseller::all())
            ;
    }

    public function edit(Reseller $reseller)
    {
        return view('admin.resellers.edit', compact('reseller'));
    }

    public function update(Request $request, Reseller $reseller)
    {
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'verified' => 'sometimes|nullable',
        ]);
        $data['verified_at'] = isset($data['verified']) ? now()->toDateTimeString() : NULL;

        $reseller->update($data);
        return redirect()->back()->with('success', 'Reseller Profile Updated.');
    }

    public function show(Reseller $reseller)
    {
        return view('admin.resellers.show', compact('reseller'));
    }
}
