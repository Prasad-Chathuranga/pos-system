@extends('layouts.dashboard')

@section('content')

@section('title', 'Add New Customer')
<main class="page-content">

    <div class="container">
        <div style="width: 1000px;">
            <div class="card-header mt-5 text-center">
                <strong>
                    <h5>Supplier Management</h5>
                </strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-xs text-light mb-3" style="background-color: #1e2229" data-toggle="modal"
                            data-target=".bd-example-modal-lg" data-backdrop="static">Add New Supplier</button>
                        <table id="example" class="display table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Customer Code</th>
                                    <th>Customer Name</th>
                                    <th>Type</th>
                                    <th>Telephone No</th>
                                    <th>Mobile No</th>
                                    <th>Credit Balance</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($suppliers as $key => $supplier)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td><b>{{ $supplier->code }}</b></td>
                                        <td>{{ $supplier->name }}</td>
                                        <td>{{ $supplier->country }}</td>
                                        <td>{{ $supplier->status }}</td>
                                        <td>{{ $supplier->city }}</td>
                                        <td>{{ $supplier->credit_balance }}</td>
                                        <td><a id=" {{ $supplier->id }} " style="cursor: pointer"
                                                class='mr-3 edit_country_button'><span data-toggle='modal'
                                                    data-target='#edit_country'
                                                    class='fas fa-edit text-info'></span></a>
                                            @can('delete', $supplier)
                                        
                                                    <a id=" {{ $supplier->id }} " style="cursor: pointer"
                                                class="delete_a"><span class='fas fa-trash text-danger'></span></a>
                                            @endcan    
                                        </td>
                                        <form id="delete-supplier" action="{{ route('supplier.delete', $supplier->id) }}"
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

    <!-- Add Customer Modal -->
    <div class="modal fade bd-example-modal-lg" id="customer" data-keyboard="false" data-backdrop="static" tabindex="-1"
        role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Supplier</h5>
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


                    <form method="POST" id="supplier-form" action="save-supplier">
                        @csrf
                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Supplier Name <span class="text-danger">*</span></label>
                                    <input name="name" id="supplier_name" style="text-transform: capitalize"
                                        class="form-control form-control-sm" type="text" placeholder="Supplier Name">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Code For Name</label>
                                    <input class="form-control form-control-sm" name="code" id="supplier_code"
                                        readonly type="text" placeholder="Code For Name">
                                </div>

                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country <span class="text-danger">*</span></label>
                                    <select name="country" class="form-control form-control-sm">
                                        <option selected disabled>Select Supplier Country...</option>
                                       @foreach ($countries as $country)
                                       <option value={{$country->country_name}}>{{ $country->country_name }}</option>
                                       @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>City <span class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" name="city" type="text"
                                        placeholder="City">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Address<span class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" name="address" type="text"
                                        placeholder="Address Line 1">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Contact No 1 <span class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" name="contact_no_1" type="text"
                                        placeholder="Address Line 2">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Contact No 2<span class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" name="contact_no_2" type="text"
                                        placeholder="Address Line 3">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Status<span class="text-danger">*</span></label>
                                    <select name="status" class="form-control form-control-sm">
                                        <option selected disabled>Select Supplier Status...</option>
                                        <option value="Active">Active</option>
                                        <option value="InActive">InActive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Credit Balance<span class="text-danger">*</span></label>
                                    <input class="form-control form-control-sm" name="credit_balance" type="number"
                                        value="0" placeholder="Credit Balance">
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>About<span class="text-danger">*</span></label>
                                    <textarea class="form-control form-control-sm" name="about" type="text"
                                        placeholder="About Supplier...."></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <button type="button" onclick="document.getElementById('supplier-form').submit();"
                                class="btn btn-sm text-light" style="background-color: #1e2229">Save New
                                Supplier</button>
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


        //         var fileName =  "All Customers - "+moment(new Date()).format('YYYY-MM-DD HH-mm-ss A');
        //         $(document).ready(function() {
        //     $('#example').DataTable( {
        //         dom: 'Bfrtip',
        //         buttons: [{
        //             extend: 'csv',
        //             text: 'Export As Excel',
        //             title: fileName
        //         },
        //         {
        //             extend: 'pdf',
        //             text: 'Export As PDF',
        //             title: fileName
        //         }
        //         ]
        //     } );

        // } );

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
                            $('#delete-supplier').submit();
                        }
                    })

                });


        $("#supplier_name").keyup(function() {

            var result = $(this).val().charAt(0).toUpperCase();

            if (result != "") {
                $.ajax({
                    url: "{{ route('user.supplier-search') }}",
                    type: 'GET',
                    data: {
                        'result': result
                    },
                    success: function(data) {
                        var padedNumber = (Number(data) + 1) + "";
                        $("#supplier_code").val(result + padedNumber.padStart(3, '0'));
                    }
                })
            }
        });

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
