<?php 
    require_once "functions_basic.php"; 

    $query = selectPDO("select * from payout_settings", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        if($row['type']=='privilege'){
            $privilege = $row['amount'];
            $exchange1 = $row['exchange'];
        }

        if($row['type']=='premium'){
            $premium = $row['amount'];
        }

        if($row['type']=='level'){
            $exchange2 = $row['exchange'];
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
        <title>.: Join Us | BlackLoop Club :.</title>
        <?php require_once "styles.php"; require_once "top-scripts.php"; ?>
        <style type="text/css">
            
            .body-background .ls-area .sitemap .join-banner #large {
                display: block;
                z-index: 1 !important;
            }
            
            .body-background .ls-area .sitemap .join-banner #small {
                display: none;
            }
            
            
            .body-background .ls-area .sitemap .table {
                margin-top: -45px;
            }
            
            .body-background .ls-area .sitemap .table tr td {
                padding: 15px;
                color: #000;
                width: 5%;
                font-size: 16px;
                z-index: 999999 !important;
            }

            .body-background .ls-area .sitemap .table tr #text {
                width: 35%;
            }
            
            .body-background .ls-area .sitemap .table tr #box {
                border-left: 2px solid #FE6802;
                border-right: 2px solid #FE6802;
                text-align: center;
                width: 25%;
                z-index: 999999 !important;
            }
            
            .body-background .ls-area .sitemap .table tr .top {
                border-top:2px solid #FE6802;
                padding-bottom: 30px;
                padding-top: 15px;
            }
            
            .body-background .ls-area .sitemap .table img {
                width: 100%;
                margin-bottom:0px;
                min-width: 100px;
            }
            
            .body-background .ls-area .sitemap .table #large {
                display: block;
            }
            
            .body-background .ls-area .sitemap .table #small {
                display: none;
            }
            
            
            .body-background .ls-area .sitemap .table a.hero_button {
                font-size: 12px;
                text-transform: uppercase;
                padding: 12px 20px;
                border: 1px solid #FE6802;
                border-radius: 2px;
                letter-spacing: 2px;
                color: #FE6802;
                font-weight:bold;
            }

            .body-background .ls-area .sitemap .table a.hero_button:hover,
            .body-background .ls-area .sitemap .table a.hero_button:active,
            .body-background .ls-area .sitemap .table a.hero_button:focus {
                background-color: #FE6802;
                border: 1px solid #FE6802;
                color: #FFF;
                text-decoration: none;
            }
            
            
            @media (max-width:767px){
                
                .body-background .ls-area .sitemap .join-banner #large {
                    display: none;
                }

                .body-background .ls-area .sitemap .join-banner #small {
                    display: block;
                }
                
                
                .body-background .ls-area .sitemap .table {
                    margin-left: 15px;
                    margin-top: 10px;
                }
                
                .body-background .ls-area .sitemap .table img {
                    margin-bottom:5px;
                }
                
                .body-background .ls-area .sitemap .table #large {
                    /*display: none;*/
                    margin-top: 5px;
                    margin-right: 12px;
                    max-width: 180px;
                }

                .body-background .ls-area .sitemap .table #small {
                    display: none;
                    
                }
                
                .body-background .ls-area .sitemap .table a.hero_button {
                    padding: 15px 10px;
                    font-size: 10px;
                }
                
                .body-background .ls-area .sitemap .table tr td {
                    width: 2%;
                    padding: 0px;
                }
                
                .body-background .ls-area .sitemap .table tr #text {
                    width: 10%;
                    padding: 5px;
                }

                .body-background .ls-area .sitemap .table tr #box {
                    width: 10%;
                    padding: 5px;
                }
                
                .body-background .ls-area .sitemap .table tr .top {
                    padding-top: 0px;
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
                        <!--<img src="images/faq.png" width="100%" />-->
                        
                        <div class="ls-area" id="mainWrapper">
                            <div class="ls-cmp-wrap" id="w1494674560314">
                                <div class="iw_component" id="c1494674560314">

                                    <!-- COMPONENT: vi16-content/Paragraph -->
                                    <div data-componentName="Sitemap" class="vi16">
                                        <div class="sitemap" style="background: transparent;">
                                            <div class="wrapper-980">
                                                <div class="join-banner">
                                                    <img id="large" src="jpg/Header1.jpg" width="100%" />
                                                    <img id="small" src="jpg/Header2.jpg" width="100%" />
                                                </div>
                                                
                                                <table class="list table table-striped">
                                                    <tr style="background: transparent;">
                                                        <td id="text" style="border-top:0px;">
                                                            <img id="small" src="jpg/Card.jpg" />
                                                        </td>
                                                        <td id="box" class="top">
                                                            <img id="large" src="jpg/Card.jpg" />
                                                            <br/>
                                                            <span style="font-size:28px;font-weight:bold;"><span style="font-size:14px;font-weight:normal;">$</span><span style=""> <?php echo $privilege; ?></span></span>
                                                            <br/><br/>
                                                            <a href="register"
                                                                class="hero_button"
                                                                title="Register on BlackLoop Club">Register</a>
                                                        </td>
                                                        <td style="border-top:0px;"></td>
                                                        <td id="box" class="top">
                                                            <img id="large" src="jpg/card2.jpg" />
                                                            <br/>
                                                            <span style="font-size:28px;font-weight:bold;"><span style="font-size:14px;font-weight:normal;">$</span><span style=""> <?php echo $premium; ?></span></span>
                                                            <br/><br/>
                                                            <button class="btn btn-default" disabled>Coming soon!</button>
                                                        </td>
                                                        <td style="border-top:0px;"></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="text">Cash Reward</td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                        <td></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="text">$ 625 shopping voucher Bonus <sup>**</sup></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                        <td></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="text">Luxury Car Bonus</td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                        <td></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="text">House Bonus</td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                        <td></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="text">Blackloop Debit Card</td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                        <td></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="text">Instant Savings</td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                        <td></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="text">Early / Late Shopping Hours</td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                        <td></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="text">Extra value Drugstore</td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                        <td></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="text">Luxury Vacations</td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                        <td></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="text">Blackloop Exclusive Services</td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                        <td></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="text">Exclusive Club Brands</td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                        <td></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="text">Low Gas Prices </td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                        <td></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="text">Add on Membership</td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                        <td></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="text">Global Yearly Profit Sharing</td>
                                                        <td id="box"></td>
                                                        <td></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="text">Household Access</td>
                                                        <td id="box"></td>
                                                        <td></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td id="text">Free Shipping</td>
                                                        <td id="box"></td>
                                                        <td></td>
                                                        <td id="box"><span class="fa fa-check-circle" style="font-size: 27px;color:#FE6802"></span></td>
                                                    </tr>
                                                    <tr style="background: transparent;">
                                                        <td id="text" style="bordr-top:0px;"></td>
                                                        <td id="box" style="border-bottom:2px solid #FE6802;padding-bottom: 30px;padding-top: 30px;">
                                                            
                                                            <a href="register"
                                                                class="hero_button"
                                                                title="Register on BlackLoop Club">Register</a>
                                                        </td>
                                                        <td style="border-top:0px;"></td>
                                                        <td id="box" style="border-bottom:2px solid #FE6802;padding-bottom: 30px;padding-top: 30px;">
                                                            
                                                            <button class="btn btn-default" disabled>Coming soon!</button>
                                                        </td>
                                                        <td style="border-top:0px;"></td>
                                                    </tr>
                                                </table>
                                                <hr style="margin-top: 100px;" />
                                                <div class="col-xs-12" style="margin-top: 20px;">
                                                    <sup>**</sup> Our adopted exchange rate is &#8358; <?php echo $exchange1; ?> to $1 for all inflows and &#8358; <?php echo $exchange2; ?> to $1 for all outflows.<br/><br/>
                                                    <span style="font-weight: bold;">N/B: </span>Please contact us for other currency exchange rates.
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