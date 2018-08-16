<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use App\User;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Auth;
use App\Shop;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return AnonymousResourceCollection
     */
    public function index()
    {
        Auth::login(User::find(1));
        if (Auth::check()) {
            return response()->json($this->orderByDistance($this->findShopsByNeighborhood()->get()));
        } else {
            return ProductResource::collection(Product::all());
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public
    function store(ProductRequest $request)
    {
        //$profilePic = $request->file('imgurl');
        //$profilePic->store('profiles');           uncomment for testing

        $product = new Product();
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        $product->imgurl = "testfolder";
        $product->shop()->associate(Shop::find(1));
        $product->save();
        //$product->imgurl = $profilePic->path(); uncomment for testing

        return e('Product created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return ProductResource
     */
    public
    function show($id)
    {
        $product = Product::find($id);
        return new ProductResource($product);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        $product = Product::find($id);
        $product->title = $request->input('title');
        $product->description = $request->input('description');
        $product->quantity = $request->input('quantity');
        $product->price = $request->input('price');
        $product->imgurl = $request->input('imgurl');

        return e('Product updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public
    function destroy($id)
    {
        $product = Product::find($id);

        if ($product) {
            $product->delete();
        }
    }

    /**
     * Find a product by tags
     *
     * @param  int $query
     * @return \Illuminate\Http\Response
     */
    public
    function search($query)
    {
        Auth::login(User::find(1));

        if (Auth::check()) {
            $products = $this->findShopsByNeighborhood();

            $foundProducts = $products->where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->get();

            if ($foundProducts) {
                $results = $this->orderByDistance($foundProducts);
            }else{
                return "Error: No products found...";
            }
        }else{
            $products = Product::where('title', 'like', '%' . $query . '%')
                ->orWhere('description', 'like', '%' . $query . '%')
                ->get();

            $results = $this->orderByDistance($products);
        }

        return $results;
    }

    public function findShopsByNeighborhood()
    {
        if (Auth::check()) {

            $neighborhood = Auth::user()->address->neighborhood;
            if ($neighborhood AND $neighborhood->id != 0) {
                $products = Product::whereHas('shop.address.neighborhood', function ($query) use ($neighborhood) {
                    $query->where('id', '=', $neighborhood->id);
                });
                return $products;
            } else {
                $city = Auth::user()->address->city;
                $products = Product::whereHas('shop.address', function ($query) use ($city) {
                    $query->where('city', '=', $city);
                });
                return $products;
            }
        }
    }

    protected function orderByDistance($products){
        $results = array();

        foreach ($products as $product) {

            $shopLongitude = $product->shop->address->longitude;
            $shopLatitude = $product->shop->address->latitude;

            $distance = (6371 * acos(cos($shopLatitude) * cos(Auth::user()->address->latitude) * cos(Auth::user()->address->longitude - $shopLongitude) + sin($shopLatitude) * sin(Auth::user()->address->latitude)));

            $results[$distance] = $product;
            if(!in_array($product, $results))
                array_push($results, [$distance => $product]);

        }
        ksort($results);
        return $results;
    }
}
