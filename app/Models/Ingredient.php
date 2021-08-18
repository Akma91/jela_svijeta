<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Meal;


class Ingredient extends Model implements TranslatableContract
{
    use HasFactory;
    use Translatable;
    
    public $translatedAttributes = ['title'];

    protected $hidden = ['translations', 'created_at', 'updated_at', 'deleted_at', 'pivot'];

    public function meals(){

        return $this->belongsToMany(Meal::class);

    }

}
