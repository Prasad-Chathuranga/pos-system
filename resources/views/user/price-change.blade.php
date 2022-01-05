@extends('layouts.dashboard')

@section('content')
@section('title', 'Price Change Management')
<main class="page-content">

    <div class="container">
        <div style="width: 1000px;">
            <div class="card-header mt-5 text-center">
                <strong>
                    <h5>Price Change Management</h5>
                </strong>
            </div>
            <div class="card-body">
             
                <div class="row">
                    <div class="col-md-12">
                       
                        {{-- <button class="btn btn-xs text-light mb-3" style="background-color: #1e2229" data-toggle="modal"
                            data-target=".bd-example-modal-lg" data-backdrop="static">Add New Re-Order</button> --}}
                        
                        <table id="example" class="display table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Item Code</th>
                                    <th>Item No</th>
                                    <th>Description</th>
                                    <th>SOH</th>
                                    {{-- <th>Country</th>
                                    <th>Sale Price</th> --}}
                                    <th>Reorder Level</th>
                                   
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($items as $key => $item)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td id="item_code">{{ $item->item_code }}</td>
                                        <td id="item_code">{{ $item->item_no }}</td>
                                        <td id="description">{{ $item->description }}</td>
                                        <td id="soh">{{ $item->soh }}</td>
                                        <td id="reorder_level">{{ $item->reorder_level }}</td>
                                     {{-- <td><input type="number" placeholder="New SOH" id="new_soh" class="form-control form-control-sm" /></td> --}}
                                        {{-- <td><a id=" {{ $item->id }} " style="cursor: pointer" class='mr-3 reorder'><span 
                                             class='fa fa-archive text-info'></span></a> --}}
                                      
                                         
                                    </tr>
                                @endforeach
                                {{-- {{ $items->links() }} --}}
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
                                    {{-- <input class="form-control form-control-sm" name="category_id"
                                        value="{{ $next_id }}" readonly type="text" placeholder="Category ID"> --}}
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

    
            // $('#example').DataTable();
        });

        $(document).on('click', '.reorder', function(){

var id = $(this).attr('id');
var new_soh = ($(this).closest('tr').find('input#new_soh').val());

 var item_code = ($(this).closest('tr').find('td#item_code').text());
 var description = ($(this).closest('tr').find('td#description').text());
 var soh = ($(this).closest('tr').find('td#soh').text());
 var reorder_level = ($(this).closest('tr').find('td#reorder_level').text());
 

$.ajax({
    url: "update-soh",
    type: 'POST',
    data: {
        'item_id': id,
        'item_code':item_code,
        'description':description,
        'soh':soh,
        'reorder_level': reorder_level,
        'new_soh' : new_soh, 
        '_token': '{{csrf_token()}}'
        },
    success:function(data){
        console.log(data);
        if(data.url){
                                     
                       
                window.location = data.url;
                swal({
                    title: "New SOH Updated with "+item_code,
                    text: "Successfully Updated !",
                    icon: "success"
                })
                                }
                                // else{
        //                             swal({
        //             title: "You cant perform this",
        //             text: "Once deleted, you will not be able to recover this!",
        //             icon: "warning"
        //         })
        //                         }
    }
})
})


$(document).ready(function() {
            $('#example').DataTable();
        });
</script>
    {{-- <script>
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

        $(document).on('click', '.reorder', function(){

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


    </script> --}}
</main>

@endsection
