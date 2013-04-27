<?php

  require 'php-sdk/src/facebook.php';


$facebook = new Facebook(array(
  'appId'  => '542850419100800',
  'secret' => '998f621eeb2c44a00ea4d4c91a7d5539',
));

// Get User ID
$user = $facebook->getUser();

?>


<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Top News</title>

<link href="default.css" rel="stylesheet" type="text/css" media="screen" />
<script type="text/javascript" src="jquery.js"></script>
<script type="text/javascript" src="sliding_effects.js"></script>
</head>
<body>

<div id="fb-root"></div>
<script>
  // Additional JS functions here
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '542850419100800', // App ID
      channelUrl : '//topnews.no-ip.org/channel.html', // Channel File
      status     : true, // check login status
      cookie     : true, // enable cookies to allow the server to access the session
      xfbml      : true  // parse XFBML
    });

    // Additional init code here
    FB.getLoginStatus(function(response) {
      if (response.status === 'connected') {
        // connected
        testAPI();
      } else if (response.status === 'not_authorized') {
        // not_authorized
        login();
      } else {
        login();
        // not_logged_in
      }
    });

  };

  function login() {
      FB.login(function(response) {
          if (response.authResponse) {
              // connected
          } else {
              // cancelled
          }
      });
  }

  function testAPI() {
    console.log('Welcome!  Fetching your information.... ');
    FB.api('/me', function(response) {
        console.log('Good to see you, ' + response.name + '.');
    });
  }

  // Load the SDK Asynchronously
  (function(d){
     var js, id = 'facebook-jssdk', ref = d.getElementsByTagName('script')[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement('script'); js.id = id; js.async = true;
     js.src = "//connect.facebook.net/en_US/all.js";
     ref.parentNode.insertBefore(js, ref);
   }(document));
</script>



<div class="container">
<div id="header"><img src="Top News Logo.jpg" alt="Top News" width="211" height="99" align="left" />
  <ul>
    <p class="slogan">&nbsp;</p>
    <p class="slogan">&quot;More News. More Often.&quot; </p>
    <hr width="78%" />
  </ul>
</div>	

<div id="page">
  <div class="title">
      <form method="get" action="http://search.freefind.com/find.html" id="search" target="main">
        <p>
        <input type="hidden" name="si" value="20115984" />
        <input type="hidden" name="pid" value="r" />
        <input type="hidden" name="n" value="0" />
        <input type="hidden" name="_charset_" value="" />
        <input type="hidden" name="bcd" value="÷" />
        <input type="text" name="query" size="40" placeholder="Search for headlines..." />
      </p>
    </form>
  </div>
<div id="ads" align="left">
  <form>
    <ul id="sidebar">
      <input type="checkbox" name="check" onclick="toggle(this.form.check, 'index');" checked="checked" />
        <li id="index" class="sidebar-element" style="visibility:visible"><a href="index.php">Home</a></li>
        <li id="mynews" class="sidebar-element" style="visibility:visible"><a href="myNews.php" target="main">My News</a></li>

        <?php
           $con=mysqli_connect("localhost","web", "web" ,"userRSS");
           // Check connection
           if (mysqli_connect_errno())
           {
             echo "Failed to connect to MySQL: " . mysqli_connect_error();
           }
           if ($user)
           {
             $sql="SELECT * FROM userPrefs where id='$user'";
             $result = mysqli_query($con,$sql);
             $result = mysqli_fetch_array($result);
             if ($result['sports'] == '1')
             {
               echo '<li id="sports" class="sidebar-element" style="visibility:visible"><a href="espn.html" target="main">Sports</a></li>';
             }
             if ($result['finance'] == '1')
             {
               echo '<li id="finance" class="sidebar-element" style="visibility:visible"><a href="finance.html" target="main">Finance</a></li>';
             }
             if ($result['worldnews'] == '1')
             {
               echo '<li id="worldnews" class="sidebar-element" style="visibility:visible"><a href="worldnews.html" target="main">World News</a></li>';
             }
             if ($result['entertainment'] == '1')
             {
               echo '<li id="entertainment" class="sidebar-element" style="visibility:visible"><a href="entertainment.html" target="main">Entertainment</a></li>';
             }
             if ($result['music'] == '1')
             {
               echo '<li id="music" class="sidebar-element" style="visibility:visible"><a href="music.html" target="main">Music</a></li>';
             }
             if ($result['weather'] == '1')
             {
               echo '<li id="weather" class="sidebar-element" style="visibility:visible"><a href="weather.html" target="main">Weather</a></li>';
             }
             if ($result['contact'] == '1')
             {
               echo '<li class="sidebar-element" style="visibility:visible"><a href="contact.html" target="main">Contact Us</a></li>';
             }
           }
        ?>
        <li class="sidebar-element" style="visibility:visible"><a href="settings.html" target="main">Settings</a></li>
        <div class="fb-login-button" data-show-faces="true" data-width="200" data-max-rows="1"></div>
        <div class="fb-like" data-href="http://topnews.no-ip.org" data-send="false" data-layout="button_count" data-width="450" data-show-faces="true"></div>

  	</ul>
  </form>
</div>
  
  <script>
        function toggle(check, id)
        { if(!check.checked)
        {
        document.getElementById(id).style.visibility='hidden';
        }
        else
        {
        document.getElementById(id).style.visibility='visible';
        }
        }
  </script>
<div id="content">
	<iframe name="main" 
	src="home.html" 
    iframe width="100%"
    scrolling="yes"
    height="500"
	frameborder="0">
   </iframe>
</div>

<div id="footer">
	&copy; 2013 Top News &bull;&nbsp;Developed by Krunal Shah, Landon Vance, Nick Kacena, Jakob Klinger
</div>

</div>

</body>
</html>
