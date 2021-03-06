<?php

use app\models\Tag;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Article */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Articles', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="article-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Set Image', ['set-image', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Set Category', ['set-category', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
        <?= Html::a('Set Tag', ['set-tag', 'id' => $model->id], ['class' => 'btn btn-secondary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'description:ntext',
            'content:ntext',
            'created_at',
            'image',
            'viewed',
            'user_id',
            'status',
            [
                'label' => 'Категория',
                'value' => $model->category->title ?? 'Нет категории',
            ],
            [
                'label' => 'Теги',
                'value' => function ($model){
                    if (!empty($model->tags)){
                        foreach($model->tags as $tagId)
                        {

                            $item[] = Tag::findOne($tagId)->title ?? 'Нет выбранных тегов';
                        }
                        return implode(', ', $item);
                    }else{
                        return 'Нет выбранных тегов';
                    }
                }
            ],
        ],
    ]) ?>

</div>
