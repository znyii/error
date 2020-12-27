<?php

namespace ZnYii\Error\Admin\controllers;

use yii\web\Controller;
use ZnYii\Error\Web\Actions\ErrorAction;

class ErrorController extends Controller
{

	public function actions()
	{
		return [
			'error' => [
				'class' => ErrorAction::class,
			],
		];
	}
}
