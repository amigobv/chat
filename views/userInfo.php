<?php
/**
 * Created by PhpStorm.
 * User: dro
 * Date: 29.07.2015
 * Time: 13:10
 */

include_once("views/partials/header.php");
?>
<div class="page-header">
    <h2><?php echo AuthenticationManager::getAuthenticatedUser()->getUsername(); ?></h2>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Registration data.
    </div>
    <div class="panel-body">
        <ul class="list-group">
            <li class="list-group-item">
                First name: <?php echo AuthenticationManager::getAuthenticatedUser()->getFirstName(); ?>
            </li>
            <li class="list-group-item">
                Last name: <?php echo AuthenticationManager::getAuthenticatedUser()->getLastName(); ?>
            </li>
            <li class="list-group-item">
                Channels:
                <?php
                    $user = AuthenticationManager::getAuthenticatedUser();
                    $channels = DataManager::getChannelsByUserId($user->getID());
                    $str = array();
                    foreach($channels as $channel) {
                        $str[] = $channel->getName();
                    }
                    $strSeparated = implode(", ", $str);
                    echo $strSeparated;
                ?>
            </li>
        </ul>
    </div>  <!-- panel-body -->
</div> <!-- panel panel-default-->

<?php
include_once("views/partials/footer.php");
?>
