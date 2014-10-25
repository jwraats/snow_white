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
	
	public function addFriend($id){
		if(!$this->checkIfFriends($id)){
			if(!isset($_SESSION['id']) || isset($_SESSION['id']) && !is_numeric($_SESSION['id'])){
				return false;
			}
			try{
				$q = $this->pdo->prepare('INSERT INTO friend (user_id, friend_id, timeAdded) VALUES(:userId, :friendId, :time)');
				$q->execute(array(':userId' => $_SESSION['id'], ':friendId' => $id, ':time' => time()));
				return true;
			}catch(PDOException $e)
			{
				return false;
			}

		}
	}

	public function checkFeedSession($session){
		if(isset($_SESSION['id'])){
			return false;
		}
		$detail = false;
		$select_detail = $this->pdo->prepare('SELECT * FROM feed WHERE session = :session AND user_id = :user_id');
		try
		{
			$select_detail->execute(array(':user_id' => $_SESSION['id'], ':session' => $session));
			$detail = $select_detail->fetchAll(PDO::FETCH_OBJ);

			$select_detail->closeCursor();
		}
		catch(PDOException $e)
		{
			var_dump($e);
			return false;
		}
		return $detail;
	}

	public function addFeed($session, $title, $message){
		if(!$this->checkFeedSession($session)){
			if(!isset($_SESSION['id']) || isset($_SESSION['id']) && !is_numeric($_SESSION['id'])){
				return false;
			}
			try{
				$q = $this->pdo->prepare('INSERT INTO feed (user_id, session, title, message, created) VALUES(:userId, :session, :title, :message, :time)');
				$q->execute(array(':userId' => $_SESSION['id'], ':session' => $session, ':title' => $title, ':message' => $message, ':time' => time()));
				return true;
			}catch(PDOException $e)
			{
				return false;
			}

		}
		return false;
	}

	public function delFriend($id){
		if($this->checkIfFriends($id)){
			if(!isset($_SESSION['id']) || isset($_SESSION['id']) && !is_numeric($_SESSION['id'])){
				return false;
			}
			try{
				$q = $this->pdo->prepare('DELETE FROM friend WHERE user_id = :userId AND friend_id = :friendId');
				$q->execute(array(':userId' => $_SESSION['id'], ':friendId' => $id));
				return true;
			}catch(PDOException $e)
			{
				return false;
			}

		}
	}

	public function checkIfFriends($id){
		if(!isset($_SESSION['id']) || isset($_SESSION['id']) && !is_numeric($_SESSION['id'])){
			return false;
		}
		$detail = false;
		$select_detail = $this->pdo->prepare('SELECT u.* FROM friend f, user u WHERE f.user_id = :user_id AND f.friend_id = u.id AND f.friend_id = :id');
		try
		{
			$select_detail->execute(array(':user_id' => $_SESSION['id'], ':id' => $id));
			$detail = $select_detail->fetchAll(PDO::FETCH_OBJ);
			$select_detail->closeCursor();
		}
		catch(PDOException $e)
		{
			return false;
		}
		return $detail;
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
		$select_detail = $this->pdo->prepare('SELECT * FROM feed WHERE user_id = :user_id ORDER BY id DESC');
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