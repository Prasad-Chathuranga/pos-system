<?php
## Database configuration
$sname= "localhost";
$unmae= "root";
$password = "";

$db_name = "pos_system";

$conn = mysqli_connect($sname, $unmae, $password, $db_name);

## Read value
$draw = $_POST['draw'];
$row = $_POST['start'];
$rowperpage = $_POST['length']; // Rows display per page
$columnIndex = $_POST['order'][0]['column']; // Column index
$columnName = $_POST['columns'][$columnIndex]['data']; // Column name
$columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
$searchValue = mysqli_real_escape_string($conn,$_POST['search']['value']); // Search value

## Search 
$searchQuery = " ";
if($searchValue != ''){
   $searchQuery = " and (item_no like '%".$searchValue."%' or item_code like '%".$searchValue."%' or description like '%".$searchValue."%' ) ";
}

## Total number of records without filtering
$sel = mysqli_query($conn,"select count(*) as allcount from items");
$records = mysqli_fetch_assoc($sel);
$totalRecords = $records['allcount'];

## Total number of record with filtering
$sel = mysqli_query($conn,"select count(*) as allcount from items WHERE 1 ".$searchQuery);
$records = mysqli_fetch_assoc($sel);
$totalRecordwithFilter = $records['allcount'];

## Fetch records
$empQuery = "select * from items WHERE 1 ".$searchQuery." order by ".$columnName." ".$columnSortOrder." limit ".$row.",".$rowperpage;
$empRecords = mysqli_query($conn, $empQuery);
$data = array();

while ($row = mysqli_fetch_assoc($empRecords)) {
  

   // Update Button
   // $updateButton = "<a class='btn btn-success'  href='editCustomer.php?id=".$row['cid']."'   method='POST'><span class='fas fa-edit text-light'></span></a>"; 
   $updateButton = "<a class='mr-3' data-id='".$row['id']."' data-toggle='modal'
   data-target='#edit_item' ><span class='fas fa-edit text-info'></span></a>";

   // Delete Button
   $deleteButton = "<a onclick='javascript:confirmationDelete($(this));return false;'  method='POST'><span class='fas fa-trash text-danger'></span></a>";

   $action = $updateButton." ".$deleteButton;

   $data[] = array( 
      "id"=>$row['id'],
      "item_no"=>$row['item_no'],
      "item_code"=>$row['item_code'],
      "description"=>$row['description'],
      "soh"=>$row['soh'],
      "sale_price"=>$row['sale_price'],
      "reorder_level"=>$row['reorder_level'],
      "country"=>$row['country'],
      "action" => $action
   );
  
}

// var_dump($data); exit();

## Response
$response = array(
  "draw" => intval($draw),
  "iTotalRecords" => $totalRecords,
  "iTotalDisplayRecords" => $totalRecordwithFilter,
  "aaData" => $data
);

echo json_encode($response);

