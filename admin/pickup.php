<?php


function rpShowPickup(){
	
		global $wpdb;
		
		
		
		
			
			$r = $wpdb->get_results("SELECT SQL_CALC_FOUND_ROWS `OrderID`, `PID`, `CID`, `StartDate`, `EndDate`, `Quantity`, `Price`, `Status` FROM ".$wpdb->prefix . "rp_orders ;", ARRAY_A);	
			$content .=''. RpNavigation().'	<h1>Pickup List</h1> ';
			
			
            
						$content .='

	 
	  <table class="wp-list-table widefat fixed posts" id="Rptable" cellspacing="0">
	<thead>
	<tr>

<th >Order ID</th>

<th>ProductID</th>
<th>CustomerID</th>
<th>Start Date</th>
<th>End Date </th>
<th>Quantity</th>
<th>Price</th>
<th>Payment Status</th>
<th>Status</th>
<th>Actions</th>


	</thead><tbody>';	
	
	
	for($i=0; $i<count($r); $i++){
		
		if($r[$i]['Status'] =="Processing" ){
            $content .='<tr>
		<td>'.$r[$i]['OrderID'].'</td>
        <td>'.$r[$i]['PID'].'</td>
		<td>'.$r[$i]['CID'].'</td>
        <td>'.$r[$i]['StartDate'].'</td>
        <td>'.$r[$i]['EndDate'].'</td>
		<td>'.$r[$i]['Quantity'].'</td>
      <td>'.$r[$i]['Price'].'</td>
		<td>'.$r[$i]['PayementStatus'].'</td>
		<td>'.$r[$i]['Status'].'</td>
		
		<td>
	      <a class="button" style="margin-left:20px" href="admin.php?page=RpPickup&OrderID='.$r[$i]['OrderID'].'">Pickup</a> 
	     </td>
		</tr>';
        }	
        else{
            $content .='';
        }
		
		
	}
	
return  $content;
}

function rpEditPickup(){
	
	global $wpdb;
	
	if($_POST['submit'] != ''){
		
        $OID =$_POST['OrderID']; 
		$table_name = $wpdb->prefix . 'rp_orders';
		$query.="UPDATE $table_name " ;
		$query.="SET Status='With Customer'";
		$query.="WHERE OrderID='$OID'";
	    $wpdb->query($query );
		RpRedirect('admin.php?page=RpPickup');
	}
	
	
	$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "rp_orders where OrderID = '".$wpdb->escape($_GET['OrderID'])."'", ARRAY_A);		

	
    $content = '
    
	<h2> Order Details:</h2>
	<div style="width:700px">
	
  <table class="wp-list-table widefat fixed posts" id="Rptable" cellspacing="0">
  <tr>
    <td><strong>Order Id</strong></td>
    <td colspan="3">'.$r[0]['OrderID'].'</td>
 
 </tr>
  <tr>
    <td><strong>Product Name</strong></td>
    <td colspan="3">'.$r[0]['PID'].'</td>
 
 </tr>
  
  <tr>
    <td><strong>StartDate</strong></td>
    <td colspan="3">'.$r[0]['StartDate'].'</td>
 
 </tr>
 <tr>
    <td><strong>EndDate</strong></td>
    <td colspan="3">'.$r[0]['EndDate'].'</td>
 
 </tr>
 <tr>
    <td><strong>Quantity</strong></td>
    <td colspan="3">'.$r[0]['Quantity'].'</td>
 
 </tr>
 <tr>
    <td><strong>Total</strong></td>
    <td colspan="3">'.$r[0]['Price'].'</td>
 
 </tr>
 <tr>
    <td><strong>Status</strong></td>
    <td colspan="3">'.$r[0]['Status'].'</td>
 
 </tr>
 
</table>

<form action="admin.php?page=RpPickup&OrderID='.$r[0]['OrderID'].'"  method="post" enctype="multipart/form-data">
 <input type="hidden" name="OrderID" value="'.$r[0]['OrderID'].'">
 <br>
 <h3>Update Order Status To With Customer:</h3>
 <input class="button" " id="pick" type="submit" name="submit" value="Pick Up">
 </form>

</div>




</div>

';
	return $content;
}


function RpPickupManager(){
	
	
global $wpdb;


if($_GET['OrderID'] == ""){
	
	
echo rpShowPickup();
}

else{
	
echo rpEditPickup();	
}
	
}
?>