<?php

  require 'php-sdk/src/facebook.php';


$facebook = new Facebook(array(
  'appId'  => '542850419100800',
  'secret' => '998f621eeb2c44a00ea4d4c91a7d5539',
));

// Get User ID
$user = $facebook->getUser();

?>
<html>
 <body>
<?php
if ($user) {
  try {
    // Get the user profile data you have permission to view
    $user_profile = $facebook->api('/me');
    echo "<pre>";
    print_r($user_profile);
    echo "</pre>";
  } catch (FacebookApiException $e) {
    $user = null;
  }
} else {
  die('<script>top.location.href="'.$facebook->getLoginUrl().'";</script>');
}

echo 'this should always work';

 ?>
 </body>
</html>
