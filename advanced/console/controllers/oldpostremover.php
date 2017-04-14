<?php 
namespace app\commands;
use yii\console\Controller;
use app\frontend\models\Post;

class OldPostsController extends Controller
{
    public function actionRemoveAllPosts()
    {   
    	//for demo usage 
        Post::deleteAll();
    }
}   
?>