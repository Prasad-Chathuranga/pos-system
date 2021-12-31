@extends('layouts.dashboard')

@section('content')

@section('title', 'Add New Country')
<main class="page-content">

    <div class="container">
        <div style="width: 1000px;">
            <div class="card-header mt-5 text-center">
                <strong>
                    <h5>Product Management</h5>
                </strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-xs text-light mb-3" style="background-color: #1e2229" data-toggle="modal"
                            data-target=".bd-example-modal-lg" data-backdrop="static">Add New Product</button>
                        <table id="example" class="display table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product Name</th>
                                    <th>Product Price</th>
                                    <th>Year</th>
                                    <th>Product Image</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($products as $key => $product)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><b>{{ $product->product_name }}</b></td>
                                        <td>{{ $product->product_price }}</td>
                                        <td>{{ $product->product_year }}</td>
                                        <td><img height="150" width="300" src="/uploads/{{$product->product_image }}" /></td>
                                       
                                        <td><a id=" {{ $product->id }} " style="cursor: pointer"
                                                class='mr-3 edit_country_button'><span data-toggle='modal'
                                                    data-target='#edit_country'
                                                    class='fas fa-edit text-info'></span></a>
                                            <a id=" {{ $product->id }} " style="cursor: pointer"
                                                class="delete_a"><span class='fas fa-trash text-danger'></span></a>
                                        </td>
                                        <form id="delete-product" action="{{ route('product.delete', $product->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                        </form>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
   
    <!-- Add Product Modal -->
    <div class="modal fade bd-example-modal-lg" id="customer" data-keyboard="false" data-backdrop="static" tabindex="-1"
        role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (count($errors) > 0)
                        <script>
                            $('#customer').modal('show');
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

                 
                    <form method="POST" id="product-form" action="save-product" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Name <span class="text-danger">*</span></label>
                                    <input name="product_name" id="product_name" style="text-transform: capitalize" class="form-control form-control-sm" type="text"
                                        placeholder="Product Name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Product Price</label>
                                    <input class="form-control form-control-sm" name="product_price"
                                        id="product_price"  type="number" placeholder="Product Price">
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Year <span class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" name="product_year"
                                        id="product_year"  type="number" placeholder="Product Year">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Image <span class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" type="file" accept="image/png, image/gif, image/jpeg" name="product_image">
                                </div>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <button type="button" onclick="document.getElementById('product-form').submit();"
                                class="btn btn-sm text-light" 
                                style="background-color: #1e2229">Save New
                                Product</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Country Modal -->
    <div class="modal fade bd-example-modal-lg" id="edit_country" data-keyboard="false" data-backdrop="static"
        tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (count($errors) > 0)
                        <script>
                            // $('#edit_country').modal('show');
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
                    <form method="POST" id="edit-country-form" action="update-country">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country ID</label>
                                    <input class="form-control form-control-sm" id="edit_country_id"
                                        name="edit_country_id" readonly type="text" placeholder="Country ID">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country Code <span class="text-danger">*</span></label>
                                    <input name="edit_country_code" id="edit_country_code"
                                        class="form-control form-control-sm" type="text" placeholder="Country Code">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Country Name <span class="text-danger">*</span></label>
                                    <input type="text" name="edit_country_name" class="form-control form-control-sm"
                                        type="text" id="edit_country_name" placeholder="Country Name" />
                                </div>


                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" onclick="document.getElementById('edit-country-form').submit();"
                                class="btn btn-xs text-light" style="background-color: #1e2229">Update Country</button>
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

        // $(document).on('click', '.edit_country_button', function() {
        //     var id = $(this).attr('id');

        //     $.ajax({
        //         url: "get-country/" + id,
        //         type: 'GET',
        //         data: {
        //             'id': id
        //         },
        //         success: function(data) {
        //             $("#edit_country_id").val(data.id);
        //             $("#edit_country_code").val(data.country_code);
        //             $("#edit_country_name").val(data.country_name);
        //         }
        //     })
        // })

        $(document).on('click', '.delete_a', function() {

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
                closeOnClickOutside: false
            }).then((willDelete) => {
                if (willDelete) {
                    $('#delete-product').submit();
                }
            })

        });

      
//         $("#customer_name").keyup(function() {

            

// var result = $(this).val().charAt(0).toUpperCase();

// if(result != ""){
// $.ajax({
//         url: "{{ route('user.customer-search') }}",
//         type: 'GET',
//         data: {
//             'result': result
//         },
//         success: function(data) {
//             var padedNumber =  (Number(data)+1) + "";
//             $("#name_for_code").val( result+ padedNumber.padStart(3, '0'));


//         }
//     })
// }

// if (result != "") {
//     $.ajax({
//         url: "{{ route('invoice.search') }}",
//         type: 'GET',
//         data: {
//             'result': result
//         },
//         success: function(data) {

//             if (data != "") {
//                 $("#country_list").html(data);
//                 $("#country_list").show();
//             }


//         }
//     })
// } else {
//     $("#country_list").hide();
// }

// });
       
    </script>
</main>

    
@endsection