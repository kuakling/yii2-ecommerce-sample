<?php

namespace backend\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;
use \yii\web\UploadedFile;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\FileHelper;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $title
 * @property integer $category_id
 * @property string $detail
 * @property double $price
 * @property double $balance
 * @property integer $status
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 */
class Product extends \yii\db\ActiveRecord
{
    const STATUS_YES = 1;
    const STATUS_NO = 0;
    
    public $upload_foler ='image_product';
    
    public $image = null;
    public $photos = null;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
            ],
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'category_id', 'status'], 'required'],
            [['category_id', 'status', 'created_by', 'updated_by'], 'integer'],
            [['detail'], 'string'],
            [['price', 'balance'], 'number'],
            [['title'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'string', 'max' => 11],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'ชื่อสินค้า',
            'category_id' => 'หมวดหมู่',
            'detail' => 'รายละเอียด',
            'price' => 'ราคา/หน่วย',
            'balance' => 'คงเหลือ',
            'image' => 'ภาพสินค้า',
            'photos' => 'ภาพสินค้าทั้งหมด',
            'status' => 'สถานะ',
            'created_at' => 'Created At',
            'created_by' => 'Created By',
            'updated_at' => 'Updated At',
            'updated_by' => 'Updated By',
        ];
    }
    
    public static function getStatuses()
    {
        return [
            self::STATUS_YES => 'Yes',
            self::STATUS_NO => 'No',
        ];
    }
    
    public function getStatusText()
    {
        $statuses = self::getStatuses();
        
        return array_key_exists($this->status, $statuses) ? $statuses[$this->status] : null;
    }
    
    public function getCategory()
    {
        return $this->hasOne(ProductCategory::className(), ['id' => 'category_id']);
    }
    
    
    
    
    public function upload($model,$attribute)
    {
        $image  = UploadedFile::getInstance($model, $attribute);
        $path = $this->getUploadPath();
        if ($image !== null) {
            $fileName = $model->id . '.' . $image->extension;
            if($image->saveAs($path.$fileName)){
              return $fileName;
            }else{
            }
        }
        return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }
    
    public function getUploadPath(){
      return Yii::getAlias('@uploads').'/'.$this->upload_foler.'/';
    }
    
    public function getUploadUrl(){
      return '/uploads/'.$this->upload_foler.'/';
    }
    
    public function getImageViewer(){
        $imageName = $this->id . '.jpg';
        return is_file($this->getUploadPath() . $imageName) ? $this->getUploadUrl() . $imageName : '/media/images/no-image.jpg';
    }
    
    public function getImageInitialPreview()
    {
        if($this->isNewRecord) return [];
        
        $imageName = $this->id . '.jpg';
        return is_file($this->getUploadPath() . $imageName) ? [$this->getUploadUrl() . $imageName] : [];
    }
    
    public function getImageInitialConfig()
    {
        $imageName = $this->id . '.jpg';
        return is_file($this->getUploadPath() . $imageName) ? [[
            'caption' => $imageName,
            'size' => filesize($this->getUploadPath() . $imageName),
            'url' => Url::to(['delete-image', 'id' => 1]),
        ]] : [];
    }
    
    
    
    
    
    
    
    
    
    public function uploadMultiple($model,$attribute)
    {
      $photos  = UploadedFile::getInstances($model, $attribute);
      $path = $this->getUploadPath() . $model->id . '/';
      if(!is_dir($path)) {mkdir($path);}
      if ($photos !== null) {
          $filenames = [];
          foreach ($photos as $file) {
                  $filename =  md5($file->baseName.time()) . '.' . $file->extension;
                  if($file->saveAs($path . $filename)){
                    $filenames[] = $filename;
                  }
          }
          if($model->isNewRecord){
            return implode(',', $filenames);
          }else{
            return implode(',',(ArrayHelper::merge($filenames,$model->getOwnPhotosToArray())));
          }
      }

      return $model->isNewRecord ? false : $model->getOldAttribute($attribute);
    }
    
    public function getPhotosInitialPreview()
    {
        if($this->isNewRecord) return [];
        
        $path = $this->getUploadPath() . $this->id . '/';
        $photos = is_dir($path) ? FileHelper::findFiles($path, ['only'=>['*.jpg']]) : [];
        
        $urlPhotos = [];
        foreach($photos as $photo) {
            $urlPhotos[] = $this->getUploadUrl() . $this->id . '/' . basename($photo);
        }
        
        return $urlPhotos;
    }
    
    public function getPhotosInitialConfig()
    {
        $path = $this->getUploadPath() . $this->id . '/';
        $photos = FileHelper::findFiles($path, ['only'=>['*.jpg']]);
        
        $cfgPhotos = [];
        foreach($photos as $photo) {
            $cfgPhotos[] = [
                'caption' => basename($photo),
                'size' => filesize($photo),
                'url' => Url::to(['delete-photo', 'id' => $this->id, 'name' => basename($photo)]),
            ];
        }
        
        return $cfgPhotos;
    }
    

    public function getOwnPhotosToArray()
    {
      return $this->getOldAttribute('photos') ? @explode(',',$this->getOldAttribute('photos')) : [];
    }
}
