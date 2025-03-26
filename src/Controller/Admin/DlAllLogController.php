<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

use Cake\Core\Configure;
use Cake\I18n\DateTime;
use Cake\Utility\Filesystem;


class DlAllLogController  extends AppController
{

    public $ChatLogWarehouses = null;

    public function initialize(): void
    {
        parent::initialize();

        $this->ChatLogWarehouses = $this->fetchTable('ChatLogWarehouses');
    }

    public function outputChatLog()
    {
        ini_set('memory_limit', PHP_MEMORY_LIMIT);

        $filesystem = new Filesystem();

        $logfilePath = ROOT .Configure::read('Site.logfilepath');

        $ids = $this->ChatLogWarehouses->find('list', [
                'fields' => ['id'],
        ])->toArray();

        $count = 0;
        foreach ($ids as $id) {
            $chatLogWarehouse = $this->ChatLogWarehouses->get($id);

            $time = DateTime::parse($chatLogWarehouse->created);
            $chatroom = h($chatLogWarehouse->chat_room_title);
            $logfileName = $time->format('Ymd_His_') .trim($chatroom) .'.html';
            $logfile = $logfilePath .$logfileName;
            $tmplogs = (string)$chatLogWarehouse->logs;

            if (file_exists($logfile)) {
                // メモリ開放用
                unset($chatLogWarehouse);
                continue;
            }

            // ログ出力
            $filesystem->dumpFile($logfile, $tmplogs);

            // メモリ開放用
            unset($chatLogWarehouse);

            $count = $count + 1;
        }

        if($count > 0) {
            $resultMessage = $logfilePath .'に' .$count .'件のログを出力しました。';
        } else {
            $resultMessage = $logfilePath .'には既にDB内のログが全て出力されています。';
        }
        $this->Flash->success(__($resultMessage));


        $this->redirect(['controller' => 'Pages', 'action' => 'index']);
    }
}
