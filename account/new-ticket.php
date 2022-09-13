<?php 
    require_once "../functions_basic.php";
    include "../password_compat-master/lib/password.php";
    require_once "validation.php";

    validateUser();

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $user_id = $row['id'];
    }

    if(isset($_POST['post'])){
        $type = $_POST['type'];
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $date = date("Y-m-d H:i:s");
        $image = "";

        if(isset($_FILES["image"]) && $_FILES["image"]['size']>0){

            define("UPLOAD_DIR", "../account/ticket_files/");

            if($_FILES["image"]['size']>5000000){
                $error = "File size cannot be more than 5mb!";
            }else{

                $image = $_FILES["image"];

                if ($image["error"] !== UPLOAD_ERR_OK) {
                    echo "<p>An error occurred.</p>";
                    exit;
                }

                // ensure a safe filename
                $name = preg_replace("/[^A-Z0-9._-]/i", "_", $image["name"]);

                // don't overwrite an existing file
                $i = 0;
                $parts = pathinfo($name);
                while (file_exists(UPLOAD_DIR . $name)) {
                    $i++;
                    $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
                }

                // preserve file from temporary directory
                $success = move_uploaded_file($image["tmp_name"], UPLOAD_DIR . $name);

                if (!isset($success)) {
                    echo "<p>Unable to save file.</p>";
                    exit;
                }
                // set proper permissions on the new file
                chmod(UPLOAD_DIR . $name, 0644);

                $image = substr((UPLOAD_DIR.$name), 3);

            }
        }

        otherPDO("insert into tickets (user_id, subject, message, type, file, date_posted) values (?,?,?,?,?,?)", array($user_id, $subject, $message, $type, $image, $date));
        $query = selectPDO("select * from tickets where date_posted = ? and user_id = ? and subject = ?", array($date, $user_id, $subject));
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            otherPDO("update tickets set parent = ? where id = ?", array($row['id'], $row['id']));
        }
        $_SESSION['ticket_success'] = 1;
        header("Location: ticket-confirmation");
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
        <title>Post New Ticket | Blackloop Club</title>
        <?php require_once "styles.php"; ?>

        <style type="text/css">
            .note-group-select-from-files {
                /*display: none;*/
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
                         <?php require_once "news-flash.php"; ?>
                        <div class="header-icon">
                            <i class="fa fa-envelope-open"></i>
                        </div>
                        <div class="header-title">
                            <h1>Post New Ticket</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Post New Ticket</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mailbox">
                                <div class="mailbox-body">
                                    <div class="row m-0">
                                        <form action="" method="post" enctype="multipart/form-data">
                                        <div class="col-xs-12 col-sm-12 p-0 inbox-mail p-20">
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-2 col-form-label text-right">Type :</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <select required="" name="type" id="type" class="form-control">
                                                        <option disabled="" selected="">Select Option</option>
                                                        <option>Technical</option>
                                                        <option>Billing</option>
                                                        <option>Withdrawals</option>
                                                        <option>Deposits</option>
                                                        <option>Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-md-2 col-form-label text-right">Subject :</label>
                                                <div class="col-sm-9 col-md-10">
                                                    <input required="" class="form-control" name="subject" type="text" id="subjejct">
                                                </div>
                                            </div>
                                            <!-- summernote -->
                                            <textarea required="" id="summernote" name="message"></textarea>
                                            <hr/>
                                            <div class="form-group">
                                                <input type="file" id="exampleInputFile" name="image" aria-describedby="fileHelp">
                                            </div>
                                            <hr/>
                                            <div class="hidden-xs hidden-sm btn-group">
                                                <a href="index"><button type="button" class="text-center btn btn-default">DISCARD</button></a>
                                            </div>
                                            <div class="btn-group pull-right">
                                                <button type="submit" onclick="return checkType();" name="post" class="btn btn-success">SEND</button>
                                            </div>
                                        </div>
                                        </form>
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
