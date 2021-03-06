<?php
namespace App\Helpers;
use GuzzleHttp\Client;

class APIHandler{
    protected $client;

    public function __construct(){
        $this->client = new Client();
    }

    public function getAllProducts(){
        $res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product');
        return json_decode($res->getBody()->getContents(), true);
    }

    public function getSingleProduct($product_id){
        $product_res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$product_id);
        return json_decode($product_res->getBody()->getContents(), true);
    }

    public function getProductTastesAll($product_id){
        $taste_res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$product_id.'/tastes');
        return json_decode($taste_res->getBody()->getContents(), true);
    }

    public function getProductTasteSingle($product_id, $taste_id){
        $taste_res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$product_id.'/tastes/'.$taste_id);
        return json_decode($taste_res->getBody()->getContents(), true);
    }
    public function getProductDataAll($product_id, $taste_id){
        $res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$product_id.'/tastes/'.$taste_id.'/utilities');
        return json_decode($res->getBody()->getContents(), true);
    }

    public function getProductDataSingle($product_id, $taste_id, $product_data_id){
        $res = $this->client->request('GET', 'http://127.0.0.1:8001/api/product/'.$product_id.'/tastes/'.$taste_id.'/utilities/'.$product_data_id);
        return json_decode($res->getBody()->getContents(), true);
    }

    public function updateStock($product_id, $taste_id, $product_data_id, $quantity){
        $this->client->request('GET',
            'http://127.0.0.1:8001/api/product/'.$product_id.'
                /tastes/'.$taste_id.'/utilities/'.$product_data_id.'
                /updateStock/'.$quantity);
    }

    public function revertBackToStock($product_id, $taste_id, $product_data_id, $quantity){
        $this->client->request('GET',
            'http://127.0.0.1:8001/api/product/'.$product_id.'/tastes/'.$taste_id.'/utilities/'.$product_data_id.'/back-to-inventory/'.$quantity);
    }
}
