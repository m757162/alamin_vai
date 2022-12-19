@extends('backend.master')
@section('title', 'Dashboard | Easy Bangladesh')

@section('header_css')
    <link href="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">
@endsection

@section('content')

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Dashboard > Roles</h1>
        <a 
        href="#" 
        class="d-none d-md-inline-block btn btn-md btn-primary shadow-sm" 
        data-toggle="modal" 
        data-target="#rolesModal">Add New</a>
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-12 col-md-12 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">

                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th width="55%">Role</th>
                                    <th width="15%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            
                            <tbody>
                                @forelse($roles as $key => $role)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $role->name }}</td>
                                    
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a 
                                                href="#" 
                                                data-toggle="modal" 
                                                data-target="#roleUpdateModal" 
                                                class="btn btn-primary btn-circle m-1"
                                                onclick="editRole({{ $role->id }})"
                                                >
                                                
                                                <i class="fas fa-pencil-alt"></i>
                                            </a>
                                            <form action="{{ route('admin.roles.destroy', $role->id) }}" method="post">
                                                @csrf 
                                                @method('DELETE')
                                                
                                                <button type="submit" class="btn btn-danger btn-circle m-1"><i class="fas fa-trash"></i></button>
                                            </form>
                                        </div>

                                        
                                        
                                    </td>
                                </tr>
                                @empty 
                                    <tr>
                                        <td colspan="3" class="text-center">No data found!</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        
                    </div>

                    
                </div><!--End card body-->
            </div><!--End card-->
        </div><!--End Col-->

    </div><!--End row-->

    <!-- Content Row -->

     <!--Modal Store--> 
     <div class="modal fade show" id="rolesModal" tabindex="-1" role="dialog" aria-labelledby="rolesModal" aria-modal="true" style="padding-right: 15px;">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Role</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>

                <div class="modal-body" >
                    <form action="{{ route('admin.roles.store') }}" method="POST">
                        @csrf 

                        <div class="form-group mb-3">
                            <input type="text" name="name" placeholder="New role" class="form-control">
                        </div>

                        <div class="form-group mb-3">
                            <div class="row">
                                @forelse($permissions as $key => $permission)
                                    
                                    <div class="col-md-4">
                                        <input type="checkbox" name="permissions[]" id="permission{{$key}}" value="{{ $permission->name }}">
                                        <label for="permission{{$key}}">{{ $permission->name }}</label>
                                    </div>
                                    
                                @empty 
                                    <div class="col-md-12">Add Permission first...</div>
                                @endforelse 
                            </div>

                        </div>


                        <div class="form-group mb-3">
                           <button type="submit" class="btn btn-primary">Save</button>
                        </div>

                    </form>

                </div>

                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                </div>
            </div>
        </div>
    </div>
<!--Modal Update--> 
<div class="modal fade show" id="roleUpdateModal" tabindex="-1" role="dialog" aria-labelledby="roleUpdateModal" aria-modal="true" style="padding-right: 15px;">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Role</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>

            <div class="modal-body" >
                <form action="{{ route('admin.roles.updateRole') }}" method="POST" id="editForm">
                    @csrf 
                    <input type="hidden" name="id" id="id" >

                    <div class="form-group mb-3">
                        <input type="text" name="name" id="editName"  class="form-control">

                    </div>

                    <div class="form-group mb-3">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>

                </form>

            </div>

            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!--End update modal-->
    

    
@endsection

@section ('footer_scripts')
    <!-- Page level plugins -->
    <script src="{{ asset('backend/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('backend/js/demo/datatables-demo.js') }}"></script>

    <script>

      
        function editRole(id){
            
            $.ajax({
                url: "{{ route('admin.roles.roles-edit') }}",
                data: {
                    id:id
                },
                success:function(res){
                    $('#editName').val(res.name)
                    $('#id').val(id)
                },
                error:function(){
                    console.log('Cannot get role')
                }
            });
        }
    </script>
@endsection