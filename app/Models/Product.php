<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'category_id'];

    public function category()
    {
        return $this->belongsTo(Product::class);
    }

    public function getResults($data, $totalPage)
    {

        if (!isset($data['filter']) && !isset($data['category_id'])) {
            return $this->orderBy('id', 'DESC')->paginate($totalPage);
        }

        return $this->where(function ($query) use ($data) {
            if (isset($data['filter'])) {
                $filter = $data['filter'];
                $query->where('name', $filter);
                $query->orWhere('description', 'LIKE', "%{$filter}%");
            }


            if (isset($data['category_id'])) {
                $query->where('category_id', $data['category_id']);
            }


        })//->toSql();dd($results);
        ->orderBy('id', 'DESC')
            ->paginate($totalPage);
    }


}
