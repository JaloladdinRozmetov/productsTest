<?php

namespace App\Repositories;

use App\Models\Product;
use App\Services\UpdateArticleService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;
use App\Jobs\SendProductCreatedNotification;


class ProductRepository
{
    private $updateArticleService;

    public function __construct(UpdateArticleService $updateArticleService)
    {
        $this->updateArticleService = $updateArticleService;

    }

    /**
     * @return Collection|array
     */
    public function getAll(): Collection|array
    {
        return Product::query()->get();
    }

    /**
     * @param $id
     * @return Model|Collection|Builder|array|null
     */
    public function getById($id): Model|Collection|Builder|array|null
    {
        return Product::query()->findOrFail($id);
    }

    /**
     * @param array $data
     * @return Builder|Model
     */
    public function create(array $data): Model|Builder
    {
        if (isset($data['attributes_name']) and isset($data['attributes_value']))
        {
            $attributes = array_combine(
                $data['attributes_name'],
                $data['attributes_value']
            );
        }else{
            $attributes = null;
        }

        $product = Product::query()->create([
            'name' => $data['name'],
            'article' => $data['article'],
            'status' => $data['status'],
            'data' => json_encode($attributes),
        ]);

        SendProductCreatedNotification::dispatch(config('product.email'), $product);

        return $product;

    }

    /**
     * @param $id
     * @param array $data
     * @return array|Builder|Collection|Model|null
     */
    public function update($id, array $data): Model|Collection|Builder|array|null
    {
        if (isset($data['attributes_name']) and isset($data['attributes_value']))
        {
            $attributes = array_combine(
                $data['attributes_name'],
                $data['attributes_value']
            );
        }else{
            $attributes = null;
        }
        $product = $this->getById($id);
        $this->updateArticleService->handle($product, $data);
            $product->update([
                'name' => $data['name'],
                'status' => $data['status'],
                'data' => json_encode($attributes),
            ]);
        return $product;
    }

    /**
     * @param $id
     * @return Model|Collection|Builder|array|null
     */
    public function delete($id): Model|Collection|Builder|array|null
    {
        $product = $this->getById($id);
        $product->delete();
        return $product;
    }
}

