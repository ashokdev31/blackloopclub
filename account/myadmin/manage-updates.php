<?php 
    require_once "../../functions_basic.php";
    require_once "validation.php"; 

    validateAdmin(5);

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $admin_id = $row['id'];
    }

    if(isset($_POST['update_news'])){
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $status = $_POST['status'];
        $date = date("Y-m-d H:i:s");
        $update_id = $_POST['update_id'];
        $tag = array();
        if(isset($_POST['tags'])){
            $tagging = $_POST['tags'];
            foreach ($tagging as $key => $value) {
                $tag[] = $value;
            }
        }
        
        $tags = implode(",", $tag);
        if($status=="Delete"){
            otherPDO("delete from news_updates where id = ?", array($update_id));
        }else{

            if(isset($_FILES["banner"]) && $_FILES["banner"]['size']>0){

                define("UPLOAD_DIR", "../../account/img/update_banners/");

                if($_FILES["banner"]['size']>5000000){
                    $error = "File size cannot be more than 5mb!";
                }else{

                    $banner = $_FILES["banner"];

                    if ($banner["error"] !== UPLOAD_ERR_OK) {
                        echo "<p>An error occurred.</p>";
                        exit;
                    }

                    // ensure a safe filename
                    $name = preg_replace("/[^A-Z0-9._-]/i", "_", $banner["name"]);

                    // don't overwrite an existing file
                    $i = 0;
                    $parts = pathinfo($name);
                    while (file_exists(UPLOAD_DIR . $name)) {
                        $i++;
                        $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
                    }

                    // preserve file from temporary directory
                    $success = move_uploaded_file($banner["tmp_name"], UPLOAD_DIR . $name);

                    if (!isset($success)) {
                        echo "<p>Unable to save file.</p>";
                        exit;
                    }
                    // set proper permissions on the new file
                    chmod(UPLOAD_DIR . $name, 0644);

                    $banner = substr((UPLOAD_DIR.$name), 6);

                    $query = selectPDO("select * from news_updates where id = ?", array($update_id));
                    while($row=$query->fetch(PDO::FETCH_ASSOC)){
                        if($row['banner']!=NULL){
                            if(!unlink("../../".$row['banner'])){
                                echo "error deleting file";
                            }
                        }
                    }

                    otherPDO("update news_updates set banner = ? where id = ?", array($banner, $update_id));

                }
            }

            
            if(!isset($error)){
                otherPDO("update news_updates set subject = ?, status = ?, tags = ?, message=?, last_modified = ? where id = ?", array($subject, $status, $tags, $message, $date, $update_id));
            }
        }
        $success = "Changes has been updated successfully!";
    }

    if(isset($_POST['add_update'])){
        $subject = $_POST['subject'];
        $message = $_POST['message'];
        $date = date("Y-m-d H:i:s");
        $banner = "";
        $tag = array(); $mail_tag = array();
        if(isset($_POST['tags'])){
            $tagging = $_POST['tags'];
            foreach ($tagging as $key => $value) {
                $tag[] = $value;
                $query2 = selectPDO("select * from news_tags where id = ?", array($value));
                while($row2=$query2->fetch(PDO::FETCH_ASSOC)){
                    $mail_tag[] = strtoupper($row2['name']);
                }
            }
        }
        
        $tags = implode(",", $tag);
        $m_tags = implode(", ", $mail_tag);

        if(isset($_FILES["banner"]) && $_FILES["banner"]['size']>0){

            define("UPLOAD_DIR", "../../account/img/update_banners/");

            if($_FILES["banner"]['size']>5000000){
                $error = "File size cannot be more than 5mb!";
            }else{

                $banner = $_FILES["banner"];

                if ($banner["error"] !== UPLOAD_ERR_OK) {
                    echo "<p>An error occurred.</p>";
                    exit;
                }

                // ensure a safe filename
                $name = preg_replace("/[^A-Z0-9._-]/i", "_", $banner["name"]);

                // don't overwrite an existing file
                $i = 0;
                $parts = pathinfo($name);
                while (file_exists(UPLOAD_DIR . $name)) {
                    $i++;
                    $name = $parts["filename"] . "-" . $i . "." . $parts["extension"];
                }

                // preserve file from temporary directory
                $success = move_uploaded_file($banner["tmp_name"], UPLOAD_DIR . $name);

                if (!isset($success)) {
                    echo "<p>Unable to save file.</p>";
                    exit;
                }
                // set proper permissions on the new file
                chmod(UPLOAD_DIR . $name, 0644);

                $banner = substr((UPLOAD_DIR.$name), 6);
            }
        }

        
        otherPDO("insert into news_updates (subject, banner, tags, message, date_posted, last_modified, admin) values (?,?,?,?,?,?,?)", array($subject, $banner, $tags, $message, $date, $date, $admin_id));

        // send mail
        // $emails = array();
        // $query = selectPDO("select * from users where email_promo = '1' and user_status = '1'", array());
        // while($row=$query->fetch(PDO::FETCH_ASSOC)){
        //     $emails[] = $row['email'];
        // }

        // $query = selectPDO("select * from email_subscribers", array());
        // while($row=$query->fetch(PDO::FETCH_ASSOC)){
        //     $emails[] = $row['email'];
        // }

        // $emails = array_unique($emails, SORT_REGULAR);
        // $total = count($emails);

        // if($banner!=""){$banner="<img src='../../{$banner}' width='100%' style='margin-bottom:30px;' />";}

        // for($i=0; $i<$total; $i++){
        //     $to = $emails[$i];
        //     $message = "{$banner}<h1 class='text-center;text-decoration:underline;'>{$subject}</h1><br/><br/>{$message}<br/><br/><b>TAGS:</b> {$m_tags}";
        //     $message = wordwrap($message, 70, "\r\n");
            // $headers = 'Content-type: text/html; charset=iso-8859-1; charset=utf-8'."\r\n".
            //             'From: Blackloop Club <no-reply@blackloopclub.com>' . "\r\n" .
            //             'Reply-To: contact@blackloopclub.com' . "\r\n" .
            //             'X-Mailer: PHP/' . phpversion();

        //     mail($to, $subject, $message, $headers);
        // }

        

        $success = "News update has been added successfully!";
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
        <title>Manage News Updates | Blackloop Club</title>
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
                            <i class="fa fa-rss-square"></i>
                        </div>
                        <div class="header-title">
                            <h1>Manage News Updates</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Manage News Updates</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">

                        <?php if(isset($error)){ ?>
                        <div class="col-xs-12">
                            <div class="alert alert-danger text-center"><?php echo $error; ?></div>
                        </div>
                        <?php }elseif(isset($success)){ ?>
                        <div class="col-xs-12">
                            <div class="alert alert-success text-center"><?php echo $success; ?></div>
                        </div>
                        <?php } ?>

                        <div class="col-xs-12" style="padding: 0px;">
                            <form action="" method="post" enctype="multipart/form-data">
                                <div class="col-xs-12">
                                    <h2 class="text-center btn btn-default" style="width: 100%;margin-bottom: -5px;font-weight: bold;padding: 10px;cursor: text;">Add News Item</h2>
                                    <div class="panel panel-bd">
                                        
                                        <div class="panel-body">
                                            <form action="" method="post" enctype="multipart/form-data">
                                                
                                                <div class='form-group'>
                                                <label for='exampleSelect1'>Choose Banner (1400px by 600px) 5mb Max</label>
                                                <input type='file' name='banner' class='form-control'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Subject</label>
                                                <input type='text' required name='subject' placeholder='Enter subject for news item' class='form-control'>
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>News Tags</label>
                                                <?php echo getTags(); ?>
                                            </div>
                                            <div class='form-group'>
                                                <label for='exampleSelect1'>Message</label>
                                                <textarea required='' id='summernote' name='message'></textarea>
                                            </div>
                                            <div>
                                                <button type="submit" name="add_update" class="btn btn-primary pull-right">Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                </div> 
                            </form>
                        </div>
                        
                        <div class="col-sm-12">
                            <div class="panel panel-bd lobidrag">
                                <div class="panel-heading">
                                    <div class="panel-title">
                                        <h4>Manage All Updates </h4>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    
                                    <div class="table-responsive">
                                        <table class="table table-bordered table-striped table-hover" id="user_table" style="word-wrap: break-word;table-layout: fixed;">
                                            <thead>
                                                <tr>
                                                    <th style="width: 7%;">SN</th>
                                                    <th style="width: 11%;">Banner</th>
                                                    <th style="width: 25%;">Subject</th>
                                                    <th style="width: 19%;">Tags</th>
                                                    <th style="width: 10%;">Status</th>
                                                    <th style="width: 11%;">Date Posted</th>
                                                    <th style="width: 11%;">Last Modified</th>
                                                    <th style="width: 6%;">&nbsp;</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php echo showUpdates(); ?>
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
        <script type="text/javascript">
            $(document).ready(function () {

                "use strict"; // Start of use strict

                <?php 
                $query = selectPDO("select n.id as id from news_updates n inner join users u on n.admin = u.id order by n.date_posted desc", array());
                $sn=0;
                while($row=$query->fetch(PDO::FETCH_ASSOC)){ 
                ?>
                //summernote
                $('#summernote'+<?php echo $row['id']; ?>).summernote({
                    height: 200, // set editor height
                    minHeight: null, // set minimum height of editor
                    maxHeight: null, // set maximum height of editor
                    // focus: true,                  // set focus to editable area after initializing summernote
                    toolbar: [
                        [ 'style', [ 'style' ] ],
                        [ 'font', [ 'bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear'] ],
                        [ 'fontname', [ 'fontname' ] ],
                        [ 'fontsize', [ 'fontsize' ] ],
                        [ 'color', [ 'color' ] ],
                        [ 'para', [ 'ol', 'ul', 'paragraph', 'height' ] ],
                        [ 'table', [ 'table' ] ],
                        [ 'insert', [ 'link'] ],
                        [ 'view', [ 'undo', 'redo', 'fullscreen', 'codeview', 'help' ] ]
                    ]
                });

                <?php } ?>
            });
        </script>
    </body>
</html>
