<?php 
    require_once "../functions_basic.php";
    include "../password_compat-master/lib/password.php";
    require_once "validation.php";

    validateUser();

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $user_id = $row['id'];
    }
    

    if(!isset($_SESSION['ticket_success'])){
        header("Location: index");
        exit;
    }
    unset($_SESSION['ticket_success']);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Ticket Confirmation | Blackloop Club</title>
        <?php require_once "styles.php"; ?>

        <style type="text/css">
            
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
                            <i class="fa fa-rss-square"></i>
                        </div>
                        <div class="header-title">
                            <h1>Ticket Confirmation</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Ticket Confirmation</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mailbox">
                                <div class="mailbox-body">
                                    <div class="row m-0">
                                        <div class="col-xs-12" style="text-align: center;padding: 50px 0 70px 0;">
                                            <img src="../png/submission-success.png" width="40%" style="max-width: 250px;" />
                                            <label class="input-label col-xs-12" style="text-align: center !important;font-size: 30px !important;"><h1>Ticket submitted successfully!</h1></label>
                                            <label class="input-label col-xs-12" style="text-align: center !important;font-size: 14px !important;">We will review your ticket and respond to you within 24hrs.</label>
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
