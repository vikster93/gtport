<?php
include 'dbinfo.php'; 
session_start(); 
ob_start();
?>  


<html>
<title> Update Course Info </title>
<body bgcolor="#000000">  
<center>
<font color="#ffffff">  
<br />
<b><p>Update Course Info</p></b>
<br />

<?php


$department = $_POST['department'];

    mysql_connect($host,$username,$password, $database) or die( "Unable to connect");
    mysql_select_db($database) or die( "Unable to select database");

    $course_query = "SELECT Course_Title FROM offers WHERE (Dept_ID = '$department')";
    $course_result = mysql_query ($course_query)  or die(mysql_error());
    $numCourses = mysql_num_rows($course_result);

if($_SESSION['firstTime'] == True){

    $user = $_SESSION['user'];
    $pass = $_SESSION['pass'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $permAddress = $_POST['permAddress'];
    $gender = $_POST['gender'];
    $number = $_POST['number'];
    
    $department = $_POST['department'];
    $position = $_POST['position'];

    $facultyInsert = "INSERT INTO `cs4400_Group22`.`faculty` (`Instructor_ID`, `Username`, `Dept_ID`, `Position`) VALUES (NULL, '$user', '$department', '$position')";

    mysql_query ($facultyInsert)  or die(mysql_error());

    $regular_user_insert = "INSERT INTO `cs4400_Group22`.`Regular_User` (`Username`, `Password`, `Name`, `Address`, `Email_ID`, `Date_Of_Birth`, `Permanent_Address`, `Gender`, `Contact_No`) VALUES ('$user', '$pass', '$name', '$address', '$email', '$dob', '$permAddress', '$gender', '$number')";

    mysql_query ($regular_user_insert)  or die(mysql_error());

    //research interests

    $get_id = "SELECT Instructor_ID FROM faculty WHERE (Username = '$user')"; 
    $id_result = mysql_query ($get_id)  or die(mysql_error());
    $_SESSION['id'] = mysql_result($id_result, 0, "Instructor_ID");
    $id = $_SESSION['id'];

    $researchString = $_POST['research'];
    $researchArray = str_split($researchString);

    $currentResearch = "";

    foreach($researchArray as $char){
        if($char == " "){

            $researchInsert = "INSERT INTO `cs4400_Group22`.`faculty_research_interests` (`Instructor_ID`, `Research_Interest`) VALUES ('$id', '$currentResearch')";

            mysql_query($researchInsert);

            $currentResearch = "";
        }else{
            $currentResearch = $currentResearch.$char;
        }
    }

    $_SESSION['firstTime'] = False;


}else{

    $user = $_SESSION['user'];
    $pass = $_SESSION['pass'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $email = $_POST['email'];
    $dob = $_POST['dob'];
    $permAddress = $_POST['permAddress'];
    $gender = $_POST['gender'];
    $number = $_POST['number'];
    $id = $_SESSION['id'];
    
    $department = $_POST['department'];
    $position = $_POST['position'];

    $facultyUpdate = "UPDATE `cs4400_Group22`.`faculty` SET `Instructor_ID` = '$id', `Username` = '$user', `Dept_ID` = '$department', `Position` = '$position' WHERE (Instructor_ID = '$id')";

    mysql_query ($facultyUpdate)  or die(mysql_error());

        $regular_user_update = "UPDATE `cs4400_Group22`.`Regular_User` SET `Username` = '$user', `Password` = '$pass', `Name` = '$name', `Address` = '$address', `Email_ID` = '$email', `Date_Of_Birth` = '$dob', `Permanent_Address` = '$permAddress', `Gender` = '$gender', `Contact_No` = '$number' WHERE (Username = '$user')";

        mysql_query ($regular_user_update)  or die(mysql_error());

    //research interests

    $deleteResearch = "DELETE FROM faculty_research_interests WHERE (Instructor_ID='$id')";
    mysql_query($deleteResearch);



    $researchString = $_POST['research'];
    $researchArray = str_split($researchString);

    $currentResearch = "";

    foreach($researchArray as $char){
        if($char == " "){

            $researchInsert = "INSERT INTO `cs4400_Group22`.`faculty_research_interests` (`Instructor_ID`, `Research_Interest`) VALUES ('$id', '$currentResearch')";

            mysql_query($researchInsert);

            $currentResearch = "";
        }else{
            $currentResearch = $currentResearch.$char;
        }
    }


}



echo "<html>"; 
echo "<head>"; 
echo "</head>"; 
echo "<body>"; 

echo "<form action=\"facultySection.php\" method=\"POST\">"; 

echo "<p> Select a Course from your Department: ";
echo "<select name=\"courseName\" >";
    
    for ($i=0; $i < $numCourses; $i++) {

        $courseName = mysql_result($course_result, $i, "Course_Title");

        echo "<option value=\"$courseName\">".$courseName."</option>";

    }

echo "</select></p>";

echo "<input type=\"submit\" name=\"faculty_section\" value=\"Choose Course\" />"; 
echo "</form>";

//create account
echo "<form action=\"homePage.php\" method=\"POST\">"; 
echo "<input type=\"submit\" name=\"return_home\" value=\"Return to Home\" />"; 
echo "</form>";

echo "</body>"; 
echo "</html>"; 
?>

</font>
</center>
</body>
</html>
