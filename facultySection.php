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


    $courseName = $_POST['courseName'];
    $_SESSION['courseName'] = $courseName;

    mysql_connect($host,$username,$password, $database) or die( "Unable to connect");
    mysql_select_db($database) or die( "Unable to select database");

    $section_query = "SELECT Letter FROM section WHERE (Course_Title = '$courseName')";
    $section_result = mysql_query ($section_query)  or die(mysql_error());
    $numSections = mysql_num_rows($section_result);


echo "<html>"; 
echo "<head>"; 
echo "</head>"; 
echo "<body>"; 

echo "<form action=\"facultyCourseSubmit.php\" method=\"POST\">"; 

echo "<p> Select a Section of the Course: ";
echo "<select name=\"letter\" >";
    
    for ($i=0; $i < $numSections; $i++) {

        $sectionName = mysql_result($section_result, $i);

        echo "<option value=\"$sectionName\">".$sectionName."</option>";

    }

echo "</select></p>";

echo "<input type=\"submit\" name=\"faculty_section\" value=\"Choose Section\" />"; 
echo "</form>";

echo "</body>"; 
echo "</html>"; 
?>

</font>
</center>
</body>
</html>
