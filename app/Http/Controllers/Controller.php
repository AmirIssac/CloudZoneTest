<?php

namespace App\Http\Controllers;

use App\Color;
use App\Product;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index(){
        $product = Product::first();
        $colors = Color::all();
        return view('welcome')->with(['product'=>$product,'colors'=>$colors]);
    }

    public function addProductToMyFavorite(Request $request,$id){
        $product = Product::find($id);
        // add to favorite
        if($request->price || $request->color){
            $product->update([
                'color_id' => $request->color,
                'price' => $request->price,
                'is_favorite' => 1,
            ]);
        }
        else{   // cancel
            $product->update([
                'is_favorite' => 0,
            ]);
        }
        
        return response()->json($product);
    }

    public function showMyFavorite(){
        $product = Product::with(['color'])->where('is_favorite',1)->first();
        return response()->json($product);
    }
}
