<?php
   
namespace App\Http\Controllers\Api;
   
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Http\Resources\Donation as DonationResource;
use App\Models\Donation;
use Illuminate\Support\Facades\Validator;

class DonationController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $donations = Donation::all();
    
        return $this->sendResponse(DonationResource::collection($donations), 'donations retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->only(['donorName', 'campaignID', 'amount']);
   
        $validator = Validator::make($input, [
            'donorName' => 'required',
            'amount' => 'required',
            'campaignID' => 'exists:campaigns,id',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $donation = Donation::create($input);
   
        return $this->sendResponse(new DonationResource($donation), 'Donation created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $donation = Donation::find($id);
  
        if (is_null($donation)) {
            return $this->sendError('Donation not found.');
        }
   
        return $this->sendResponse(new DonationResource($donation), 'Donation retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Donation $donation)
    {
        $input = $request->only(['donorName', 'campaignID', 'amount']);
   
        $validator = Validator::make($input, [
            'campaignID' => 'exists:campaigns,id',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $donation->update($input);
   
        return $this->sendResponse(new DonationResource($donation), 'Donation updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Donation $donation)
    {
        $donation->delete();
   
        return $this->sendResponse([], 'Donation deleted successfully.');
    }
}