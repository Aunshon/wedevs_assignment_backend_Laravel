<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;

use Carbon\Carbon;
use Facade\FlareClient\Stacktrace\File;

use Image;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login']]);
    }
    public function index()
    {
        $products = Product::get();
        return response()->json(['products'=>$products]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            // 'image' => 'required',
            'description' => 'required',
        ]);

        $file_name = null;
        if ($request->image!='' || $request->image !=null) {
            $file_name = Carbon::now()->timestamp . '.png';
            $path = public_path() . '/uploads/product//' . $file_name;
            $img = Image::make($request->image);
            $img->save($path);
        }


        Product::insert([
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
            'image' => $file_name,
        ]);
        $products = Product::get();
        return response()->json(['products'=>$products]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'price' => 'required',
            // 'image' => 'required',
            'description' => 'required',
            'id' => 'required',
        ]);

        $file_name = null;
        if ($request->image!='' || $request->image !=null) {

            $getImage = Product::findOrFail($request->id);
            if ($getImage->image != null) {
                $path = public_path() . '/uploads/product//' . $getImage->image;
                // dd($path);
                if (file_exists($path)) {
                    @unlink($path);
                }
            }


            $file_name = Carbon::now()->timestamp . '.png';
            $path = public_path() . '/uploads/product//' . $file_name;
            $img = Image::make($request->image);
            $img->save($path);
            Product::find($request->id)->update([
            'image' => $file_name,
        ]);
        }


        Product::find($request->id)->update([
            'title' => $request->title,
            'price' => $request->price,
            'description' => $request->description,
        ]);
        $products = Product::get();
        return response()->json(['products'=>$products]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        if ($request->image != null) {
            $path = public_path() . '/uploads/product//' . $request->image;
            // dd($path);
            if (file_exists($path)) {
                @unlink($path);
            }
        }
        Product::find($request->id)->delete();
        $products = Product::get();
        return response()->json(['products'=>$products]);
    }
}
