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
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
if ($user && ($_POST[feed1] != NULL || $_POST[feed2] != NULL || $_POST[feed3] != NULL || $_POST[feed4] != NULL || $_POST[feed5] != NULL ))
{
    $sql="INSERT INTO sportsFeeds (id, feed1, feed2, feed3, feed4, feed5)
    VALUES ('$user','$_POST[feed1]','$_POST[feed2]', '$_POST[feed3]', '$_POST[feed4]', '$_POST[feed5]')
    ON DUPLICATE KEY UPDATE feed1='$_POST[feed1]', feed2='$_POST[feed2]', feed3='$_POST[feed3]', feed4='$_POST[feed4]', feed5='$_POST[feed5]'";

  if (!mysqli_query($con,$sql))
  {
    echo "something broke";
    die;
  }
  chdir("../DataMining");
  $output = shell_exec("./DbFetch userRSS web web sportsFeeds $user");
  echo "$output<br/>";

}

else if ($user)
{
  chdir("../DataMining");
  $output = shell_exec("./DbFetch userRSS web web sportsFeeds $user");
  echo "$output<br/>";
}

else {
  echo "please go to out main page and login with facebook!";
}




mysqli_close($con);
?>
</BODY>
</HTML>
