<?php
namespace App\Repositories;
use App\Helpers\OfferAPIHandler;

class OfferRepository implements OfferInterface
{
    protected $offer;
    public function __construct(){
        $this->offer = new OfferAPIHandler();
    }

    public function all()
    {
        return $this->offer->getAllOffer();
    }

    public function store(array $data)
    {
        $status = $this->offer->storeOffer($data);
        if ($status){
            return true;
        }
        else {
            return false;
        }
    }

    public function show($id)
    {
        return $this->offer->getOfferSingle($id);
    }

    public function update(array $data, $id)
    {
        return $this->offer->updateOffer($data, $id);

    }

    public function destroy($id)
    {
        $this->offer->destroyOffer($id);
    }

    public function updateStatus($id)
    {
        $this->offer->updateStatus($id);
    }

    public function getCurrentOffer()
    {
        return $this->offer->getCurrentOffer();
    }
}
