<?php
 
// grab recaptcha library
//require_once "recaptchalib.php";

// your secret key
//$secret = "6LcDnhwTAAAAALCXJ8oQnge0bEV1K3jRQadsD_aM";
 
// empty response
//$response = null;
 
// check secret key
//$reCaptcha = new ReCaptcha($secret);

// if submitted check response
//if ($_POST["g-recaptcha-response"]) {
   // $response = $reCaptcha->verifyResponse(
   //     $_SERVER["REMOTE_ADDR"],
   //     $_POST["g-recaptcha-response"]
  //  );
//}
 
?>

<?php
 
if(isset($_POST['action'])) {
 
 
    $email_to = "justinivip@gmail.com";
 
    $email_from = $_POST['email']; // required
 
    $message = $_POST['message']; // required
    
    $subject = $_POST['subject'];
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
    
    if (empty($_POST['email']) || empty($_POST['message']) || empty($_POST['subject'])) {
        echo '<script language="javascript">';
        echo 'alert("Error, please go back and check you have filled in all the required(*) fields.")';
        echo '</script>';
        echo '<script language="javascript">';
        echo 'window.location = "http://filezekk.tk"';
        echo '</script>';
    }
    
    $email_message = "FiLeZekk Contact Form.\n\n";
    
    $email_message .= "Form details below.\n\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
    
    $email_message .= "Subject: ".clean_string($subject)."\n";
 
    $email_message .= "Message: ".clean_string($message)."\n\n";
    
    $email_message .= "From: ".clean_string($email_from)."\n";
    
    $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    
    if (empty($_POST['copy'])) {
        @mail($email_to, $subject, $email_message, $headers); 
    }
    
    else {
       @mail($email_to, $subject, $email_message, $headers);  
       @mail($email_from, $subject, $email_message, $headers); 
    }
     
?>

<!--Page to go to once php has been executed-->
<!DOCTYPE HTML>
<html lang="en">
	<head>
		<title>Legacy47</title>
		<meta charset="utf-8" />
        <meta name="description" content="">
        <meta name="author" content="">
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->     
        <!-- Favicon-->
        <link rel="apple-touch-icon" sizes="57x57" href="images/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60" href="images/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72" href="images/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76" href="images/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114" href="images/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120" href="images/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144" href="images/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152" href="images/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180" href="images/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"  href="images/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32" href="images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96" href="images/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16" href="images/favicon/favicon-16x16.png">
        <link rel="manifest" href="assets/json/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage" content="images/favicon/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
	</head>
	<body>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Header -->
					<header id="header" class="alt">
						<span class="logo"><img src="images/logo.png" alt="" /></span>
						<h1>Legacy47</h1>
						<p>Rhythm &#160;+&#160; &#60;Code&#62; &#160;+&#160; Gaming &#160;→&#160; ~Legacy 47~</p>
					</header>

				<!-- Nav -->
					<nav id="nav">
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><a href="projects.html">Projects</a></li>
                        </ul>
					</nav>

				<!-- Main -->
					<div id="main">

						<!-- Introduction -->
							<section id="intro" class="main">
								<div class="spotlight">
									<div class="content">
										<header class="major">
                                            <h2>Thank you for submitting you Form!</h2>
										</header>
										<ul class="actions">
											<!--<li><a href="generic.html" class="button">Learn More</a></li>-->
										</ul>
									</div>
									<span class="image"><img src="images/legacy47.png" alt="" /></span>
								</div>
							</section>
					</div>

				<!-- Footer -->
					<footer id="footer">
						<section>
							<h2>Connections</h2>
							<dl class="alt">
                                <dt>Steam</dt>
								<dd><a href="http://steamcommunity.com/id/FiLeZekk">FiLeZekk</a></dd>
                                <dt>Osu!</dt>
								<dd><a href="http://osu.ppy.sh/u/Legacy47">Legacy47</a></dd>
                                <dt>Youtube</dt>
                                <dd><a href="https://www.youtube.com/c/Legacy47GamingHighlights">Legacy47 &#160;Gaming</a></dd>
							</dl>
							<ul class="icons">
								<li><a href="https://twitter.com/_legacy47" class="icon fa-twitter alt"><span class="label">Twitter</span></a></li>
								<li><a href="https://www.facebook.com/legacy447" class="icon fa-facebook alt"><span class="label">Facebook</span></a></li>
								<li><a href="https://www.instagram.com/_justinlee._/" class="icon fa-instagram alt"><span class="label">Instagram</span></a></li>
								<li><a href="https://github.com/justinjameslee" class="icon fa-github alt"><span class="label">GitHub</span></a></li>
							</ul>
						</section>
					</footer>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollex.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>
<?php
 
}
 
?>