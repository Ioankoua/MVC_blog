<?php

namespace app\models;

use app\core\Model;

class Main extends Model
{
	public function getAllPosts()
	{
		return $result = $this->db->findall('SELECT id, name, description, text, goodlike, dislike, author FROM posts ORDER BY id DESC;');
	}

	public function getFullPosts($id)
	{
		return $result = $this->db->findall("SELECT id, name, description, text, goodlike, dislike, author FROM posts WHERE id = '$id'");
	}

	public function getPostForApi($name)
	{
		return $result = $this->db->findall("SELECT name, description, text, author FROM posts WHERE name = '$name'");
	}

	public function getAllPostForApi()
	{
		return $result = $this->db->findall('SELECT name, description, text, author FROM posts ORDER BY id DESC;');
	}

	public function getLike($id)
	{
		return $this->db->find("SELECT goodlike FROM posts WHERE id = '$id'");
	}

	public function getDislike($id)
	{
		return $this->db->find("SELECT dislike FROM posts WHERE id = '$id'");
	}

	public function addComent($post)
	{
		$author = $_SESSION['auth'];
		$lastid = $this->db->getMaxIdPlus('comments');

		$params = [
			'id' => $lastid,
			'message' => $post['message'],
			'author' => $_SESSION['auth'],
			'ispost' => $post['ispost'],
		];

		$this->db->query('INSERT INTO `comments` VALUES (:id, :author, :message, :ispost)', $params);
		return $this->db->lastInsertId();
	}

	public function getComent($ispost)
	{
		return  $this->db->findall("SELECT id, author, message, ispost FROM comments WHERE ispost = '$ispost'");
	}

	public function makeLike($post)
	{
		if (isset($_POST['like'])) {
			$idpost = $_POST['like'];
			$colum = 'goodlike';
			$countlike = Main::getLike($idpost);
		}else{
			$idpost = $_POST['dislike'];
			$colum = 'dislike';
			$countlike = Main::getDislike($idpost);
		}
		$pluslike = $countlike + 1;
		$minuslike = $countlike - 1;

		$id = $_SESSION['auth'];

		if (!isset($_COOKIE["$idpost".''.$id])) {
			$this->db->update('posts', $colum, $pluslike, $idpost);
			setcookie($idpost.''.$id, $colum, time() + 60000);	
		}
		
		if ($_COOKIE["$idpost".''.$id] == $colum) {
			$this->db->update('posts', $colum, $minuslike, $idpost);
			setcookie($idpost.''.$id, "", time() + 60000);
		}

		if ($_COOKIE["$idpost".''.$id] != $colum) {
			$countdislike = Main::getDislike($idpost);
			$countlike = Main::getLike($idpost);
			$plusdis = $countdislike + 1;
			$minusdis = $countdislike - 1;
			$pluslike = $countlike + 1;
			$minuslike = $countlike - 1;

			if ($_COOKIE["$idpost".''.$id] == 'goodlike') {
				$this->db->update('posts', 'goodlike', $minuslike, $idpost);
				$this->db->update('posts', 'dislike', $plusdis, $idpost);
				setcookie($idpost.''.$id, $colum, time() + 60000);
			}
			if ($_COOKIE["$idpost".''.$id] == 'dislike') {
				$this->db->update('posts', 'dislike', $minusdis, $idpost);
				$this->db->update('posts', 'goodlike', $pluslike, $idpost);
				setcookie($idpost.''.$id, $colum, time() + 60000);
			}
		}
		
	}

}