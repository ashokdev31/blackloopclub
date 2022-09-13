<style type="text/css">
    

/*----start-about----*/
.about{
	padding:3em 0; background:url(images/pattern-bg.jpg)
}
.about-head{
	text-align: center;
}
.about-head h1{
	font-weight: 600;
	font-size: 30px;
	color: #222222;
	text-transform: uppercase;
       padding-top: 25px;
        margin-bottom: -40px
}
.aboutsshead span{
	width: 8%;
	height: 1px;
	background: #35C2F8;
	display: inline-block;
}
/*--about-time-line--*/
.about-time-line{
	padding: 0;
	list-style: none;
	position: relative;
	width: 60%;
	margin: 6em auto 15em!important;
}
.about-time-line li{
	display: inline;
	min-height: 300px;
}
.about-time-line:before {
	content: '';
	position: absolute;
	top: 0;
	bottom: 0;
	width: 2px;
	background: #cdcdcd;
	left: 47%;
	margin-left: -10px;
}
.about-time-line > li:nth-child(odd) .cbp_tmtime span:last-child {
	color: #6cbfee;
}
.about-time-line > li .cbp_tmtime span:last-child {
	font-size: 2.9em;
	color: #3594cb;
}
.about-time-line > li .cbp_tmtime span {
	display: block;
	text-align: right;
}
.about-time-line > li .cbp_tmicon,.cbp_tmicon1,.cbp_tmicon2,.cbp_tmicon3,.cbp_tmicon2,.cbp_tmicon4,.cbp_tmicon5{
	width: 170px;
	height: 170px;
	border: 10px solid #fff;
	speak: none;
	font-size: 1.4em;
	line-height: 40px;
	position: absolute;
	color: #fff;
	border-radius: 50%;
	box-shadow: 0 0  8px rgba(0,0,0,0.1);
	-webkit-box-shadow: 0 0  8px rgba(0,0,0,0.1);
	-moz-box-shadow: 0 0  8px rgba(0,0,0,0.1);
	-o-box-shadow: 0 0  8px rgba(0,0,0,0.1);
	text-align: center;
	left: 41%;
	top: 0;
	margin: 0 0 0 -25px;
	display:block;
}
.cbp_tmicon1{
	left: 41%;
	top: 17%;
}
.cbp_tmicon2{
	left: 41%;
	top: 34%;
}
.cbp_tmicon3{
	left: 41%;
	top: 51%;
}
.cbp_tmicon4{
	left: 41%;
	top: 68%;
}

.cbp_tmicon5{
	left: 41%;
	top: 85%;
}
.img1{
	background:url(..<?php echo $GLOBALS['path'] ?>png/front/power.png) no-repeat;
	background-size: 100% 100%;
		-webkit-transition: all 1s ease-in-out;
  -moz-transition: all 1s ease-in-out;
  -o-transition: all 1s ease-in-out;
  transition: all 1s ease-in-out;
}
.img2{
	background:url(..<?php echo $GLOBALS['path'] ?>png/front/collab.png) no-repeat;
	background-size: 100% 100%;
		-webkit-transition: all 1s ease-in-out;
  -moz-transition: all 1s ease-in-out;
  -o-transition: all 1s ease-in-out;
  transition: all 1s ease-in-out;
}
.img3{
	background:url(..<?php echo $GLOBALS['path'] ?>png/front/smile.png) no-repeat;
	background-size: 100% 100%;
	-webkit-transition: all 1s ease-in-out;
  -moz-transition: all 1s ease-in-out;
  -o-transition: all 1s ease-in-out;
  transition: all 1s ease-in-out;
}

.img4{
	background:url(..<?php echo $GLOBALS['path'] ?>png/front/pay.png) no-repeat;
	background-size: 100% 100%;
		-webkit-transition: all 1s ease-in-out;
  -moz-transition: all 1s ease-in-out;
  -o-transition: all 1s ease-in-out;
  transition: all 1s ease-in-out;
}
.img5{
	background:url(..<?php echo $GLOBALS['path'] ?>png/front/blank_face.png) no-repeat;
	background-size: 100% 100%;
		-webkit-transition: all 1s ease-in-out;
  -moz-transition: all 1s ease-in-out;
  -o-transition: all 1s ease-in-out;
  transition: all 1s ease-in-out;

}
.img6{
	background:url(..<?php echo $GLOBALS['path'] ?>png/front/graph.png) no-repeat;
	background-size: 100% 100%;
		-webkit-transition: all 1s ease-in-out;
  -moz-transition: all 1s ease-in-out;
  -o-transition: all 1s ease-in-out;
  transition: all 1s ease-in-out;

}
.about-time-line li:hover .img1, .about-time-line li:hover .img2, .about-time-line li:hover .img3, .about-time-line li:hover .img4, .about-time-line li:hover .img5, , .about-time-line li:hover .img6{
	transform: rotateX(360deg);
	-webkit-transform: rotateX(360deg);
	-moz-transform: rotateX(360deg);
	-o-transform: rotateX(360deg);
	-ms-transform: rotateX(360deg);}

