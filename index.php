<?php
	$msg = '';
	$msg_code = 'success';
	if (isset($_POST['send'])) {
        $email;$comment;$captcha;
        if(isset($_POST['email'])){
          $to=$_POST['email'];
          $captcha = '';
        }if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }
        if(!$captcha){
          $msg = "We would love to contact a real human.";
          $msg_code = 'failure';
        }
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6Lf8MQITAAAAADem8RmHnkgorsqMAtOmaH8CyH9n&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']);
		$obj = json_decode($response);
		$condition = $obj->{'success'};
        if($condition == false)
        {
        	$msg = "We would love to contact a real human.";
        	$msg_code = 'failure';
        }
        else if ($condition == true)
        {
        	$subject = 'WebBanao: Thank you for contacting us :-)';
			$message = 'Dear ' . $_POST['name'] . ",\n\n\n";
			$message .= 'This is to confirm that we have received your request. Again, we would like to thank you for offering us an opportunity to be a part of your Bussiness/Work. We will get back to you as soon as possible after reviewing your request or query. Feel free to reply to this mail in case you have any other query or want to add any comment.';
			$message .= "\n\n\n\n";
			$message .= "Thanks & Regards , \n\n";
			$message .= "WebBanao\n(Bussiness Badhao)";

			$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
			if ($email) {
			   $headers .= "\r\nReply-To: $email";
			}
			$headers = 	"From: support@webbanao.com\r\n";
			$headers .= 'Content-Type: text/plain; charset=utf-8';
			$success = mail($to, $subject, $message, $headers, '-fsupport@webbanao.com');


			$subject_wb = "WebBanao:".$to." mailed a query";
			$message_wb = $_POST['name'] . " with email address : ".$to." has sent the following message as ".$_POST['subject'].": ";
			$message_wb .= $_POST['message'];
			if (isset($success) && $success) { 
				mail("ankitech@gmail.com", $subject_wb, $message_wb, $headers, '-fsupport@webbanao.com');
				mail("support@webbanao.com", $subject_wb, $message_wb, $headers, '-fsupport@webbanao.com');
				$msg = "Thank You for contacting us...";
				$msg_code = 'success';
			} 
			else { 
				$msg = "Sorry, there was a problem sending your message.";
				$msg_code = 'failure';
			}
		}
	}
?>
<!DOCTYPE html>

<html prefix="og: http://ogp.me/ns#">

<head>
	<title>Webbanao.com-Hire us to make functional and beautiful websites for your company</title>
	<meta charset="UTF-8">
	<meta property="og:title" content="Web Banao" />
	<meta property="og:type" content="image.jpeg" />
	<meta property="og:url" content="http://www.webbanao.com/" />
	<meta property="og:image" content="http://www.webbanao.com/android-icon-192x192.png" />
	<meta property="og:description" content="At webbanao, we are committed to create you a beautiful and fuctional website using the latest techniques that will keep you ahead in the competition. Webbanao was essentially setup to Web(websites) + Banao(Creation in
	Hindi) and that is what we do." />
	<meta property="og:determiner" content="the" />
	<meta property="og:locale" content="en_IN" />
	<link rel="canonical" href="www.webbanao.com" />
	<meta name="robots" content="index, follow">
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192" href="/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/style.css">
	<link href='http://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Overlock' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css'>
	<!-- Core JavaScript Files -->
	<script src="js/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.easing.min.js"></script>
	<script src="js/jquery.scrollTo.js"></script>
	<script src="js/wow.min.js"></script>
	<!-- Custom Theme JavaScript -->
	<script src="js/custom.js"></script>


</head>

