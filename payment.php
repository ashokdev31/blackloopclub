<?php 
    require_once "functions_basic.php";
    include "password_compat-master/lib/password.php";

    $countries = ['AF'=>"Afghanistan",
    'AX'=>"Ã…land Islands",
    'AL'=>"Albania",
    'DZ'=>"Algeria",
    'AS'=>"American Samoa",
    'AD'=>"Andorra",
    'AO'=>"Angola",
    'AI'=>"Anguilla",
    'AQ'=>"Antarctica",
    'AG'=>"Antigua and Barbuda",
    'AR'=>"Argentina",
    'AM'=>"Armenia",
    'AW'=>"Aruba",
    'AU'=>"Australia",
    'AT'=>"Austria",
    'AZ'=>"Azerbaijan",
    'BS'=>"Bahamas",
    'BH'=>"Bahrain",
    'BD'=>"Bangladesh",
    'BB'=>"Barbados",
    'BY'=>"Belarus",
    'BE'=>"Belgium",
    'BZ'=>"Belize",
    'BJ'=>"Benin",
    'BM'=>"Bermuda",
    'BT'=>"Bhutan",
    'BO'=>"Bolivia, Plurinational State of",
    'BQ'=>"Bonaire, Sint Eustatius and Saba",
    'BA'=>"Bosnia and Herzegovina",
    'BW'=>"Botswana",
    'BV'=>"Bouvet Island",
    'BR'=>"Brazil",
    'IO'=>"British Indian Ocean Territory",
    'BN'=>"Brunei Darussalam",
    'BG'=>"Bulgaria",
    'BF'=>"Burkina Faso",
    'BI'=>"Burundi",
    'KH'=>"Cambodia",
    'CM'=>"Cameroon",
    'CA'=>"Canada",
    'CV'=>"Cape Verde",
    'KY'=>"Cayman Islands",
    'CF'=>"Central African Republic",
    'TD'=>"Chad",
    'CL'=>"Chile",
    'CN'=>"China",
    'CX'=>"Christmas Island",
    'CC'=>"Cocos (Keeling) Islands",
    'CO'=>"Colombia",
    'KM'=>"Comoros",
    'CG'=>"Congo",
    'CD'=>"Congo, the Democratic Republic of the",
    'CK'=>"Cook Islands",
    'CR'=>"Costa Rica",
    'CI'=>"CÃ´te d'Ivoire",
    'HR'=>"Croatia",
    'CU'=>"Cuba",
    'CW'=>"CuraÃ§ao",
    'CY'=>"Cyprus",
    'CZ'=>"Czech Republic",
    'DK'=>"Denmark",
    'DJ'=>"Djibouti",
    'DM'=>"Dominica",
    'DO'=>"Dominican Republic",
    'EC'=>"Ecuador",
    'EG'=>"Egypt",
    'SV'=>"El Salvador",
    'GQ'=>"Equatorial Guinea",
    'ER'=>"Eritrea",
    'EE'=>"Estonia",
    'ET'=>"Ethiopia",
    'FK'=>"Falkland Islands (Malvinas)",
    'FO'=>"Faroe Islands",
    'FJ'=>"Fiji",
    'FI'=>"Finland",
    'FR'=>"France",
    'GF'=>"French Guiana",
    'PF'=>"French Polynesia",
    'TF'=>"French Southern Territories",
    'GA'=>"Gabon",
    'GM'=>"Gambia",
    'GE'=>"Georgia",
    'DE'=>"Germany",
    'GH'=>"Ghana",
    'GI'=>"Gibraltar",
    'GR'=>"Greece",
    'GL'=>"Greenland",
    'GD'=>"Grenada",
    'GP'=>"Guadeloupe",
    'GU'=>"Guam",
    'GT'=>"Guatemala",
    'GG'=>"Guernsey",
    'GN'=>"Guinea",
    'GW'=>"Guinea-Bissau",
    'GY'=>"Guyana",
    'HT'=>"Haiti",
    'HM'=>"Heard Island and McDonald Islands",
    'VA'=>"Holy See (Vatican City State)",
    'HN'=>"Honduras",
    'HK'=>"Hong Kong",
    'HU'=>"Hungary",
    'IS'=>"Iceland",
    'IN'=>"India",
    'ID'=>"Indonesia",
    'IR'=>"Iran, Islamic Republic of",
    'IQ'=>"Iraq",
    'IE'=>"Ireland",
    'IM'=>"Isle of Man",
    'IL'=>"Israel",
    'IT'=>"Italy",
    'JM'=>"Jamaica",
    'JP'=>"Japan",
    'JE'=>"Jersey",
    'JO'=>"Jordan",
    'KZ'=>"Kazakhstan",
    'KE'=>"Kenya",
    'KI'=>"Kiribati",
    'KP'=>"Korea, Democratic People's Republic of",
    'KR'=>"Korea, Republic of",
    'KW'=>"Kuwait",
    'KG'=>"Kyrgyzstan",
    'LA'=>"Lao People's Democratic Republic",
    'LV'=>"Latvia",
    'LB'=>"Lebanon",
    'LS'=>"Lesotho",
    'LR'=>"Liberia",
    'LY'=>"Libya",
    'LI'=>"Liechtenstein",
    'LT'=>"Lithuania",
    'LU'=>"Luxembourg",
    'MO'=>"Macao",
    'MK'=>"Macedonia, the former Yugoslav Republic of",
    'MG'=>"Madagascar",
    'MW'=>"Malawi",
    'MY'=>"Malaysia",
    'MV'=>"Maldives",
    'ML'=>"Mali",
    'MT'=>"Malta",
    'MH'=>"Marshall Islands",
    'MQ'=>"Martinique",
    'MR'=>"Mauritania",
    'MU'=>"Mauritius",
    'YT'=>"Mayotte",
    'MX'=>"Mexico",
    'FM'=>"Micronesia, Federated States of",
    'MD'=>"Moldova, Republic of",
    'MC'=>"Monaco",
    'MN'=>"Mongolia",
    'ME'=>"Montenegro",
    'MS'=>"Montserrat",
    'MA'=>"Morocco",
    'MZ'=>"Mozambique",
    'MM'=>"Myanmar",
    'NA'=>"Namibia",
    'NR'=>"Nauru",
    'NP'=>"Nepal",
    'NL'=>"Netherlands",
    'NC'=>"New Caledonia",
    'NZ'=>"New Zealand",
    'NI'=>"Nicaragua",
    'NE'=>"Niger",
    'NG'=>"Nigeria",
    'NU'=>"Niue",
    'NF'=>"Norfolk Island",
    'MP'=>"Northern Mariana Islands",
    'NO'=>"Norway",
    'OM'=>"Oman",
    'PK'=>"Pakistan",
    'PW'=>"Palau",
    'PS'=>"Palestinian Territory, Occupied",
    'PA'=>"Panama",
    'PG'=>"Papua New Guinea",
    'PY'=>"Paraguay",
    'PE'=>"Peru",
    'PH'=>"Philippines",
    'PN'=>"Pitcairn",
    'PL'=>"Poland",
    'PT'=>"Portugal",
    'PR'=>"Puerto Rico",
    'QA'=>"Qatar",
    'RE'=>"RÃ©union",
    'RO'=>"Romania",
    'RU'=>"Russian Federation",
    'RW'=>"Rwanda",
    'BL'=>"Saint BarthÃ©lemy",
    'SH'=>"Saint Helena, Ascension and Tristan da Cunha",
    'KN'=>"Saint Kitts and Nevis",
    'LC'=>"Saint Lucia",
    'MF'=>"Saint Martin (French part)",
    'PM'=>"Saint Pierre and Miquelon",
    'VC'=>"Saint Vincent and the Grenadines",
    'WS'=>"Samoa",
    'SM'=>"San Marino",
    'ST'=>"Sao Tome and Principe",
    'SA'=>"Saudi Arabia",
    'SN'=>"Senegal",
    'RS'=>"Serbia",
    'SC'=>"Seychelles",
    'SL'=>"Sierra Leone",
    'SG'=>"Singapore",
    'SX'=>"Sint Maarten (Dutch part)",
    'SK'=>"Slovakia",
    'SI'=>"Slovenia",
    'SB'=>"Solomon Islands",
    'SO'=>"Somalia",
    'ZA'=>"South Africa",
    'GS'=>"South Georgia and the South Sandwich Islands",
    'SS'=>"South Sudan",
    'ES'=>"Spain",
    'LK'=>"Sri Lanka",
    'SD'=>"Sudan",
    'SR'=>"Suriname",
    'SJ'=>"Svalbard and Jan Mayen",
    'SZ'=>"Swaziland",
    'SE'=>"Sweden",
    'CH'=>"Switzerland",
    'SY'=>"Syrian Arab Republic",
    'TW'=>"Taiwan, Province of China",
    'TJ'=>"Tajikistan",
    'TZ'=>"Tanzania, United Republic of",
    'TH'=>"Thailand",
    'TL'=>"Timor-Leste",
    'TG'=>"Togo",
    'TK'=>"Tokelau",
    'TO'=>"Tonga",
    'TT'=>"Trinidad and Tobago",
    'TN'=>"Tunisia",
    'TR'=>"Turkey",
    'TM'=>"Turkmenistan",
    'TC'=>"Turks and Caicos Islands",
    'TV'=>"Tuvalu",
    'UG'=>"Uganda",
    'UA'=>"Ukraine",
    'AE'=>"United Arab Emirates",
    'GB'=>"United Kingdom",
    'US'=>"United States",
    'UM'=>"United States Minor Outlying Islands",
    'UY'=>"Uruguay",
    'UZ'=>"Uzbekistan",
    'VU'=>"Vanuatu",
    'VE'=>"Venezuela, Bolivarian Republic of",
    'VN'=>"Viet Nam",
    'VG'=>"Virgin Islands, British",
    'VI'=>"Virgin Islands, U.S.",
    'WF'=>"Wallis and Futuna",
    'EH'=>"Western Sahara",
    'YE'=>"Yemen",
    'ZM'=>"Zambia",
    'ZW'=>"Zimbabwe",];


    if(!isset($_POST['register']) && !isset($_POST['submit']) && !isset($_GET['back'])){
        header("Location: register");
        exit;
    }

    if(isset($_GET['back'])){
        if($_POST['sellerator']=="1"){
            header("Location: register-sellerator");
            exit;
        }else{
            header("Location: register");
            exit;
        }
    }

    
    if(isset($_POST['submit'])){
        
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $street_address = $_POST['street_address'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $zip_code = $_POST['zip_code'];
        $phone_number = $_POST['phone_number'];
        $sellerator = $_POST['sellerator'];
        if($sellerator=="1"){
            $referral = "9E9Y25";   /// modification required
            $user_type = "sellerator";
        }else{
            $referral = $_POST['referral'];
            $query = selectPDO("select * from users where user_code = ? and user_status = '1' and roles is NULL", array($referral));
            if($query->rowCount()==0){
                $referral = "000000";
            }
            $user_type = "privilege";
        }
        
        if(isset($_POST['email_promo'])){$email_promo = $_POST['email_promo'];}else{$email_promo="0";}

        $hash = password_hash($password, PASSWORD_BCRYPT);
        $email_hash = password_hash($email, PASSWORD_BCRYPT);
        
        do{
            $user_code = generateRandomString(6);
            $query = selectPDO("select * from users where user_code = ?", array($user_code));
        }while($query->rowCount()>0 || $user_code == "000000");
        $date = date("Y-m-d H:i:s");
        otherPDO("insert into users (fname, lname, email, email_slug, password, street_address, country, city, zip_code, phone_number, referral_code, email_promo, user_code, date_registered, date_modified) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?) ",array($fname, $lname, $email, $email_hash, $hash, $street_address, $country, $city, $zip_code, $phone_number, $referral, $email_promo, $user_code, $date, $date));

        
        $query = selectPDO("select * from users where user_code = ?", array($user_code));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $user_id = $row['id'];
        }

        // open account for user
        otherPDO("insert into accounts (user_id, date_modified) values (?,?)", array($user_id, $date));

        // SEND EMAIL
        $link = "https://www.blackloopclub.com/login?x";
        $to      = $email;
        $subject = "Thank You for Registering on Blackloop Club!";
        $query = selectPDO("select * from page_details where name = 'after_register'", array());
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

        $notification_type = "register";
        sendNotification($user_id, $notification_type, "", "", "", "");

        $payment_type = $_POST['payment_type'];
        $electronic_method = "";
        $image = "";
        $bank_name = "";
        $acct_name = "";
        $acct_number = "";
        $trans_date = NULL;
        $customer_name = "";

        if($payment_type=="card"){
            $electronic_method = $_POST['online'];
        }elseif($payment_type=="deposit"){
            // $image = $_POST['image'];

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
            if($payment_type!="gtb"){
                otherPDO("insert into payments (user_id, type, file, elect_method, bank_name, acct_name, acct_number, trans_date, payer_name, user_type, date_posted, date_modified) values (?,?,?,?,?,?,?,?,?,?,?,?)", array($user_id, $payment_type, $image, $electronic_method, $bank_name, $acct_name, $acct_number, $trans_date, $customer_name, $user_type, $date, $date));
                $query = selectPDO("select * from payments where user_id = ? and date_posted = ?", array($user_id, $date));
                while($row=$query->fetch(PDO::FETCH_ASSOC)){
                    $payment_id = $row['id'];
                }
            }else{
                otherPDO("update users set user_status = '2' where id = ?", array($user_id));
            }

            if($payment_type=="card"){
                $_SESSION['proceed_online'] = "";
                $_SESSION['online_method'] = $electronic_method;
                $_SESSION['ussr_aidy'] = $user_id;
                $_SESSION['ussr_naim'] = $fname." ".$lname;
                $_SESSION['email'] = $email;
                $_SESSION['payment_id'] = $payment_id;
                $_SESSION['user_type'] = $user_type;
                otherPDO("update payments set payment_status = ? where id = ?", array("2", $payment_id));
                otherPDO("update users set user_status = ? where id = ?", array("2", $user_id));
                header("Location: online-payment");
                exit;
            }else{
                $_SESSION['confirm_reg'] = "";
                header("Location: confirmation");
                exit;
            }
        }

    }

    if(isset($_POST['register'])){
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
            $_SESSION['register_error']="reCAPTCHA failed!";
            if($response['hostname']=="blackloopclub.com" || $response['hostname']=="www.blackloopclub.com"){
                $_SESSION['fname'] = $_POST['fname'];
                $_SESSION['lname'] = $_POST['lname'];
                $_SESSION['email'] = $_POST['email'];
                $_SESSION['age'] = $_POST['age'];
                $_SESSION['street_address'] = $_POST['street_address'];
                $_SESSION['country'] = $_POST['country'];
                $_SESSION['city'] = $_POST['city'];
                $_SESSION['zip_code'] = $_POST['zip_code'];
                $_SESSION['phone_number'] = $_POST['phone_number'];
                $_SESSION['referral'] = $_POST['referral'];
                if(isset($_POST['email_promo'])){$_SESSION['email_promo'] = $_POST['email_promo'];}
            }

            if($_POST['sellerator']=="1"){
                header("Location: register-sellerator");
                exit;
            }else{
                header("Location: register");
                exit;
            }
        }
    }

    
    $_SESSION['fname'] = $fname = $_POST['fname'];
    $_SESSION['lname'] = $lname = $_POST['lname'];
    $_SESSION['email'] = $email = $_POST['email'];
    $_SESSION['age'] = $age = $_POST['age'];
    $_SESSION['street_address'] = $street_address = $_POST['street_address'];
    $_SESSION['country'] = $country = $_POST['country'];
    $_SESSION['city'] = $city = $_POST['city'];
    $_SESSION['zip_code'] = $zip_code = $_POST['zip_code'];
    $_SESSION['phone_number'] = $phone_number = $_POST['phone_number'];
    $_SESSION['referral'] = $referral = $_POST['referral'];
    if(isset($_POST['email_promo'])){$_SESSION['email_promo'] = $email_promo = $_POST['email_promo'];}

    // check for existing user with same email
    $query = selectPDO("select * from users where email = ?", array($_POST['email']));
    if($query->rowCount()>0){
        $_SESSION['register_error'] = "This email has already been registered!";
        if($_POST['sellerator']=="1"){
            header("Location: register-sellerator");
            exit;
        }else{
            header("Location: register");
            exit;
        }
    }

    // match passwords
    if($_POST['password']!=$_POST['password_confirmation']){
        $_SESSION['register_error'] = "Passwords do not match!";
        if($_POST['sellerator']=="1"){
            header("Location: register-sellerator");
            exit;
        }else{
            header("Location: register");
            exit;
        }
    }

    $password = $_POST['password'];
    $sellerator = $_POST['sellerator'];

    $query = selectPDO("select * from payout_settings", array());
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        if($_POST['sellerator']=="1"){
            if($row['type']=='sellerator'){
                $exchange1 = $row['exchange'];
            }
        }else{
            if($row['type']=='privilege'){
                $exchange1 = $row['exchange'];
            }
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
        
        <title>.: Payment | BlackLoop Club :.</title>
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
                                                                <h1><strong>Payment</strong></h1>
                                                                <img src="png/step-counter2.png"
                                                                     style="width:230px;margin-top:20px;"/>
                                                            </div>
                <form action="payment"
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
                            <label class="input-label mylist col-xs-12 gtb-button"
                                   style="font-size:16px !important;"
                                   for="gtb_collections">
                                <input required id="gtb_collections"
                                       onclick="this.blur();"
                                       style="margin-right:10px;"
                                       name="payment_type"
                                       value="gtb" type="radio"> GT Collections
                                <span class="fa fa-university"
                                      style="margin-left: 5px;"></span>
                            </label>
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
                    <div class="block push-bit col-xs-12 gtb-panel"
                         style="display:none;">
                        <div class="col-xs-12">
                            <label class="input-label col-xs-12">Pay Later Using GT Collections</label>
                            <div class="form-group">
                                <div class="col-xs-12">
                                    <p>Continue below to login to your dashboard and use your Blackloop Club User Code (BLC-UC) to make payment via any of the GTB Collections channels.</p>
                                </div>
                            </div>
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

                    
                    <div class="block push-bit col-xs-12">

                        
                        <div class="col-xs-12 col-sm-6">
                            <fieldset>
                                <label class="input-label col-xs-12">Preview
                                    your information</label>
                                <div class="form-group">
                                    <div class="col-xs-12" style="padding:0px;">
                                        <input id="fname" name="fname" readonly
                                               class="form-control input-b"
                                               placeholder="First name"
                                               type="text"
                                               value="<?php echo $fname; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12" style="padding:0px;">
                                        <input id="lname" name="lname" readonly
                                               class="form-control input-b"
                                               placeholder="Last name"
                                               type="text"
                                               value="<?php echo $lname; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12" style="padding:0px;">
                                        <input id="email" readonly name="email"
                                               class="form-control input-b"
                                               placeholder="Email address"
                                               type="email"
                                               value="<?php echo $email; ?>">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                                <label class="input-label"
                                       style="font-size:14px !important;"
                                       for="contact">
                                    <input id="contact" name="email_promo"
                                           <?php if(isset($email_promo)){ echo "checked"; } ?> value="1"
                                           type="checkbox">
                                    Contact me via e-mail
                                </label>
                            </fieldset>
                        </div>
                        <div class="col-xs-12 col-sm-6">
                            <fieldset>
                                <label class="input-label hidden-xs col-sm-12">&nbsp;</label>
                                <div class="form-group">
                                    <div class="col-xs-12" style="padding:0px;">
                                        <input id="maddress" readonly
                                               name="street_address"
                                               class="form-control input-b"
                                               placeholder="Street address"
                                               type="text"
                                               value="<?php echo $street_address; ?>">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12" style="padding:0px;">
                                        
                                        <select id="country" required name="country" readonly class="form-control input-b">
                                        <optgroup label="">
                                            <option <?php if(!isset($country)){ ?> selected <?php } ?> disabled>Select
                                                Country
                                            </option>
                                            <?php foreach ($countries as $key => $count) { ?>
                                                <option <?php if(isset($country) && $country==$key){echo "selected"; } ?> value="<?php echo $key ?>"><?php echo $count; ?></option>
                                            <?php } ?>
                                            
                                        </optgroup>
                                    </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                   
                                    <div class="col-xs-12 col-sm-6" style="padding: 0px;">
                                        <input id="fname" readonly name="city"
                                               class="form-control input-b"
                                               placeholder="City"
                                               type="text"
                                               value="<?php echo $city; ?>">
                                    </div>
                                    <div class="col-xs-12 col-sm-6" style="padding: 0px;">
                                        <input id="zip_code" readonly
                                               name="zip_code"
                                               class="form-control input-b"
                                               placeholder="Zip Code (optional)"
                                               type="number"
                                               value="<?php echo $zip_code; ?>">
                                    </div>
                                </div>
                            </fieldset>
                            <fieldset>
                            <div class="form-group">
                                
                                <div class="col-xs-12 col-sm-6" style="padding: 0px;">
                                    <input id="pnumber" readonly
                                           name="phone_number"
                                           class="form-control input-b"
                                           placeholder="Phone number"
                                           type="text"
                                           value="<?php echo $phone_number; ?>">
                                </div>
                                <div class="col-xs-12 col-sm-6" style="padding: 0px;">
                                    <input id="referral" readonly
                                           name="referral"
                                           class="form-control input-b"
                                           placeholder="Referral code (optional)"
                                           value="<?php echo $referral; ?>"
                                           type="text">
                                </div>
                            </div>
                             </fieldset>
                            
                            <fieldset>
                                <div class="form-group form-actions">
                                    <div class="col-xs-12 continue" style="padding:0px;">
                                        
                                        <input type="password"
                                               name="password"
                                               value="<?php echo $password; ?>"
                                               style="display: none;">
                                        <a href="?back">
                                            <button type="button"
                                                    class="hero_button"><i
                                                        class="fa fa-angle-left"></i>
                                                Back
                                            </button>
                                        </a>
                                       
                                        <button name="submit" type="submit"
                                                onclick="return checkform();"
                                                class="hero_button"  style="margin-left:5px;"><i
                                                    class="fa fa-angle-right"></i>
                                            Continue
                                        </button>
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                        <div class="form-group">
                            <div class="col-xs-12" style="padding:0px;">
                                <div class="col-xs-12 login">Do you have an
                                    account?
                                    <a style="color:#FE6802"
                                       href="login">
                                        <small>Login</small>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <input type="text" value="<?php echo $sellerator; ?>" name="sellerator" style="display: none;">
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