<?php
declare(strict_types=1);

namespace App\Controller;

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
            ->order(['id' => 'DESC']);
        $chatLogWarehouses = $this->paginate($chatLogWarehouses);

        $this->set(compact('chatLogWarehouses'));
    }

    public function topListTable()
    {
        $chatLogWarehouses = $this->ChatLogWarehouses->find()
            ->select([
              'ChatLogWarehouses.id',
              'ChatLogWarehouses.created',
              'ChatLogWarehouses.chat_room_title',
              'ChatLogWarehouses.characters'
            ])
            ->order(['id' => 'DESC'])
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
}
