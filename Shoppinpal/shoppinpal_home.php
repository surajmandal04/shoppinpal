<?php
    session_start();

if(!isset($_SESSION['log-in']) || $_SESSION['log-in']== false) {
    header( "Location: shoppinpal_index.php" );
}

if( isset( $_SESSION['log-in'] ) && $_SESSION['log-in'] ) {
?>
    <!DOCTYPE html>
    <html>
    <head>
    	<title>Home Page</title>
    </head>
    <body>
        <div>
	    <p> Hi <?php echo $_SESSION['username'];?></p>
	    <form method="post" action="shoppinpal_logout.php">
	    	<input type="submit" name="logout" value='Logout'>
	    </form></br></br>
	    <form method="post">
	    	<textarea id='loop_code' name='loop_code' style="width: 30%;height: 50%;"><?php echo (isset($_POST['loop_code'])) ? $_POST['loop_code'] : '';?></textarea></br></br>
		    <input type="submit" name="loop_result">
	    </form>
	    </div>
    </body>
    </html>
	
<?php

if(isset($_POST['loop_result'])) {
    $fullString = $_POST['loop_code'];
    $str = str_replace('suraj', 'for', $fullString);
    $str_final = str_replace('mandal', 'echo', $str);
    eval($str_final);
    } 
}
