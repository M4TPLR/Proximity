<?php

namespace App\Http\Controllers;

use App\Address;
use App\Http\Requests\AddressRequest;
use App\Http\Resources\AddressResource;
use App\Neighborhood;

use Grimzy\LaravelMysqlSpatial\Types\Point;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $addresses = Address::all();
        return AddressResource::collection($addresses);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AddressRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AddressRequest $request)
    {
        $address = new Address();
        $address->firstLine = $request->input('firstLine');
        $address->secondLine = $request->input('secondLine');
        $address->country = $request->input('country');
        $address->city = $request->input('city');
        $address->postcode = $request->input('postcode');

        $this->findNeighborhood($address);

        $address->save();
        $user = Auth::user()->address()->associate($address);
        $user->save();

        return e('The address has been stored!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $address = Address::find($id);
        return new AddressResource($address);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AddressRequest $request, $id)
    {
        $address = Address::find($id);
        $address->firstLine = $request->input('firstLine');
        $address->secondLine = $request->input('secondLine');
        $address->country = $request->input('country');
        $address->city = $request->input('city');
        $address->postcode = $request->input('postcode');

        $this->findNeighborhood($address);

        $address->save();
        return e('The address has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $address = Address::find($id);

        if($address){
            $address->delete();
        }
    }

    protected function findNeighborhood($address){
        $geocoder = app('geocoder');

        $postalAddress = $address->firstLine . ', ' . $address->city . ', ' . $address->country;
        $result = $geocoder->geocode($postalAddress)->get()->first();
        if (!$result){
            return e('An error has occured... No address is corresponding - '. $postalAddress);
        }

        $address->latitude = $result->getCoordinates()->getLatitude();
        $address->longitude = $result->getCoordinates()->getLongitude();

        if(Neighborhood::where('city', strtolower($address->city))->count() != 0){
            $point = new Point($address->latitude, $address->longitude);
            $neighborhood = Neighborhood::contains('geometry', $point)->first();

            if($neighborhood) {
                $address->neighborhood()->associate($neighborhood);
            }
        }

        return $address;

    }
}
