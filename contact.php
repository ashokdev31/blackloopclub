<?php require_once "functions_basic.php";

    if(isset($_POST['submit'])){
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,"https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,
                    "secret=6LdSMUoUAAAAADyTNoD-HB5YDVT9anLc1q2QX-Bm&response={$_POST['g-recaptcha-response']}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $server_output = curl_exec ($ch);
        curl_close ($ch);
        $response = json_decode($server_output, TRUE);
        if($response['success']==false){
            $contact_error2="reCAPTCHA failed!";
        }elseif($response['hostname']=="blackloopclub.com" || $response['hostname']=="www.blackloopclub.com"){
            $to      = 'contact@blackloopclub.com';
            $subject = $_POST['subject'];
            $message = $_POST['fname']." ".$_POST['lname']." (".$_POST['phone'].")\r\n\r\n".$_POST['message'];
            $headers = "Content-type: text/html; charset=iso-8859-1; charset=utf-8"."\r\n".
                        "From: {$_POST['fname']} {$_POST['lname']} <{$_POST['email']}>" . "\r\n" .
                    "Reply-To: {$_POST['email']}" . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
            $contact_success2="Message was sent successfully!";
        }
    }

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#" lang="en" xml:lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <head>
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-116674753-1"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-116674753-1');
        </script>
        <title>.: Contact | BlackLoop Club :.</title>
        <?php require_once "styles.php"; require_once "top-scripts.php"; ?>
        <style type="text/css">
        
            .body-background .row2 {
                margin-top: 70px;
            }
            
            .body-background .ls-area .sitemap .heading {
                padding:0px;
            }
            
            .body-background .ls-area .sitemap .heading h1 {
                font-size:25px;
                color:#000
            }
            
            .body-background .ls-area .sitemap .block {
                margin-top:40px;
                background: #EEE;
                padding:30px;
            }
            
            .body-background .ls-area .sitemap .input-label {
                text-align: left !important;
                padding:0px;
                font-size: 18px !important;
                font-weight: normal;
                margin-bottom: 20px;
                margin-top:15px;
                color:#000;
            }
            
            .body-background .ls-area .sitemap .social-label {
                text-align: left !important;
                padding:0px;
                font-size: 15px !important;
                font-weight: normal !important;
                margin-bottom: 10px;
                margin-top:0px;
                color:#000;
            }
            
            .body-background .ls-area .sitemap .social-label .gap {
                margin-left: 7px;
            }
            
            .body-background .ls-area .sitemap #zip_code {
                margin-top:0px;
            }
            
            .body-background .ls-area .sitemap #referral {
                margin-top:0px;
            }
            
            .body-background .ls-area .sitemap .input-b {
                border-radius:0px;
                padding:10px !important;
                height: 45px;
            }
            
            .body-background .ls-area .sitemap button.hero_button {
                font-size: 12px;
                text-transform: uppercase;
                padding: 12px 20px;
                border: 1px solid #FE6802;
                border-radius: 2px;
                letter-spacing: 2px;
                color: #FE6802;
                font-weight:bold;
                margin-top:5px;
                float: left;
            }

            .body-background .ls-area .sitemap button.hero_button:hover,
            .body-background .ls-area .sitemap button.hero_button:active,
            .body-background .ls-area .sitemap button.hero_button:focus {
                background-color: #FE6802;
                border: 1px solid #FE6802;
                color: #FFF;
                text-decoration: none;
            }
            
            .body-background .ls-area .sitemap .continue {
                text-align: right;
            }
            
            .body-background .ls-area .sitemap .login {
                text-align:right;
                margin-top: 10px;
            }
            
            @media (max-width:767px){
                .body-background .row2 {
                    margin-top: 30px;
                }
                
                .body-background .ls-area .sitemap .heading {
                    padding-left:15px;
                    padding-right:15px;
                }
                
                .body-background .ls-area .sitemap .heading h1 {
                    font-size:20px;
                }
                
                .body-background .ls-area .sitemap .block {
                    margin-top:40px;
                    padding:5px;
                }
                
                .body-background .ls-area .sitemap #zip_code {
                    margin-top:15px;
                }

                .body-background .ls-area .sitemap #referral {
                    margin-top:15px;
                }
                
                .body-background .ls-area .sitemap .continue {
                    text-align: left;
                }

                .body-background .ls-area .sitemap .login {
                    text-align:left;
                }
            }

        </style>
        
    </head>

    <body id="corporate-one" class="blkPage page-class-home blk-responsive en_US">
        <div class="ls-canvas content-page-wide-12">

            <?php require_once "header2.php"; ?>

            <div class="ls-row body-background" id="bodyWrapper" style="border-bottom:0px;">
                <div class="ls-col" style="margin-bottom: 100px;color: #666 ">
                    
                    <div class="ls-row row2" style="margin-bottom:0px;">
                        <!-- <img src="png/contact.png" width="100%" /> -->
                        
                        <div class="ls-area" id="mainWrapper" style="margin-top:-20px;">
                            <div class="ls-cmp-wrap" id="w1494674560314">
                                <div class="iw_component" id="c1494674560314">

                                    <!-- COMPONENT: vi16-content/Paragraph -->
                                    <div data-componentName="Sitemap" class="vi16">
                                        <div class="sitemap" style="background: transparent;">
                                            <div class="wrapper-980">

                                                <div class="row">
                                                
                                                    <div class="block push-bit col-xs-12">
                                                        <div class="col-xs-12">
                                                            <form action="" method="post" id="form-register"
                                                                  class="form-horizontal">
                                                                <?php if (isset($contact_success2)){ ?> 
                                                                <div class="alert alert-success text-center"><?php echo $contact_success2; ?></div>
                                                                <?php }elseif(isset($contact_error2)){ ?>
                                                                <div class="alert alert-danger text-center"><?php echo $contact_error2; ?></div>
                                                                <?php } ?>
                                                                <div class="col-xs-12 col-sm-8">
                                                                <fieldset>
                                                                    <label class="input-label col-xs-12">Send us a message</label>
                                                                    <div class="form-group">
                                                                        <div class="col-xs-6">
                                                                        <input required id="fname" name="fname" class="form-control input-b"
                                                                                   placeholder="First name"
                                                                                   type="text">
                                                                        </div>
                                                                        <div class="col-xs-6">
                                                                            <input required id="lname" name="lname" class="form-control input-b" placeholder="Last name"
                                                                                   type="text">
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <fieldset>
                                                                    <div class="form-group">
                                                                        <div class="col-xs-6">
                                                                            <input required id="email" name="email"
                                                                                   class="form-control input-b"
                                                                                   placeholder="Email address" type="email">
                                                                        </div>
                                                                        <div class="col-xs-6">
                                                                            <input required id="phone" name="phone"
                                                                                   class="form-control input-b"
                                                                                   placeholder="Phone number" type="number">
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <fieldset>
                                                                    <div class="form-group">
                                                                        <div class="col-xs-12">
                                                                            <input required id="subject" name="subject"
                                                                                   class="form-control input-b"
                                                                                   placeholder="Subject" type="text">
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <fieldset>
                                                                    <div class="form-group">
                                                                        <div class="col-xs-12">
                                                                            <textarea class="form-control" rows="7" placeholder="Type message here" name="message"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                <fieldset>
                                                                    <div class="form-group">
                                                                        
                                                                            <div class="g-recaptcha col-xs-12" style="" data-sitekey="6LdSMUoUAAAAAKrpOV3-pZAzQhR-j1X7ujaBt7xs"></div>
                                                                    </div>
                                                                </fieldset>
                                                                <fieldset>
                                                                    <div class="form-group form-actions">
                                                                        <div class="col-xs-12 continue">
                                                                            <button type="submit" name="submit" class="hero_button"><i
                                                                                        class="fa fa-angle-right"></i> Submit
                                                                                </button>
                                                                        </div>
                                                                    </div>
                                                                </fieldset>
                                                                </div>
                                                                <div class="col-xs-12 col-sm-4">
                                                                <fieldset>
                                                                    <label class="input-label col-xs-12">&nbsp;</label>
                                                                    <img src="png/contactmap.png" width="100%" style="margin-bottom: 15px;" />
                                                                    
                                                                    <div class="col-xs-12" style="padding-left:20px;">
                                                                        <label class="social-label col-xs-12"><span class="fa fa-envelope-open"></span> <span class="gap">contact@blackloopclub.com</span></label>
                                                                        <label class="social-label col-xs-12"><span class="fa fa-facebook-square"></span> <span class="gap">@blackloopclub</span></label>
                                                                        <label class="social-label col-xs-12"><span class="fa fa-twitter"></span> <span class="gap">@blackloopclub</span></label>
                                                                        <label class="social-label col-xs-12"><span class="fa fa-instagram"></span> <span class="gap">@blackloopclub</span></label>
                                                                    </div>
                                                                </fieldset>
                                                                
                                                                
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                        </div>
                        
                    </div>
                    
                </div>
                
            </div>

            <?php /*require_once "top-footer.php";*/ require_once "footer2.php"; ?>
        </div>
        <?php require_once "bottom-scripts.php"; ?>
    </body>
</html>