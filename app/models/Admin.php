<?php

namespace app\models;

use app\core\Model;

class Admin extends Model
{
	public function loginValidate($post) //Проверка логина и пароля при входе в админ панель
	{
		$config = require 'app/config/admin.php';
		if ($config['login'] != $post['login'] or $config['password'] != $post['password']){
			$this->db->message('error', 'Incorrect login or password');
		}else{
			return true;
		}
	}

	public function getAllPosts()
    {
      return $this->db->findall('SELECT id, name, description, text, goodlike, dislike, author FROM posts ORDER BY id DESC;');
    }

    public function getFullPosts($id)
    {
      return $this->db->findall("SELECT id, name, description, text, goodlike, dislike, author FROM posts WHERE id = '$id'");
    }

    public function getComent($ispost)
	{
	  return  $this->db->findall("SELECT id, author, message, ispost FROM comments WHERE ispost = '$ispost'");
	}

	public function emptyFields($post) // Проверка на пустые поля
	{
		$idLen = iconv_strlen($post['id']);
		if (isset($post['name'])) {
			$nameLen = iconv_strlen($post['name']);
		}

		if ($nameLen >= 1 or $idLen >= 1) {
			return true;
		}else{
			$this->db->message('error', 'empty fields');
		}
	}

	public function postValidate($post) 
	{
		$nameLen = iconv_strlen($post['name']);
		$descriptionLen = iconv_strlen($post['description']);
		$textLen = iconv_strlen($post['text']);
		
		$this->db->nameValidate($nameLen);
		$this->db->descriptionValidate($descriptionLen);
		$this->db->textValidate($textLen);
		
		if (empty($_FILES['img']['tmp_name'])) {
			$this->db->message('error', 'Need picture');
			return false;
		}
		
		return true;
	}

	public function postAdd($post) 
	{		
		$lastid = $this->db->getMaxIdPlus('posts');

		$params = [
			'id' => $lastid,
			'name' => $post['name'],
			'description' => $post['description'],
			'text' => $post['text'],
			'goodlike' => '0',
			'dislike' =>  '0',
			'author' => 'admin',
		];
		//setcookie('res',$lastid.$post['name'].$post['description'].$post['text'].$like.$dis.'admin', time() +100);
		$this->db->query('INSERT INTO `posts` VALUES (:id, :author, :name, :description, :goodlike, :dislike, :text)', $params);
		
		return $lastid;
	}

	public function addimg($path, $id)
	{
		move_uploaded_file($path, 'public/img/'.$id.'.jpg');
	}

	public function deletePost($post)
	{
		$id = $post['id'];
		if (isset($post['name'])) {
			$name = $post['name'];
		}

		if (!empty($id)) {
			$result = $this->db->getId('posts', $id);
			if ($result == true) {
				$this->db->deleteColum('posts', $id);
			}else{
				$this->db->message('error', 'No such id exists');
			}			
		}

		if (!empty($name)) {
			$id = $this->db->getNameId('posts', $name);
			if ($id == true) {
				$this->db->deleteColum('posts', $id);
			}else{
				$this->db->message('error', 'No such name exists');
			}			
		}	
	}

	public function deleteComm($post)
	{
		$id = $post['id'];

		if (!empty($id)) {
			$result = $this->db->getId('comments', $id);
			if ($result == true) {
				$this->db->deleteColum('comments', $id);
			}else{
				$this->db->message('error', 'No such id exists');
			}			
		}
	}

	public function getPost()// Берет один пост через сесию
	{
		$id = $_SESSION['id']; 
		$post = $this->db->findall("SELECT name, description, text, goodlike, dislike, author FROM posts WHERE id = '$id'");
		return $post;
	}

	public function enterEdit($post)
	{
		$id = $post['id'];
		if (isset($post['name'])) {
			$name = $post['name'];
		}

		if (!empty($id)) {
			$result = $this->db->getId('posts', $id);
			if ($result == true) {
				return $id;
			}else{
				$this->db->message('error', 'No such id exists');
			}			
		}

		if (!empty($name)) {
			$id = $this->db->getNameId('posts', $name);
			if ($id == true) {
				return $id;
			}else{
				$this->db->message('error', 'No such name exists');
			}			
		}
	}

	public function editLike($like, $id)
	{
		if (!empty($like)) {
			$this->db->update('posts', 'goodlike', $like, $id);
		}else{
			$this->db->message('error', 'The like field is empty');
		}
	}

	public function editDis($dis, $id)
	{
		if (!empty($dis)) {
			$this->db->update('posts', 'dislike', $dis, $id);
		}else{
			$this->db->message('error', 'The dislike field is empty');
		}
	}

	public function editAuthor($author, $id)
	{
		if (!empty($author)) {
			$this->db->update('posts', 'author', $author, $id);
		}else{
			$this->db->message('error', 'The author field is empty');
		}
	}

	public function editPost($post)
	{
		$id = $_SESSION['id']; 
		$name = $post['name'];
		$description = $post['description'];
		$text = $post['text'];
		$like = $post['goodlike'];
		$dis = $post['dislike'];
		$author = $post['author'];

		$this->db->editName($name, $id);
		$this->db->editDescription($description, $id);
		$this->db->editText($text, $id);		
		Admin::editLike($like, $id);
		Admin::editDis($dis, $id);
		Admin::editAuthor($author, $id);
	}
		
}