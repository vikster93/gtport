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
<p> You have registered for the following courses! </p>
<br /><br />


<table border="1" cellspacing="2" cellpadding="2">
<tr>
<th><font color="#ffffff" face="Arial, Helvetica, sans-serif">Course Code  </font></th>
<th><font color="#ffffff" face="Arial, Helvetica, sans-serif">Title  </font></th>
<th><font color="#ffffff" face="Arial, Helvetica, sans-serif">Section </font></th>
<th><font color="#ffffff" face="Arial, Helvetica, sans-serif">Mode of Grading</font></th>
</tr>

<?php   
  
echo $_POST['0'];

  mysql_connect($host,$username,$password, $database) or die( "Unable to connect");
  mysql_select_db($database) or die( "Unable to select database");

$id = $_SESSION['id'];

$departmentQuery = "SELECT Major FROM student WHERE (Student_ID = '$id')"; 
$departmentResult = mysql_query($departmentQuery);
$major = mysql_result($departmentResult, 0);

$dept_id_query = "SELECT Dept_ID FROM department WHERE (Dept_Name = '$major')";
$deptResult = mysql_query($dept_id_query);
$dept_id = mysql_result($deptResult, 0);

          $courses_query2 = " SELECT      section.CRN, section.Course_Title, course_code.Code, section.Letter, Regular_User.Name, section.Day, 
                                          section.Time, section.Location 
                              FROM        section INNER JOIN course_code ON course_code.Course_Title=section.Course_Title 
                                          INNER JOIN faculty ON section.Instructor_ID=faculty.Instructor_ID 
                                          INNER JOIN Regular_User ON faculty.Username=Regular_User.Username WHERE (Dept_ID = '$dept_id') ";

          $courses_result = mysql_query($courses_query2);

  $numCourses = mysql_num_rows($courses_result);

  $i = 0;



$numCourses = 1;

  while($i < $numCourses){

 
    if($_POST['isSelected$i'] != "selected"){

          $mode = "Letter";
          $title = "Matlab";
          $section = "A";
          $courseCode = "CS1371";

          /*
          $mode = $_POST['mode$i'];
          $title = mysql_result($courses_result,$i, "Course_Title");
          $section = mysql_result($courses_result, $i,"Letter");
          $courseCode = mysql_result($courses_result, $i,"Code");
          */
    }


 ?>

<tr>
<td><font color="#ffffff" face="Arial, Helvetica, sans-serif"><?php echo $courseCode; ?></font></td>
<td><font color="#ffffff" face="Arial, Helvetica, sans-serif"><?php echo $title; ?></font></td>
<td><font color="#ffffff" face="Arial, Helvetica, sans-serif"><?php echo $section; ?></font></td>
<td><font color="#ffffff" face="Arial, Helvetica, sans-serif"><?php echo $mode; ?></font></td>
</tr>


<?php
             $i++;
          }

 ?>

</table>   


<form action="homePage.php" method="post">
  <input type="submit" value="Return to Home Page" name="submit">
</form>

