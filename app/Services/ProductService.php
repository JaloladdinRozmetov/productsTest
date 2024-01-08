<?php

// app/Services/ProductService.php

namespace App\Services;

use App\Repositories\ProductRepository;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

class ProductService
{
    protected $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @return Collection|array
     */
    public function getAllProducts(): Collection|array
    {
        return $this->productRepository->getAll();
    }

    /**
     * @param $id
     * @return Model|Collection|Builder|array|null
     */
    public function getProductById($id): Model|Collection|Builder|array|null
    {
        return $this->productRepository->getById($id);
    }

    /**
     * @param array $data
     * @return Model|Builder
     */
    public function createProduct(array $data): Model|Builder
    {
        return $this->productRepository->create($data);
    }

    /**
     * @param $id
     * @param array $data
     * @return Model|Collection|Builder|array|null
     */
    public function updateProduct($id, array $data): Model|Collection|Builder|array|null
    {
        return $this->productRepository->update($id, $data);
    }

    /**
     * @param $id
     * @return Model|Collection|Builder|array|null
     */
    public function deleteProduct($id): Model|Collection|Builder|array|null
    {
        return $this->productRepository->delete($id);
    }

    /**
     * @param $id
     * @return Model|Collection|Builder|array|null
     */
    public function showProduct($id): Model|Collection|Builder|array|null
    {
        return $this->productRepository->getById($id);
    }
}

