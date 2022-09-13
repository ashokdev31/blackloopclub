<?php 
    require_once "../functions_basic.php";
    require_once "validation.php";

    validateUser();

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $user_id = $row['id'];
    }

    
    if(isset($_POST['post'])){
        $message = $_POST['message'];
        $status = $_POST['status'];
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

        otherPDO("insert into tickets (message, file, parent, ticket_status, date_posted) values (?,?,?,?,?)", 
            array($message, $image, $_GET['x'], $status, $date));
        otherPDO("update tickets set read_status = '0', ticket_status = ? where id = ?", array($status, $_GET['x']));
        $success = "Ticket updated successfully";
    }

    if(isset($_GET['x'])){
        otherPDO("update tickets set read_status = '1' where id = ?", array($_GET['x']));
        $query = selectPDO("select * from tickets where id = ? and ticket_status = '2' order by date_posted asc", array($_GET['x']));
        if($query->rowCount()==0){
            header("Location: closed-tickets");
            exit;
        }
        $query = selectPDO("select * from tickets where parent = ? and ticket_status = '2' order by date_posted asc", array($_GET['x']));
        $string = "";$count=0;
        while($row=$query->fetch(PDO::FETCH_ASSOC)){
            if($count==0){
                $string .= "<div class='mailbox' style='padding:40px;'>
                                <div class='mailbox-header'>
                                    <div class='row'>
                                        <div class='col-xs-10'>
                                            <div class='inbox-avatar'>
                                                <div class='inbox-avatar-text hidden-xs hidden-sm'>
                                                    <div class='avatar-name'>{$row['type']} - {$row['subject']}</div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class='col-xs-2' style='margin-top: -17px;'>
                                            <div class='inbox-toolbar btn-toolbar'>
                                                <div class='btn-group'>
                                                    <a href='closed-tickets' class='btn btn-default'>
                                                        <span class='fa fa-times'></span> Close
                                                    </a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>";
                $count++;
            }
            $date_posted = date("D, j M Y g:i a", strtotime($row['date_posted']));
            if($row['admin']==null){$sender="Me";}else{$sender="Admin";}
            if($row['file']==null){
                $file="";
            }else{
                $file="<div class='col-xs-12 text-center' style='background:#555;padding:20px;width:290px;'>
                    <img src='../{$row['file']}' width='100%' /><br/>
                    <div class='btn btn-primary' data-toggle='modal' data-target='#enlarge{$row['id']}' style='margin-top:10px'><span class='fa fa-search-plus'></span> Enlarge Image</div>
                </div>
                <div class='modal fade' id='enlarge{$row['id']}' tabindex='-1' role='dialog'>
                    <div class='modal-dialog' role='document'>
                        <div class='modal-content'>
                            <div class='modal-header'>
                                <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                <h1 class='modal-title'>Uploaded File</h1>
                            </div>
                            <div class='modal-body'>
                                <img src='../{$row['file']}' width='100%' class='img-rounded' alt='deposit slip image'>
                            </div>
                            <div class='modal-footer'>
                                <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                            </div>
                        </div>
                    </div>
                </div>";
            }
            $string .= "
                        <div class='mailbox-body' style='border-bottom:1px dashed #555;padding-bottom:30px;'>
                            <div class='row m-0'>
                                <div class='col-xs-12 p-0 inbox-mail'>
                                    <div class='inbox-mail-details p-20' style='border-top:0px;'>
                                        <div class='inbox-avatar-text col-xs-12' style='padding:10px;margin-bottom: 20px;background:#555'>
                                            <div class='avatar-name' style='float:left'>
                                                <strong>{$sender}</strong>
                                            </div>
                                            <small style='float:left; margin-top:3px;margin-left:10px;'>
                                                ({$date_posted})
                                            </small>
                                        </div>
                                        {$row['message']}
                                        <br/>
                                        {$file}
                                    </div>
                                </div>
                            </div>
                        </div>";
        }
        
        $string .= "<div class='m-t-20 border-all p-20'>
                        <p class='p-b-20'>
                            click here to <a href='#' data-toggle='modal' data-target='#reply'>Re-open Ticket</a>
                        </p>
                    </div>
                </div>";
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
        <title>Closed Tickets | Blackloop Club</title>
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
                            <i class="fa fa-envelope"></i>
                        </div>
                        <div class="header-title">
                            <h1>Closed Tickets</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Closed Tickets</li>
                            </ol>
                        </div>
                    </div>
                    <?php if(isset($success)){ ?>
                        <div class="col-xs-12">
                            <div class="alert alert-success text-center"><?php echo $success; ?></div>
                        </div>
                    <?php } if(isset($_GET['x'])){ ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <?php echo $string; ?>
                        </div>
                    </div>
                    <?php } ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>All Closed Tickets</h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="earnings_table">
                                            <thead>
                                                <tr>
                                                    <th>SN</th>
                                                    <th>Subject</th>
                                                    <th>Type</th>
                                                    <th>Status</th>
                                                    <th>Date Posted</th>
                                                    <th>Last Modified</th>
                                                    <th>View</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo closedTickets($user_id); ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class='modal fade' id='reply' tabindex='-1' role='dialog'>
                        <div class='modal-dialog' role='document'>
                            <div class='modal-content'>
                                <form action="" method="post" enctype="multipart/form-data">
                                    <div class='modal-header'>
                                        <button type='button' class='close' data-dismiss='modal' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                                        <h1 class='modal-title'>Update Ticket</h1>
                                    </div>
                                    <div class='modal-body'>
                                        <!-- summernote -->
                                        <textarea required="" id="summernote" name="message"></textarea>
                                        <hr/>
                                        <div class="form-group">
                                            <input type="file" id="exampleInputFile" name="image" aria-describedby="fileHelp">
                                        </div>
                                        <hr/>
                                        <div class='form-group'>
                                            <label for='exampleSelect1'>Change Status</label>
                                            <select name="status" class="form-control">
                                                <optgroup>
                                                    <option value="1">Active</option>
                                                </optgroup>
                                            </select>
                                        </div>
                                        <hr/>
                                        <div class="hidden-xs hidden-sm btn-group">
                                            <button type='button' class='btn btn-danger' data-dismiss='modal'>Close</button>
                                        </div>
                                        <div class="btn-group pull-right">
                                            <button type="submit" name="post" class="btn btn-success">SEND</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php require_once "scripts.php"; ?>
    </body>
</html>
