<?php

// app/Http/Controllers/ProductController.php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProductRequest;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ProductController extends Controller
{
    protected  $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    /**
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $products = $this->productService->getAllProducts();
        return view('admin.index', compact('products'));
    }

    /**
     * @return Application|Factory|View
     */
    public function create(): View|Factory|Application
    {
        return view('admin.product.create');
    }

    /**
     * @param ProductRequest $request
     * @return RedirectResponse
     */
    public function store(ProductRequest $request):RedirectResponse
    {
        $this->productService->createProduct($request->validated());
        return redirect()->route('products.index')->with('success', 'Product created successfully');
    }

    /**
     * @param $id
     * @return Application|Factory|View|
     */
    public function edit($id): View|Factory|Application
    {
        $product = $this->productService->getProductById($id);
        return view('admin.product.update', compact('product'));
    }

    /**
     * @param UpdateProductRequest $request
     * @param $id
     * @return RedirectResponse
     */
    public function update(UpdateProductRequest $request, $id): RedirectResponse
    {
        $this->productService->updateProduct($id, $request->validated());
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    /**
     * @param $id
     * @return RedirectResponse
     */
    public function destroy($id): RedirectResponse
    {
        $this->productService->deleteProduct($id);
        return redirect()->route('products.index')->with('success', 'Product deleted successfully');
    }

    /**
     * @param $id
     * @return View|Application|Factory|
     */
    public function show($id): Factory|View|Application
    {
    $product = $this->productService->showProduct($id);
    return view('admin.product.show',compact('product'));
    }
}

