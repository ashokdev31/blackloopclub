<?php 

    require_once "functions_basic.php";
    // require_once "account/validation.php";

    if((isset($_COOKIE["blackloopclub"]) || isset($_SESSION['blackloopclub_slug'])) && !isset($_GET['x'])){
        // check if cookies is active
        header("Location: account/index");
        exit;
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
        <title>.: Login | Blackloop Club :.</title>
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

            <div class="ls-row body-background" id="bodyWrapper" style="border-bottom:0px;backgound: #000;">
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
                                                            
                                                            
                                                            <div class="block push-bit col-xs-12 col-sm-offset-3 col-sm-6" style="margin-top:0px;">
                                                                <?php if(isset($_SESSION['login_error'])){ ?>
                                                                    <div class="alert alert-danger text-center"><?php echo $_SESSION['login_error']; ?></div>
                                                                    <?php unset($_SESSION['login_error']);} ?>
                                                                <div class="col-xs-12">
                                                                            <form action="account/validation" method="post" id="form-login"
                                                                                  class="form-horizontal form-bordered form-control-borderless">

                                                                                <label class="input-label col-xs-12" style="text-align: center !important"><span class="fa fa-sign-in"></span> User Login</label>
                                                                                <div class="form-group">
                                                                                    <div class="col-xs-12">
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-addon"><i class="fa fa-at"></i></span>
                                                                                            <input type="email" id="login-email" name="email" class="form-control  input-b"
                                                                                                   placeholder="Email">
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <div class="col-xs-12">
                                                                                        <div class="input-group">
                                                                                            <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                                                            <input type="password" id="login-password" name="password" class="form-control  input-b"
                                                                                                   placeholder="Password">
                                                                                            
                                                                                        </div>
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group form-actions">
                                                                                    <div class="col-xs-12">
                                                                                        
                                                                                    <button type="submit" name="login" class="hero_button pull-right form-control  input-b" style="margin-top:0px;"><i class="fa fa-angle-right"></i> Login to Dashboard</button>
                                                                                        
                                                                                    </div>
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <label class="switch switch-primary pull-left col-xs-6" data-toggle="tooltip" title="Remember Me" style="font-weight:normal;">
                                                                                            <input type="checkbox" id="login-remember-me"
                                                                                                   name="remember" checked value="1"> 
                                                                                            <span>Remember Me</span>
                                                                                        </label>
                                                                                    <div class="col-xs-6">
                                                                                        <a class="btn btn-link pull-right" style="padding: 0px;" href="forgot-password">
                                                                                            Forgot Password?
                                                                                        </a>
                                                                                    </div>
                                                                                    <div class="col-xs-12" style="margin-top: 5px;">
                                                                                        <a href="register" style="text-decoration: underline;" class="pull-right">
                                                                                            <small>New user?</small>
                                                                                            <small>Create an account</small>
                                                                                        </a>
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