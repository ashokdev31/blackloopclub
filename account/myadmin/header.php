<?php 

    $transferRequests = transferRequests();
    $tickets = newTicketsAdmin();
    $pending = totalPending();

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
            <?php if(validateSideAdmin(3)){ ?>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-flag" title="Transfer Requests"></i>
                    <?php if($transferRequests[1]>0){ ?><span class="label label-success"><?php echo $transferRequests[1]; ?></span><?php } ?>
                </a>
                <ul class="dropdown-menu dropdown-messages" style="margin-left: 0px;">
                    <li class="rad-dropmenu-header"><a href="#">Transfer Requests</a></li>
                    <?php echo $transferRequests[0]; ?>
                </ul>
            </li>
            <?php } if(validateSideAdmin(4)){ ?>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-comments" title="Chat"></i>
                    <?php if($tickets[1]>0){ ?><span class="label label-danger"><?php echo $tickets[1]; ?></span><?php } ?>
                </a>
                <ul class="dropdown-menu dropdown-messages">
                    <li class="rad-dropmenu-header"><a href="#">Tickets Updates</a></li>
                    <?php echo $tickets[0]; ?>
                    <li class="rad-dropmenu-footer"><a href="active-tickets">View Tickets</a></li>
                </ul>
            </li>
            <?php } if(validateSideAdmin(2)){ ?>
            <li class="dropdown">
                <a class="dropdown-toggle" href="pending-users">
                    <i class="fa fa-user-plus" title="New Registrations"></i>
                    <?php if($pending>0){ ?><span class="label label-warning"><?php echo $pending; ?></span><?php } ?>
                </a>
            </li>
            <?php } ?>
            <li class="log_out">
                <a href="#" onclick="logout();">
                    <i class="fa fa-power-off" title="Logout"></i>
                </a>
            </li>
        </ul>
    </div>
</nav>