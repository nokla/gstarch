<!DOCTYPE html>
<html>
<head>
	<title>PSD-Module Security DB</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="css/Litera.min.css">
	<!-- Bootstrap JS and jQuery -->
	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
	<!-- Custom CSS -->
	<style>
		body {
			background-image: url('img/gstarch-3.jpg');
			background-size: cover;
			background-position: center;
		}
	</style>
</head>
<body>
	<div class="container">
        <hr>
        <br>
		<div class="row justify-content-center">
			<div class="col-md-6 col-lg-6">
				<div class="card border-success mb-3 my-5 p-4 gy-4 shadow p-3 mb-5 bg-body rounded">
					<div class="card-header">
						<h3 class="text-center mb-0 text-success">PSD APPS-Module Security DB:</h3>
					</div>
					<div class="card-body">
						<form class="form" role="form" autocomplete="off">
							<div class="form-group">
								<label for="username">Username</label>
								<input type="text" class="form-control" id="username" name="username" required>
							</div>
							<div class="form-group">
								<label for="password">Password</label>
								<input type="password" class="form-control" id="password" name="password" required>
							</div>
							<div class="form-group m-4">
								<button type="submit" class="btn btn-success btn-block w-100">Login</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
        <div class="col-md-4 m-auto text-center text-white bg-dark rounded-pill item-end">
            PSD COnsulting &copy; 2023
        </div>
	</div>
	<!-- jQuery code -->
	<script>
		$(document).ready(function() {
			$('.form').submit(function(event) {
				event.preventDefault();
				var username = $('#username').val();
				var password = $('#password').val();
				// Do something with username and password
                alert(username);
			});
		});
	</script>
</body>
</html>
