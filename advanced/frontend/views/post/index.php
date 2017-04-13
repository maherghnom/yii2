<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
         [
        'attribute'=>'username',
        'value'=>'user.username',],
            'title',
            'description',
            ['attribute'=>'category','value'=>'cat.name',],

            ['attribute'=>'tag','value'=> function($model) {
                    return implode(', ', ArrayHelper::map($model->postTags, 'tag_id', 'tag.name'));
                }],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
