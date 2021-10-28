<?php

return [
//AuthController

	'register' => [
		'controller' => 'auth',
		'action' => 'register',
	],

	'enter' => [
		'controller' => 'auth',
		'action' => 'enter',
	],

//ApiController

	'receivedApi' => [
		'controller' => 'api',
		'action' => 'receivedApi',
	],

	'shareApi' => [
		'controller' => 'api',
		'action' => 'shareApi',
	],

	'shareApi/{id:\d+}' => [
		'controller' => 'api',
		'action' => 'shareApi',
	],


//MainController

	'' => [
		'controller' => 'main',
		'action' => 'post',
	],

	'fullpost' => [
		'controller' => 'main',
		'action' => 'fullpost',
	],

	'like' => [
		'controller' => 'main',
		'action' => 'like',
	],

	'coment' => [
		'controller' => 'main',
		'action' => 'coment',
	],

	'exit' => [
		'controller' => 'main',
		'action' => 'exit',
	],

//UserController

	'account/addpost' => [
		'controller' => 'user',
		'action' => 'addpost',
	],

	'account/editpost' => [
		'controller' => 'user',
		'action' => 'editpost',
	],

	'account/fullpost' => [
		'controller' => 'user',
		'action' => 'fullpost',
	],

	'account/myposts' => [
		'controller' => 'user',
		'action' => 'myposts',
	],
	'account/deletepost' => [
		'controller' => 'user',
		'action' => 'deletepost',
	],

	'account/buttonedit' => [
		'controller' => 'user',
		'action' => 'buttonedit',
	],

//AdminCotroller

	'admin/login' => [
		'controller' => 'admin',
		'action' => 'login',
	],

	'admin/logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],

	'admin/add' => [
		'controller' => 'admin',
		'action' => 'add',
	],

	'admin/edit' => [
		'controller' => 'admin',
		'action' => 'edit',
	],

	'admin/enter_edit' => [
		'controller' => 'admin',
		'action' => 'enter_edit',
	],

	'admin/button_enter_edit' => [
		'controller' => 'admin',
		'action' => 'button_enter_edit',
	],

	'admin/delete' => [
		'controller' => 'admin',
		'action' => 'delete',
	],

	'admin/deleteComment' => [
		'controller' => 'admin',
		'action' => 'deleteComment',
	],

	'admin/delete_button' => [
		'controller' => 'admin',
		'action' => 'delete_button',
	],

	'admin/post' => [
		'controller' => 'admin',
		'action' => 'admin_post',
	],

	'admin/text_post' => [
		'controller' => 'admin',
		'action' => 'text_post',
	],



];

