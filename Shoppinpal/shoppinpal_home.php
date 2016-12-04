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
        <link rel="stylesheet" type="text/css" href="assests/css/home.css">
    	<title>Home Page</title>
    </head>
    <body>
        <div id="main-div">
            <div id="div-1">
    	        <p><b> Hi <?php echo $_SESSION['username'];?></b></p>
            </div>
            <div id="div-2">
        	    <form method="post" action="shoppinpal_logout.php" id='user-logout'>
        	    	<input type="submit" name="logout" value='Logout'>
        	    </form></br></br>
            </div>
        </div>
        <div id='sub-div'>
    	    <form method="post" id="loop-form">
    	    	<textarea id='loop_code' name='loop_code'><?php echo (isset($_POST['loop_code'])) ? $_POST['loop_code'] : '';?></textarea></br></br>
                <div id='note-div'>[Note:Enter 'suraj' instead of 'for' and 'mandal' instead of 'echo'. This is 'for' loop code.]</div>
    		    <input type="submit" name="loop_result">
    	    </form>
        </div>
        <p id='answer-tag'><b>Answer :</b></p>
        <div id='answer-div'>
        <?php

            $loop_str = (isset($_POST['loop_code'])) ? $_POST['loop_code'] : '';
            if(!empty($loop_str)) {

            $new_loop_array = array_filter(array_map('trim',explode("\n",$loop_str))); //explode string by new line and remove the space
            $new_loop_str = implode("", $new_loop_array);                              //from all element and make string of array again
            $result_str = substr($new_loop_str, 0, 5);                                 //take first five element of string
            if($result_str == 'suraj')                                                 //Check use 'suraj' or not 
            {
                preg_match_all('/\{(.*?)\}/', $new_loop_str, $matches1);               //get string from {}
                $echo_str_arr = explode(" ", $matches1[1][0]);
                if($echo_str_arr[0] == 'mandal') {                                     //Check use 'mandal' or not

                    $find = array(';','"',"'");
                    $replace = array('');
                    $pre_echo_str=str_replace($find,$replace,$echo_str_arr[1]);        //Replace ",',; by blanck spaces.
                    $echo_str = $pre_echo_str;
                    preg_match_all('/\((.*?)\)/', $new_loop_str, $matches);            //get string from ()
                    $condition_str=$matches[1][0];

                    $condition_array = explode(";", $condition_str);                   //seprate all 3 condition
                    $variable_number = explode("=", $condition_array[0]);              // get variable and initial number
                    $variable = $variable_number[0];
                    $initial_number = intval($variable_number[1]);                     
                    //check same variable use for all 3 condition or not.
                    if (strpos($condition_array[1], $variable) !== false && strpos($condition_array[2], $variable) !== false) {
                        if(strpos($condition_array[1], '<=') !== false && strpos($condition_array[2], '++') !== false) {
                            $last_number_arr = explode('<=', $condition_array[1]);
                            $last_number = intval($last_number_arr[1]);
                            for ($a=$initial_number; $a<= $last_number ; $a++) { 
                                echo $echo_str;
                                echo " ";
                            }
                        } else if(strpos($condition_array[1], '<') !== false && strpos($condition_array[2], '++') !== false) {
                                $last_number_arr = explode('<', $condition_array[1]);
                                $last_number = intval($last_number_arr[1]);
                                for ($a=$initial_number; $a< $last_number ; $a++) { 
                                    echo $echo_str;
                                    echo " ";
                                }
                            } else if(strpos($condition_array[1], '>=') !== false && strpos($condition_array[2], '--') !== false) {
                                    $last_number_arr = explode('>=', $condition_array[1]);
                                    $last_number = intval($last_number_arr[1]);
                                    for ($a=$initial_number; $a >= $last_number ; $a--) { 
                                        echo $echo_str;
                                        echo " ";
                                    }
                                } else if(strpos($condition_array[1], '>') !== false && strpos($condition_array[2], '--') !== false) {
                                        $last_number_arr = explode('>', $condition_array[1]);
                                        $last_number = intval($last_number_arr[1]);
                                        for ($a=$initial_number; $a > $last_number ; $a--) { 
                                            echo $echo_str;
                                            echo " ";
                                        }
                                    } else {
                                        echo 'This loop print content infinite time';
                                    }

                    } else {
                        echo 'Enter invalid variable to condition';
                    }
                } else {
                    echo "Enter 'mandal' insted of 'echo'!";
                }
            } else {
                echo "Enter 'suraj' insted of 'for'";
            }
        }
        ?>
        </div>
	    </div>
    </body>
    </html>
	
<?php
}
