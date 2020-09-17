<?php

namespace ZnYii\Error\Web\controllers;

use yii\web\Controller;

class ErrorController extends Controller
{

	public function actions()
	{
		return [
			'error' => [
				'class' => 'ZnYii\Error\Web\Actions\ErrorAction',
			],
		];
	}
}
