<?php 
    require_once "../../functions_basic.php";
    require_once "validation.php";

    validateAdmin(5);

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $admin_id = $row['id'];
    }

    if(isset($_POST['update_download'])){
        $title = $_POST['title'];
        $status = $_POST['status'];
        $date = date("Y-m-d H:i:s");
        $download_id = $_POST['download_id'];

        if($status=="Delete"){
            otherPDO("delete from multimedia where id = ?", array($download_id));
        }else{

            if(isset($_FILES["cover"]) && $_FILES["cover"]['size']>0){

                define("UPLOAD_DIR", "../../account/img/cover_photo/");

                if($_FILES["cover"]['size']>5000000){
                    $error = "File size cannot be more than 5mb!";
                }else{

                    $cover = $_FILES["cover"];

                    if ($cover["error"] !== UPLOAD_ERR_OK) {
                        echo "<p>An error occurred.</p>";
                        exit;
                    }

                    // ensure a safe filename
                    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $cover["name"]);

                    // don't overwrite an existing file
                    $i = 0;
                    $parts = pathinfo($name);
                    while (file_exists(UPLOAD_DIR . $name)) {
                        $i++;
                        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
                    }

                    // preserve file from temporary directory
                    $success = move_uploaded_file($cover["tmp_name"], UPLOAD_DIR . $name);

                    if (!isset($success)) {
                        echo "<p>Unable to save file.</p>";
                        exit;
                    }
                    // set proper permissions on the new file
                    chmod(UPLOAD_DIR . $name, 0644);

                    $cover = substr((UPLOAD_DIR.$name), 6);

                    $query = selectPDO("select * from multimedia where id = ?", array($download_id));
                    while($row=$query->fetch(PDO::FETCH_ASSOC)){
                        if($row['cover_photo']!="account/img/pdf.png"){
                            if(!unlink("../../".$row['cover_photo'])){
                                echo "error deleting file";
                            }
                        }
                    }

                    otherPDO("update multimedia set cover_photo = ? where id = ?", array($cover, $download_id));

                }
            }

            if(isset($_FILES["url"]) && $_FILES["url"]['size']>0){

                define("UPLOAD_DIR2", "../../account/img/downloads/");

                if($_FILES["url"]['size']>5000000){
                    $error = "File size cannot be more than 5mb!";
                }else{

                    $url = $_FILES["url"];

                    if ($url["error"] !== UPLOAD_ERR_OK) {
                        echo "<p>An error occurred.</p>";
                        exit;
                    }

                    // ensure a safe filename
                    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $url["name"]);

                    // don't overwrite an existing file
                    $i = 0;
                    $parts = pathinfo($name);
                    while (file_exists(UPLOAD_DIR2 . $name)) {
                        $i++;
                        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
                    }

                    // preserve file from temporary directory
                    $success = move_uploaded_file($url["tmp_name"], UPLOAD_DIR2 . $name);

                    if (!isset($success)) {
                        echo "<p>Unable to save file.</p>";
                        exit;
                    }
                    // set proper permissions on the new file
                    chmod(UPLOAD_DIR2 . $name, 0644);

                    $url = substr((UPLOAD_DIR2.$name), 6);

                    $query = selectPDO("select * from multimedia where id = ?", array($download_id));
                    while($row=$query->fetch(PDO::FETCH_ASSOC)){
                        if(!unlink("../../".$row['url'])){
                            echo "error deleting file";
                        }
                    }

                    otherPDO("update multimedia set url = ? where id = ?", array($url, $download_id));

                }
            }

            if(!isset($error)){
                otherPDO("update multimedia set title = ?, status = ?, date_modified = ? where id = ?", array($title, $status, $date, $download_id));
            }
        }
        $success = "Changes has been updated successfully!";
    }

    if(isset($_POST['add_download'])){
        $title = $_POST['title'];
        $type = "image";
        $date = date("Y-m-d H:i:s");
        $cover = "account/img/pdf.png ";
        $url = "";

        if(isset($_FILES["cover"]) && $_FILES["cover"]['size']>0){

            define("UPLOAD_DIR", "../../account/img/cover_photo/");

            if($_FILES["cover"]['size']>5000000){
                $error = "File size cannot be more than 5mb!";
            }else{

                $cover = $_FILES["cover"];

                if ($cover["error"] !== UPLOAD_ERR_OK) {
                    echo "<p>An error occurred.</p>";
                    exit;
                }

                // ensure a safe filename
                $name = preg_replace("/[^A-Z0-9._-]/i", "_", $cover["name"]);

                // don't overwrite an existing file
                $i = 0;
                $parts = pathinfo($name);
                while (file_exists(UPLOAD_DIR . $name)) {
                    $i++;
                    $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
                }

                // preserve file from temporary directory
                $success = move_uploaded_file($cover["tmp_name"], UPLOAD_DIR . $name);

                if (!isset($success)) {
                    echo "<p>Unable to save file.</p>";
                    exit;
                }
                // set proper permissions on the new file
                chmod(UPLOAD_DIR . $name, 0644);

                $cover = substr((UPLOAD_DIR.$name), 6);

            }
        }

        if(isset($_FILES["url"]) && $_FILES["url"]['size']>0){

            define("UPLOAD_DIR2", "../../account/img/downloads/");

            if($_FILES["url"]['size']>5000000){
                $error = "File size cannot be more than 5mb!";
            }else{

                $url = $_FILES["url"];

                if ($url["error"] !== UPLOAD_ERR_OK) {
                    echo "<p>An error occurred.</p>";
                    exit;
                }

                // ensure a safe filename
                $name = preg_replace("/[^A-Z0-9._-]/i", "_", $url["name"]);

                // don't overwrite an existing file
                $i = 0;
                $parts = pathinfo($name);
                while (file_exists(UPLOAD_DIR2 . $name)) {
                    $i++;
                    $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
                }

                // preserve file from temporary directory
                $success = move_uploaded_file($url["tmp_name"], UPLOAD_DIR2 . $name);

                if (!isset($success)) {
                    echo "<p>Unable to save file.</p>";
                    exit;
                }
                // set proper permissions on the new file
                chmod(UPLOAD_DIR2 . $name, 0644);

                $url = substr((UPLOAD_DIR2.$name), 6);

            }
        }

        otherPDO("insert into multimedia (title, url, cover_photo, type, date_posted, date_modified, admin) values (?,?,?,?,?,?,?)", array($title, $url, $cover, $type, $date, $date, $admin_id));
        $success = "Download file has been added successfully!";
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
        <title>Manage Downloads | Blackloop Club</title>
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
                            <i class="fa fa-download"></i>
                        </div>
                        <div class="header-title">
                            <h1>Manage Downloads</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Manage Downloads</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">

                        <?php if(isset($error)){ ?>
                        <div class="col-xs-12 col-md-6">
                            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                        </div>
                        <?php }elseif(isset($success)){ ?>
                        <div class="col-xs-12 col-md-6">
                            <div class="alert alert-success text-center"><?php echo $success; ?></div>
                        </div>
                        <?php } ?>

                        <div class="col-xs-12" style="padding: 0px;">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="col-xs-12 col-md-6">
                                    <h2 class="text-center btn btn-default" style="width: 100%;margin-bottom: -5px;font-weight: bold;padding: 10px;cursor: text;">Add New Download</h2>
                                    <div class="panel panel-bd">
                                        
                                        <div class="panel-body">
                                            <form action="" method="post">
                                                
                                                <div class='form-group'>
                                                    <label for='exampleSelect1'>Choose Cover (1024px by 640px) 5mb Max</label>
                                                    <input type='file' name='cover' class='form-control'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='exampleSelect1'>Download Title</label>
                                                    <input type='text' required  name='title' placeholder='Enter download title' class='form-control'>
                                                </div>
                                                <div class='form-group'>
                                                    <label for='exampleSelect1'>Upload File (5mb Max)</label>
                                                    <input type='file' name='url' class='form-control'>
                                                </div>
                                                <div>
                                                    <button type="submit" name="add_download" class="btn btn-primary pull-right">Submit</button>
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
                                        <h4>Manage All Downloads </h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="user_table" style="word-wrap: break-word;table-layout: fixed;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 6%;">SN</th>
                                                    <th style="width: 9%;">Cover</th>
                                                    <th style="width: 25%;">Title</th>
                                                    <th style="width: 25%;">URL</th>
                                                    <th style="width: 10%;">Status</th>
                                                    <th style="width: 10%;">Date Posted</th>
                                                    <th style="width: 10%;">Last Modified</th>
                                                    <th style="width: 5%;">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo showDownloads(); ?>
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
