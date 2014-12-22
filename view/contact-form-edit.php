<!DOCTYPE HTML>
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		<title>
			<?php echo htmlentities($title); ?>
		</title>
	</head>
	<body>
		<h3>Add New Contact</h3>
		<?php
			if ($errors) {
				echo '<ul class="errors">';
				foreach ($errors as $field => $error) {
					echo '<li>' . htmlentities($error) . '</li>';
				}
				echo '</ul>';
			}
		?>
		
		<form method="post" action="">
				<label for="name">Name: </label><br>
					<input type="text" name="name" value="<?php echo htmlentities($contact->name); ?>">
				<br>
				<label for="phone">Phone: </label><br>
					<input type="text" name="phone" value="<?php echo htmlentities($contact->phone); ?>">
				<br>
				<label for="Email">Email: </label><br>
					<input type="text" name="email" value="<?php echo htmlentities($contact->email); ?>">
				<br>
				<label for="Address">Address: </label><br>
					<textarea name="address"><?php echo htmlentities($contact->address); ?></textarea>
				<br>

			<input type="hidden" name="form-submitted" value="1">
			<input type="submit" value="Edit">
			<button type="button" onclick="location.href='index.php'">Cancel</button>
		</form>
	</body>
</html>