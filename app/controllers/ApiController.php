<?php

namespace app\controllers;

use app\core\Controller;
use app\lib\Db;

class ApiController extends Controller
{
	public function receivedApiAction()
	{
		$this->view->render('Received Api');
	}

	public function shareApiAction()
	{
		header('Access-Control-Allow-Origin: *');
		header('Access-Control-Allow-Headers: *');
		header('Access-Control-Allow-Methods: *');
		header('Access-Control-Allow-Credentials: true');
		//header('Content-type: json/apllication');

		$method = $_SERVER['REQUEST_METHOD'];

		if (isset($this->route['id'])) {
			$id = $this->route['id'];
		}
		
		if ($method === 'GET') {
			if (isset($id)) {
				$post = $this->model->getPost($id);
				$comment = $this->model->getComent($id);
				$vars = [
					'posts' => $post,
					'comments' => $comment,
				];
				$this->view->render('Fullpost', $vars);
			}else{
				$this->model->getPosts();	
			}

		} elseif ($method === 'POST'){

			$this->model->addPost($_POST);

		}elseif ($method === 'DELETE') {
			
			if(isset($id)){
				$this->model->deletePost($id);
			}
	
		}

	}  	

}