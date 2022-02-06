<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class ProductController extends Controller
{
    public function get(Request $request) {

        $productQuery = Product::select('id', 'name', 'description', 'price', 'product_category_id')->with([
            'category' => function($q){
                $q->select('id','name');
            },
            'productDetails' => function($q){
                $q->select('product_details.id','product_id','name as gudang_name','stock')
                ->join('warehouses', 'warehouses.id', '=', 'product_details.warehouses_id');
            }
        ]);
        
        if($request->category) {
            $productQuery->whereHas('category', function($q) use($request){
                $q->where('name', $request->category);
            });
        }

        if($request->sortBy && in_array($request->sortBy,['id', 'name', 'price'])) {
            $sortBy = $request->sortBy;
        } else {
            $sortBy = 'id';
        }

        if($request->sortOrder && in_array($request->sortOrder,['asc', 'desc'])) {
            $sortOrder = $request->sortOrder;
        } else {
            $sortOrder = 'desc';
        }

        $perPage = $request->perPage;

        if($request->paginate) {
            $product = $productQuery->orderBy($sortBy, $sortOrder)->paginate($perPage ?? 5);

        } else {
            $product = $productQuery->orderBy($sortBy, $sortOrder)->get();
        }
        

        return response()->json([
            'status' => 200,
            'message' => 'success get',
            'data' => $product
        ],200);
    }
}