<body>
	<?php include_once("analyticstracking.php") ?>
	<!-- facebook like script start-->
	<script>
		window.fbAsyncInit = function() {
			FB.init({
				appId: '196708687162159',
				xfbml: true,
				version: 'v2.2'
			});
		};

		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) {
				return;
			}
			js = d.createElement(s);
			js.id = id;
			js.src = "//connect.facebook.net/en_US/sdk.js";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>

	<div id="fb-root"></div>
	<script>
		(function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0];
			if (d.getElementById(id)) return;
			js = d.createElement(s);
			js.id = id;
			js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&appId=196708687162159&version=v2.0";
			fjs.parentNode.insertBefore(js, fjs);
		}(document, 'script', 'facebook-jssdk'));
	</script>
	<!-- facebook like script end-->

	<!--Navigation Panel-->
	<nav id="top-nav" class="navbar navbar-custom navbar-fixed-top" role="navigation">
		<div class="container">
			<div class="navbar-header page-scroll">
				<!--Menu toggle button for small screens-->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>

				<a class="navbar-brand" href="index.html">
					<img src="img/webbanao.png" width="60px" height="40px" alt="logo">
				</a>
			</div>
			<!--Menu items-->
			<div id="navbar" class="collapse navbar-collapse navbar-right navbarHeaderCollapse">
				<ul class="nav navbar-nav">
					<li><a href="#intro">Home</a>
					</li>
					<li><a href="#service">Services</a>
					</li>
					<li><a href="#project">Projects</a>
					</li>
					<li><a href="#work">Work</a>
					</li>
					<li><a href="#about">About</a>
					</li>
					<li><a href="#contact">Contact</a>
					</li>
				</ul>
			</div>
		</div>

	</nav>
	<div id="float-social">

		<div class="float-social-item">
			<fb:like href="https://www.facebook.com/webbanao" layout="box_count" action="like" show_faces="true" share="true"></fb:like>
		</div>
		<div class="float-social-item"><a class="twitter-share-button" data-count="vertical" href="https://twitter.com/web_banao">Tweet</a>
		</div>
		<div class="float-social-item">
			<div class="g-plusone" data-size="tall" data-href="http://www.webbanao.com"></div>
		</div>
	</div>

	<!--Section: intro-->
	<section id="intro" class="intro" >
		<div class="slogan">
			<h2>WELCOME TO <span class="text_color">WEB BANAO</span> </h2>
			<h4>WE ARE GROUP OF GENTLEMEN MAKING AWESOME WEBSITES FOR YOU</h4>
		</div>
		<div class="page-scroll">
			<a href="#service" class="btn btn-circle">
				<i class="fa fa-angle-double-down animated"></i>
			</a>
		</div>
	</section>
	<!--/Section: intro-->

	<!-- Section: services -->
	<section id="service" class="home-section text-center bg-gray">

		<div class="heading-about">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="wow bounceInDown" data-wow-delay="0.4s">
							<div class="section-heading">
								<h2>Our Services</h2>
								<i class="fa fa-2x fa-angle-down"></i>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-lg-offset-5">
					<hr class="marginbot-50">
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 col-md-3">
					<div class="wow fadeInLeft" data-wow-delay="0.2s">
						<div class="service-box">
							<div class="service-icon">
								<img src="img/icons/1.png" alt="web developement" />
							</div>
							<div class="service-desc">
								<h5>Web Developement</h5>
								<p>We can code and develop sites to your requirement and make it perfect by our skills.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3 col-md-3">
					<div class="wow fadeInUp" data-wow-delay="0.2s">
						<div class="service-box">
							<div class="service-icon">
								<img src="img/icons/2.png" alt="web design" />
							</div>
							<div class="service-desc">
								<h5>Web Design</h5>
								<p>We can design sites for you that are customized for your content and looks good be it PC,Mobile or Tablet.</p>
							</div>
						</div>
					</div>
				</div>
				<div class="col-sm-3 col-md-3">
					<div class="wow fadeInUp" data-wow-delay="0.2s">
						<div class="service-box">
							<div class="service-icon">
								<img src="img/icons/4.png" alt="social branding" />
							</div>
							<div class="service-desc">
								<h5>Social Branding</h5>
								<p>We can connect your website to social networking to get you more eyes for your products.</p>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-3 col-md-3">
					<div class="wow fadeInLeft" data-wow-delay="0.2s">
						<div class="service-box">
							<div class="service-icon">
								<img src="img/icons/5.png" alt="poster" />
							</div>
							<div class="service-desc">
								<h5>Posters,Flyers and Logos</h5>
								<p>We can design beautiful posters and flyers for any event or a great logo for your brand or company.</p>
							</div>
						</div>
					</div>
				</div>

				<div class="col-sm-3 col-md-3">
					<div class="wow fadeInRight" data-wow-delay="0.2s">
						<div class="service-box">
							<div class="service-icon">
								<img src="img/icons/3.png" alt="content management" />
							</div>
							<div class="service-desc">
								<h5>Content Management</h5>
								<p>We can provide content management services so that you can frequently update whatever the content you want leaving the hard part for us.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /Section: services -->

	<!--Section: project-->
	<section id="project" class="home-section">
		<div class="heading-about">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="wow bounceInDown" data-wow-delay="0.4s">
							<div class="section-heading text-center">
								<h2>Projects</h2>
								<i class="fa fa-2x fa-angle-down"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-lg-offset-5">
					<hr class="marginbot-50">
				</div>
			</div>
			<div class="row row-centered section-heading">
				<div class="col-xs-6 col-sm-3 col-md-3 col-centered">
					<!--<div class="wow bounceInUp" data-wow-delay="0.2s">
                <div class="team boxed-grey">
                    <div class="inner">
						<h5>Kumar Ankit</h5>
                        <p class="subtitle">Engineer</p>
                        <div class="avatar"><img src="img/team/3.jpg" alt="" class="img-responsive img-circle" /></div>
                    </div>
                </div>
				</div>-->
					<h3 class="text-center" style="margin-bottom:260px;">Coming Soon...</h3>
				</div>
			</div>
	</section>
	<!--/Section: project-->

	<!--Section: work-->
	<section id="work" class="home-section">
		<div class="heading-about">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="wow bounceInDown" data-wow-delay="0.4s">
							<div class="section-heading text-center">
								<h2>Work</h2>
								<i class="fa fa-2x fa-angle-down"></i>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-lg-offset-5">
					<hr class="marginbot-50">
				</div>
			</div>
			<div class="row">
				<div class="col-lg-9 col-lg-offset-0">
					<h3>WHAT CAN WE DO FOR YOU?</h3>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-9 col-lg-offset-0">
					<div class="ordered-list">
						<ol>
							<li><span>Help you grow your products and brand.</span>
							</li>
							<li><span>Make your brand ascessible.</span>
							</li>
							<li><span>Connect you to your potential customers.</span>
							</li>
						</ol>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-lg-12 col-lg-offset-0">
					<h3>HOW WE WORK?</h3>
					<div class="ordered-list">
						<ol>
							<li><span>You contact us <a href="#contact">here</a>.</span>
							</li>
							<li><span>We communicate and discuss your requirements.</span>
							</li>
							<li><span>If you are satisfied then we meet to finalize.</span>
							</li>
							<li><span>We then work with you gather detailed requirements and plan the project.</span>
							</li>
							<li><span>We then start developing and designing the project custom-made for your requirements. </span>
							</li>
							<li><span>We then test you project in real time to weed out any errors.</span>
							</li>
							<li><span>We then launch or handover the project according to your requirements.</span>
							</li>
							<li><span>Provide you with post-project service if required.</span>
							</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--/Section: work-->

	<!--Section: about-->
	<section id="about" class="home-section text-center">
		<div class="heading-about">
			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="wow bounceInDown" data-wow-delay="0.4s">
							<div class="section-heading">
								<h2>About us</h2>
								<i class="fa fa-2x fa-angle-down"></i>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container">

			<div class="row">
				<div class="col-lg-2 col-lg-offset-5">
					<hr class="marginbot-50">
				</div>
			</div>
			<div class="row row-centered section-heading">
				<div class="col-xs-6 col-sm-3 col-md-3 col-centered">
					<div class="wow bounceInUp" data-wow-delay="0.2s">
						<div class="team boxed-grey">
							<div class="inner">
								<h5>Kumar Ankit</h5>
								<p class="subtitle">Developer</p>
								<div class="avatar">
									<img src="img/team/ankit.jpg" alt="kumar ankit" class="img-responsive img-circle" />
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-3 col-md-3 col-centered">
					<div class="wow bounceInUp" data-wow-delay="0.5s">
						<div class="team boxed-grey">
							<div class="inner">
								<h5>Dev Gourav</h5>
								<p class="subtitle">Designer</p>
								<div class="avatar">
									<img src="img/team/dev.jpg" alt="dev gourav" class="img-responsive img-circle" />
								</div>

							</div>
						</div>
					</div>
				</div>
				<div class="col-xs-6 col-sm-3 col-md-3 col-centered">
					<div class="wow bounceInUp" data-wow-delay="0.8s">
						<div class="team boxed-grey">
							<div class="inner">
								<h5>Jitesh Agarwal</h5>
								<p class="subtitle">Operations</p>
								<div class="avatar">
									<img src="img/team/jitesh.jpg" alt="jitesh agrawal" class="img-responsive img-circle" />
								</div>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- /Section: about -->


	<!-- Section: contact -->
	<section id="contact" class="home-section text-center">
		<div class="heading-contact">

			<div class="container">
				<div class="row">
					<div class="col-lg-8 col-lg-offset-2">
						<div class="wow bounceInDown" data-wow-delay="0.4s">
							<div class="section-heading">
								<h2>Get in touch</h2>
								<i class="fa fa-2x fa-angle-down"></i>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="container">
			<div class="row">
				<div class="col-lg-2 col-lg-offset-5">
					<hr class="marginbot-50">
				</div>
			</div>

			<div class="row">
				<div class="col-lg-8">
					<div class="boxed-grey">
						<form id="contact-form" action="index.php#contact" method="POST">
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="name">Name</label>
										<input type="text" class="form-control" id="name" placeholder="Enter name" required="required" name="name" />
									</div>
									<div class="form-group">
										<label for="email">Email Address</label>
										<div class="input-group">
											<span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span>
											</span>
											<input type="email" class="form-control" id="email" placeholder="Enter email" required="required" name="email" />
										</div>
									</div>
									<div class="form-group">
										<label for="subject">Subject</label>
										<select id="subject" name="subject" class="form-control" required="required">
											<option value="na" selected="">Choose One:</option>
											<option value="service">General Customer Service</option>
											<option value="suggestions">Suggestions</option>
											<option value="product">Product Support</option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="name">Message</label>
										<textarea name="message" id="message" class="form-control" rows="8" cols="25" required="required" placeholder="Message"></textarea>
									</div>
								</div>
								<div class="col-md-12">
								<div class="g-recaptcha" data-sitekey="6Lf8MQITAAAAAPhacG1vc6HXofDIl9ygx5MrSjov"></div>
							</div>
								<div class="col-md-12">
									<button type="submit" name="send" class="btn btn-skin pull-left" style="margin-top:10px;" id="btnContactUs">
										Send Message</button>
								</div>
							</div>
							<div id="<?php echo $msg_code; ?>">
								<p>
									<?php echo $msg; ?>
								</p>
							</div>
						</form>
					</div>
				</div>

				<div class="col-lg-4">
					<div class="widget-contact">
						<h5>Main Office</h5>

						<address>
				  		<strong>Coming Soon!</strong><br>
				  		<abbr title="Phone">Phone no:</abbr>(+91)-9923834174
						</address>

						<address>
				  		<strong>Email</strong><br>
				  		<a href="mailto:#">support@webbanao.com</a>
						</address>	
						<address>
				       	<ul class="company-social">
				       		<strong>We're on social networks</strong></br>
				       		<hr>
                            <li class="social-facebook"><a href="https://www.facebook.com/webbanao" target="_blank"><img src="img/icons/facebook.png" height="40px" width="40px" alt="facebook"></a></li>
                            <li class="social-twitter"><a href="https://twitter.com/web_banao" target="_blank"><img src="img/icons/twitter.png" height="40px" width="40px" alt="twitter"></a></li>
                            <li class="social-google"><a href="https://plus.google.com/104917054063729004309/about" target="_blank"><img src="img/icons/googleplus.png" height="40px" width="40px" alt="googleplus"></a></li>
                            <li class="social-vimeo"><a href="http://www.linkedin.com/company/web-banao" target="_blank"><img src="img/icons/linkedin.png" height="40px" width="40px" alt="linkedin"></a></li>
                        </ul>
						</address>	
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--Footer-->
	<footer>
		<nav class="navbar navbar-custom navbar-static-bottom" role="navigation">
			<div class="container">
				<p class="navbar-text pull-left" style="color: white;font-size: 15px;">&copy;Copyright 2014 - WebBanao.com. All rights reserved.</p>
			</div>
		</nav>
	</footer>


	<script>
		window.twttr = (function(d, s, id) {
			var js, fjs = d.getElementsByTagName(s)[0],
				t = window.twttr || {};
			if (d.getElementById(id)) return;
			js = d.createElement(s);
			js.id = id;
			js.src = "https://platform.twitter.com/widgets.js";
			fjs.parentNode.insertBefore(js, fjs);
			t._e = [];
			t.ready = function(f) {
				t._e.push(f);
			};
			return t;
		}(document, "script", "twitter-wjs"));
	</script>

	<script src="https://apis.google.com/js/platform.js" async defer></script>
	<script src='https://www.google.com/recaptcha/api.js'></script>
</body>

</html>
