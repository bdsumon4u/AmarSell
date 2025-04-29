<?php

namespace App\Pathao\Manage;

use App\Pathao\Apis\AreaApi;
use App\Pathao\Apis\OrderApi;
use App\Pathao\Apis\StoreApi;

class Manage
{
    /**
     * @var AreaApi
     */
    private $area;

    /**
     * @var StoreApi
     */
    private $store;

    /**
     * @var OrderApi
     */
    private $order;

    public function __construct(AreaApi $area, StoreApi $store, OrderApi $order)
    {
        $this->area = $area;
        $this->store = $store;
        $this->order = $order;
    }

    public function area(): AreaApi
    {
        return $this->area;
    }

    public function store(): StoreApi
    {
        return $this->store;
    }

    public function order(): OrderApi
    {
        return $this->order;
    }
}
