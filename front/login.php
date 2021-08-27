<?php



if($_GET['action'] =="Register"){


 global $wpdb;
 $PUrl=get_option('rp_application_link');

    session_start();

if(isset($_POST['register_btn']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    $password2=$_POST['password2'];  
    $r=$wpdb->get_results("SELECT * FROM ".$wpdb->prefix . "rp_clients WHERE email = '$email' ", ARRAY_A );
     
    if($r[0]['email'])
      {
     
                
         echo '<script language="javascript">';
         echo 'alert("User already exists")';
         echo '</script>';
    }
          else
          {
            
            if($password==$password2)
            {           //Create User
                echo "Register Working";
                $password=md5($password); //hash password before storing for security purposes
                $table_name = $wpdb->prefix . 'rp_clients';
                $query="INSERT INTO $table_name(email,password)  VALUES('$email','$password') ";
                $wpdb->query($query);
                echo $query;
                $_SESSION['message']="You are now logged in"; 
                $_SESSION['email']=$username;
                RpRedirect($PUrl);  //redirect Products page
            }
            else
            {
                $_SESSION['message']="The two password do not match";   
            }
        }
 } 



$action="$PUrl?action=Register";
$content.='
<h4>Create Account</h4>
<form method="post" action="'.$action.'">
  <table>
     <tr>
           <td><strong>Email :</strong> </td>
           <td><input type="email" name="email" class="textInput"></td>
     </tr>
      <tr>
           <td><strong>Password : </strong></td>
           <td><input type="password" name="password" class="textInput"></td>
     </tr>
      <tr>
           <td><strong>Password again: </strong></td>
           <td><input type="password" name="password2" class="textInput"></td>
     </tr>
      <tr>
           <td><a href="'.$PUrl.'/?action=Login">LogIN</a></td>
           <td><input type="submit" name="register_btn" value="Register" class="Register"></td>
     </tr>
    </table>

</form>';

 echo $content;

}

if($_GET['action'] =="Login"){
  

   global $wpdb;
    $PUrl=get_option('rp_application_link');

    session_start();
if(isset($_SESSION['email']) )
{
  RpRedirect($PUrl);
  die();
}

  if(isset($_POST['login_btn']))
  {
      //echo "im working for fuck sake";  
      $email=$_POST['email'];
      $password=$_POST['password'];
      $password=md5($password); //Remember we hashed password before storing last time
      $r=$wpdb->get_results("SELECT email FROM ".$wpdb->prefix . "rp_clients WHERE  email='$email' ", ARRAY_A );
      if($r[0]['email'] !='')
      {
            $_SESSION['message']="You are now Loggged In";
            $_SESSION['email']=$email;
            RpRedirect($PUrl);
        }
       else
       {
              $_SESSION['message']="Username and Password combiation incorrect";
       }
  }


   $action="$PUrl/action=login";
   $content.='
   <h4>Login To Account</h4>
   <form method="post" action="'.$action.'">
  <table>
     <tr>
           <td><strong>Email : </strong></td>
           <td><input type="text" name="email" class="textInput"></td>
     </tr>
      <tr>
           <td><strong>Password : </strong></td>
           <td><input type="password" name="password" class="textInput"></td>
     </tr>
      <tr>
           <td><a href="'.$PUrl.'/?action=register">Register</a></td>
           <td><input type="submit" name="login_btn" value="LogIN" class="Log In"></td>
     </tr>
 
</table>
</form>
</div>

</main>
</div>

</body>
</html>';

echo $content;

}



add_shortcode( 'rp_login', 'RpLogin' );

//add_action( 'init', 'RpLoginManager' );
//add_action( 'init', 'RpRegisterManager' );

/*<ul class="nav navbar-nav center">
        <li><a href="'.$PUrl.'/?action=Login">LogIN</a></li>
        <li><a href="'.$PUrl.'/?action=Register">SignUp</a></li>
      </ul>*/ 
 ?>