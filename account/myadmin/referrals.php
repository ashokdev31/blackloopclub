<?php 
    require_once "../../functions_basic.php";
    include "../../password_compat-master/lib/password.php";
    require_once "validation.php";

    validateAdmin(2);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Referrals | Blackloop Club</title>
        <?php require_once "styles.php"; ?>

        <style type="text/css">
            .btn-labeled {
                float: right;
            }

            @media(max-width: 767px){
                .btn-labeled {
                    float: left;
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
                   
                    <div class="content-header">
                         <?php require_once "../news-flash.php"; ?>
                        <div class="header-icon">
                            <i class="fa fa-link"></i>
                        </div>
                        <div class="header-title">
                            <h1>Referrals</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Referrals</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" title="All users that have ever successfully registered on the system">
                            <div class="statistic-box statistic-filled-1">
                                <h3><span class="count-number"><?php echo number_format(totalRegUsers()); ?></span></h3>
                                <div class="big" style="font-weight: bold">All Registered Users</div>
                                <i class="ti-world statistic_icon fab fa-google-wallet"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" title="All users that registered on the system through referrals">
                            <div class="statistic-box statistic-filled-3">
                                <h3><span class="count-number"><?php echo number_format(totalReferredUsers()); ?></span></h3>
                                <div class="big" style="font-weight: bold">All Referred Users</div>
                                <i class="ti-world statistic_icon fa fa-shopping-basket"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4" title="All users that registered on the system through without referrals">
                            <div class="statistic-box statistic-filled-4">
                                <h3><span class="count-number"><?php echo number_format(totalOrganicUsers()); ?></span></h3>
                                <div class="big" style="font-weight: bold">All Organic Users</div>
                                <i class="ti-world statistic_icon fa fa-home"></i>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Total Referrals Report</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="earnings_table">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Plan</th>
                                                    <th>Level</th>
                                                    <th>Referrals</th>
                                                    <th>Date Activated</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo totalReferrals(); ?>
                                            </tbody>
                                        </table>
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
