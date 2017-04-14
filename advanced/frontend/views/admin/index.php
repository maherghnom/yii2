
<h1>Admin</h1>


<?php

use yii\helpers\Html;
use yii\helpers\ArrayHelper;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel frontend\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$duplicates = [];
foreach ($dataArray as $key => $post) {
    foreach ($dataArray as $key2 => $post2) {
        if($post['title'] == $post2['title'] && $key != $key2){
            $duplicates[] = $post;
            
        }
    }
}

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">
    <h1>Duplicated post</h1>

    <table class="table table-hover">
  	<tr>
  		<td>
  			Post Id
  		</td>
  		<td>
  			Post Title
  		</td>
  		<td>
  			Post Description
  		</td>
  	</tr>
	
    <?php foreach ($duplicates as $post) {
        echo 	"<tr>
  		<td>".
  			$post['id']
  		."</td>
  		<td>".
  			$post['title']
  		."</td>
  		<td>".
  			$post['description']
  		."</td>
  	</tr>"; 

        
    }
    ?>
    </table>
 
 

<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   
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
        'description:ntext',
        ['attribute'=>'category','value'=>'cat.name',],
        ['attribute'=>'tag','value'=> function($data) {
                    return implode(', ', ArrayHelper::map($data->postTags, 'tag_id', 'tag.name'));
                }],
        ['class' => 'yii\grid\ActionColumn'],

        ],
        ]); ?>
    </div>
