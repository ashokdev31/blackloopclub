<?php 

    $query = selectPDO("select * from users where email_slug = ?", array($_SESSION['blackloop_slug'][0]));
    while($row=$query->fetch(PDO::FETCH_ASSOC)){
        $user_id = $row['id'];
    }

    $notice = notifications($user_id);
    $tickets = newTickets($user_id);

?>
<nav class="navbar navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
            <span class="sr-only">Toggle navigation</span>
            <i class="fa fa-th"></i>
        </button>
        <a class="navbar-brand" href="index">
            <img class="main-logo" src="<?php echo $GLOBALS['path']; ?>jpg/blackloop2.jpg" width="190px" alt="">
        </a>
    </div>
    <div class="nav-container">
        <ul class="nav navbar-nav hidden-xs">
            <li><a id="fullscreen" href="#"><i class="fa fa-expand" title="Full Screen"></i> </a></li>
            <li><a href="#" class="btn-buy hidden-xs hidden-sm hidden-md">Hello <?php echo $_SESSION['blackloop_slug'][2]; ?>!</a></li>
        </ul>
        <ul class="nav navbar-top-links navbar-right">
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-flag" title="Notifications"></i>
                    <?php if($notice[1]>0){ ?><span class="label label-success"><?php echo $notice[1]; ?></span><?php } ?>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li class="rad-dropmenu-header"><a href="#">Your Notifications</a></li>
                    <?php echo $notice[0]; ?>
                    <li class="rad-dropmenu-footer"><a href="notifications">See all notifications</a></li>
                </ul>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-comments" title="Chat"></i>
                    <?php if($tickets[1]>0){ ?><span class="label label-danger"><?php echo $tickets[1]; ?></span><?php } ?>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li class="rad-dropmenu-header"><a href="#">Tickets Updates</a></li>
                    <?php echo $tickets[0]; ?>
                </ul>
            </li>
            
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user" title="User"></i>
                </a>
                <ul class="dropdown-menu dropdown-alerts" style="margin-right: 0px;">
                    <li><a href="profile"><i class="fa fa-edit"></i>&nbsp; Edit Profile</a></li>
                    <li><a href="profile"><i class="fa fa-key"></i>&nbsp;Change Password</a></li>
                    <li><a href="profile"><i class="fa fa-university"></i>&nbsp; Manage Bank Account</a></li>
                    <li><a href="profile"><i class="fa fa-credit-card"></i>&nbsp; Payments</a></li>
                    <li><a href="#"><i class="fa fa-long-arrow-alt-up"></i>&nbsp; Upgrade Membership</a></li>
                </ul>
            </li>
            <li class="log_out">
                <a href="#" onclick="logout();">
                    <i class="fa fa-power-off" title="Logout"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>