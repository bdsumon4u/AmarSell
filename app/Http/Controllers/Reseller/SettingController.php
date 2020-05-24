<?php

namespace App\Http\Controllers\Reseller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        $user = auth('reseller')->user();
        return view('reseller.setting.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $data = $request->validate([
            // 'name' => 'required',
            // 'email' => 'required|email',
            'phone' => 'required',
            'payment' => 'required|array',
            'payment.*' => 'required|array',
        ]);
        // dump($data);
        $data['payment'] = $this->payment_filter($data['payment']);
        // dd($data);

        auth('reseller')->user()->update($data);
        return redirect()->back()->with('success', 'Setting Updated.');
    }

    public function payment_filter($payment)
    {
        $items = [];
        foreach($payment as $item) {
            if(isset($item['method']) && !empty($item['method']) && isset($item['type']) && !empty($item['type']) && isset($item['number']) && !empty($item['number'])) {
                if ( $item['method'] == 'Bank') {
                    if(!isset($item['bank_name']) || empty($item['bank_name']) || !isset($item['account_name']) || empty($item['account_name'])) {
                        continue;
                    }
                }
                $items[] = $item;
            }
        }
        return $items;
    }
}
