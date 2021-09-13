<?php



function RpShowProducts($atts){
	
	global $wpdb;
	
	$content .='<div id="Products">';
	
	if($_GET['ProductID'] != ""){
		      
    
   


      $r = $wpdb->get_results("SELECT *  FROM ".$wpdb->prefix . "rp_products where ProductID = '".$wpdb->escape($_GET['ProductID'])."'", ARRAY_A);			
	
	$content .='<div class="">';
		if($r[0]['photo'] == ""){
			
			$img = '<img  src="'.get_bloginfo("wpurl").'/wp-content/plugins/Rent Plugin/images/comming.jpg">';
			
		}else{
			
		$img = '<img  src="'.$r[0]['photo'].'">';	
			}
		
	
				$content .='</div>

	<h4>Product Informations</h4>
	  <table class="wp-list-table widefat fixed posts" >
	<tbody>
	<tr>
	<td ><strong>'.$r[0]['Pname'].'</strong></td>
	<td width="100%">'.$img .'</td>
	</tr>
  
  
	<tr>
	<td ><strong>Hourly Rent Price</strong></td>
	<td>'.$r[0]['HourlyRPrice'].'$ </td>
	</tr>
  <tr>
	<td ><strong>Daily Rent Price</strong></td>
	<td>'.$r[0]['DailyRPrice'].'$ </td>
	</tr>
  <tr>
	<td ><strong>Weekly Rent Price</strong></td>
	<td>'.$r[0]['WeeklyRPrice'].'$ </td>
	</tr>
  <tr>
	<td ><strong>Monthly Rent Price</strong></td>
	<td>'.$r[0]['MonthlyRPrice'].'$ </td>
	</tr>

	<tr>
	<td width="30%"><strong>Description</strong></td>
	<td>'.$r[0]['description'].'</td>
	</tr>

	

	
	
	  
	
	</tbody></table>';

	//Get Min Date
	$DailyminDate=date('Y-m-d');
  $WminDate=date('Y-m-d');
  $Week=date("W", strtotime($WminDate));
  $Year=date("Y", strtotime($WminDate));
  $weeklyMinDate="$Year-W$Week";
  $monthlyminDate=date('Y-m');

	
      $content.='
        <div >
		<form action="" method="POST" id="abstractForm">	

    
      <h4>Client Informations</h4>

		<table width="100%" border="0" cellspacing="3" cellpadding="3">
        <tr>
    <td><strong>Name</strong></td>
    </tr>
    <tr>
    <td><input type="text" name="name" class="required"></td>
    </tr>
    <tr>
    <td><strong>Adresse</strong></td>
    </tr>
    <tr>
    <td><input type="text" name="adresse" class="required"></td>
    </tr>

    <tr>
    <td><strong>phone</strong></td>
    </tr>
    <tr>
    <td><input type="number" name="phone" class="required"></td>
    </tr>
    <tr>
    <td><strong>Email</td>
    </tr>
    <tr>
    <td><input type="email" name="email" class="required"></td>
	 </tr>
     </table>


      <h4>Order Information</h4>

<label for="RentType"><strong>Choose a Rent Type:</strong></label>

<select id="RentType" onchange="RentTypeHandler(value);">
  <option value="Hourly">Hourly</option>
  <option value="Daily">Daily</option>
  <option value="Weekly">Weekly</option>
  <option value="Monthly">Monthly</option>
</select>

    

		<table width="100%" border="0" >
        
       ';

      

         
         
       $content.='
    <tbody  id="hourlyRent">
       <tr>
       <td><strong>Rent Duration in hours</strong></td>
       <td>
       <input type="number" name="duration" class="required">
       </td>
       </tr>
       </tbody>
    
    
    ';
       
       $content.='
       <tbody  id="dailyRent">
       <tr>
       <td><strong>Start Day</strong></td>
       <td><input type="date" name="StartDay" min='.$DailyminDate.' onchange="MinDay()" class="required"></td>
       </tr>
       <tr>
       <td><strong>End Day</strong></td>
       <td><input type="date" name="EndDay" class="required"></td
       </tr>
       </tbody>
      
    ';
    
       $content.='
       <tbody  id="weeklyRent">
       <tr>
       <td><strong>Start Week</strong></td>
       <td><input type="week" name="StartWeek"  min='.$weeklyMinDate.' onchange="MinWeek()"  class="required"></td>
       </tr>
       <tr>
       <td><strong>End Week</strong></td>
       <td><input type="week" name="EndWeek" class="required"></td
       </tr>
       </tbody>
       ';
      
         $content.='
         <tbody  id="monthlyRent">
       <tr>
       <td ><strong>Start Month</strong></td>
       <td ><input type="month" name="StartMonth"  min='.$monthlyminDate.' onchange="MinMonth()" class="required"></td>
       </tr>
       <tr>
       <td ><strong>End Month</strong></td>
       <td><input type="month" name="EndMonth" class="required"></td
       </tr>
       </tbody>
       
       ';
      
    

    $content.='

    
     <tr>
    <td ><strong>Quantity</strong></td>
    <td><input type="number" name="Quantity" min="1" max="'.$r[0]['pQuantity'].'" class="required"></td>
    </tr>
      <tr>
     <td><input type="submit" name="submit-app" value="Order Now" class="button"></td>
     </tr>


     
   
    </table>
    


    </form>
    
    </div>
   
    
	 ';
	
		
	
 }


	
	
	
	
		
	else{
	
	
	

	
	 

  $r = $wpdb->get_results("SELECT * FROM ".$wpdb->prefix . "rp_products ; ", ARRAY_A);			
	     
	    $PUrl=get_option('rp_application_link');

				$content .='

	  

	  <table class="wp-list-table widefat fixed posts" cellspacing="0">
	<thead>
	<tr>
<th></th>
<th >Product Name</th>
<th >Rent Price</th>
<th >Actions</th>
</tr>
	</thead><tbody>';	
	
for($i=0; $i<count($r); $i++){


	if($r[$i]['rStatus'] =="Hidden"){
      $content .='';
  }

	else{

		if($r[$i]['photo'] == ""){
			
			$img = '<a  href="?ProductID='.$r[$i]['ProductID'].'"><img width="75" src="'.get_bloginfo("wpurl").'/wp-content/plugins/Rent Plugin/images/comming.jpg"></a>';
		}else{
		$img = '<a  href="?ProductID='.$r[$i]['ProductID'].'"><img width="75" src="'.$r[$i]['photo'].'"></a>';	
			
		}
		$content .='<tr>
		<td>'.	$img .'</td>
		<td>'.$r[$i]['Pname'].'</td>
	<td>Starting At '.$r[$i]['HourlyRPrice'].'$</td>';
	
  if($r[$i]['rStatus'] =="Out Of Stock"   ){
        $content .='	<td>
         	<strong><p> Out Of Stock</p></strong>
	        </td>
		      </tr>';
    }
  
  else{
	$content .='	<td>
	<a class="button"  href="'.get_option('rp_application_link').'?ProductID='.$r[$i]['ProductID'].'">View</a>
	 </td>
		</tr>';
    }
	}
}
				
				$content .= '</tbody></table>
				
	
				
				';
	}
	$content .='</div>';

  
     return $content;
    
	
}


