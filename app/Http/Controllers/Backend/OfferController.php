<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Repositories\OfferInterface;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    protected $OfferInterface;
    public function __construct(OfferInterface $OfferInterface){
        $this->OfferInterface = $OfferInterface;
    }
    public function index()
    {
        $offers = $this->OfferInterface->all();
        return view('backend.pages.offers.index',['offers' => $offers]);
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        $status = $this->OfferInterface->store($request->all());
        if ($status == true){
            toastr()->success('Product was stored successfully', 'Success');
            return back();

        }else {
            toastr()->error('Product could not store', 'Error');
            return back();
        }
    }


    public function show($id)
    {

    }

    public function edit($id)
    {
        $offer = $this->OfferInterface->show($id);
        return view('backend.pages.offers.edit',['offer' => $offer]);

    }

    public function update(Request $request, $id)
    {
        $status = $this->OfferInterface->update($request->all(), $id);
        if ($status == true){
            toastr()->success('Product was updated successfully', 'Updated');
            //return redirect()->route('preOrder.offers.update');

        }else {
            toastr()->error('Product could not update', 'Error');
        }
        return back();
    }

    public function destroy($id)
    {
        $this->OfferInterface->destroy($id);
        toastr()->success('Offer is deleted', 'Deleted');
        return back();
    }

    public function updateStatus($id){
        $data = $this->OfferInterface->updateStatus($id);
        toastr()->success('Offer is Activated', 'Activated');
        return back();
    }
}
