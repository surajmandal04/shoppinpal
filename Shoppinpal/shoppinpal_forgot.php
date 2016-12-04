<?php
session_start();

if( isset( $_SESSION['log-in'] ) && $_SESSION['log-in'] ) {
    header( "Location: shoppinpal_home.php" );
} else {


    if(isset($_POST['forgot'])) {
        $user_not_found = '';
        $update_user = '';
    	$user_email = (isset($_POST['username_email'])) ? $_POST['username_email'] : '';
    	$password = (isset($_POST['new_password'])) ? $_POST['new_password'] : '';
    	$dbhost='localhost';
	    $dbuser='root';
	    $dbpass='root';
	    $conn=mysqli_connect($dbhost,$dbuser,$dbpass);
	    if(!$conn)
	    {
	       die('Could not connect:' .mysqli_connect_error());
	    }
	    mysqli_select_db($conn,'shoppinpal');
	    $sql_check = "SELECT username,email from user_details";
        $flg_un = 0;
        $flg_email = 0;
	    $retval_check=mysqli_query($conn,$sql_check);
	    while($row_check = mysqli_fetch_array($retval_check, MYSQL_NUM))
	    {
	        if($row_check[0] == $user_email) {
	            $flg_un =1;
	            break;
	        }
	        if($row_check[1] == $user_email) {
	            $flg_email =1;
	            break;
	        }
	    }
        
        if($flg_un == 1) {
            $sql = "UPDATE user_details SET password = '".$password."' WHERE username = '".$user_email."'";	
            $retval = mysqli_query( $conn,$sql );
            if( !$retval )
            {
                echo 'Database Error';
                mysqli_error($conn);
                die();
    	    } else {
    	    	$update_user = 'Your password has been changed.';
    	    }
        } else if($flg_email == 1) {
        	$sql = "UPDATE user_details SET password = '".$password."' WHERE email = '".$user_email."'";
        	$retval = mysqli_query( $conn,$sql );
            if( !$retval )
            {
                echo 'Database Error';
                mysqli_error($conn);
                die();
    	    } else {
    	    	$update_user = 'Your password has been changed.';
    	    }
        } else {
            $user_not_found = '*Incorrect username or email. Please enter correct information.';
        }    
        mysqli_close($conn);
    }
	?>
<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="assests/css/forgot.css">
	<title>Forgot Password</title>
	<script src="assests/js/jquery-3.1.1.slim.min.js"></script>
	<script src="assests/js/forgot.js"></script>

</head>
<body>
<div id='main-div'>
    <div id='name-div'><b>Forgot Password</b></div>
	<form method='post' id='forgot_form'>
		<input type="text" name="username_email" placeholder="Username Or Email" required></br></br>
		<input type="password" name="new_password" placeholder="New Password" id='forgot-password' required></br></br>
		<input type="submit" name="forgot" value='Change Password' class='submit_button' id='forgot-button'></br></br>
		<?php if(isset($user_not_found) && !empty($user_not_found)) {
			    ?><span class="error-message"><?php
			    echo $user_not_found;
			    ?></span><?php
			}
			if(isset($update_user) && !empty($update_user)) {
				?>
				<span class='success-message'>
					<?php echo $update_user; ?>
				</span></br></br>			 
			    <?php
			}
			?></span>
	</form>
	<div class='login-div'>
		<a href="shoppinpal_index.php" id='forgot-password'>LOGIN</a>
	</div>
</div>
</body>
</html>
<?php
}
