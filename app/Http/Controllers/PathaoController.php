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
        try {
            $cities = $this->areaApi->city();
            return response()->json($cities);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    /**
     * Get list of zones for a city from Pathao API
     *
     * @param int $cityId
     * @return \Illuminate\Http\JsonResponse
     */
    public function zones($cityId)
    {
        try {
            $zones = $this->areaApi->zone($cityId);
            return response()->json($zones);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}