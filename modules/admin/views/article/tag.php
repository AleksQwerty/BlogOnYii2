<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
/* @var $selectedCurrentTag app\modules\admin\controllers\ArticleController */
/* @var $tagList app\modules\admin\controllers\ArticleController */
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= Html::dropDownList('tag', $selectedCurrentTag, $tagList, ['class' => 'form-control', 'multiple' => true]) ?>
    <br>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
