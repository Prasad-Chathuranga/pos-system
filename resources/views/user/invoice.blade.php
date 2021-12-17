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

                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Search for an Item....</label>
                            <input class="form-control form-control-sm" id="item_search" name="category" type="text"
                                placeholder="By Category Name or Code...">
                        </div>
                        <div class="mb-3" id="country_list"></div>
                        <div class="table_added_items">
                            <table id="myTable" class="table table-borderless">
                               
                                <tbody>

                                </tbody>
                            </table>
                            <button type="button" id="addToInvoice" class="btn btn-xs ml-auto m-2 text-light"
                                style="background-color: #1e2229">Add to Invoice</button>
                            <button id="clear" type="button"
                                class="btn btn-xs ml-auto m-2 text-light btn-danger">Clear</button>
                        </div>
                      
                        <div style="display: none" class="added_items_div">
                            <h5>Added Items</h5>
                            <table id="displayItems" class="table table-borderless">
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
                            <label><b>Total Price : <span class="total_price_label text-danger"></span></b></label><br>
                            <label id="discount_label_hide" style="display: none"><b>Discount : <span class="discount_label text-danger"></span></b></label><br>
                            <label id="final_amount_label_hide" style="display: none"><b>Final Amount : <span class="final_amount text-danger"></span></b></label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Discount Type<span class="text-danger">*</span></label>
                                        <select name="discount_type" id="discount_type" class="form-control form-control-sm">
                                            <option selected disabled>Select a Type....</option>
                                            <option value="Amount">Amount</option>
                                            <option value="Precentage">Precentage</option>
                                        </select>
                                    </div>
                                </div>
                                <div style="display: none" class="col-md-6 discount_div">
                                    <div class="form-group">
                                        <label>Amount<span class="text-danger">*</span></label>
                                        <input name="discount_amount" id="discount_amount"
                                            class="form-control form-control-sm" style="display: none" type="number" placeholder="Discount Amount">
                                            <input name="precentage_amount" id="precentage_amount"
                                            class="form-control form-control-sm" style="display: none" type="number" placeholder="Precentage Amount">
                                    </div>
                                    <button type="button" id="discount_button" class="btn btn-xs mr-auto text-light" style="background-color: #1e2229">Calculate Discount</button>
                                </div>
                            </div>
                        </div>
                    </div>
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
                    <h5 class="modal-title" id="exampleModalLabel">Edit Items</h5>
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
                    <table class="table" id="edit_items_table_modal">
                        <tbody>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>



    <script>
        var totalInvoiceAmount = 0;
        var arrayOfItems = []
        var arrayOfItemNames = []
        var discountType = "";
        $('.table_added_items').hide();

        $("#discount_button").on('click', function(){
           $("#discount_label_hide").show();
           $("#final_amount_label_hide").show();

           if(discountType === "Amount"){
            var dis_amount = $("#discount_amount").val();
            var discounted_total =  totalInvoiceAmount - dis_amount;
            $(".discount_label").text(dis_amount);
            $(".final_amount").text(discounted_total);
            console.log(discounted_total);
           }else{
            var dis_amount = $("#precentage_amount").val();
            var discounted_total =  totalInvoiceAmount - (totalInvoiceAmount * (dis_amount / 100));
            $(".discount_label").text(totalInvoiceAmount * (dis_amount / 100));
            $(".final_amount").text(discounted_total);
            console.log(discounted_total);
           }
        });

        $('#discount_type').on('change',function(){

$(".discount_div").show();


discountType = ($(this).val());

    if(discountType === "Amount")
    {
        $("#discount_amount").show();
        $("#precentage_amount").hide();
    }
    else
    {
        $("#precentage_amount").show();
        $("#discount_amount").hide();
    }

        })

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

                // var value = $(this).text();
                var value = ($(this).attr('class'));
                var item_no = ($(this).attr('id'));

                // console.log(class_value);

                var rowCount = $('#myTable tr').length;

                // console.log(arrayOfItemNames);

                if (value) {

                    var found = false;
                    arrayOfItemNames.forEach(element => {
                        	
                        if (element == value) {
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
                            ' /></td><td class="class_quantity"><input type="number" id="quantity" class="form-control form-control-sm" placeholder="Enter Quantity" /></td><td><a style="cursor: pointer" class="deleteRow" ><span class="fas fa-trash text-danger"></span></a></td></tr>'
                        );
                    arrayOfItemNames.push(data.id);


                }
            })
        }

        $(document).on('click', '.deleteRow', function

            (e) {
                var price = ($(this).closest('tr').find('td.class_total_price').text());
                var item_no = ($(this).closest('tr').find('td.class_item_no').text());
                totalInvoiceAmount = totalInvoiceAmount - price;
                $(".total_price_label").text(totalInvoiceAmount);
                var id = $(this).attr('id');
                arrayOfItems.splice(id, 1);

                var index = $.inArray(item_no, arrayOfItemNames);
                if (index != -1) {
                    arrayOfItemNames.splice(index, 1);
                }

                $(this).parent().parent().remove();

            });

        $(document).on('click', '#clear', function

            (e) {
                $('#myTable tbody').empty();
                $("#price_label").hide();
                $("#total_price").text("");
            });

        $(document).on('click', '.update_item_modal_icon', function

            (e) {

                var id = ($(this).attr('id'));
                var price = ($(this).closest('tr').find('input#update_single_item_price').val());
                var quantity = ($(this).closest('tr').find('input#update_single_item_quantity').val());

                arrayOfItems[id].item_price = price;
                arrayOfItems[id].item_quantity = quantity;
                arrayOfItems[id].total_price = price * quantity;

                $('#edit_items_table_modal tbody').empty();


                totalInvoiceAmount = 0

                arrayOfItems.forEach((element, index) => {


                    $('#edit_items_table_modal tbody')
                        .append('<tr><td class="class_item_no">' + element.item_no +
                            '</td><td class="class_item_code">' + element.item_code +
                            '</td><td class="class_item_description">' +
                            element.item_description +
                            '</td><td class="class_price"><input type="number" id="update_single_item_price" class="form-control form-control-sm" value=' +
                            element.item_price +
                            ' /></td><td class="class_quantity"><input type="number" id="update_single_item_quantity" class="form-control form-control-sm" value=' +
                            element.item_quantity +
                            ' /></td><td id="class_total_price" class="class_total_price">' + element
                            .total_price +
                            '</td><td><a id=' + index +
                            ' class="update_item_modal_icon" style="cursor: pointer"><span class="fas fa-wrench text-danger"></span></a></td></tr>'
                        );
                    totalInvoiceAmount += element.total_price
                });

                $(".total_price_label").text(totalInvoiceAmount);

                $('#displayItems tbody').empty();

                arrayOfItems.forEach((element, index) => {

                    $('#displayItems tbody')
                        .append('<tr><td class="class_item_no">' + element.item_no +
                            '</td><td class="class_item_code">' + element.item_code +
                            '</td><td class="class_item_description">' +
                            element.item_description + '</td><td class="class_price">' +
                            element.item_price + '</td><td class="class_quantity">' + element.item_quantity +
                            '</td><td class="class_total_price text-danger"><b>' + element.total_price +
                            '</b></td><td><a style="cursor: pointer" id="edit_item_modal_button" data-toggle="modal" data-target="#edit_item" ><span class="fas fa-edit text-info"></span></a>&nbsp;&nbsp;<a style="cursor: pointer" id=' +
                            index +
                            ' class="deleteRow" ><span class="fas fa-trash text-danger"></span></a></td></tr>'
                        );

                });

            });



        $(document).on('click', '#edit_item_modal_button', function

            (e) {
                $('#edit_items_table_modal tbody').empty();
                arrayOfItems.forEach((element, index) => {


                    $('#edit_items_table_modal tbody')
                        .append('<tr><td class="class_item_no">' + element.item_no +
                            '</td><td class="class_item_code">' + element.item_code +
                            '</td><td class="class_item_description">' +
                            element.item_description +
                            '</td><td class="class_price"><input type="number" id="update_single_item_price" class="form-control form-control-sm" value=' +
                            element.item_price +
                            ' /></td><td class="class_quantity"><input type="number" id="update_single_item_quantity" class="form-control form-control-sm" value=' +
                            element.item_quantity + ' /></td><td class="class_total_price">' + element
                            .total_price +
                            '</td><td><a id=' + index +
                            ' class="update_item_modal_icon" style="cursor: pointer"><span class="fas fa-wrench text-danger"></span></a></td></tr>'
                        );

                });

            });

        $(document).on('click', '#addToInvoice', function

            (e) {


                $(".table_added_items").hide();

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
                        'total_price': item_price * item_quantity
                    }

                    arrayOfItems.push(item);



                });


                // arrayOfItems.shift();


                $('.added_items_div').show();
                // arrayOfDisplayItems = arrayOfItems;
                // arrayOfItems = [];
                $('#myTable tbody').empty();
                $('#displayItems tbody').empty();

                arrayOfItems.forEach((element, index) => {

                    $('#displayItems tbody')
                        .append('<tr><td class="class_item_no">' + element.item_no +
                            '</td><td class="class_item_code">' + element.item_code +
                            '</td><td class="class_item_description">' +
                            element.item_description + '</td><td class="class_price">' +
                            element.item_price + '</td><td class="class_quantity">' + element.item_quantity +
                            '</td><td class="class_total_price text-danger"><b>' + element.total_price +
                            '</b></td><td><a style="cursor: pointer" id="edit_item_modal_button" data-toggle="modal" data-target="#edit_item" ><span class="fas fa-edit text-info"></span></a>&nbsp;&nbsp;<a style="cursor: pointer" id=' +
                            index +
                            ' class="deleteRow" ><span class="fas fa-trash text-danger"></span></a></td></tr>'
                        );

                    totalInvoiceAmount += element.total_price


                });

                $(".total_price_label").text(totalInvoiceAmount);

                //   $('#displayItems tbody')
                //         .append('<tr><td class="class_item_no">'+data.item_no+'</td><td class="class_item_code">'+data.item_code+'</td><td class="class_item_description">'
                //         +data.description+'</td><td class="class_price"><input type="number" id="price" class="form-control form-control-sm" value='
                //         +data.sale_price+' /></td><td class="class_quantity"><input type="number" id="quantity" class="form-control form-control-sm" placeholder="Enter Quantity" /></td><td><a style="cursor: pointer" id="deleteRow" ><span class="fas fa-trash text-danger"></span></a></td></tr>');


            });
    </script>


</main>

@endsection
