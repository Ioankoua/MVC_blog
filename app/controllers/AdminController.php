<?php

namespace app\controllers;

use app\core\Controller;
use app\lib\Db;

class AdminController extends Controller
{
	public function __construct($route)
	{
		parent::__construct($route);
		$this->view->layout = 'admin_template';
	}

	public function loginAction()// Вход в панель админа
	{	
		if (isset($_SESSION['admin'])){
			$this->view->redirect('../admin/add');
		}
		if (!empty($_POST)){
			if ($this->model->loginValidate($_POST)){
				$_SESSION['admin'] = true;
				unset($_SESSION['auth']);
				$this->view->location('/admin/add');
			}
		}

		$this->view->render('Login');
	}

	public function addAction()// Добавление новых постов
	{	
		if (!empty($_POST)){
			$this->model->postValidate($_POST);
			$id = $this->model->postAdd($_POST);

			if (!$id) {
				$this->view->message('error', 'Picture no add');
			}
			$this->model->addimg($_FILES['img']['tmp_name'], $id);

			$this->view->message('success', 'id: '.$id);
		}

		$this->view->render('Add');
	}

	public function enter_editAction() // Вход в режим редактора через навигацию
	{
		if (!empty($_POST)){
			$this->model->emptyFields($_POST);
			$id = $this->model->enterEdit($_POST);
			$_SESSION['id'] = $id;
			$this->view->location('../admin/edit');
		}

		$this->view->render('Edit Enter');
	}

	public function button_enter_editAction() // Вход в режим редактора через кнопку
	{
		if (!empty($_POST)){
			$id = $this->model->enterEdit($_POST);
			$_SESSION['id'] = $id;
			$this->view->redirect('../admin/edit');
		}
	}

	public function editAction()// Редактор поста
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

	public function admin_postAction() // Ввывод всех постов сокращеном варианте
	{	
		$result = $this->model->getAllPosts();
		$vars = [
			'posts' => $result,
		];
		$this->view->render('Post', $vars);
	}

	public function text_postAction() // Полный обзор одного выбраного поста
	{	
		$result = $this->model->getFullPosts($_POST['idpost']);
		$comment = $this->model->getComent($_POST['idpost']);
		$vars = [
			'posts' => $result,
			'comments' => $comment,
		];
		$this->view->render('Text post', $vars);
	}

	public function deleteAction() // Удаление через навигацию
	{	
		if (!empty($_POST)) {
			$this->model->emptyFields($_POST);
			$this->model->deletePost($_POST);
			$this->view->message('success','This post was deleted');
		}
		
		$this->view->render('Delete');
	}

	public function delete_buttonAction() // Удаление через кнопку
	{	
		if (!empty($_POST)) {
			$this->model->deletePost($_POST);
			$this->view->redirect('/admin/post');
		}
	}

	public function deleteCommentAction()
	{
		$this->model->deleteComm($_POST);
		?> <script type="text/javascript">window.history.back()</script><?
	}

	public function logoutAction()
	{	
		unset($_SESSION['admin']);
		$this->view->redirect('/');
	}

}