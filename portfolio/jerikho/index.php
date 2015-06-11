<?php
    $error = false;

    if (isset($_GET['test'])) {
    $_SERVER['REQUEST_METHOD'] = 'POST';
    $_POST = $_GET;
    }


    if ($_SERVER ["REQUEST_METHOD"] == "POST") {

    function validate_request() {
        $name = trim($_POST["name"]);
        $email = trim($_POST["email"]);
        $message = trim($_POST["message"]);

        if ($name == "" || $email == "" || $message == "") {
        return "Please enter your name, email address, and message. Click back to return to the contact page.";
        }

        // PROTECTS AGAINST HIJACK BOTS:
        foreach( $_POST as $value) {
        if( stripos($value, 'Content-Type:') !== FALSE ) {
        return "There was a problem with the information you entered";
        }
        }

        if (!isset($_POST['address']) || $_POST["address"] != "") {
        return "There was a problem with your submission";
        }

        require_once ('inc/phpmailer/class.phpmailer.php');
        $mail = new PHPMailer();

        if (!$mail->ValidateAddress($email)) {
        return "Please enter a valid email address.";
        }

        $email_body = "";
        $email_body = $email_body . "Name: " . $name . "<br>"; 
        $email_body = $email_body . "Email: " . $email . "<br>";
        $email_body = $email_body . "Message: " . $message;


        $address = "henry.george.fox@gmail.com";

        $mail->AddAddress($address, "Harry");

        $mail->Subject = "Web Enquiry | " . $name;
        $mail->MsgHTML($email_body);

        $mail->IsSMTP();
        $mail->Host       = "smtp.gmail.com"; // SMTP server
        $mail->SMTPAuth   = true;                  // enable SMTP authentication 
        $mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing)
        
        $mail->SMTPSecure = 'ssl'; // Secure transfer enabled (required for GMail)
        $mail->Port       = 465;                    // set the SMTP port for the GMAIL server
        $mail->Username   = "harryfoxphpmail@gmail.com"; // SMTP account username 
        $mail->Password   = "dontmakemeusemypassword";   // SMTP account password 

        $mail->AddReplyTo($email,$name);
        $mail->SetFrom("harryfoxphpmail@gmail.com",$name);

        // attachment $mail->AddAttachment("images/phpmailer.gif");
        // attachment $mail->AddAttachment("images/phpmailer_mini.gif"); 
        //rugby999

        if(!$mail->Send()) {
        return "Mailer Error: " . $mail->ErrorInfo;
        }

        return false;
    }

    $error = validate_request();

    if(!$error)
        header("Location: index.php?status=thanks");
    }
?>


<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> 
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Jerikho</title>
    <meta name="description" content="Jerikho - localised gift economy application">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />

	<link rel="author" href="https://harryfox.me/portfolio"/>
	<link rel="icon" type="image/png" href="favicon.ico">
    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <script src="http://code.jquery.com/jquery.min.js"></script>

    <link href="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
    

		<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
		

		<link href='http://fonts.googleapis.com/css?family=Syncopate' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Raleway:300' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Cedarville+Cursive' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/jerikho.css">
    <!-- Responsive style sheets -->
    <link rel="stylesheet" media="only screen and (max-width: 420px)" href="css/mobile.css" />
    <link rel="stylesheet" media="only screen and (min-width: 421px) and (max-width:767px)" href="css/tablet.css" />
    <link rel="stylesheet" media="only screen and (min-width: 768px)" href="css/sm.css">
    <link rel="stylesheet" media="only screen and (min-width: 991px)" href="css/md.css">

    <script src="js/vendor/modernizr-2.7.1.min.js"></script>
    
</head>
<body class="loading">
    <!--[if lt IE 7]>
        <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
    <![endif]-->


<!-- **********************************
	ADD AN ARROW AT THE BOOTOM OF EACH PAGE
	SET THE PAGE TO RELATIVE AND THE ARROW TO ABSOLUTE 
	 **********************************
