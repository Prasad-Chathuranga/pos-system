@extends('layouts.dashboard')

@section('content')
@section('title', 'Add New Country')
<main class="page-content">

    <div class="container">
        <div style="width: 1000px;">
            <div class="card-header mt-5 text-center">
                <strong>
                    <h5>Country Management</h5>
                </strong>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
                        <button class="btn btn-xs text-light mb-3" style="background-color: #1e2229" data-toggle="modal"
                            data-target=".bd-example-modal-lg" data-backdrop="static">Add New Country</button>
                        <table id="example" class="display table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Country Code</th>
                                    <th>Country Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($countries as $key => $country)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $country->country_code }}</td>
                                        <td>{{ $country->country_name }}</td>
                                        <td><a id=" {{ $country->id }} " style="cursor: pointer"
                                                class='mr-3 edit_country_button'><span data-toggle='modal'
                                                    data-target='#edit_country'
                                                    class='fas fa-edit text-info'></span></a>
                                            <a id=" {{ $country->id }} " style="cursor: pointer"
                                                class="delete_a"><span class='fas fa-trash text-danger'></span></a>
                                        </td>
                                        <form id="delete-country" action="{{ route('country.delete', $country->id) }}"
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

    <!-- Add Country Modal -->
    <div class="modal fade bd-example-modal-lg" id="country" data-keyboard="false" data-backdrop="static" tabindex="-1"
        role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header text-center">
                    <h5 class="modal-title" id="exampleModalLabel">Add Country</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if (count($errors) > 0)
                        <script>
                            $('#country').modal('show');
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
                    <form method="POST" id="country-form" action="save-country">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country ID</label>
                                    <input class="form-control form-control-sm" name="category_code"
                                        value="{{ $next_id }}" readonly type="text" placeholder="Category ID">
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Country Code <span class="text-danger">*</span></label>
                                    <input name="country_code" class="form-control form-control-sm" type="text"
                                        placeholder="Country Code">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Country Name <span class="text-danger">*</span></label>
                                    <input name="country_name" class="form-control form-control-sm" type="text"
                                        placeholder="Country Name" />
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <button type="button" onclick="document.getElementById('country-form').submit();"
                                class="btn btn-xs text-light" style="background-color: #1e2229">Save New
                                Country</button>
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
                            $('#edit_country').modal('show');
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

        $(document).on('click', '.edit_country_button', function() {
            var id = $(this).attr('id');

            $.ajax({
                url: "get-country/" + id,
                type: 'GET',
                data: {
                    'id': id
                },
                success: function(data) {
                    $("#edit_country_id").val(data.id);
                    $("#edit_country_code").val(data.country_code);
                    $("#edit_country_name").val(data.country_name);
                }
            })
        })

        $(document).on('click', '.delete_a', function() {

            swal({
                title: "Are you sure?",
                text: "Once deleted, you will not be able to recover this!",
                icon: "warning",
                buttons: true,
                dangerMode: true,
            }).then((willDelete) => {
                if (willDelete) {
                    $('#delete-country').submit();
                }
            })

        });


        // $('#delete-country').submit(function(e) {
        //     e.preventDefault();

        //     var form = $(this);

        //     swal({
        //         title: "Are you sure?",
        //         text: "You will not be able to recover this imaginary file!",
        //         type: "warning",
        //         showCancelButton: true,
        //         confirmButtonColor: "#DD6B55",
        //         confirmButtonText: "Yes, delete it!",
        //         closeOnConfirm: false
        //     }, function(isConfirmed) {
        //         if (isConfirmed) {
        //             form.submit();
        //         }
        //     });

        //     return false;
        // });
    </script>
</main>

@endsection
