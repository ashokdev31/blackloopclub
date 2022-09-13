<?php 
    require_once "functions_basic.php";

    $merchant_id = '8129-0060573';

    ##Check if transaction ID has been submitted

    if(isset($_POST['transaction_id']) && isset($_SESSION['ussr_aidy']) && isset($_SESSION['online_method']) && isset($_SESSION['payment_id']) && isset($_SESSION['cancel_online'])){

        unset($_SESSION['cancel_online']);

        //get the full transaction details as an xml from voguepay
        $xml = file_get_contents('https://voguepay.com/?v_transaction_id='.$_POST['transaction_id']);
        //parse our new xml
        try{
            $xml_elements = new SimpleXMLElement($xml);
            //create new array to store our transaction detail
            $transaction = array();
            //loop through the $xml_elements and populate our $transaction array
            foreach($xml_elements as $key => $value) 
            {
                    $transaction[$key]=$value;
            }
                    
            /*You can do anything you want now with the transaction details or the merchant reference.
            You should query your database with the merchant reference and fetch the records you saved for this transaction.
            Then you should compare the $transaction['total'] with the total from your database.*/
            
            if($transaction['merchant_id'] == $merchant_id){
                $query = selectPDO("select * from users where id = ?", array($_SESSION['ussr_aidy']));
                while($row=$query->fetch(PDO::FETCH_ASSOC)){
                    $phoneNumber = $row['phone_number'];
                    $email = $row['email'];
                    $referral_code = $row['referral_code'];
                }
                $user_id = $_SESSION['ussr_aidy'];
                $elect_method = $_SESSION['online_method'];
                $payment_id = $_SESSION['payment_id'];
                $user_type = $_SESSION['user_type'];
                unset($_SESSION['ussr_aidy']);
                unset($_SESSION['online_method']);
                unset($_SESSION['payment_id']);
                unset($_SESSION['user_type']);
                $total_paid_by_buyer = $transaction['total_paid_by_buyer'];
                $total_credited_to_merchant = $transaction['total_credited_to_merchant'];
                $extra_charges_by_merchant = $transaction['extra_charges_by_merchant'];
                $fund_maturity = $transaction['fund_maturity'];
                $transaction_id = $transaction['transaction_id'];
                $alt_email = $transaction['email'];
                $total = $transaction['total'];
                $merchant_ref = $transaction['merchant_ref'];
                $memo = $transaction['memo'];
                $transaction_status = $transaction['status'];
                $transaction_date = $transaction['date'];
                $referrer = $transaction['referrer'];
                $method = $transaction['method'];
                
                $date = date("Y-m-d H:i:s");
                $products = "Privilege Membership";
                $quantity = "1";

                otherPDO("insert into online_transactions (payment_id, user_id, phone, email, "
                    . "merchant_id, transaction_id, alt_email, total, total_paid_by_buyer, "
                    . "total_credited_to_merchant, extra_charge_by_merchant, merchant_ref, memo, products, quantity,"
                    . "transaction_status, transaction_date, referrer, method, fund_maturity, cur, elect_method) values "
                    . "(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", array($payment_id, $user_id, $phoneNumber, $email, 
                        $merchant_id, $transaction_id, $alt_email, $total, $total_paid_by_buyer,
                        $total_credited_to_merchant, $extra_charges_by_merchant, $merchant_ref, $memo, $products, 
                        $quantity, $transaction_status, $transaction_date, $referrer, $method, $fund_maturity, "NGN", $elect_method));

                if($transaction['status'] == 'Approved' && $transaction['total'] > 0){
                    // SEND MESSAGE TO WELCOME USER
                    $query = selectPDO("select * from users where id = ?", array($user_id));
                    $row=$query->fetch(PDO::FETCH_ASSOC);
                    $fname = $row['fname'];
                    $lname = $row['lname'];
                    $to = $email;
                    $subject = "Welcome to Blackloop Club!";
                    $query = selectPDO("select * from page_details where name = 'after_payment'", array());
                    $row=$query->fetch(PDO::FETCH_ASSOC);
                    $register_email = $row['note'];
                    $register_email = preg_replace("#FNAME#", $fname, $register_email);
                    $register_email = preg_replace("#LNAME#", $lname, $register_email);
                    $message = $register_email;
                    $message = wordwrap($message, 70, "\r\n");
                    $headers = 'Content-type: text/html; charset=iso-8859-1; charset=utf-8'."\r\n".
                            'From: Blackloop Club <no-reply@blackloopclub.com>' . "\r\n" .
                        'Reply-To: contact@blackloopclub.com' . "\r\n" .
                        'X-Mailer: PHP/' . phpversion();

                    mail($to, $subject, $message, $headers);


                    $notification_type = "welcome";
                    sendNotification($user_id, $notification_type, "", "", "", "");

                    otherPDO("update payments set date_modified=?, amount=?, payment_status = ? where id = ?", array($date, $total_credited_to_merchant, "1", $payment_id));

                    otherPDO("update users set user_status = ?, user_level = ?, date_activated = ?, date_modified = ?, date_shifted =? where id = ?", array("1", "1", $date, $date, $date, $user_id));

                    // create shift in the system
                    createShifts();
                    
                    // payout bonusess
                    if($referral_code!="000000"){
                        payBonuses($referral_code, $user_id, $user_type, $date);
                    }

                }elseif($transaction['status'] == 'Failed' || $transaction['status'] == 'Declined' || $transaction['status'] == 'Disputed'){
                    otherPDO("update payments set date_modified=?, payment_status = ? where id = ?", array($date, "2", $payment_id));

                    otherPDO("update users set user_status = ?, date_modified = ? where id = ?", array("2", $date, $user_id));
                }
            }else{
                header("Location: index.php");
                exit;
            }
        }catch(Exception $e){
            otherPDO("update payments set date_modified=?, payment_status = ? where id = ?", array($date, "2", $payment_id));

            otherPDO("update users set user_status = ?, date_modified = ? where id = ?", array("2", $date, $user_id));
        }
        
    }elseif(isset($_SESSION['confirm_reg']) || isset($_SESSION['cancel_online'])){
        unset($_SESSION['confirm_reg']);
        if(isset($_SESSION['cancel_online'])){
            $date = date("Y-m-d H:i:s");
            otherPDO("update payments set date_modified=?, payment_status = ? where id = ?", array($date, "2", $_SESSION['payment_id']));
            otherPDO("update users set user_status = ?, date_modified = ? where id = ?", array("2", $date, $_SESSION['ussr_aidy']));
        }
        unset($_SESSION['ussr_aidy']);
        unset($_SESSION['online_method']);
        unset($_SESSION['payment_id']);

    }else{
        header("Location: login");
        exit;
    }
    