.about-time-line > li .cbp_tmlabel {
	margin: 0 0 0px -8%;
	color: #fff;
	padding: 1em 0em 0em 0;
	font-size: 1.2em;
	font-weight: 300;
	line-height: 1.4;
	position: relative;
	border-radius: 5px;
	width: 60%;
	text-align: right;
	min-height: 200px;
}
.about-time-line > li .cbp_tmlabel1 {
	margin: 0 0 15px 64%;
	text-align: left;
}
.about-time-line > li:nth-child(odd) .cbp_tmlabel:after {
	border-right-color: #6cbfee;
}
.cbp_tmlabel h2{
	color: #222!important;
	text-transform: uppercase;
	font-weight: 600;
	font-size: 20px!important;
}
.cbp_tmlabel p{
	color: #777777;
	line-height: 1.6em;
	font-family: 'Open Sans', sans-serif;
	font-size: 0.72em;
	margin-top: 0.8em;
}
/*--//about-time-line--*/
/*---team-members--*/
.team-members{
	padding: 3em 0 4em 0;
	background: #F9F9F9;
}
.tm-head{
	text-align:center;
}
.tm-head h3{
	font-size: 2.5em;
	font-family: 'Montserrat', sans-serif;
	color: #222; font-weight:900;
	text-transform: uppercase;
}
.tm-head p{
	font-family: 'Open Sans', sans-serif;
	color: #777777;
	margin: 0 auto;
	font-size: 1em;
	line-height: 1.44em;
}
.tm-head-grid img{
	border-radius: 30em;
	-webkit-border-radius: 30em;
	-moz-border-radius: 30em;
	-o-border-radius: 30em;
-webkit-transition: all 0.5s ease-in-out;
          transition: all 0.5s ease-in-out;
}

.tm-head-grid:hover img{
	border-radius: 0em;
	-webkit-border-radius: 0em;
	-moz-border-radius: 0em;
	-o-border-radius: 0em;


}


.tm-head-grid {
	width: 25%;
	text-align: center;
	float: left;
	padding-right:0 1%;
}
.tm-head-grids {
	width: 75%;
	margin: 3.3em auto 1.3em;
}
.tm-head-grid:nth-child(3){
	margin-right:0;
}
.tm-head-grid h4{
	font-size: 1.2em;
	color: #222222;
	font-family: 'Montserrat', sans-serif;
	text-shadow: 0px 0px 1px rgba(66, 66, 66, 0.39);
	-webkit-text-shadow: 0px 0px 1px rgba(66, 66, 66, 0.39);
	-moz-text-shadow: 0px 0px 1px rgba(66, 66, 66, 0.39);
	-o-text-shadow: 0px 0px 1px rgba(66, 66, 66, 0.39);
	margin: 0.8em 0 0.2em;
}
.tm-head-grid h5{
	font-family: 'Open Sans', sans-serif;
	color: #777777;
	margin: 0 auto;
	font-size: 0.95em;
	line-height: 1.44em;
}
/*---//team-members--*/
/*----team-info----*/
.team-info{
	font-family: 'Open Sans', sans-serif;
	color: #777777;
	margin: 0 auto;
	font-size: 1em;
	line-height: 1.8em;
	text-align: center;
	width: 50%;
}
/*--//team-info--*/

/*---- responsive-design ----*/
@media (max-width:1366px){
	.NULL{
		width:80%;
	}
	.portfolio-top-left-grid-left, .e-left-inner-grid-left{width:10%}
	.portfolio-top-left-grid-right, .e-left-inner-grid-right{width:85%}
}
@media (max-width:1280px){
	
	
	.portfolio-work-grid-caption {
		padding: 4.5em 2em 0em 2em;
	}
}
@media (max-width:1024px){
	
	.portfolio-work-grid-caption {
		padding: 2.4em 1em 0em 1em;
	}
	.banner-info h1 {
		font-size: 3.2em;
		width: 80%;
	}
	.banner-info p {
		width: 60%;
	}
	.e-left-inner-grid-right {
		width: 80%;
	}
	.portfolio-top-left-grid-right p {
		width: 100%;
	}
	.portfolio-top-left {
		background: url(images/single-page/portbg-1.png) no-repeat 68% 51%;
	}
	.about-time-line > li .cbp_tmlabel {
		width: 55%;
		margin: 0% 0 0px -23%;
	}
	.about-time-line > li .cbp_tmlabel1 {
		margin: 0 0 15px 70%;
	}
	.about-time-line:before {
		left: 52%;
	}
	.top-NULL ul li a{padding:0.2em 0.4em}
}
@media (max-width:991px){
.banner-info{padding-top:3em; padding-bottom:10em}
.fixed-theme .logo img{width:180px}
.fixed-theme{}
.bg-slider{height:570px}
.banner-info{padding-top:1em}

}

