<?php

namespace App\Http\Controllers;

use App\Pathao\Apis\AreaApi;
use Illuminate\Http\Request;

class PathaoController extends Controller
{
    protected $areaApi;

    public function __construct(AreaApi $areaApi)
    {
        $this->areaApi = $areaApi;
    }

    /**
     * Get list of cities from Pathao API
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function cities()
    {
        $cities = cache()->remember('pathao.cities', now()->addMonth(), function () {
            try {
                return $this->areaApi->city();
            } catch (\Exception $e) {
                return [];
            }
        });

        if (empty($cities)) {
            cache()->forget('pathao.cities');
        }

        return response()->json($cities);
    }

    /**
     * Get list of zones for a city from Pathao API
     *
     * @param int $cityId
     * @return \Illuminate\Http\JsonResponse
     */
    public function zones($cityId)
    {
        $zones = cache()->remember('pathao.zones.' . $cityId, now()->addMonth(), function () use ($cityId) {
            try {
                return $this->areaApi->zone($cityId);
            } catch (\Exception $e) {
                return [];
            }
        });

        if (empty($zones)) {
            cache()->forget('pathao.zones.' . $cityId);
        }

        return response()->json($zones);
    }
}