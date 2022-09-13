<?php 

    if(isset($download_success)){
        echo '<script type="text/javascript"> 
            swal("Success!", "Download link has been sent to your mailbox!", "success"); 
        </script>';
    }
?>

<div class="ls-row footer-wrapper" id="footerWrapper" style="border-top:0px!important;">
    <div class="ls-area footer-bottom" id="footerBottom">
        <div class="ls-cmp-wrap" id="w1508565242546">
            <div class="iw_component" id="c1508565242546">

                <!-- COMPONENT: vi16-page-frame/Sitemap -->
                <!-- <div data-componentName="Sitemap" class="vi16">
                    <div class="sitemap">
                        <div class="wrapper-980">
                            <div class="sitemap-links hide-on-mobile head-block">
                                <div class="column one-in-5">
                                    <a href="<?php echo $GLOBALS['path']; ?>index" title="Blackloop LLC">
                                    <div class="logo"><img src="<?php echo $GLOBALS['path']; ?>png/BlackLoop Logo PNG (WHITE).png" width="160px"/></div>
                                    <div class="mobile logo"><img src="<?php echo $GLOBALS['path']; ?>png/BlackLoop Logo PNG (WHITE).png" width="180px"/>
                                    </div>
                                </a>
                                </div>
                                <div class="column one-in-8">
                                    <a href="#" class="menu inactive" style="font-weight: bold;font-size: 15px;"
                                       id="mm-hr1yg190" data-link-event="About Us" data-id="About Us">
                                        What We're Not </a>
                                </div>
                                <div class="column one-in-8">
                                    <a href="#" class="menu inactive" style="font-weight: bold;font-size: 15px;"
                                       id="mm-iljp1yri" data-link-event="Responsibility" data-id="Responsibility">
                                        How We Serve You </a>
                                </div>
                                <div class="column one-in-8">
                                    <a href="#" class="menu inactive" style="font-weight: bold;font-size: 15px;"
                                       id="mm-igfogz60" data-link-event="More Info" data-id="More Info">
                                        Join Our Crusade </a></a>
                                </div>
                                <div class="column one-in-8">
                                    <a href="#" class="menu inactive" style="font-weight: bold;font-size: 15px;"
                                       id="mm-iljp1yri" data-link-event="Responsibility" data-id="Responsibility">
                                        FAQ </a></div>
                                <div class="column one-in-8">
                                    <a href="#" class="menu inactive" style="font-weight: bold;font-size: 15px;"
                                       id="mm-igfogz60" data-link-event="More Info" data-id="More Info">
                                        Contact </a>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                </div> -->
            </div>
        </div>
        <div class="ls-cmp-wrap" id="w1508565242547">
            <div class="iw_component" id="c1508565242547">

                <!-- COMPONENT: vi16-page-frame/Footer -->
                <div data-componentName="Footer" class="vi16">
                    <div class="footer">
                        <div class="links" style="border-bottom: 1px solid #FE6802;">
                            <!-- <div class="wrapper-980 clearfix text-center">

                                <div class="col-xs-12 hidden-sm hidden-md hidden-lg" style="padding: 0px;">
                                    <iframe width="100%" height="180px" style="margin: 0 0 20px 0;" src="https://www.youtube.com/embed/8zfpfWHj1_M" frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe>
                                    <a href="<?php echo $GLOBALS['path']; ?>faq" data-link-event="cta:FAQ"
                                       target="_self" class="cta link"> <span
                                                class="label"><span>FAQ</span></span>
                                        <span class="short label">
                                                <span>FAQ</span>
                                            </span>
                                    </a>
                                    <a href="<?php echo $GLOBALS['path']; ?>contact" data-link-event="cta:Contact Us"
                                       target="_self" class="cta link"> <span
                                                class="label"><span>Contact Us</span></span>
                                        <span class="short label">
                                                <span>Contact Us</span>
                                            </span>
                                    </a>
                                    <a href="#" data-toggle="modal" data-target="#editProfileModal
                                        " data-link-event="cta:Download Brochure"
                                       target="_self" class="cta link"> <span
                                                class="label"><span>Download Brochure</span></span>
                                        <span class="short label">
                                                <span>Download Brochure</span>
                                            </span>
                                    </a>
                                </div>
                                <a href="terms-conditions" data-link-event="cta:Terms & Conditions"
                                   target="_self" class="cta link"> <span
                                            class="label"><span>Terms & Conditions</span></span>
                                    <span class="short label">
                                            <span>Terms & Conditions</span>
                                        </span>
                                </a>
                                <a href="privacy-policy" data-link-event="cta:Privacy Policy" target="_self"
                                   class="cta link"> <span class="label"><span>Privacy Policy</span></span>
                                    <span class="short label">
                                            <span>Privacy Policy</span>
                                        </span>
                                </a>
                            </div> -->
                        </div>
                        <div class="wrapper-980 copyright text-center">© <?php echo date("Y") ?> Blackloop Club. All rights reserved.</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <div  class="modal fade modal-warning" id='editProfileModal' tabindex='-1' role='dialog'>
    <div class='modal-dialog' role='document'>
        <div class='modal-content'>
            <form action='' method='post'>
                <div class='modal-header' style="background: #FE6802">
                    <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                    <h1 class='modal-title text-center' style="font-weight: bold;color: #FFF;">FILL THIS FORM TO HAVE THE DOWNLOAD LINK SENT TO YOUR EMAIL</h1>
                </div>
                <div class='modal-body'>
                    <label>First Name</label>
                    <input required="" type="text" style="margin-bottom: 15px;border: 1px solid #FE6802;height: 40px;" name="fname" placeholder="Enter first name" class="form-control">
                    <label>Last Name</label>
                    <input required="" type="text" style="margin-bottom: 15px;border: 1px solid #FE6802;height: 40px;" name="lname" placeholder="Enter last name" class="form-control">
                    <label>Email Address</label>
                    <input required="" type="text" style="margin-bottom: 15px;border: 1px solid #FE6802;height: 40px;" name="email" placeholder="Enter email address" class="form-control">
                    <label style="font-weight: normal;color: #777"><input type="radio" checked value="1"> Clicking the submit button means you agree to receive our periodic newsletter updates in your email!</label>
                </div>
                <div class='modal-footer'>
                    <button type='button' class='btn btn-inverse' data-dismiss='modal'><span class="fa fa-remove"></span> Close</button>
                    <button type='submit' name='download_brochure' style="background: #FE6802" class='btn btn-warning'><span class="fa fa-paper-plane"></span> Submit</button>
                </div>
            </form>
        </div>
    </div>
</div> -->