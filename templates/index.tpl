<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1"/>
	<meta name="robots" content="noindex,nofollow">
	<title>Simple Todo Lists</title>
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css"/>
	<link href="css/styles.css" rel="stylesheet" type="text/css"/>
<head>
<body>
	<div class="notice-block"></div>
	<div class="container">
		<?php if ($isAuthorized): ?>
			<form class="col-md-4 col-md-offset-4">
				<h1>Hello <?php if (isset($username)) echo $username ?></h1>
				<div class="form-actions">
					<button class="btn btn-large btn-primary" type="submit" id="logout">Logout</button>
				</div>
			</form>

			<div class="col-md-6 col-md-offset-3" id="projects-list">
				<button type="button" class="btn btn-primary btn-lg" id="add-project-btn">Add TODO List</button>
			</div>
		<?php  else: ?>

		<form class="col-md-4 col-md-offset-4 auth-block">
			<div class="form-group">
				<h2 class="form-signin-heading">Please sign in</h2>
				<label for="username">Username</label>
				<input name="username" type="text" class="form-control" id="username" placeholder="Username" autofocus>
			</div>
			<div class="form-group">
				<label for="password">Password</label>
				<input name="password1" type="password" class="form-control" id="password" placeholder="Password">
			</div>
			<div class="form-group hidden">
				<label for="password2">Confirm password</label>
				<input name="password2" type="password" class="form-control" id="password2" placeholder="Confirm password">
			</div>
			<button type="button" class="btn btn-primary btn-lg btn-block" id="login">Login</button>
			<button type="button" class="btn btn-primary btn-lg btn-block hidden" id="register">Register</button>

			<div class="form-group helpers">
				<p class="helper bg-info">Not registered? <a class="text-info" id="sign-up"><strong>Sign up</strong></a></p>
			</div>
		</form>
		<?php endif; ?>
	</div>
</body>
<script type="text/javascript" src="/js/jquery-3.1.0.js"></script>
<script type="text/javascript" src="/js/todo.js"></script>
<script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>