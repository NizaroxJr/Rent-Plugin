<?php 

function RpNavigation(){
	
$menu = '<div style="padding:10px 10px 30px 10px">
  <a class="button" href="admin.php?page=Rp">Edit Options</a>
<a class="button" href="admin.php?page=RpOrders">Orders</a>
<a class="button" href="admin.php?page=RpProducts">Products</a>
<a class="button" href="admin.php?page=RpClients">Clients</a>
<a class="button" href="admin.php?page=RpPickup">Pickup List</a>
<a class="button" href="admin.php?page=RpReturn">Return List</a>
  </div> ';	
	
	return $menu;
}

function RpOptionsPage(){
	
	
	global $wpdb;
	
	
	if(isset($_POST['save_options'])){
		

		
		update_option( 'rp_application_link',esc_html($_POST['rp_application_link']) );
		

				
	}
	
	
	
	
	$content .=''.RpNavigation().'<h1>Rental Plugin Options</h1>



	<form action="admin.php?page=Rp&save=1" method="post">
	 <table class="wp-list-table widefat fixed posts" id="Rptable" cellspacing="0">
  
   
         <tr>
    <td width="300"><strong>Products Page full url</strong><br><em>full url to Products page which contains All Products. Please put the shortcode [rp_products] on the page.</td>
    <td><input type="text" name="rp_application_link"  value="'.get_option('rp_application_link').'"  size=80"> </td>
    
  </tr>

    ';
  

  
  
  $content .='
    <tr>
    <td>&nbsp;</td>
    <td><input type="submit" name="save_options" value="Save Options"></td>
  </tr>
</table>
</form>
	
	';
	
	
	
	echo $content;
}
?>