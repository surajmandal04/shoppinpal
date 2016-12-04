<?php
session_start();

if(!isset($_SESSION['log-in']) || $_SESSION['log-in']== false) {
    header( "Location: shoppinpal_index.php" );
}

if(isset($_SESSION['username']))
{
       header( "Location: shoppinpal_home.php" );
}
if(isset($_POST['register'])) {

    $username = (isset($_POST['user_name'])) ? $_POST['user_name'] : '';
    $firstname = (isset($_POST['first_name'])) ? $_POST['first_name'] : '';
    $lastname = (isset($_POST['last_name'])) ? $_POST['last_name'] : '';
    $email = (isset($_POST['email'])) ? $_POST['email'] : '';
    $password = (isset($_POST['password'])) ? $_POST['password'] : '';



	$dbhost='localhost';
    $dbuser='root';
    $dbpass='root';
    $conn=mysqli_connect($dbhost,$dbuser,$dbpass);
    if(!$conn)
    {
       die('Could not connect:' .mysqli_connect_error());
    }
    mysqli_select_db($conn,'shoppinpal');

    $flg_un = 0;
    $flg_email = 0;
    $sql_check = "SELECT username,email from user_details";

    $retval_check=mysqli_query($conn,$sql_check);
    while($row_check = mysqli_fetch_array($retval_check, MYSQL_NUM))
    {
        if($row_check[0] == $username) {
            $flg_un =1;
            break;
        }
        if($row_check[1] == $email) {
            $flg_email =1;
            break;
        }
    }
    if($flg_un == 1) {
        $_SESSION['register_error'] = '*Username Already Present';
        header( "Location: shoppinpal_index.php" );
    } else if($flg_email == 1) {
        $_SESSION['register_error'] = '*Email Already Present';
        header( "Location: shoppinpal_index.php" );
    } else {
        mysqli_select_db($conn,'shoppinpal');
        $sql = "INSERT INTO user_details (user_id, username, firstname, lastname, email, password) VALUES (NULL, '$username', '$firstname', '$lastname', '$email', '$password');";
        $retval = mysqli_query( $conn,$sql );
        
        if( !$retval )
        {
                      echo 'Database Error';
                      mysqli_error($conn);
                      die();
    	} else {
                mysqli_close($conn);
    	    	$_SESSION['log-in']=true;
                $_SESSION['username']=$username;
                header( "Location: shoppinpal_home.php" );
    	}
    }
    mysqli_close($conn);

}