<?php


function RpEditOrder(){
 global $wpdb;

	
if($_POST['edit'] != ""){

	                   global $wpdb;

                       $where=$_POST['OrderID'] ;
                       $PID=$_POST['PID'] ;
					   $StartDate= $_POST['StartDate'];
		               $EndDate=$_POST['EndDate'];
		               $Quantity= $_POST['Quantity'];
		               $Price= $_POST['Price'];
		             
                       //Updating Order
                       $table_name1 = $wpdb->prefix . 'rp_orders';
		               $query.="UPDATE $table_name1 " ;
		               $query.="SET StartDate='$StartDate'  , EndDate='$EndDate',Quantity='$Quantity',Price='$Price'";
		               $query.="WHERE OrderID='$where'";
	                   $wpdb->query($query );

                       //Updating Product Quantity
					   $oldQuantity=$wpdb->get_results("SELECT pQuantity FROM ".$wpdb->prefix . "rp_products where ProductID = ".$_POST['PID']. "", ARRAY_A);
                       $newQuantity=$oldQuantity[0]['pQuantity'] - $Quantity;
    
                       $table_name2 = $wpdb->prefix . "rp_products";
		               $query2.="UPDATE $table_name2 " ;
					   $query2.="SET pQuantity='$newQuantity' ";
					   $query2.="WHERE ProductID='$PID' " ;
	                   $wpdb->query($query2);


                   RpRedirect('admin.php?page=RpOrders');
	               }

   $r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "rp_orders where OrderID = '".$wpdb->escape($_GET['OrderID'])."'", ARRAY_A);
   $c=  $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "rp_clients where ClientID = ".$r[0]['CID']."", ARRAY_A);
   $p=  $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "rp_products where ProductID = ".$r[0]['PID']."", ARRAY_A);


   $content .= '
	<h2> Order Edit:</h2>	
<form action="admin.php?page=RpOrders&action=EditOrder&OrderID='.$r[0]['OrderID'].'"  method="post" enctype="multipart/form-data">
 <input type="hidden" name="OrderID" value="'.$r[0]['OrderID'].'">
 <input type="hidden" name="PID" value="'.$r[0]['PID'].'">
  <table class="wp-list-table widefat fixed posts" id="Rptable" cellspacing="0">
	
	<tbody>
	<tr>
	<td>StartDate</td>
	<td><input type="date" name="StartDate" onchange="RpCalendar()" value="'.$r[0]['StartDate'].'"  required"></td>
	</tr>

	<tr>
		<td>EndDate</td>
	<td><input type="date" name="EndDate" value="'.$r[0]['EndDate'].'" required"></td>
	</tr>
	<tr>
		<td>Quantity</td>
	<td><input type="number"  name="Quantity" name="Quantity" min="1" max="'.$p[0]['pQuantity'].'" value="'.$r[0]['Quantity'].'" required"></td>
	</tr>
    
    
	<tr>
		<td>Price</td>
	<td><input type="number" name="Price" value="'.$r[0]['Price'].'" required"></td>
	</tr>

	<tr>
	<td></td>
	<td><input type="submit" name="edit" value="Edit Order"></td>
	</tr>
	</tbody>
</table>
</form>
<p><br></p>


';


$content .= '<h2> Product Details:</h2>
<table class="wp-list-table widefat fixed posts" id="Rptable" cellspacing="0">
	
	<tbody>
   <tr>
	<td><img width="75" src="'.$p[0]['photo'].'"></td>
	</tr>
	<tr>
	<td><strong>Product Name</strong></td>
	<td>'.$p[0]['Pname'].'</td>
	</tr>

	<tr>
		<td><strong>Quantity</strong></td>
	<td>'.$p[0]['pQuantity'].'</td>
	</tr>
	<tr>
		<td><strong>Description</strong></td>
	<td>'.$p[0]['description'].' </td>
	</tr>
   <tr>
		<td><strong>Time</strong></td>
	<td>'.$p[0]['time'].'</td>
	</tr>
    <tr>
		<td><strong>Duration</strong></td>
	<td>'.$p[0]['duration'].'</td>
	</tr>
	<tr>
		<td><strong>Rent Price</strong></td>
	<td>'.$p[0]['rPrice'].'</td>
	</tr>
	    
	</tbody>
</table>




<h2> Customer Details:</h2>
	<div style="width:700px">
	
  <table class="wp-list-table widefat fixed posts" id="Rptable" cellspacing="0">
  <tr>
    <td><strong>ClientID</strong></td>
    <td colspan="3">'.$c[0]['ClientID'].'</td>
 
 </tr>
  <tr>
    <td><strong>Name</strong></td>
    <td colspan="3">'.$c[0]['name'].'</td>
 
 </tr>
  <tr>
    <td><strong>Phone</strong></td>
    <td colspan="3">'.$c[0]['phone'].'</td>
 
 </tr>
 <tr>
    <td><strong>Adresse</strong></td>
    <td colspan="3">'.$c[0]['adresse'].'</td>
 
 </tr>

</table>


</div>

<h2>Payment Details	</h2>
	<div style="width:700px">
	
  <table class="wp-list-table widefat fixed posts" id="Rptable" cellspacing="0">
  <tr>
    <td><strong>Payment Type:</strong></td>
    <td colspan="3">'.$p[0]['Type'].'</td>
 
 </tr>
  <tr>
    <td><strong>Payment Status</strong></td>
    <td colspan="3">'.$p[0]['PayementStatus'].'</td>
 
 </tr>
  <tr>
    <td><strong>Paid Amount	</strong></td>
    <td colspan="3">'.$p[0]['amount'].'</td>
 
 </tr>
 <tr>
    <td><strong>Note</strong></td>
    <td colspan="3">'.$p[0]['Note'].'</td>
 
 </tr>

