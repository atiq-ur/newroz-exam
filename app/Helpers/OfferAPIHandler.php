<?php
namespace App\Helpers;
use GuzzleHttp\Client;

class OfferAPIHandler
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getAllOffer(){
        $res = $this->client->request('GET', 'http://127.0.0.1:8001/api/offers');
        return json_decode($res->getBody()->getContents(), true);
    }
    public function storeOffer($data): bool
    {
        $this->client->request('POST', 'http://127.0.0.1:8001/api/offers',[
            'body' => json_encode($data),
            'headers'=> [
                'content-type' => 'application/json',
            ]
        ]);
        return true;
    }

    public function getOfferSingle($id){
        $res = $this->client->request('GET', 'http://127.0.0.1:8001/api/offers/'.$id);
        return json_decode($res->getBody()->getContents(), true);
    }

    public function updateOffer(array $data, $id)
    {
        $this->client->request('PUT', 'http://127.0.0.1:8001/api/offers/'.$id,[
            'body' => json_encode($data),
            'headers'=> [
                'content-type' => 'application/json',
            ]
        ]);
        return true;
    }


    public function destroyOffer($id){
        //$offer = $this->getOfferSingle($id);
        $this->client->request('POST', 'http://127.0.0.1:8001/api/offers/'.$id,[
            'form_params' => [
                '_method' => 'DELETE'
            ]
        ]);
    }

    public function updateStatus($id){
        $this->client->request('GET', 'http://127.0.0.1:8001/api/offer/change-status/'.$id);
    }
}
