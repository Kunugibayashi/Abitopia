<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

class CheckFileComponent extends Component
{
    public function findChatRoomCss($chatRoomId)
    {
        $cssPath = WWW_ROOT . 'css/room/' .$chatRoomId .'.css';
        if (file_exists($cssPath)) {
            return 'room/' . $chatRoomId .'.css';
        }
        return null;
    }

    // ログ出力用にCSS内部文字列を取得。対応CSSを読み込み、アットルールを削除する。
    public function getChatRoomCssString($chatRoomId)
    {
        $cssPath = WWW_ROOT . 'css/room/' .$chatRoomId .'.css';
        if (file_exists($cssPath)) {
            $cssString = file_get_contents($cssPath);

            // 画像ファイルは表示されないため削除
            $cssString = preg_replace("/(.*?)\.png(.*?)\r\n/i", '', $cssString);
            $cssString = preg_replace("/(.*?)\.png(.*?)\n/i", '', $cssString);
            $cssString = preg_replace("/(.*?)\.png(.*?)\r/i", '', $cssString);

            $cssString = preg_replace("/(.*?)\.jpg(.*?)\r\n/i", '', $cssString);
            $cssString = preg_replace("/(.*?)\.jpg(.*?)\n/i", '', $cssString);
            $cssString = preg_replace("/(.*?)\.jpg(.*?)\r/i", '', $cssString);

            $cssString = preg_replace("/(.*?)\.jpeg(.*?)\r\n/i", '', $cssString);
            $cssString = preg_replace("/(.*?)\.jpeg(.*?)\n/i", '', $cssString);
            $cssString = preg_replace("/(.*?)\.jpeg(.*?)\r/i", '', $cssString);

            $cssString = preg_replace("/(.*?)\.gif(.*?)\r\n/i", '', $cssString);
            $cssString = preg_replace("/(.*?)\.gif(.*?)\n/i", '', $cssString);
            $cssString = preg_replace("/(.*?)\.gif(.*?)\r/i", '', $cssString);

            $cssString = preg_replace("/(.*?)\.tiff(.*?)\r\n/i", '', $cssString);
            $cssString = preg_replace("/(.*?)\.tiff(.*?)\n/i", '', $cssString);
            $cssString = preg_replace("/(.*?)\.tiff(.*?)\r/i", '', $cssString);

            $cssString = preg_replace("/(.*?)\.webp(.*?)\r\n/i", '', $cssString);
            $cssString = preg_replace("/(.*?)\.webp(.*?)\n/i", '', $cssString);
            $cssString = preg_replace("/(.*?)\.webp(.*?)\r/i", '', $cssString);

            $cssString = preg_replace("/(.*?)\.svg(.*?)\r\n/i", '', $cssString);
            $cssString = preg_replace("/(.*?)\.svg(.*?)\n/i", '', $cssString);
            $cssString = preg_replace("/(.*?)\.svg(.*?)\r/i", '', $cssString);

            // アットルール複数行削除
            $cssString = preg_replace("/@(.*)\{([\s\S]*?)\}/m", '', $cssString);

            // アットルール一行削除
            $cssString = preg_replace("/@(.*);/", '', $cssString);
            $cssString = preg_replace("/@(.*)\r\n/", '', $cssString);
            $cssString = preg_replace("/@(.*)\n/", '', $cssString);
            $cssString = preg_replace("/@(.*)\r/", '', $cssString);

            // 空白行削除
            $cssString = preg_replace("/^\r\n/m", '', $cssString);
            $cssString = preg_replace("/^\n/m", '', $cssString);
            $cssString = preg_replace("/^\r/m", '', $cssString);

            return $cssString;
        }
        return "";
    }
}
