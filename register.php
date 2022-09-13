<?php 
    require_once "functions_basic.php";

    if(isset($_GET['ref_code'])){
        $_SESSION['referral'] = $_GET['ref_code'];
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
        <title>.: Register as Member | BlackLoop Club :.</title>
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
            
            .body-background .ls-area .sitemap #zip_code,
            .body-background .ls-area .sitemap #referral,
            .body-background .ls-area .sitemap #fname,
            .body-background .ls-area .sitemap #lname,
            .body-background .ls-area .sitemap #password,
            .body-background .ls-area .sitemap #confirm-password {
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
                margin-top:5px;
                float: left;
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
                /*text-align:right;*/
                margin-top: 10px;
            }

            .mobile {
                display: none;
            }

            .web {
                display: block;
            }
            
            @media (max-width:767px){
                .mobile {
                    display: block;
                }

                .web {
                    display: none;
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
                
                .body-background .ls-area .sitemap #zip_code,
                .body-background .ls-area .sitemap #referral,
                .body-background .ls-area .sitemap #fname,
                .body-background .ls-area .sitemap #lname,
                .body-background .ls-area .sitemap #password,
                .body-background .ls-area .sitemap #confirm-password {
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
                                                                <h1><strong>Become a Privilege Business Pack Member</strong></h1>
                                                                <img src="png/step-counter.png" style="width:230px;margin-top:20px;" />
                                                            </div>
                                                            
                                                            
                                                            <div class="block push-bit col-xs-12">
                                                                <form action="payment" method="post" onsubmit="checkValm();" id="form-register"
                                                                      class="form-horizontal">
                                                                    <?php if(isset($_SESSION['register_error'])){ ?>
                                                                    <div class="col-xs-12">
                                                                        <div class="alert alert-danger text-center"><?php echo $_SESSION['register_error']; ?></div>
                                                                    </div>
                                                                    <?php unset($_SESSION['register_error']);} ?>
                                                                    <div class="col-xs-12 col-sm-6">
                                                                    <fieldset>
                                                                        <label class="input-label col-xs-12">Your information</label>
                                                                        <div class="form-group">
                                                                            <div class="col-xs-12 col-sm-6">
                                                                            <input required id="fname" name="fname" class="form-control input-b"
                                                                                       placeholder="First name"
                                                                                       type="text" value="<?php if(isset($_SESSION['fname'])){echo $_SESSION['fname']; unset($_SESSION['fname']);} ?>">
                                                                                
                                                                            </div>
                                                                            <div class="col-xs-12 col-sm-6">
                                                                                <input required id="lname" name="lname" class="form-control input-b" placeholder="Last name"
                                                                                       type="text"  value="<?php if(isset($_SESSION['lname'])){echo $_SESSION['lname']; unset($_SESSION['lname']);} ?>">
                                                                               
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col-xs-12">
                                                                                <input required id="email" name="email"
                                                                                       class="form-control input-b"
                                                                                       placeholder="Email address" title="example@mail.ca" type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$"
                                                                                       value="<?php if(isset($_SESSION['email'])){echo $_SESSION['email']; unset($_SESSION['email']);} ?>">
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>
                                                                    <fieldset>
                                                                        <label class="input-label col-xs-12" style="font-size:14px !important;">Create a password for your online account</label>
                                                                        <div class="form-group">
                                                                            <div class="col-xs-12 col-sm-6">
                                                                                <input required id="password" name="password" class="form-control input-b" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" 
                                                                                       placeholder="Password"
                                                                                       type="password">
                                                                                
                                                                            </div>
                                                                            <div class="col-xs-12 col-sm-6">
                                                                                <input required id="confirm-password" name="password_confirmation"
                                                                                       class="form-control input-b"
                                                                                       placeholder="Confirm password" type="password">
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>
                                                                    <fieldset>
                                                                        <label class="input-label col-xs-12">Mailing address</label>
                                                                        <div class="form-group">
                                                                            <div class="col-xs-12">
                                                                                <input required id="maddress" name="street_address" class="form-control input-b"
                                                                                       placeholder="Street address"
                                                                                       type="text" value="<?php if(isset($_SESSION['street_address'])){echo $_SESSION['street_address']; unset($_SESSION['street_address']);} ?>">
                                                                                
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col-xs-12">
                                                                                <select id="country" required name="country" class="form-control input-b">
                                                                                    <optgroup label="">
                                                                                        <option value="">Select
                                                                                            Country
                                                                                        </option>
                                                                                        <?php foreach ($countries as $key => $country) { ?>
                                                                                            <option <?php if(isset($_SESSION['country'])){echo "selected"; unset($_SESSION['country']);} ?> value="<?php echo $key ?>"><?php echo $country; ?></option>
                                                                                        <?php } ?>
                                                                                        
                                                                                    </optgroup>
                                                                                </select>
                                                                            </div>
                                                                        </div>
                                                                        <div class="form-group">
                                                                            <div class="col-xs-12 col-sm-6">
                                                                                <input required id="fname" name="city" class="form-control input-b"
                                                                                       placeholder="City"
                                                                                       type="text" value="<?php if(isset($_SESSION['city'])){echo $_SESSION['city']; unset($_SESSION['city']);} ?>">
                                                                                
                                                                            </div>
                                                                            <div class="col-xs-12 col-sm-6">
                                                                                <input id="zip_code" name="zip_code" class="form-control input-b" placeholder="Zip Code (optional)"
                                                                                       type="number" value="<?php if(isset($_SESSION['zip_code'])){echo $_SESSION['zip_code']; unset($_SESSION['zip_code']);} ?>">
                                                                                
                                                                            </div>
                                                                        </div>
                                                                    </fieldset>
                                                                    <div class="form-group">
                                                                        <div class="col-xs-12 col-sm-6">
                                                                            <input required id="pnumber" name="phone_number" class="form-control input-b"
                                                                                   placeholder="Phone number"
                                                                                   type="text" value="<?php if(isset($_SESSION['phone_number'])){echo $_SESSION['phone_number']; unset($_SESSION['phone_number']);} ?>">
                                                                           
                                                                        </div>
                                                                        <div class="col-xs-12 col-sm-6">
                                                                            <input id="referral" name="referral" class="form-control input-b"
                                                                                   placeholder="Referral code (optional)"
                                                                                   type="text" value="<?php if(isset($_SESSION['referral'])){echo $_SESSION['referral']; unset($_SESSION['referral']);} ?>">
                                                                            
                                                                        </div>
                                                                    </div>
                                                                    
                                                                    </div>
                                                                    <div class="col-xs-12 col-sm-6" style="margin-top: 35px;">
                                                                    
                                                                    <fieldset>
                                                                        <label class="input-label col-xs-12">Contact preferences (optional)</label>
                                                                        <p>Select how would you like to hear about new products, special offers and other messages from BlackLoop Club. See our <a style="color:#FE6802" href="privacy-policy">Privacy Policy</a></p>
                                                                            <label class="input-label" style="font-size:14px !important;" for="contact">
                                                                                <input id="contact" <?php if(isset($_SESSION['email_promo'])){echo "checked"; unset($_SESSION['email_promo']);} ?> name="email_promo" value="1" type="checkbox" > Contact me via e-mail 
                                                                            </label>
                                                                    </fieldset>
                                                                    <div class="col-xs-12" style="padding: 0px;">
                                                                        <fieldset>
                                                                            <div class="form-group">
                                                                                
                                                                                <div class="col-xs-12">
                                                                                    <label class="input-label" style="font-size:16px !important; line-height: 22px;" for="yes">
                                                                                        <input required id="yes" name="age"
                                                                                               value="1" type="checkbox" > I am 18 years or older and I accept Blackloopclub.com terms and conditions.
                                                                                    </label>
                                                                                </div>
                                                                            </div>

                                                                        </fieldset>
                                                                        <fieldset>
                                                                            <div class="form-group">
                                                                                
                                                                                    <div class="g-recaptcha col-xs-12" style="" data-sitekey="6LcGi38UAAAAAHCULuWYhQwrX0QxqGxbw63acpfg"></div>
                                                                            </div>
                                                                        </fieldset>
                                                                        <fieldset>
                                                                            <div class="form-group form-actions">
                                                                                <div class="col-xs-12 continue">
                                                                                    <button name="register" type="submit" class="hero_button"><i
                                                                                                class="fa fa-angle-right"></i> Continue
                                                                                        </button>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-xs-12 login">
                                                                                    Do you have an account?
                                                                                        <a style="color:#FE6802" href="login">
                                                                                             <small>Login</small>
                                                                                        </a>
                                                                                </div>
                                                                            </div>
                                                                            <div class="form-group">
                                                                                <div class="col-xs-12 login">
                                                                                        Want more value?
                                                                                        <a style="color:#FE6802" href="career">
                                                                                             <span class="fa fa-angle-double-right"></span> REGISTER AS A SELLERATOR!
                                                                                        </a>
                                                                                </div>
                                                                            </div>
                                                                        </fieldset>
                                                                    </div>
                                                                    
                                                                    </div>
                                                                    <input type="text" value="0" name="sellerator" style="display: none;">
                                                                    
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

            <?php /*require_once "top-footer.php";*/ require_once "footer2.php"; ?>
        </div>
        <?php require_once "bottom-scripts.php"; ?>
    </body>
</html>