<?php if (isset($errors) && is_array($errors)): ?>
    <div class="errors alert alert-danger">
        <ul>
            <?php foreach ($errors as $errMsg): ?>
                <li><?php echo(Util::escape($errMsg)); ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
<?php endif; ?>

</div>  <!--container -->

<script src="assets/jquery-1.11.3.min.js"></script>
<script src="assets/bootstrap/js/bootstrap.min.js"></script>
<!-- <script src="assets/loginValidation.js"></script> -->

</body>
</html>