<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Utility\Filesystem;

/**
 * ChatLogWarehouses Controller
 *
 * @property \App\Model\Table\ChatLogWarehousesTable $ChatLogWarehouses
 * @method \App\Model\Entity\ChatLogWarehouse[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChatLogWarehousesController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $chatLogWarehouses = $this->ChatLogWarehouses->find()
            ->select(['id', 'entry_key', 'chat_room_title', 'characters', 'modified', 'created'])
            ->orderBy(['id' => 'DESC']);
        $chatLogWarehouses = $this->paginate($chatLogWarehouses);

        $this->set(compact('chatLogWarehouses'));
    }

    public function topListTable()
    {
        $this->viewBuilder()->disableAutoLayout();
        $chatLogWarehouses = $this->ChatLogWarehouses->find()
            ->select([
                'ChatLogWarehouses.id',
                'ChatLogWarehouses.created',
                'ChatLogWarehouses.chat_room_title',
                'ChatLogWarehouses.characters'
            ])
            ->orderBy(['id' => 'DESC'])
            ->limit(3);
        $this->set(compact('chatLogWarehouses'));
    }

    public function dl($id = null)
    {
        ini_set('memory_limit', PHP_MEMORY_LIMIT);

        $this->autoRender = false;

        $chatLogWarehouses = $this->ChatLogWarehouses->get($id);

        $response = $this->response;
        $response = $response->withType('text/html')
            ->withStringBody($chatLogWarehouses->logs);
        return $response;
    }

    private function createLocalIndex()
    {
        ini_set('memory_limit', PHP_MEMORY_LIMIT);

        $this->autoRender = false;
        $this->viewBuilder()->disableAutoLayout();

        $chatLogWarehouses = $this->ChatLogWarehouses->find()
            ->select(['id', 'chat_room_title', 'characters', 'created'])
            ->orderBy(['id' => 'DESC']);

        $this->set('chatLogWarehouses', $chatLogWarehouses);
        $dlListHtml = (string)$this->render('dl_all_log_list')->getBody();

        $filesystem = new Filesystem();
        $logfilePath = ROOT .Configure::read('Site.logfilepath');
        $dlListFilePath = $logfilePath .'/' .'index.html';

        $filesystem->dumpFile($dlListFilePath, $dlListHtml);

        return [$dlListFilePath, $dlListHtml];
    }

    public function dlLocalIndex()
    {
        ini_set('memory_limit', PHP_MEMORY_LIMIT);

        // 一覧ファイル出力
        [$dlListFilePath, $dlListHtml] = $this->createLocalIndex();

        // 成功
        $response = $this->response;
        $response = $response->withType('text/html')
            ->withStringBody($dlListHtml);
        return $response;
    }

    public function dlAllData()
    {
        ini_set('memory_limit', PHP_MEMORY_LIMIT);

        $this->autoRender = false;
        $this->viewBuilder()->disableAutoLayout();

        $filesystem = new Filesystem();
        $logfilePath = ROOT .Configure::read('Site.logfilepath');

        $zipFileName = Configure::read('Site.logzipname');
        $zipFilePath = ROOT .Configure::read('Site.logzippath');
        $zipFile = $zipFilePath .'/' .$zipFileName;

        // 一覧ファイル出力
        [$dlListFilePath, $dlListHtml] = $this->createLocalIndex();

        // Zipファイル作成
        $files = $filesystem->find($logfilePath, '/\.html$/');
        $zip = new \ZipArchive();

        if ($zip->open($zipFile, \ZipArchive::CREATE | \ZIPARCHIVE::OVERWRITE) !== true) {
            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '500', 'message' => 'Failed zip open.']));
            return $response;
        }

        foreach ($files as $fileObj) {
            if (!$fileObj->isFile()) {
                continue;
            }
            if ($zip->locateName($fileObj->getFilename()) !== false) {
                continue;
            }
            if (!$zip->addFile($fileObj->getPathname(), $fileObj->getFilename())) {
                $response = $this->response;
                $response = $response->withType('application/json')
                    ->withStringBody(json_encode(['code' => '500', 'message' => 'Failed zip close.']));
                return $response;
            }
        }

        if (!$zip->close()) {
            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '500', 'message' => 'Failed zip close.']));
            return $response;
        }

        // 成功
        $response = $this->response;
        $response = $response->withType('zip');
        $response = $response->withFile($zipFile, [
            'download' => true,
            'name' => $zipFileName,
        ]);
        return $response;
    }
}
