<?php

namespace app\models;

use app\core\Model;

class User extends Model
{

	public function getMyPosts()
    {
      $author = $_SESSION['auth'];	
      return $this->db->findall("SELECT id, name, description, text, goodlike, dislike, author FROM posts WHERE author = '$author' ORDER BY id DESC;");
    }

    public function getFullPosts($id)
    {
      return $this->db->findall("SELECT id, name, description, text, goodlike, dislike, author FROM posts WHERE id = '$id'");
    }

    public function getPost()// Берет один пост через сесию
	{
		$id = $_SESSION['id']; 
		return $this->db->findall("SELECT name, description, text, goodlike, dislike, author FROM posts WHERE id = '$id'");
	}

	public function getComent($ispost)
	{
	  return  $this->db->findall("SELECT id, author, message, ispost FROM comments WHERE ispost = '$ispost'");
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
		}
		
		return true;
	}

	public function postAdd($post) 
	{		
		$lastid = $this->db->getMaxIdPlus('posts');

		$params = [
			'id' => $lastid,
			'author' => $_SESSION['auth'],
			'name' => $post['name'],
			'description' => $post['description'],
			'goodlike' => '0',
			'goodlike' => '0',
			'text' => $post['text'],
		];
		$this->db->query('INSERT INTO `posts` VALUES (:id, :author, :name, :description, :goodlike, :goodlike, :text)', $params);
		return $this->db->lastInsertId();
	}

	public function addimg($path, $id)
	{
		move_uploaded_file($path, 'public/img/'.$id.'.jpg');
	}

	public function deletePost($post)
	{
		$id = $post['id'];

		if (!empty($id)) {
			$result = $this->db->getId('posts', $id);
			if ($result == true) {
				$this->db->deleteColum('posts', $id);
			}else{
				$this->db->message('error', 'No such id exists');
			}			
		}
	}

	public function enterEdit($post)
	{
		$id = $post['id'];
		if (!empty($id)) {
			$result = $this->db->getId('posts', $id);
			if ($result == true) {
				return $id;
			}else{
				$this->db->message('error', 'No such id exists');
			}			
		}
	}

	public function editPost($post)
	{
		$id = $_SESSION['id']; 
		$name = $post['name'];
		$description = $post['description'];
		$text = $post['text'];

		$this->db->editName($name, $id);
		$this->db->editDescription($description, $id);
		$this->db->editText($text, $id);		
	}
		
}