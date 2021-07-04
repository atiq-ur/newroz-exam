<?php
namespace App\Repositories;
use App\Http\Requests\OrderPlaceRequest;
use App\Models\Order;

interface ProductInterface {
    public function all();
    public function store(array $data);
    public function show($id);
    public function update(array $data, $id);
    public function destroy($id);


}
