<?php
include_once("views/partials/header.php");
?>

<?php if (AuthenticationManager::isAuthenticated()) : ?>
    <textarea id="messageInput" autocorrect="off" autocomplete="off" spellcheck="true"></textarea>
<?php else: ?>
    <p>Please Login</p>
<?php endif; ?>

<?php
include_once("views/partials/footer.php");
?>
