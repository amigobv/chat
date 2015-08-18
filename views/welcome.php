<?php
include_once("views/partials/header.php");
?>

<?php if (AuthenticationManager::isAuthenticated()) : ?>
    <div class = "chatContainer">
        <div class = "col-md-8">
            <div class = "panel panel-primary">
                <div class = "panel-heading"><h4>Channel</h4> #name</div>
                <div class = "panel-body panel-height">
                    <ul class = "media-list">
                        <li class = "media">
                            <div class = "media-body">
                                <a class = "pull-left" href = "#"><span class = "glyphicon glyphicon-user"></span></a>
                                <div class = "media-body">
                                    TODO: CHAT
                                    <br>
                                    <small class = "text-muted">Username | Date</small>
                                    <hr>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class = "panel-footer">
                    <form class = "chat" action = "">
                        <div class = "form-group">
                            <div class = "input-group col-sm-5">
                                <input type = "text" class = "form-control" placeholder = "Title">
                            </div>
                        </div>

                        <div class = "form-group">
                            <div class = "input-group ">
                                <input type = "text" class = "form-control col-sm-9" placeholder = "Enter message">
                                <span class = "input-group-btn">
                                    <button class = "btn btn-info" type = "button">SEND</button>
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
                        $users = DataManager::getUsers();
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
    <p>Please Login</p>
<?php endif; ?>

<?php
include_once("views/partials/footer.php");
?>
