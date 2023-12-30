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
        if($furnitures-> count() >0){
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
        $validator  = Validator::make($request->all(),[
            'productCode' =>'require',
            'name' =>'require',
            'price' =>'require',
            'avatar' =>'require',
        ]);
        if($validator->fails()){
            return response() ->json([
                'status'=> 422,
            ], 422);
        }else{

            $furniture = Furniture::create([
                'productCode' => $request->productCode,
                'name' => $request->name,
                'price' => $request->price,
                'avatar' => $request->avatar,
            ]);
            if($furniture){

                return response()->json([
                    'status' => 200,
                    'message' =>"Created Successfully"
                ],200);
            }else{
                return response()->json([
                    'status' => 500,
                    'message' =>"Something went Wrong"
                ],500);
            }
        }
    }
    function search($key){
        return Furniture::where('name','Like',"%$key%")->get();
    }
}
