<?php

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
    'ZW'=>"Zimbabwe",
	'XX'=>"all over the world",];

	$country2 = getCountry($_SESSION['blackloop_slug'][0]);
	foreach($countries as $key => $nation){
		if($country2==$key){$locate=$nation;}
	}
?>

<style type="text/css">
	.breaking-news-headline {
	  display: block;
	  position: absolute;
	  font-family: arial;
	  font-size: 13px;
	  margin-top: -35px;
	  color: white;
	  margin-left: 150px;
	  line-height: 40px;
	}

	.breaking-news-title {
	  background-color: #FFEA00;
	  display: block;
	  height: 100%;  
	  /*width: 150px;*/
	  font-family: arial;
	  font-size: 11px;
	  position: absolute; 
	  top: 0px;
	  margin-top: 0px;
	  margin-left: 0px;
	  padding: 8px 10px 0 10px;
	  /*padding-left: 10px;*/
	  z-index: 3;
	  color: #555;
	  &:before {
	    content:"";
	    position: absolute;
	    display: block;
	    width: 0px;
	    height: 0px;
	    top: 0;
	    left: -12px;
	    border-left:12px solid transparent;
	    border-right: 0px solid transparent;
	    border-bottom: 30px solid #FFEA00;
	  }
	  &:after {
	    content:"";
	    position: absolute;
	    display: block;
	    width: 0px;
	    height: 0px;
	    right: -12px;
	    top: 0;
	    border-right:12px solid transparent;
	    border-left: 0px solid transparent;
	    border-top: 30px solid #FFEA00;
	  }
	}

	#breaking-news-colour {
	  height: 30px;
	  /*width: 694px;*/
	  background-color: #444 /*#3399FF*/;
	}

	#breaking-news-container {
	  height: 30px;
	  width: 100%;
	  overflow: hidden;
	  position: absolute;
	  &:before {
	    content: "";
	    width: 30px;
	    height: 30px;
	    background-color: #3399FF;
	    position: absolute;
	    z-index: 2;
	  }
	}

	.animated {
	  -webkit-animation-duration: 0.2s;
	  -webkit-animation-fill-mode: both;
	  -moz-animation-duration: 0.2s;
	  -moz-animation-fill-mode: both;
	  -webkit-animation-iteration-count: 1;
	  -moz-animation-iteration-count: 1;
	}

	.delay-animated {
	  -webkit-animation-duration: 0.4s;
	  -webkit-animation-fill-mode: both;
	  -moz-animation-duration: 0.4s;
	  -moz-animation-fill-mode: both;
	  -webkit-animation-iteration-count: 1;
	  -moz-animation-iteration-count: 1;
	  -webkit-animation-delay: 0.3s; 
	  animation-delay: 0.3s;
	}

	.scroll-animated {
	  -webkit-animation-duration: 3s;
	  -webkit-animation-fill-mode: both;
	  -moz-animation-duration: 3s;
	  -moz-animation-fill-mode: both;
	  -webkit-animation-iteration-count: 1; 
	  -moz-animation-iteration-count: 1;
	  -webkit-animation-delay: 0.5s; 
	  animation-delay: 0.5s;
	}

	.delay-animated2 {
	  -webkit-animation-duration: 0.4s;
	  -webkit-animation-fill-mode: both;
	  -moz-animation-duration: 0.4s;
	  -moz-animation-fill-mode: both;
	  -webkit-animation-iteration-count: 1; 
	  -moz-animation-iteration-count: 1;
	  -webkit-animation-delay: 0.5s; 
	  animation-delay: 0.5s;
	}

	.delay-animated3 {
	  -webkit-animation-duration: 5s;
	  -webkit-animation-fill-mode: both;
	  -moz-animation-duration: 5s;
	  -moz-animation-fill-mode: both;
	  -webkit-animation-iteration-count: 1; 
	  -moz-animation-iteration-count: 1;
	  -webkit-animation-delay: 0.5s; 
	  animation-delay: 3s;
	}

	.fadein {
	  -webkit-animation-name: fadein;
	  -moz-animation-name: fadein;
	  -o-animation-name: fadein;
	  animation-name: fadein;
	}

	@-webkit-keyframes fadein {
	  from {
	    margin-left: 1000px
	  }
	  to {
	    
	  } 
	}  
	@-moz-keyframes fadein {
	  from {
	    margin-left: 1000px
	  }
	  to {
	    
	  }  
	}

	.slidein {
	  -webkit-animation-name: slidein;
	  -moz-animation-name: slidein;
	  -o-animation-name: slidein;
	  animation-name: slidein;
	}

	@keyframes marquee {
	  0% { 
	    left: 0;
	  }
	  20% { 
	    left: 0; 
	  }
	  100% { left: -100%; }
	}

	.marquee {
	  animation: marquee 15s linear infinite;
	  -webkit-animation-duration: 15s;
	  -moz-animation-duration: 15s;
	  -webkit-animation-delay: 0.5s; 
	  animation-delay: 3s;
	}

	@-webkit-keyframes slidein {
	  from {
	    margin-left: 800px
	  }
	  to {
	    margin-top: 0px
	  } 
	}  
	@-moz-keyframes slidein {
	  from {
	    margin-left: 800px
	  }
	  to {
	    margin-top: 0px
	  }  
	}

	.slideup {
	  -webkit-animation-name: slideup;
	  -moz-animation-name: slideup;
	  -o-animation-name: slideup;
	  animation-name: slideup;
	}
	@-webkit-keyframes slideup {
	  from {
	    margin-top: 30px
	  }
	  to {
	    margin-top: 0;
	  } 
	}  
	@-moz-keyframes slideup {
	  from {
	    margin-top: 30px
	  }
	  to {
	    margin-top: 0;
	  } 
	}




</style>

<div class="col-xs-12" style="height: 70px;padding: 0px;">
	<div id="breaking-news-container">
	  <div id="breaking-news-colour" class="slideup animated">
	    
	  </div>  
	   <span class="breaking-news-title delay-animated slidein">
	      // NEWS UPDATES //
	    </span> 
	    <a href="news-updates" class="breaking-news-headline delay-animated2 fadein marquee">
	      Welcome to Blackloop Club! <span style="margin: 0 20px;">:::</span> A big congratulations to all our members from <?php echo $locate; ?>, you made the best decision to be a part of this elite group of world revolutionists! <span style="margin: 0 20px;">:::</span> If your account is not active, please ensure that you have ratified all payments and uploaded proof of such.
	    </a>  
	</div>
</div> 