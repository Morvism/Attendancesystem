<!DOCTYPE html>
<?php
session_start();
if (isset($_SESSION['login_id'])) {
	header('location: home.php');
}
?>
<html lang="eng">

<head>
	<title>سیستم حضور غیاب</title>
	<?php include 'header.php' ?>
	<link rel="stylesheet" href="../assets/css/login-ad.scss">
</head>

<body>
	<div id="main" class="bg-info">
		<div class="container">
			<div class="col-lg-12">
				<div class="row">
					<div class="col-md-6 offset-md-3 ">
						<div class="card login-field">
							<div class="card-header">
								<h4>ورود</h4>
							</div>
							<div class="card-body">
								<form id="login-frm">
									<div id="" class="form-group">
										<label class="control-label">نام کاربری:</label>
										<input type="text" name="username" class="form-control" required />
									</div>
									<div id="" class="form-group">
										<label class="control-label">پسورد:</label>
										<input type="password" maxlength="20" name="password" class="form-control" required />
									</div>
									<br />
									<button type="submit" class="btn btn-primary btn-block">ورود <i class="fa fa-arrow-right"></i></button>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="../assets/js/jquery.js"></script>
<script src="../assets/js/bootstrap.js"></script>

<script>
	$(document).ready(function() {
		$('#login-frm').submit(function(e) {
			e.preventDefault();
			$.ajax({
				url: 'login.php',
				method: 'POST',
				data: $(this).serialize(),
				error: err => {
					console.log(err)
				},
				success: function(resp) {
					if (resp == true) {
						location.replace('home.php')
					}
				}
			})
		})
	})
</script>

</html>