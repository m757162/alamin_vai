<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Gig;
use App\Helpers\Helper;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\BusinessSetting;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Subsubcategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class GigController extends Controller
{
    use Helper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('frontend.pages.gigs.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::orderBy('name', 'asc')->get();
        return view('frontend.pages.gigs.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|integer',
            'image' => 'required|file', //|dimensions:max_height=170,max_width=280
        ]);

        // $max_gig = BusinessSetting::where('key', 'max_gig')->first()->value; for error
        $freelancer = User::find(Auth::guard('web')->user()->id);

        // if(($freelancer->total_gig + 1) > $max_gig){
        //     toastr()->warning('You can create max '.$max_gig.' gig!', 'Gig', ['timeOut' => 5000]);  for error
        //     return back();
        // }

        if($request->has('image')){
            $image_name = $this->image_store('frontend/gig/', $request->file('image'));
            $images = [];
            array_push($images, $image_name);
        }                

        $gig = Gig::create([
            'user_id' => Auth::guard('web')->user()->id,
            'title' => $request->title,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'subsubcategory_id' => $request->subsubcategory_id,
            'image' => $request->has('image') ? json_encode($images) : NULL,
            'price' => $request->price,
            'status' => 'inactive',
        ]);

        if($gig){
            $freelancer->total_gig += 1;
            $freelancer->save();
        }

        $gig_data = Gig::with(['category', 'subcategory', 'subsubcategory'])->where('id', $gig->id)->first();
        
        toastr()->warning('Gig create successful & Unpublish!', 'Gig', ['timeOut' => 5000]);
        return view('frontend.pages.gigs.gig_publish', ['gig' => $gig_data]);

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
        $id = decrypt($id);
        
        $data['gig'] = Gig::with(['category', 'subcategory', 'subsubcategory'])->find($id);
        $data['categories'] = Category::orderBy('name', 'asc')->get();
        $data['subcategories'] = Subcategory::orderBy('name', 'asc')->get();
        $data['subsubcategories'] = SubsubCategory::orderBy('name', 'asc')->get();
        return view('frontend.pages.gigs.edit', $data);
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
        //Published it when create gig
        if($request->has('publish')){
            Gig::find($id)->update(['status' => 'active']);

            toastr()->warning('Gig publish successfully!', 'Gig', ['timeOut' => 5000]);
            return redirect()->route('freelancer.gigs');            
        }

        $validated = $request->validate([
            'title' => 'required',
            'description' => 'required',
            'price' => 'required|ends_with:.00|gte:100',
            'image' => 'file|dimensions:max_height=170,max_width=280',
        ]);

        $gig = Gig::find($id);

        if($request->has('image')){
            
            foreach(json_decode($gig->image, true) as $image){                
                $this->image_delete('storage/frontend/gig/'.$image);
            }

            $image_name = $this->image_store('frontend/gig/', $request->file('image'));
            $images = [];
            array_push($images, $image_name);

            $gig->image = $images;
        }                

        $gig->title = $request->title;
        $gig->description = $request->description;
        $gig->category_id = $request->category_id;
        $gig->subcategory_id = $request->subcategory_id;
        $gig->subsubcategory_id = $request->subsubcategory_id;
        $gig->price = $request->price;
        $gig->status = $request->status;
        $gig->save();
        
        toastr()->warning('Gig update successful!', 'Gig', ['timeOut' => 5000]);
        return redirect()->route('freelancer.gigs');        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //if($gig){
            // $freelancer->total_gig -= 1;
        // }
    }

    public function fetch_subcategory(Request $request)
    {
        $subcategory = Subcategory::where('category_id', $request->category_id)->orderBy('name', 'asc')->get();
        return $subcategory;
    }

    public function fetch_subsubcategory(Request $request)
    {
        $subsubcategory = Subsubcategory::where('subcategory_id', $request->subcategory_id)->orderBy('name', 'asc')->get();
        return $subsubcategory;
    }


    //End
}
