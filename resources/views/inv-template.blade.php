{{-- <link href="{{ asset('https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" >

<div class="container">
    <div class="card">
        <div class="card-header">
            Invoice
            <strong>01/01/01/2018</strong>
            <span class="float-right"> <strong>Status:</strong> Pending</span>

        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h6 class="mb-3">From:</h6>
                    <div>
                        <strong>Webz Poland</strong>
                    </div>
                    <div>Madalinskiego 8</div>
                    <div>71-101 Szczecin, Poland</div>
                    <div>Email: info@webz.com.pl</div>
                    <div>Phone: +48 444 666 3333</div>
                </div>

                <div class="col-sm-6">
                    <h6 class="mb-3">To:</h6>
                    <div>
                        <strong>Bob Mart</strong>
                    </div>
                    <div>Attn: Daniel Marek</div>
                    <div>43-190 Mikolow, Poland</div>
                    <div>Email: marek@daniel.com</div>
                    <div>Phone: +48 123 456 789</div>
                </div>



            </div>

            <div class="table-responsive-sm">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th class="center">Item No</th>
                                                    <th>Item Code</th>
                                                    <th>Description</th>

                                                    <th class="right">Unit Price</th>
                                                    <th class="center">Qty</th>
                                                    <th class="right">Total</th>
                        </tr>
                    </thead>
                    <tbody>
                       @foreach ($items as $key => $item )
                           <tr>
                               <td>{{ $item['item_no'] }}</td>
                               <td>{{ $item['item_code'] }}</td>
                               <td>{{ $item['item_description'] }}</td>
                               <td>{{ $item['item_price'] }}</td>
                               <td>{{ $item['item_quantity'] }}</td>
                               <td>{{ $item['total_price'] }}</td>
                           </tr>
                       @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5">

                </div>

                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                            <tr>
                                <td class="left">
                                    <strong>Subtotal</strong>
                                </td>
                                <td class="right">{{ $sub_total }}</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>Discount (20%)</strong>
                                </td>
                                <td class="right">$1,699,40</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>VAT (10%)</strong>
                                </td>
                                <td class="right">$679,76</td>
                            </tr>
                            <tr>
                                <td class="left">
                                    <strong>Total</strong>
                                </td>
                                <td class="right">
                                    <strong>{{ $total }}</strong>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                </div>

            </div>

        </div>
    </div>
</div>

 --}}
 <!DOCTYPE html>
 <html lang="en">
   <head>
     <meta charset="utf-8">
     <title>INVOICE</title>

   </head>
   <style>
       .clearfix:after {
  content: "";
  display: table;
  clear: both;
}

a {
  color: #5D6975;
  text-decoration: underline;
}

body {
  position: relative;
  /* width: 21cm;   */
  height: 29.7cm; 
  margin: 0 auto; 
  color: #001028;
  background: #FFFFFF; 
  font-family: Arial, sans-serif; 
  font-size: 12px; 
  font-family: Arial;
}

header {
  padding: 10px 0;
  margin-bottom: 30px;
}

#logo {
  text-align: center;
  margin-bottom: 10px;
}

#logo img {
  width: 90px;
}

h1 {
  border-top: 1px solid  #5D6975;
  border-bottom: 1px solid  #5D6975;
  color: #5D6975;
  font-size: 2.4em;
  line-height: 1.4em;
  font-weight: normal;
  text-align: center;
  margin: 0 0 20px 0;
  background: url(dimension.png);
}

#project {
  float: left;
}

#project span {
  color: #5D6975;
  text-align: right;
  width: 52px;
  margin-right: 10px;
  display: inline-block;
  font-size: 0.8em;
}

#company {
  float: right;
  text-align: right;
}

#project div,
#company div {
  white-space: nowrap;        
}

table {
  width: 100%;
  border-collapse: collapse;
  border-spacing: 0;
  margin-bottom: 20px;
}

table tr:nth-child(2n-1) td {
  background: #F5F5F5;
}

table th,
table td {
  text-align: center;
}

table th {
  padding: 5px 20px;
  color: #5D6975;
  border-bottom: 1px solid #C1CED9;
  white-space: nowrap;        
  font-weight: normal;
}

table .service,
table .desc {
  text-align: left;
}

table td {
  padding: 20px;
  text-align: right;
}

table td.service,
table td.desc {
  vertical-align: top;
}

table td.unit,
table td.qty,
table td.total {
  font-size: 1.2em;
}

table td.grand {
  border-top: 1px solid #5D6975;;
}

#notices .notice {
  color: #5D6975;
  font-size: 1.2em;
}

footer {
  color: #5D6975;
  width: 100%;
  height: 30px;
  position: absolute;
  bottom: 0;
  border-top: 1px solid #C1CED9;
  padding: 8px 0;
  text-align: center;
}
   </style>
   <body>
     <header class="clearfix">
       <div id="logo">
         <img src="https://blog.hubspot.com/hubfs/image8-2.jpg">
       </div>
       <h1>INVOICE 3-2-1</h1>
       <div id="company" class="clearfix">
         <div>Company Name</div>
         <div>455 Foggy Heights,<br /> AZ 85004, US</div>
         <div>(602) 519-0450</div>
         <div><a href="mailto:company@example.com">company@example.com</a></div>
       </div>
       <div id="project">
         <div><span>PROJECT</span> Website development</div>
         <div><span>CLIENT</span> John Doe</div>
         <div><span>ADDRESS</span> 796 Silver Harbour, TX 79273, US</div>
         <div><span>EMAIL</span> <a href="mailto:john@example.com">john@example.com</a></div>
         <div><span>DATE</span> August 17, 2015</div>
         <div><span>DUE DATE</span> September 17, 2015</div>
       </div>
     </header>
     <main>
       <table>
         <thead>
           <tr>
            <th class="center">Item No</th>
            <th>Item Code</th>
            <th>Description</th>

            <th class="right">Unit Price</th>
            <th class="center">Qty</th>
            <th class="right">Total</th>
           </tr>
         </thead>
         <tbody>
            @foreach ($items as $key => $item )
                           <tr>
                               <td>{{ $item['item_no'] }}</td>
                               <td>{{ $item['item_code'] }}</td>
                               <td>{{ $item['item_description'] }}</td>
                               <td>{{ $item['item_price'] }}</td>
                               <td>{{ $item['item_quantity'] }}</td>
                               <td>{{ $item['total_price'] }}</td>
                           </tr>
                       @endforeach
                       <tr><td colspan="4">Sub Total : </td><td colspan="5">{{ $sub_total }}</td></tr>
                       <tr><td colspan="4">Discount : </td><td colspan="5">{{ $discount }}</td></tr>
                       <tr><td colspan="4">Total : </td><td colspan="5">{{ $total }}</td></tr>
         </tbody>
       </table>
       <div id="notices">
         <div>NOTICE:</div>
         <div class="notice">A finance charge of 1.5% will be made on unpaid balances after 30 days.</div>
       </div>
     </main>
     <footer>
       Invoice was created on a computer and is valid without the signature and seal.
     </footer>
   </body>
 </html>