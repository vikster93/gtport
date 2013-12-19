<?php
include 'dbinfo.php'; 
ob_start();
session_start();
?>  


<html>
<title> GTPort - CREATE ACCOUNT </title>
<body bgcolor="#000000">  
<center>
<font color="#ffffff">  
<br />
<b><p>Create Account</p></b>
<br />

<?php

if(isset($_POST['username']))  { 

    $user = $_POST['username'];
    $pass = $_POST['pass'];
    $confirmPass = $_POST['confirmPass'];
    $userType = $_POST['userType'];

//connect to the db 

    if(isset($_POST['username']) && $confirmPass == $pass){

        if(($pass == "") || ($user == "")){
            echo "Password/User fields can't be empty!";
        }else{

            mysql_connect($host,$username,$password, $database) or die( "Unable to connect");;
            mysql_select_db($database) or die( "Unable to select database");

        //check if user is in the DB

                 //SQL query for regular user.
                   $regular_user = "SELECT Username FROM Regular_User WHERE (Username = '$user')";  
                 //Run our sql query
                   $regular_result = mysql_query ($regular_user)  or die(mysql_error());
                 //SQL query for Administrator.
                   $admin_user = "SELECT Username FROM Administrator WHERE (Username = '$user')";
                 //Run our sql query
                   $admin_result = mysql_query ($admin_user)  or die(mysql_error());


        //this is where the actual verification happens 
            if(mysql_num_rows($regular_result) == 0 && mysql_num_rows($admin_result) == 0){ 

                $_SESSION['user'] = $user;
                $_SESSION['pass'] = $pass;
                $_SESSION['userType'] = $userType;
                $_SESSION['firstTime'] = True;
                //the ssn matches the ssn of a manager of a department 
                //move them to the page to which they need to go 
                if($_SESSION['userType'] == "faculty"){

                    header('Location: facultyInfo.php');


                }else{
                    header('Location: studentInfo.php');

                }

            }else{ 
                $err = "User already exists!"; 
            }

            
            //then just above your login form or where ever you want the error to be displayed you just put in 
            echo "$err";     
        
        }

    }else{
        echo "Passwords did not match!";
    }


}


echo "<html>"; 
echo "<head>"; 
echo "</head>"; 
echo "<body>"; 

//Create Account
echo "<form action=\"\" method=\"POST\">"; 
echo "<p>Username:";  
echo "<input name=\"username\" />"; 
echo "</p>"; 
echo "<p>Password:";
echo "<input type=\"password\" name=\"pass\" />"; 
echo "</p>";
echo "<p>Confirm Password:";
echo "<input type=\"password\" name=\"confirmPass\" />"; 
echo "</p>";
echo "<p> Type of User:";
echo "<select name=\"userType\" >";
echo "<option value=\"student\"> Student </option>";
echo "<option value=\"faculty\"> Faculty </option></select>";
echo "</p>";
echo "<br /><br />";
echo "<input type=\"submit\" name=\"create_account\" value=\"Create Account\" />"; 
echo "</form>";
echo "</body>"; 
echo "</html>";

?>

</font>
</center>
</body>
</html>
