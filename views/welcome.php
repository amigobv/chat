<?php
include_once("views/partials/header.php");

$userName = isset($_REQUEST['userName']) ? $_REQUEST['userName'] : null;
?>
	<div class="page-header">
		<h2>Login</h2>
	</div>
	
	<div class="pannel panel-default">
		<div class="panel-heading">
			Please login in order to use the chat! 
		</div>
		<div class="panel-body">
			<form class="form-horizontal" method="post" action="<?php echo Util::action('login', array('view' => $view));?>">
				<div class="form-group">
					<label for="inputName" class="col-sm-4 control-label">Username: </label>
					<div class="col-sm-3">
						<input type="text" class="form-control" id="userName" name="userName" placeholder="try 'scm4'" value="<?php echo htmlentities($userName)?>" required>
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
				</div>
			</form>	
		</div>
	</div>

<?php
include_once("views/partials/footer.php");
?>
