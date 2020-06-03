<?php

namespace App\Http\Controllers\Reseller;

use App\Helpers\Traits\ImageHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ImageHelper;

    public function edit()
    {
        $user = auth('reseller')->user();
        return view('reseller.setting.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $reseller = auth('reseller')->user();
        $rules = [
            // 'name' => 'required',
            // 'email' => 'required|email',
            'phone' => 'required',
            'payment' => 'nullable|array',
            'payment.*' => 'nullable|array',
        ];
        
        if($request->verified_at == 0) {
            if(! isset($reseller->documents->photo)) {
                $rules['photo'] = 'required|image|max:2048';
            } else
                $rules['photo'] = 'nullable|image|max:2048';
        }

        if($request->verified_at == 0) {
            if(! isset($reseller->documents->nid_front)) {
                $rules['nid.front'] = 'required|image|max:2048';
            } else
                $rules['nid.front'] = 'nullable|image|max:2048';
        }

        if($request->verified_at == 0) {
            if(! isset($reseller->documents->nid_back)) {
                $rules['nid.back'] = 'required|image|max:2048';
            } else
                $rules['nid.back'] = 'nullable|image|max:2048';
        }

        $data = $request->validate($rules);
        // dd($data);
        // dump($data);
        if(isset($data['payment'])) {
            $data['payment'] = $this->payment_filter($data['payment']);
        }

        if($data['photo'] ?? null) {
            $data['documents']['photo'] = $this->uploadImage($data['photo'], [
                'dir' => 'documents',
                'width' => 150,
                'height' => 150,
            ]);
            unset($data['photo']);
        } else
            $data['documents']['photo'] = optional($reseller->documents)->photo;

        if($data['nid']['front'] ?? null) {
            $data['documents']['nid_front'] = $this->uploadImage($data['nid']['front'], [
                'dir' => 'documents',
                'width' => 322,
                'height' => 222,
            ]);
            unset($data['nid']['front']);
        } else
            $data['documents']['nid_front'] = optional($reseller->documents)->nid_front;

        if($data['nid']['back'] ?? null) {
            $data['documents']['nid_back'] = $this->uploadImage($data['nid']['back'], [
                'dir' => 'documents',
                'width' => 322,
                'height' => 222,
            ]);
            unset($data['nid']['back']);
        } else
            $data['documents']['nid_back'] = optional($reseller->documents)->nid_back;
        
        $reseller->update($data);
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
