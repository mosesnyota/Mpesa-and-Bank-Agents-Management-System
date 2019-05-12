<?php
    // Initialize the session.
   session_start();
    
   // Unset all of the session variables.
    $_SESSION = array();
    
    // If it's desired to kill the session, also delete the session cookie.
    // Note: This will destroy the session, and not just the session data!
    if (isset($_COOKIE[session_name()])) {
       setcookie(session_name(), '', time()-988888888888000, '/');
    }
    
    // Finally, destroy the session.
    session_destroy();

?>

<!DOCTYPE html>
<html lang="en" >

<head>
   

  <meta charset="UTF-8">
  <title>ProNet ERP</title>
  
  <link rel="stylesheet" href="login/css/normalize.min.css">
  <link rel='stylesheet' href='login/css/foundation.min.css'>
  <link rel='stylesheet' href='login/css/font-awesome.min.css'>

      <style>
      /* NOTE: The styles were added inline because Prefixfree needs access to your styles and they must be inlined if they are on local disk! */
@import url(css.css);
@import url(css2.css);
input[type=password]::-ms-reveal, input[type=password]::-ms-clear {
  display: none;
}

/* Removing this since I'll add it myself for browser compatibility */
input[type="text"], input[type="password"], input[type="submit"] {
  -webkit-border-top-left-radius: 360px;
  -moz-border-top-left-radius: 360px;
  -ms-border-top-left-radius: 360px;
  border-top-left-radius: 360px;
  -webkit-border-top-right-radius: 360px;
  -moz-border-top-right-radius: 360px;
  -ms-border-top-right-radius: 360px;
  border-top-right-radius: 360px;
  -webkit-border-bottom-left-radius: 360px;
  -moz-border-bottom-left-radius: 360px;
  -ms-border-bottom-left-radius: 360px;
  border-bottom-left-radius: 360px;
  -webkit-border-bottom-right-radius: 360px;
  -moz-border-bottom-right-radius: 360px;
  -ms-border-bottom-right-radius: 360px;
  border-bottom-right-radius: 360px;
}

input[type="text"], input[type="password"] {
  padding-left: 2.75em;
}

input[type="submit"] {
  width: 100%;
  background-color: #003b64;
  color: white;
  border: 0;
  padding: 8px;
  -webkit-transition: all 0.25s ease-in-out;
  -moz-transition: all 0.25s ease-in-out;
  -ms-transition: all 0.25s ease-in-out;
  -o-transition: all 0.25s ease-in-out;
  transition: all 0.25s ease-in-out;
}

input[type="submit"]:hover {
  background-color: #1677bb;
}

label {
  display: inline;
  position: absolute;
  top: 0.65em;
  left: 2.30em;
  color: #999999;
}

form {
  position: relative;
  top: 50%;
  -webkit-transform: translateY(-50%);
  -ms-transform: translateY(-50%);
  transform: translateY(-50%);
}

form .row .row {
  margin: 0 -0.9375rem;
}

body {
  color: #999999;
  background-image: url("background.jpg");
  background-size: cover;
}

p.intro1, p.intro2 {
  text-align: center;
  color: white;
  font-size: 0.9em;
  margin-bottom: 40px;
  font-family: 'Open Sans';
}

p.intro2 {
  opacity: 0;
}

.wrapper, .morphHeader {
  font-family: "Montserrat", Helvetica, Arial, sans-serif;
  background-color: #f2f2f2;
  -webkit-border-top-left-radius: 6px;
  -moz-border-top-left-radius: 6px;
  -ms-border-top-left-radius: 6px;
  border-top-left-radius: 6px;
  -webkit-border-top-right-radius: 6px;
  -moz-border-top-right-radius: 6px;
  -ms-border-top-right-radius: 6px;
  border-top-right-radius: 6px;
  -webkit-border-bottom-left-radius: 6px;
  -moz-border-bottom-left-radius: 6px;
  -ms-border-bottom-left-radius: 6px;
  border-bottom-left-radius: 6px;
  -webkit-border-bottom-right-radius: 6px;
  -moz-border-bottom-right-radius: 6px;
  -ms-border-bottom-right-radius: 6px;
  border-bottom-right-radius: 6px;
}

