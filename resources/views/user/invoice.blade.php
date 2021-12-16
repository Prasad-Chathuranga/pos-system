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
                                <input class="form-control form-control-sm" id="item_search" name="category" type="text"
                                    placeholder="By Category Name or Code...">
                            </div>
                            <div id="country_list"></div>
                            <div class="table_added_items" style="display: none">
                                <table id="myTable" class="table">
                                    {{-- <thead lass="font-weight-bold" style="background: lightyellow">

                                        <th>Item No</th>
                                        <th>Item Code</th>
                                        <th>Item Description</th>
                                        <th>Sale Price</th>
                                        <th>Quantity</th>
                                        <th></th>


                                    </thead> --}}
                                    <tbody>


                                    </tbody>
                                </table>
                                <button type="button" id="addToInvoice" class="btn btn-xs ml-auto m-2 text-light"
                                    style="background-color: #1e2229">Add to Invoice</button>
                                <button id="clear" type="button"
                                    class="btn btn-xs ml-auto m-2 text-light btn-danger">Clear</button>
                            </div>
                            <label style="display: none" id="price_label"><b>Total Price : </b> <span
                                    class="danger" id="total_price"></span> </label>
                            <div style="display: none" class="added_items_div">
                                <h5>Added Items</h5>
                                <table id="displayItems" class="table">
                                    <thead lass="font-weight-bold" style="background: lightyellow">

                                        <th>Item No</th>
                                        <th>Item Code</th>
                                        <th>Item Description</th>
                                        <th>Sale Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th></th>


                                    </thead>
                                    <tbody>


                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Item No <span class="text-danger">*</span></label>
                                <input name="item_no" id="edit_item_no" class="form-control form-control-sm" type="text"
                                    placeholder="Item No">
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
                                <input name="reorder_level" id="edit_reorder_level" class="form-control form-control-sm"
                                    type="number" placeholder="Reorder Level">
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
        var totalInvoiceAmount = 0;
        var arrayOfItems = []
        var arrayOfItemNames = []
        $("#item_search").keyup(function() {

            var result = $(this).val();

            if (result != "") {
                $.ajax({
                    url: "{{ route('invoice.search') }}",
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


        $(document).on('click', '#searchTable td', function

            (e) {

                var value = $(this).text();

                var rowCount = $('#myTable tr').length;

                if (value) {

                    var found = false;
                    arrayOfItemNames.forEach(element => {

                        if (element === value) {
                            alert("Item Already Added")
                            found = true;
                            $("#country_list").hide();
                            $("#item_search").val("");
                        }


                    });

                    if (!found) {
                        getItem(value)
                    }

                }

            });

        const getItem = (value) => {


            $("#country_list").hide();
            $("#item_search").val("");

            $.ajax({
                url: "{{ route('user.item-details') }}",
                type: 'GET',
                data: {
                    'data': value
                },
                success: function(data) {

                    $('.table_added_items').show();


                    $('#myTable tbody')
                        .append('<tr><td class="class_item_no">' + data.item_no +
                            '</td><td class="class_item_code">' + data.item_code +
                            '</td><td class="class_item_description">' +
                            data.description +
                            '</td><td class="class_price"><input type="number" id="price" class="form-control form-control-sm" value=' +
                            data.sale_price +
                            ' /></td><td class="class_quantity"><input type="number" id="quantity" class="form-control form-control-sm" placeholder="Enter Quantity" /></td><td><a style="cursor: pointer" id="deleteRow" ><span class="fas fa-trash text-danger"></span></a></td></tr>'
                            );
                    arrayOfItemNames.push(data.item_no);


                }
            })
        }

        $(document).on('click', '#deleteRow', function

            (e) {
                $(this).parent().parent().remove();
            });

        $(document).on('click', '#clear', function

            (e) {
                $('#myTable tbody').empty();
                $("#price_label").hide();
                $("#total_price").text("");
            });


        $(document).on('click', '#addToInvoice', function

            (e) {



                $("#myTable tr").each(function() {

                    var $row = $(this).closest("tr");
                    var item_no = $row.find('.class_item_no').text();
                    var item_code = $row.find('.class_item_code').text();
                    var item_description = $row.find('.class_item_description').text();
                    var item_price = $row.find('td input#price').val();
                    var item_quantity = $row.find('td input#quantity').val();

                    var item = {
                        'item_no': item_no,
                        'item_code': item_code,
                        'item_description': item_description,
                        'item_price': item_price,
                        'item_quantity': item_quantity,
                        'total_price': item_price*item_quantity
                    }

                    arrayOfItems.push(item);



                });


                // arrayOfItems.shift();
              

                $('.added_items_div').show();

                arrayOfItems.forEach(element => {

                    $('#displayItems tbody')
                        .append('<tr><td class="class_item_no">' + element.item_no +
                            '</td><td class="class_item_code">' + element.item_code +
                            '</td><td class="class_item_description">' +
                            element.item_description + '</td><td class="class_price">' +
                            element.item_price + '</td><td class="class_quantity">' + element.item_quantity +
                            '</td><td class="class_quantity">' + element.total_price +
                            '</td><td><a style="cursor: pointer"  ><span class="fas fa-edit text-info"></span></a>&nbsp;&nbsp;<a style="cursor: pointer" id="deleteRow" ><span class="fas fa-trash text-danger"></span></a></td></tr>'
                            );

                });

                //   $('#displayItems tbody')
                //         .append('<tr><td class="class_item_no">'+data.item_no+'</td><td class="class_item_code">'+data.item_code+'</td><td class="class_item_description">'
                //         +data.description+'</td><td class="class_price"><input type="number" id="price" class="form-control form-control-sm" value='
                //         +data.sale_price+' /></td><td class="class_quantity"><input type="number" id="quantity" class="form-control form-control-sm" placeholder="Enter Quantity" /></td><td><a style="cursor: pointer" id="deleteRow" ><span class="fas fa-trash text-danger"></span></a></td></tr>');


            });
    </script>


</main>

@endsection
