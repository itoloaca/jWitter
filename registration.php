<?php
include('php/header.php');
?>

<div class="hero-unit" style="background-color: #e6f3f7;">
	<div class="row">


		<div class="span6 offset3">
			<h1>Sign Up</h1>
			<?php
			
			if (isset($_SESSION["status_success"])) {
				$alert = $_SESSION["status_success"];
				unset($_SESSION["status_success"]);
				echo("<div class='alert alert-success'>{$alert}</div>");
			}
			if (isset($_SESSION["status_failure"])) {
				$alert = $_SESSION["status_failure"];
				unset($_SESSION["status_failure"]);
				echo("<div class='alert alert-error'>{$alert}</div>");
			}
			?>
			<form accept-charset="UTF-8" action="doregistration.php" method="post"><div style="margin:0;padding:0;display:inline"></div>

				<label for="name">Name</label>
				<input id="name" name="name" size="30" type="text"/>

				<label for="email">Email</label>
				<input id="email" name="email" size="30" type="text" />

				<label for="password">Password</label>
				<input id="password" name="password" size="30" type="password" />

				<input class="btn btn-large btn-primary" name="commit" type="submit" value="Submit" />
			</form>

		</div>
	</div>
</div>


<?php
include('php/footer.php');
?>
