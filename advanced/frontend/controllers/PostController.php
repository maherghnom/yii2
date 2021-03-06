<?php

namespace frontend\controllers;

use Yii;
use frontend\models\Post;
use frontend\models\Tag;
use frontend\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use frontend\models\PostTag;
use yii\data\ActiveDataProvider;
use yii\db\Query;


/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
{
    public $dd;
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PostSearch();
        $dataProvider = $dataProvider = new ActiveDataProvider([
                'query' => Post::find()->with('postTags')->orderBy(
                    'id DESC'),
            ]);

        $dataArray = Post::find()->select('title, description')
        ->asArray()->all(); 

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'dataArray' => $dataArray,
        ]);
    }

    /**
     * Displays a single Post model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => Post::find()->where(['id'=>$id])->with('cat')->one(),
        ]);
    }

    /**
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
       if (Yii::$app->user->isGuest) {
            return $this->redirect(['/site/login']);
        }
        $model = new Post();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
             $request = Yii::$app->request->post('Post');
               foreach ($request['tag'] as $tag_id) {
                $newTag = new PostTag();
                $newTag->post_id = $model->id;
                $newTag->tag_id = $tag_id;
                $newTag->save();
            }
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Post model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Post model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
           //$request = Yii::$app->request->delete('Post');
       // DELETE FROM post_tag WHERE `post_id` = '$id'


    (new Query)
     ->createCommand()
     ->delete('post_tag', ['post_id' => $id])
     ->execute();

        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
