<?php

namespace app\models;

use app\core\Model;

class Auth extends Model
{

	public function validate_name($name)
		{
			if (strlen($name) >= 3 && strlen($name) <= 15){
			}else{
				$this->db->message('error', 'The name must be at least 3 characters and no more than 15');
			}
			if (1 >= $this->db->find("SELECT * FROM users WHERE name = '$name'")){
			}else{
				$this->db->message('error', 'This name is already taken, choose another login');
			}
		}

	public function validate_mail($email)
		{
			if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
			}else{
				$this->db->message('error', 'Invalid email');
			}
		}

	public function validate_login($login)
		{
			if (1 >= $this->db->find("SELECT * FROM users WHERE login = '$login'")) {
			}else{
				$this->db->message('error', 'This login is already taken, choose another login');
			}
		}

	public function validate_password($password)
		{
			if (strlen($password) > 4 && strlen($password) < 15) {
			}else{
				$this->db->message('error', 'The password must be at least 4 characters and no more than 15');
			}
		}

	public function emptyFields($name, $email, $login, $pass)
	{
		if (!empty($name) && !empty($email) && !empty($login) && !empty($pass)){

		}else{
			$this->db->message('error', 'Empty fields');
		}
	} 

	public function registrait($post)// проводим валидацию и отправляем данные в бд
	{
		$lastid = $this->db->getMaxIdPlus('users');

		$params = [
			'id' => $lastid,
			'name' => $post['name'],
			'email' => $post['email'],
			'login' => $post['login'],
			'password' => $post['password'],
		];

		if ($post != []) {
			Auth::emptyFields($post['name'], $post['email'], $post['login'], $post['password']);

			Auth::validate_name($post['name']);
			Auth::validate_mail($post['email']);
			Auth::validate_login($post['login']);
			Auth::validate_password($post['password']);

			$this->db->query('INSERT INTO users VALUES (:id, :name, :email, :login, :password)', $params); // отправляем в бд

			return $this->db->lastInsertId();
		}
	}

	public function checkAutorision($post)// проверяет зарегестрированы ли логин и пароль
	{
		$l = $post['login'];
		$p = $post['password'];

		return $post = $this->db->find("SELECT * FROM users WHERE login = '$l' AND password = '$p'");
	}

	public function getName($id)
	{
		return $this->db->find("SELECT name FROM users WHERE id = '$id'");
	}

}