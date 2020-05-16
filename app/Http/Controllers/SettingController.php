<?php

namespace App\Http\Controllers;

use App\Helpers\Traits\ImageHelper;
use App\Page;
use App\Repository\SettingsRepository;
use App\Setting;
use CodexShaper\Menu\Models\Menu;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use ImageHelper;

    protected $rules = [
        'company' => 'sometimes|array',
        'social' => 'sometimes|array',
        'contact' => 'sometimes|array',
        'footer_menu' => 'sometimes|array',
    ];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(SettingsRepository $settingsRepo)
    {
        $compact = [
            'all_menus' => Menu::all(),
            'all_pages' => Page::all(),
        ];
        collect(array_keys($this->rules))
            ->map(function($item) use(&$compact, $settingsRepo) {
                $compact[$item] = $settingsRepo->first($item)->value ?? new Setting;
            });
        return view('admin.settings.edit', $compact);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SettingsRepository $settingsRepo)
    {
        $data = $request->validate($this->rules);
        $settingsRepo->setMany($data);

        tap($settingsRepo->first('logo')->value, function($logo) use ($request, $settingsRepo) {
            foreach($request->logo ?? [] as $type => $item) {
                if(! is_null($item)) {
                    if($type == 'favicon') {
                        $logo->$type = $this->uploadImage($item, ['dir' => 'images/logo', 'height' => '46', 'width' => '46']);
                    } else {
                        $logo->$type = $this->uploadImage($item, ['dir' => 'images/logo', 'height' => 66, 'width' => 250]);
                    }
                }
            }
            $settingsRepo->set('logo', $logo);
        });
        
        return redirect()->back()->with('success', 'Settings Saved.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
