<?php
include 'dbinfo.php'; 
ob_start();
session_start();
?>  


<html>
<title> GTPort - Faculty INFO </title>
<body bgcolor="#000000">  
<center>
<font color="#ffffff">  
<br />
<b><p> Faculty Personal Information </p></b>
<br />

<?php

if(isset($_SESSION['user']))  {     

    $user = $_SESSION['user'];
    $id = $_SESSION['id'];

    if($_SESSION['firstTime'] == True){
    
        //Regular User table
        $name = "";
        $dob = "";
        $gender = "";
        $address = "";
        $permAddress = "";
        $number = "";
        $email = "";

        $department = "";
        $position = "";
        $research = "";


    }else{
        mysql_connect($host,$username,$password, $database) or die( "Unable to connect");
        mysql_select_db($database) or die( "Unable to select database");

        $prevData_query = "SELECT Username, Name, Address, Email_ID, Date_Of_Birth, Permanent_Address, Gender, Contact_No FROM Regular_User WHERE (Username = '$user')";
        $prevData_result = mysql_query ($prevData_query)  or die(mysql_error());

        $faculty_query = "SELECT Dept_ID, Position FROM faculty WHERE (Instructor_ID = '$id')";  
        $faculty_result = mysql_query ($faculty_query)  or die(mysql_error());

        $research_query = "SELECT Research_Interest FROM faculty_research_interests WHERE (Instructor_ID = '$id')";
        $research_result = mysql_query ($research_query)  or die(mysql_error());
        $numResearch = mysql_num_rows($research_result);


        //Regular User table
        $name = mysql_result($prevData_result, 0, "Name");
        $dob = mysql_result($prevData_result, 0, "Date_Of_Birth");
        $gender = mysql_result($prevData_result, 0, "Gender");
        $address = mysql_result($prevData_result, 0, "Address");
        $permAddress = mysql_result($prevData_result, 0, "Permanent_Address");
        $number = mysql_result($prevData_result, 0, "Contact_No");
        $email = mysql_result($prevData_result, 0, "Email_ID");

        //student table
        $department = mysql_result($faculty_result, 0, "Dept_ID");
        $position = mysql_result($faculty_result, 0, "Position");


        $research = "";

        for($i=0; $i<$numResearch; $i++){
            $researchInterest = mysql_result($research_result, $i);
            $research = $research.$researchInterest." ";
        }
        
        
    }

}


echo "<html>"; 
echo "<head>"; 
echo "</head>"; 
echo "<body>"; 

//Update personal info
echo "<form action=\"facultyCourse.php\" method=\"POST\">"; 
echo "<p>Name:";  
echo "<input name=\"name\" value=\"".$name."\"/>"; 
echo "</p>"; 

echo "<p>Date of Birth:";
echo "<input name=\"dob\" value=\"".$dob."\" />"; 
echo "</p>";

echo "<p> Gender:";
echo "<select name=\"gender\" >";

if($gender == "M"){
    echo "<option selected = \"selected\"  value=\"M\"> Male </option>";
    echo "<option value=\"F\"> Female </option></select>";
}else{
    echo "<option value=\"M\"> Male </option>";
    echo "<option selected = \"selected\" value=\"F\"> Female </option></select>";  
}

echo "</p>";

echo "<p>Address:";  
echo "<input name=\"address\" value=\"".$address."\"/>"; 
echo "</p>"; 

echo "<p>Permanent Address:";  
echo "<input name=\"permAddress\" value=\"".$permAddress."\"/>"; 
echo "</p>"; 

echo "<p>Contact Number:";  
echo "<input name=\"number\" value=\"".$number."\"/>"; 
echo "</p>"; 

echo "<p>Email Address:";  
echo "<input name=\"email\" value=\"".$email."\"/>"; 
echo "</p>"; 

echo "<p>Department:";  
echo "<select name=\"department\" >";
echo "<option selected = \"selected\" value=\"".$department."\"> Your Current Department </option>";
echo "<option value=\"AE\"> Aerospace Engineering </option>";
echo "<option value=\"BIO\"> Biology </option>";
echo "<option value=\"BME\"> Biomedical Engineering </option>";
echo "<option value=\"CS\"> Computer Science </option>";
echo "<option value=\"ECE\"> Electrical & Computer Engineering </option></select>";
echo "</p>"; 

echo "<p>Position:";  
echo "<select name=\"position\" >";
echo "<option selected = \"selected\" value=\"".$position."\"> Your Current Position </option>";
echo "<option value=\"Professor\"> Professor </option>";
echo "<option value=\"Associate Professor\"> Associate Professor </option>";
echo "<option value=\"Assistant Professor\"> Assistant Professor </option></select>";
echo "</p>"; 

echo "<p>Research Interests (space seperated):";  
echo "<input name=\"research\" value=\"".$research."\"/>"; 
echo "</p>"; 


echo "<br /><br />";

echo "<input type=\"submit\" name=\"submit_info\" value=\"Submit\" />"; 
echo "</form>";

//create account

echo "<form action=\"homePage.php\" method=\"POST\">";
echo "<input type=\"submit\" name=\"home\" value=\"Home\" />";
echo "</form>";

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
