<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;

/**
 * ChatMessageEdit Controller
 *
 * @method \App\Model\Entity\ChatMessageEdit[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChatMessageEditController extends AppController
{
    public $ChatEntries = null;
    public $ChatLogs = null;

    public function initialize(): void
    {
        parent::initialize();

        $this->ChatEntries = $this->fetchTable('ChatEntries');
        $this->ChatLogs = $this->fetchTable('ChatLogs');
    }


    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $userId = $this->Authentication->getIdentityData('id');

        $chatEntryKeys = $this->ChatEntries->find()
            ->select([
                'entry_key',
            ])
            ->where(['user_id' => $userId])
            ->enableHydration(false)
            ->distinct(['entry_key'])
            ->toArray();
        $chatCharacterIds = $this->ChatEntries->find()
            ->select([
                'chat_character_key' => 'chat_character_id',
            ])
            ->where(['user_id' => $userId])
            ->enableHydration(false)
            ->distinct(['chat_character_id'])
            ->toArray();

        if (!is_null($chatEntryKeys) && !is_null($chatCharacterIds)
            && count($chatEntryKeys) > 0 && count($chatCharacterIds) > 0
        ) {

            $chatLogs = $this->ChatLogs->find()
                ->where([
                    'OR' => $chatEntryKeys,
                ])
                ->where([
                    'OR' => $chatCharacterIds,
                ]);
            $string = $chatLogs->func()->left([
                'message' => 'identifier',
                '16' => 'literal',
            ]);
            $chatLogs
                ->select([
                    'id',
                    'fullname',
                    'messageLeft' => $string,
                    'created',
                ])
                ->order(['id' => 'DESC']);

            $chatCharacters = $this->paginate($chatLogs);
            $this->set(compact('chatLogs'));
            $this->set(compact('chatCharacters'));
        }
    }

    /**
     * Edit method
     *
     * @param string|null $id Chat Message Edit id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $userId = $this->Authentication->getIdentityData('id');

        $chatEntryKeys = $this->ChatEntries->find()
            ->select([
                'entry_key',
            ])
            ->where(['user_id' => $userId])
            ->enableHydration(false)
            ->distinct(['entry_key'])
            ->toArray();
        $chatCharacterIds = $this->ChatEntries->find()
            ->select([
                'chat_character_key' => 'chat_character_id',
            ])
            ->where(['user_id' => $userId])
            ->enableHydration(false)
            ->distinct(['chat_character_id'])
            ->toArray();

        if (!is_null($chatEntryKeys) && !is_null($chatCharacterIds)
            && count($chatEntryKeys) > 0 && count($chatCharacterIds) > 0
        ) {

            $chatLog = $this->ChatLogs->find()
                ->where(['id' => $id])
                ->where([
                    'OR' => $chatEntryKeys,
                ])
                ->where([
                    'OR' => $chatCharacterIds,
                ])
                ->first();

            if ($this->request->is(['patch', 'post', 'put'])) {
                $chatLog = $this->ChatLogs->patchEntity(
                    $chatLog,
                    $this->request->getData()
                );

                $connection = ConnectionManager::get('default');
                $connection->begin();

                if ($this->ChatLogs->save($chatLog)) {
                    $connection->commit();
                    $this->Flash->success(__('発言を編集しました'));

                    return $this->redirect(['action' => 'index']);
                }

                $connection->rollback();
                $this->Flash->error(__('発言編集に失敗しました。もう一度お試しください。'));
            }
            $this->set(compact('chatLog'));
        }
    }
}
