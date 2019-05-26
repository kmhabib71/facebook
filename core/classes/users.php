<?Php
class User {
	protected $pdo;

	function __construct($pdo){
		$this->pdo = $pdo;
	}

	public function checkInput($var){
		$var = htmlspecialchars($var);
		$var = trim($var);
		$var = stripcslashes($var);
		return $var;

	}

	public function search($search){
		$stmt = $this->pdo->prepare("SELECT `user_id`, `username`,`screenName`,`profileImage`,`profileCover` FROM `users` WHERE `username` LIKE ? OR `screenName` LIKE  ?");
		$stmt->bindValue(1, $search.'%', PDO::PARAM_STR);
		$stmt->bindValue(2, $search.'%', PDO::PARAM_STR);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_OBJ);
	}
	public function login($email, $password){
		$pas = md5($password);
		$stmt = $this->pdo->prepare("SELECT `user_id` FROM `users` WHERE `email`=:email AND `password` = :password");
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->bindParam(":password",$pas, PDO::PARAM_STR);
		$stmt->execute();

		$user = $stmt->fetch(PDO::FETCH_OBJ);
		$count = $stmt->rowCount();

		if($count > 0){
			$_SESSION['user_id'] = $user->user_id;
			header('Location: home.php');
		} else {
			return false;
		}
	}
