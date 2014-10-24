<?php
echo $_GET['id'];
$user_id = isset($_GET['id']) ? $_GET['id'] : 'login';
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