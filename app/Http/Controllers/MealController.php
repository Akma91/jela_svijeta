<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Http\Requests\MealRequest;

class MealController extends Controller
{
    
    public function index(MealRequest $request){

        $additional_data = explode(',', $request['with']);

        $meals = Meal::with($additional_data)->latest();

        /// queryji su definirani unutar modela kao query scopes
        $meals->hasTags($request);
        $meals->inCategory($request);
        $meals->hasStatusAfterDate($request);
        //////////////////////////////////////////////////////


        return $meals->paginate($request['per_page'])->appends(request()->query());

    }

}
