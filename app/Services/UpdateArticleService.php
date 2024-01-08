<?php

namespace App\Services;

use App\Models\Product;

class UpdateArticleService
{
    public function handle(Product $product,array $data)
    {
        $userRole = auth()->user()->role;
        if ($product->article !== $data['article'] and $userRole == config('product.role.admin'))
        {
                $product->article = $data['article'];
                $product->save();
        }
    }
}
