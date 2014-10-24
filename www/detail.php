<?php

# check login
if(!isset($_SESSION['id'])) {
    echo '<script> window.location = "./index.php"</script>';
} else {
	$user_id = $_SESSION['id'];
}

$select_detail = $pdo->prepare('SELECT u.* FROM user u
								INNER JOIN user f ON u.follow_id = f.id
								WHERE u.id = :user_id');

$follow_detail = $pdo->prepare('SELECT f.* FROM user u
								INNER JOIN user f ON u.follow_id = f.id
								WHERE u.id = :user_id');

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

try
{
	$follow_detail->execute(array(':user_id' => $user_id));
	$follow = $follow_detail->fetchAll();
	$follow_detail->closeCursor();
}
catch(PDOException $e)
{
	$json['error'] = TRUE;
	$json['msg'] = 'Error executing follow_detail: ' . $e->getMessage();
	exit;
}

if(count($detail) > 0){
	foreach($detail as $row){
		echo $row["first_name"];
		echo "<br/>";
		echo $row["last_name"];
		echo "<br/>";
		echo $row["username"];
		echo "<br/>";
		echo $row["picture"];
		echo "<br/>";
	}
} else {
	echo 'geen resultaten';
}

if(count($follow) > 0){
	foreach($follow as $row){
		echo $row["first_name"];
		echo "<br/>";
		echo $row["last_name"];
		echo "<br/>";
		echo $row["username"];
		echo "<br/>";
		echo $row["picture"];
	}
} else {
	echo 'geen resultaten';
}


?>
<div class="top-bar">
	<a class="trigger-menu" href="#"></a>
</div>

<section class="video">
Video
</section>


<section class="profile-content">	

	<div class="detail-item">
	<img class="detail-img" src="assets/img/avatar.png">
		<h3>Ready to party! Lets get some chick here.</h3>
		<p>Went to the supermarket after drinking a beer with couple of friends. Turned out pretty late.</p>
		<p class="tags"><span>tags:</span>#sleepy , #lazy , #yolo</p>
	</div>

<div class="full">
		<div class="third facebook">fb</div>
		<div class="third tweet">tw</div>
		<div class="third comment">comment</div>
</div>

</section>
