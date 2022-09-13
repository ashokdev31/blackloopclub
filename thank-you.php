<?php 
    require_once "functions_basic.php";

    if(isset($_GET['x']) && isset($_GET['y'])){
        $email = $_GET['x'];
        $hash = $_GET['y'];

        $query = selectPDO("select * from email_subscribers where email = ? and hash = ?", array($email, $hash));
        if($query->rowCount()>0){
            $row=$query->fetch(PDO::FETCH_ASSOC);
            $link = $row['link'];
        }else{
            header("Location: index");
            exit;
        }

        download($link);
    }else{
        header("Location: index");
        exit;
    }
    
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#" lang="en" xml:lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <head>
        
        <title>.: Thank You | BlackLoop Club :.</title>
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
            
            .body-background .ls-area .sitemap .block ul {
                list-style-type: none;
            }

            .body-background .ls-area .sitemap .block li {
              display: inline-block;
            }

            input[type="radio"][id^="cb"] {
              display: none;
            }

            .check-box {
              border: 1px solid #fff;
              padding: 10px;
              display: block;
              position: relative;
              margin: 10px;
              cursor: pointer;
            }

            .check-box:before {
              background-color: white;
              color: white;
              content: " ";
              display: block;
              border-radius: 50%;
              border: 1px solid #FE6802;
              position: absolute;
              top: -5px;
              left: -5px;
              width: 25px;
              height: 25px;
              text-align: center;
              line-height: 28px;
              transition-duration: 0.4s;
              transform: scale(0);
            }

            .check-box img {
              width: 180px;
              transition-duration: 0.2s;
              transform-origin: 50% 50%;
            }

            :checked + .check-box {
              border-color: #FE6802;
            }

            :checked + .check-box:before {
              content: "✓";
              background-color: #FE6802;
              transform: scale(1);
            }

            :checked + .check-box img {
              transform: scale(0.8);
              box-shadow: 1px 1px 5px #FFF;
              z-index: -1;
            }
            
            .body-background .ls-area .sitemap .block .img-display{
                max-width:200px;
                height: 200px;
                border: 1px solid #ddd;
            }
            
            .body-background .ls-area .sitemap .input-label {
                text-align: left !important;
                padding:0px;
                font-size: 18px !important;
                font-weight: normal !important;
                margin-bottom: 20px;
                margin-top:15px;
                color:#000;
            }
            
            .body-background .ls-area .sitemap .input-label2 {
                font-size:14px !important;
                margin-bottom:10px;
                margin-top: 0px;
                font-weight: normal !important;
            }
            
            .body-background .ls-area .sitemap .mylist {
                border-top: 1px solid #DDD;
                padding-top: 20px;
                padding-bottom: 20px;
                margin-top:0px;
                margin-bottom: 0px;
                cursor: pointer;
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
            
            .body-background .ls-area .sitemap a.hero_button {
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

            .body-background .ls-area .sitemap a.hero_button:hover,
            .body-background .ls-area .sitemap a.hero_button:active,
            .body-background .ls-area .sitemap a.hero_button:focus {
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
                    <div class="ls-col" style="margin-bottom: 100px;color: #666 ">
                        
                        <div class="ls-row row2">
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
                                                                
                                                                
                                                                <div class="block push-bit col-xs-12">
                                                                    <div class="col-xs-12" style="text-align: center;padding-top: 20px;">
                                                                        <img src="png/submission-success.png" width="40%" style="max-width: 250px;" />
                                                                        <label class="input-label col-xs-12" style="text-align: center !important;font-size: 30px !important;"><h1>Thank You!</h1></label>
                                                                        <label class="input-label col-xs-12" style="text-align: center !important;font-size: 14px !important;">Your download will start in few seconds. If it doesn't, please click <a href="?x=<?php echo $email; ?>&y=<?php echo $hash; ?>">HERE</a>.</label>
                                                                    </div>
                                                                    <div class="col-xs-12" style="text-align: center;padding-top: 20px;padding-bottom: 40px;">

                                                                    <a href="index" class="hero_button">Continue to Site</a>
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