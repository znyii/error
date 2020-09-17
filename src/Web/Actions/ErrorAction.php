<?php

namespace ZnYii\Error\Web\Actions;

use ZnYii\Error\Domain\Helpers\MessageHelper;

class ErrorAction extends \yii\web\ErrorAction
{
	
	protected function getViewRenderParams()
	{
		return MessageHelper::get($this->exception);
	}
}
