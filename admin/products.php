<?php

function RpAddProduct(){
	
global $wpdb;

if($_POST['add'] != ""){
	

        $ProductID=$_POST['ProductID'] ;
        $Pname = $_POST['Pname'];
		$pQuantity=$_POST['pQuantity'];
		$description= $_POST['description'];
		$time = $_POST['time'];
		$duration= $_POST['duration'];
		$rPrice= $_POST['rPrice'];
        $rStatus= $_POST['rStatus'];
	  
		
        $location = wp_upload_bits($_FILES['photo']["name"], null, file_get_contents($_FILES['photo']["tmp_name"]));	
		$photo = 	$location['url'];	
		
        	$table_name = $wpdb->prefix . 'rp_products';
			$query="INSERT INTO $table_name(Pname,pQuantity,photo,description,time,duration,rPrice,rStatus) VALUES('$Pname', '$pQuantity','$photo','$description', '$time', '$duration', '$rPrice','$rStatus')";
		     $wpdb->query($query);
		
		 
		
		
      
		RpRedirect('admin.php?page=RpProducts');
	}


	 

$content .= '
		
<form action="admin.php?page=RpProducts&action=AddProduct"  method="post" enctype="multipart/form-data">
 <input type="hidden" name="id" value="'.$r[0]['ProductID'].'">
  <table class="wp-list-table widefat fixed posts" id="Rptable" cellspacing="0">
	
	<tbody>
	<tr>
	<td>Product Name</td>
	<td><input type="text" name="Pname" value="" required></td>
	</tr>

	<tr>
		<td>Quantity</td>
	<td><input type="text" name="pQuantity" value="" required></td>
	</tr>
	<tr>
		<td>Description</td>
	<td><input type="text" style="width:400px; height:100px;" name="description" value="" required></td>
	</tr>
    <tr>
		<td>Time</td>
	  <td>
         <select name="time" id="time">
                 <option value="hourly">Hourly</option>
             <option value="daily">Daily</option>
             <option value="weekly">Weekly</option>
             <option value="monthly">Monthly</option>
        </select>
      </td>
	</tr>
    

	<tr>
		<td>Rent Price</td>
	<td><input type="text" name="rPrice" value="" required></td>
	</tr>
	    

    <tr>
		<td>Product Status</td>
	<td><select name="rStatus" id="status">
                 <option value="In Stock">In Stock</option>
             <option value="Out Of Stock">Out Of Stock</option>
             <option value="Hidden">Hidden</option>
        </select></td>
	</tr>

	    <tr>
		<td>Add Image<td>
	<td><input type="file" name="photo" value="Add Image" required></td>
		<tr>
	<td></td>
	<td><input type="submit" name="add" value="Add Product"></td>
	</tr>
	</tbody>
</table>
</form>
<p><br></p>


';
return $content;


	
	
}


function RpViewProduct(){
 global $wpdb;

	
if($_POST['edit'] != ""){
                       $ProductID=$_POST['ProductID'] ;
                       $Pname = $_POST['Pname'];
		               $pQuantity=$_POST['pQuantity'];
		               $photo = $_FILES['photo']['name'];
		               $description= $_POST['description'];
		               $time = $_POST['time'];
		               $duration= $_POST['duration'];
		               $rPrice= $_POST['rPrice'];
                       $rStatus= $_POST['rStatus'];

	                  $location = wp_upload_bits($_FILES['photo']["name"], null, file_get_contents($_FILES['photo']["tmp_name"]));	
		              $photo = 	$location['url'];	
        

                        $table_name = $wpdb->prefix . 'rp_products';
		               $query.="UPDATE $table_name " ;
		               $query.="SET Pname='$Pname'  , pQuantity='$pQuantity',photo='$photo',description='$description',time='$time',duration='$duration',rPrice='$rPrice',rStatus='$rStatus'";
		               $query.="WHERE ProductID='$ProductID'";
	                   $wpdb->query($query );	

                   RpRedirect('admin.php?page=RpProducts');
	               }

   $r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "rp_products where ProductID = '".$wpdb->escape($_GET['ProductID'])."'", ARRAY_A);

	$content .= '
		
