<?php
   
namespace App\Http\Controllers\Api;
   
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\Models\Campaign;
use App\Http\Resources\Campaign as CampaignResource;
use Illuminate\Support\Facades\Validator;

class CampaignController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::all();
    
        return $this->sendResponse(CampaignResource::collection($campaigns), 'campaigns retrieved successfully.');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'title' => 'required',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $campaign = Campaign::create($input);
   
        return $this->sendResponse(new CampaignResource($campaign), 'Campaign created successfully.');
    } 
   
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $campaign = Campaign::find($id);
  
        if (is_null($campaign)) {
            return $this->sendError('Campaign not found.');
        }
   
        return $this->sendResponse(new CampaignResource($campaign), 'Campaign retrieved successfully.');
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Campaign $campaign)
    {
        $input = $request->only(['title']);
     
        $campaign->update($input);
   
        return $this->sendResponse(new CampaignResource($campaign), 'Campaign updated successfully.');
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Campaign $campaign)
    {
        $campaign->delete();
   
        return $this->sendResponse([], 'Campaign deleted successfully.');
    }
}