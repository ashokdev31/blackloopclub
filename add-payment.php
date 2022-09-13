<?php 
    require_once "functions_basic.php";

    if(!isset($_GET['x'])){
        header("Location: index");
        exit;
    }

    $query = selectPDO("select * from users where user_code = ? and user_status <> '-1' and user_status <> '1' and user_status <> '3' and user_status <> '4'", array($_GET['x']));
    if($query->rowCount()==0){
        header("Location: index");
        exit;
    }

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
        if($response['success']==false || ($response['hostname']!="blackloopclub.com" && $response['hostname']!="www.blackloopclub.com")){
            $_SESSION['payment_error']="reCAPTCHA failed!";
        }else{
        
            $date = date("Y-m-d H:i:s");
            while($row=$query->fetch(PDO::FETCH_ASSOC)){
                $user_id = $row['id'];
                $fname = $row['fname'];
                $lname = $row['lname'];
                $email = $row['email'];
            }

            $payment_type = $_POST['payment_type'];
            $electronic_method = "";
            $image = "";
            $bank_name = "";
            $acct_name = "";
            $acct_number = "";
            $trans_date = NULL;
            $customer_name = "";
            $user_type = "privilege";

            if($payment_type=="card"){
                $electronic_method = $_POST['online'];
            }elseif($payment_type=="deposit"){
                // $image = $_FILES["image"];

                define("UPLOAD_DIR", "account/payments/");

                if(isset($_FILES["image"]) && $_FILES["image"]['size']>0){

                    if($_FILES["image"]['size']>5000000){
                        $_SESSION['payment_error'] = "File size cannot be more than 5mb!";
                    }else{
     
                        $image = $_FILES["image"];

                        if ($image["error"] !== UPLOAD_ERR_OK) {
                            echo "<p>An error occurred.</p>";
                            exit;
                        }

                        // ensure a safe filename
                        $name = preg_replace("/[^A-Z0-9._-]/i", "_", $image["name"]);

                        // don't overwrite an existing file
                        $i = 0;
                        $parts = pathinfo($name);
                        while (file_exists(UPLOAD_DIR . $name)) {
                            $i++;
                            $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
                        }

                        // preserve file from temporary directory
                        $success = move_uploaded_file($image["tmp_name"], UPLOAD_DIR . $name);

                        if (!$success) {
                            echo "<p>Unable to save file.</p>";
                            exit;
                        }
                        // set proper permissions on the new file
                        chmod(UPLOAD_DIR . $name, 0644);

                        $image = UPLOAD_DIR.$name;
                    }
                }else{
                    $image = "";
                }
            }elseif($payment_type=="transfer"){
                $electronic_method = $_POST['method'];
                $bank_info = $_POST['bank_info'];
                $query=selectPDO("select * from bank_accounts where id = ?", array($bank_info));
                $row=$query->fetch(PDO::FETCH_ASSOC);
                $bank_name = $row['bank_name'];
                $acct_name = $row['acct_name'];
                $acct_number = $row['acct_number'];
                $trans_date = $_POST['trans_date'];
                $customer_name = $_POST['customer_name'];
            }

            if(!isset($_SESSION['payment_error'])){
                otherPDO("insert into payments (user_id, type, file, elect_method, bank_name, acct_name, acct_number, trans_date, payer_name, user_type, date_posted, date_modified) values (?,?,?,?,?,?,?,?,?,?,?,?)", array($user_id, $payment_type, $image, $electronic_method, $bank_name, $acct_name, $acct_number, $trans_date, $customer_name, $user_type, $date, $date));
                otherPDO("update users set user_status = ? where id = ?", array("0", $user_id));
                $query = selectPDO("select * from payments where user_id = ? and date_posted = ?", array($user_id, $date));
                while($row=$query->fetch(PDO::FETCH_ASSOC)){
                    $payment_id = $row['id'];
                }

                if($payment_type=="card"){
                    $_SESSION['proceed_online'] = "";
                    $_SESSION['online_method'] = $electronic_method;
                    $_SESSION['ussr_aidy'] = $user_id;
                    $_SESSION['ussr_naim'] = $fname." ".$lname;
                    $_SESSION['email'] = $email;
                    $_SESSION['payment_id'] = $payment_id;
                    header("Location: online-payment");
                    exit;
                }else{
                    $_SESSION['confirm_reg'] = "";
                    header("Location: confirmation");
                    exit;
                }
            }else{
                header("Location: payment?x={$_GET['x']}");
                exit;
            }
        } // end of recaptcha check

    } // end of submit

    $query = selectPDO("select * from payout_settings", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        if($row['type']=='privilege'){
            $exchange1 = $row['exchange'];
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
        
        <title>.: Add New Payment | BlackLoop Club :.</title>
        <?php require_once "styles.php"; require_once "top-scripts.php"; ?>
    <style type="text/css">

        .body-background .row2 {
            margin-top: 70px;
        }

        .body-background .ls-area .sitemap .heading {
            padding: 0px;
        }

        .body-background .ls-area .sitemap .heading h1 {
            font-size: 25px;
            color: #000
        }

        .body-background .ls-area .sitemap .block {
            margin-top: 40px;
            background: #EEE;
            padding: 30px;
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

        .body-background .ls-area .sitemap .block .img-display {
            max-width: 200px;
            height: 200px;
            border: 1px solid #ddd;
        }

        .body-background .ls-area .sitemap .input-label {
            text-align: left !important;
            padding: 0px;
            font-size: 18px !important;
            font-weight: normal !important;
            margin-bottom: 20px;
            margin-top: 15px;
            color: #000;
        }

        .body-background .ls-area .sitemap .input-label2 {
            font-size: 14px !important;
            margin-bottom: 10px;
            margin-top: 0px;
            font-weight: normal !important;
        }

        .body-background .ls-area .sitemap .mylist {
            border-top: 1px solid #DDD;
            padding-top: 20px;
            padding-bottom: 20px;
            margin-top: 0px;
            margin-bottom: 0px;
            cursor: pointer;
        }

        .body-background .ls-area .sitemap #zip_code {
            margin-top: 0px;
        }

        .body-background .ls-area .sitemap #referral {
            margin-top: 0px;
        }

        .body-background .ls-area .sitemap .input-b {
            border-radius: 0px;
            padding: 10px !important;
            height: 45px;
            margin-bottom:15px;
        }

        .body-background .ls-area .sitemap button.hero_button {
            font-size: 12px;
            text-transform: uppercase;
            padding: 12px 20px;
            border: 1px solid #FE6802;
            border-radius: 2px;
            letter-spacing: 2px;
            color: #FE6802;
            font-weight: bold;
            margin-top: 20px;
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
            text-align: right;
            margin-top: 10px;
        }

        @media (max-width: 767px) {
            .body-background .row2 {
                margin-top: 30px;
            }

            .body-background .ls-area .sitemap .heading {
                padding-left: 15px;
                padding-right: 15px;
            }

            .body-background .ls-area .sitemap .heading h1 {
                font-size: 20px;
            }

            .body-background .ls-area .sitemap .block {
                margin-top: 40px;
                padding: 5px;
            }

            .body-background .ls-area .sitemap #zip_code {
                margin-top: 15px;
            }

            .body-background .ls-area .sitemap #referral {
                margin-top: 15px;
            }

            .body-background .ls-area .sitemap .continue {
                text-align: left;
            }

            .body-background .ls-area .sitemap .login {
                text-align: left;
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
                                                        <div id="login-container" class="animation-fadeInLeft"
                                                             data-toggle="animation-appear"
                                                             data-animation-class="animation-fadeInLeft"
                                                             data-element-offset="-180">

                                                            <div class="col-xs-12 heading">
                                                                <h1><strong>Add New Payment</strong></h1>
                                                                
                                                            </div>
                                                            <form action=""
                                                                  enctype="multipart/form-data"
                                                                  method="post" id="form-register"
                                                                  class="form-horizontal">
                                                                
                                                                <?php if(isset($_SESSION['payment_error'])){ ?>
                                                                <div class="col-xs-12" style="padding: 0px;margin-top: 25px; margin-bottom: -40px;">
                                                                    <div class="alert alert-danger text-center"><?php echo $_SESSION['payment_error']; ?></div>
                                                                </div>
                                                                <?php unset($_SESSION['payment_error']);} ?>
                                                                <div class="block push-bit col-xs-12">
                                                                    <div class="col-xs-12">
                                                                        <label class="input-label col-xs-12">Payment Options
                                                                            <span style="font-size:14px;color:#FE6802;">(select one)</span></label>
                                                                        <label class="input-label mylist col-xs-12 online-button"
                                                                               style="font-size:16px !important;"
                                                                               for="online_pay">
                                                                            <input required id="online_pay"
                                                                                   onclick="this.blur();"
                                                                                   style="margin-right:10px;"
                                                                                   name="payment_type"
                                                                                   value="card" type="radio"> Credit / Debit Card
                                                                            <span class="fa fa-credit-card"
                                                                                  style="margin-left: 5px;"></span>
                                                                        </label>
                                                                        <label class="input-label mylist col-xs-12 deposit-button"
                                                                               style="font-size:16px !important;"
                                                                               for="deposit_slip">
                                                                            <input required id="deposit_slip"
                                                                                   onclick="this.blur();"
                                                                                   style="margin-right:10px;"
                                                                                   name="payment_type"
                                                                                   value="deposit" type="radio"> Upload Deposit Slip
                                                                            <span class="fa fa-upload"
                                                                                  style="margin-left: 5px;"></span>
                                                                        </label>
                                                                        <label class="input-label mylist col-xs-12 transfer-button"
                                                                               style="font-size:16px !important;"
                                                                               for="online_transfer">
                                                                            <input required id="online_transfer"
                                                                                   onclick="this.blur();"
                                                                                   style="margin-right:10px;"
                                                                                   name="payment_type"
                                                                                   value="transfer" type="radio"> Electronic Transfers
                                                                            <span class="fa fa-globe"
                                                                                  style="margin-left: 5px;font-size: 18px;"></span>
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <div class="block push-bit col-xs-12 online-panel"
                                                                     style="display:none;">
                                                                    <div class="col-xs-12">
                                                                        <label class="input-label col-xs-12">Pay Now Via Credit
                                                                            / Debit Card <span
                                                                                    style="font-size:14px;color:#FE6802;">(select one)</span></label>
                                                                        <div class="form-group">
                                                                            <div class="col-xs-12">
                                                                                <ul>
                                                                                    <!-- <li><input type="radio" value="paypal" name="online"
                                                                                               id="cb1"/>
                                                                                        <label class="check-box" for="cb1"><img
                                                                                                    src="png/paypal-logo.png"/></label>
                                                                                    </li> -->
                                                                                    <li><input type="radio" value="voguepay" name="online"
                                                                                               id="cb2"/>
                                                                                        <label class="check-box" for="cb2"><img
                                                                                                    src="png/voguepay.png"/></label>
                                                                                    </li>
                                                                                    <!-- <li><input type="radio" name="online"
                                                                                               id="cb3"/>
                                                                                        <label class="check-box" for="cb3"><img
                                                                                                    src="png/visa-logo.png"/></label>
                                                                                    </li> -->
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="block push-bit col-xs-12">
                                                                    <div class="col-xs-12">
                                                                        <label class="input-label col-xs-12" style="padding: 0px;margin-bottom: 30px;">Our Bank Information</label>
                                                                        <div class="panel-bd lobidrag">
                                                                            <?php echo bankInfoWeb(); ?>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="block push-bit col-xs-12 deposit-panel"
                                                                     style="display:none;">
                                                                    <div class="col-xs-12">
                                                                        <label class="input-label col-xs-12" style="padding: 0px;">Upload Bank Deposit
                                                                            Slip</label>
                                                                        <div class="form-group input-group">
                                                                            <div  class="img-display" style=" display: none"> </div>
                                                                            <input id="input-preview" type="file" class="file" name="image">
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="block push-bit col-xs-12 transfer-panel"
                                                                     style="display:none;">
                                                                    <div class="col-xs-12">
                                                                        <label class="input-label col-xs-12">Submit Electronic
                                                                            Transfer Details</label>
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-6" style="padding: 0px;">
                                                                        <fieldset>
                                                                            <div class="form-group">
                                                                                <label class="input-label2 col-xs-12">Select
                                                                                    Method</label>
                                                                                <div class="col-xs-12">
                                                                                    <select id="method" name="method"
                                                                                            class="form-control input-b">
                                                                                        <optgroup label="">
                                                                                            <option selected disabled></option>
                                                                                            <option value="bank">Bank Transfer
                                                                                            </option>
                                                                                            <option value="ussd">USSD</option>
                                                                                        </optgroup>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="input-label2 col-xs-12">Blackloop's Account Information</label>
                                                                                <div class="col-xs-12">
                                                                                    <select id="bank_info" name="bank_info" class="form-control input-b">
                                                                                        <optgroup label="">
                                                                                            <option disabled selected></option>
                                                                                            <?php echo listBankAccount(); ?>
                                                                                        </optgroup>
                                                                                    </select>
                                                                                </div>
                                                                            </div>
                                                                            
                                                                        </fieldset>
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-6">
                                                                        <fieldset>
                                                                            
                                                                            <div class="form-group">
                                                                                <label class="input-label2 col-xs-12">Transaction
                                                                                    Date</label>
                                                                                <div class="col-xs-12">
                                                                                    <input id="trans_date" name="trans_date"
                                                                                           class="form-control input-b"
                                                                                           title="Transaction date" type="date">
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <label class="input-label2 col-xs-12">Transferring Account Name</label>
                                                                                <div class="col-xs-12">
                                                                                    <input id="customer_name"
                                                                                           name="customer_name"
                                                                                           class="form-control input-b"
                                                                                           type="text">
                                                                                </div>
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                </div>

                                                                
                                                                <div class="block push-bit col-xs-12" style="background: transparent;padding: 0px;">

                                                                    <div class="col-xs-12" style="padding: 0px;">
                                                                        <div class="form-group">
                                                                            <div class="g-recaptcha col-xs-12" data-sitekey="6LdSMUoUAAAAAKrpOV3-pZAzQhR-j1X7ujaBt7xs"></div>
                                                                        </div>
                                                                    
                                                                       <button name="submit" type="submit"
                                                                                onclick="return checkform();"
                                                                                class="hero_button"  style="margin-left:5px;"><i
                                                                                    class="fa fa-angle-right"></i>
                                                                            Continue
                                                                        </button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
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
            </div>

            <?php /*require_once "top-footer.php";*/ require_once "footer2.php"; ?>
        </div>
        <?php require_once "bottom-scripts.php"; ?>
    </body>
</html>