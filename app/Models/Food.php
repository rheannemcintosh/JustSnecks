<?php

/**
 * Category Model
 *
 * @author  Rheanne McIntosh <rheanne.mcintosh@outlook.com>
 * @version 07-03-2021
 */

namespace App\Models;

// Use Statements
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Food extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'price',
        'category_id',
        'image',
    ];

    /**
     * Get the food associated with the category
     */
    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }
}
