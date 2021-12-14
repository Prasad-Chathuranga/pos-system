@extends('layouts.dashboard')

@section('content')
@section('title', 'Add Item')
<main class="page-content">

    <div class="container">
        <div style="width: 1000px;">
            <div class="card-header mt-5 text-center">
                <strong>
                    <h5>Item Management</h5>
                </strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-xs text-light mb-3" style="background-color: #1e2229" data-toggle="modal"
                            data-target=".bd-example-modal-lg" data-backdrop="static">Add New Item</button>
                            <table id="example" class="table display table-striped mt-5" style="width:100%">
                            <thead>
                                <tr>
                                <th>#</th>
                                    <th>Item Code</th>
                                    <th>Item No</th>
                                    <th>Description</th>
                                    <th>SOH</th>
                                    <th>Country</th>
                                    <th>Sale Price</th>
                                    <th>Reorder Level</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                          
                            <tr>
                                <tfoot>
                            <th>#</th>
                                    <th>Item Code</th>
                                    <th>Item No</th>
                                    <th>Description</th>
                                    <th>SOH</th>
                                    <th>Country</th>
                                    <th>Sale Price</th>
                                    <th>Reorder Level</th>
                                    <th>Action</th>
                                </tr>
        </tfoot>

                        </table>
          
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="category" data-keyboard="false" data-backdrop="static" tabindex="-1"
        role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Add Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (count($errors) > 0)
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
                    @endif
                    <form method="POST" id="category-form" action="save-item-category">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Search for a Category....</label>
                                    <input class="form-control form-control-sm" id="category_code" name="category_code" type="text"
                                        placeholder="By Category Name or Code...">

                                </div>
                                <div id="country_list" style="overflow-y: scroll; height: 100px"></div>             

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category Name <span class="text-danger">*</span></label>
                                    <input name="category_name" class="form-control form-control-sm" type="text"
                                        placeholder="Category Name">
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
                        <div class="form-group">
                            <button type="button" onclick="document.getElementById('category-form').submit();"
                                class="btn btn-xs text-light" style="background-color: #1e2229">Save Item
                                Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade bd-example-modal-lg" id="edit_item" data-keyboard="false" data-backdrop="static" tabindex="-1"
        role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Item</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (count($errors) > 0)
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
                    @endif
                    <form method="POST" id="category-form" action="save-item-category">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Search for a Category</label>
                                    <input class="form-control form-control-sm" id="category_code" name="category_code" readonly type="text"
                                        placeholder="Category ID">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Category Name <span class="text-danger">*</span></label>
                                    <input name="category_name" class="form-control form-control-sm" type="text"
                                        placeholder="Category Name">
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
                        <div class="form-group">
                            <button type="button" onclick="document.getElementById('category-form').submit();"
                                class="btn btn-xs text-light" style="background-color: #1e2229">Save Item
                                Category</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
          $.ajaxSetup({
             headers:{
                 'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
             }
         });

    </script>

    <script>
         $("#category_code").keyup(function(){
             
    
            var result = $(this).val();
            
            if(result != ""){
            $.ajax({
                url: "{{ route('user.search')}}",
                type: 'GET',
                data: {'result': result},
                success:function(data){
                    $("#country_list").html(data);
                    $("#country_list").show();
                }
            })
            }
            else{
                $("#country_list").hide();
            }

  });
    </script>

<script>
 $(document).ready(function(){
     $("#country_list").hide();
   $('#example').DataTable({
    'processing': true,
      'serverSide': true,
      'serverMethod': 'post',
      responsive: true,
    //   columnDefs: [
    //         { responsivePriority: 1, targets: 0 },
    //         { responsivePriority: 10001, targets: 4 },
    //         { responsivePriority: 2, targets: -2 }
    //     ],
     
      'ajax': {
          'url':'ajax_items.php'
      },
      'columns': [
        { data: 'id' },
         { data: 'item_no' },
         { data: 'item_code' },
         { data: 'description' },
         { data: 'soh' },
         { data: 'country' },
         { data: 'sale_price' }, 
         { data: 'reorder_level' },
         { data: 'action'}
      
      ]
   });
});
</script>

</main>

@endsection
