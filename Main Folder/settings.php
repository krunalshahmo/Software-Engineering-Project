<?php

  require 'php-sdk/src/facebook.php';


$facebook = new Facebook(array(
  'appId'  => '542850419100800',
  'secret' => '998f621eeb2c44a00ea4d4c91a7d5539',
));

// Get User ID
$user = $facebook->getUser();

?>
<!DOCTYPE HTML>
<HEAD>
<BODY>
<?php
$con=mysqli_connect("localhost","web", "web" ,"userRSS");
// Check connection
if (mysqli_connect_errno())
  {
    die;
  }
if ($user)
{
    $sql="INSERT INTO userPrefs (id, sports, finance, worldnews, entertainment, music, weather, contact)
    VALUES ('$user','$_POST[sports]','$_POST[finannce]', '$_POST[worldnews]', '$_POST[entertainment]', '$_POST[music]', '$_POST[weather]', '$_POST[contact]')
    ON DUPLICATE KEY UPDATE sports='$_POST[sports]', finance='$_POST[finance]', worldnews='$_POST[worldnews]', entertainment='$_POST[entertainment]', music='$_POST[music]',
    weather='$_POST[weather]', contact='$_POST[contact]'";

  if (!mysqli_query($con,$sql))
  {
    echo "Failed to update genre preferences";
    die;
  }

  if ($_POST[feed1] != NULL || $_POST[feed2] != NULL || $_POST[feed3] != NULL || $_POST[feed4] != NULL || $_POST[feed5] != NULL)
  {
    $sql="INSERT INTO myFeeds (id, feed1, feed2, feed3, feed4, feed5)
    VALUES ('$user','$_POST[feed1]','$_POST[feed2]', '$_POST[feed3]', '$_POST[feed4]', '$_POST[feed5]')
    ON DUPLICATE KEY UPDATE feed1='$_POST[feed1]', feed2='$_POST[feed2]', feed3='$_POST[feed3]', feed4='$_POST[feed4]', feed5='$_POST[feed5]'";
  }
  if (!mysqli_query($con,$sql))
  {
    echo "Failed to update myNews feeds";
    die;
  }
}
else
{
  echo "Please log in with facebook!";
  die;
}

mysqli_close($con);
?>
<script>
window.location = 'http://topnews.no-ip.org/home.html';
</script>
</BODY>
</HTML>
