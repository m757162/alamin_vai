<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Gig;
use App\Models\Category;
use App\Models\Subcategory;
use App\Models\Favourite;
use Illuminate\Http\Request;
use App\Models\SubsubCategory;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Storage;

class HomeController extends Controller
{
    public function home(Request $request)
    {
       
        if($request->has('refer')){
            Session::put('refer', $request->refer);
        }
        $data['categories'] = Category::limit(8)->get();
        $data['allCategories']=Category::with('subcategory.subsubcategory')->get();
        
        return view('frontend.pages.home',$data);
    }

    public function gig_view($title, $id)
    {
        // return $id;
        $data['gig_favourite'] = Favourite::where('user_id',Auth::id())->where('gig_id',decrypt($id))->first();
        Session::put('visitor_ip', request()->ip());

        $data['gig'] = Gig::with(['freelancer', 'rate', 'category', 'subcategory', 'subsubcategory'])->find(decrypt($id));
          
        if(Auth::guard('web')->check()){
            if(Auth::guard('web')->user()->id != $data['gig']->user_id){
                $gig = Gig::find(decrypt($id));
                $gig->view += 1;
                $gig->save();
            }

        }elseif(request()->ip() != Session::get('visitor_ip')){
            $gig = Gig::find(decrypt($id));
            $gig->view += 1;
            $gig->save();
        }               

        return view('frontend.pages.users.gig_view', $data);
    }

    public function find_gig(Request $request)
    {
        
        $data['page_title'] = 'Finding Gig';
        $data['categories'] = Category::orderBy('name', 'asc')->get();
        $data['subcategories'] = Subcategory::orderBy('name', 'asc')->get();
        $data['subsubcategories'] = SubsubCategory::orderBy('name', 'asc')->get(); 
        $data['gig_favourite'] = Favourite::where('user_id',Auth::id())->first();
    
        $data['gigs']= Gig::with(['fav_gig','freelancer', 'rate', 'category', 'subcategory', 'subsubcategory'])
        ->filtering(request(['category_name', 'subcategory_name', 'subsubcategory_name','search']))
        ->budgetFilter(request(['min_budget', 'max_budget']))
        ->whereStatus('active')
        ->orderBy('id', 'desc')
        ->paginate(12);
      
        return view('frontend.pages.find-gigs', $data);
    }

    // find gig end 
    public function find_gig_end(Request $request){
        return Gig::where('title','like','%'.$request->search.'%')->get();
    }




    // Gig favourite 
    public function gig_favourite(Request $request){
       
        Favourite::insert([
            'user_id'=>Auth::id(),
            'gig_id'=> $request->gig
        ]);

        toastr()->success('added successfully');
        return redirect()->back();
    }

    // Gig favourite delete
    public function gig_favourite_delete(Request $request){
       
        Favourite::where('user_id',Auth::id())->where('gig_id',$request->gig)->delete();
        toastr()->success('delete successfully',['timeOut'=> 500]);
        return back();

    }

    //End
}
