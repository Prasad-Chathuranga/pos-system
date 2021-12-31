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
                                    <th></th>
                                    <th></th>
                                   
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
                                    <th></th>
                                    <th></th>
                                 
                            </tr>
                            </tfoot>

                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Item Modal -->
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
                    <form method="POST" id="item-form" action="save-item">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Search for a Category....</label>
                                    <input class="form-control form-control-sm" id="category_code" name="category_code"
                                        type="text" placeholder="By Category Name or Code...">

                                    <input class="form-control form-control-sm" id="description" name="description"
                                        type="hidden" placeholder="By Category Name or Code...">

                                    <input class="form-control form-control-sm" id="code" name="code" type="hidden"
                                        placeholder="By Category Name or Code...">


                                </div>
                                <div id="country_list"></div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Item No <span class="text-danger">*</span></label>
                                    <input name="item_no" class="form-control form-control-sm" type="text"
                                        placeholder="Item No">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Item Code</label>
                                    <input name="item_code" readonly id="item_code" class="form-control form-control-sm"
                                        type="text" placeholder="Item Code">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description <span class="text-danger">*</span></label>
                                    <textarea name="item_description" class="form-control form-control-sm" type="text"
                                        placeholder="Item Description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>SOH <span class="text-danger">*</span></label>
                                    <input name="soh" class="form-control form-control-sm" type="number"
                                        placeholder="SOH">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Bin <span class="text-danger">*</span></label>
                                    <input name="bin" class="form-control form-control-sm" type="text"
                                        placeholder="Bin">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Sale Price <span class="text-danger">*</span></label>
                                    <input name="sale_price" class="form-control form-control-sm" type="number"
                                        placeholder="Sale Price">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Cost Price <span class="text-danger">*</span></label>
                                    <input name="cost_price" value="0.00" class="form-control form-control-sm"
                                        type="number" placeholder="Cost Price">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Reorder Level <span class="text-danger">*</span></label>
                                    <input name="reorder_level" class="form-control form-control-sm" type="number"
                                        placeholder="Reorder Level">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <select name="status" class="form-control form-control-sm">
                                        <option selected disabled>Select a Status....</option>
                                        <option value="Active">Active</option>
                                        <option value="InActive">InActive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Country <span class="text-danger">*</span></label>
                                    <select name="country" class="form-control form-control-sm">
                                        <option selected disabled>Select a Country....</option>
                                        @foreach ($countries as $country)
                                            <option value={{ $country->country_code }}>{{ $country->country_name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" onclick="document.getElementById('item-form').submit();"
                                class="btn btn-xs text-light" style="background-color: #1e2229">Save New Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Item Modal -->
    <div class="modal fade bd-example-modal-lg" id="edit_item" data-keyboard="false" data-backdrop="static"
        tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            $('#edit_item').modal('show');
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
                    <form method="POST" id="update-item-form" action="update-item">
                        @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Search for a Category....</label>
                                    <input class="form-control form-control-sm edit_category_code"
                                        id="edit_category_code" name="category" type="text"
                                        placeholder="By Category Name or Code...">
                                    <input class="form-control form-control-sm" id="edit_item_id" name="edit_item_id"
                                        type="hidden" placeholder="By Category Name or Code...">
                                    <input class="form-control form-control-sm" id="eh_description" name="description"
                                        type="hidden" placeholder="By Category Name or Code...">

                                    <input class="form-control form-control-sm" id="eh_code" name="code" type="hidden"
                                        placeholder="By Category Name or Code...">


                                </div>
                                <div id="country_list_edit"></div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Item No <span class="text-danger">*</span></label>
                                    <input name="item_no" id="edit_item_no" class="form-control form-control-sm"
                                        type="text" placeholder="Item No">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Item Code</label>
                                    <input name="item_code" readonly id="eh_item_code"
                                        class="form-control form-control-sm edit_item_code" type="text"
                                        placeholder="Item Code">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Description <span class="text-danger">*</span></label>
                                    <textarea name="item_description" id="edit_item_description"
                                        class="form-control form-control-sm" type="text"
                                        placeholder="Item Description"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>SOH <span class="text-danger">*</span></label>
                                    <input name="soh" id="edit_soh" class="form-control form-control-sm" type="number"
                                        placeholder="SOH">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Bin <span class="text-danger">*</span></label>
                                    <input name="bin" id="edit_bin" class="form-control form-control-sm" type="text"
                                        placeholder="Bin">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Sale Price <span class="text-danger">*</span></label>
                                    <input name="sale_price" id="edit_sale_price" class="form-control form-control-sm"
                                        type="number" placeholder="Sale Price">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Cost Price <span class="text-danger">*</span></label>
                                    <input name="cost_price" id="edit_cost_price" value="0.00"
                                        class="form-control form-control-sm" type="number" placeholder="Cost Price">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Reorder Level <span class="text-danger">*</span></label>
                                    <input name="reorder_level" id="edit_reorder_level"
                                        class="form-control form-control-sm" type="number" placeholder="Reorder Level">
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Status <span class="text-danger">*</span></label>
                                    <select name="status" id="edit_status" class="form-control form-control-sm">
                                        <option selected disabled>Select a Status....</option>
                                        <option value="Active">Active</option>
                                        <option value="InActive">InActive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Country <span class="text-danger">*</span></label>
                                    <select name="country" id="edit_country" class="form-control form-control-sm">
                                        <option selected disabled>Select a Country....</option>
                                        <option value="Active">Active</option>
                                        <option value="InActive">InActive</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" onclick="document.getElementById('update-item-form').submit();"
                                class="btn btn-xs text-light" style="background-color: #1e2229">Update Item</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    <script>
        $("#category_code").keyup(function() {

            var result = $(this).val();

            if (result != "") {
                $.ajax({
                    url: "{{ route('user.search') }}",
                    type: 'GET',
                    data: {
                        'result': result
                    },
                    success: function(data) {
                        if (data != "") {
                            $("#country_list").html(data);
                            $("#country_list").show();
                        }


                    }
                })
            } else {
                $("#country_list").hide();
            }

        });


        $("#edit_category_code").keyup(function() {

            var result = $(this).val();

            if (result != "") {
                $.ajax({
                    url: "{{ route('user.search-edit') }}",
                    type: 'GET',
                    data: {
                        'result': result
                    },
                    success: function(data) {
                        if (data != "") {
                            $("#country_list_edit").html(data);
                            $("#country_list_edit").show();
                        }


                    }
                })
            } else {
                $("#country_list_edit").hide();
            }

        });

        $(document).on('click', '#searchTable td', function

            () {

                var value = $(this).text();
                $("#country_list").hide();

                $("#category_code").val(value);

                $.ajax({
                    url: "{{ route('user.category-details') }}",
                    type: 'GET',
                    data: {
                        'data': value
                    },
                    success: function(data) {

                        $("#description").val(data.category_data.category_description);
                        $("#code").val(data.category_data.category_code);
                        $("#item_code").val(data.next_item_id);

                    }
                })
            });


        $(document).on('click', '.delete_item_button', function

            () {

                swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover this!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                }).then((willDelete) => {
                    if (willDelete) {
                        var id = $(this).attr('id');

                        $.ajax({
                            url: "delete-item/" + id,
                            type: 'DELETE',
                            data: {
                                'data': id,
                                "_token": "{{ csrf_token() }}"
                            },
                            success: function(data) {
 
                                if(data.url){
                                     window.location = data.url;
                                }else if(data.message){
                                    swal({
                    title: "You cant perform this",
                    text: "Once deleted, you will not be able to recover this!",
                    icon: "warning"
                })
                                }

                            }
                        })
                    }
                })


            });

        $(document).on('click', '#searchTableEdit td', function

            () {

                var value = $(this).text();
                console.log(value);
                $("#country_list_edit").hide();

                $(".edit_category_code").val(value);

                $.ajax({
                    url: "{{ route('user.category-details') }}",
                    type: 'GET',
                    data: {
                        'data': value
                    },
                    success: function(data) {

                        $("#eh_description").val(data.category_data.category_description);
                        $("#eh_code").val(data.category_data.category_code);
                        $("#eh_item_code").val(data.next_item_id);

                    }
                })
            });


        $(document).on('click', '.edit_item_button', function() {
            var id = $(this).attr('id');


            $.ajax({
                url: "get-item/" + id,
                type: 'GET',
                data: {
                    'id': id
                },
                success: function(data) {
                    $(".edit_category_code").val(data.category);
                    $("#edit_item_no").val(data.item_no);
                    $(".edit_item_code").val(data.item_code);
                    $("#edit_item_description").val(data.description);
                    $("#edit_item_id").val(data.id);
                    $("#edit_soh").val(data.soh);
                    $("#edit_bin").val(data.bin);
                    $("#edit_sale_price").val(data.sale_price);
                    $("#edit_cost_price").val(data.cost_price);

                    $("#edit_reorder_level").val(data.reorder_level);
                    $("#edit_status").val(data.status);
                    $("#edit_country").val(data.country);

                    $("#eh_description").val(data.category);
                    $("#eh_code").val(data.category_code);
                    $("#eh_item_code").val(data.item_code);

                }
            })
        })
    </script>

    <script>

        
        $(document).ready(function() {
            $("#country_list").hide();
            $('#example').DataTable({
                'processing': true,
                'serverSide': true,
                'serverMethod': 'post',
                'responsive': true,
              

                'ajax': {
                    'url': 'ajax_items.php'
                },
                'columns': [{
                        data: 'id'
                    },
                    {
                        data: 'item_no'
                    },
                    {
                        data: 'item_code'
                    },
                    {
                        data: 'description'
                    },
                    {
                        data: 'soh'
                    },
                    {
                        data: 'country'
                    },
                    {
                        data: 'sale_price'
                    },
                    {
                        data: 'reorder_level'
                    },
                    {
                        data: 'edit'
                    },
                    {
                        data: 'delete'
                    }

                ]
            });
        });
    </script>

</main>

@endsection
