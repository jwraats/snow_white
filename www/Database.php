<?php
class Database{
	private $pdo;
	public function Database($db_host, $db_name, $db_user, $db_pass){
		try {
		    $this->pdo = new PDO('mysql:host='.$db_host.';dbname='.$db_name, $db_user, $db_pass);
		} catch (PDOException $e) {
		    print "Error!: " . $e->getMessage() . "<br/>";
		    die();
		}
	}

	public function getPDO(){
		return $this->pdo;
	}

	public function getFriendsByUserId($userId){
		$detail = false;
		$select_detail = $this->pdo->prepare('SELECT u.* FROM friend f, user u WHERE f.user_id = :user_id AND f.friend_id = u.id');
		try
		{
			$select_detail->execute(array(':user_id' => $userId));
			$detail = $select_detail->fetchAll(PDO::FETCH_OBJ);
			$select_detail->closeCursor();
		}
		catch(PDOException $e)
		{
			return false;
		}
		return $detail;
	}


	public function getFeedById($id){
		$detail = false;
		$select_detail = $this->pdo->prepare('SELECT * FROM feed WHERE id = :id');
		try
		{
			$select_detail->execute(array(':id' => $id));
			$detail = $select_detail->fetch(PDO::FETCH_OBJ);
			$select_detail->closeCursor();
		}
		catch(PDOException $e)
		{
			return false;
		}
		return $detail;
	}

	public function getUserByID($userId){
		$detail = false;
		$select_detail = $this->pdo->prepare('SELECT * FROM user WHERE id = :user_id');
		try
		{
			$select_detail->execute(array(':user_id' => $userId));
			$detail = $select_detail->fetch(PDO::FETCH_OBJ);
			$select_detail->closeCursor();
		}
		catch(PDOException $e)
		{
			return false;
		}
		return $detail;
	}

	public function Login($username, $password){
		$detail = false;
		$select_detail = $this->pdo->prepare('SELECT * FROM user WHERE username = :username AND password = :password');
		try
		{
			$select_detail->execute(array(':username' => $username, ':password' => md5($password)));
			$detail = $select_detail->fetch(PDO::FETCH_OBJ);
			$select_detail->closeCursor();
		}
		catch(PDOException $e)
		{
			return false;
		}
		return $detail;
	}

	public function getFeedByUserId($userId){
		$detail = false;
		$select_detail = $this->pdo->prepare('SELECT * FROM feed WHERE user_id = :user_id');
		try
		{
			$select_detail->execute(array(':user_id' => $userId));
			$detail = $select_detail->fetchAll(PDO::FETCH_OBJ);
			$select_detail->closeCursor();
		}
		catch(PDOException $e)
		{
			return false;
		}
		return $detail;
	}

	public function getTagsByFeedId($feedId){
		$detail = false;
		$select_detail = $this->pdo->prepare('SELECT * FROM tag WHERE feed_id = :feedId');
		try
		{
			$select_detail->execute(array(':feedId' => $feedId));
			$detail = $select_detail->fetchAll(PDO::FETCH_OBJ);
			$select_detail->closeCursor();
		}
		catch(PDOException $e)
		{
			return false;
		}
		return $detail;
	}
}

?>