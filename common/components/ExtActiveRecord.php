<?php


namespace common\components;

use yii;

class ExtActiveRecord extends \yii\db\ActiveRecord
{
    public static function exportAsCSV($models, $filename = null, $exclude = []){

        $data = "";

        $instance = self::instance();

        if($filename == null){
            $filename = "export_" . date('d.m.Y') . ".csv";
        }

        $attr_count = 0;

        $attributes = $instance->attributes;

        foreach ($attributes as $key => $value) {
            if(!in_array($key, $exclude)) {
                $data .= $instance->getAttributeLabel($key);

                if (count($attributes) > ++$attr_count) {

                    $data .= ",";

                }
            }

        }

        $data .= "\r\n";

        /* header section EOL */
        if(count($models) >0) {

            foreach ($models as $record) {

                $attributes = $record->getAttributes();

                $row_attr_count = 0;

                foreach ($attributes as $key => $value) {
                    $data .= $value;

                    if (count($attributes) > ++$row_attr_count) {

                        $data .= ",";

                    }
                }
                $data .= "\r\n";
            }
        }

        header('Content-type: text/csv');

        header('Content-Disposition: attachment; filename="'.$filename.'"');

        echo iconv('windows-1251', 'utf-8', $data);

        Yii::$app->end();

    }
}