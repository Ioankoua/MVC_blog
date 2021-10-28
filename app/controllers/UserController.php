<?php

namespace app\controllers;

use app\core\Controller;
use app\lib\Db;

class UserController extends Controller
{
	/*public function __construct($route)
	{
		parent::__construct($route);
		$this->view->layout = 'admin_template';
	}*/

	public function addpostAction()// Добавление новых постов
	{	
		if (!empty($_POST)){
			$this->model->postValidate($_POST);
			$id = $this->model->postAdd($_POST);
			if (!$id) {
				$this->view->message('error', 'Picture no add');
			}
			$this->model->addimg($_FILES['img']['tmp_name'], $id);

			$this->view->message('success', 'post add');
		}

		$this->view->render('Add');
	}

	public function buttoneditAction() // Вход в режим редактора через кнопку
	{
		if (!empty($_POST)){
			$id = $this->model->enterEdit($_POST);
			$_SESSION['id'] = $id;;
			$this->view->redirect('/account/editpost');
		}
	}

	public function editpostAction()// Редактор поста
	{	
		$result = $this->model->getPost();
		$vars = [
			'posts' => $result,
		];

		if (!empty($_POST)){
			$this->model->editPost($_POST);
			$this->view->message('success', 'datas edit');
		}

		$this->view->render('Edit', $vars);
	}

	public function mypostsAction() // Ввывод всех постов сокращеном варианте
	{	
		$result = $this->model->getMyPosts();
		$vars = [
			'posts' => $result,
		];
		$this->view->render('Post', $vars);
	}

	public function fullpostAction() // Полный обзор одного выбраного поста
	{	
		$result = $this->model->getFullPosts($_POST['idpost']);
		$comment = $this->model->getComent($_POST['idpost']);
		$vars = [
			'posts' => $result,
			'comments' => $comment,
		];
		$this->view->render('Text post', $vars);
	}

	public function deletepostAction() // Удаление через кнопку
	{	
		if (!empty($_POST)) {
			$this->model->deletePost($_POST);
			$this->view->redirect('/account/myposts');
		}
	}

	public function logoutAction()
	{	
		unset($_SESSION['auth']);
		$this->view->redirect('/');
	}

}