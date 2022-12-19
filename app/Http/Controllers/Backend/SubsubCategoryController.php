<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Models\SubsubCategory;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;

class SubsubCategoryController extends Controller
{
    use Helper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.subsubcategory.index', [
            'subsubcategories' => SubsubCategory::with(['category', 'subcategory'])->orderBy('id','desc')->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.subsubcategory.create', [
            'categories' => Category::get(),
            'subcategories' => Subcategory::get(),
        ]);
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
            'subcategory_id' => 'required',
            'name' => 'required',
            'image' => 'dimensions:max_height=120,max_width=120|file',
        ],[
            'category_id.required' => 'Select Category',
            'subcategory_id.required' => 'Select Subcategory',
        ]); 

        if($request->has('image')){
            $image_name = $this->image_store('backend/category/', $request->file('image'));            
        }

        Subsubcategory::create([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'image' => $request->has('image') ? $image_name : NULL,
        ]);

        toastr()->success('Sub Subcategory added success!', 'Sub Subcategory', ['timeOut' => 5000]);
        return redirect()->route('admin.subsubcategories.index');
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
        return view('backend.pages.subsubcategory.edit', [
            'categories' => Category::get(),
            'subcategories' => SubCategory::get(),
            'subsubcategory' => SubsubCategory::find($id),
        ]);
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
        $request->validate([
            'category_id' => 'required',
            'subcategory_id' => 'required',
            'name' => 'required',
            'image' => 'dimensions:max_height=120,max_width=120|file',
        ],[
            'category_id.required' => 'Select Category',
            'subcategory_id.required' => 'Select Subcategory',
        ]); 
        
        $subsubcategory = Subsubcategory::find($id);

        if($request->has('image')){
            $image_name = $this->image_store('backend/category/', $request->file('image')); 
            
            if($subsubcategory->image !== NULL){
                $this->image_delete($subsubcategory->image);
            }
        }

        $subsubcategory->update([
            'category_id' => $request->category_id,
            'subcategory_id' => $request->subcategory_id,
            'name' => $request->name,
            'image' => $request->has('image') ? $image_name : $subsubcategory->image,
        ]);

        toastr()->success('Sub Subcategory update success!', 'Sub Subcategory', ['timeOut' => 5000]);
        return redirect()->route('admin.subsubcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {        
        $subsubcategory = Subsubcategory::find($id);

        $this->image_delete($subsubcategory->image);
        $subsubcategory->delete();

        toastr()->success('Sub Subcategory delete success!', 'Sub Subcategory', ['timeOut' => 5000]);
        return redirect()->route('admin.subsubcategories.index');
    }
}
