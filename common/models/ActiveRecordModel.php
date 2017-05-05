<?php
/**
 * Created by PhpStorm.
 * User: Freedom
 * Date: 12/03/2017
 * Time: 12:04
 */
namespace common\models;

use common\components\helpers\DateTimeHelper;
use DateTime;
use Yii;
use yii\db\ActiveRecord;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

/**
 * This is the base model class
 */
class ActiveRecordModel extends ActiveRecord
{
    #region Statuses
    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    // const STATUS_PENDING = 20;
    #endregion

    const SCENARIO_UPDATE = 'update';
    const SCENARIO_REST_UPDATE = 'update-rest';

    /*
     * @var String[]
     */
    public $dateAttributes = [];

    public function scenarios()
    {
        $scenarios = parent::scenarios();
        $scenarios[self::SCENARIO_UPDATE] = array_keys($this->getAttributes());
        $scenarios[self::SCENARIO_REST_UPDATE] = array_keys($this->getAttributes());
        return $scenarios;
    }

    #region Events
    /**
     * @inheritdoc
     */
    public function beforeSave($insert) {
        if(parent::beforeSave($insert)){
            if($this->hasAttribute('created_at') && $this->hasAttribute('updated_at')) {
                if ($this->isNewRecord) {
                    $this->created_at = (new DateTime())->getTimestamp();
                }
                $this->updated_at = (new DateTime())->getTimestamp();
            }
            foreach ($this->dateAttributes as $dateAttribute) {
                $this->$dateAttribute = DateTimeHelper::convert(
                    $this->$dateAttribute,
                    'd/m/Y',
                    'Y-m-d',
                    DateTimeHelper::TYPE_DATE
                );
            }
            return true;
        }else{
            return false;
        }
    }

    /**
     * @inheritdoc
     */
    public function afterFind() {
        parent::afterFind();
        foreach ($this->dateAttributes as $dateAttribute) {
            $this->$dateAttribute = DateTimeHelper::convert(
                $this->$dateAttribute,
                'Y-m-d',
                'd/m/Y',
                DateTimeHelper::TYPE_DATE
            );
        }
    }
    #endregion

    #region Listing
    /**
     * @param array|string $where
     * @param array $orderBy
     * @param string $idProperty
     * @param string $nameProperty
     * @param string $firstEmptyLabel
     * @param string $firstEmptyValue
     *
     * @return array
     */
    public static function getDefaultListing(
        $where = [],
        $orderBy = ['name' => SORT_ASC],
        $idProperty = 'id',
        $nameProperty = 'name',
        $firstEmptyLabel = '',
        $firstEmptyValue=''
    )
    {
        if (!is_array($orderBy)) {
            $orderBy = [];
        }

        $items = static::find()->where($where)->orderBy($orderBy)->asArray()->all();
        $selectedIndex = null;

        $realItems = [];

        if (!empty($firstEmptyLabel)) {
            $realItems[$firstEmptyValue] = $firstEmptyLabel;
        }

        return ArrayHelper::merge($realItems, ArrayHelper::map($items, $idProperty, $nameProperty));
    }
    #endregion

    #region Status
    /**
     * Returns the status.
     *
     * @param $id integer Status Code
     *
     * @return string Status Label
     */
    public static function getStatusById($id)
    {
        switch ((int)$id) {
            case self::STATUS_DELETED: {
                return 'Inativo';
            }

            case self::STATUS_ACTIVE: {
                return 'Ativo';
            }

            case self::STATUS_PENDING: {
                return 'Pendente';
            }
            default: {
                return '-';
            }
        }
    }

    /**
     * Returns the Status listing
     *
     * @return array
     */
    public static function getStatusList()
    {
        return [
            self::STATUS_DELETED => self::getStatusById(self::STATUS_DELETED),
            self::STATUS_ACTIVE   => self::getStatusById(self::STATUS_ACTIVE),
            // self::STATUS_PENDING   => self::getStatusById(self::STATUS_PENDING),
        ];
    }

    /**
     * @return array
     */
    public static function getStatusRange()
    {
        $items = self::getStatusList();
        $range = [];

        foreach ($items as $key => $value) {
            $range[] = $key;
        }

        return $range;
    }
    #endregion
}