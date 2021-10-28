<?php

namespace app\models;

use app\core\Model;

class Api extends Model
{
	public function getPosts()
	{
		$result = $this->db->findall('SELECT * FROM posts ORDER BY id DESC;');

		echo json_encode($result);
	}

	public function getPost($id)
	{
		$post = $this->db->findall("SELECT * FROM posts WHERE id = '$id'");
		if ($post === []) {
			http_response_code(404);
			$res = [
				"status" => false,
				"message" => "Post not found"
			];
			echo json_encode($res);
		}else{
			return $post;
		}
		
	}

	public function getComent($ispost)
	{
		return  $this->db->findall("SELECT * FROM comments WHERE ispost = '$ispost'");
	}
	
	public function addPost($post)
	{
		$lastid = $this->db->getMaxIdPlus('posts');

		$params = [
			'id' => $lastid,
			'author' => 'kek',
			'name' => $post['name'],
			'description' => $post['description'],
			'goodlike' => '0',
			'goodlike' => '0',
			'text' => $post['text'],
		];
		$this->db->query('INSERT INTO `posts` VALUES (:id, :author, :name, :description, :goodlike, :goodlike, :text)', $params);
		move_uploaded_file($_FILES['img']['tmp_name'], 'public/img/'.$lastid.'.jpg');

		http_response_code(201);

		echo json_encode($res);
	}

	public function deletePost($id)
	{
		$this->db->deleteColum('posts', $id);

		http_response_code(200);

		$res = [
				"status" => true,
				"message" => "Post is deleted"
		];

		echo json_encode($res);
	}
}

