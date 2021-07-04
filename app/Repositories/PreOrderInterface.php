<?php
namespace App\Repositories;

interface PreOrderInterface {
    public function all();
    public function productDetails($name);
    public function getCurrentOffer();
    /*public function store(array $data);
    public function show($id);
    public function update(array $data, $id);
    public function destroy($id);*/
}
