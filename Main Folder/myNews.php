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
if ($user)
{
  chdir("../DataMining");
  $output = shell_exec("./DbFetch userRSS web web myFeeds $user");
  echo "$output<br/>";
}

else {
  echo "please go to out main page and login with facebook!";
}




mysqli_close($con);
?>
</BODY>
</HTML>
