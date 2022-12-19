<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Admin;
use Spatie\Permission\Models\Role;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['employees'] = Admin::paginate();
        $data['roles'] = Role::get();

        return view('backend.pages.employees.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'type' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ]);

        $employee = new Admin;
        
        $employee->type = $request->type;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->password = bcrypt($request->password);
        $employee->save();

        $employee->assignRole($request->type);

        toastr()->success('Employee save successfully!', 'Employee', ['timeOut' => 5000]);
        return redirect()->route('admin.employees.index');
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
    public function destroy(Request $request, $id)
    {
        
        $employee = Admin::find($id);

        $employee->removeRole($request->role);

        $employee->delete();

        toastr()->success('Employee delete successfully!', 'Employee', ['timeOut' => 5000]);
        return redirect()->route('admin.employees.index');
    }

    public function employees(Request $request)
    {
        return Admin::find($request->id);
    }

    public function update_employees(Request $request)
    {
        $request->validate([
            'type' => 'required',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required|email',
        ]);

        if($request->has('password') && $request->password != null){
            $request->validate([
                'password' => 'required|confirmed',
            ]);

            $employee = Admin::where('id', $request->id)->update([
                'password' => bcrypt($request->password)
            ]);
        }
        
        $employee = Admin::find($request->id);
        
        $employee->type = $request->type;
        $employee->name = $request->name;
        $employee->email = $request->email;
        $employee->phone = $request->phone;
        $employee->syncRoles($request->type);
        $employee->save();

        $employee->syncRoles($request->type);

        toastr()->success('Employee save successfully!', 'Employee', ['timeOut' => 5000]);
        return redirect()->route('admin.employees.index');
    }
}
