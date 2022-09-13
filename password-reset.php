<?php 
    require_once "functions_basic.php";
    include "password_compat-master/lib/password.php"; 

    if(isset($_POST['change_password']) && isset($_GET['m']) && isset($_GET['x'])){
        $password1 = $_POST['password1'];
        $password2 = $_POST['password2'];
        $date = date("Y-m-d H:i:s");

        if($password1==$password2){
            $hash = password_hash($password1, PASSWORD_BCRYPT);
            otherPDO("update users set password = ?, date_modified = ? where email_slug = ? and user_pin = ?", array($hash, $date, $_GET['m'], $_GET['x']));
            header("Location: login?x");
            exit;
        }else{
            $error = "Passwords do not match!";
        }
    }

    if(isset($_GET['m']) && isset($_GET['x'])){
        $email = $_GET['m'];
        $hash = $_GET['x'];

        $query = selectPDO("select * from users where email_slug = ? and user_pin = ?", array($email, $hash));
        if($query->rowCount()==0){
            header("Location: index");
            exit;
        }
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $dp = $row['profile_pic'];
            $fname = $row['fname'];
            $lname = $row['lname'];

        }
    }else{
        header("Location: index");
        exit;
    }

?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#" lang="en" xml:lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <head>
        
        <title>.: Password Reset | Blackloop Club :.</title>
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

            <?php require_once "header.php"; ?>

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
                                                                    <?php } ?>
                                                                <div class="col-xs-12">
                                                                            <form action="" method="post" id="form-login"
                                                                                  class="form-horizontal form-bordered form-control-borderless">
                                                                                
                                                                                <div class="user-thumb">
                                                                                    <img src="<?php echo $dp; ?>" width="120px" class="img-responsive img-circle img-thumbnail" alt="thumbnail">
                                                                                </div>
                                                                                <div class="form-group">
                                                                                    <h3 style="font-weight: bold;font-size: 18px;margin-top: 20px;"><?php echo $fname." ".$lname; ?></h3>
                                                                                    <p class="text-muted" style="margin: 10px 0 15px 0;">Reset Password</p>
                                                                                    <div class="form-group">
                                                                                        <div class="col-xs-12">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                                                                <input type="password" id="login-password" name="password1" class="form-control input-b" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" placeholder="Enter password">
                                                                                                
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                        <div class="col-xs-12">
                                                                                            <div class="input-group">
                                                                                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                                                                                <input type="password" id="login-password" name="password2" class="form-control  input-b"
                                                                                                       placeholder="Re-enter password">
                                                                                                
                                                                                            </div>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="form-group form-actions">
                                                                                        <div class="col-xs-12">
                                                                                            
                                                                                        <button type="submit" name="change_password" class="hero_button pull-right form-control  input-b" style="margin-top:0px;"><i class="fa fa-angle-right"></i> Confirm</button>
                                                                                            
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="text-center">
                                                                                    <a href="login?x" class="text-muted">Not <?php echo $fname; ?>?</a>
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

            <?php require_once "top-footer.php"; require_once "footer.php"; ?>
        </div>
        <?php require_once "bottom-scripts.php"; ?>
    </body>
</html>