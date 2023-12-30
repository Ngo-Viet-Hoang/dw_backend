<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Furniture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FurnitureController extends Controller
{
    public function index(){
        $furnitures = Furniture::all();
        if($furnitures-> count() > 0){
            return response()->json([
                'status'=> 200,
                'furnitures' =>$furnitures
            ],200);
        }else{
            return response()->json([
                'status'=> 404,
                'message' =>"No Records Found"
            ],404);
        }
    }
    public function store (Request $request){
        return Furniture::create($request->all());
     
    }
    function search($key){
        return Furniture::where('name','Like',"%$key%")->get();
    }
}
