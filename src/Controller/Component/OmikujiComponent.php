<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

use Cake\Core\Configure;

class OmikujiComponent extends Component
{
    /**
     * 保存時のデータ形式に変更する。
     * , の後に改行を入れる。
     */
    public function saveDataFormat($omikujiString)
    {
        if(is_null($omikujiString)){
            return "";
        }

        $omikujiTmpArray = explode(',', $omikujiString);

        foreach ($omikujiTmpArray as $key => $value) {
            $omikujiTmpArray[$key] = trim($value);
        }
        $result = implode(",\n", $omikujiTmpArray);

        return $result;
    }

    /**
     * おみくじをひく
     */
    public function draw($omikujiString) {
        if(is_null($omikujiString)){
            return ["" , "", ""];
        }

        $omikujiArray = explode(',', $omikujiString);

        // 改行コードを切り取る
        foreach ($omikujiArray as $key => $value) {
            $value = rtrim($value);
            $value = trim($value);
            $omikujiArray[$key] = $value;
        }

        $cnt = count($omikujiArray);
        $me = mt_rand(1, $cnt);
        $text = $omikujiArray[$me - 1];

        return [$cnt , $me, $text];
    }
}
