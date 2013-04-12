<!DOCTYPE HTML>
<HEAD>
<BODY>
<?php
$con=mysqli_connect("localhost","web", "web" ,"userRSS");
// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

$sql="INSERT INTO sportsFeeds (id, feed1, feed2, feed3, feed4, feed5)
VALUES
('$_POST[id]','$_POST[feed1]','$_POST[feed2]', '$_POST[feed3]', '$_POST[feed4]', '$_POST[feed5]')";

if (!mysqli_query($con,$sql))
  {
  die('Error: ' . mysqli_error());
  }
echo "1 record added";

mysqli_close($con);
?>
</BODY>
</HTML>
