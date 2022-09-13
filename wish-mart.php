<?php require_once "functions_basic.php"; ?>

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
        <title>.: Wish Mart | BlackLoop Club :.</title>
        <?php require_once "styles.php"; require_once "top-scripts.php"; ?>
        <style type="text/css">
            .body-background .ls-area .mybut {
                list-style: none;
                text-align: center;
                margin-top: 20px;
            }
            
            .body-background .ls-area .mybut button.hero_button {
                font-size: 12px;
                text-transform: uppercase;
                padding: 12px 50px;
                border: 1px solid #FE6802;
                border-radius: 2px;
                letter-spacing: 2px;
                color: #FE6802;
                font-weight:bold;
                background: transparent;
            }

            .body-background .ls-area .mybut button.hero_button:hover,
            .body-background .ls-area .mybut button.hero_button:active,
            .body-background .ls-area .mybut button.hero_button:focus {
                background-color: #FE6802;
                border: 1px solid #FE6802;
                color: #FFF;
                text-decoration: none;
            }
        </style>
    </head>

    <body id="corporate-one" class="blkPage page-class-home blk-responsive en_US">
        <div class="ls-canvas content-page-wide-12">

            <?php require_once "header.php"; ?>

            <div class="ls-row body-background" id="bodyWrapper" style="border-bottom:0px;">
                <div class="ls-col" style="margin-bottom: 100px;color: #666 ">

                    <div class="ls-row row2" style="margin-bottom:0px;">
                        <img src="png/wish-mart.png" width="100%"/>

                        <div class="ls-area" id="mainWrapper" style="margin-top:10px;">
                            <div class="ls-cmp-wrap" id="w1494674560314">
                                <div class="iw_component" id="c1494674560314">

                                    <!-- COMPONENT: vi16-content/Paragraph -->
                                    <div data-componentName="Paragraph" class="vi16">
                                        <div class="paragraph tinymce clearfix ">
                                            <div class="para-content">
                                                <p class="intro-black intro-black-border-bottom">
                                                    <span style="text-align:center">What’s keeping you up all night? Drop it on us, let’s keep up all day to find & fix it.</span>
                                                </p>
                                                
                                                <p><span>We work with this abstract notion of starting with the clients and working backwards, we get particular about our clients individual wish  products or services and go all out to making it available. Now you can personalize your online shopping experience with us. As  We LISTEN, INVENT and PERSONALIZE for you.</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <li style="list-style:none;text-align: center;font-size: 30px;margin-top:40px;">
                                <h1 style="font-weight: normal;">Get started <span class="fa fa-angle-right"></span></h1>
                            </li>

                            <div class="ls-cmp-wrap" id="w1467271847304">
                                <div class="iw_component" id="c1467271847304">
                                    <form action="#" method="post">
                                        <!-- COMPONENT: vi16-content/Paragraph -->
                                        <div data-componentName="Paragraph" class="vi16">
                                            <div class="paragraph tinymce clearfix table-620-wide">
                                                <div class="para-content">
                                                    <p><span>
                                                               
                                                            <label style="font-weight: normal">First Name</label>
                                                            <input required="" type="text" placeholder="Enter first name"
                                                                   style="margin-bottom: 15px;" class="form-control"
                                                                   name="firstname" width="100%"/>
                                                            
                                                            <label style="font-weight: normal">Last Name</label>
                                                            <input required="" type="text" placeholder="Enter last name"
                                                                   style="margin-bottom: 15px;" class="form-control"
                                                                   name="lastname" width="100%"/>
                                                            
                                                            <label style="font-weight: normal">Mobile Number</label>
                                                            <input required="" type="number" placeholder="Enter mobile number"
                                                                   style="margin-bottom: 15px;" class="form-control"
                                                                   name="mobile" width="100%"/>
                                                            
                                                            <label style="font-weight: normal">Email</label>
                                                            <input required="" type="email" placeholder="Enter email address"
                                                                   style="margin-bottom: 15px;" class="form-control"
                                                                   name="email" width="100%"/>
                                                            
                                                            <label style="font-weight: normal">Products / Services</label>
                                                            <input required="" type="text"
                                                                   placeholder="Enter products or services"
                                                                   style="margin-bottom: 15px;" class="form-control"
                                                                   name="products_services" width="100%"/>
                                                            
                                                            <label style="font-weight: normal">Item Description</label>
                                                            <input required="" type="text" placeholder="Enter item description"
                                                                   style="margin-bottom: 15px;" class="form-control"
                                                                   name="item_description" width="100%"/>
                                                            
                                                            <label style="font-weight: normal">General Description</label>
                                                            <textarea required="" class="form-control"
                                                                      style="margin-bottom: 15px;" name="description"
                                                                      placeholder="Enter general description"></textarea>
                                                            
                                                            
                                                            
                                                    </span></p>
                                                </div>
                                            </div>
                                        </div>
                                        
                                        <li class="mybut">
                                        <button type="submit" name="submit"
                                                class="hero_button">Submit</button>
                                        </li>
                                    </form>
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