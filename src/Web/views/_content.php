<?php

/* @var $this yii\web\View
 * @var $exception Exception
 * @var $name string
 * @var $message string */

?>

<div class="alert alert-danger">
    <?= nl2br($message) ?>
</div>

<div class="float-left">

    <a class="btn btn-primary" href="#" onclick="window.history.go(-1); return false;" role="button">
        <i class="fas fa-arrow-left"></i>
        <?= \ZnCore\Base\Libs\I18Next\Facades\I18Next::t('core', 'action.back') ?>
    </a>
    <a class="btn btn-primary" href="<?= \yii\helpers\Url::base() ?: '/' ?>" role="button">
        <i class="fas fa-home"></i>
        <?= \ZnCore\Base\Libs\I18Next\Facades\I18Next::t('core', 'action.home') ?>
    </a>

    <?php if(
        $exception instanceof \ZnCore\Base\Exceptions\NotFoundException ||
        $exception instanceof \yii\web\NotFoundHttpException ||
        $exception instanceof \yii\web\ForbiddenHttpException
    ): ?>

    <?php endif; ?>

    <?php if($exception instanceof \yii\web\UnauthorizedHttpException): ?>
        <a class="btn btn-primary" href="<?= \yii\helpers\Url::to(Yii::$app->user->loginUrl) ?>" role="button">
            <i class="fas fa-sign-in-alt"></i>
            <?= \ZnCore\Base\Libs\I18Next\Facades\I18Next::t('core', 'action.sign_in') ?>
        </a>
    <?php endif; ?>

</div>