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
        if (!$this->isFilter($data)) {
            return $this->paginate($totalPage);
        }

        return $this->where(function ($query) use ($data) {
            if (isset($data['filter'])) {
                $filter = $data['filter'];

                $query->where('name', 'LIKE', "%{$filter}%");
                $query->orWhere('description', 'LIKE', "%{$filter}%");
            }
        })->paginate($totalPage);
    }

    /**
     * @param $data
     * @return bool
     */
    private function isFilter($data): bool
    {
        return isset($data['name']) || isset($data['description']) || isset($data['filter']);
    }



}
