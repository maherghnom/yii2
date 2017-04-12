<?php

namespace frontend\models;

use Yii;
use frontend\models\Category;
use frontend\models\User;
use frontend\models\Tag;


/**
 * This is the model class for table "post".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $description
 * @property integer $cat_id
 *
 * @property User $user
 * @property Category $cat
 * @property PostTag[] $postTags
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'post';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'title', 'description', 'cat_id'], 'required'],
            [['user_id', 'cat_id'], 'integer'],
            [['title'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 250],
           
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'title' => 'Title',
            'description' => 'Description',
            'cat_id' => 'Cat ID',
            

        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCat()
    {
        return $this->hasOne(Category::className(), ['id' => 'cat_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPostTags()
    {
        return $this->hasMany(PostTag::className(), ['post_id' => 'id']);
    }

     public function getCateg()
    {
        return Category::find()->select('name')->indexBy('id')->column();
    }

     public function getTag()
    {
        return Tag::find()->select('name')->indexBy('id')->column();
    }
    public function relations()
        {
               
                return array(
                 'tag' => array(self::MANY_MANY, 'tag', 'post_tag(tag_id, post_id)'),
                );
        }
}
