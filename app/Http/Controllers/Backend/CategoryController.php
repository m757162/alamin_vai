<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Helpers\Helper;

class CategoryController extends Controller
{
    use Helper;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.pages.category.index', [
            'categories' => Category::orderBy('id','desc')->paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.pages.category.create');
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
            'name' => 'required',
            'commission' => 'required',
            'image' => 'dimensions:max_height=120,max_width=120|file',
        ]); 

        if($request->has('image')){
            $image_name = $this->image_store('backend/category/', $request->file('image'));            
        }

        Category::create([
            'name' => $request->name,
            'commission' => $request->commission,
            'image' => $request->has('image') ? $image_name : NULL,
        ]);

        toastr()->success('Category added success!', 'Category', ['timeOut' => 5000]);
        return redirect()->route('admin.categories.index');
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
        return view('backend.pages.category.edit', [
            'category' => Category::find($id),
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
            'name' => 'required',
            'commission' => 'required',
            'image' => 'dimensions:max_height=120,max_width=120|file',
        ]); 

        $category = Category::find($id);
       
        if($request->has('image')){
            $image_name = $this->image_store('backend/category/', $request->file('image'));            
            
            if($category->image !== NULL){
                $this->image_delete($category->image);
            }
        }

        $category->update([
            'name' => $request->name,
            'commission' => $request->commission,
            'image' => $request->has('image') ? $image_name : $category->image,
        ]);

        toastr()->success('Category update success!', 'Category', ['timeOut' => 5000]);
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        
        $this->image_delete($category->image);
        $category->delete();

        toastr()->success('Category delete success!', 'Category', ['timeOut' => 5000]);
        return redirect()->route('admin.categories.index');
    }
}
