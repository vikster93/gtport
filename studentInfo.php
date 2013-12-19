<?php
include 'dbinfo.php'; 
ob_start();
session_start();
?>  


<html>
<title> GTPort - STUDENT INFO </title>
<body bgcolor="#000000">  
<center>
<font color="#ffffff">  
<br />
<b><p> Student Personal Information </p></b>
<br />

<?php

if(isset($_SESSION['user']))  {     

    $user = $_SESSION['user'];

    if($_SESSION['firstTime'] == True){
    
        //Regular User table
        $name = "";
        $dob = "";
        $gender = "";
        $address = "";
        $permAddress = "";
        $number = "";
        $email = "";
        //student table
        $tutoring = "";
        $major = "";
        $degree = ""; 


    }else{
        $id = $_SESSION['id'];

        mysql_connect($host,$username,$password, $database) or die( "Unable to connect");
        mysql_select_db($database) or die( "Unable to select database");

        $prevData_query = "SELECT Username, Name, Address, Email_ID, Date_Of_Birth, Permanent_Address, Gender, Contact_No FROM Regular_User WHERE (Username = '$user')";
        $prevData_result = mysql_query ($prevData_query)  or die(mysql_error());

        $student_query = "SELECT Major, Degree, Tutor FROM student WHERE (Student_ID = '$id')";  
        $student_result = mysql_query ($student_query)  or die(mysql_error());

        $tutorable_query = "SELECT Student_ID, section.CRN, section.Course_Title 
                            FROM registers INNER JOIN section ON registers.CRN=section.CRN 
                            WHERE (Student_ID = $id AND (Grade_Received = 'A' OR Grade_Received = 'B'))";
        $tutorable_result = mysql_query ($tutorable_query)  or die(mysql_error());

        $numCourses = mysql_num_rows($tutorable_result);

        //Regular User table
        $name = mysql_result($prevData_result, 0, "Name");
        $dob = mysql_result($prevData_result, 0, "Date_Of_Birth");
        $gender = mysql_result($prevData_result, 0, "Gender");
        $address = mysql_result($prevData_result, 0, "Address");
        $permAddress = mysql_result($prevData_result, 0, "Permanent_Address");
        $number = mysql_result($prevData_result, 0, "Contact_No");
        $email = mysql_result($prevData_result, 0, "Email_ID");

        //student table
        $tutoring = mysql_result($student_result, 0, "Tutor");
        $major = mysql_result($student_result, 0, "Major");
        $degree = mysql_result($student_result, 0, "Degree"); 
        
    }

}


echo "<html>"; 
echo "<head>"; 
echo "</head>"; 
echo "<body>"; 

//Update personal info
echo "<form action=\"studentInfoSubmit.php\" method=\"POST\">"; 
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

echo "<p> Willing to tutor?:";
echo "<select name=\"tutoring\" >";
echo "<option value=\"yes\"> Yes </option>";
echo "<option value=\"no\"> No </option></select>";
echo "</p>";

echo "<p> If Yes, select the course you would like to tutor for: ";
echo "<select name=\"tutorCourse\" >";
    
    for ($i=0; $i < $numCourses; $i++) {

        $courseName = mysql_result($tutorable_result, $i, "Course_Title");

        echo "<option value=\"$courseName\">".$courseName."</option>";

    }

echo "</select></p>";

echo "<p>Major:";  
echo "<select name=\"major\" >";
echo "<option selected = \"selected\" value=\"".$major."\"> Your Current Major </option>";
echo "<option value=\"Aerospace Engineering\"> Aerospace Engineering </option>";
echo "<option value=\"Biology\"> Biology </option>";
echo "<option value=\"Biomedical Engineering\"> Biomedical Engineering </option>";
echo "<option value=\"Computer Science\"> Computer Science </option>";
echo "<option value=\"Electrical & Computer Engineer\"> Electrical & Computer Engineering </option></select>";
echo "</p>"; 

echo "<p> Degree:";
echo "<select name=\"degree\" >";
if($degree == "BS"){
    echo "<option selected = \"selected\" value=\"BS\"> BS </option>";
    echo "<option value=\"MS\"> MS </option>";
    echo "<option value=\"Ph.D.\"> Ph.D. </option></select>";
}else if($degree == "MS"){
    echo "<option value=\"BS\"> BS </option>";
    echo "<option selected = \"selected\" value=\"MS\"> MS </option>";
    echo "<option value=\"Ph.D.\"> Ph.D. </option></select>";
}else{
    echo "<option value=\"BS\"> BS </option>";
    echo "<option value=\"MS\"> MS </option>";
    echo "<option selected = \"selected\" value=\"Ph.D.\"> Ph.D. </option></select>";    
}
echo "</p>";

//PREVIOUS EDU

echo "PREVIOUS EDUCATION";

echo "<p>Name of Institution Attended:";  
echo "<input name=\"priorInstitution\" />"; 
echo "</p>"; 

echo "<p>Major:";  
echo "<input name=\"priorMajor\" />"; 
echo "</p>"; 

echo "<p> Degree:";
echo "<select name=\"priorDegree\" >";
echo "<option value=\"BS\"> BS </option>";
echo "<option value=\"MS\"> MS </option>";
echo "<option value=\"Ph.D.\"> Ph.D. </option></select>"; 
echo "</p>";  

echo "<p>Year of graduation:";  
echo "<input name=\"priorGraduation\" />"; 
echo "</p>"; 

echo "<p>GPA:";  
echo "<input name=\"priorGPA\" />"; 
echo "</p>"; 

echo "<br /><br />";

echo "<input type=\"submit\" name=\"submit_info\" value=\"Submit\" />"; 
echo "</form>";

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
