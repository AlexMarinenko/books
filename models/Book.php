<?php

namespace app\models;

use Imagine\Image\ManipulatorInterface;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\web\UploadedFile;
use yii\imagine\Image;

/**
 * This is the model class for table "books".
 *
 * @property integer $id
 * @property string $name
 * @property string $date_create
 * @property string $date_update
 * @property string $preview
 * @property string $date_published
 * @property integer $author_id
 *
 * @property Authors $author
 */
class Book extends \yii\db\ActiveRecord
{

    /**
     * @var UploadedFile
     */
    public $previewFile;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'books';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'author_id'], 'required'],
            [['date_create', 'date_update', 'date_published'], 'safe'],
            [['author_id'], 'integer'],
            [['name', 'preview'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'date_create' => 'Date Create',
            'date_update' => 'Date Update',
            'preview' => 'Preview',
            'date_published' => 'Date Published',
            'author_id' => 'Author',
        ];
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'date_create',
                'updatedAtAttribute' => 'date_update',
                'value' => new Expression('NOW()'),
            ],
        ];
    }

    public function getIcon(){
        return '/uploads/thumbs/' . $this->preview;
    }

    public function getFullImage(){
        return '/uploads/' . $this->preview;
    }

    public function removeOldPreviews(){
        if ($this->preview){
            @unlink(getcwd() . '/uploads/' . $this->preview);
            @unlink(getcwd() . '/uploads/thumbs/' . $this->preview);
        }
    }

    public function upload()
    {
        if ($this->validate()) {
            if ($this->previewFile){
                $this->removeOldPreviews();
                $this->preview = uniqid($this->previewFile->baseName) . '.' . $this->previewFile->extension;
                $this->previewFile->saveAs('uploads/' . $this->preview);
                Image::thumbnail('uploads/' . $this->preview, 100, 100, ManipulatorInterface::THUMBNAIL_OUTBOUND)
                    ->save('uploads/thumbs/' . $this->preview, ['quality' => 50]);
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }
}