<form action="admin.php?page=RpProducts&action=ViewProduct&ProductID='.$r[0]['ProductID'].'"  method="post" enctype="multipart/form-data">
 <input type="hidden" name="ProductID" value="'.$r[0]['ProductID'].'">
  <table class="wp-list-table widefat fixed posts" id="Rptable" cellspacing="0">
	
	<tbody>
	<tr>
	<td>Product Name</td>
	<td><input type="text" name="Pname" value="'.$r[0]['Pname'].'"  required"></td>
	</tr>

	<tr>
		<td>Quantity</td>
	<td><input type="text" name="pQuantity" value="'.$r[0]['pQuantity'].'" required"></td>
	</tr>
	<tr>
		<td>Description</td>
	<td><input type="text" style="width:400px; height:100px;" name="description" value="'.$r[0]['description'].'" required"></td>
	</tr>
    <tr>
		<td>Time</td>
	  <td>
         <select name="time" id="time" >
            <option value="hourly">Hourly</option>
             <option value="daily">Daily</option>
             <option value="weekly">Weekly</option>
             <option value="monthly">Monthly</option>
        </select>
      </td>
	</tr>
    
	<tr>
		<td>Rent Price</td>
	<td><input type="text" name="rPrice" value="'.$r[0]['rPrice'].'" required"></td>
	</tr>

	 <tr>
		<td>Product Status</td>
	<td><select name="rStatus" id="status">
                 <option value="In Stock">In Stock</option>
             <option value="Out Of Stock">Out Of Stock</option>
             <option value="Hidden">Hidden</option>
        </select></td>
	</tr>


	    <tr>
		<td>Add Image<td>
	<td><input type="file" name="photo" value="Add Image" required></td>
		<tr>
	<td></td>
	<td><input type="submit" name="edit" value="Edit Product"></td>
	</tr>
	</tbody>
</table>
</form>
<p><br></p>


';
return $content;


}


function RpManageProducts(){
	
	
	global $wpdb;
	$content .= ' '.RpNavigation().'	<h1>Products</h1>';
				
			if($_GET['action'] == 'AddProduct'){		
			
			$content .= RpAddProduct();			
			
			}
			elseif($_GET['action'] == 'ViewProduct'){
				
				
            $content .= RpViewProduct();
			}
			elseif($_GET['action'] == 'DeleteProduct'){
				
			$wpdb->query("DELETE FROM wp_rp_products WHERE ProductID = ".$wpdb->escape($_GET['ProductID'])."	");	
			RpRedirect('admin.php?page=RpProducts');

			}
            else{
		
	        unset($r);
			$r = $wpdb->get_results("SELECT * FROM wp_rp_products LIMIT 0, 100;", ARRAY_A);	
	        
			
				$content .='

	 <a class="button" href="admin.php?page=RpProducts&action=AddProduct">Add Product</a>
	  <table class="wp-list-table widefat fixed posts" id="Rptable" cellspacing="0">
	<thead>
	<tr>

<th >Image</th>
<th >N° Orders</th>
<th >Product ID</th>
<th>Product Name</th>
<th>Quantity</th>
<th>Rent Price </th>
<th>Status </th>
<th colspan="2">Actions</th>
</tr>
	</thead><tbody>';	
	
	
	for($i=0; $i<count($r); $i++){
		
			$o = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "rp_orders where PID = '".$r[$i]['ProductID']."'", ARRAY_A);		
		
		$content .='<tr>
		<td><img width="75" src="'.$r[$i]['photo'].'" ></td>
		<td>'.count($o).'</td>
        <td>'.$r[$i]['ProductID'].'</td>
		<td>'.$r[$i]['Pname'].'</td>
		<td>'.$r[$i]['pQuantity'].'</td>
        <td>'.$r[$i]['rPrice'].'$ '.$r[$i]['time'].' </td>';


        if($r[$i]['pQuantity'] ==0){
             $content .='
		<td>Out Of Stock</td>';

		$pid=$r[$i]['ProductID'];
		 $table_name = $wpdb->prefix . 'rp_products';
		               $query.="UPDATE $table_name " ;
		               $query.="SET rStatus='Out Of Stock' ";
		               $query.="WHERE ProductID='$pid'";
	                   $wpdb->query($query );	
		}
		else{
			$content .='
		<td>'.$r[$i]['rStatus'].'</td>';
		}
		

		$content .='<td colspan="2"><a  class="button" href="admin.php?page=RpProducts&action=DeleteProduct&ProductID='.$r[$i]['ProductID'].'">Delete</a>  
	<a class="button" style="margin-left:20px" href="admin.php?page=RpProducts&action=ViewProduct&ProductID='.$r[$i]['ProductID'].'">View</a> 
	</td>
		</tr>';
		
				}
				
				$content .= '</tbody></table>';
				
	
	
	
	
	
	
	
	
	
	
	
			}	
				
				echo $content;
			
} 

?>