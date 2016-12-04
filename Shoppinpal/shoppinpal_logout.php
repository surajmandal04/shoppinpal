<?php
	session_start();

    if(!isset($_SESSION['log-in']) || $_SESSION['log-in']== false) {
        header( "Location: shoppinpal_index.php" );
    }


	if( isset( $_SESSION['log-in'] ) && $_SESSION['log-in'] ) {
		if(isset($_POST['logout'])) {
		    $_SESSION['log-in']=false;
		    unset($_SESSION['username']);
		    header( "Location: shoppinpal_index.php" );	
		}
	}
?>
