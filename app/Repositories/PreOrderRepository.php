<?php
namespace App\Repositories;
use App\Helpers\APIHandler;
use App\Helpers\OfferAPIHandler;

class PreOrderRepository implements PreOrderInterface
{
    protected $preOrder;
    public function __construct(){
        $this->preOrder = new APIHandler();
    }
    public function all()
    {
        return $this->preOrder->getAllProducts();
    }

    public function productDetails($name): array
    {
        $products =  $this->preOrder->getAllProducts();
        $product_id = 0;
        foreach ($products['data'] as $product) {
            if ($product['name'] == $name){
                $product_id = $product['id'];
            }
        }
        $product = $this->preOrder->getSingleProduct($product_id);
        $tastes = $this->preOrder->getProductTastesAll($product_id);
        //return ['product' => $product, 'tastes' => $tastes];
        return [$product, $tastes];
    }

    public function addToCart(array $data): array
    {
        $pro_id = $data['product_id'];
        $taste_id = $data['taste_id'];
        $product_data_id = $data['product_data_id'];

        $product = $this->preOrder->getSingleProduct($pro_id);
        $taste = $this->preOrder->getProductTasteSingle($pro_id, $taste_id);
        $productData = $this->preOrder->getProductDataSingle($pro_id, $taste_id, $product_data_id);

        return [$product, $taste, $productData];
    }
}
