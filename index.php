<?php
include 'dbinfo.php'; 
session_start(); 
ob_start();
?>  


<html>
<title> GTPort Login </title>
<body bgcolor="#000000">  
<center>
<font color="#ffffff">  
<br />
<b><p>GTPort Login</p></b>
<br />

<?php

if(isset($_POST['username']) && isset($_POST['pass']))  { 
    $user = $_POST['username'];
    $pass = $_POST['pass']; 


//connect to the db 

    mysql_connect($host,$username,$password, $database) or die( "Unable to connect");;
    mysql_select_db($database) or die( "Unable to select database");

         //SQL query for regular user.
           $regular_user = "SELECT Username FROM Regular_User WHERE (Username = '$user' AND Password = '$pass')";  

         //Run our sql query
           $regular_result = mysql_query ($regular_user)  or die(mysql_error());

         //SQL query for Administrator.
           $admin_user = "SELECT Username FROM Administrator WHERE (Username = '$user' AND Password = '$pass')";

         //Run our sql query

           $admin_result = mysql_query ($admin_user)  or die(mysql_error());


//this is where the actual verification happens 
    if(mysql_num_rows($regular_result) == 1){ 
        // store session data for regular user
        $_SESSION['user']=$user;
        $_SESSION['pass']=$pass;
        $_SESSION['admin']=False;

        $studentCheck = "SELECT Student_ID FROM Regular_User INNER JOIN student ON Regular_User.Username = student.Username WHERE Regular_User.Username = '$user'";
        $facultyCheck = "SELECT Instructor_ID FROM Regular_User INNER JOIN faculty ON Regular_User.Username = faculty.Username WHERE Regular_User.Username = '$user'";

        $studentCheckResult = mysql_query ($studentCheck)  or die(mysql_error());
        $facultyCheckResult = mysql_query ($facultyCheck)  or die(mysql_error());

        if(mysql_num_rows($studentCheckResult) == 1){
            $_SESSION['userType'] = "student";
            $_SESSION['id'] = mysql_result($studentCheckResult, 0, "Student_ID");
            $_SESSION['firstTime'] = False;
        }else{
            $_SESSION['userType'] = "faculty";
            $_SESSION['id'] = mysql_result($facultyCheckResult, 0, "Instructor_ID");
            $_SESSION['firstTime'] = False;
        }

        //the ssn matches the ssn of a manager of a department 
        //move them to the page to which they need to go 
        header('Location: homePage.php');
       
    }else if(mysql_num_rows($admin_result) == 1){
        // store session data for admin
        $_SESSION['user']=$user;
        $_SESSION['admin']=True;
        $_SESSION['pass']=$pass;
   
        header('Location: homePage.php'); 

    }else{ 
        $err = 'Invalid Username / Password Combination.' ; 
    } 
    //then just above your login form or where ever you want the error to be displayed you just put in 
    echo "$err";
}


echo "<html>"; 
echo "<head>"; 
echo "</head>"; 
echo "<body>"; 

//login
echo "<form action=\"\" method=\"POST\">"; 
echo "<p>Username:";  
echo "<input name=\"username\" />"; 
echo "</p>"; 
echo "<p>Password:";
echo "<input type=\"password\" name=\"pass\" />"; 
echo "</p>";
echo "<input type=\"submit\" name=\"login\" value=\"Login\" />"; 
echo "</form>";

//create account
echo "<form action=\"create.php\" method=\"POST\">"; 
echo "<input type=\"submit\" name=\"create_account\" value=\"Create Account\" />"; 
echo "</form>";

echo "</body>"; 
echo "</html>"; 
?>

</font>
</center>
</body>
</html>