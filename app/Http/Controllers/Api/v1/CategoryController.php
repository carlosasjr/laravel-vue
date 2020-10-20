<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * @var Category
     */
    private $category;

    public function __construct(Category $category)
    {

        $this->category = $category;
    }


    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function index(Request $request)
    {
        $categories = $this->category->getResults($request->name);

        return response()->json($categories, 202);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreUpdateCategoryRequest $request
     * @return JsonResponse
     */
    public function store(StoreUpdateCategoryRequest $request)
    {
        $category = $this->category->create($request->all());

        return response()->json($category, 202);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        $category = $this->category->findOrFail($id);

        return response()->json($category, 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param StoreUpdateCategoryRequest $request
     * @param int $id
     * @return Response
     */
    public function update(StoreUpdateCategoryRequest $request, $id)
    {
         $category = $this->category->findOrFail($id);

         $category->update($request->all());

         return response()->json($category, 202);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $category = $this->category->findOrFail($id);

        $category->delete();

        return response()->json(['success' => true], 204);
    }

    public function products($id)
    {
        $category = $this->category->findOrFail($id);

        $products = $category->products()->paginate(10);

        return response()->json($products);
    }
}
