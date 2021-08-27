<?php

function RpAddClient(){
	
global $wpdb;

if($_POST['add-client'] != ""){
	

        $name = $_POST['name'];
		$adresse=$_POST['adresse'];
		$phone = $_POST['phone'];
		$email= $_POST['email'];
 

	  
			
		
        	$table_name = $wpdb->prefix . 'rp_clients';
			$query="INSERT INTO $table_name(name,adresse,phone,email) VALUES('$name', '$adresse','$phone','$email')";
		     $wpdb->query($query);
		
		 
		
		
      
		RpRedirect('admin.php?page=RpClients');
	}


	 

$content .= '
		
<form action="admin.php?page=RpClients&action=AddClient"  method="post" enctype="multipart/form-data">
  <table class="wp-list-table widefat fixed posts " id="Rptable" cellspacing="0">
	
	<tbody>
	<tr>
	<td>Client Name</td>
	<td><input type="text" name="name" value="" required></td>
	</tr>

	<tr>
		<td>Adresse</td>
	<td><input type="text" name="adresse" value="" required></td>
	</tr>
	<tr>
		<td>Phone</td>
	<td><input type="text"  name="phone" value="" required></td>
	</tr>
    
  
		<td>Email</td>
	<td><input type="text" name="email" value="" required></td>
	</tr>
	   
	<td></td>
	<td><input type="submit" name="add-client" value="Add Client"></td>
	</tr>
	</tbody>
</table>
</form>
<p><br></p>


';
return $content;


	
	
}


function RpViewClient(){
 global $wpdb;

	
if($_POST['edit-client'] != ""){
	
        $ClientID=$_POST['ClientID'];
        $name = $_POST['name'];
		$adresse=$_POST['adresse'];
		$phone = $_POST['phone'];
		$email= $_POST['email'];
 

	   
		
       
        	$table_name = $wpdb->prefix . 'rp_clients';
		               $query.="UPDATE $table_name " ;
		               $query.="SET name='$name'  , adresse='$adresse',phone='$phone',email='$email'";
		               $query.="WHERE ClientID='$ClientID'";
	                   $wpdb->query($query );
		
		 
		
		
      
		RpRedirect('admin.php?page=RpClients');
	}


   $r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "rp_clients where ClientID = '".$wpdb->escape($_GET['ClientID'])."'", ARRAY_A);

	$content .= '
		
<form action="admin.php?page=RpClients&action=ViewClient&ClientID='.$r[0]['ClientID'].'"  method="post" enctype="multipart/form-data">
 <input type="hidden" name="ClientID" value="'.$r[0]['ClientID'].'">
  <table class="wp-list-table widefat fixed posts " id="Rptable" cellspacing="0">
	
	<tbody>
	<tr>
	<td>Client Name</td>
	<td><input type="text" name="name" value="'.$r[0]['name'].'"  required"></td>
	</tr>

	<tr>
		<td>adresse</td>
	<td><input type="text" name="adresse" value="'.$r[0]['adresse'].'" required"></td>
	</tr>
	<tr>
		<td>phone</td>
	<td><input type="text"  name="phone" value="'.$r[0]['phone'].'" required"></td>
	</tr>

    
	<tr>
		<td>email</td>
	<td><input type="text" name="email" value="'.$r[0]['email'].'" required"></td>
	</tr>
	   
	<td></td>
	<td><input type="submit" name="edit-client" value="Edit Client"></td>
	</tr>
	</tbody>
</table>
</form>
<p><br></p>


';
return $content;


}


function RpManageClients(){
	
	
	global $wpdb;
	$content .= ' '.RpNavigation().'	<h1>Clients</h1>';
				
			if($_GET['action'] == 'AddClient'){		
			
			$content .= RpAddClient();			
			
			}
			elseif($_GET['action'] == 'ViewClient'){
				
				
            $content .= RpViewClient();
			}
			elseif($_GET['action'] == 'DeleteClient'){
				
			$wpdb->query("DELETE FROM wp_rp_clients WHERE ClientID = ".$wpdb->escape($_GET['ClientID'])."	");	
			RpRedirect('admin.php?page=RpClients');

			}
            else{
		
			$r = $wpdb->get_results("SELECT * FROM wp_rp_clients ;", ARRAY_A);	
	        
			
				$content .='

	 <a class="button" href="admin.php?page=RpClients&action=AddClient">Add Client</a>
	  <table class="wp-list-table widefat fixed posts" id="Rptable" cellspacing="0">
	<thead>
	<tr>

 <th >ClientID</th>
<th> Name</th>
<th>Adresse</th>
<th>Phone </th>
<th>Email</th>
<th>Actions</th>
</tr>
	</thead><tbody>';	
	
	
	for($i=0; $i<count($r); $i++){
		
		
		$content .='<tr>
        <td>'.$r[$i]['ClientID'].'</td>
		<td>'.$r[$i]['name'].'</td>
		<td>'.$r[$i]['adresse'].'</td>
        <td>'.$r[$i]['phone'].'</td>
        <td>'.$r[$i]['email'].'</td>
		<td width="100"><a  class="button" href="admin.php?page=RpClients&action=DeleteClient&ClientID='.$r[$i]['ClientID'].'">Delete</a>  
	<a class="button" style="margin-left:20px" href="admin.php?page=RpClients&action=ViewClient&ClientID='.$r[$i]['ClientID'].'">View</a> 
	</td>
		</tr>';
		
				}
				
				$content .= '</tbody></table>';
				
	
	
	
	
	
	
	
	
	
	
	
			}	
				
				echo $content;
			
} 

?>