<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\ProductService;

class ProductsController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function products_show($id)
    {
        $data = $this->productService->showProduct($id);
        return view('product', [
            'getproduct' => $data['product'],
            'rates' => $data['rates'],
            'topReviews' => $data['topReviews']
        ]);
    }

    public function men()
    {
        $menProducts = $this->productService->getProductsBySex('male');
        return view('men', compact('menProducts'));
    }

    public function women()
    {
        $womenProducts = $this->productService->getProductsBySex('female');
        return view('women', compact('womenProducts'));
    }

    public function every()
    {
        $every = $this->productService->getAllProducts();
        return view('every', compact('every'));
    }

    public function showAddForm()
    {
        return view('add_product');
    }
public function add_product(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'code' => 'required|string|max:50|unique:products,code',
        'sex' => 'required|in:male,female',
        'special' => 'nullable|in:yes,no',
        'price' => 'required|numeric|min:0',
        'ml' => 'required|integer|min:1',
        'quantity' => 'required|integer|min:0',
        'image' => 'required|string|max:255',
        'description' => 'nullable|string',
    ]);

    $this->productService->addProduct($request->all());

    return redirect()->back()->with('success', 'تم إضافة المنتج');
}


    public function search(Request $request)
    {
        $products = $this->productService->search($request->all());
        return response()->json($products);
    }
}
