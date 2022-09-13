<?php 
    require_once "../functions_basic.php";
    include "../password_compat-master/lib/password.php";
    require_once "validation.php";

    validateUser();

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $user_code = $row['user_code'];
    }

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

    if(isset($_GET['rp'])){ // reset PIN
        $date = date("Y-m-d H:i:s");
        $hash = password_hash(date("YmdHis"), PASSWORD_BCRYPT);
        
        $query = selectPDO("select * from users where user_code = ?", array($user_code));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $email = $row['email'];
            $email_slug = $row['email_slug'];
            $fname = $row['fname'];
        }
        otherPDO("update users set user_pin = ?, date_modified = ? where user_code = ?", array($hash, $date, $user_code));

        // send message
        $link = "https://www.blackloopclub.com/reset-pin?m={$email_slug}&x={$hash}";
        $to      = $email;
        $subject = "Reset Your Transaction PIN!";
        $message = "Dear {$fname},<br/><br/>Please click <a href='{$link}'>HERE</a> to set your transaction PIN.<br/><br/><br/>Blackloop Club Team";
        $message = wordwrap($message, 70, "\r\n");
        $headers = 'Content-type: text/html; charset=iso-8859-1; charset=utf-8'."\r\n".
                    'From: Blackloop Club <no-reply@blackloopclub.com>' . "\r\n" .
                    'Reply-To: contact@blackloopclub.com' . "\r\n" .
                    'X-Mailer: PHP/' . phpversion();

        mail($to, $subject, $message, $headers);
        $success = "PIN reset link has been sent to your email successfully!";
    }

    if(isset($_POST['update_password'])){
        $old_password = $_POST['old_password'];
        $new_password = $_POST['new_password'];
        $new_password2 = $_POST['new_password2'];

        if($new_password != $new_password2){
            $error = "New password does not match!";
        }else{
            $query = selectPDO("select * from users where user_code = ?", array($user_code));
            $row = $query->fetch(PDO::FETCH_ASSOC);
            $password = $row['password'];

            if(!password_verify($old_password, $password)){
                $error = "Old password does not match!";
            }else{
                $hash = password_hash($new_password, PASSWORD_BCRYPT);
                $user = array($_SESSION['blackloop_slug'][0], $_SESSION['blackloop_slug'][1], $_SESSION['blackloop_slug'][2], $_SESSION['blackloop_slug'][3], $_SESSION['blackloop_slug'][4], $hash);
                $_SESSION['blackloop_slug'] = $user;
                otherPDO("update users set password = ? where user_code = ?", array($hash, $user_code));
                $success = "Password was changed successfully";
            }
        }
    }

    if(isset($_POST['set_pin'])){
        $new_pin = $_POST['new_pin'];
        $new_pin2 = $_POST['new_pin2'];

        if(is_numeric($new_pin)){
            if(strlen($new_pin)!=4){
                $error = "Transaction PIN must be 4 characters long!";
            }else{
                if($new_pin != $new_pin2){
                    $error = "Transaction PIN does not match!";
                }else{
                    $hash = password_hash($new_pin, PASSWORD_BCRYPT);
                    otherPDO("update users set user_pin = ? where user_code = ?", array($hash, $user_code));
                    $success = "Transaction PIN was set successfully";
                }
            }
        }else{
            $error = "Transaction PIN must be numeric characters!";
        }
    }

    if(isset($_POST['update_pin'])){
        $old_pin = $_POST['old_pin'];
        $new_pin = $_POST['new_pin'];
        $new_pin2 = $_POST['new_pin2'];

        if(strlen($new_pin)!=4){
            $error = "Transaction PIN must be 4 characters long!";
        }else{
            if($new_pin != $new_pin2){
                $error = "Transaction PIN does not match!";
            }else{
                $query = selectPDO("select * from users where user_code = ?", array($user_code));
                $row = $query->fetch(PDO::FETCH_ASSOC);
                $pin = $row['user_pin'];

                if(!password_verify($old_pin, $pin)){
                    $error = "Old PIN does not match!";
                }else{
                    $hash = password_hash($new_pin, PASSWORD_BCRYPT);
                    otherPDO("update users set user_pin = ? where user_code = ?", array($hash, $user_code));
                    $success = "Transaction PIN was changed successfully";
                }
            }
        }
    }

    if(isset($_POST['update_account'])){
        $bank_name = $_POST['bank_name'];
        $acct_name = $_POST['acct_name'];
        $acct_number = $_POST['acct_number'];
        $acct_type = $_POST['acct_type'];
        $swift_code = $_POST['swift_code'];
        $trans_pin = $_POST['trans_pin'];

        $query = selectPDO("select * from users where user_code = ?", array($user_code));
        $row=$query->fetch(PDO::FETCH_ASSOC);
        $pin = $row['user_pin'];

        if($pin!=null){
            if(!password_verify($trans_pin, $pin)){
                $error = "Transaction PIN is incorrect!";
            }else{
                otherPDO("update users set bank_name = ?, acct_name = ?, acct_number = ?, acct_type = ?, swift_code = ? where user_code = ?", array($bank_name, $acct_name, $acct_number, $acct_type, $swift_code, $user_code));
                $success = "Update was successful!";
            }
        }else{
            $error = "Please set a Transaction PIN to proceed!";
        }
    }

    if(isset($_POST['update_profile'])){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $street_address = $_POST['street_address'];
        $country = $_POST['country'];
        $city = $_POST['city'];
        $zip_code = $_POST['zip_code'];
        $phone_number = $_POST['phone_number'];
        if($_POST['birthday']==NULL){$birthday=NULL;}else{$birthday = $_POST['birthday'];};
        $date = date("Y-m-d H:i:s");

        $query = selectPDO("select * from users where user_code = ?", array($user_code));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $image = $row['profile_pic'];
        }

        if(isset($_FILES["image"]) && $_FILES["image"]['size']>0){

            define("UPLOAD_DIR", "../account/profile_pictures/");

            if($_FILES["image"]['size']>5000000){
                $error = "File size cannot be more than 5mb!";
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

                if (!isset($success)) {
                    echo "<p>Unable to save file.</p>";
                    exit;
                }
                // set proper permissions on the new file
                chmod(UPLOAD_DIR . $name, 0644);

                $image = substr((UPLOAD_DIR.$name), 3);

                $query = selectPDO("select * from users where user_code = ?", array($user_code));
                while($row=$query->fetch(PDO::FETCH_ASSOC)){
                    if($row['profile_pic']!="img/default-user.png"){
                        if(!unlink("../".$row['profile_pic'])){
                            echo "error deleting file";
                        }
                    }
                }

            }
        }

        if(!isset($error)){
            $user = array($_SESSION['blackloop_slug'][0], $_SESSION['blackloop_slug'][1], $fname, $lname, $image, $_SESSION['blackloop_slug'][5]);
            $_SESSION['blackloop_slug'] = $user;
            otherPDO("update users set profile_pic =?, fname=?, lname=?, street_address=?, birthday=?, country=?, city=?, zip_code=?, phone_number=?, date_modified=? where user_code = ?",array($image, $fname, $lname, $street_address, $birthday, $country, $city, $zip_code, $phone_number, $date, $user_code));
            $success = "Update was successful!";
        }
        
    }

    
    $query = selectPDO("select * from users where user_code = ?", array($user_code));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $dp = "../".$row['profile_pic'];
        $names = $row['fname']." ".$row['lname'];
        $fname = $row['fname'];
        $lname = $row['lname'];
        $user_pin = $row['user_pin'];
        $city = $row['city'];
        $zip_code = $row['zip_code'];
        foreach ($countries as $key => $nation) {
            if($row['country'] == $key){$country=$nation;}
        }
        $location = $city.", ".$country.", ".$zip_code;
        $level = $row['user_level'];
        $user_status = $row['user_status'];
        if($row['user_status']=="1"){
            $status="<span class='label label-outline label-success-outline m-r-15' style='height: 20px;margin-top: 10px;margin-left:-60px;z-index:1;background:#fff;'>Active</span>";
        }elseif($row['user_status']=="-1"){
            $status="<span class='label label-outline label-danger-outline m-r-15' style='height: 20px;margin-top: 10px;margin-left:-60px;z-index:1;background:#fff;'>Blocked</span>";
        }elseif($row['user_status']=="0"){
            $status="<span class='label label-outline label-primary-outline m-r-15' style='height: 20px;margin-top: 10px;margin-left:-60px;z-index:1;background:#fff;'>Pending</span>";
        }elseif($row['user_status']=="2"){
            $status="<span class='label label-outline label-warning-outline m-r-15' style='height: 20px;margin-top: 10px;margin-left:-60px;z-index:1;background:#fff;'>Declined</span>";
        }elseif($row['user_status']=="4"){
            $status="<span class='label label-outline label-danger-outline m-r-15' style='height: 20px;margin-top: 10px;margin-left:-60px;z-index:1;background:#fff;'>Restricted</span>";
        }elseif($row['user_status']=="3"){
            $status="<span class='label label-outline label-danger-outline m-r-15' style='height: 20px;margin-top: 10px;margin-left:-60px;z-index:1;background:#fff;'>Deactivated</span>";
        }
        $user_type = strtoupper($row['user_type']);
        $user_id = $row['id'];
        $address = $row['street_address'];
        $email = $row['email'];
        $phone = $row['phone_number'];
        $user_code = $row['user_code'];
        $date_registered = date("D, j M Y g:i a", strtotime($row['date_registered']));
        $date_activated = date("D, j M Y g:i a", strtotime($row['date_activated']));
        $last_on = date("D, j M Y g:i a", strtotime($row['last_online']));
        if($row['birthday']==NULL){
            $birthday = "N/a";
            $birth = $birthday;
        }else{
            $birthday = date("j M Y", strtotime($row['birthday']));
            $birth = $row['birthday'];
        }
        if(trim($row['bank_name'])==""){$bank_name="n/a";$bank_name2 = $row['bank_name'];}else{$bank_name = $bank_name2 = $row['bank_name'];}
        if(trim($row['acct_name'])==""){$acct_name="n/a";$acct_name2 = $row['acct_name'];}else{$acct_name = $acct_name2 = $row['acct_name'];}
        if(trim($row['acct_number'])==""){$acct_number="n/a";$acct_number2 = $row['acct_number'];}else{$acct_number = $acct_number2 = $row['acct_number'];}
        if(trim($row['acct_type'])==""){$acct_type="n/a";$acct_type2 = $row['acct_type'];}else{$acct_type = $acct_type2 = $row['acct_type'];}
        if(trim($row['swift_code'])==""){$swift_code="n/a";$swift_code2 = $row['swift_code'];}else{$swift_code = $swift_code2 = $row['swift_code'];}

    }


    $query = selectPDO("select * from accounts where user_id = ?", array($user_id));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $wallet_bal = $row['wallet_bal'];
        $voucher_bal = $row['voucher_bal'];
        $car = $row['car'];
        $house = $row['house'];
    }

    $query=selectPDO("select * from referrals where sponsor_id = ?", array($user_id));
    $referrals=$query->rowCount();

    $query = selectPDO("select * from payments where user_id = ? order by date_posted desc", array($user_id));
    $payment_size = $query->rowCount();
    $payment = "";
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $payment_id = $row['id'];
        $type = strtoupper($row['user_type']);
        $option = ucfirst($row['type']);
        $trans_date = substr(date("D, j M Y g:i a", strtotime($row['trans_date'])), 0, 16);
        $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
        $date_modified = date("D, j M Y g:i a", strtotime($row['date_modified']));
        if($row['payment_status']=="0"){$payment_status = "Pending";}elseif($row['payment_status']=="1"){$payment_status = "Approved";}elseif($row['payment_status']=="3"){$payment_status = "Partial Approval";}elseif($row['payment_status']=="2"){$payment_status = "Declined";}
        if(trim($row['amount'])==""){$amount="n/a";}else{$amount=$row['amount'];}
        if($row['type']=="deposit"){
            
            $payment .= "
                        <div class='row' style='margin-top: 10px;'>
                            <div class='col-sm-5'>
                                <img src='../{$row['file']}' width='100%' class='img-rounded' alt='deposit slip image'>
                                <div class='btn btn-primary col-xs-12' data-toggle='modal' data-target='#enlarge{$payment_id}' style='margin-top:-30px;margin-bottom:20px;'><span class='fa fa-search-plus'></span> Enlarge Image</div>
                            </div>
                            <div class='col-sm-7'>
                                <div style='width: 40%;color:#FFF;float:left;'>Type:</div><div style='width:60%;float:left'>{$type}</div><br/>
                                <div style='width: 40%;color:#FFF;float:left'>Option:</div><div style='width:60%;float:left'>{$option}</div><br/>
                                <div style='width: 40%;color:#FFF;float:left'>Amount Paid:</div><div style='width:60%;float:left'>{$amount}</div><br/>
                                <div style='width: 40%;color:#FFF;float:left'>Payment Status:</div><div style='width:60%;float:left'>{$payment_status}</div><br/><br/>
                                <div style='width: 40%;color:#FFF;float:left'>Date Posted:</div><div style='width:60%;float:left'>{$date_posted}</div><br/>
                                <div style='width: 40%;color:#FFF;float:left'>Last Modified:</div><div style='width:60%;float:left'>{$date_modified}</div><br/>
                            </div>
                        </div>

                        <div class='modal fade' id='enlarge{$payment_id}' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <h1 class='modal-title'>Uploaded File</h1>
                                    </div>
                                    <div class='modal-body'>
                                        <img src='../{$row['file']}' width='100%' class='img-rounded' alt='deposit slip image'>
                                    </div>
                                    <div class='modal-footer'>
                                        <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>";
        }elseif($row['type']=="transfer"){
            
            $payment .= "
                        <div class='row' style='margin-top: 10px;'>
                            <div class='col-sm-12'>
                                <div style='width: 40%;color:#FFF;float:left'>Type:</div><div style='width:60%;float:left'>{$type}</div><br/>
                                <div style='width: 40%;color:#FFF;float:left'>Option:</div><div style='width:60%;float:left'>{$option}</div><br/>
                                <div style='width: 40%;color:#FFF;float:left'>Bank Name:</div><div style='width:60%;float:left'>{$row['bank_name']}</div><br/>
                                <div style='width: 40%;color:#FFF;float:left'>Acct. Name:</div><div style='width:60%;float:left'>{$row['acct_name']}</div><br/>
                                <div style='width: 40%;color:#FFF;float:left'>Acct. Number:</div><div style='width:60%;float:left'>{$row['acct_number']}</div><br/>
                                <div style='width: 40%;color:#FFF;float:left'>Trans. Date:</div><div style='width:60%;float:left'>{$trans_date}</div><br/>
                                <div style='width: 40%;color:#FFF;float:left'>Payer Name:</div><div style='width:60%;float:left'>{$row['payer_name']}</div><br/>
                                <div style='width: 40%;color:#FFF;float:left'>Amount Paid:</div><div style='width:60%;float:left'>{$amount}</div><br/>
                                <div style='width: 40%;color:#FFF;float:left'>Payment Status:</div><div style='width:60%;float:left'>{$payment_status}</div><br/><br/>
                                <div style='width: 40%;color:#FFF;float:left'>Date Posted:</div><div style='width:60%;float:left'>{$date_posted}</div><br/>
                                <div style='width: 40%;color:#FFF;float:left'>Last Modified:</div><div style='width:60%;float:left'>{$date_modified}</div><br/>
                            </div>
                        </div>
                        <hr>";
        }elseif($row['type']=="card"){
            
            $payment .= "
                        <div class='row' style='margin-top: 10px;'>
                            <div class='col-sm-12'>
                                <div style='width: 40%;float:left;color:#FFF;'>Type:</div><div style='width:60%;float:left'>{$type}</div><br/>
                                <div style='width: 40%;float:left;color:#FFF;'>Option:</div><div style='width:60%;float:left'>{$option}</div><br/>
                                <div style='width: 40%;float:left;color:#FFF;'>Method:</div><div style='width:60%;float:left'>{$row['elect_method']}</div><br/>
                                <div style='width: 40%;float:left;color:#FFF;'>Amount Paid:</div><div style='width:60%;float:left'>{$amount}</div><br/>
                                <div style='width: 40%;float:left;color:#FFF;'>Payment Status:</div><div style='width:60%;float:left'>{$payment_status}</div><br/><br/>
                                <div style='width: 40%;float:left;color:#FFF;'>Date Posted:</div><div style='width:60%;float:left'>{$date_posted}</div><br/>
                                <div style='width: 40%;float:left;color:#FFF;'>Last Modified:</div><div style='width:60%;float:left'>{$date_modified}</div><br/>
                            </div>
                        </div>
                        <hr>";
        }elseif($row['type']=="GTCOLLECTIONS"){
            
            $payment .= "
                        <div class='row' style='margin-top: 10px;'>
                            <div class='col-sm-12'>
                                <div style='width: 40%;float:left;color:#FFF;'>Type:</div><div style='width:60%;float:left'>{$type}</div><br/>
                                <div style='width: 40%;float:left;color:#FFF;'>Option:</div><div style='width:60%;float:left'>{$option}</div><br/>
                                <div style='width: 40%;float:left;color:#FFF;'>Method:</div><div style='width:60%;float:left'>{$row['elect_method']}</div><br/>
                                <div style='width: 40%;float:left;color:#FFF;'>Amount Paid:</div><div style='width:60%;float:left'>{$amount}</div><br/>
                                <div style='width: 40%;float:left;color:#FFF;'>Payment Status:</div><div style='width:60%;float:left'>{$payment_status}</div><br/><br/>
                                <div style='width: 40%;float:left;color:#FFF;'>Date Posted:</div><div style='width:60%;float:left'>{$date_posted}</div><br/>
                                <div style='width: 40%;float:left;color:#FFF;'>Last Modified:</div><div style='width:60%;float:left'>{$date_modified}</div><br/>
                            </div>
                        </div>
                        <hr>";
        }
    }
    


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>My Profile | Blackloop Club</title>
        <?php require_once "styles.php"; ?>

        <style type="text/css">
            .password {
                padding: 15px;
                border-radius: 5px;
            }

            .password ul {
                margin: 0px;
                padding: 0px;
            }

            .password ul li {
                list-style: none;
                float: left;
                margin-right: 20px;
            }

            .password ul li a {
                /*font-weight: bold;*/
                display: block;
            }

        </style>
    </head>
    <body>
        <div id="wrapper" class="wrapper animsition">
            <?php 
                require_once "header.php"; 
                require_once "sidebar-left.php"; 
                // require_once "sidebar-right.php"; 
            ?>
            
            <div class="control-sidebar-bg"></div>

            <div id="page-wrapper">
                <div class="content">
                   
                    <div class="content-header">
                         <?php require_once "news-flash.php"; ?>
                        <div class="header-icon">
                            <i class="fa fa-user-circle"></i>
                        </div>
                        <div class="header-title">
                            <h1>My Profile</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">My Profile</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">

                        <?php if(isset($error)){ ?>
                        <div class="col-xs-12">
                            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                        </div>
                        <?php }elseif(isset($success)){ ?>
                        <div class="col-xs-12">
                            <div class="alert alert-success text-center"><?php echo $success; ?></div>
                        </div>
                        <?php } if($user_status==0){ ?>
                        <div class="col-xs-12">
                            <div class="alert alert-danger text-center"><span class="fa fa-exclamation-triangle"></span> Your payment is undergoing review, please allow some time for this to be completed before your account can become active!</div>
                        </div>
                        <?php }elseif($user_status==2 && $payment_size==0){ ?>
                        <div class="col-xs-12">
                            <div class="alert alert-danger text-center"><span class="fa fa-exclamation-triangle"></span> You are yet to make any payment! Kindly use <b><?php echo $user_code; ?></b> as your Blackloop Clup Usercode to make payment via any of the GT Collections channels of Guaranteed Trust Bank Plc or go to My Profile and scroll down to Payments and click on Add New Payment to use other payment options.</div>
                        </div>
                        <?php }elseif($user_status==2){ ?>
                        <div class="col-xs-12">
                            <div class="alert alert-danger text-center"><span class="fa fa-exclamation-triangle"></span> Please complete payment for your account to become active! Your previous payment was either declined or partially approved, scroll down to Payments and click on Add New Payment</div>
                        </div>
                        <?php } ?>

                        <div class="col-xs-12 hidden-sm hidden-md hidden-lg">
                            <div class="row" style="margin-bottom: 30px;">
                                <div class="col-sm-12 col-md-6">
                                    <div class="rating-block">
                                        <h4>User Level: <small style="font-size: 17px;margin-left: 10px;"><?php if($level!="exclusive"){ echo $level; $rem = 7-$level; }else{ echo "Exclusive"; } ?> (<?php echo $user_type; ?>)</small></h4>
                                        <?php if($level!="exclusive"){
                                        for($i=0; $i<$level; $i++){ ?>
                                        <button type="button" class="btn btn-success btn-sm" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                        </button>
                                        <?php } for($i=0; $i<$rem; $i++){ ?>
                                        <button type="button" class="btn btn-default btn-sm" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                        </button>
                                        <?php }}else{ for($i=0; $i<7; $i++){ ?>
                                        <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                            <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                        </button>
                                        <?php }} ?>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-md-6">
                                    <!-- <h4 class="m-t-0">Bonuses</h4> -->
                                    <div class="pull-left col-xs-12" style="padding: 0px; margin-top: 5px;">
                                        <span class="fab fa-google-wallet" style="font-weight: bold;"> Wallet Balance: <span class="label label-pill label-default m-r-15" style="color: #000">&#8358; <?php echo number_format($wallet_bal, 2); ?></span></span>
                                    </div>
                                    <div class="pull-left col-xs-12" style="padding: 0px; margin-top: 5px;">
                                        <span class="fa fa-shopping-cart"> Shopping Voucher: <span class="label label-pill label-default m-r-15" style="color: #000">&#8358; <?php echo number_format($voucher_bal, 2); ?></span></span>
                                    </div>
                                    <div class="pull-left col-xs-12" style="padding: 0px; margin-top: 5px;">
                                        <span class="fa fa-car"> Car Bonus: <span class="label label-pill label-default m-r-15" style="color: #000"><?php echo $car; ?></span></span>
                                    </div>
                                    <div class="pull-left col-xs-12" style="padding: 0px; margin-top: 5px;">
                                       <span class="fa fa-home"> House Bonus: <span class="label label-pill label-default m-r-15" style="color: #000"><?php echo $house; ?></span></span>
                                    </div>
                                </div>          
                            </div>

                            <div class="col-xs-12 password jumbotron">
                                <ul>
                                    <li><a href="" data-toggle="modal" data-target="#editPasswordModal"><span class="fa fa-unlock-alt"></span> Change Account Password</a></li>
                                    <?php if(trim($user_pin)==""){ ?>
                                    <li><a href="" data-toggle="modal" data-target="#setPinModal"><span class="fa fa-key"></span> Set Transaction PIN</a></li>
                                    <?php }else{ ?>
                                    <li style="border-left:1px solid #000;padding-left: 20px;"><a href="" data-toggle="modal" data-target="#editPinModal"><span class="fa fa-key"></span> Change Transaction PIN</a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-4">
                            <div class="card col-xs-12" style="padding: 0px;margin-bottom: 40px;">
                                <div class="card-header" style="background: #FFF;padding: 0px;">
                                    <img src="<?php echo $dp; ?>" width="100%" style="margin-left: 2px;margin-bottom: -2px;" />
                                    <?php echo $status; ?>
                                </div>
                                <div class="card-content">
                                    <div class="card-content-member">
                                        <h4 class="m-t-0"><?php echo $names; ?></h4>
                                        <p class="m-0"><i class="pe-7s-map-marker"></i><?php echo $location; ?></p>
                                    </div>
                                    <div class="card-content-languages">
                                        <div class="card-content-languages-group">
                                            <div>
                                                <h4>Email:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li style="word-wrap: break-word;table-layout: fixed;width: 200px;"><?php echo $email; ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-content-languages-group">
                                            <div>
                                                <h4>Phone:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li><?php echo $phone ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-content-languages-group">
                                            <div>
                                                <h4>Address:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li style="word-wrap: break-word;table-layout: fixed;width: 200px;"><?php echo $address; ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-content-languages-group">
                                            <div>
                                                <h4>Birthday:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li><?php echo $birthday; ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-content-languages-group">
                                            <div>
                                                <h4>User Code:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li><?php echo $user_code; ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="card-content-languages-group">
                                            <div>
                                                <h4>No. of Referrals:</h4>
                                            </div>
                                            <div>
                                                <ul>
                                                    <li><?php echo $referrals; ?>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                        

                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="card-footer-stats">
                                        <div>
                                            <p>DATE <br/>REGISTERED:</p><br/><span class="stats-small"><?php echo $date_registered; ?></span>
                                        </div>
                                        <div>
                                            <p>DATE <br/>ACTIVATED:</p><br/><span class="stats-small"><?php echo $date_activated; ?></span>
                                        </div>
                                        <div>
                                            <p>LAST <br/>ONLINE</p><br/><span class="stats-small"><?php echo $last_on; ?></span>
                                        </div>
                                    </div>
                                    <div data-toggle="modal" data-target="#editProfileModal
                                    " class="card-footer-message btn btn-success col-xs-12">
                                        <h4><i class="fa fa-edit"></i> Edit Profile</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="hidden-xs hidden-sm col-md-12  text-center"><a href="deactivate-account"><button type="button" class="btn btn-danger btn-outline w-md m-b-5">Deactivate Account</button></a></div>
                        </div>
                        
                        <div class='modal fade' id='editProfileModal' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post' enctype="multipart/form-data">
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Update Profile</h1>
                                        </div>
                                        <div class='modal-body'>
                                            <div class="form-group">
                                                <label>Update Profile Picture</label>
                                                <input type="file" name="image" style="margin-bottom: 5px;" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>First Name</label>
                                                <input required="" type="text" style="margin-bottom: 5px;" value="<?php echo $fname; ?>" name="fname" placeholder="Enter first name" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Last Name</label>
                                                <input required="" type="text" style="margin-bottom: 5px;" value="<?php echo $lname; ?>" name="lname" placeholder="Enter last name" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Phone Number</label>
                                                <input required="" type="number" style="margin-bottom: 5px;" value="<?php echo $phone; ?>" name="phone_number" placeholder="Enter phone number" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Street Address</label>
                                                <input required="" type="text" style="margin-bottom: 5px;" value="<?php echo $address; ?>" name="street_address" placeholder="Enter street address" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>City</label>
                                                <input required="" type="text" style="margin-bottom: 5px;" value="<?php echo $city; ?>" name="city" placeholder="Enter city" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Zip Code</label>
                                                <input type="text" style="margin-bottom: 5px;" value="<?php echo $zip_code; ?>" name="zip_code" placeholder="Enter zip code" class="form-control">
                                            </div>

                                            <div class="form-group">
                                                <label>Country</label>
                                                <select required="" style="margin-bottom: 5px;" name="country" class="form-control">
                                                    <optgroup>
                                                        <option disabled="">Select country</option>
                                                        <?php foreach ($countries as $key => $nation) { ?>
                                                            <option <?php if($country==$nation){ echo " selected "; } ?> value="<?php echo $key; ?>"><?php echo $nation; ?></option>
                                                        <?php } ?>
                                                    </optgroup>
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>Birthday</label>
                                                <input type="date" style="margin-bottom: 5px;" value="<?php echo $birth; ?>" name="birthday" placeholder="Enter birthday" class="form-control">
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            <button onclick="return confirm('Save changes?');" type='submit' name='update_profile' class='btn btn-success'>Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class='modal fade' id='editAccountModal' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Update Bank Account</h1>
                                        </div>
                                        <div class='modal-body'>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Bank name</label>
                                                <input type="text" value="<?php echo $bank_name2; ?>" name="bank_name" placeholder="Enter bank name" class="form-control">
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Account name</label>
                                                <input type="text" value="<?php echo $acct_name2; ?>" name="acct_name" placeholder="Enter account name" class="form-control">
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Account number</label>
                                                <input type="number" value="<?php echo $acct_number2; ?>" name="acct_number" placeholder="Enter account number" class="form-control">
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Account type</label>
                                                <select name="acct_type" class="form-control">
                                                    <optgroup>
                                                        <option <?php if($acct_type2=="Savings"){ echo " selected "; } ?>>Savings</option>
                                                        <option <?php if($acct_type2=="Current"){ echo " selected "; } ?>>Current</option>
                                                    </optgroup>
                                                </select>
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Swift code</label>
                                                <input type="text" value="<?php echo $swift_code2; ?>" name="swift_code" placeholder="Enter swift code" class="form-control">
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Transaction PIN</label>
                                                <input type="password" required="" name="trans_pin" placeholder="Enter transaction PIN" class="form-control">
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            <button type='submit' name='update_account' class='btn btn-success'>Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class='modal fade' id='editPasswordModal' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Change Account Password</h1>
                                        </div>
                                        <div class='modal-body'>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Old password</label>
                                                <input required="" type="password" name="old_password" placeholder="Enter old password" class="form-control">
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>New password</label>
                                                <input required="" type="password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="new_password" placeholder="Enter new password" class="form-control">
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Re-enter password</label>
                                                <input required="" type="password" name="new_password2" placeholder="Re-enter password" class="form-control">
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            <button type='submit' name='update_password' class='btn btn-success'>Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class='modal fade' id='editPinModal' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Change Transaction PIN</h1>
                                        </div>
                                        <div class='modal-body'>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Old PIN</label>
                                                <input required="" type="password" name="old_pin" placeholder="Enter old PIN" class="form-control">
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>New PIN</label>
                                                <input required title="Must be 4 characters" type="password" name="new_pin" placeholder="Enter new PIN" class="form-control">
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Re-enter PIN</label>
                                                <input required="" type="password" name="new_pin2" placeholder="Re-enter PIN" class="form-control">
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <a href="?rp" onclick="return confirm('Reset transaction PIN?');" style="margin-right: 10px;"><span class="fa fa-sync-alt"></span> Reset PIN</a>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            <button type='submit' name='update_pin' class='btn btn-success'>Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class='modal fade' id='setPinModal' tabindex='-1' role='dialog'>
                            <div class='modal-dialog' role='document'>
                                <div class='modal-content'>
                                    <form action='' method='post'>
                                        <div class='modal-header'>
                                            <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                            <h1 class='modal-title'>Set Transaction PIN</h1>
                                        </div>
                                        <div class='modal-body'>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Transaction PIN</label>
                                                <input required title="Must be 4 characters" type="password" name="new_pin" placeholder="Enter transaction PIN" class="form-control">
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Re-enter PIN</label>
                                                <input required="" type="password" name="new_pin2" placeholder="Re-enter PIN" class="form-control">
                                            </div>
                                        </div>
                                        <div class='modal-footer'>
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                            <button type='submit' name='set_pin' class='btn btn-success'>Save changes</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-8">

                            <div class="hidden-xs col-sm-12" style="padding: 0px;">
                                <div class="row" style="margin-bottom: 30px;">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="rating-block">
                                            <h4>User Level: <small style="font-size: 17px;margin-left: 10px;"><?php if($level!="exclusive"){ echo $level; $rem = 7-$level; }else{ echo "Exclusive"; } ?> (<?php echo $user_type; ?>)</small></h4>
                                            <?php if($level!="exclusive"){
                                            for($i=0; $i<$level; $i++){ ?>
                                            <button type="button" class="btn btn-success btn-sm" aria-label="Left Align">
                                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                            </button>
                                            <?php } for($i=0; $i<$rem; $i++){ ?>
                                            <button type="button" class="btn btn-default btn-sm" aria-label="Left Align">
                                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                            </button>
                                            <?php }}else{ for($i=0; $i<7; $i++){ ?>
                                            <button type="button" class="btn btn-warning btn-sm" aria-label="Left Align">
                                                <span class="glyphicon glyphicon-star" aria-hidden="true"></span>
                                            </button>
                                            <?php }} ?>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <!-- <h4 class="m-t-0">Bonuses</h4> -->
                                        <div class="pull-left col-xs-12" style="padding: 0px; margin-top: 5px;">
                                            <span class="fab fa-google-wallet" style="font-weight: bold;"> Wallet Balance: <span class="label label-pill label-default m-r-15" style="color: #000">&#8358; <?php echo number_format($wallet_bal, 2); ?></span></span>
                                        </div>
                                        <div class="pull-left col-xs-12" style="padding: 0px; margin-top: 5px;">
                                            <span class="fa fa-shopping-cart"> Shopping Voucher: <span class="label label-pill label-default m-r-15" style="color: #000">&#8358; <?php echo number_format($voucher_bal, 2); ?></span></span>
                                        </div>
                                        <div class="pull-left col-xs-12" style="padding: 0px; margin-top: 5px;">
                                            <span class="fa fa-car"> Car Bonus: <span class="label label-pill label-default m-r-15" style="color: #000"><?php echo $car; ?></span></span>
                                        </div>
                                        <div class="pull-left col-xs-12" style="padding: 0px; margin-top: 5px;">
                                           <span class="fa fa-home"> House Bonus: <span class="label label-pill label-default m-r-15" style="color: #000"><?php echo $house; ?></span></span>
                                        </div>
                                    </div>          
                                </div>

                                <div class="col-xs-12 password jumbotron">
                                    <ul>
                                        <li><a href="" data-toggle="modal" data-target="#editPasswordModal"><span class="fa fa-unlock-alt"></span> Change Account Password</a></li>
                                        <?php if(trim($user_pin)==""){ ?>
                                        <li><a href="" data-toggle="modal" data-target="#setPinModal"><span class="fa fa-key"></span> Set Transaction PIN</a></li>
                                        <?php }else{ ?>
                                        <li style="border-left:1px solid #000;padding-left: 20px;"><a href="" data-toggle="modal" data-target="#editPinModal"><span class="fa fa-key"></span> Change Transaction PIN</a></li>
                                        <?php } ?>
                                    </ul>
                                </div>
                            </div>
                            
                            <h2 class="text-center btn btn-default" style="width: 100%;margin-bottom: -5px;font-weight: bold;text-transform: uppercase;padding: 10px;cursor: text;">Bank Account Info <span class="fa fa-edit" data-toggle="modal" data-target="#editAccountModal" style="color:green;margin-left: 10px;cursor: pointer;text-transform: none;"> Edit</span></h2>

                            <div class="review-block">
                                <div class='row' style='margin-top: 10px;'>
                                    <div class='col-sm-12'>
                                        <div style='width: 40%;float:left;color:#FFF;'>Bank Name:</div><div style='width:60%;float:left'><?php echo $bank_name; ?></div><br/>
                                        <div style='width: 40%;float:left;color:#FFF;'>Account Name:</div><div style='width:60%;float:left'><?php echo $acct_name; ?></div><br/>
                                        <div style='width: 40%;float:left;color:#FFF;'>Account No.:</div><div style='width:60%;float:left'><?php echo $acct_number; ?></div><br/>
                                        <div style='width: 40%;float:left;color:#FFF;'>Account Type:</div><div style='width:60%;float:left'><?php echo $acct_type; ?></div><br/>
                                        <div style='width: 40%;float:left;color:#FFF;'>Swift Code:</div><div style='width:60%;float:left'><?php echo $swift_code; ?></div><br/>
                                    </div>
                                </div>
                            </div>

                            <h2 class="text-center btn btn-default" style="width: 100%;margin-bottom: -5px;font-weight: bold;text-transform: uppercase;padding: 10px;cursor: text;">Payments (<?php echo $payment_size; ?>)
                                <?php if($user_status==2 || ($user_status==0 && $payment_size==0)){ ?>
                                <a href="<?php echo $GLOBALS['path']; ?>add-payment?x=<?php echo $user_code; ?>" target="_blank"><span class="fa fa-plus-square" style="margin-left: 10px;text-transform: none;color: red;font-size: 18px;"> Add new payment</span></a>
                                <?php } ?>
                            </h2>

                            <div class="review-block">
                               <?php echo $payment; ?>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="col-xs-12 hidden-md hidden-lg text-center" style="margin-bottom: 50px;"><a href="deactivate-account"><button type="button" class="btn btn-danger btn-outline w-md m-b-5">Deactivate Account</button></a></div>
            </div>
        </div>
        <?php require_once "scripts.php"; ?>
    </body>
</html>
