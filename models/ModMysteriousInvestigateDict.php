<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tblMysteriousInvestigateDict".
 *
 * @property integer $ID
 * @property string $name
 * @property integer $key
 * @property string $content
 */
class ModMysteriousInvestigateDict extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tblMysteriousInvestigateDict';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'key', 'content'], 'required'],
            [['key'], 'integer'],
            [['name', 'content'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'ID' => 'ID',
            'name' => 'Name',
            'key' => 'Key',
            'content' => 'Content',
        ];
    }
}