add_shortcode( 'rp_products', 'RpShowProducts' );

add_action( 'init', 'GetFormData' );


function GetFormData() {
    global $wpdb;
   
 if($_POST['submit-app'] != ""){

  $r=$wpdb->get_results("SELECT ClientID  FROM ".$wpdb->prefix . "rp_clients ", ARRAY_A);

    for($i=0; $i<count($r); $i++){
      $NewID=$r[$i]['ClientID'];
    }

    $NewID++;

    $insert1['ClientID']=$NewID;
  	$insert1['name'] = $_POST['name'];
    $insert1['adresse'] = $_POST['adresse'];
    $insert1['phone'] = $_POST['phone'];
    $insert1['email'] = $_POST['email'];
    $email=$_POST['email'];
  
    
     
    $CID = $insert1['ClientID'];
    $PID=$_GET['ProductID'];
    $Quantity = $_POST['Quantity'];
	
    //No Duplicate User
    $e=$wpdb->get_results("SELECT email  FROM ".$wpdb->prefix . "rp_clients where email = '$email'", ARRAY_A);
    
    $OldID=$wpdb->get_results("SELECT ClientID  FROM ".$wpdb->prefix . "rp_clients where email = '$email'", ARRAY_A);
   
    if($e[0]['email']==""){
       $wpdb->insert(  ''.$wpdb->prefix .'rp_clients',$insert1 );
    }
    else{
    $insert2['CID']=$OldID[0]["ClientID"];
    }
    
    //Updating Product Quantity
    $p=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix . "rp_products where ProductID = ".$PID."", ARRAY_A);
    
    $newQuantity=$p[0]['pQuantity'] - $insert2['Quantity'];
    
    $table_name = $wpdb->prefix . "rp_products";
    $PID2=$insert2['PID'];
		$query="UPDATE $table_name SET pQuantity='$newQuantity' WHERE ProductID='$PID2'" ;
	  $wpdb->query($query );
    
     
    //Total Price Calculation
    if($_POST['StartDay'] ){
    
    $StartDay=$_POST['StartDay'];
    $EndDay=$_POST['EndDay'];

    $Yduration =number_format(substr($EndDay, 2, 2)) -number_format(substr($StartDay, 2, 2));
    $Mduration =number_format(substr($EndDay, 5, 2)) -number_format(substr($StartDay, 5, 2));
    $Dduration =number_format(substr($EndDay, 8, 2)) -number_format(substr($StartDay, 8, 2));
    $TotalDuration=360*$Yduration+30*$Mduration+$Dduration;

    $StartDate = $_POST['StartDay'];
    $EndDate = $_POST['EndDay'];
    $TotalPrice= $TotalDuration*$p[0]['DailyRPrice']*$Quantity;
    
    }
    elseif($_POST['StartWeek'] ){
    $StartWeek=$_POST['StartWeek'];
    $EndWeek=$_POST['EndWeek'];

    $Yduration =number_format(substr($EndWeek, 2, 2)) -number_format(substr($StartWeek, 2, 2));
    $Wduration =number_format(substr($EndWeek, 7, 2)) -number_format(substr($StartWeek, 7, 2));
    $TotalDuration=52*$Yduration+$Wduration;

    $StartDate = $_POST['StartWeek'];
    $EndDate = $_POST['EndWeek'];
    $TotalPrice= $TotalDuration*$p[0]['WeeklyRPrice']*$Quantity;

    
    }
    elseif($_POST['StartMonth']){
    $StartMonth=$_POST['StartMonth'];
    $EndMonth=$_POST['EndMonth'];
    
    $Yduration =number_format(substr($EndMonth, 2, 2)) -number_format(substr($StartMonth, 2, 2));
    $Mduration =number_format(substr($EndMonth, 5, 2)) -number_format(substr($StartMonth, 5, 2));
    $TotalDuration=12*$Yduration+$Mduration;
    

    $StartDate = $_POST['StartMonth'];
    $EndDate = $_POST['EndMonth'];
    $TotalPrice= $TotalDuration*$p[0]['MonthlyRPrice']*$Quantity;
    
    }
    else{
      $TotalDuration=$_POST['duration'];
      date_default_timezone_set('Africa/Casablanca');
      $StartDate=date("d/m/Y h");
      
      $i=0;
      $h=number_format(substr($StartDate, 10,3));
      $day=number_format(substr($StartDate, 0,2));
      $m=number_format(substr($StartDate, 3,2));
      $y=number_format(substr($StartDate, 6,4));
      
      //Get Month Duration
      if($m==9 || $m==4 || $m==6 || $m==11 ){
         $mDuration=30;
      }
      elseif($m==2){
         $mDuration=28;
         if(($y % 2) ==0 ){
           $mDuration=29;
         }
      }
      else{
          $mDuration=31;
      }

      //Get Total DUration
      while($i<$TotalDuration){
        $h++;
        if($h>=24){
          $h=0;
          $day++;
        }
        if($day>=$mDuration){
          $day=0;
          $m++;
        }
        if($m>=12){
          $m=0;
          $y++;
        }
       $i++;
      }
      
      $EndDate="$day/$m/$y $h";
      $TotalPrice= $TotalDuration*$p[0]['HourlyRPrice']*$Quantity;

      
    }

    
    //Order Insert
    $table_name = $wpdb->prefix . 'rp_orders';
		$query2="INSERT INTO $table_name(PID,CID,StartDate,EndDate,Quantity,Price,duration,Status) VALUES('$PID', '$CID','$StartDate','$EndDate', '$Quantity', '$TotalPrice', '$TotalDuration','Processing')";
		$wpdb->query($query2);    
   
    echo "<h1>Your Order Has Been Successfull Continue Shopping<h1>";
    
    $ProductsPage=	get_option('rp_application_link');
    RpRedirect("$ProductsPage");
    


 }

 
		
}
?>