-->


   	<main>
   	 
        <section id="slide-1" class="homeSlide">
        	<div class="bcg"
        		data-center="background-position: 50% 0px;"
    			data-top-bottom="background-position: 50% -250px;"
    			data-anchor-target="#slide-1"
        	>
        
	        	<div class="hsContainer">
		    		<div class="hsContent container-fluid"
						data-center="opacity: 1"
            			data--450-bottom="opacity: 0;"
            			data-anchor-target="#slide-1"
		    		>
		    			<div class="row">

				    		<div class="col-xs-6 col-xs-offset-3 col-sm-2 col-sm-offset-2" id="mainlogoframe">
                				<img src="img/logo.png"  class="image" id="mainlogo">
           				 	</div>
            				<div class="col-xs-12 col-sm-7 col-md-offset-1">
                				<h1>Jerikho</h1>
            				</div>
            				<div class="col-xs-10 col-xs-offset-1  col-sm-8 col-sm-offset-4 col-md-offset-5">
                			<h2 id="slogan">"<span>Comm</span>unication - <span>unity</span>"</h2>
            				</div>

            				
        					<div class="col-xs-12 col-sm-8 col-sm-offset-4 col-md-offset-5">
				                <h3>A hyper-local</h3>
				            </div>
				            <div class="col-xs-12 col-sm-8 col-sm-offset-4 col-md-offset-5">
				                <h3>gift economy for</h3>
				            </div>
				            <div class="col-xs-12 col-sm-8 col-sm-offset-4 col-md-offset-5">
				                <h3>the digital age</h3>
				            </div>
				      		

				        </div>
		    		</div>
	        	</div>
        	</div>

        	<img src="img/arrow.png" class="arrow">

	    </section>
	    
	    <section id="slide-2" class="homeSlide">
	    	<div class="bcg">
		    	<div class="hsContainer">
		    		<div class="hsContent container-fluid">

			    		<div class="row" id="slide-2row1">
  
				            <div class="col-xs-8 col-sm-6 col-sm-offset-2" id="slide2row">
				                <h2 class="header2">Connecting a Community</h2>
				            </div>
				            <div class="col-xs-3 col-sm-1 minilogoframe">
				                <img src="img/logo.png" title="Hosted by imgur.com" class="image">
				            </div>
				      
				        </div>

				        <div class="row" id="slide-2row2">
				      
				            <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2" id="problemframe">
				                <p class="copy">Social networking allows us to connect to those we know, but what of the individuals and communities on our door-step?<br>Increasingly it seems that <span>our neighbours are strangers</span> and, as a result, so much valuable human interaction is lost.</p>
				            </div>
				            <div class="col-xs-12 col-sm-8 col-sm-offset-2" id="solutionframe">
				                <p class="copy end"><span><span class="Jerikho">Jerikho</span></span> combines digital interaction with human interaction by <span>connecting individuals</span> willing to help one another.</p>
				            </div>
				      
				        </div>

		    		</div>
	        	</div>
	    	</div>
	    
	    	<img src="img/arrow.png" class="arrow">

	    </section>
	    
		<section id="slide-3" class="homeSlide">
			<div class="bcg"
				data-center="background-position: 50% 0px;"
    			data-top-bottom="background-position: 50% -350px;"
    			data-bottom-top="background-position: 50% 350px;"
    			data-anchor-target="#slide-3"
			>
		    	<div class="hsContainer">
	    			<div class="hsContent container-fluid">


			    		<div class="row" id="phone">

			                <div class="col-xs-8 col-xs-offset-2 phonebox">
			                    <p class="copy">Choose between being a <em>Needer</em> (if you need some help) or a <em>Deeder</em> (if you're feeling helpful) or both!</p>
			                </div>
			                <div class="col-xs-8 col-xs-offset-2 phonebox">
			                    <p class="copy"><span class="Jerikho">Jerikho</span> matches <em>Needers</em> with <em>Deeders</em> in your  area</p>
			                </div>
			                <div class="col-xs-8 col-xs-offset-2 phonebox">
			                    <p class="copy"><em>Needers</em> message <em>Deeders</em> and make arrangements</p>
			                </div>
			                <div class="col-xs-8 col-xs-offset-2 phonebox">
			                    <p class="copy"><span class="Jerikho">Jerikho</span> logs all good deeds</p>
			                </div>
			                <div class="col-xs-8 col-xs-offset-2 phonebox" id="lastphonebox">
			                    <p class="copy">Altruism can change the face of your local community!</p>
			                </div>

			            </div>


		    		</div>
		    	</div>
		    	
		    </div>
		
		    <img src="img/arrow.png" class="arrow">

		</section>
		
		<section id="slide-4" class="homeSlide">
			<div class="bcg">
		    	<div class="hsContainer">
	    			<div class="hsContent container-fluid"
	    			data-center="bottom: 1200px; opacity: 1;"
	    			data-bottom-top="bottom: 1200px;"                	
            		data-anchor-target="#slide-4"
	    			>



			    		<div class="row onslide">
  
				            <div class="col-xs-12 col-sm-8 col-sm-offset-2">
				                <h2 class="lastheader">Interested?</h2>
				                <h2 class="lastheader">Get involved and let's make Jerikho happen!</h2>
				            </div>
				            <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 copy contact">
				                <p>How would you use Jerikho?</p>
				                <p>Want to be a part of the Jerikho movement?</p>
				                <p>Get in touch by clicking below and sending us a message.</p> 
				                <p>We would love to hear your thoughts!</p> 
				            </div>
				    
				        </div>
    
    <?php
        if($error)
        echo $error;
        else if (isset ($_GET["status"]) && $_GET["status"] == "thanks") 
    { 
    ?>

    
			            <div class="row onslide" id="thankyoumessage">

			                <div class="col-xs-12">
			                    <h2>Thanks for your message!</h2>
			                </div>
			                <div class="col-xs-8 col-xs-offset-2">
			                    <p>We'll get back to you very soon</p>
			                    <p id="signed">- <span class="Jerikho">Team Jerikho</span> (not really)</p>
			                </div>

			            </div>
    

    <?php  
    } else  {  
    ?>

				        <div class="row onslide" id="openform-row">

				            <div class="col-xs-12" id="buttonframe">
				            <!-- Button trigger modal -->
				                <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
				                    Say Hello
				                </button>
				            </div>
				    
				        </div>

		    		</div>

		    		<!-- Modal -->
			        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			            <div class="modal-dialog">
			                <div class="modal-content">

			                    <div class="modal-header">
			                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
			                        <h4 class="modal-title" id="myModalLabel">Go ahead, it's going to Harry Fox</h4>
			                    </div>

			                    <div class="modal-body">
			                        <form method="post" class="container-fluid">

			                            <table>
			                                <tbody>
			                                    <tr class="row">
			                                        <th >
			                                            <label class="control-label" for="name">Name</label>
			                                        </th>
			                                        <td class="col-xs-10">
			                                            <input type="text" name="name" id="name" class="form-control input-md">
			                                        </td>
			                                    </tr>
			                                    <tr class="row"> 
			                                        <th class="">
			                                            <label class="control-label" for="email">Email</label>
			                                        </th>
			                                        <td class="col-xs-10">
			                                            <input type="email" name="email" id="email" class="form-control input-md">
			                                        </td>
			                                    </tr>
			                                    <tr class="row">
			                                        <th class="">
			                                            <label class="control-label" for="message">Your Message</label>
			                                        </th>
			                                        <td class="col-xs-10"> 
			                                            <textarea name="message" id="message" class="form-control"></textarea>
			                                        </td>
			                                    </tr>
			                                    <tr style="display: none;">
			                                        <th>
			                                            <label for="address">Address</label>
			                                        </th>
			                                        <td>
			                                            <textarea name="address" id="address"></textarea>
			                                            <p>Humans, please leave this field blank.</p>
			                                        </td>
			                                    </tr>
			                                </tbody>
			                            </table>

			                            <div class="row buttonsrow">
			                                <button id="button1id" class="btn btn-success col-xs-4 col-xs-offset-1">
			                                    Send
			                                    <input type="submit" value="Send" style="display:none;">
			                                </button>
			                                <button id="button2id" name="button2id" class="btn btn-danger col-xs-4 col-xs-offset-2" data-dismiss="modal">
			                                    Cancel
			                                </button>
			                            </div>
			                        </form>
			                    </div>

			                </div>
			            </div>
			        </div>

	<?php } ?>



		    	</div>
		    	
		    </div>
		</section>
	    
	</main>

    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.1.min.js"><\/script>')</script>
    <script src="js/imagesloaded.js"></script>
    <script type="text/javascript" src="js/enquire.min.js"></script>
    <script src="js/skrollr.js"></script>
    <script src="js/_main.js"></script>

</body>
</html>