@media (max-width:800px){
	.NULL{
		width:80%;
	}
	.bg-slider{height:540px}
	.plans_agile_learning_grid1_pos{width:auto}

	NULL ul{width:320px; margin:50px 0 0 !important; box-shadow:0 2px 8px rgba(0,0,0,0.2);}
	.fixed-theme{height:65px}
	.fixed-theme .display-one{opacity:0;}
	.fixed-theme .display-two{opacity:1;}
	.banner-info{padding-top:0}
	.services-grids .col-xs-4{width:100%}
	div.effect-roxy figcaption::before{top: 10px;
right: 10px;
bottom: 10px;
left: 10px;}
.grid .effect-roxy figcaption{padding:1em}
div.effect-roxy h2{padding:15% 10px 10px}
	
	.portfolio-work-grid-caption {
		padding: 2.4em 1em 0em 1em;
	}
	.banner-info h1 {
		font-size: 2.8em;
		width: 100%;
	}
	.banner-info p {
		width: 90%;
	}
	.e-left-inner-grid-right {
		width: 80%;
	}
	.portfolio-top-left-grid-right p {
		width: 100%;
	}
	.portfolio-top-left {
		background: url(../images/single-page/portbg-1.png) no-repeat 68% 51%;
		padding: 1.5em 4em 1.5em 4em;
	}
	.about-time-line > li .cbp_tmlabel {
		width: 56%;
		margin: 0% 100% 0px 35%;
		text-align: left;
	}
	.about-time-line > li .cbp_tmlabel1 {
		margin: 0 0 15px 35%;
	}
	.about-time-line:before {
		left: 20.5%;
	}
	.service-head h2 {
		font-size: 2.2em;
	}
	.services {
		padding: 1em 0;
	}
	.services-grids {
		padding: 1em 0;
	}
	.service-grid h3{
		margin:0 0 0.3em 0;
	}
	.service-grid{
		margin:0 auto 1em;
	}
	.expertice-left-grid {
		padding: 1.5em 4em 1.5em 4em;
	}
	.about {
		padding: 1em 0 0;
	}
	.about-time-line {
		width: 100%;
		margin: 0;
	}
	.about-time-line > li .cbp_tmicon, .cbp_tmicon1, .cbp_tmicon2, .cbp_tmicon3, .cbp_tmicon2, .cbp_tmicon4, .cbp_tmicon5 {
		left: 10%;
	}
	.tm-head h3 {
		font-size: 3em;
	}
	.team-members {
		padding: 2em 0 3em 0;
	}
	.tm-head-grid {
		width: 100%;
		float: none;
		margin-right: 0;
	}
	.team-info {
		width: 80%;
	}
	.contact {
		padding: 3em 0 0;
	}
	.contact-left h3 {
		font-size: 2.5em;
	}
	.contact-left{
		margin:0 0 1em 0;
	}
}
@media (max-width:640px){
	.NULL{
		width:80%;
	}
	.portfolio-works .col-xs-4{width:50%}
	.portfolio-work-grid-caption {
		padding: 2.4em 1em 0em 1em;
	}
	.banner-info {
		padding: 5em 0 7em;
	}
	.banner-info h1 {
		font-size: 2.3em;
		width: 100%;
	}
	.banner-info p {
		width: 100%;
		font-size: 1.2em;
	}
	.e-left-inner-grid-right {
		width: 80%;
	}
	.portfolio-top-left-grid-right p {
		width: 100%;
	}
	.portfolio-top-left {
		background: url(../images/single-page/portbg-1.png) no-repeat 68% 51%;
		padding: 1.5em 3em 1.5em 3em;
	}
	.about-time-line > li .cbp_tmlabel {
		width: 54%;
		margin: 0% 100% 0px 37%;
		text-align: left;
	}
	.about-time-line > li .cbp_tmlabel1 {
		margin: 0 0 15px 35%;
	}
	.about-time-line:before {
		left: 19.5%;
	}
	.services {
		padding: 1em 0;
	}
	.services-grids {
		padding: 1em 0;
	}
	.service-grid h3{
		margin:0 0 0.3em 0;
	}
	.expertice-left-grid {
		padding: 1.5em 3em 1.5em 3em;
	}
	.about {
		padding: 1em 0 14em;
	}
	.about-time-line {
		width: 100%;
		margin: 0;
	}
	.about-time-line > li .cbp_tmicon, .cbp_tmicon1, .cbp_tmicon2, .cbp_tmicon3, .cbp_tmicon2, .cbp_tmicon4, .cbp_tmicon5 {
		left: 10%;
		width: 140px;
		height: 140px;
	}
	.tm-head h3 {
		font-size: 2.8em;
	}
	.team-members {
		padding: 2em 0 3em 0;
	}
	.tm-head-grid {
		width: 100%;
		float: none;
		margin-right: 0;
	}
	.team-info {
		width: 80%;
	}
	.contact {
		padding: 3em 0 0;
	}
	.contact-left h3 {
		font-size: 2.5em;
	}
	.contact-left{
		margin:0 0 1em 0;
	}
}
@media (max-width:480px){
	.NULL{
		width:80%;
	}
	.fixed-theme .logo img{width:110px}
	.fixed-theme .NULL{width:100%}
	.portfolio-top-left-grid-right h5{font-size:1em}
	
	.portfolio-work-grid-caption {
		padding: 2.4em 1em 0em 1em;
	}
	.banner-info {
		padding: 3em 0 4em;
	}
	.banner-info h1 {
		font-size: 1.7em;
		width: 100%;
	}
	.banner-info p {
		width: 100%;
		font-size: 0.875em;
	}
	.e-left-inner-grid-right {
		width: 80%;
	}
	.portfolio-top-left-grid-right p {
		width: 100%;
	}
	.portfolio-top-left {
		background: url(../images/single-page/portbg-1.png) no-repeat 68% 51%;
		padding: 1.5em 2em 1.5em 1.8em;
	}
	.about-time-line > li .cbp_tmlabel {
		width: 54%;
		margin: 0% 100% 0px 37%;
		text-align: left;
	}
	.about-time-line > li .cbp_tmlabel1 {
		margin: 0 0 15px 35%;
	}
	.about-time-line:before {
		left: 19.5%;
	}
	.service-head h2 {
		font-size: 1.5em;
	}
	.services {
		padding: 1em 0;
	}
	.services-grids {
		padding: 1em 0;
	}
	.service-grid h3{
		margin:0 0 0.3em 0;
	}
	.expertice-left-grid {
		padding: 1.5em 3em 1.5em 3em;
	}
	.about {
		padding: 1em 0 14em;
	}
	.about-time-line {
		width: 100%;
		margin: 0;
	}
	.about-time-line > li .cbp_tmicon, .cbp_tmicon1, .cbp_tmicon2, .cbp_tmicon3, .cbp_tmicon2, .cbp_tmicon4 {
		left: 12%;
		width: 120px;
		height: 120px;
               
	}
	.tm-head h3 {
		font-size: 1.5em;
	}
	
	.service-grid p{font-size:14px}
	.grid .effect-roxy h2{font-size:14px} 
	.grid .effect-roxy p{font-size:12px}
	.logo img{width:100%}
	
	
	.banner-info h1{margin:0}
	.banner-info p{margin:0}
	.bg-slider, .carousel, .carousel-inner, .carousel-inner .item{height:auto}
	
.logo {
    width: 100px;
}
NULL ul{margin:0!important; width:100%}
.portfolio-top-right-inner{display:none}

.bg{padding-top:40px}
.banner-info br{display:none}



	.team-members {
		padding: 1em 0 2em 0;
	}
	.tm-head-grid {
		width: 100%;
		float: none;
		margin-right: 0;
	}
	.team-info {
		width: 80%;
	}
	.contact {
		padding: 3em 0 0;
	}
	.contact-left h3 {
		font-size: 2.2em;
	}
	.contact-left{
		margin:0 0 1em 0;
	}
	.service-grid h3 a {
		font-size: 0.8em;
	}
	.expertise-head h3 {
		font-size: 1.5em;
		
	}

.about-time-line{margin:1em auto 15em !important}
.about-time-line > li .cbp_tmicon, .cbp_tmicon1, .cbp_tmicon2, .cbp_tmicon3, .cbp_tmicon2, .cbp_tmicon4{border:3px solid #fff}
	.e-left-inner-grid {
		width: 100%;
		float: none;
		margin-bottom: 0.5em;
	}
	.expertise-left-inner-grids {
		padding: 1em 0;
	}
	.portfolio-top-left h3 {
		font-size: 2em;
	}
	.portfolio-top-left h3 {
		font-size: 1.7em;
	}
	.about-head h1 {
		font-size: 2.2em;
	}
	.copy-right p{
		padding:1.5em 0 1.2em;
		margin-top:3em;
	}
	.contact-right input[type="text"], .contact-right textarea,.contact-right input[type="submit"]{
		-webkit-appearance:none;
		resize:none;
	}
	.contact-right input[type="submit"] {
		padding: 0.7em 0em;
		width: 100%;
		outline:none;
	}
}
@media (max-width:327px){
	.NULL{
		width:90%;
	}
	.portfolio-work-grid-caption {
		padding: 0.5em 1em 0em 1em;
	}
	.banner-info {
		padding: 2em 0 3em;
	}
	.banner-info h1 {
		font-size: 1.2em;
		width: 100%;
	}
	.banner-info p {
		width: 100%;
		font-size: 0.875em;
	}
	.e-left-inner-grid-right {
		width: 80%;
	}
	.portfolio-top-left-grid-right p {
		width: 100%;
	}
	.portfolio-top-left {
		background: url(../images/single-page/portbg-1.png) no-repeat 68% 51%;
		padding:0;
	}
	.about-time-line > li .cbp_tmlabel {
		width: 62%;
		margin: 0% 100% 0px 32%;
		text-align: left;
	}
	.about-time-line > li .cbp_tmlabel1 {
		margin: 0 0 15px 35%;
	}
	.about-time-line:before {
		left: 16%;
	}
	.service-head h2 {
		font-size: 1.5em;
		margin: 0.2em 0 0;
	}
	.services {
		padding: 1em 0;
	}
	.services-grids {
		padding: 1em 0;
	}
	.service-grid h3{
		margin:0 0 0.3em 0;
	}
	.expertice-left-grid {
		padding: 1.5em 2em 1.5em 2em;
	}
	.about {
		padding: 1em 0 14em;
	}
	.about-time-line {
		width: 100%;
		margin: 0;
	}
	.about-time-line > li .cbp_tmicon, .cbp_tmicon1, .cbp_tmicon2, .cbp_tmicon3, .cbp_tmicon2, .cbp_tmicon4 {
		left: 12%;
		width: 70px;
		height: 70px;
	}
	.tm-head h3 {
		font-size: 1.5em;
	}
	.team-members {
		padding: 1em 0 2em 0;
	}
	.tm-head-grid {
		width: 100%;
		float: none;
		margin-right: 0;
	}
	.team-info {
		width: 80%;
	}
	.contact {
		padding: 1.8em 0 0;
	}
	.contact-left h3 {
		font-size: 1.5em;
	}
	.contact-left{
		margin:0 0 1em 0;
	}
	.service-grid h3 a {
		font-size: 0.8em;
	}
	.expertise-head h3 {
		font-size: 1.3em;
	}
	.e-left-inner-grid {
		width: 100%;
		float: none;
		margin-bottom: 0.5em;
	}
	.expertise-left-inner-grids {
		padding: 1em 0;
	}
	.portfolio-top-left h3 {
		font-size: 2em;
	}
	.portfolio-top-left h3 {
		font-size: 1.5em;
	}
	.about-head h1 {
		font-size: 1.8em;
	}
	.copy-right p{
		padding:1.5em 0 1.2em;
		margin-top:3em;
	}
	.e-left-inner-grid-right h4 {
		font-size: 1.1em;
	}
	.e-left-inner-grid-left span {
		margin-top: 0.2em;
	}
	a.leran-more {
		padding: 0.8em 1.3em;
		font-size: 0.9em;
	}
	.portfolio-top-left-grid-right h5 {
		font-size: 1.1em;
	}
	.portfolio-top-left-grid-right {
		width: 82%;
	}
	.portfolio-work-grid-caption h4 {
		font-size: 1.3em;
	}
	.cbp_tmlabel h2 {
		font-size: 0.875em;
		margin: 0;
	}
	.tm-head p {
		width: 80%;
		margin: 0 auto;
	}
	.contact-right-grid p, .contact-right-grid p a {
		font-size: 1em;
	}
	.contact-left-grid p, .contact-left-grid p a {
		font-size: 1em;
	}
	.contact-left label {
		font-size: 0.875em;
	}
	.top-NULL ul li a {
		padding: 0.2em 0;
	}
	.contact-right input[type="text"], .contact-right textarea,.contact-right input[type="submit"]{
		-webkit-appearance:none;
		resize:none;
	}
	.contact-right input[type="submit"] {
		padding: 0.7em 0em;
		width: 100%;
		outline:none;
	}
}





.plans_main_grids{
	width:60%;
	margin:30px auto 85px;
}
.plans_agileits_pricing_grid{
	float:left;
	width:32.2%;
}
.wthree_learning_grid1,.agileinfo_learning_grid1,.agileits_learning_grid1{
	border-radius: 10px;
	position:relative;
}
.plans_agile_learning_grid1_pos{
	bottom:-12px;
	left:0;
	width:100%; text-align:center
}
.plans_agile_learning_grid1_pos a{
	padding: 12px 50px;
    font-size: 1em;
    color: #fff;
    border-radius: 5px;
    text-decoration: none;
	cursor:pointer;
	text-transform:uppercase;
	font-weight:700
}
.plans_agile_learning_grid1_pos a:focus{
	outline:none;
}
.plans_agile_learning_grid1_pos a.plans_agileits_sign_up{
	background:#6082ff;
}
.plans_agile_learning_grid1_pos a.plans_agileits_sign_up1{
	background:#49b681;
}
.plans_agile_learning_grid1_pos a.plans_agileits_sign_up2{
	background:#ff9d77;
}
.plans_agile_learning_grid1_pos a:hover{
	background:#000000;
	color:#ffffff;
}
.wthree_learning_grid1{
	background: url(../images/single-page/1.jpg) no-repeat 0px 0px;
    background-size: cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    -ms-background-size: cover;
}
.agileinfo_learning_grid1{
	background: url(../images/single-page/2.jpg) no-repeat 0px 0px;
    background-size: cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    -ms-background-size: cover;
}
.agileits_learning_grid1{
	background: url(../images/single-page/3.jpg) no-repeat 0px 0px;
    background-size: cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    -ms-background-size: cover;
}
.agile_main_grid {
    padding: 0 1em;
}
.plansls_pricing_grid_top{
	padding: 2em 2em 3em;
    text-align: center;
    border-bottom: 1px solid #7283c6;
	position:relative;
}
.wthree_pricing_grid_top{
	border-bottom:1px solid #5bbd84 !important;
}
.wthree_pricing_grid_top1{
	border-bottom:1px solid #e29b80 !important;
}
.plansls_pricing_grid_top_pos{
	position: absolute;
    bottom: 2%;
	width:100%;
	left:0;
    text-align: center;
}

.single-page-modal{top:20%!important;}

.plansls_pricing_grid_top_pos h4{
	padding:.5em 1em;
	background:#fff;
	color:#212121;
	display:inline-block;
	font-weight:700; text-transform:uppercase;
	font-size:1em;
}
.plansls_pricing_grid_top h3{
	font-size:1.5em;
    color: #fff;
	font-weight:700;
	margin-bottom:.2em;
}
.plansls_pricing_grid_top h3 span{
	font-size:1.5em;
	font-weight:700
}
.plansls_pricing_grid_top h3 span.agile_counter{
	color:#fff;
}
.plansls_pricing_grid_top h3 span.agile_counter1{
	color:#fff;
}
.plansls_pricing_grid_top h3 span.agile_counter2{
	color:#fff;
}
.plansls_pricing_grid_top p{
	font-size:1em;
	color:#fff;
	text-transform:uppercase;
	font-weight:700;
}
.plansl_pricing_grid_content{
	padding:1em 2em 4em;
}
.plansl_pricing_grid_content ul li{
	list-style-type:none;
	padding:1em;
	border-bottom:1px dotted #c1c1c1;
	font-size:14px;
	color:#fff;
}
.plansl_pricing_grid_content ul li i{
	padding-right:1.5em;
	color: #ffffff;
}
/*-- pop-up --*/
.agile_signup_form h2{
	text-align: center;
    font-size: 1.7em;
    margin-bottom: 2em;
    color: #212121;
    position: relative;
    padding-bottom: .5em;
}
.agile_signup_form h2:after{
	content: '';
    background: #f15f22;
    height: 2px;
    width: 15%;
    position: absolute;
    bottom: 0%;
    left: 43%;
}
.modal .form-control{
	position:relative;
	height:auto;
	padding:0 2em;
	border:0 none;
	margin-top: 1em;
}
.modal .form-control label{
	font-size: 1em;
    color: #212121;
    width: 40%;
    display: inline-block;
}
.modal .form-control label span{
	position:absolute;
	left: 30%;
}
.plans{margin-bottom:20px; margin-top:50px}
.NULLbar-fixed-top, .NULLbar-fixed-bottom{z-index:9999!important}
.modal input#firstname,.modal input#lastname,.modal input#email,.modal input#password1,.modal input#password2 {
	padding: 20px 40px;
    width: 59%;
    border: 1px solid #dadada;
    color: #212121;
    text-align:justify;
    outline: none;
    letter-spacing: 1px;
    font-size: 1em;
	font-weight:normal;
    background-color:transparent;
	border-radius:30px;
	-webkit-border-radius:30px;
	-moz-border-radius:30px;
	-o-border-radius:30px;
	-ms-border-radius:30px;	
}
.modal input#firstname:focus,input#lastname:focus,input#email:focus,input#password1:focus,input#password2:focus  {
	background-color: #efefef;
    border: 1px solid #d6d6d6;
}
.modal .plans_submit{
	text-align:right;
	margin:1em 0 0;
}
.modal .register {
    background-color: #5FBBF9;
    width: 59%;
    padding: 20px 0px;
    border: none;
    cursor: pointer;
    color: #fff;
    outline: none;
    font-size: 1em;
    font-weight: normal;
    text-transform: uppercase;
    border-radius: 30px;
    -webkit-border-radius: 30px;
    -moz-border-radius: 30px;
    -o-border-radius: 30px;
    -ms-border-radius: 30px;
}
.modal .register:hover{
    background-color: #49b681;
}
/*-- start-responsive-design --*/
@media (max-width:1440px){
	.plans_main_grids {
		width: 67%;
	}
}
@media (max-width: 1366px){
	.plans_main_grids {
		width: 70%;
	}
}
@media (max-width: 1280px){
	.plans_agileits_pricing_grid {
		width: 32.14%;
	}
}
@media (max-width: 1080px){
	.plans_main_grids {
		width: 85%;
	}
}
@media (max-width: 1024px){
	.plans_agileits_pricing_grid {
		width: 32.06%;
	}
}
@media (max-width: 991px){
	.plans_agileits_pricing_grid {
		width: 32%;
	}
	.plansls_pricing_grid_top {
		padding: 1em 2em 3em;
	}
	.plansl_pricing_grid_content {
		padding: 0.3em;
	}
	.plansls_pricing_grid_top h3 span {
		font-size: 1.4em;
	}
	.tm-head-grid{width:49%; padding:0 15px; display:inline-block}
}
@media (max-width: 900px){
	.plans_main_grids {
		width: 91%;
	}
	.plansl_pricing_grid_content {
		padding: 3em 1em 4em;
	}
}
@media (max-width: 800px){
.project-1 input[type="text"]{width:50%}
	.plans_agileits_pricing_grid {
		width: 100%; margin-bottom:25px
	}
.agile_main_grid{padding:0}
	.plansls_pricing_grid_top_pos h4 {
		font-size: 14px;
	}
	.plansls_pricing_grid_top h3 {
		font-size: 1.3em;
	}
	.plans_agile_learning_grid1_pos {
		left: 19%;
	}
	.plansl_pricing_grid_content {
		padding: 2em 1em 4em;
	}
	.main h1 {
		font-size: 2.3em;
	}
}
@media (max-width: 800px){
	.plans_main_grids {
		width: 95%;
	}
	.service-grid p{margin-bottom:20px;}
	.service-grid h3{margin-top:15px; margin-bottom:5px}
	.about-time-line{margin:0!important}
	.about{padding:1em 0 17em}
	.banner-info{margin-bottom:7.4em; padding:0;}
	.top-NULL ul li a{padding:0}
	.tm-head h3{font-size:2.6em}
.agileits-clients .col-md-6 {width:100%; margin:0 0 30px; padding-bottom:2em}

.client-agile-info{min-height:800px; padding-top:3em}
.agileits-clients{padding-top:2em}
.callbacks_NULL{bottom:-7%}
.callbacks_NULL.prev{left:44%; }
.callbacks_NULL.next{left:53%; }
.project-1 p{font-size:15px}
}
@media (max-width: 768px){
	.banner-info{margin-bottom:6.5em; padding:0;}
	.fixed-theme .logo img{width:100%}
}

