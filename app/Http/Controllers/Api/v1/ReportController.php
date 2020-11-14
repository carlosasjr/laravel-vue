<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Models\Product;
use DB;

class ReportController extends Controller
{
    /**
     * @var Product
     */
    private $product;

    public function __construct(Product $product)
    {
        //$this->middleware('jwt.auth');
        $this->product = $product;
    }

    public function products($year)
    {
        $start = "{$year}-01-01";
        $end = "{$year}-12-31";

        $products = $this->product
            ->whereBetween('created_at', [$start, $end])
            ->orderBy('created_at')->get()
            ->groupBy(function ($query) {
                return $query->created_at->format('m');
            });


        $labels = [];
        $datasets = [];

        foreach ($products as $product) {
            $labels[] = $product[0]->created_at->format('m');
            $datasets[] = $product->count();
        }

        return response()->json([
          'labels' =>  $labels,
          'datasets' => $datasets
        ]);
    }
}
