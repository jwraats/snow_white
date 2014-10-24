<?php

if(!isset($_SESSION['id'])) {
    echo '<script> window.location = "./index.php"</script>';
} else {
	$user_id = $_SESSION['id'];
}

$select_detail = $pdo->prepare('SELECT u.* FROM user u WHERE u.id = :user_id');

try
{	
	$select_detail->execute(array(':user_id' => $user_id));
	$detail = $select_detail->fetchAll();
	$select_detail->closeCursor();
}
catch(PDOException $e)
{
	$json['error'] = TRUE;
	$json['msg'] = 'Error executing select_detail: ' . $e->getMessage();
	exit;
}
?>

<form method="POST" action="update_user.php">
	<?php
		foreach ($detail as $row) {
			echo "<label for='first_name'>First name</label>";
			echo "<input type='text' value='" . $row["first_name"] . "' name='first_name' id='first_name'>";
			echo "<label for='last_name'>Last name</label>";
			echo "<input type='text' value='" . $row["last_name"] . "' name='last_name' id='last_name'>";
			echo "<label for='description'>Description</label>";
			echo "<input type='text' value='" . $row["description"] . "' name='description' id='description'>";
			echo "<label for='picture'>Description</label>";
			echo "<input type='file' name='picture' id='picture'>";
			echo "<a>Current profile picture</a>";
			echo '<img src="assets/img/'. $row["picture"] .'" class="profile-avatar"/>';
		}
	?>
	<input type="submit" value="Update">
</form>