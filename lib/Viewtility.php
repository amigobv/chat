<?php
/**
 * Created by PhpStorm.
 * User: dro
 * Date: 01.09.2015
 * Time: 20:38
 */

class Viewtility extends BaseObject {
    public static function viewMessage($message, $status) {
        ?>
            <li class = 'media'>
                <div class = 'media-body <?php echo ($status == Status::UNREAD) ? 'mark' : ' ' ; ?> '>
                    <p class='lead'><?php echo $message->getTitle(); ?><p>
                        <?php echo $message->getContent(); ?>
                        <br>
                    <div>
                        <small class = 'text-muted'>
                            <a class = 'pull-left' href = '#'>
                                            <span class = 'glyphicon glyphicon-user'>
                                                <?php
                                                $author = DataManager::getUserById($message->getAuthor());
                                                echo $author->getUsername();
                                                ?>
                                            </span>
                            </a>

                            <?php
                            $id = $message->getID();
                            switch($status) {
                                case Status::UNREAD:
                                    ?>
                                    <a href = '#' id = "<?php echo $id; ?>" class = 'glyphicon glyphicon-star-empty custom-star' onclick='setPrior(<?php echo $id; ?>)'></a>
                                    <a href = '#' id = "<?php echo $id; ?>" class = 'glyphicon glyphicon-remove customRemoveActive' onclick='removeMessage(<?php echo $id; ?>)'></a>
                                    <?php
                                    break;
                                case Status::READ:
                                    ?>
                                    <a href = '#' id = '<?php echo $id; ?>' class = 'glyphicon glyphicon-star-empty custom-star' onclick='setPrior(<?php echo $id; ?>)'></a>
                                    <a href = '#' id = "<?php echo $id; ?>" class = 'glyphicon glyphicon-remove customRemoveActive' onclick='removeMessage(<?php echo $id; ?>)'></a>
                                    <?php
                                    break;
                                case Status::ANSWERED:
                                    ?>
                                    <a href = '#' id = '<?php echo $id; ?>' class = 'glyphicon glyphicon-star-empty custom-star' onclick='setPrior(<?php echo $id; ?>)'></a>
                                    <?php
                                    break;
                                case Status::PRIOR:
                                    ?>
                                    <a href = '#' id = '<?php echo $id; ?>' class = 'glyphicon glyphicon-star custom-star' onclick='resetPrior(<?php echo $id; ?>)'></a>
                                    <?php
                                    break;
                                default:
                                case Status::DELETED:
                                    break;
                            }
                            ?>
                        </small>
                    </div>
                </div>
                <hr>
            </li>
    <?php
    }
}
?>