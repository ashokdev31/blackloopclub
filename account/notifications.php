<?php 
    require_once "../functions_basic.php";
    require_once "validation.php";

    validateUser();

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $user_id = $row['id'];
    }
    
    $perpage = 1;
    $notifications = getNotifications($user_id, 0, $perpage);
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="">
        <meta name="author" content="">
        <title>Notifications | Blackloop Club</title>
        <?php require_once "styles.php"; ?>
        <style type="text/css">
            #loadMore {
                text-align: center;
            }

            .load-more{
                background: #33383e;
                text-align: center;
                padding: 12px;
                border-radius: 6px;
                border:1px solid #555;
                margin-bottom: 50px;
                color: green;
                margin-top: 60px;
            }

            .load-more:hover {
                background: #2c3136;
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
                            <i class="fa fa-flag"></i>
                        </div>
                        <div class="header-title">
                            <h1>All Notifications</h1>
                            <!-- <small>Very detailed & featured admin.</small> -->
                            <ol class="breadcrumb" style="margin-top: -6px;">
                                <li><a href="index"><i class="pe-7s-home"></i> Home</a></li>
                                <li class="active">Notifications</li>
                            </ol>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="mailbox panel panel-bd">
                                <form action="" method="post">
                                <div class="mailbox-header">
                                    <div class="row">
                                        <div class="col-xs-4">
                                            &nbsp;
                                        </div>
                                        <div class="col-xs-8" style="margin-bottom: 20px;">

                                            <div class="inbox-toolbar btn-toolbar">
                                                <div class="btn-group  m-b-5">
                                                    <button type="button" class="btn btn-default">Mark</button>
                                                    <button type="button" data-toggle="dropdown" class="btn dropdown-toggle btn-default">
                                                        <span class="caret"></span>
                                                        <span class="sr-only">default</span>
                                                    </button>
                                                    <ul role="menu" class="dropdown-menu">
                                                        <li><a href="#" id="mark_all">Read</a>
                                                        </li>
                                                        <li><a href="#" id="unMark_all">Unread</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="hidden-xs hidden-sm btn-group">
                                                    <!-- <button type="button" class="text-center btn btn-default" title="Mark as read">Mark As Read / Unread</button> -->
                                                    <button onclick="return confirm('Confirm delete?')" id="delete_all" type="button" class="btn btn-danger"><span class="fa fa-trash"></span></button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="mailbox-body panel-body">
                                    <div class="row m-0">
                                        
                                        <div class="col-xs-12 p-0 inbox-mail">
                                            <div class="mailbox-content">
                                                <?php echo $notifications[0]; ?>
                                            </div>

                                            <!-- <div class="col-xs-12">
                                                <div id="loadMore">
                                                    <a href="#" onclick="this.blur();event.preventDefault();" class="load-more">
                                                        <i class="fa fa-spinner"></i> Load More Results</a>
                                                </div>
                                            </div> -->

                                            <button type="button" id="notify_button" style="display: none;"></button>
                                            <input type="hidden" id="row" value="0">
                                            <input type="hidden" id="all" value="<?php if(isset( $notifications[1])){echo $notifications[1]; } ?>">
                                            <input type="hidden" id="perpage" value="<?php echo $perpage; ?>" >
                                            <input type="hidden" id="user_id" value="<?php echo $user_id; ?>">
                                            
                                        </div>

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
