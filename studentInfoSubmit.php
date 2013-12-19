<?php
//retrieve session data    
  session_start();  
//echo "Manager SSN is  ". $_SESSION['manager'] . "<br />";
 $manager = $_SESSION['manager'];  
?>



<?php
include 'dbinfo.php' ; 
?>  

<html>
<head>
<title> Info Updated  </title>
</head>


<body bgcolor="#000000">
<center>
<font color="#ffffff">
<p> Student Personal Information Has Been Successfully Updated! </p>
<br /><br />

<?php
  
  if($_SESSION['firstTime'] == True){
        mysql_connect($host,$username,$password, $database) or die( "Unable to connect");
        mysql_select_db($database) or die( "Unable to select database");

        $major = $_POST['major'];
        $degree = $_POST['degree'];
        $user = $_SESSION['user'];
        $pass = $_SESSION['pass'];
        $name = $_POST['name'];
        $address = $_POST['address'];
        $email = $_POST['email'];
        $dob = $_POST['dob'];
        $permAddress = $_POST['permAddress'];
        $gender = $_POST['gender'];
        $number = $_POST['number'];

        if($_POST['tutoring'] == "yes"){
          $tutoring = 1;
        }else{
          $tutoring =0;
        } 

        $student_insert = "INSERT INTO `cs4400_Group22`.`student` (`Student_ID`, `Major`, `Degree`, `Username`, `Tutor`) VALUES (NULL, '$major', '$degree', '$user', '$tutoring')";

        mysql_query ($student_insert)  or die(mysql_error());

        $regular_user_insert = "INSERT INTO `cs4400_Group22`.`Regular_User` (`Username`, `Password`, `Name`, `Address`, `Email_ID`, `Date_Of_Birth`, `Permanent_Address`, `Gender`, `Contact_No`) VALUES ('$user', '$pass', '$name', '$address', '$email', '$dob', '$permAddress', '$gender', '$number')";

        mysql_query ($regular_user_insert)  or die(mysql_error());

        //prior education.

          $get_id = "SELECT Student_ID FROM student WHERE (Username = '$user')"; 
          $id_result = mysql_query ($get_id)  or die(mysql_error());
          $_SESSION['id'] = mysql_result($id_result, 0, "Student_ID");

          $id = $_SESSION['id'];


        if($_POST['priorInstitution']!=""){
          $priorInstitution = $_POST['priorInstitution'];
          $priorMajor = $_POST['priorMajor'];
          $priorDegree = $_POST['priorDegree'];
          $priorGraduation = $_POST['priorGraduation'];
          $priorGPA = $_POST['priorGPA'];

          $education_history_insert ="INSERT INTO `cs4400_Group22`.`education_history` (`Student_ID`, `Name_Of_School`, `Year_Graduation`, `Degree`, `Major`, `GPA`) VALUES ('$id', '$priorInstitution', '$priorGraduation', '$priorDegree', '$priorMajor', '$priorGPA')";

          mysql_query ($education_history_insert)  or die(mysql_error());

        }

        $_SESSION['firstTime'] = False;

  }else{
        mysql_connect($host,$username,$password, $database) or die( "Unable to connect");
        mysql_select_db($database) or die( "Unable to select database");

        $major = $_POST['major'];
        $degree = $_POST['degree'];
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

        if($_POST['tutoring'] == "yes"){
          $tutoring = 1;
        }else{
          $tutoring =0;
        } 

        $student_update = "UPDATE `cs4400_Group22`.`student` SET `Student_ID` = '$id', `Major` = '$major', `Degree` = '$degree', `Username` = '$user', `Tutor` = '$tutoring' WHERE (Student_ID = '$id')";

        mysql_query ($student_update)  or die(mysql_error());

        $regular_user_update = "UPDATE `cs4400_Group22`.`Regular_User` SET `Username` = '$user', `Password` = '$pass', `Name` = '$name', `Address` = '$address', `Email_ID` = '$email', `Date_Of_Birth` = '$dob', `Permanent_Address` = '$permAddress', `Gender` = '$gender', `Contact_No` = '$number' WHERE (Username = '$user') ";

        mysql_query ($regular_user_update)  or die(mysql_error());

        //prior education.

        if($_POST['priorInstitution']!=""){
          $priorInstitution = $_POST['priorInstitution'];
          $priorMajor = $_POST['priorMajor'];
          $priorDegree = $_POST['priorDegree'];
          $priorGraduation = $_POST['priorGraduation'];
          $priorGPA = $_POST['priorGPA'];

          $education_history_insert ="INSERT INTO `cs4400_Group22`.`education_history` (`Student_ID`, `Name_Of_School`, `Year_Graduation`, `Degree`, `Major`, `GPA`) VALUES ('$id', '$priorInstitution', '$priorGraduation', '$priorDegree', '$priorMajor', '$priorGPA')";

          mysql_query ($education_history_insert)  or die(mysql_error());

        }

        if($tutoring == 1 && isset($_POST['tutorCourse'])){

          $courseTitle = $_POST['tutorCourse'];

          $tutor_check_query = "SELECT Student_ID
                                FROM application_for_tutoring
                                WHERE application_for_tutoring.Student_ID = '$id'";

          $tutor_check = mysql_query($tutor_check_query);

          if (mysql_num_rows($tutor_check)==0) {

            $apply_tutor = "INSERT INTO `cs4400_Group22`.`application_for_tutoring` (`Student_ID`, `Course_Title`) VALUES ('$id', '$courseTitle')";
            mysql_query ($apply_tutor)  or die(mysql_error());

          }

          else {

            $tutor_update_query = "UPDATE `cs4400_Group22`.`application_for_tutoring` SET `Student_ID` = '$id', `Course_Title` = '$courseTitle' WHERE (`Student_ID` = '$id')";
          }

        }

  }
  
?>
  

<form action="homePage.php" method="post">
  <input type="submit" value="Return to Home Page" name="submit">
</form>

