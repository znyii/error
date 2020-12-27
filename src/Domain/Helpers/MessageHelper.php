<?php

namespace ZnYii\Error\Domain\Helpers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Inflector;
use yii\web\HttpException;
use Exception;
//use yii2rails\domain\exceptions\UnprocessableEntityHttpException;
use ZnCore\Base\Enums\Http\HttpStatusCodeEnum;
use ZnCore\Base\Libs\I18Next\Facades\I18Next;
use ZnCore\Domain\Exceptions\UnprocessibleEntityException;
use ZnCore\Domain\Helpers\EntityHelper;
use ZnYii\Error\Domain\Entities\ErrorEntity;

class MessageHelper
{
	
	public static function get(Exception $exception): ErrorEntity {
        $errorEntity = new ErrorEntity();
        $errorEntity->setException($exception);

//        $message = self::getExceptionMessage($exception);

        /*if($exception instanceof UnprocessibleEntityException) {
            $translate['message'] = self::getUnprocessableEntityExceptionMessage($exception);
        }
        $translate = self::getTranslateByClassName($exception);
        if(!$translate) {
            $translate = self::getTranslateByStatusCode($exception);
        }
        $message = $exception->getMessage();
        if($message) {
            $translate['message'] = $message;
        }*/
//        $translate = self::getTranslate($exception);
//		$translate = self::normalizeTranslate($translate, $exception);

        //EntityHelper::setAttributes($errorEntity, $translate);

        $isInernalServerError =
            ($exception instanceof HttpException && $exception->statusCode >= HttpStatusCodeEnum::INTERNAL_SERVER_ERROR) ||
            !($exception instanceof HttpException);
        if(YII_ENV_PROD && $isInernalServerError) {
            $errorEntity->setName(I18Next::t('error', 'main.error_for_production.name'));
            $errorEntity->setMessage(I18Next::t('error', 'main.error_for_production.message'));
        } else {
            self::gettt($errorEntity);
        }
		return $errorEntity;
	}

	private static function getExceptionCode(Exception $exception)
	{
		if ($exception instanceof HttpException) {
			return $exception->statusCode;
		}
		return $exception->getCode();
	}

    private static function getTranslateByCode($code, string $name) {
        $key = 'main.' . $code . '.' . $name;
        $name = I18Next::t('error', $key);
        if($name == $key) {
            $name = null;
        }
        return $name;
    }

    private static function gettt(ErrorEntity $errorEntity)
    {
        $exception = $errorEntity->getException();
        $code = self::getExceptionCode($exception);
        $name = self::getTranslateByCode($code, 'name');
        if($name == null) {
            $name = I18Next::t('error', 'main.default_title');
        }
        $message = self::getTranslateByCode($code, 'message');
        if($message == null) {
            $message = $exception->getMessage();
        }
        if (YII_ENV_DEV) {
            $name .= " (#$code)";
        }
        $errorEntity->setName($name);
        $errorEntity->setMessage($message);
    }

	private static function getTranslateByClassName(Exception $exception) {
		$className = get_class($exception);
		$translate = I18Next::t('error', 'exceptions.' . $className);
		if(is_array($translate)) {
			return $translate;
		}
		return null;
	}

	private static function normalizeTranslate($translate, Exception $exception) {
		$translate['exception'] = $exception;
		if(empty($translate['name'])) {
			$translate['name'] = self::getExceptionName($exception);
		}
        if(empty($translate['message'])) {
            $translate['message'] = self::getExceptionMessage($exception);
        }
        return $translate;


		if(YII_ENV_PROD && !empty($translate) && empty($translate['message'])) {
			/** @var array $forProduction */
			$forProduction = I18Next::t('error', 'main.error_for_production');
			$translate = ArrayHelper::merge($translate, $forProduction);
		}
		if(empty($translate['message'])) {
			//$translate['message'] = $exception->getMessage();
		}
		return $translate;
	}

	private static function normalizeTranslateKey($translateKey) {
		$translateKey = Inflector::variablize($translateKey);
		$translateKey = Inflector::underscore($translateKey);
		return $translateKey;
	}
}
