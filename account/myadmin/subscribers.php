<?php 
    require_once "../../functions_basic.php"; 
    require_once "validation.php"; 

    validateAdmin(5);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Newsletter Subscribers | Blackloop Club</title>
        <?php require_once "styles.php"; ?>
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
                            <i class="fa fa-newspaper"></i>
                        </div>
                        <div class="header-title">
                            <h1>Newsletter Subscribers</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Newsletter Subscribers</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>All Newsletter Subscribers </h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="user_table">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Names</th>
                                                    <th>Email</th>
                                                    <th>Registered</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo allSubscribers(); ?>
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