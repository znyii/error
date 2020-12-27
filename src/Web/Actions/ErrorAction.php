<?php

namespace ZnYii\Error\Web\Actions;

use ZnCore\Domain\Helpers\EntityHelper;
use ZnYii\Error\Domain\Helpers\MessageHelper;

class ErrorAction extends \yii\web\ErrorAction
{
	
	protected function getViewRenderParams()
	{
	    $errorEntity = MessageHelper::get($this->exception);
		return EntityHelper::toArray($errorEntity);
	}
}
