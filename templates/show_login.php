<p>Welcome to the super-secure enterprise app (Version "Port Knox").</p>

<br/><br/>

<?php
	if(isset($_['authenticated']) && $_['authenticated'] === false):
?>

	<p>To proceed please enter your administrative credentials.</p>
	<?php if(isset($_['password'])): ?>
		Sorry, <code><?php echo $_['password'] ?></code> is not the correct password.
	<?php endif; ?>
	<form method="POST">
		<input placeholder="Password" type="text" name="password"/>
		<input type="submit" value="Authenticate"/>
	</form>

<?php
	else:
?>
<?php
	endif;
?>
