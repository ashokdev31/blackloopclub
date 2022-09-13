<?php 
    require_once "functions_basic.php"; 

    if(isset($_POST['submit'])){
        $email = $_POST['email'];

        $query = selectPDO("select * from users where (user_status = '0' or user_status = '1' or user_status = '2') and roles is null and email = ?", array($email));
        if($query->rowCount()>0){
            while($row=$query->fetch(PDO::FETCH_ASSOC)){
                $hash = $row['user_pin'];
                $fname = $row['fname'];
                $email_slug = $row['email_slug'];
            }
            // send message
            $link = "https://www.blackloopclub.com/password-reset?m={$email_slug}&x={$hash}";
            $to      = $email;
            $subject = "Did You Forget Your Password?";
            $message = "Dear {$fname},<br/><br/>You recently asked to reset your password. Please click <a href='{$link}'>HERE</a> to set a new password. However, if you didn't request this action, please ignore this message.<br/><br/>Thank you!<br/><br/><br/>Blackloop Club Team";
            $message = wordwrap($message, 70, "\r\n");
            $headers = 'Content-type: text/html; charset=iso-8859-1; charset=utf-8'."\r\n".
                        'From: Blackloop Club <no-reply@blackloopclub.com>' . "\r\n" .
                    'Reply-To: contact@blackloopclub.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);
            $success = "Password reset link has been sent successfully!";
        }else{
            $error = "This email does not belong to a registered user!";
        }
    }

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#" lang="en" xml:lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <head>
        
        <title>.: Forgot Password | Blackloop Club :.</title>
        <?php require_once "styles.php"; require_once "top-scripts.php"; ?>
        <style>
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
                margin-top:20px;
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
                <div class="ls-col" style="padding: 30px 0 100px 0;color: #666 ">
                    
                    <div class="ls-row row2" style="margin-bottom:0px;">
                        <!--<img src="images/faq.png" width="100%" />-->
                        
                        <div class="ls-area" id="mainWrapper">
                            <div class="ls-cmp-wrap" id="w1494674560314">
                                <div class="iw_component" id="c1494674560314">

                                    <!-- COMPONENT: vi16-content/Paragraph -->
                                    <div data-componentName="Sitemap" class="vi16">
                                        <div class="sitemap" style="background: transparent;">
                                            <div class="wrapper-980">

                                                <div class="row">

                                                    <div class="col-xs-12">
                                                        <div id="login-container" class="animation-fadeInLeft" data-toggle="animation-appear"
                                                             data-animation-class="animation-fadeInLeft" data-element-offset="-180">
                                                            
                                                            
                                                            <div class="block push-bit col-xs-12 col-sm-offset-3 col-sm-6 text-center" style="margin-top:0px;">
                                                                <?php if(isset($error)){ ?>
                                                                    <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                                                                    <?php }elseif (isset($success)) { ?>
                                                                    <div class="alert alert-success text-center"><?php echo $success; ?></div>
                                                                    <?php } ?>
                                                                <div class="col-xs-12">
                                                                            <form action="" method="post" id="form-login"
                                                                                  class="form-horizontal form-bordered form-control-borderless">
                                                                                
                                                                                
                                                                                <div class="form-group">
                                                                                    <h3 style="font-weight: bold;font-size: 18px;margin-top: 20px;">Forgot Password?</h3>
                                                                                    <p class="text-muted" style="margin: 10px 0 15px 0;">A reset password link will be sent to your email</p>
                                                                                    <div class="form-group">
                                                                                        <div class="col-xs-12">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i class="fa fa-at"></i></span>
                                                                                                <input type="email" id="login-password" name="email" class="form-control  input-b"
                                                                                                       placeholder="Email">
                                                                                                
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group form-actions">
                                                                                        <div class="col-xs-12">
                                                                                            
                                                                                        <button type="submit" name="submit" class="hero_button pull-right form-control  input-b" style="margin-top:0px;"><i class="fa fa-angle-right"></i> Proceed</button>
                                                                                            
                                                                                        </div>
                                                                                    </div>
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
                    
                </div>
                
            </div>

            <?php /*require_once "top-footer.php";*/ require_once "footer2.php"; ?>
        </div>
        <?php require_once "bottom-scripts.php"; ?>
    </body>
</html>