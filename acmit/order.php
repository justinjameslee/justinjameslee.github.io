<?php
 
$secret= "6Lf7iCsUAAAAAFwWqg8Qm6n13pNuHV8WDf1gpoEm";
$response=$_POST["g-recaptcha-response"];
$verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
$captcha_success=json_decode($verify);

if ($captcha_success->success==false) {
		echo "<p>You are a bot! Go away!</p>";
	} else if ($captcha_success->success==true) {
		echo "<p>You are not not a bot!</p>";
	}

?>

<?php
 
if(isset($_POST['action'])) {
 
 
    $email_to = "justinjameslee5@gmail.com";

    
    $name = $_POST['name']; // required
 
    $email_from = $_POST['email']; // required
    
    $wechat = $_POST['wechat']; //required
 
    $phone = $_POST['phone']; // required
    
 
    function clean_string($string) {
 
      $bad = array("content-type","bcc:","to:","cc:","href");
 
      return str_replace($bad,"",$string);
 
    }
    
    if (empty($_POST['name']) || empty($_POST['email']) || empty($_POST['phone']) || empty($_POST['wechat'])) {
        echo '<script language="javascript">';
        echo 'alert("Error, please go back and check you have filled in all the required(*) fields.")';
        echo '</script>';
        echo '<script language="javascript">';
        echo 'window.location = "http://www.acmit.com.au/order.html"';
        echo '</script>';
    }
    
    if (empty($_POST['phone'])) {
        $phone = "No phone number was given.";
    }
    
    if (empty($_POST['subject'])) {
        $email_subject = "No subject was given.";
    }
 
    $email_message = "ACMIT AIR Contact Form.\n\n";
    
    $email_message .= "Form details below.\n\n";
    
    $email_message .= "Name: ".clean_string($name)."\n";
 
    $email_message .= "Email: ".clean_string($email_from)."\n";
 
    $email_message .= "Phone: ".clean_string($phone)."\n";
    
    $email_message .= "Subject: ".clean_string($email_subject)."\n";
 
    $email_message .= "Message: ".clean_string($message)."\n\n";
    
    $email_message .= "From: ".clean_string($email_from)."\n";
    
    $headers = 'From: '.$email_from."\r\n".
        'Reply-To: '.$email_from."\r\n" .
        'X-Mailer: PHP/' . phpversion();
    
    @mail($email_to, $email_subject, $email_message, $headers);  
?>

<!--Page to go to once php has been executed-->
<!DOCTYPE HTML>
<html>
	<head>
		<title>ACMIT</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
		<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
	</head>
	<body class="homepage">
		<div id="page-wrapper">

			<!-- Header -->
				<header id="header">
					<div class="logo container">
						<div>
							<h1><a href="index.html" id="logo">ACMIT AIR</a></h1>
							<p>not only an air filter but also an air cleaner</p>
						</div>
					</div>
				</header>

			<!-- Nav -->
				<nav id="nav">
					<ul>
						<li><a href="index.html">Home</a></li>
						<li><a href="about.html">About</a></li>
						<li><a href="products.html">Products</a></li>
						<li class="current"><a href="contact.html">Contact</a></li>
					</ul>
				</nav>

			<!-- Main -->
				<div id="main-wrapper">
					<div id="main" class="container">
						<div class="row">
							<div class="12u">
								<div class="content">
									<!-- Content -->
                                    <article class="box page-content">
                                       <header>
                                            <h2 style="text-align: center;">THANK YOU</h2>
                                            <p style="text-align: center;">Thank you for contacting ACMIT&trade; AIR. We will be in touch with you very soon.</p>
                                           <div style="text-align: center;">
                                               <a href="about.html" class="button">READ MORE ABOUT US HERE!</a>
                                           </div>
                                            
                                        </header>
                                    </article>
                                </div>
                            </div>
                        </div>
                    </div>
				</div>
			<!-- Footer -->
				<footer id="footer" class="container">
					<div class="row 200%">
						<div class="12u">

							<!-- Contact -->
								<section>
									<h2 class="major"><span>Get in touch</span></h2>
									<ul class="contact">
										<li><a class="icon fa-facebook" href="#"><span class="label">Facebook</span></a></li>
										<li><a class="icon fa-twitter" href="#"><span class="label">Twitter</span></a></li>
										<li><a class="icon fa-instagram" href="#"><span class="label">Instagram</span></a></li>
										<li><a class="icon fa-wechat" href="#"><span class="label">WeChat</span></a></li>
										<li><a class="icon fa-google-plus" href="#"><span class="label">Google+</span></a></li>
									</ul>
								</section>

						</div>
					</div>

					<!-- Copyright -->
						<div id="copyright">
							<ul class="menu">
								<li>&copy; ACMIT AIR. All rights reserved</li>
							</ul>
						</div>

				</footer>
        </div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/skel-viewport.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>
<?php
 
}
 
?>