<?php

/**
 * Category Model
 *
 * @author  Rheanne McIntosh <rheanne.mcintosh@outlook.com>
 * @version 07-03-2021
 */

namespace App\Models;

// Use Statements
use App\Models\Food;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];
    
    /**
     * Get the food associated with the category
     */
    public function food()
    {
        return $this->hasOne(Food::class, 'category_id', 'id');
    }
}