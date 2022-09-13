<?php 
    require_once "../functions_basic.php";
    require_once "validation.php";

    validateUser();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Open Notification | Blackloop Club</title>
        <?php require_once "styles.php"; ?>

        <style type="text/css">
            .inbox-date {
                float: right;
                margin-top: 20px;
            }

            .inbox-avatar {
                padding-bottom: 0px;
            }

            @media(max-width: 767px){
                .inbox-date {
                    float: left;
                    margin-top: 0px;
                }  

                .inbox-avatar {
                    padding-bottom: 40px!important;
                }              
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
                   
                    <div class="content-header" style="margin-bottom: -40px;">
                         <?php require_once "news-flash.php"; ?>
                        <div class="header-icon">
                            <i class="fa fa-flag"></i>
                        </div>
                        <div class="header-title">
                            <h1>Open Notification</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Notifications</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mailbox">
                                <div class="mailbox-header">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            &nbsp;
                                        </div>
                                        <div class="col-xs-8" style="margin-bottom: 20px;">
                                            <div class="inbox-toolbar btn-toolbar">
                                                <div class="btn-group">
                                                    <a href="notifications" title="Return to all notifications" class="btn btn-default"><span class="fa fa-long-arrow-alt-left"></span> Back</a>
                                                </div>
                                                <div class="btn-group  m-b-5">
                                                    <button type="button" class="btn btn-default">Mark</button>
                                                    <button type="button" data-toggle="dropdown" class="btn dropdown-toggle btn-default">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">default</span>
                                                    </button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        <li><a href="#">Read</a>
                                                        </li>
                                                        <li><a href="#">Unread</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="hidden-xs hidden-sm btn-group">
                                                    <!-- <button type="button" class="text-center btn btn-danger"><span class="fa fa-exclamation"></span></button> -->
                                                    <button type="button" class="btn btn-danger"><span class="fa fa-trash"></span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mailbox-body">
                                    <div class="row m-0">
                                        <div class="col-xs-12 p-0 inbox-mail">
                                            <div class="inbox-avatar p-20 border-btm">
                                                <div class="inbox-avatar-text">
                                                    <div class="avatar-name"><strong>From: </strong>
                                                        Admin
                                                    </div>
                                                    <div><small><strong>Subject: </strong> Lorem Ipsum is simply dummy text of the printing and typesetting industry</small></div>
                                                </div>
                                                <div class="inbox-date text-right">
                                                    <!-- <div><span class="bg-green badge"><small>OPPORTUNITIES</small></span></div> -->
                                                    <div><small>June 5th, 08:41 AM</small></div>
                                                </div>
                                            </div>
                                            <div class="inbox-mail-details p-20">
                                                <p><strong>Hi Naeem,</strong></p>
                                                <p><span>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that</span></p>
                                                <p><span>Maecenas sed enim ut sem viverra aliquet. Consectetur adipiscing elit ut aliquam purus sit amet luctus.</span><span>Bibendum est ultricies integer quis :</span></p>
                                                <div>
                                                    <ul>
                                                        <li><span>Lorem ipsum dolor sit amet, consectetur adipiscing elit.</span></li>
                                                        <li><span>Quisque dictum lorem id tempus lacinia.</span></li>
                                                        <li><span>Aenean placerat metus eget dignissim sodales.</span></li>
                                                        <li><span>Vivamus pretium risus vitae nibh maximus bibendum.</span></li>
                                                        <li><span>Curabitur maximus neque eget elit fermentum, at sagittis elit gravida.</span></li>
                                                    </ul>
                                                    <blockquote><small><strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy</strong></small></blockquote>
                                                </div>
                                                <p><span>Ac tincidunt vitae semper quis lectus nulla at volutpat diam. Pellentesque massa placerat duis ultricies.</span></p>
                                                <div><strong>Regards,</strong></div>
                                                <div><strong>Tanjil Ahmed</strong></div>
                                                
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
        <?php require_once "scripts.php"; ?>
    </body>
</html>
