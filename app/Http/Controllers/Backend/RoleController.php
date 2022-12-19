<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['roles'] = Role::orderBy('name', 'asc')->get();
        $data['permissions'] = Permission::orderBy('name', 'asc')->get();
        return view('backend.pages.roles.index', $data);
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
            'name' => 'required',
            'permissions' => 'required',
        ]);

        $role = new Role;
        $role->name = $request->name;
        $role->guard_name = 'admin';
        $role->save();

        foreach($request->permissions as $value){
            $role->givePermissionTo($value);
        }

        toastr()->success('Role save successfully!', 'Role', ['timeOut' => 5000]);
        return redirect()->route('admin.roles.index');
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
        Role::find($id)->delete();

        toastr()->success('Role delete successfully!', 'Role', ['timeOut' => 5000]);
        return redirect()->route('admin.roles.index');
    }

    public function role(Request $request)
    {
        return Role::find($request->id);
    }

    public function updateRole(Request $request)
    {
        $role = Role::find($request->id);
        $role->name = $request->name;
        $role->save();

        toastr()->success('Role update successfully!', 'Role', ['timeOut' => 5000]);
        return redirect()->route('admin.roles.index');
    }
}
