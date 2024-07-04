<?php
  error_reporting(E_ALL ^ E_NOTICE);

  $secretKey = "6LcrIFsjAAAAADki4Hn3NSZ-m_9fw1Mbol9FwsYf";
  $responseKey = $_POST['g-recaptcha-response'];
  $userIP = $_SERVER['REMOTE_ADDR'];

  $url = "https://www.google.com/recaptcha/api/siteverify?secret=$secretKey&response=$responseKey&remoteip=$userIP";
  $response = file_get_contents($url);
  $response = json_decode($response);

  $name = $_POST['name'];
  $fakeName = $_POST['name_test']; //honeypot
  $email = $_POST['email'];
  $reason = $_POST['reason'];
  $comments = $_POST['comments'];
  $date = date('m-d-Y');

  $email_from = 'contact@brianstowell.name';
  $email_subject = "New Form Submission";
  $email_body = "You have received a new message from the user $name at $email.\n
                  Here is the message regarding $reason:\n $comments";
  
  $email_to = "$email";
  $email_to_subject = "Thank you for contacting Brian Stowell, Web Development Student.";
  $email_to_body = "
                <html>
                <body style=\"background-color:lightblue;color:white;font-size:15px;font-weight:bold;\">
                <h3 style=\"font-size:25px;background-color:darkgray;color:white;padding:10px;margin-bottom:20px;text-align:center;\">Brian Stowell Portfolio Site</h3>
                <p style=\"margin-left:15px\">$date</p>
                <p style=\"margin-left:15px\">Thank you $name, for contacting me regarding $reason.</p>
                <p style=\"margin-left:15px\">I received your comments: </p>
                <p style=\"margin-left:15px\">$comments</p>
                <p style=\"margin-left:15px\">I look forward to responding to your inquiry and will do so very soon.</p>

                <p style=\"margin-left:15px\">Thanks again for contacting me. Have a great day!</p>
				<p style=\"margin-left:15px\">Brian Stowell</p>

                <h3 style=\"font-size:15px;background-color:darkgray;padding:10px;text-align:center;\"><a href='https://brianstowell.name' style=\"color:white;text-decoration:none;\">Click Here to Return to Brian's Portfolio Site</a></h3>
                </body>
                </html>";
?>

<!DOCTYPE html>

<html>

<head>

	<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-RWWSF8S7T9"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-RWWSF8S7T9');
</script>

	<title>Web Development Student Portfolio</title>
	<!--
			Author: Brian Stowell
			Date: 3/12/2024
	-->

	<link href="css/styles.css" rel="stylesheet" type="text/css">
	<link href="css/styles.scss" rel="stylesheet" type="text/css">
	<link href="css/styles600.css" rel="stylesheet" type="text/css">
	<link href="css/styles600.scss" rel="stylesheet" type="text/css">
	<link rel="manifest" href="app.webmanifest">
	<script src="serviceWorker.js"></script>

	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- BEGIN SHAREAHOLIC CODE -->
<link rel="preload" href="https://cdn.shareaholic.net/assets/pub/shareaholic.js" as="script" />
<meta name="shareaholic:site_id" content="47d2efbe19aa0a52e26a8b16a7de8546" />
<script data-cfasync="false" async src="https://cdn.shareaholic.net/assets/pub/shareaholic.js"></script>
<!-- END SHAREAHOLIC CODE -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> <!--icon for hamburger mobile menu-->

<script>
    function myFunction() {        //display hamburger menu contents when hamburger is clicked on mobile view
        var x = document.getElementById("myLinks");
            if (x.style.display === "block") {
                x.style.display = "none";
            } else {
                x.style.display = "block";
            }
    }
</script>
</head>

