<?php
session_start();
?>

<html>
<title> GTPort </title>
<body bgcolor="#000000">  
<center>
<font color="#ffffff">  
<br />
<b><p>Logged Out Successfully!</p></b>
<br />

<?php

echo "<html>"; 
echo "<head>"; 
echo "</head>"; 
echo "<body>"; 

echo "<form action=\"index.php\" method=\"POST\">";
echo "<input type=\"submit\" name=\"home\" value=\"Back to Login\" />";
echo "</form>";
echo "</body>"; 
echo "</html>";

?>

<?php 
session_destroy(); 
?> 

</font>
</center>
</body>
</html>