@extends('layouts.dashboard')

@section('content')
@section('title', 'Add Item Category')
<main class="page-content">

    <div class="container">
        <div style="width: 1000px;">
            <div class="card-header mt-5 text-center">
                <strong>
                    <h5>Item Category Management</h5>
                </strong>
            </div>
            <div class="card-body">
             
                <div class="row">
                    <div class="col-md-12">
                       
                        <button class="btn btn-xs text-light mb-3" style="background-color: #1e2229" data-toggle="modal"
                            data-target=".bd-example-modal-lg" data-backdrop="static">Add New Category</button>
                        
                        <table id="example" class="display table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Category Code</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    {{-- @if (Auth::user()->can('update') || Auth::user()->can('delete')) --}}
                                    <th>Action</th>
                                    {{-- @endif --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $key => $category)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $category->category_code }}</td>
                                        <td>{{ $category->category_description }}</td>
                                        <td>{{ $category->category_status }}</td>
                                        @if (Auth::user()->can('update', $category))
                                        <td><a id=" {{ $category->id }} " style="cursor: pointer" class='mr-3 edit_category_button'><span data-toggle='modal'
                                            data-target='#edit_category' class='fas fa-edit text-info'></span></a>
                                        @endif
                                           @can('delete', $category)
                                            <a id=" {{ $category->id }} " style="cursor: pointer" class="delete_category_button"><span class='fas fa-trash text-danger'></span></a></td>
                                            <form id="delete-item-category" action="{{ route('admin.category-delete', $category->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        @endcan
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Add Category Modal -->
    <div class="modal fade bd-example-modal-lg" id="category" data-keyboard="false" data-backdrop="static" tabindex="-1"
        role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Add Item Category</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- @if (count($errors) > 0)
                        <script>
                            $('#category').modal('show');
                        </script>
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                            <ul class="p-0 m-0" style="list-style: none;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif --}}

                    <form method="POST" id="category-form" action="save-item-category">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category ID</label>
                                    <input class="form-control form-control-sm" name="category_id"
                                        value="{{ $next_id }}" readonly type="text" placeholder="Category ID">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category Code <span class="text-danger">*</span></label>
                                    <input name="category_code" class="form-control form-control-sm" type="text"
                                        placeholder="Category Code">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description <span class="text-danger">*</span></label>
                                    <textarea name="category_description" class="form-control form-control-sm"
                                        type="text" placeholder="Category Description"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <select name="category_status" class="form-control form-control-sm">
                                        <option selected disabled>Select Category Status...</option>
                                        <option value="Active">Active</option>
                                        <option value="InActive">InActive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        @can('create', \App\Models\ItemCategory::class)
                        <div class="form-group">
                            <button type="button" onclick="document.getElementById('category-form').submit();"
                                class="btn btn-xs text-light" style="background-color: #1e2229">Save Item
                                Category</button>
                        </div>
                        @endcan
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Item Category Modal -->
     <div class="modal fade bd-example-modal-lg" id="edit_category" data-keyboard="false" data-backdrop="static" tabindex="-1"
     role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
     <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
             <div class="modal-header text-center">
                 <h5 class="modal-title" id="exampleModalLabel">Edit Item Category</h5>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true">&times;</span>
                 </button>
             </div>
             <div class="modal-body">
                 {{-- @if (count($errors) > 0)
                     <script>
                         $('#edit_category').modal('show');
                     </script>
                     <div class="alert alert-danger alert-dismissible fade show" role="alert">
                         <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                             <span aria-hidden="true">&times;</span>
                         </button>
                         <ul class="p-0 m-0" style="list-style: none;">
                             @foreach ($errors->all() as $error)
                                 <li>{{ $error }}</li>
                             @endforeach
                         </ul>
                     </div>
                 @endif --}}
                 <form method="POST" id="edit-category-form" action="update-item-category">
                     @csrf
                     <div class="row">
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Category ID</label>
                                 <input class="form-control form-control-sm" id="edit_category_id" name="category_id"
                                      readonly type="text" placeholder="Category ID">
                             </div>

                         </div>
                         <div class="col-md-6">
                             <div class="form-group">
                                 <label>Category Code <span class="text-danger">*</span></label>
                                 <input name="category_code" id="edit_category_code" class="form-control form-control-sm" type="text"
                                     placeholder="Category Code">
                             </div>
                         </div>
                     </div>
                     <div class="row">
                         <div class="col-md-12">
                             <div class="form-group">
                                 <label>Description <span class="text-danger">*</span></label>
                                 <textarea name="category_description" class="form-control form-control-sm"
                                     type="text" id="edit_category_description" placeholder="Category Description"></textarea>
                             </div>
                             <div class="form-group">
                                 <label>Status <span class="text-danger">*</span></label>
                                 <select name="category_status" id="edit_category_status" class="form-control form-control-sm">
                                    <option selected disabled>Select Category Status...</option>
                                     <option value="Active">Active</option>
                                     <option value="InActive">InActive</option>
                                 </select>
                             </div>
                         </div>
                     </div>
                  
                     <div class="form-group">
                         <button type="button" onclick="document.getElementById('edit-category-form').submit();"
                             class="btn btn-xs text-light" style="background-color: #1e2229">Update Item
                             Category</button>
                     </div>
                   
                 </form>
             </div>
         </div>
     </div>
 </div>


    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        $(document).on('click', '.edit_category_button', function(){
            var id = $(this).attr('id');
       
        $.ajax({
                url: "get-item-category/"+id,
                type: 'GET',
                data: {'id': id},
                success:function(data){
                   $("#edit_category_id").val(data.id);
                   $("#edit_category_code").val(data.category_code);
                   $("#edit_category_description").val(data.category_description);
                   $("#edit_category_status").val(data.category_status);
                }
            })
        })

        $(document).on('click', '.delete_category_button', function(){

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $('#delete-item-category').submit();
                }
            })


        //     var id = $(this).attr('id');
       
        // $.ajax({
        //         url: "delete-item-category/"+id,
        //         type: 'DELETE',
        //         data: {'id': id, "_token": "{{ csrf_token() }}",},
        //         success:function(data){
                  
        //         }
        //     })
        })


    </script>
</main>

@endsection