@media (max-width: 736px){
.about{padding-bottom:13em}
	.plans_agileits_pricing_grid {
		width: 100%;
		float: none;
	}
		.project-1 h3 , .contact-left h3 , .tm-head h3 , .h3.tittle.two, .about-head h1, .portfolio-top-left h3, .expertise-head h3, .service-head h2 {
		font-size: 2.2em;
	}

	.bg{padding-top:130px}
	.logo{width:140px;}
	.logo img{width:100%}
	.agile_main_grid {
		padding: 3em 0;
	}
	.plans_agile_learning_grid1_pos {
		left: 31%;
	}
	.form-control label {
		width: 38%;
	}
	.agile_signup_form h2 {
		margin-bottom: 1.3em;
	}
	.register {
		width: 61%;
	}
}
@media (max-width: 667px){
	input#firstname, input#lastname, input#email, input#password1, input#password2 {
		padding: 15px 35px;
	}
	.form-control label {
		font-size: 14px;
	}
	.form-control label span {
		left: 33%;
	}	.bg-slider{height:auto}

	.register {
		padding: 15px 0px;
	}
	.banner-info p{margin:0.5em auto 2.5em}
	.agileits-clients .col-md-6:nth-child(odd){display:none}
	.client-agile-info{min-height:480px}
	.tm-head-grids{margin-bottom:0}
	.plans_main_grids{margin:30px auto 40px}
	.project-1 input[type="text"]{width:60%}
	.banner-info h1{margin-bottom:0}
}
@media (max-width: 640px){
	.main h1 {
		font-size: 2em;
	}
	.plans_agile_learning_grid1_pos {
		left: 29%;
	}
	.agile_main_grid{padding:1em 0}
	input#firstname, input#lastname, input#email, input#password1, input#password2 {
		width: 43%;
	}
	.e-left-inner-grid{min-height:190px}
}
@media (max-width: 568px){
.project-1 p{font-size:12px}

.project-1 h3, .contact-left h3, .tm-head h3, .h3.tittle.two, .about-head h1, .portfolio-top-left h3, .expertise-head h3, .service-head h2{font-size:1.6em }
.tm-head-grid{width:99%}

h3.tittle.two{font-size:27px}
	.e-left-inner-grid{width:97%; min-height:inherit}
	
	.portfolio-top-right-inner{display:none}
	.plansls_pricing_grid_top {
		padding: 1em 2em 3em;
		
	}
	
	.modal .form-control{padding:0 1em}
	.modal input#firstname, .modal input#lastname, .modal input#email, .modal input#password1, .modal input#password2{padding:10px 20px}
	.modal .register{padding:10px 20px}
	.agileits_copyright p {
		font-size: 14px;
	}
	
	.banner-info h1{font-size:2em}
	.bg{padding-top:100px;}
	.banner-info{margin-bottom:1.5em}
}
@media (max-width: 480px){
	.main h1 {
		font-size: 1.8em;
	}
	.plans_main_grids {
		width: 65%;
	}
	input#firstname, input#lastname, input#email, input#password1, input#password2 {
		font-size: 14px;
		padding: 12px 27px;
	}
	.agile_signup_form h2 {
		font-size: 1.4em;
	}
	.register {
		padding: 12px 0px;
		font-size: 14px;
	}
	.banner-info h1{font-size:1.4em}
	h3.tittle.two, .project-1 h3, .contact-left h3, .tm-head h3, .h3.tittle.two, .about-head h1, .portfolio-top-left h3, .expertise-head h3, .service-head h2{font-size:1.5em}
	.cbp_tmlabel h2{font-size:0.8em }
	.banner-info p{margin-bottom:5em; font-size:0.8em}
		.project-1 input[type="submit"]{width:40%}
