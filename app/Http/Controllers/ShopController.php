<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;

class ShopController extends Controller
{
    /**
     * Shop Index
     */
    public function index(Request $request, $per_page = 24)
    {
        $page = $request['page'] ? $request['page'] : 1;

        $products = QueryBuilder::for(Product::class)
            ->allowedFilters([
                'title', 
                'wholesale_price',
                'page',
            ])
            ->defaultSort('created_at')
            ->allowedSorts(['title'])
            // ->get(); 
            ->allowedFields(['title'])
            ->paginate($per_page, ['*'], 'page', $page)
            ->appends(request()->query());
        $products_count = 4;
        return view('resellers.shop.index', compact('products', 'products_count'));
    }
}
