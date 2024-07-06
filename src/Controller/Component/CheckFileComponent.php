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
}