.expertice-left-grid{padding:1.5em 2em}
.modal input#firstname, .modal input#lastname, .modal input#email, .modal input#password1, .modal input#password2{width:57%; margin:0}
.modal-body{padding:10px 0 15px}
.single-page-modal{top:5%!important}
.agileits-clients{padding-top:1em}
.callbacks_NULL.prev{left:36%}

}
@media (max-width: 414px){
	.main {
		padding: 2em 0;
	}
	.main h1 {
		font-size: 1.6em;
	}
	.plans_main_grids {
		width: 70%;
	}
	.agileits_copyright {
		margin: 2.5em 0 0;
	}
	.form-control label {
		width: 100%;
	}
	input#firstname, input#lastname, input#email, input#password1, input#password2 {
		width: 82%;
		margin: 1em 0 0;
	}
	.register {
		width: 100%;
	}
}
@media (max-width:384px){
	.main h1 {
		font-size: 1.5em;
	}
	.agile_main_grid {
		padding: 2em 0;
	}
}
@media (max-width: 375px){
	.banner-info p{font-size:0.7em}
	.bg{padding-top:85px}
	.logo{width:102px}
	h3.tittle.two, .project-1 h3, .contact-left h3, .tm-head h3, .h3.tittle.two, .about-head h1, .portfolio-top-left h3, .expertise-head h3, .service-head h2{font-size:1.2em}
	.agileits-clients p{font-size: 0.85em;
    line-height: 1.8em;}
	.callbacks_NULL.prev{left:36%}
}
@media (max-width: 320px){
	.main h1 {
		font-size: 1.4em;
	}
	.plans_main_grids {
		width: 85%;
	}
	.plansls_pricing_grid_top h3 {
		font-size: 1.1em;
	}
	.plansls_pricing_grid_top p {
		font-size: 14px;
	}
	.plansls_pricing_grid_top {
		padding: 2em 1em 2.5em;
	}
	.plansls_pricing_grid_top_pos h4,.plansl_pricing_grid_content ul li,.agileits_copyright p {
		font-size: 13px;
	}
	.plansl_pricing_grid_content {
		padding: 1.5em 1em 3.5em;
	}
	.plans_agile_learning_grid1_pos a {
		padding: 8px 35px;
		font-size: 14px;
	}
	input#firstname, input#lastname, input#email, input#password1, input#password2 {
		width: 78%;
		font-size: 13px;
	}
	.agile_signup_form h2 {
		font-size: 1.3em;
	}
}




.carousel-fade {
    .carousel-inner {
        .item {
            transition-property: opacity;
        }
        
        .item,
        .active.left,
        .active.right {
            opacity: 0;
        }

        .active,
        .next.left,
        .prev.right {
            opacity: 1;
        }

        .next,
        .prev,
        .active.left,
        .active.right {
            left: 0;
            transform: translate3d(0, 0, 0);
        }
    }

    .carousel-control {
        z-index: 2;
    }
}
    
    
</style>