<body>

	<div class="container">

		<header>
				<div class="topnav">
					<a href="#" class="active"></a>
					<!-- Navigation links (hidden by default) -->
					<div id="myLinks">
                    <li><a href="https://brianstowell.name" target="_blank">Home</a></li>
					<a href="resume/BrianStowell_resume.pdf" target="_blank">Resume</a>
					<a href="https://brianstowell.name/homepage/index.html" target="_blank">Homework</a>
					<a href="https://www.linkedin.com/in/brian-stowell-31833171" target="_blank">LinkedIn</a>
					<a href="https://github.com/bsstowell" target="_blank">GitHub</a>
					</div>
					<!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
					<a href="javascript:void(0);" class="icon" onclick="myFunction()">
					<i class="fa fa-bars"></i>
					</a>
				</div>
				<div class="topHeader">
					<ul>
						<li><a href="https://brianstowell.name" target="_blank">Home</a></li>
						<li><a href="https://brianstowell.name/homepage/index.html" target="_blank">Homework</a></li>
						<li><a href="https://www.linkedin.com/in/brian-stowell-31833171" target="_blank">LinkedIn</a></li>
						<li><a href="https://github.com/bsstowell" target="_blank">GitHub</a></li>
					</ul>
				</div> <!--end of .topHeader-->
				<!-- Top Navigation Menu for mobile view-->
				<nav>
					<div class="alignHeaderText">Academic Portfolio</div>
					<div class="alignQR">
						<img src="images/qrcode_brianstowell.name.png" class="qrcode">
						<figcaption>Scan for Resume</figcaption>
					</div>
				</nav>
		</header>

		<?php
			if(isset($_POST["submit"]) && $response->success && $fakeName == "") {
			?>
				<div class="alignSmallBox" style="margin-bottom:40px; padding-left:40px;">
					<p><?php echo date("m-d-Y"); ?></p>
					<p>Hello <?php echo $name;?>,</p>
					<p>Thank you for reaching out.</p>
					<p>I will be in contact with you shortly at the email address you provided, <?php echo $email; ?>.</p>
					<p>I look forward to our future correspondence.</p>
					<p>Sincerely, </p>
					<p>Brian Stowell</p>
				</div>

			<?php

				$to = "briansstowell@hotmail.com";
				$headers = "From: $email_from \r\n";
				$headers .= "Reply-To: $email \r\n";
				$headers .= "MIME-Version: 1.0 \r\n";
				$headers .= "Content-type: text/html; charset=iso-8859-1 \r\n";

				mail($to,$email_subject,$email_body,$headers);

				mail($email_to,$email_to_subject,$email_to_body,$headers);
				}
				else{
			?>

		<div class="alignHeader2">
			<h2>Brian Stowell</h2>
			<div>
				  <div class="meImage">
					<img src="images/myself2.png" class="image">
				</div>
			</div>
			<h2>Web Development</h2>
		</div>

		<div class="alignHeaderMobile">
			<h2>Brian Stowell<br><br>
			Web Development</h2>
		</div>

		<p class="alignSmallBox">
			Welcome to my portfolio page! My name is Brian, and I recently completed
			my Web Development degree in May, 2024. I created this page to display what I
			have learned during my studies.
			<br><br>
			During my time studying at DMACC I have demonstrated my understanding and ability in regards to several
			classes and their competencies.
		</p>

		<p class="alignSmallBox" style="text-align:center;">Hover over (or tap) the blocks below and click the links to view
			some of my favorite projects. Thanks for stopping by!
		</p>
		
	<div class="flex-container">
		<div class="flip-card">
			<div class="flip-card-inner">
				<div class="flip-card-front alignBox">
					WordPress:
					<ul>
						<li>Themes</li> 
						<li>Plugins</li> 
						<li>Commerce</li>
						<li>Forms</li>
						<li>Blog</li> 
					</ul>
				</div>
				<div class="flip-card-back alignBoxBack">
					<div class="centered" style="top:30%"><a
						href="https://brianstowell.name/WDV240/Finalproject/"
						target="_blank">Wow Conference</a>
					</div>
					<div class="centered"><a
						href="https://brianstowell.name/WDV240/project5/" target="_blank">Happy Fun Socks
						</a></div>
				</div>
			</div>
		</div>
		
		<div class="flip-card">
			<div class="flip-card-inner">
				<div class="flip-card-front alignBox">
					Web Design:
					<ul>
						<li>Website Proposals</li> 
						<li>Wireframes</li>
						<li>Logos</li>
						<li>Color Palettes</li>
						<li>Prototypes</li>
					</ul>
				</div>
				<div class="flip-card-back alignBoxBack">
					<div class="centered" style="top:30%"><a
						href="https://xd.adobe.com/view/f7251496-afa7-4f0a-ad8d-30bb0ad2d218-a276/"
						target="_blank">Prototype XD</a>
					</div>
					<div class="centered"><a
							href="https://xd.adobe.com/view/9eb7c5a7-28d5-4616-a2da-f7a2c38826a5-cbe4/" target="_blank">Wire
							Frame XD</a>
					</div>
				</div>
			</div>
		</div>

		<div class="flip-card">
			<div class="flip-card-inner">
				<div class="flip-card-front alignBox">
					JavaScript:
					<ul>
						<li>Parameters</li> 
						<li>Returns</li>
						<li>Forms</li>
						<li>Math Operators</li>
						<li>Properties</li>
						<li>Methods</li>
						<li>If Statements / Loops</li>
					</ul>
				</div>
				<div class="flip-card-back alignBoxBack">
					<div class="centered" style="top:30%"><a
						href="https://brianstowell.name/WDV221_audit/arraysAssignment.html" target="_blank">Arrays Tax Lookup</a>
					</div>
					<div class="centered"><a
						href="https://brianstowell.name/WDV221_audit/operatorsTextfields.html" target="_blank">Operators/Textfields</a>
					</div>
				</div>
			</div>
		</div>

		<div class="flip-card">
			<div class="flip-card-inner">
				<div class="flip-card-front alignBox">
					Advanced CSS:
					<ul>
						<li>SASS</li> 
						<li>Float</li>
						<li>Flexbox</li>
						<li>Grid</li>
						<li>Mixins</li>
						<li>Animations</li>
						<li>Responsive Design</li>
						<li>Nesting</li>
					</ul>
				</div>
				<div class="flip-card-back alignBoxBack">
					<div class="centered" style="top:30%"><a
						href="https://brianstowell.name/WDV205/animations/animationsFootball.html"
						target="_blank">Football Animation</a>
					</div>
					<div class="centered"><a
						href="https://brianstowell.name/WDV205/ADV%20CSS%20Final/finalProject.html"
						target="_blank">Biggie B's</a>
					</div>
				</div>
			</div>
		</div>

		<div class="flip-card">
			<div class="flip-card-inner">
				<div class="flip-card-front alignBox">
					PHP:
					<ul>
						<li>Functions</li> 
						<li>Form Processing</li>
						<li>Contact Form / Email</li>
						<li>Login-Protected Pages</li>
						<li>Session Variables</li>
						<li>Self Posting Form</li>
					</ul>
				</div>
				<div class="flip-card-back alignBoxBack">
					<div class="centered" style="top:30%"><a
						href="https://brianstowell.name/WDV341/WildWestResort/index.php"
						target="_blank">Wild West Resort</a>
					</div>
					<div class="centered"><a
						href="https://lucid.app/lucidspark/fe594afa-b401-45da-b646-4d525d512571/edit?invitationId=inv_7868028b-f1b3-495e-a7ae-d45b130bdc1b&page=0_0#"
						target="_blank">Wild West Prototype</a>
					</div>
				</div>
			</div>
		</div>
				
		<div class="flip-card">
			<div class="flip-card-inner">
				<div class="flip-card-front alignBox">
					Advanced JavaScript:
					<ul>
						<li>Dynamic Content</li> 
						<li>JS / JSON Objects</li>
						<li>Cookies</li>
						<li>Local Storage</li>
						<li>AJAX / Fetch API</li>
						<li>Arrays & Objects</li>
						<li>React App</li>
					</ul>
				</div>
				<div class="flip-card-back alignBoxBack">
					<div class="centered" style="top:30%"><a
						href="https://brianstowell.name/WDV321/jsonProject/consumeJSONArrayOfObjects.html" target="_blank">JSON Objects</a>
					</div>
					<div class="centered"><a
						href="https://brianstowell.name/WDV321/finalProject/index.html" target="_blank">Recipe Project</a>
					</div>
				</div>
			</div>
		</div>

		<div class="flip-card">
			<div class="flip-card-inner">
				<div class="flip-card-front alignBox">
					Other classes completed:
					<ul>
						<li>Intro to HTML/CSS</li> 
						<li>Digital Marketing</li>
						<li>E-Commerce</li>
						<li>Photoshop</li>
						<li>Intro Programming</li>
						<li>Database & SQL</li>
					</ul>
				</div>
				<div class="flip-card-back alignBoxBack">
					<div class="centered" style="top:30%"><a
						href="https://brianstowell.name/WDV101/adventure_travel_project/index.html" target="_blank">Intro HTML Final</a>
					</div>	
					<div class="centered"><a
						href="https://brianstowell.name/WDV205/bannerAd/bannerAd.html" target="_blank">Animations</a>
					</div>
				</div>
			</div>
		</div>
		<div class="flip-card">
			<div class="flip-card-inner">
				<div class="flip-card-front alignBox">
					Emerging Technologies:
					<ul>
						<li>Motion UI</li> 
						<li>ChatGPT</li>
						<li>Generative AI</li>
					</ul>
				</div>
				<div class="flip-card-back alignBoxBack">
					<div class="centered" style="top:30%"><a
						href="https://brianstowell.name/WDV495/motionui/index.html" target="_blank">Motion UI</a>
					</div>
					<div class="centered"><a
						href="https://portfolio1526.z13.web.core.windows.net/" target="_blank">Azure Cloud</a>
					</div>
				</div>
			</div>
		</div>
		<div class="flip-card">
			<div class="flip-card-inner">
				<div class="flip-card-front alignBox">
					Website App Seminar:
					<ul>
						<li>GPGP - Class Project</li> 
						<li>Portfolio Site</li>
						<li>Prototypes</li>
					</ul>
				</div>
				<div class="flip-card-back alignBoxBack">
					<div class="centered"><a
						href="http://www.greatplainsgameplayers.com/" target="_blank">GPGP Site</a>
					</div>
				</div>
			</div>
		</div>
		<div class="flip-card">
			<div class="flip-card-inner">
				<div class="flip-card-front alignBox">
					Drupal:
					<ul>
						<li>Creating Blog Sites</li> 
						<li>Taxonomy</li>
						<li>Content Types</li>
						<li>Themes</li>
						<li>Web Forms</li>
						<li>Blocks & Views</li>
					</ul>
				</div>
				<div class="flip-card-back alignBoxBack">
					<div class="centered" style="top:30%"><a
						href="http://media.brianstowell.name/" target="_blank">Top TV Shows</a>
					</div>
					<div class="centered"><a
						href="http://city.brianstowell.name/" target="_blank">City Site</a>
					</div>
				</div>
			</div>
		</div>
	</div> <!--end of flex-container-->

			<div class="formPadding">
				<form id="contact" name="contact" method="post" action="index.php" >
					<h1>Contact Me</h1>
					<div>
						<label for="" class="formatLabel">Name:</label> 
						<input type="text" name="name" id="name" required />
						<input type="text" name="name_test" id="name_test" /> 
					</div>
					<div>
						<label for="" class="formatLabel">Email:</label>
						<input type="text" name="email" id="email" required />
					</div>
					<div>
					<label for="reason" class="formatLabel">Reason:</label>
					<select id="reason" name="reason" required>
						<option value="">Reason for Contact</option>
						<option value="kudos">I like your site!</option>
						<option value="employment">Job Opportunity</option>
						<option value="general inquiry">General Inquiry</option>
						<option value="feedback">Constructive Feedback</option>
					</select>
					</div>
					<div>
						<label for="" class="formatLabelComments">Message:</label>
						<textarea name="comments" id="comments" rows="5" cols="55" required></textarea>
					</div>
					
					<div class="g-recaptcha" data-sitekey="6LcrIFsjAAAAAOX8aVqZqu1kA_InCfTZ4BsGH8GA" style="margin-left:auto;margin-right:auto">
					</div>
				
					<div class="button">
						<input type="submit" name="submit" id="button" value="Submit" class="button"/>
						<input type="reset" name="button2" id="button2" value="Clear Form" class="button"/>
					</div>
				</form>

				<script src="https://www.google.com/recaptcha/api.js"></script>
			</div> 

			<?php
				}
			?>

			<footer >
				<div style="text-align:center; margin:35px">
					Copyright &copy <script>document.write( new Date().getFullYear() );</script>. All Rights Reserved. Brian Stowell, DMACC.
				</div>
				<div>
					<a href="https://www.linkedin.com/in/brian-stowell-31833171" target="_blank"><img src="images/linkedin.png" height="100px" width="100px" class="alignLogo" alt="linkedin logo"></a>
					<a href="https://github.com/bsstowell" target="_blank"><img src="images/github.png" height="100px" width="100px" class="alignLogo" alt="github logo"></a>
				</div>
			</footer>
	
		</div>
	
	</body>
	
	</html>