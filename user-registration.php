<?php
use Phppot\Member;
if (! empty($_POST["signup-btn"])) {
    require_once './lib/user.php';
    $member = new Member();
    $registrationResponse = $member->registerMember();
}
?>
<HTML>
<HEAD>
<TITLE>User Registration</TITLE>
</HEAD>
<BODY>
			<div class="login-signup">
				<a href="login.php">Login</a>
			</div>
				<form name="sign-up" action="" method="post">
					<div>Registration</div>
				<?php
					if (! empty($registrationResponse["status"])) {
						?>
									<?php
						if ($registrationResponse["status"] == "error") {
							?>
									<div ><?php echo $registrationResponse["message"]; ?></div>
									<?php
						} else if ($registrationResponse["status"] == "success") {
							?>
									<div ><?php echo $registrationResponse["message"]; ?></div>
									<?php
						}
						?>
								<?php
					}
					?>
							<div class="form-label">
								Username<span class="required error" id="username-info"></span>
							</div>
							<input  type="text" name="username"
								id="username">
							<div class="form-label">
								Email<span  id="email-info" required></span>
							</div>
							<input type="email" name="email" id="email">
							<div class="form-label">
								Password<span id="signup-password-info"></span>
							</div>
							<input  type="password"
								name="signup-password" id="signup-password">
						<input class="btn" type="submit" name="signup-btn"
							id="signup-btn" value="Sign up">
				</form>
	<script>
</script>
</BODY>
</HTML>
