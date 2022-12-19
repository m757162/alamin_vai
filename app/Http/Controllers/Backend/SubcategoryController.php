<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;

class SubcategoryController extends Controller
{
    use Helper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.subcategory.index', [
            'subcategories' => Subcategory::with('category')->orderBy('id','desc')->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.subcategory.create', [
            'categories' => Category::get(),
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
            'name' => 'required',
            'image' => 'dimensions:max_height=120,max_width=120|file',
        ],[
            'category_id.required' => 'Select Category',
        ]); 

        if($request->has('image')){
            $image_name = $this->image_store('backend/category/', $request->file('image'));            
        }

        Subcategory::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'image' => $request->has('image') ? $image_name : NULL,
        ]);

        toastr()->success('Subcategory added success!', 'Subcategory', ['timeOut' => 5000]);
        return redirect()->route('admin.subcategories.index');
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
        return view('backend.pages.subcategory.edit', [
            'categories' => Category::get(),
            'subcategory' => Subcategory::find($id),
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
            'name' => 'required',
            'image' => 'dimensions:max_height=120,max_width=120|file',
        ],[
            'category_id.required' => 'Select Category',
        ]); 
        
        $subcategory = Subcategory::find($id);

        if($request->has('image')){
            $image_name = $this->image_store('backend/category/', $request->file('image'));            
            
            if($subcategory->image !== NULL){
                $this->image_delete($subcategory->image);
            }            
        }

        $subcategory->update([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'image' => $request->has('image') ? $image_name : $subcategory->image,
        ]);

        toastr()->success('Subcategory update success!', 'Subcategory', ['timeOut' => 5000]);
        return redirect()->route('admin.subcategories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $subcategory = Subcategory::find($id);

        $this->image_delete($subcategory->image);
        $subcategory->delete();
        
        toastr()->success('Subcategory delete success!', 'Subcategory', ['timeOut' => 5000]);
        return redirect()->route('admin.subcategories.index');
    }
}
