<?php
use Phppot\Member;
if (! empty($_POST["login-btn"])) {
    require_once __DIR__ . '/lib/user.php';
    $member = new Member();
    $loginResult = $member->loginMember();
}
?>
<HTML>
<HEAD>
<TITLE>Login</TITLE>
</HEAD>
<BODY>
			<div class="login-signup">
				<a href="user-registration.php">Sign up</a>
			</div>
				<form name="login" action="" method="post">
					<div class="signup-heading">Login</div>
				<?php if(!empty($loginResult)){?>
				<div><?php echo $loginResult;?></div>
				<?php }?>
								Email<span class="required error" id="username-info"></span>
							<input  type="text" name="email"
								id="email">
								Password<span class="required error" id="login-password-info"></span>
							<input  type="password"
								name="login-password" id="login-password">
					<div class="row">
						<input class="btn" type="submit" name="login-btn"
							id="login-btn" value="Login">
					</div>
				</form>
	<script>
</script>
</BODY>
</HTML>