.header, .footer, .morphHeader {
  text-align: center;
  text-transform: uppercase;
}

.header, .morphHeader {
  -webkit-border-top-left-radius: 6px;
  -moz-border-top-left-radius: 6px;
  -ms-border-top-left-radius: 6px;
  border-top-left-radius: 6px;
  -webkit-border-top-right-radius: 6px;
  -moz-border-top-right-radius: 6px;
  -ms-border-top-right-radius: 6px;
  border-top-right-radius: 6px;
  -webkit-border-bottom-left-radius: 0;
  -moz-border-bottom-left-radius: 0;
  -ms-border-bottom-left-radius: 0;
  border-bottom-left-radius: 0;
  -webkit-border-bottom-right-radius: 0;
  -moz-border-bottom-right-radius: 0;
  -ms-border-bottom-right-radius: 0;
  border-bottom-right-radius: 0;
  font-size: 1.7em;
  background-image: url("backgroundBox.png");
  padding: 2em;
  color: white;
}

.username {
  padding-top: 1.25rem;
}

.submit, .footer {
  padding-bottom: 1.25rem;
}

.morphButton {
  z-index: 999;
  -webkit-border-top-left-radius: 360px;
  -moz-border-top-left-radius: 360px;
  -ms-border-top-left-radius: 360px;
  border-top-left-radius: 360px;
  -webkit-border-top-right-radius: 360px;
  -moz-border-top-right-radius: 360px;
  -ms-border-top-right-radius: 360px;
  border-top-right-radius: 360px;
  -webkit-border-bottom-left-radius: 360px;
  -moz-border-bottom-left-radius: 360px;
  -ms-border-bottom-left-radius: 360px;
  border-bottom-left-radius: 360px;
  -webkit-border-bottom-right-radius: 360px;
  -moz-border-bottom-right-radius: 360px;
  -ms-border-bottom-right-radius: 360px;
  border-bottom-right-radius: 360px;
}

.morphButton, .morphHeader {
  opacity: 0;
  background-color: #1677bb;
  text-align: center;
}

.loading, .success, .failure {
  color: white;
  line-height: 34px !important;
  text-align: center;
}

.tooltip p {
  font-family: 'Open Sans';
  font-size: 13px;
  line-height: 16px;
}

.columns {
  position: relative;
}

    </style>

    <script src="prefixfree.min.js"></script>

</head>

<body>


<form method="post" autocomplete="off">
	
	<div class="row">
		<div class="wrapper large-4 columns large-centered small-6 small-centered">
			<div class="row header">
				<div class="large-12 columns">SIGN IN</div>
			</div>

			<div class="row username">
				<div class="large-9 columns large-centered">
					<label for="username"><i class="fa fa-user"></i></label>
					<input id="username" type="text" name="username" placeholder="username" required autocomplete="off" />
				</div>
			</div>

			<div class="row password">
				<div class="large-9 columns large-centered">
					<label for="password"><i class="fa fa-lock"></i></label>
					<input id="password" type="password" name="pass" placeholder="password" required autocomplete="off" />
				</div>
			</div>

			<div class="row submit">
				<div class="large-9 columns large-centered">
					<input type="submit" value="SUBMIT">
				</div>
			</div>
		</div>
	</div>
</form>



<span class="morphHeader"><span>SIGN IN</span></span>
  <script src='login/js/jquery-2.2.4.min.js'></script>
<script src='login/js/TweenMax.min.js'></script>

  
    <script type="text/javascript" src="login/js/index.js?<?php echo time(); ?>"></script>
    
</body>

</html>
