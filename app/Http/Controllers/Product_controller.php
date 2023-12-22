<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product_request;
use App\Models\Product_model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class Product_controller extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // public function index()
    // {
    //     return Product_model::all();
    // }

    /**
     * Display a listing of the resource.
     */
    // Inside the index or show method of Product_controller
    public function index()
    {
        $products = Product_model::all();

        // Append image URLs to the products before sending the response
        $productsWithImages = $products->map(function ($product) {
            $product->image_url = asset('storage/' . $product->image); // Assuming images are stored in storage/images
            return $product;
        });

        return $productsWithImages;
    }


    /**
     * Store a newly created resource in storage.
     */
    // public function store(Product_request $request)
    // {
    //     $product = Product_model::create($request->validated());

    //     return $product;
    // }

    /**
     * Store a newly created resource in storage.
     */
    // public function store(Product_request $request)
    // {
    //     $validatedData = $request->validated();

    //     // Check if an image is present in the request
    //     if ($request->hasFile('image')) {
    //         $imagePath = $request->file('image')->storePublicly('images', 'public');
    //         $validatedData['image'] = $imagePath;
    //     }

    //     // Create the product with the validated data
    //     $product = Product_model::create($validatedData);

    //     return $product;
    // }

    public function store(Product_request $request)
    {
        // Validate the incoming request using Product_request rules
        $validatedData = $request->validated();

        // Check if an image is present in the request
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->storePublicly('images', 'public');
            $validatedData['image'] = $imagePath;
        }

        // Create the product with the validated data
        $product = Product_model::create($validatedData);

        // Return the created product
        // return $product;
        return response()->json([$product, 201]);
    }




    // /**
    //  * Display the specified resource.
    //  */
    // public function show(string $id)
    // {
    //     $product = Product_model::findOrFail($id);

    //     return $product;
    // }


    // /**
    //  * Display the specified resource.
    //  */
    public function show(string $id)
    {
        $product = Product_model::findOrFail($id);

        // Append image URL to the product before sending the response
        $product->image_url = asset('storage/' . $product->image); // Assuming images are stored in storage/images

        return $product;
    }


    /**
     * Update the specified resource in storage.
     */
    // public function update(Product_request $request, string $id)
    // {
    //     $validated = $request->validated();

    //     $product = Product_model::findOrFail($id)->update($validated);

    //     return $product;
    // }


    public function update(Product_request $request, string $id)
    {
        try {
            $product = Product_model::findOrFail($id);

            $validatedData = $request->validated();

            if ($request->hasFile('image')) {
                if (!is_null($product->image)) {
                    Storage::disk('public')->delete($product->image);
                }

                $imagePath = $request->file('image')->storePublicly('images', 'public');
                $validatedData['image'] = $imagePath;
            }

            $product->update($validatedData);

            return response()->json(['message' => 'Product updated successfully', 'product' => $product], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to update product', 'error' => $e->getMessage()], 500);
        }
    }

    // public function destroy(string $mainTableId)
    // {
    //     try {
    //         // Begin a database transaction
    //         DB::products();

    //         // Retrieve related records from TableB (stock)
    //         $relatedRecordsTableB = DB::table('stock')->where('prod_id', $mainTableId)->get();

    //         // Check if there are any related records in the stock table
    //         if ($relatedRecordsTableB->isNotEmpty()) {
    //             // Delete related records from TableB (stock)
    //             DB::table('stock')->where('prod_id', $mainTableId)->delete();
    //         }

    //         // Perform deletion of the record from MainTable (product)
    //         DB::table('product')->where('prod_id', $mainTableId)->delete();

    //         // Commit the transaction
    //         DB::commit();

    //         // Return a success message or indicator
    //         return ['success' => true, 'product' => 'Deletion successful'];
    //     } catch (\Exception $e) {
    //         // Something went wrong, rollback the transaction
    //         DB::rollBack();

    //         // Return an error message or indicator
    //         return ['success' => false, 'product' => 'Deletion failed: ' . $e->getMessage()];
    //     }
    // }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product_model::findOrFail($id);

        $product->delete();

        return $product;
    }

    /**
     * Update image the specified resource from storage.
     */
    public function image(Product_request $request, string $id)
    {
        $product = Product_model::findOrFail($id);

        if (!is_null($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->image = $request->file('image')->storePublicly('images', 'public');
        // $image->image = $request->file('image')->storePublicly('images', 'public');

        $product->save();

        return $product;
    }

    public function proDCategory()
    {
        $leftJoin = DB::table('product')
            ->leftJoin('category', 'category.category_id', '=', 'product.category_id')
            ->select('product.*', 'category.*')
            ->get();

        return $leftJoin;
    }



    // public function prodStock()
    // {
    //     $response = DB::table('product')
    //         ->select(
    //             'product.*',
    //             'stock.*'
    //         )
    //         ->join('stock', 'category.prod_id', '=', 'stock.prod_id')
    //         ->get();

    //     return $response;
    // }

    // public function prodStock()
    // {
    //     $leftJoin = DB::table('product')
    //         ->leftJoin('stock', 'product.prod_id', '=', 'stock.prod_id')
    //         ->select('product.*', 'stock.*')
    //         ->get();

    //     return $leftJoin;
    // }

    public function prodStock()
    {
        $leftJoin = DB::table('product')
            ->leftJoin('stock', 'product.prod_id', '=', 'stock.prod_id')
            ->select(
                'product.*',
                'stock.quantity',
            )
            ->get();

        return $leftJoin;
    }


    // public function store(Product_request $request)
    // {
    //     $product = Product_model::create($request->validated());

    //     return $product;
    // }
}
