<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Datasource\ConnectionManager;

/**
 * Messages Controller
 *
 * @property \App\Model\Table\MessagesTable $Messages
 * @method \App\Model\Entity\Message[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class MessagesController extends AppController
{
    public $Users = null;
    public $ChatCharacters = null;
    public $ReceivedMessages = null;
    public $SendMessages = null;

    public function initialize(): void
    {
        parent::initialize();

        $this->Users = $this->fetchTable('Users');
        $this->ChatCharacters = $this->fetchTable('ChatCharacters');
        $this->ReceivedMessages = $this->fetchTable('ReceivedMessages');
        $this->SendMessages = $this->fetchTable('SendMessages');
    }

    public function isCharacters()
    {
        $userId = $this->Authentication->getIdentityData('id');
        return $this->ChatCharacters->exists(['user_id' => $userId]);
    }

    public function getCharacterIds()
    {
        $userId = $this->Authentication->getIdentityData('id');
        $chatCharacters = $this->ChatCharacters->find()
            ->where(['user_id' => $userId]);
        $chatCharacters = $chatCharacters->toArray();
        $chatCharacterIds = array_column($chatCharacters, 'id');
        return $chatCharacterIds;
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $userId = $this->Authentication->getIdentityData('id');

        // 登録キャラがいない場合は表示しない
        if (!$this->isCharacters()) {
            $this->Flash->error(__('私書を受取可能なキャラクターが見つかりません。'));
            return $this->redirect(['controller' => '/', 'action' => 'index']);
        }
        $chatCharacterIds = $this->getCharacterIds();

        $receivedMessages = $this->ReceivedMessages->find()
            ->contain(['Users'])
            ->where(['user_id' =>  $userId])
            ->where(['chat_character_key IN ' =>  $chatCharacterIds])
            ->order(['ReceivedMessages.id' => 'DESC']);

        $sendMessages = $this->SendMessages->find()
            ->contain(['Users'])
            ->where(['user_id' =>  $userId])
            ->where(['chat_character_key IN ' =>  $chatCharacterIds])
            ->order(['SendMessages.id' => 'DESC']);

        $this->set(compact('receivedMessages'));
        $this->set(compact('sendMessages'));
    }

    public function receivedDelete($id = null)
    {
        $userId = $this->Authentication->getIdentityData('id');

        $this->request->allowMethod(['post', 'delete']);
        $receivedMessage  = $this->ReceivedMessages->find()
            ->contain(['Users'])
            ->where(['user_id' =>  $userId])
            ->where(['ReceivedMessages.id' => $id])
            ->first();
        if ($this->ReceivedMessages->delete($receivedMessage)) {
            $this->Flash->success(__('メッセージを削除しました。'));
        } else {
            $this->Flash->error(__('メッセージの削除に失敗しました。もう一度お試しください。'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function sendDelete($id = null)
    {
        $userId = $this->Authentication->getIdentityData('id');

        $this->request->allowMethod(['post', 'delete']);
        $sendMessage = $this->SendMessages->find()
            ->contain(['Users'])
            ->where(['user_id' =>  $userId])
            ->where(['SendMessages.id' => $id])
            ->first();
        if ($this->SendMessages->delete($sendMessage)) {
            $this->Flash->success(__('メッセージを削除しました。'));
        } else {
            $this->Flash->error(__('メッセージの削除に失敗しました。もう一度お試しください。'));
        }

        return $this->redirect(['action' => 'index']);
    }

    public function viewReceivedMessage($id = null)
    {
        $userId = $this->Authentication->getIdentityData('id');

        $receivedMessage = $this->ReceivedMessages->find()
            ->contain(['Users'])
            ->where(['user_id' =>  $userId])
            ->where(['ReceivedMessages.id' => $id])
            ->first();

        // 開封済みにする
        $receivedMessage->opend = 1;
        $this->ReceivedMessages->save($receivedMessage);

        $this->set('message', $receivedMessage);
        return $this->render('view');
    }

    public function dlReceivedMessage($id = null)
    {
        $this->viewBuilder()->disableAutoLayout();

        $userId = $this->Authentication->getIdentityData('id');

        $receivedMessage = $this->ReceivedMessages->find()
            ->contain(['Users'])
            ->where(['user_id' =>  $userId])
            ->where(['ReceivedMessages.id' => $id])
            ->first();

        $this->set('message', $receivedMessage);
        return $this->render('dl_message');
    }

    public function viewSendMessage($id = null)
    {
        $userId = $this->Authentication->getIdentityData('id');

        $sendMessage = $this->SendMessages->find()
            ->contain(['Users'])
            ->where(['user_id' =>  $userId])
            ->where(['SendMessages.id' => $id])
            ->first();

        $this->set('message', $sendMessage);
        return $this->render('view');
    }

    public function dlSendMessage($id = null)
    {
        $this->viewBuilder()->disableAutoLayout();

        $userId = $this->Authentication->getIdentityData('id');

        $sendMessage = $this->SendMessages->find()
            ->contain(['Users'])
            ->where(['user_id' =>  $userId])
            ->where(['SendMessages.id' => $id])
            ->first();

        $this->set('message', $sendMessage);
        return $this->render('dl_message');
    }

    public function send($id = null)
    {
        $userId = $this->Authentication->getIdentityData('id');

        // 登録キャラがいない場合は表示しない
        if (!$this->isCharacters()) {
            $this->Flash->error(__('指定キャラクターが存在しません。'));
            return $this->redirect(['action' => 'index']);
        }
        $chatCharacterIds = $this->getCharacterIds();

        $receivedMessage = $this->ReceivedMessages->newEmptyEntity();

        // 受信履歴
        $toCharacter = $this->ChatCharacters->get($id);
        $receivedMessage->set('chat_character_key', $toCharacter->id);
        $receivedMessage->set('chat_character_fullname', $toCharacter->fullname);

        if ($this->request->is('post')) {
            $fromCharacterId = $this->request->getData('from_chat_character_key');
            $fromCharacter = $this->ChatCharacters->find()
                ->where(['user_id' => $userId])
                ->where(['id' => $fromCharacterId])
                ->first();

            $receivedMessage->set('user_id', $toCharacter->user_id);
            $receivedMessage->set('from_chat_character_key', $fromCharacter->id);
            $receivedMessage->set('from_chat_character_fullname', $fromCharacter->fullname);
            $receivedMessage->set('title', $this->request->getData('title'));
            $receivedMessage->set('message', $this->request->getData('message'));

            // 送信履歴
            $sendMessage = $this->SendMessages->newEmptyEntity();
            $sendMessage->set('user_id', $userId);
            $sendMessage->set('chat_character_key', $receivedMessage->from_chat_character_key);
            $sendMessage->set('chat_character_fullname', $receivedMessage->from_chat_character_fullname);
            $sendMessage->set('to_chat_character_key', $receivedMessage->chat_character_key);
            $sendMessage->set('to_chat_character_fullname', $receivedMessage->chat_character_fullname);
            $sendMessage->set('title', $receivedMessage->title);
            $sendMessage->set('message', $receivedMessage->message);

            $connection = ConnectionManager::get('default');
            $connection->begin();

            $received = $this->ReceivedMessages->save($receivedMessage);
            $send = $this->SendMessages->save($sendMessage);

            if ($received && $send) {
                $connection->commit();
                $this->Flash->success(__('メッセージを送信しました。'));

                return $this->redirect(['action' => 'index']);
            }
            $connection->rollback();
            $this->Flash->error(__('メッセージの送信に失敗しました。もう一度お試しください。'));
        }

        $chatCharacters = $this->ChatCharacters->find()
            ->where(['user_id' => $userId])
            ->toArray();
        $fromCharacters = array_column($chatCharacters, 'fullname', 'id');

        $this->set(compact('receivedMessage'));
        $this->set(compact('toCharacter'));
        $this->set(compact('fromCharacters'));
    }

    public function topListTable()
    {
        $this->viewBuilder()->disableAutoLayout();
        $userId = $this->Authentication->getIdentityData('id');

        // 登録キャラがいない場合は表示しない
        if (!$this->isCharacters()) {
            return;
        }
        $chatCharacterIds = $this->getCharacterIds();

        $receivedMessages = $this->ReceivedMessages->find()
            ->contain(['Users'])
            ->where(['user_id' =>  $userId])
            ->where(['chat_character_key IN ' =>  $chatCharacterIds])
            ->order(['ReceivedMessages.id' => 'DESC'])
            ->limit(3);

        $this->set(compact('receivedMessages'));
    }

    public function isNewMessage()
    {
        $this->viewBuilder()->disableAutoLayout();
        $userId = $this->Authentication->getIdentityData('id');

        // 登録キャラがいない場合は表示しない
        if (!$this->isCharacters()) {
            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '200', 'isNewMessage' => 0]));
            return $response;
        }
        $chatCharacterIds = $this->getCharacterIds();

        $receivedMessage = $this->ReceivedMessages->find()
            ->contain(['Users'])
            ->where(['user_id' => $userId])
            ->where(['opend' => 0])
            ->where(['chat_character_key IN ' => $chatCharacterIds])
            ->first();

        $result = 0;
        if ($receivedMessage) {
            $result = 1;
        }

        $response = $this->response;
        $response = $response->withType('application/json')
            ->withStringBody(json_encode(['code' => '200', 'isNewMessage' => $result]));
        return $response;
    }

}
