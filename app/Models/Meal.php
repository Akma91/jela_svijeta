<?php

namespace App\Models;

use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;
use App\Models\Category;
use App\Models\Ingredient;
use App\Models\Tag;

class Meal extends Model implements TranslatableContract
{
    use HasFactory;
    use SoftDeletes;
    use Translatable;

    protected $hidden = ['translations', 'created_at', 'updated_at', 'deleted_at', 'category_id'];

    
    public $translatedAttributes = ['title', 'description'];



    public function category(){

        return $this->belongsTo(Category::class);

    }

    public function ingredients(){

        return $this->belongsToMany(Ingredient::class);

    }

    public function tags(){

        return $this->belongsToMany(Tag::class);

    }

    public function scopeHasTags($query, $request){

        if($request['tags']){

            $tags_array = explode(',', $request['tags']);

            $query->whereHas('tags', function ($query2) use ($tags_array)  {
                $query2->whereIn('tags.id', $tags_array);
            }, '=', count(explode(',', request('tags'))));

        }

    }

    public function scopeInCategory($query, $request){

        if(request('category')){

            $category = request('category');

            if($category == 'NULL'){

                $query->WhereNull('category_id');

            } else if($category == '!NULL'){

                $query->whereNotNull('category_id');

            } else{

                $query->where('category_id', $category);
                
            }


        }

    }

    public function scopeHasStatusAfterDate($query, $request){

        if($request['diff_time']){

            $diff_time_formated = date('Y-m-d H-i-s', $request['diff_time']);



            $query->withTrashed()->whereNested(function($query2) use ($diff_time_formated){
                $query2->where('created_at', '>', $diff_time_formated)
                    ->orWhere('updated_at', '>', $diff_time_formated)
                    ->orWhere('deleted_at', '>', $diff_time_formated);
            });


            $query->selectRaw("

            *,
            TRIM(BOTH ', ' FROM 
                concat(
                    IF(created_at > ?, 'created, ', ''), 
                    IF(updated_at > ?, 'updated, ', ''), 
                    IF(deleted_at > ?, 'deleted, ', '')
                )
            )

            as status", [$diff_time_formated, $diff_time_formated, $diff_time_formated]);


        }else{

            $query->selectRaw("

            *, 'created' as status");
            
        }

    }

}
