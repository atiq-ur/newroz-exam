<?php
namespace App\Repositories;
use App\Helpers\APIHandler;
use PDF;

class ProductRepository implements ProductInterface
{
    protected $product;

    public function __construct()
    {
        $this->product = new APIHandler();
    }

    public function all()
    {
        return $this->product->getAllProducts();
    }

    public function store(array $data)
    {
        $this->product->storeProduct($data);
    }

    public function show($id)
    {
        return $this->product->getSingleProduct($id);
    }

    public function update(array $data, $id)
    {
        $this->product->updateProduct($data, $id);
    }

    public function destroy($id)
    {
        $this->product->destroyProduct($id);
    }
}
