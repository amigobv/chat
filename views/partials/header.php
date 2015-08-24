<?php
$user = AuthenticationManager::getAuthenticatedUser();
if(isset($_GET['errors']))
{
    $errors = unserialize(urldecode($_GET['errors']));
}
?>
<!DOCTYPE html>
<html>
	<head>
		<meta http-equiv="Content-Type" content="test/html">
		<meta charset="UTF-8">
		
		<title>Chatroom</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
		<link href="assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="assets/bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
		<link href="assets/main.css" rel="stylesheet">
        <link href="assets/customize.css" rel="stylesheet">
	</head>
	<body>

    <div class="navbar navbar-inverse navbar-fixed-top">
        <div class="container-fluid navbar-custom">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header navbar-custom">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php?view=welcome"><b>Slack light</b></a>
            </div>


            <div class="navbar-collapse collapse navbar-custom" id="bs-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right ">
                    <li>
                        <a href="index.php?view=join"><span class="glyphicon glyphicon-comment"></span> Join channel</a>
                    </li>
                    <li>
                        <?php if ($user == null): ?>
                            <a href="index.php?view=registration"><span class="glyphicon glyphicon-user"></span> Sign Up</a>
                        <?php else: ?>
                            <a href="index.php?view=user">
                                <span class="glyphicon glyphicon-user"></span>
                                <?php echo Util::escape($user->getUserName()); ?>
                            </a>
                        <?php endif; ?>
                    </li>
                    <li>
                        <?php if ($user == null): ?>
                            <a href="index.php?view=welcome"><span class="glyphicon glyphicon-log-in"></span> Login</a>
                        <?php else: ?>
                            <a href="index.php?view=logout"><span class="glyphicon glyphicon-log-out"></span> Logout</a>
                        <?php endif; ?>
                    </li>
                </ul>

            </div> <!--/.nav-collapse -->
        </div>
    </div>

    <div class = "container">

