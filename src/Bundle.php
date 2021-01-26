<?php

namespace ZnYii\Error;

use ZnCore\Base\Libs\App\Base\BaseBundle;

class Bundle extends BaseBundle
{

    public function yiiAdmin(): array
    {
        return [
            'modules' => [
                'error' => 'ZnYii\Error\Admin\Module',
            ],
            'components' => [
                'errorHandler' => [
                    'errorAction' => 'error/error/error',
                ],
            ],
        ];
    }

    public function yiiWeb(): array
    {
        return [
            'modules' => [
                'error' => 'ZnYii\Error\Web\Module',
            ],
            'components' => [
                'errorHandler' => [
                    'errorAction' => 'error/error/error',
                ],
            ],
        ];
    }

    public function i18next(): array
    {
        return [
            'error' => 'vendor/znyii/error/src/Domain/i18next/__lng__/__ns__.json',
        ];
    }

    public function migration(): array
    {
        return [

        ];
    }

    public function container(): array
    {
        return [

        ];
    }
}
