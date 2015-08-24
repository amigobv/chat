<?php
/**
 * Created by PhpStorm.
 * User: dro
 * Date: 29.07.2015
 * Time: 13:10
 */

include_once("views/partials/header.php");

$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : null;
?>
<div class="page-header">
    <h2>Join channel</h2>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Enter your username, password and choose the channel you want to join!
    </div>
    <div class="panel-body">
        <form class="form-horizontal" id = "loginForm" method="post" action="<?php echo Util::action('join');?>">
            <div class="form-group">
                <label for="inputName" class="col-sm-4 control-label">Username: </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="username" name="username" placeholder="try 'scm4'" value="<?php echo htmlentities($username)?>" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputPassword" class="col-sm-4 control-label">Password</label>
                <div class="col-sm-3">
                    <input type="password" class="form-control" id="inputPassword" name="password" placeholder="try 'scm4'" required>
                </div>
            </div>
            <div class = "form-group">
                <label for = "loginChannel" class = "col-sm-4 control-label">Choose channel</label>
                <div class = "col-sm-3">
                    <select class = "form-control" id = "loginChannel" name = "channel" required>
                        <?php
                        $channels = DataManager::getChannels();
                        foreach($channels as $channel) { ?>
                            <option><?php echo $channel->getName();?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-offset-4 col-sm-3">
                    <button type="submit" class="btn btn-default">Login</button>
                </div>
            </div> <!-- form-group -->
        </form>
    </div>  <!-- panel-body -->
</div> <!-- panel panel-default-->

<?php
include_once("views/partials/footer.php");
?>
