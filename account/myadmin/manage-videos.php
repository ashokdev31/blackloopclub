<?php 
    require_once "../../functions_basic.php";
    require_once "validation.php";

    validateAdmin(5);

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $admin_id = $row['id'];
    }

    if(isset($_POST['update_video'])){
        $title = $_POST['title'];
        $url = $_POST['url'];
        $status = $_POST['status'];
        $date = date("Y-m-d H:i:s");
        $video_id = $_POST['video_id'];

        if($status=="Delete"){
            otherPDO("delete from multimedia where id = ?", array($video_id));
        }else{
            otherPDO("update multimedia set title = ?, url = ?, status = ?, date_modified = ? where id = ?", array($title, $url, $status, $date, $video_id));
        }
        $success = "Update was successful!";
    }

    if(isset($_POST['add_video'])){
        $title = $_POST['title'];
        $url = $_POST['url'];
        $type = "video";
        $date = date("Y-m-d H:i:s");

        otherPDO("insert into multimedia (title, url, type, date_posted, date_modified, admin) values (?,?,?,?,?,?)", array($title, $url, $type, $date, $date, $admin_id));
        $success = "Video has been added successfully!";
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
        <title>Manage Videos | Blackloop Club</title>
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
                            <i class="fa fa-video"></i>
                        </div>
                        <div class="header-title">
                            <h1>Manage Videos</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Manage Videos</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">

                        <?php if(isset($success)){ ?>
                        <div class="col-xs-12 col-md-6">
                            <div class="alert alert-success text-center"><?php echo $success; ?></div>
                        </div>
                        <?php }elseif(isset($error)){ ?>
                        <div class="col-xs-12 col-md-6">
                            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                        </div>
                        <?php } ?>

                        <div class="col-xs-12" style="padding: 0px;">
                            <form action="" method="post">
                                <div class="col-xs-12 col-md-6">
                                    <h2 class="text-center btn btn-default" style="width: 100%;margin-bottom: -5px;font-weight: bold;padding: 10px;cursor: text;">Add New Video</h2>
                                    <div class="panel panel-bd">
                                        
                                        <div class="panel-body">
                                            <form action="" method="post">
                                                <div class='form-group'>
                                                    <label for='exampleSelect1'>Video Title</label>
                                                    <input type='text' required name='title' placeholder='Enter video title' class='form-control'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='exampleSelect1'>Video URL</label>
                                                    <input type='text' name='url' placeholder='Enter video URL' class='form-control'>
                                                </div>
                                                <div>
                                                    <button type="submit" name="add_video" class="btn btn-primary pull-right">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div> 
                            </form>
                        </div>
                        
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Manage All Videos </h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="user_table" style="word-wrap: break-word;table-layout: fixed;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 6%;">SN</th>
                                                    <th style="width: 29%;">Title</th>
                                                    <th style="width: 29%;">URL</th>
                                                    <th style="width: 10%;">Status</th>
                                                    <th style="width: 10%;">Date Posted</th>
                                                    <th style="width: 10%;">Last Modified</th>
                                                    <th style="width: 6%;">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo showVideos(); ?>
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
