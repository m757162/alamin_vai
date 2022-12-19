<?php

namespace App\Http\Controllers\Frontend\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\BuyerRequest;
use App\Models\Gig;
use App\Models\Bid;
use Auth;

class BuyerRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['buyer_requests'] = BuyerRequest::orderBy('id', 'desc')->paginate(10);
        return view('frontend.pages.clients.buyer-request.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::orderBy('name', 'asc')->get();
        return view('frontend.pages.clients.buyer-request.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required',
            'description' => 'required',
            'budget' => 'required',
            'estimate_date' => 'required',
        ]);

        BuyerRequest::create([
            'client_id' => Auth::guard('web')->user()->id,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'description' => $request->description,
            'budget' => $request->budget,
            'estimate_date' => $request->estimate_date,
        ]);

        toastr()->success('Post job successfully!', 'Job Post', ['timeOut' => 5000]);
        return redirect()->route('clients.buyer-request.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function buyer_request()
    {
        // $freelancer = User::find(Auth::guard('web')->user()->id);
        $category_ids = Gig::where('user_id', Auth::guard('web')->user()->id)->pluck('category_id')->unique();

        $data['buyer_requests'] = BuyerRequest::whereIn('category_id', $category_ids)
        ->where('status', 'active')
        ->paginate(10);

        $data['bids'] = Bid::where('freelancer_id', Auth::guard('web')->user()->id)
        ->paginate(10);

        return view('frontend.pages.freelancer.buyer_request', $data);
    }

    public function send_offer($buyer_request_id)
    {
        $data['buyer_request_id'] = $buyer_request_id;
        return view('frontend.pages.freelancer.bid', $data);
    }

    public function send_offer_store(Request $request)
    {

        $request->validate([
            'buyer_request_id' => 'required',
            'offer_letter' => 'required',
            'budget' => 'required',
            'estimate_date' => 'required',
        ]);

        Bid::create([
            'freelancer_id' => Auth::guard('web')->user()->id,
            'buyer_request_id' => $request->buyer_request_id,
            'offer_letter' => $request->offer_letter, 
            'budget' => $request->budget,
            'estimate_date' => $request->estimate_date,
        ]);

        toastr()->success('Send successfully!', 'Send Offer', ['timeOut' => 5000]);
        return redirect()->route('freelancer.buyer-request');

    }

    public function bid_delete($bid_id)
    {
        Bid::find($bid_id)->delete();
        toastr()->success('Bid delete successfully!', 'Bid', ['timeOut' => 5000]);
        return redirect()->route('freelancer.buyer-request');

    }
}
