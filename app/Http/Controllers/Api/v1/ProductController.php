<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateProductRequest;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * @var Product
     */
    private $product;
    private $totalPage;
    private $path = 'products';

    public function __construct(Product $product)
    {

        $this->product = $product;
        $this->totalPage = 10;

        $this->middleware('jwt.auth')->except(['index', 'show']);
    }

    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $products = $this->product->getResults($request->all(), $this->totalPage);

        return response()->json($products);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateProductRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateProductRequest $request)
    {
        $data =$request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $name = Str::of($request->name)->kebab();
            $extension = $request->file('image')->extension();

            $nameFile = "{$name}.{$extension}";
            $data['image'] = $nameFile;

            $upload = $request->file('image')->storeAs($this->path, $nameFile);

            if (!$upload) {
                return response()->json(['error' => 'Fail upload'], 500);
            }
        }


        $product = $this->product->create($data);

        return response()->json($product, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = $this->product->with('category')->findOrFail($id);

        return response()->json($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateProductRequest $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateProductRequest $request, $id)
    {

        $product = $this->product->findOrFail($id);

        $data = $request->all();

        if ($request->hasFile('image') && $request->file('image')->isValid()) {
            $this->deleteFileExists($product);

            $name = Str::of($request->name)->kebab();
            $extension = $request->file('image')->extension();

            $nameFile = "{$name}.{$extension}";
            $data['image'] = $nameFile;

            $upload = $request->file('image')->storeAs($this->path, $nameFile);

            if (!$upload) {
                return response()->json(['error' => 'Fail upload'], 500);
            }
        }


        $product->update($data);

        return response()->json($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = $this->product->findOrFail($id);

        $product->delete();

        $this->deleteFileExists($product);

        return response()->json(['success' => true], 204);
    }

    /**
     * @param $product
     */
    private function deleteFileExists($product): void
    {
        if ($product->image) {

            $file = "$this->path/{$product->image}";
            if (Storage::exists($file)) {

                Storage::delete($file);
            }
        }
    }


}
