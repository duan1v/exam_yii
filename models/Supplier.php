<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "supplier".
 *
 * @property int $id
 * @property string $name
 * @property string|null $code
 * @property string $t_status
 *
 */
class Supplier extends \yii\db\ActiveRecord
{
    /**
     * $t_status的枚举值数组
     */
    const T_STATUS_LIST = [
        'ok',
        'hold'
    ];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'supplier';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['t_status'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['code'], 'string', 'max' => 3],
            [['code'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'       => 'ID',
            'name'     => 'Name',
            'code'     => 'Code',
            't_status' => 'T Status',
        ];
    }

    /**
     * @param string $column 字段
     * @param string|mixed $value 字段对应的值，不指定则返回字段数组
     * @return bool|mixed|array 返回某个值或者数组
     */
    public static function dropDown($column, $value = null)
    {
        $dropDownList = [
            "t_status" => [
                "0"    => "all",
                "ok"   => "ok",
                "hold" => "hold",
            ],
        ];
        if ($value !== null) {
            //根据具体值显示对应的值
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column][$value] : false;
        } else {
//            返回关联数组，用户下拉的filter实现
            return array_key_exists($column, $dropDownList) ? $dropDownList[$column] : false;
        }
    }
}
