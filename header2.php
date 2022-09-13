<?php require_once "functions_basic.php"; ?>
<div class="ls-row" id="mastheadWrapper">

    <div class="ls-area top-nav">
        <div class="ls-cmp-wrap" id="w1481956139585">
            <div class="iw_component" id="c1481956139585">

                <!-- COMPONENT: vi16-page-frame/Masthead -->
                <div data-componentName="Masthead" class="vi16 clearfix" id="vi16Masthead">
                    <div class="masthead desktop hide-on-mobile">
                        <div class="wrapper-980 main-section">

                            <!-- <div class="pull-right" style="margin-top: 2px;margin-left: 20px">
                                <div id="google_translate_element"></div>
                                <script type="text/javascript">
                                    function googleTranslateElementInit() {
                                        new google.translate.TranslateElement({
                                            pageLanguage: 'en', includedLanguages: 'af,ar,zh-CN,zh-TW,nl,en,de,el,iw,hi,id,it,ja,ko,la,pl,pt,ru,es,sw,tr,uk',
                                            layout: google.translate.TranslateElement.InlineLayout.SIMPLE
                                        }, 'google_translate_element');
                                    }
                                </script>
                                <script type="text/javascript"
                                        src="https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
                            </div> -->

                            <div class="right-cntnr float-right">
                                <ul class="siteUtils float-left" style="margin-top: 5px;">
                                    <!-- <li style="margin-right: 20px;"><a style="font-size: 15px;color:#FFF;"
                                                                       href="<?php //echo $GLOBALS['path']; ?>join"><span
                                                    class="fa fa-pencil-square-o" style="font-weight: bold;"></span>
                                            Join</a></li>
                                    <li><a style="font-size: 15px;color:#FFF;"
                                           href="<?php //echo $GLOBALS['path']; ?>login"><span class="fa fa-lock"
                                                                                                style=""></span>
                                            Login</a></li> -->
                                <!-- @auth
                                <li style="margin-right: 20px;"><a style="font-size: 15px;color:#FFF;"
                                               href="<?php //echo $GLOBALS['path']; ?>home"><span class="fa fa-dashboard"
                                                                             style=""></span>
                                                Dashboard </a></li>
                                        <li><a style="font-size: 15px;color:#FFF;" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();"
                                               href="{{ route('logout') }}"><span class="fa fa-lock" style=""></span>
                                                 Logout</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>

                                    @endauth -->
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ls-area" id="navWrapper">
        <div class="ls-cmp-wrap" id="w1481956139586">
            <div class="iw_component" id="c1481956139586">

                <!-- COMPONENT: vi16-page-frame/Main Nav -->
                <div data-componentName="Main Nav" class="vi16">
                    <div class="main-nav desktop hide-on-mobile" style="border-bottom: 1px solid #eee">
                        <div class="wrapper-980 text-center">
                            <a href="<?php echo $GLOBALS['path']; ?>index" title="Blackloop LLC">
                                <div class="logo"><img src="<?php echo $GLOBALS['path']; ?>images/Blackloop club Shadow Black PNG2.png" width="180px" style="margin-bottom: 15px;margin-top:0px;" alt="Blackloop Club"/></div>
                            </a>
                        </div>
                    </div>
                    <div class="main-nav mobile hide-on-desktop">
                        <div class="nav-bar">
                            <div class="display-table">
                                <div class="display-row">
                                    <div class="display-cell icon-cell">
                                        <div class="nav-icon menu-toggle" data-id="menu"></div>
                                    </div>
                                    <div class="display-cell logo-cell text-center">
                                        <a href="<?php echo $GLOBALS['path']; ?>index" title="Blackloop Club"> <img class="logo" src="<?php echo $GLOBALS['path']; ?>images/Blackloop club Shadow Black PNG2.png" width="180px" style="margin-left: -60px;" alt="Blackloop Club"/>
                                        </a>
                                    </div>
                                    <!-- <div class="display-cell icon-cell">
                                        <div  onclick="$(this).unbind();" class="nav-icon search icon-sprite fa fa-search"
                                             style="font-size: 17px;" data-id="search"></div>
                                    </div> -->
                                </div>
                            </div>
                        </div>
                        <div class="space-holder"></div>
                        <div class="overlay sarch">
                        </div>
                        <div class="overlay menu">
                            <div class="view-space">
                                <div class="main">
                                    <div class="nav-data root-l1"></div>
                                    <div class="nav-data root-l2"></div>
                                    <!-- <div class="separator"></div> -->
                                    <div class="nav-data signin">
                                        <div class="level-one"></div>
                                        <div class="level-two"></div>
                                    </div>
                                    
                                    <!-- @auth
                                    <div class="nav-data usertypes">
                                        <div style="padding-left:20px !important;padding-top:15px;"><a style="color:#000 !important;text-decoration:none !important;" href="<?php echo $GLOBALS['path']; ?>home">Dashboard</a></div>
                                    </div>
                                    <div class="nav-data languages"></div>
                                    <div class="nav-data usercontacts">
                                        <div style="padding-left:20px !important;"><a style="color:#000 !important;text-decoration:none !important;"  onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{route('logout">Logout</a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </div>
                                    @endauth -->
                                    <div class="nav-data sitelinks">
                                        <div class="level-one"></div>
                                        <div class="level-two"></div>
                                    </div>
                                </div>
                                <div class="sub"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>