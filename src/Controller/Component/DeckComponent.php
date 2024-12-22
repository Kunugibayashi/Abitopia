<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

use Cake\Core\Configure;

class DeckComponent extends Component
{
    /**
     * 保存時のデータ形式に変更する。
     * , の後に改行を入れる。
     */
    public function saveDataFormat($deckString)
    {
        if(is_null($deckString)){
            return "";
        }

        $deckArray = explode(',', $deckString);

        foreach ($deckArray as $key => $value) {
            $value = trim($value);

            $markArray = explode('#', $value);

            if (count($markArray) >= 2) {
                $deckArray[$key] = $markArray[0].'#'.$markArray[1];
            } else {
                $deckArray[$key] = '0#'.$markArray[0];
            }
        }
        $result = implode(",\n", $deckArray);

        return $result;
    }

    /**
     * 山札をひく
     */
    public function flip($deckString) {
        if(is_null($deckString)){
            return ["", "", "", ""];
        }

        $deckArray = explode(',', $deckString);

        // 改行コードを切り取る
        foreach ($deckArray as $key => $deckValue) {
            $deckValue = trim($deckValue);
            $deckArray[$key] = trim($deckValue);
        }

        // 表と裏の数をカウント
        $headArray = array();
        $tailArray = array();
        foreach ($deckArray as $key => $deckValue) {
            if(preg_match('/^0#.*/', $deckValue)){
                $tailArray[] = ['key' => $key, 'deckValue' => $deckValue];
            } else {
                $headArray[] = ['key' => $key, 'deckValue' => $deckValue];
            }
        }

        // 裏がゼロの場合はエラー
        if (count($tailArray) === 0) {
            return ["", "", "", ""];
        }

        // 山札を引く
        $randKey = array_rand($tailArray);
        $showTailArray = $tailArray[$randKey];
        $resultDeckText = preg_replace('/^0#/', '', $showTailArray['deckValue']);

        // 表にする
        $showTailArray['deckValue'] = preg_replace('/^0#/', '1#', $showTailArray['deckValue']);

        // 元の配列に戻す
        $deckArray[$showTailArray['key']] = $showTailArray['deckValue'];

        // 元の文字列に戻す
        $deckText = implode(",\n", $deckArray);

        return [$deckText , count($headArray), count($tailArray), $resultDeckText];
    }

    /**
     * 山札をリセット
     */
    public function reset($deckString) {
        if(is_null($deckString)){
            return [];
        }

        $deckArray = explode(',', $deckString);

        // 改行コードを切り取る
        foreach ($deckArray as $key => $deckValue) {
            $deckValue = trim($deckValue);
            $deckArray[$key] = trim($deckValue);
        }

        // リセットする
        $resetDeckText = array();
        foreach ($deckArray as $key => $deckValue) {
            $deckValueArray = explode('#', $deckValue);
            if (count($deckValueArray) >= 2) {
                $resetDeckText[] = '0#' .$deckValueArray[1];
            } else {
                // 正しい型でなければ全文を残す
                $resetDeckText[] = '0#' .$deckValueArray[0];
            }
        }

        // 元の文字列に戻す
        $resetDeckText = implode(",\n", $resetDeckText);

        return $resetDeckText;
    }

}
