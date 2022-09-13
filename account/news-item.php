<?php 
    require_once "../functions_basic.php"; 
    require_once "validation.php";

    validateUser();
    
    if(isset($_GET['v'])){
        $query = selectPDO("select * from news_updates where id = ? and status = '1'", array($_GET['v']));
        
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            $subject = $row['subject'];
            $message = $row['message'];
            if($row['banner']!=NULL){
                $banner = "<img src='../{$row['banner']}' width='100%' style='margin-bottom:30px;' />";
            }else{
                $banner = "";
            }
            $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
            $tags_all = $row['tags'];
            $tags = explode(",", $tags_all);
            $tag = "";
            if(sizeof($tags)>0){
                foreach ($tags as $key => $value) {
                    $query2 = selectPDO("select * from news_tags where id = ?", array($value));
                    while($row2=$query2->fetch(PDO::FETCH_ASSOC)){
                        $name = strtoupper($row2['name']);
                        $tag .= "<span class='label label-pill label-{$row2['color']} m-r-5'>{$name}</span>";
                    }
                }
            }
        }

        if($query->rowCount()==0){
            header("Location: news-updates");
            exit;
        }


    }else{
        header("Location: news-updates");
        exit;
    }

?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title><?php echo $subject; ?> | Blackloop Club</title>
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
                            <i class="fa fa-rss-square"></i>
                        </div>
                        <div class="header-title">
                            <h1>News Item</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">News Updates</li>
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
                                                    <a href="news-updates" title="Return to all news updates" class="btn btn-default"><span class="fa fa-long-arrow-alt-left"></span> Back</a>
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
                                                    <div><small><strong>Subject: </strong> <?php echo $subject; ?></small>
                                                    </div><br/>
                                                    <?php echo $tag; ?>
                                                </div>
                                                <div class="inbox-date text-right">
                                                    <div><small><?php echo $date_posted; ?></small></div>
                                                </div>
                                            </div>
                                            <div class="inbox-mail-details p-20">
                                                <?php echo $banner."".$message; ?>
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
