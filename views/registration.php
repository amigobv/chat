<?php
/**
 * Created by PhpStorm.
 * User: dro
 * Date: 31.07.2015
 * Time: 13:54
 */

include_once("views/partials/header.php");

$username = isset($_REQUEST['username']) ? $_REQUEST['username'] : null;
?>
<div class="page-header">
    <h2>Registration</h2>
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        Please complete the registration form in order to communicate with other users!
    </div>
    <div class="panel-body">
        <form class="form-horizontal" method="post" action="<?php echo Util::action('registrate');?>">
            <div class="form-group">
                <label for="inputName" class="col-sm-4 control-label">First name: </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="firstName" name="firstName" placeholder="Sam" required>
                </div>
            </div>
            <div class="form-group">
                <label for="inputName" class="col-sm-4 control-label">Last name: </label>
                <div class="col-sm-3">
                    <input type="text" class="form-control" id="lastName" name="lastName" placeholder="Sample" required>
                </div>
            </div>
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
