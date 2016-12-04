<?php

session_start();

if(!isset($_SESSION['log-in']) || $_SESSION['log-in']== false) {
    header( "Location: shoppinpal_index.php" );
}

if(isset($_SESSION['username']))
{
       header( "Location: shoppinpal_home.php" );
}

if(isset($_POST['login'])) {
	$username = (isset($_POST['user_name'])) ? $_POST['user_name'] : '';
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
    $sql = 'SELECT username,password FROM user_details';

    $retval1=mysqli_query($conn,$sql);
    $flg=0;
    while($row1 = mysqli_fetch_array($retval1, MYSQL_NUM))
    {
       if($row1[0]==$username&&$row1[1]==$password)
       {
          $flg=1;
          $name=$row1[0];
          break;
       }
    }
    mysqli_close($conn);
    if($flg==1)
    {
        $_SESSION['log-in']=true;
        $_SESSION['username']=$name;
        header( "Location: shoppinpal_home.php" );
    } else {
    	  $_SESSION['login_error']='*Enter invalid username and password';
    	  header( "Location: shoppinpal_index.php" );
    }
}