@extends('layouts.dashboard')

@section('content')
@section('title', 'Invoice')
<main class="page-content">

    <div class="container">
        <div style="width: 1000px;">
            <div class="card-header mt-5 text-center">
                <strong>
                    <h5>Invoice</h5>
                </strong>
            </div>
            <div class="card-body">
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
                            <label>Search for an Item....</label>
                            <input class="form-control form-control-sm" id="item_search"
                                name="category" type="text" placeholder="By Category Name or Code...">
                        </div>
                        <div id="country_list"></div>

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
                                class="form-control form-control-sm edit_item_code" type="text" placeholder="Item Code">
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



    <script>
        $("#item_search").keyup(function() {

            var result = $(this).val();

            console.log(result);;
            if (result != "") {
                $.ajax({
                    url: "{{ route('user.search') }}",
                    type: 'GET',
                    data: {
                        'result': result
                    },
                    success: function(data) {
                        console.log(data);
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
</script>


</main>

@endsection
