<?php 
    require_once "../../functions_basic.php";
    require_once "validation.php"; 

    validateAdmin(1);

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>All Payouts | Blackloop Club</title>
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
                         <?php require_once "../news-flash.php"; ?>
                        <div class="header-icon">
                            <i class="fab fa-bitcoin"></i>
                        </div>
                        <div class="header-title">
                            <h1>All Payouts</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">All Payouts</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3" title="All monies ever due to clients in the system">
                            <div class="statistic-box statistic-filled-1">
                                <h3>&#8358; <span class="count-number"><?php echo number_format(cummOutflow(), 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Cummulative Outflows</div>
                                <i class="ti-world statistic_icon fab fa-google-wallet"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3" title="All monies taken out of the system by clients">
                            <div class="statistic-box statistic-filled-3">
                                <h3>&#8358; <span class="count-number"><?php echo number_format(totalPayouts(), 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Total Payouts</div>
                                <i class="ti-world statistic_icon fa fa-shopping-basket"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3" title="All monies in the system due to clients">
                            <div class="statistic-box statistic-filled-4">
                                <h3>&#8358; <span class="count-number"><?php echo number_format(outstandingPayouts(), 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Outstanding Payouts</div>
                                <i class="ti-world statistic_icon fa fa-home"></i>
                            </div>
                        </div>

                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-3" title="All monies refunded to clients for whatever reasons">
                            <div class="statistic-box statistic-filled-2">
                                <h3>&#8358; <span class="count-number"><?php echo number_format(totalRefunds(), 2); ?></span></h3>
                                <div class="big" style="font-weight: bold">Total Refunds</div>
                                <i class="ti-world statistic_icon fa fa-home"></i>
                            </div>
                        </div>

                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Total Payout History </h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="earnings_table">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Email</th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th>Date Posted</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo totalPayoutHistory(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Total Outstanding Payout History </h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="earnings_table2">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Email</th>
                                                    <th>Type</th>
                                                    <th>Amount</th>
                                                    <th>Date Posted</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo totalOutstandingHistory(); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Total Refund History </h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="earnings_table3">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Email</th>
                                                    <th>Amount</th>
                                                    <th>Date Processed</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo totalRefundHistory(); ?>
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
