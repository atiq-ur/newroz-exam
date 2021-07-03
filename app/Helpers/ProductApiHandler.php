<?php
namespace App\Helpers;
use GuzzleHttp\Client;

class ProductApiHandler
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
    }

}
