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
}

?>