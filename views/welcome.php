<?php
include_once("views/partials/header.php");
$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : null;
?>

<?php if (AuthenticationManager::isAuthenticated()) : ?>
    <div class = "chatContainer">
        <div class = "col-md-8">
            <div class = "panel panel-primary">
                <div class = "panel-heading">
                    <h4><?php echo (isset($_SESSION['channel']) && $_SESSION['channel']) ? $_SESSION['channel'] : "Default" ?></h4></div>
                <div class = "panel-body panel-height">
                    <ul class = "media-list">
                        <?php
                        $channel = DataManager::getChannelByName($_SESSION['channel']);
                        $messages = DataManager::getPostsByChannel($channel->getID());

                        foreach($messages as $message) {
                        ?>
                        <li class = "media">
                            <div class = "media-body <?php echo ($message->getStatus() == Status::UNREAD) ? 'mark' : '' ; ?> ">
                                <p class="lead"><?php echo $message->getTitle(); ?><p>
                                <?php echo $message->getContent(); ?>
                                <br>
                                <div>
                                    <small class = "text-muted">
                                        <a class = "pull-left" href = "#">
                                            <span class = "glyphicon glyphicon-user">
                                                <?php
                                                $user = DataManager::getUserById($message->getAuthor());
                                                echo $user->getUsername();
                                                ?>
                                            </span>
                                        </a>

                                        <?php if($message->getProminence()): ?>
                                            <a class = "glyphicon glyphicon-star custom-star" href = '#'></a>
                                        <?php else: ?>
                                            <a href = '#'><span class = "glyphicon glyphicon-star-empty custom-star"></span></a>
                                        <?php endif; ?>
                                    </small>
                                </div>
                            </div>
                            <hr>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
                <div class = "panel-footer">
                    <form class = "chat" method = "post" action = "<?php echo Util::action('postMessage');?>">
                        <div class = "form-group">
                            <div class = "input-group col-sm-5">
                                <input type = "text" class = "form-control" name = "title" placeholder = "Title">
                            </div>
                        </div>

                        <div class = "form-group">
                            <div class = "input-group ">
                                <input type = "text" class = "form-control col-sm-9" name = "content" placeholder = "Enter message">
                                <span class = "input-group-btn">
                                    <button class = "btn btn-info" type = "submit">SEND</button>
                                </span>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class = "col-md-4">
            <div class = "panel panel-primary">
                <div class = "panel-heading">Users</div>
                <div class = "panel-body">
                    <?php
                        $channel = DataManager::getChannelByName($_SESSION['channel']);
                        $users = DataManager::getUsersByChannelId($channel->getID());
                        foreach($users as $user) {
                            ?>
                            <ul class = "media-list">
                                <li class = "media">
                                    <div class = "media-body">
                                        <a class = "glyphicon glyphicon-user" href = "#"></a> <?php echo $user->getUsername()?>
                                    </div>
                                </li>
                            </ul>
                        <?php } ?>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="page-header">
        <h2>Login</h2>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">
            Please login in order to use the chat!
        </div>
        <div class="panel-body">
            <form class="form-horizontal" id = "loginForm" method="post" action="<?php echo Util::action('login');?>">
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
<?php endif; ?>

<?php
include_once("views/partials/footer.php");
?>
