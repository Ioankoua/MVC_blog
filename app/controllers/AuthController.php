<?php

namespace app\controllers;

use app\core\Controller;
use app\lib\Db;

class AuthController extends Controller
{
	public function registerAction() // Проводим регистрацию и редеректим на вход
	{
		$id = $this->model->registrait($_POST); // 

		if ($id != false) {
			$name = $this->model->getName($id);
			$_SESSION['auth'] = $name;
			$this->view->location('/');
		}

		$this->view->render('Register');
	}

	public function enterAction() // проверяте сходяться ли пароль и логин и редиректит на акаунт
	{	
		$id = $this->model->checkAutorision($_POST); // получает ид входящего

		if ($_POST != []) {
			if ($id != false) {
				$name = $this->model->getName($id);
				$_SESSION['auth'] = $name;
				$this->view->location('/');
			}else{
				$this->view->message('error', 'Incorrect login or password');
			}
		}
		
		$this->view->render('Enter');
	}


}