?>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml" prefix="og: http://ogp.me/ns#" lang="en" xml:lang="en">
    <meta http-equiv="content-type" content="text/html;charset=UTF-8"/>
    <head>
        
        <title>.: Payment Confirmation | BlackLoop Club :.</title>
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
                                                                    <h1><strong>Confirmation</strong></h1>
                                                                    <img src="png/step-counter3.png" style="width:230px;margin-top:20px;" />
                                                                </div>
                                                                
                                                                <div class="block push-bit col-xs-12">
                                                                    <?php if(!isset($_POST['transaction_id']) || (isset($_POST['transaction_id']) && $transaction['status'] == 'Pending')){
                                                                        if(!isset($_SESSION['cancel_online'])){ ?>
                                                                    <div class="col-xs-12" style="text-align: center;padding-top: 20px;">
                                                                        <img src="png/submission-success.png" width="40%" style="max-width: 250px;" />
                                                                        <label class="input-label col-xs-12" style="text-align: center !important;font-size: 30px !important;"><h1>Registration complete</h1></label>
                                                                        <label class="input-label col-xs-12" style="text-align: center !important;font-size: 14px !important;">Your registration has been submitted pending receipt & approval of your payment! <br/><br/>Please check your mailbox (Inbox & Spam) within 48hrs for a confirmation email.</label>
                                                                    </div>
                                                                        <?php }else{ unset($_SESSION['cancel_online']); ?>
                                                                    <div class="col-xs-12" style="text-align: center;padding-top: 20px;">
                                                                        <img src="png/pending-warning.png" width="40%" style="max-width: 250px;" />
                                                                        <label class="input-label col-xs-12" style="text-align: center !important;font-size: 30px !important;"><h1>Payment failed</h1></label>
                                                                        <label class="input-label col-xs-12" style="text-align: center !important;font-size: 14px !important;">Your registration has been received but unfortunately we could not process your payment.<br/><br/>Please click on the button below to login to your dashboard and attempt paying online again or use our other payment options.</label>
                                                                    </div>
                                                                    <?php }}else{
                                                                        if($transaction['status'] == 'Approved' && $transaction['total'] > 0){ ?>
                                                                    <div class="col-xs-12" style="text-align: center;padding-top: 20px;">
                                                                        <img src="png/submission-success.png" width="40%" style="max-width: 250px;" />
                                                                        <label class="input-label col-xs-12" style="text-align: center !important;font-size: 30px !important;"><h1>Registration complete</h1></label>
                                                                        <label class="input-label col-xs-12" style="text-align: center !important;font-size: 14px !important;">Congratulations for joining the Blackloop Club! <br/><br/>Please click on the button below to login to your dashboard.</label>
                                                                    </div>        
                                                                        <?php }else{ ?>
                                                                    <div class="col-xs-12" style="text-align: center;padding-top: 20px;">
                                                                        <img src="png/pending-warning.png" width="40%" style="max-width: 250px;" />
                                                                        <label class="input-label col-xs-12" style="text-align: center !important;font-size: 30px !important;"><h1>Payment failed</h1></label>
                                                                        <label class="input-label col-xs-12" style="text-align: center !important;font-size: 14px !important;">Your registration has been received but unfortunately we could not process your payment.<br/><br/>Please click on the button below to login to your dashboard and attempt paying online again or try other payment options.</label>
                                                                    </div>
                                                                    <?php }} ?>
                                                                    <div class="col-xs-12" style="text-align: center;padding-top: 20px;padding-bottom: 40px;">

                                                                    <a href="login" class="hero_button">Login to Dashboard</a>
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