//public function register($email, $screenName, $password){
//
//		$stmt = $this->pdo->prepare("INSERT INTO `users` (`email`, `password`, `screenName`, `profileImage`, 	`profileCover`) VALUES (:email, :password, :screenName, 'assets/images/defaultProfileImage.png', 'assets/images/defaultCoverImage.png')");
//
//		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
//		$stmt->bindParam(":password", md5($password), PDO::PARAM_STR);
//		$stmt->bindParam(":screenName", $screenName, PDO::PARAM_STR);
//		$stmt->execute();
//
//		$user_id = $this->pdo->lastInsertId();
//		$_SESSION['user_id'] = $user_id;
//	}
//


	public function userData($user_id){
		$stmt = $this->pdo->prepare("SELECT * FROM `users` LEFT JOIN `profile` ON users.user_id = profile.userId WHERE users.user_id = :user_id");
//		$stmt = $this->pdo->prepare("SELECT post.*, users.*, profile.* from post, users, profile WHERE post.postBy = 5 AND users.user_id = 5 ORDER BY post.postedOn DESC;");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}
    public function totalPost($user_id){
		$stmt = $this->pdo->prepare("SELECT count(tweetID) as totalPost FROM tweets WHERE tweetBy = :user_id");
		$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetch(PDO::FETCH_OBJ);
	}

	public function logout(){
		$_SESSION = array();
		session_destroy();
		header('Location: '.BASE_URL.'../index.php');
		// header('Location: http://localhost/srasoc/index.php');
	}
	public function delete($table, $array){
		$sql = "DELETE FROM `{$table}`";
		$where = " WHERE ";
		foreach($array as $name=> $value){
			$sql .="{$where} `{$name}` = :{$name}";
			$where = " AND ";
		}
		if($stmt = $this->pdo->prepare($sql)){
			foreach ($array as $name => $value) {
				$stmt->bindValue(':'.$name, $value);

			}
			$stmt->execute();
		}
	}

	public function checkUsername($username){
		$stmt = $this->pdo->prepare("SELECT `username` FROM users WHERE `username` = :username");
		$stmt->bindParam(":username", $username, PDO::PARAM_STR);
		$stmt->execute();
		$count = $stmt->rowCount();
		if($count > 0){
			return true;
		} else {
			return false;
		}
	}


	public function checkEmail($email){
		$stmt = $this->pdo->prepare("SELECT email FROM users WHERE email = :email");
		$stmt->bindParam(":email", $email, PDO::PARAM_STR);
		$stmt->execute();
		$count = $stmt->rowCount();
		if($count > 0){
			return true;
		} else {
			return false;
		}
	}
	public function loggedIn(){
		return (isset($_SESSION['user_id'])) ? true : false;
	}
	public function userIdByUsername($username){
		$stmt = $this->pdo->prepare("SELECT `user_id` FROM `users` WHERE `userLink` = :username");
		$stmt->bindParam(":username", $username, PDO::PARAM_STR);
		$stmt->execute();
		$user = $stmt->fetch(PDO::FETCH_OBJ);
		return $user->user_id;
	}
    public function create($table, $fields = array()){
		$columns = implode(',', array_keys($fields));
		$values = ':'.implode(', :', array_keys($fields));
		$sql = "INSERT INTO {$table}({$columns})VALUES ({$values}) ";
		if($stmt = $this->pdo->prepare($sql)){
			foreach($fields as $key => $data){
				$stmt->bindValue(':'.$key, $data);
			}
			$stmt->execute();
			return $this->pdo->lastInsertId();
		}
    }
    public function reactExistingCheck($postId, $userID ){
	$stmt = $this->pdo->prepare("SELECT reactID from `react` WHERE `reactOn`= :postId AND `reactBy` = :userID  ");
             $stmt->bindParam(":postId", $postId, PDO::PARAM_INT);
             $stmt->bindParam(":userID ", $userID, PDO::PARAM_INT);
			$stmt->execute();
			return $stmt->fetchAll(PDO::FETCH_OBJ);
		}
public function allPhoto($profileId){
    $stmt = $this->pdo->prepare("SELECT * FROM `tweets` WHERE `tweetBy`= :profileID");
    $stmt->bindParam(":profileID", $profileId, PDO::PARAM_INT);
    $stmt->execute();
//    $stmt->fetch(PDO::FETCH_OBJ);
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

    public function update($table, $user_id, $fields = array()){
		$columns = '';
		$i       = 1;

		foreach ($fields as $name => $value){
			$columns .= "`{$name}` = :{$name}";
			if($i < count($fields)){
				$columns .= ', ';
			}
			$i++;
		}
		$sql = "UPDATE {$table} SET {$columns} WHERE `userId` = {$user_id}";
		if($stmt = $this->pdo->prepare($sql)){
			foreach ($fields as $key => $value){
				$stmt->bindValue(':'.$key, $value);
			}

			$stmt->execute();
		}
	}


    ///////Image upload............................

    public function multiImage($file){


$errors = array();
$uploadedFiles = array();
$extension = array("jpeg","jpg","png","gif","JPG");
$bytes = 1024;
$KB = 1024;
$totalBytes = $bytes * $KB;
$UploadFolder = "user";

$counter = 0;

foreach($file["files"]["tmp_name"] as $key=>$tmp_name){
    $temp = $file["files"]["tmp_name"][$key];
    $name = $file["files"]["name"][$key];

    if(empty($temp))
    {
        break;
    }

    $counter++;
    $UploadOk = true;

    if($file["files"]["size"][$key] > $totalBytes)
    {
        $UploadOk = false;
        array_push($errors, $name." file size is larger than the 1 MB.");
    }

    $ext = pathinfo($name, PATHINFO_EXTENSION);
    if(in_array($ext, $extension) == false){
        $UploadOk = false;
        array_push($errors, $name." is invalid file type.");
    }

//    if(file_exists($UploadFolder."/".$name) == true){
//        $UploadOk = false;
//        array_push($errors, $name." file is already exist.");
//    }

    if($UploadOk == true){
        move_uploaded_file($temp,$UploadFolder."/".$name);
        array_push($uploadedFiles, $name);
    }
}

if($counter>0){
    if(count($errors)>0)
    {
        echo "<b>Errors:</b>";
        echo "<br/><ul>";
        foreach($errors as $error)
        {
            echo "<li>".$error."</li>";
        }
        echo "</ul><br/>";
    }

    if(count($uploadedFiles)>0){
        echo "<b>Uploaded Files:</b>";
        echo "<br/><ul>";
        foreach($uploadedFiles as $fileName)
        {
            echo "<li>".$fileName."</li>";
        }
        echo "</ul><br/>";

        echo count($uploadedFiles)." file(s) are successfully uploaded.";
    }
}
else{
    echo "Please, Select file(s) to upload.";
}
    }




	public function uploadImage($file){
		$filename = basename($file['name']);
		$fileTmp  = $file['tmp_name'];
		$fileSize = $file['size'];
		$error    = $file['error'];

		$ext  = explode('.', $filename);
		$ext = strtolower(end($ext));
		$allowed_ext = array('jpg', 'png', 'jpeg');

		if(in_array($ext, $allowed_ext) === true ){
			if($error === 0){
				if($fileSize <= 809272152){
					$fileRoot = 'users/' . $filename;
					move_uploaded_file($fileTmp, $_SERVER['DOCUMENT_ROOT'].'/facebook/user/'.$fileRoot);
					return $fileRoot;
				}
			} else {
				$GLOBALS['imageError'] = "This file size is too larg";
			}
} else {
		$GLOBALS['imageError'] = "The extension is not allowed";
	}
}
public function blockUser($user_id, $profileID){
    $stmt = $this->pdo->prepare("SELECT blockID FROM block WHERE (`blockerID` = :user_id AND `blockedID` =:profileID) OR (`blockedID` = :user_id AND `blockerID` =:profileID) ");
    $stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
    $stmt->bindParam(":profileID", $profileID, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchALL(PDO::FETCH_OBJ);

}
public function checkPassword($password){
		$stmt = $this->pdo->prepare("SELECT `password` FROM users WHERE `password` = :password");
		$stmt->bindParam(":password", md5($password), PDO::PARAM_STR);
		$stmt->execute();
		$count = $stmt->rowCount();
		if($count > 0){
			return true;
		} else {
			return false;
		}
	}

	public function timeAgo($datetime){
		$time = strtotime($datetime);
		$current = time();
		$seconds = $current - $time;
		$minutes = round($seconds / 60);
		$hours = round($seconds / 3600);
		$months = round ($seconds / 2600640);

		if($seconds <= 60){
			if($seconds == 0){
				return 'posted now';
			}else {
				return ''.$seconds.'s ago';
			}
			} else if($minutes <= 60){
				return ''.$minutes.'m ago';
			}else if($hours <= 24){
				return ''.$hours.'h ago ';

			}else if($months <= 12){
				return ''.date('M j', $time);
			}else {
				return ''.date('j M Y', $time);
			}
		}

//    //////////////................About section....................../////////////
//public function aboutSubmit($submitType, $inputVal, $userid,$profileid){
//			$stmt = $this->pdo->prepare("UPDATE profile SET :submitType = :inputValue WHERE `postID` = :post_id");
//			$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
//			$stmt->execute();
//
//			$stmt = $this->pdo->prepare("DELETE FROM `likes` WHERE `likeBy` = :user_id AND `likeOn` = :post_id");
//			$stmt->bindParam(":user_id", $user_id, PDO::PARAM_INT);
//			$stmt->bindParam(":post_id", $post_id, PDO::PARAM_INT);
//			$stmt->execute();
//		}

//    public function profileUpdate($user_id, $fields = array()){
//		$columns = '';
//		$i       = 1;
//
//		foreach ($fields as $name => $value){
//			$columns .= "`{$name}` = :{$name}";
//			if($i < count($fields)){
//				$columns .= ', ';
//			}
//			$i++;
//		}
//		$sql = "UPDATE `profile` SET {$columns} WHERE `userId` = {$user_id}";
//		if($stmt = $this->pdo->prepare($sql)){
//			foreach ($fields as $key => $value){
//				$stmt->bindValue(':'.$key, $value);
//			}
//			// var_dump($sql);
//			$stmt->execute();
//		}
//	}







//    //////////////................About section end....................../////////////











	}


?>