</table>


</div>

';

return $content;


}






function rpViewOrder(){
	
	global $wpdb;
	
	
	
	
	$r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "rp_orders where OrderID = '".$wpdb->escape($_GET['OrderID'])."'", ARRAY_A);		
	$c=  $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "rp_clients where ClientID = ".$r[0]['CID']."", ARRAY_A);
   $p=  $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "rp_products where ProductID = ".$r[0]['PID']."", ARRAY_A);

	
    $content = '
    
	<h2> Order Details:</h2>'. RpNavigation().'
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


</div>


<h2> Product Details:</h2>
<table class="wp-list-table widefat fixed posts" id="Rptable" cellspacing="0">
	
	<tbody>
   <tr>
	<td><img width="75" src="'.$p[0]['photo'].'"></td>
	</tr>
	<tr>
	<td><strong>Product Name</strong></td>
	<td>'.$p[0]['Pname'].'</td>
	</tr>

	<tr>
		<td><strong>Quantity</strong></td>
	<td>'.$p[0]['pQuantity'].'</td>
	</tr>
	<tr>
		<td><strong>Description</strong></td>
	<td>'.$p[0]['description'].' </td>
	</tr>
   <tr>
		<td><strong>Time</strong></td>
	<td>'.$p[0]['time'].'</td>
	</tr>
    <tr>
		<td><strong>Duration</strong></td>
	<td>'.$p[0]['duration'].'</td>
	</tr>
	<tr>
		<td><strong>Rent Price</strong></td>
	<td>'.$p[0]['rPrice'].'</td>
	</tr>
	    
	</tbody>
</table>




<h2> Customer Details:</h2>
	<div style="width:700px">
	
  <table class="wp-list-table widefat fixed posts" id="Rptable" cellspacing="0">
  <tr>
    <td><strong>ClientID</strong></td>
    <td colspan="3">'.$c[0]['ClientID'].'</td>
 
 </tr>
  <tr>
    <td><strong>Name</strong></td>
    <td colspan="3">'.$c[0]['name'].'</td>
 
 </tr>
  <tr>
    <td><strong>Phone</strong></td>
    <td colspan="3">'.$c[0]['phone'].'</td>
 
 </tr>
 <tr>
    <td><strong>Adresse</strong></td>
    <td colspan="3">'.$c[0]['adresse'].'</td>
 
 </tr>

</table>


</div>

<h2>Payment Details	</h2>
	<div style="width:700px">
	
  <table class="wp-list-table widefat fixed posts" id="Rptable" cellspacing="0">
  <tr>
    <td><strong>Payment Type:</strong></td>
    <td colspan="3">'.$p[0]['Type'].'</td>
 
 </tr>
  <tr>
    <td><strong>Payment Status</strong></td>
    <td colspan="3">'.$p[0]['PayementStatus'].'</td>
 
 </tr>
  <tr>
    <td><strong>Paid Amount	</strong></td>
    <td colspan="3">'.$p[0]['amount'].'</td>
 
 </tr>
 <tr>
    <td><strong>Note</strong></td>
    <td colspan="3">'.$p[0]['Note'].'</td>
 
 </tr>

</table>


</div>

';
	return $content;
}




function RpOrderInit(){
	
	
global $wpdb;


if($_GET['action'] == 'ViewOrder'){		
			
			$content .= rpViewOrder();
			
			}
elseif($_GET['action'] == 'EditOrder'){
				
            $content .= RpEditOrder();
			}
elseif($_GET['action'] == 'delete'){
				
		$wpdb->query("DELETE FROM ".$wpdb->prefix . "rp_orders WHERE OrderID = '".$wpdb->escape($_GET['OrderID'])."'	");
		RpRedirect('admin.php?page=RpOrders');
		
			}

else{
	global $wpdb;
		
		
		
		
			
			$r = $wpdb->get_results("SELECT SQL_CALC_FOUND_ROWS `OrderID`, `PID`, `CID`, `StartDate`, `EndDate`, `Quantity`, `Price`, `Status` FROM ".$wpdb->prefix . "rp_orders ;", ARRAY_A);	
			$content .=''. RpNavigation().'	<h1>Orders</h1> ';
			
			

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
<th colspan="3">Actions</th>


	</thead><tbody>';	
	
	
	for($i=0; $i<count($r); $i++){
		
			
		$content .='<tr>
		<td>'.$r[$i]['OrderID'].'</td>
        <td>'.$r[$i]['PID'].'</td>
		<td>'.$r[$i]['CID'].'</td>
        <td>'.$r[$i]['StartDate'].'</td>
        <td>'.$r[$i]['EndDate'].'</td>
		<td>'.$r[$i]['Quantity'].'</td>
      <td>'.$r[$i]['Price'].' $</td>
		<td>'.$r[$i]['PayementStatus'].'</td>
		<td>'.$r[$i]['Status'].'</td>
		
		<td colspan="3">
          <a  class="button" href="admin.php?page=RpOrders&action=delete&OrderID='.$r[$i]['OrderID'].'">Delete</a> 
		  <a class="button" style="margin-left:20px" href="admin.php?page=RpOrders&action=EditOrder&OrderID='.$r[$i]['OrderID'].'">Edit</a>  
	      <a class="button" style="margin-left:20px" href="admin.php?page=RpOrders&action=ViewOrder&OrderID='.$r[$i]['OrderID'].'">View</a> 
	     </td>
		</tr>';


		 
    }			

  }   

  echo $content;
} 

?>