<?php

namespace App\Http\Controllers;

use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $product = Product::all();
        return response()->json([
            'status' => true,
            'message' => 'All records fetched successifully',
            'data' => $product
        ],200);

    }


    public function create()
    {
        return view('create');
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'image' => 'required',
            'price' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation Error',
                'error' => $validator->errors()->all()
            ],401);
        }
        else{

            $img = $request->image;
            $ext = $img->getClientOriginalExtension();
            $imageName = time().".".$ext;
            $img->storeAs('/uploads',$imageName,'public');

            $product= Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'image' => $imageName
            ]);
            return response()->json([
                'status' => true,
                'message' => 'Product Created Successifully',
                'data' => $product
            ],200);
        }

    }

    public function show(string $id)
    {
        $product = Product::find($id);
        return response()->json([
            'status' => true,
            'message' => 'Single Product Fetched Successifully',
            'data' => $product
        ],200);
    }

 
    public function edit(string $id)
    {
        return view('edit');
        // $product = Product::find($id);
        // return response()->json([
        //     'status' => true,
        //     'message' => 'Single Product Fetched Successifully',
        //     'data' => $product
        // ],200);
    }

    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'price' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation Error',
                'error' => $validator->errors()->all()
            ],401);
        }
        else{

            if($request->hasFile('image')){

                $oldImageName = Product::find($id)->image;
                $oldPath = public_path().'/storage/uploads/'.$oldImageName;
                if(file_exists($oldPath)){
                    unlink($oldPath);
                }

                $img = $request->image;
                $ext = $img->getClientOriginalExtension();
                $imageName = time().".".$ext;
                $img->storeAs('/uploads',$imageName,'public');

                $product = Product::find($id)->update([
                    'name' => $request->name,
                    'price' => $request->price,
                    'image' => $imageName
                ]);
            }
            else{
                $product = Product::find($id)->update([
                    'name' => $request->name,
                    'price' => $request->price,
                ]);
            }

            
            return response()->json([
                'status' => true,
                'message' => 'Product Updated Successifully',
                'data' => $product
            ],200);
        }
    }

    public function destroy(string $id)
    {
        $oldImageName = Product::find($id)->image;
        $oldPath = public_path()."/storage/uploads/".$oldImageName;

        if(file_exists($oldPath)){
            unlink($oldPath);
        }
            
        $product = Product::find($id)->delete();
        return response()->json([
            'status' => true,
            'message' => 'Product Deleted Successifully',
            'data' => $product
        ],200);
        
    }
}


