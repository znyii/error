<?php

/* @var $this yii\web\View
 * @var $exception Exception
 * @var $name string
 * @var $message string */

$this->title = $name;

?>

<div class="error">

	<h1>
		<?= $name ?>
	</h1>

    <?= $this->renderPhpFile(__DIR__ . '/../../../Web/views/_content.php', [
        'exception' => $exception,
        'name' => $name,
        'message' => $message,
    ]) ?>

</div>
