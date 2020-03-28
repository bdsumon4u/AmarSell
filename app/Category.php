<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Helpers\Traits\CategoryModelHelper;

class Category extends Model
{
    use CategoryModelHelper;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'parent_id', 'name', 'slug',
    ];

    /**
     * Products
     */
    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
