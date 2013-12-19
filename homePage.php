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




echo "<html>"; 
echo "<head>"; 
echo "</head>"; 
echo "<body>"; 


if($_SESSION['admin']==True){
//create account
    echo "<form action=\"adminReport.php\" method=\"POST\">"; 
    echo "<input type=\"submit\" name=\"Admin_Report\" value=\"View Administrative Report\" />"; 
    echo "</form>";

}else{
    if($_SESSION['userType'] == "student"){
        echo "<form action=\"studentInfo.php\" method=\"POST\">"; 
        echo "<input type=\"submit\" name=\"personal_info\" value=\"Personal Information\" />"; 
        echo "</form>";

        echo "<form action=\"studentServices.php\" method=\"POST\">"; 
        echo "<input type=\"submit\" name=\"stud_services\" value=\"Student Services\" />"; 
        echo "</form>";
    }else{
        echo "<form action=\"facultyInfo.php\" method=\"POST\">"; 
        echo "<input type=\"submit\" name=\"personal_info2\" value=\"Personal Information\" />"; 
        echo "</form>";

        echo "<form action=\"facultyServices.php\" method=\"POST\">"; 
        echo "<input type=\"submit\" name=\"stud_services2\" value=\"Faculty Services\" />"; 
        echo "</form>";

    }

}

        echo "<form action=\"logout.php\" method=\"POST\">";
        echo "<input type=\"submit\" name=\"home\" value=\"Logout\" />";
        echo "</form>";



echo "</body>"; 
echo "</html>"; 
?>

</font>
</center>
</body>
</html>
