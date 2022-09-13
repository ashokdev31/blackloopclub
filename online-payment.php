<?php 
    require_once "functions_basic.php";

    if(!isset($_SESSION['proceed_online']) || !isset($_SESSION['online_method']) || !isset($_SESSION['payment_id'])){
        header("Location: login");
        exit;
    }
    $user_id = $_SESSION['ussr_aidy'];
    $user_name = $_SESSION['ussr_naim'];
    $email = $_SESSION['email'];
    unset($_SESSION['proceed_online']);
    unset($_SESSION['ussr_naim']);
    unset($_SESSION['email']);

    $query = selectPDO("select * from payout_settings where type = 'privilege'", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $amount = $row['amount'] * $row['exchange'];
    }
    $charges = 0;
    $total = $amount+$charges;
    $invoice = generateInvoiceNum();
    $_SESSION['cancel_online']="";
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#" lang="en" xml:lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <head>
        
        <title>.: Online Payment | BlackLoop Club :.</title>
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
            
            .body-background .ls-area .sitemap button.hero_button {
                font-size: 12px;
                text-transform: uppercase;
                padding: 12px 20px;
                border: 1px solid #FE6802;
                border-radius: 2px;
                letter-spacing: 2px;
                color: #FE6802;
                font-weight:bold;
                margin-top:-40px;
                float: left;
                margin-bottom: 30px;
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

            table caption {
                text-align: center;
                padding: 15px;
                font-weight:bold;
                background: #888;
                color: #FFF;
            }

            th, td {
                border: 1px solid #333;
                border-collapse: collapse;
                padding: 20px;
            }

            th {
                background: #888;
                color: #FFF;
                text-align: center;
                font-weight: bold;
            }
            
            @media (max-width:767px){
                th, td {
                    padding: 5px;
                }

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
                                                                
                                                                <div class="col-xs-12 heading">
                                                                <h1><strong>Payment</strong></h1>
                                                                <img src="png/step-counter2.png"
                                                                     style="width:230px;margin-top:20px;"/>
                                                                 </div>
                                                                
                                                                <div class="block push-bit col-xs-12">
                                                                    <div class="col-xs-12" style="text-align: center;padding-top: 20px;">

                                                                        <table style="width:100%">
                                                                            <caption>Preview Payment Information</caption>
                                                                            <thead>
                                                                                <th align="center">ITEM</th>
                                                                                <th align="center">QUANTITY</th>
                                                                                <th align="center">UNIT COST</th>
                                                                                <th align="center">CHARGES</th>
                                                                                <th align="center">TOTAL</th>
                                                                            </thead>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td>Privilege Membership Plan</td>
                                                                                    <td align="center">1</td>
                                                                                    <td align="center">&#8358; <?php echo number_format($amount, 2); ?></td>
                                                                                    <td align="center">&#8358; <?php echo number_format($charges, 2); ?></td>
                                                                                    <td align="center">&#8358; <?php echo number_format($total, 2); ?></td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>

                                                                        <form method="POST" action="https://voguepay.com/pay/">
                                                                            <input type="hidden" name="v_merchant_id" value="8129-0060573" />
                                                                            <input type="hidden" name="memo" value="Order from <?php echo $user_name; ?>" />
                                                                            <input type="hidden" name="store_id" value="4452" />
                                                                            <input type="hidden" name="cur" value="NGN" />
                                                                            <input type="hidden" name="price_1" value="<?php echo $amount; ?>">
                                                                            <input type="hidden" name="item_1" value="Privilege Membership">
                                                                            <input type="hidden" name="description_1" value="Purchase of membership plan" />
                                                                            <input type="hidden" name="price_2" value="<?php echo $charges; ?>">
                                                                            <input type="hidden" name="item_2" value="Merchant Charge">
                                                                            <input type="hidden" name="description_2" value="Transaction Charges" />
                                                                            <input type='hidden' name='total' value='<?php echo $total; ?>' />
                                                                            <input type='hidden' name='merchant_ref' value='<?php echo $invoice; ?>' />
                                                                            <input type='hidden' name='success_url' value='https://www.blackloopclub.com/confirmation.php' />
                                                                            <input type='hidden' name='fail_url' value='https://www.blackloopclub.com/confirmation.php' />
                                                                            
                                                                            <br />
                                                                            
                                                                            <input type="image" class="pull-right" style="height: 40px;" src="https://voguepay.com/images/buttons/make_payment_red.png" alt="PAY" />

                                                                            <br/>
                                                                            <div class="col-xs-12" style="padding: 0px;">
                                                                                <a href="confirmation">
                                                                                    <button type="button" onclick="return confirm('Do you really want to cancel this transaction?');" 
                                                                                            class="hero_button"><i
                                                                                                class="fa fa-times"></i>
                                                                                        Cancel
                                                                                    </button>
                                                                                </a>
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