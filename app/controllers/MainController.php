<?php

namespace app\controllers;

use app\core\Controller;
use app\lib\Db;

class MainController extends Controller
{
	public function postAction()
	{	
		$result = $this->model->getAllPosts();
		$vars = [
			'posts' => $result,
		];
		
		$this->view->render('Post', $vars);
	}

	public function fullpostAction()
	{	
		$result = $this->model->getFullPosts($_POST['idpost']);
		$comment = $this->model->getComent($_POST['idpost']);
		$vars = [
			'posts' => $result,
			'comments' => $comment,
		];
		$this->view->render('Fullpost', $vars);
	}

	public function getPostAction()
	{
		$method = $_SERVER['REQUEST_METHOD'];

		if (isset($this->route['id'])) {
			$id = $this->route['id'];
		}

		$result = $this->model->getFullPosts($id);
		$comment = $this->model->getComent($id);
		$vars = [
			'posts' => $result,
			'comments' => $comment,
		];
		$this->view->render('Fullpost', $vars);
	}	

	public function likeAction()
	{
		$this->model->makeLike($_POST);
		
		?> <script type="text/javascript">window.history.back()</script><?
	}

	public function comentAction()
	{
		$this->model->addComent($_POST);

		?> <script type="text/javascript">window.history.back()</script><?
	}

	public function exitAction()
	{	
		unset($_SESSION['auth']);
		$this->view->redirect('/');
	}

	public function receivedApiAction()
	{
		$this->view->render('Received Api');
	}

	public function shareApiAction()
	{	
		$this->view->render('Share Api');
	}

	public function getOnePostJsonAction()
	{
		header('Content-type: json/aplication');

		if (strlen($_POST['name']) > 3) {
			
			$result = $this->model->getPostForApi($_POST['name']);

			$result = json_encode($result);
			echo $result;
		}

	}

	public function allPostsJsonAction()
	{
		header('Content-type: json/aplication');

		$result = $this->model->getAllPostForApi();

		$result = json_encode($result);
		echo $result;		
	}



}