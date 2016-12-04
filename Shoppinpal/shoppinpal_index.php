<?php
session_start();

if( isset( $_SESSION['log-in'] ) && $_SESSION['log-in'] ) {
    header( "Location: shoppinpal_home.php" );
} else {
	?>

     <!DOCTYPE html>
	<html>
	<head>
    <link rel="stylesheet" type="text/css" href="assests/css/homecss.css">
	<title>Home</title>
	<script src="assests/js/jquery-3.1.1.slim.min.js"></script>
	<script src="assests/js/AddTabs.js"></script>
	<script src="assests/js/validation.js"></script>
	</head>
	<body>
	<div id='main-div'>
	<div id='div-0'>
	    <p id='icon-name'><b>BLUBOX</b><p id='sub-icon'>Making Brands Click!</p></p>
	    <div>
		    <p id='welcome-part'>Wecome to BluBox</p>
		    <p id='seller-part'><b>SELLER PORT</b></p>
		</div>
	</div>
	<div id='div-1'>
    <div data-addui='tabs'>
    <div role='tabs'>
    <div>LOGIN</div>
    <div>REGISTER</div>
    </div>
	  <div role='contents'>
	    <div>
	        <form method="post" action="shoppinpal_login.php" id='login_form'>
				<input type="text" name="user_name" placeholder="username" required></br></br>
				<input type="password" name="password" placeholder="password" required></br></br>
				<span><input type="checkbox" name="remember_me"><span id='remember-me'>Remember Me</span> <a href="shoppinpal_forgot.php" id='forgot-password'>Forgot Password?</a></span></br></br>
				<span class='error-message'><?php
                if(isset($_SESSION['login_error'])) {
                    echo $_SESSION['login_error'];
                    unset($_SESSION['login_error']);
                }
				?></span>
				<input type="submit" name="login" value='Login' class='submit_button'>
		    </form>
	    </div>
	    <div>
	      <form method='post' action="shoppinpal_register.php" id='register_form'>
				<input type="text" name="user_name" placeholder="username" id='reg_username' required></br></br>
				<input type="text" name="first_name" placeholder="Frist Name" required></br></br>
				<input type="text" name="last_name" placeholder="Last Name" required></br></br>
				<input type="text" name="email" placeholder="Email" id="reg_email" required></br></br>
				<input type="password" name="password" placeholder="password" id='reg_password' required></br></br>
				<span class='error-message'><?php
                if(isset($_SESSION['register_error'])) {
                    echo $_SESSION['register_error'];
                    unset($_SESSION['register_error']);
                }
				?></span>
				<input type="submit" name="register" value='Register' class='submit_button' id='registration_button'>
		    </form>
	    </div>
	  </div>
    </div>
    </div>
    </div>
    </body>
</html>
	<?php
}