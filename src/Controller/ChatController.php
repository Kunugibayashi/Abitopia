<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;
use Cake\Datasource\ConnectionManager;
use Cake\Utility\Xml;

/**
 * Chat Controller
 *
 * @method \App\Model\Entity\Chat[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ChatController extends AppController
{
    public $ChatRooms = null;
    public $ChatCharacters = null;
    public $ChatEntries = null;
    public $ChatLogs = null;
    public $ChatLogWarehouses = null;
    public $Sessions = null;

    public $BattleSaveSkills = null;

    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('CheckFile');
        $this->loadComponent('FormatTopList');
        $this->loadComponent('CheckChat');
        $this->loadComponent('ActionLog');
        $this->loadComponent('ChatSession');
        $this->loadComponent('Dice');
        $this->loadComponent('Omikuji');
        $this->loadComponent('Deck');

        $this->ChatRooms = $this->fetchTable('ChatRooms');
        $this->ChatCharacters = $this->fetchTable('ChatCharacters');
        $this->ChatEntries = $this->fetchTable('ChatEntries');
        $this->ChatLogs = $this->fetchTable('ChatLogs');
        $this->ChatLogWarehouses = $this->fetchTable('ChatLogWarehouses');
        $this->Sessions = $this->fetchTable('Sessions');

        $this->BattleSaveSkills = $this->fetchTable('BattleSaveSkills');

        $this->session = $this->getRequest()->getSession();
        $this->ChatSession->set($this->session);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $userId = $this->Authentication->getIdentityData('id');
        // Routesにて、正規表現で数値制限済み
        $chatRoomId = $this->request->getParam('chatRoomId');

        //チャットルーム一覧
        $chatRooms = $this->ChatRooms
            ->find()
            ->where(['published' => 1]) // 公開のみ
            ->order(['displayno' => 'ASC']);
        $activeChatRooms = $this->ChatRooms->get($chatRoomId);

        // キャラクター一覧
        $chatCharacters = $this->ChatCharacters
            ->find()
            ->where(['user_id' => $userId])
            ->order(['id' => 'ASC'])
            ->toArray();
        $chatCharacters = $this->FormatTopList->formatChatCharacters($chatCharacters);

        $chatRoomCss = $this->CheckFile->findChatRoomCss($chatRoomId);

        $this->set(compact('chatCharacters'));
        $this->set(compact('activeChatRooms'));
        $this->set(compact('chatRooms'));
        $this->set(compact('chatRoomId'));
        $this->set(compact('chatRoomCss'));
    }

    public function enter()
    {
        if (!$this->request->is('post')) {
            return $this->redirect();
        }

        $userId = $this->Authentication->getIdentityData('id');
        $chatCharacterId = $this->request->getData('chat_character_id');
        $chatCharacterId = $this->CheckChat->userCharacterId($userId, $chatCharacterId);
        $this->ChatSession->setChatCharacterId($chatCharacterId);
        // Routesにて、正規表現で数値制限済み
        $chatRoomId = $this->request->getParam('chatRoomId');

        // 入室済の場合は入室した部屋にリダイレクト
        $enteredChatRoomId = $this->CheckChat->enteredChatRoomId($userId, $chatCharacterId);
        if($enteredChatRoomId) {
            $this->Flash->success(__('すでに入室しています。入室画面に移動します。'));
            return $this->redirect([
                'controller' => 'Chat',
                'action' => 'room',
                $enteredChatRoomId,
            ]);
        }

        $connection = ConnectionManager::get('default');
        $connection->begin();

        // 入室状態の追加
        $entryKey = $this->CheckChat->findEntryKey($chatRoomId);
        $chatEntry = $this->ChatEntries->newEmptyEntity();
        $chatEntry->set('chat_room_id', $chatRoomId);
        $chatEntry->set('user_id', $userId);
        $chatEntry->set('chat_character_id', $chatCharacterId);
        $chatEntry->set('entry_key', $entryKey);
        if (!$this->ChatEntries->save($chatEntry)) {
            $connection->rollback();
            $this->Flash->error(__('入室に失敗しました。もう一度お試しください。'));
            return $this->redirect([
                'controller' => 'Chat',
                'action' => 'index',
                $chatRoomId,
            ]);
        }

        // 入室メッセージ追加
        $chatLog = $this->ActionLog->setEntryMessage($chatEntry);
        if (!$this->ChatLogs->save($chatLog)) {
            $connection->rollback();
            $this->Flash->error(__('入室に失敗しました。もう一度お試しください。'));
            return $this->redirect([
                'controller' => 'Chat',
                'action' => 'index',
                $chatRoomId,
            ]);
        }

        $connection->commit();

        // 発言画面にリダイレクト
        return $this->redirect([
            'controller' => 'Chat',
            'action' => 'room',
            $chatRoomId,
        ]);
    }


    public function exit()
    {
        $userId = $this->Authentication->getIdentityData('id');
        $chatCharacterId = $this->request->getData('chat_character_key');
        $chatCharacterId = $this->CheckChat->userCharacterId($userId, $chatCharacterId);
        $this->ChatSession->setChatCharacterId($chatCharacterId);
        // Routesにて、正規表現で数値制限済み
        $chatRoomId = $this->request->getParam('chatRoomId');

        $chatEntry = $this->ChatEntries->find()
            ->where(['chat_room_id' => $chatRoomId])
            ->where(['user_id' => $userId])
            ->where(['chat_character_id' => $chatCharacterId])
            ->first();

        $connection = ConnectionManager::get('default');
        $connection->begin();

        // 退室メッセージ追加
        $chatLog = $this->ActionLog->setExitMessage($chatEntry);
        if (!$this->ChatLogs->save($chatLog)) {
            $connection->rollback();
            $this->Flash->error(__('退出に失敗しました。もう一度お試しください。'));
            return $this->redirect([
                'controller' => 'Chat',
                'action' => 'room',
                $chatRoomId,
            ]);
        }

        // 入室状態からの削除
        $entry_key = $chatEntry->entry_key; // 保持
        if (!$this->ChatEntries->delete($chatEntry)) {
            $connection->rollback();
            $this->Flash->error(__('退出に失敗しました。もう一度お試しください。'));
            return $this->redirect([
                'controller' => 'Chat',
                'action' => 'room',
                $chatRoomId,
            ]);
        }

        // 入室者がいなくなった場合、ログ出力する
        $chatEntry = $this->ChatEntries->find()
            ->where(['chat_room_id' => $chatRoomId])
            ->first();
        if (!$chatEntry) {
            $this->outputChatLog($chatRoomId, $entry_key);
        }

        $connection->commit();

        // MAX以上のログは削除する
        $logMax = Configure::read('Site.logmax');
        $maxLog = $this->ChatLogs->find()
            ->order(['id' => 'DESC'])
            ->limit(1)
            ->offset($logMax)
            ->first();
        $firstLog = $this->ChatLogs->find()
            ->order(['id' => 'ASC'])
            ->limit(1)
            ->first();
        if (!is_null($maxLog) && !is_null($firstLog) && !is_null($firstLog->id) && !is_null($maxLog->id)) {
            $connection->begin();
            $this->log(__CLASS__.":".__FUNCTION__.":" ."ChatLogs maxLog->id = $maxLog->id", 'debug');
            $this->log(__CLASS__.":".__FUNCTION__.":" ."ChatLogs firstLog->id = $firstLog->id", 'debug');
            for ($i = $firstLog->id; $i <= $maxLog->id; $i++) {
                // 多すぎるとメモリを圧迫するため1つずつ
                $this->ChatLogs->deleteAll(['id =' => $i]);
            }
            $connection->commit();
        }

        // チャットで使用していたセッションを削除
        $this->ChatSession->delete();
        $this->Flash->success(__('退出しました。'));

        // 発言画面にリダイレクト
        return $this->redirect([
            'controller' => 'Chat',
            'action' => 'index',
            $chatRoomId,
        ]);
    }

    public function outputChatLog($chatRoomId, $chatEntryKey) {
        ini_set('memory_limit', PHP_MEMORY_LIMIT);

        $chatRoom = $this->ChatRooms->get($chatRoomId);

        $logs = $this->chatLog($chatRoomId, $chatEntryKey);

        $characters = $this->ChatLogs->find()
            ->where(['chat_room_key' => $chatRoomId])
            ->where(['entry_key' => $chatEntryKey])
            ->group('fullname')
            ->select(['fullname'])
            ->toArray();
        $characters = array_column($characters, 'fullname');
        $charactersString = join('...', $characters);

        $chatLogWarehouse = $this->ChatLogWarehouses->newEmptyEntity();
        $chatLogWarehouse->set('entry_key', $chatEntryKey);
        $chatLogWarehouse->set('chat_room_title', $chatRoom->title);
        $chatLogWarehouse->set('logs', $logs);
        $chatLogWarehouse->set('characters', $charactersString);

        if (!$this->ChatLogWarehouses->save($chatLogWarehouse)) {
            // 保存に失敗してもエラーログのみ表示
            $this->log(__CLASS__.":".__FUNCTION__.":" ."Error out put log. chatEntryKey = $chatEntryKey", 'error');
        }
    }

    public function room()
    {
        $userId = $this->Authentication->getIdentityData('id');
        $chatCharacterId = $this->ChatSession->getChatCharacterId();
        $chatCharacterId = $this->CheckChat->userCharacterId($userId, $chatCharacterId);
        $this->ChatSession->setChatCharacterId($chatCharacterId);
        // Routesにて、正規表現で数値制限済み
        $chatRoomId = $this->request->getParam('chatRoomId');

        $chatCharacter = $this->ChatCharacters
            ->get($chatCharacterId);

        $chatRoomCss = $this->CheckFile->findChatRoomCss($chatRoomId);
        $entryKey = $this->CheckChat->findEntryKey($chatRoomId);

        // 部屋情報
        $chatRoom = $this->ChatRooms
            ->get($chatRoomId);

        $chatLog = $this->ChatLogs->newEmptyEntity();
        $chatLog->set('entry_key', $entryKey);
        $chatLog->set('chat_room_key', $chatRoomId);
        $chatLog->set('color', $chatCharacter->color);
        $chatLog->set('backgroundcolor', $chatCharacter->backgroundcolor);
        $chatLog->set('fullname', $chatCharacter->fullname);
        $chatLog->set('chat_character_key', $chatCharacterId);
        $chatLog->set('note', $this->ChatSession->getChatNote());

        // 戦闘用
        $battleSaveSkill = $this->ChatSession->getBattleSaveSkill();
        if (!$battleSaveSkill) {
            // 初期表示用
            $battleSaveSkill = $this->BattleSaveSkills->newEmptyEntity();
            $battleSaveSkill->set('chat_character_id', $chatCharacterId);
        }

        // 敵
        $enemies = $this->ChatCharacters->find()
            ->innerJoinWith('ChatEntries', function ($q) use ($chatRoomId) {
                return $q->select(['chat_room_id', 'chat_character_id'])
                    ->where(['chat_room_id' => $chatRoomId]);
            })
            ->where(['ChatCharacters.id !=' => $chatCharacterId])
            ->select(['ChatCharacters.id', 'ChatCharacters.fullname'])
            ->toArray();
        if ($enemies) {
            $enemies = array_column($enemies, 'fullname', 'id');
        }

        $battleSkills = Configure::read('Battle.battleSkills');
        $limitSkills = Configure::read('Battle.limitSkills');
        $passiveSkills = Configure::read('Battle.passiveSkills');

        $this->set(compact('battleSkills'));
        $this->set(compact('limitSkills'));
        $this->set(compact('passiveSkills'));
        $this->set(compact('battleSaveSkill'));
        $this->set(compact('enemies'));
        // 上記はバトル専用

        // 別窓にログを表示するか
        $openLogWindow = $this->ChatSession->getOpenLogWindow();

        $this->set(compact('openLogWindow'));
        $this->set(compact('chatCharacter'));
        $this->set(compact('chatRoomCss'));
        $this->set(compact('chatRoomId'));
        $this->set(compact('chatLog'));
        $this->set(compact('chatCharacterId'));
        $this->set(compact('chatRoom'));
    }

    public function say()
    {
        $this->autoRender = false;

        $userId = $this->Authentication->getIdentityData('id');
        $chatCharacterId = $this->request->getData('chat_character_key'); // ここは key
        $chatCharacterId = $this->CheckChat->userCharacterId($userId, $chatCharacterId);
        $this->ChatSession->setChatCharacterId($chatCharacterId);
        // Routesにて、正規表現で数値制限済み
        $chatRoomId = $this->request->getParam('chatRoomId');

        // $this->log(__CLASS__.":".__FUNCTION__.":" ."userId = $userId, chatCharacterId = $chatCharacterId", 'debug');
        // $this->log(__CLASS__.":".__FUNCTION__.":" ."chatRoomId = $chatRoomId", 'debug');

        $chatEntry = $this->ChatEntries->find()
            ->where(['chat_room_id' => $chatRoomId])
            ->where(['user_id' => $userId])
            ->where(['chat_character_id' => $chatCharacterId])
            ->first();

        $note = $this->request->getData('note');
        $this->ChatSession->setChatNote($note);

        // タグチェック
        $message = $this->request->getData('message');
        try {
            $xmltext = '<?xml version="1.0"?><root><child>' .$message .'</child></root>';
            $xmlObject = Xml::build($xmltext);
        } catch (\Cake\Utility\Exception\XmlException $e) {
            $this->log(__CLASS__.":".__FUNCTION__.":" ."It is not in XML format.", 'warning');

            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '500', 'message' => 'タグが正しくありません。']));
            return $response;
        }

        // 前回の発言と同発言かのチェック
        // 通信エラーと荒らし対策のため
        $message = $this->request->getData('message');
        $lastChatLog = $this->ChatLogs->find()
            ->where(['chat_character_key' => $chatEntry->chat_character_id])
            ->order(['id' => 'DESC'])
            ->first();
        if(!is_null($lastChatLog) && !is_null($lastChatLog->message) && $lastChatLog->message == $message) {
            $this->log(__CLASS__.":".__FUNCTION__.":" ."The remarks are repeated.", 'warning');

            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '500', 'message' => '同じ発言を繰り返すことはできません。']));
            return $response;
        }

        $connection = ConnectionManager::get('default');
        $connection->begin();

        //for($testCnt = 0; $testCnt < 1000; $testCnt++){ // 負荷試験用
        //  usleep(10000); // 負荷試験用

        $chatLog = $this->ActionLog->setSayMessage($chatEntry, $this->request);
        if(!$this->ChatLogs->save($chatLog)) {
            $connection->rollback();
            $this->log(__CLASS__.":".__FUNCTION__.":" ."ChatLogs save failed.", 'warning');

            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '500']));
            return $response;
        }

        //} // 負荷試験用

        $connection->commit();

        $response = $this->response;
        $response = $response->withType('application/json')
            ->withStringBody(json_encode(['code' => '200']));
        return $response;
    }

    public function chatLogWindow($chatRoomId, $openLogWindow)
    {
        $chatRoomCss = $this->CheckFile->findChatRoomCss($chatRoomId);
        $isChatLogWindow = 1; // 別窓表示

        $this->ChatSession->setOpenLogWindow($openLogWindow);

        $openLogWindow = $this->ChatSession->getOpenLogWindow();
        $this->log(__CLASS__.":".__FUNCTION__.": chatRoomId=" .$chatRoomId ." openLogWindow=" .$openLogWindow, 'debug');

        $this->set(compact('chatRoomCss'));
        $this->set(compact('openLogWindow'));
        $this->set(compact('isChatLogWindow'));
        return $this->chatLog($chatRoomId);
    }

    public function chatLog($chatRoomId = null, $chatEntryKey = null, $chatLoglimit = 10000)
    {
        // 引数はRoutesにて、正規表現で数値制限済み
        // 他から呼び出すため getParam を使用しない
        $this->viewBuilder()->setLayout('chatlog');

        // GETの指定がある場合はGETを優先
        if ($this->request->is('get')){
            // GETの場合は入れ子を想定
            $this->viewBuilder()->setLayout('none');

            $chatLoglimit = $this->request->getQuery('limit');
            if (!$chatLoglimit || $chatLoglimit < 0 || 2000 < $chatLoglimit) {
                // 極端な数字は除く
                $chatLoglimit = 25;
            }
        }

        // 全体数
        $tmpChatLogs = $this->ChatLogs->find()
                            ->contain(['BattleLogs'])
                            ->where(['chat_room_key' => $chatRoomId]);
        if ($chatEntryKey != null && $chatEntryKey != "") {
            $tmpChatLogs = $tmpChatLogs
                            ->where(['entry_key' => $chatEntryKey]);
        }
        $count = $tmpChatLogs->count();
        // $this->log(__CLASS__.":".__FUNCTION__.":" ."count = $count", 'debug');

        // データ取得
        $chatLogs = null;
        $limit = 100;
        for ($i = 0; $i <= $count; $i+=$limit){
            // 100件ずつ取得
            $tmpChatLogs = $this->ChatLogs->find()
                                ->contain(['BattleLogs'])
                                ->where(['chat_room_key' => $chatRoomId])
                                ->order(['ChatLogs.id' => 'DESC'])
                                ->offset($i)
                                ->limit($limit);
            if ($chatEntryKey != null && $chatEntryKey != "") {
                $tmpChatLogs = $tmpChatLogs
                                ->where(['entry_key' => $chatEntryKey]);
            }
            $tmpChatLogs = $tmpChatLogs->toArray();
            foreach ($tmpChatLogs as $tmpChatLog) {
                $chatLogs[] = $tmpChatLog;
            }
            if ($i > $chatLoglimit) break;
        }

        // toArray()を挟まないとこのIF文は機能しないので注意
        $chatLog = [];
        if ($chatLogs) {
            // ルーム情報は最新のレコードから取得
            // 紐付けを行っておらず、部屋が削除されたあともログを出力するため
            // first() は絞り込まれてしまうため使えない
            $chatLog = $chatLogs[0];
        }

        // 部屋情報
        $chatRoom = $this->ChatRooms->get($chatRoomId);
        $chatRoomCssString = $this->CheckFile->getChatRoomCssString($chatRoomId);

        $colorCodes = Configure::read('ColorCodes');

        $this->set(compact('chatLogs'));
        $this->set(compact('chatLog'));
        $this->set(compact('chatRoomId'));
        $this->set(compact('chatEntryKey'));
        $this->set(compact('colorCodes'));
        $this->set(compact('chatRoom'));
        $this->set(compact('chatRoomCssString'));

        return $this->render('chatLog');
    }

    public function topListTable()
    {
        $this->viewBuilder()->disableAutoLayout();
        $chatLogs = $this->ChatLogs->find()
            ->where(['chat_character_key' => 0]) // システム
            ->order(['id' => 'DESC'])
            ->limit(3);
        $this->set(compact('chatLogs'));
    }

    public function viewCount()
    {
        $now = date('Y-m-d H:i:s');
        $target = date('Y-m-d H:i:s', strtotime('-60 second'));
        $cnt = $this->Sessions->find()
            ->where([
                'modified BETWEEN :start AND :end'
            ])
            ->bind(':start', $target, 'date')
            ->bind(':end', $now, 'date')
            ->count();

        $response = $this->response;
        $response = $response->withType('application/json')
            ->withStringBody(json_encode(['code' => '200', 'views' => $cnt]));
        return $response;
    }

    public function dice()
    {
        $this->autoRender = false;

        $userId = $this->Authentication->getIdentityData('id');
        $chatCharacterId = $this->request->getData('chat_character_key'); // ここは key
        $chatCharacterId = $this->CheckChat->userCharacterId($userId, $chatCharacterId);
        $this->ChatSession->setChatCharacterId($chatCharacterId);
        // Routesにて、正規表現で数値制限済み
        $chatRoomId = $this->request->getParam('chatRoomId');

        $chatRoom = $this->ChatRooms->get($chatRoomId);
        $chatEntry = $this->ChatEntries->find()
            ->where(['chat_room_id' => $chatRoomId])
            ->where(['user_id' => $userId])
            ->where(['chat_character_id' => $chatCharacterId])
            ->first();
        $chatCharacter = $this->ChatCharacters
            ->get($chatCharacterId);

        $diceString = $this->request->getData('dice');

        if (!$this->Dice->isDiceFormat($diceString)) {
            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '400', 'message' => 'ダイス形式がフォーマットにあっていません']));
            return $response;
        }

        list($rollDiceString, $surfaces, $sum) = $this->Dice->roll($diceString);

        $connection = ConnectionManager::get('default');
        $connection->begin();

        // ダイス
        $format = Configure::read('Room.dice');
        $message = __($format, [
            $chatCharacter->fullname,
            $rollDiceString,
            join(' + ', $surfaces),
            $sum,
        ]);
        $chatLog = $this->ActionLog->setSystemMessage($message, $chatEntry, $chatRoom);
        if (!$this->ChatLogs->save($chatLog)) {
            $connection->rollback();

            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '500', 'message' => 'DB更新に失敗しました。']));
            return $response;
        }

        $connection->commit();

        $response = $this->response;
        $response = $response->withType('application/json')
            ->withStringBody(json_encode(['code' => '200', 'message' => '正常終了']));
        return $response;
    }

    public function omikuji()
    {
        $this->autoRender = false;
        $chatCharacterId = $this->request->getData(); // ここは key

        $userId = $this->Authentication->getIdentityData('id');
        $chatCharacterId = $this->request->getData('chat_character_key'); // ここは key
        $chatCharacterId = $this->CheckChat->userCharacterId($userId, $chatCharacterId);
        $this->ChatSession->setChatCharacterId($chatCharacterId);
        // Routesにて、正規表現で数値制限済み
        $chatRoomId = $this->request->getParam('chatRoomId');

        $chatRoom = $this->ChatRooms->get($chatRoomId);
        $chatEntry = $this->ChatEntries->find()
            ->where(['chat_room_id' => $chatRoomId])
            ->where(['user_id' => $userId])
            ->where(['chat_character_id' => $chatCharacterId])
            ->first();
        $chatCharacter = $this->ChatCharacters
            ->get($chatCharacterId);

        $omikuji = $this->request->getData('omikuji');

        $omikujiText = "";
        $omikujiName = "";
        if ($omikuji == 'omikuji1') {
            $omikujiText = $chatRoom->omikuji1text;
            $omikujiName = $chatRoom->omikuji1name;
        } else if ($omikuji == 'omikuji2') {
            $omikujiText = $chatRoom->omikuji2text;
            $omikujiName = $chatRoom->omikuji2name;
        }
        if (empty($omikujiText)) {
            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '400', 'message' => 'おみくじが設定されていません。']));
            return $response;
        }

        $omikujiArray = explode(',', $omikujiText);
        if (empty($omikujiArray) || count($omikujiArray) < 1) {
            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '400', 'message' => 'おみくじが設定されていません。']));
            return $response;
        }

        list($count, $me, $resultOmikujiText) = $this->Omikuji->draw($omikujiText);

        $connection = ConnectionManager::get('default');
        $connection->begin();

        // おみくじ
        $format = Configure::read('Room.omikuji');
        $message = __($format, [
            $chatCharacter->fullname,
            $omikujiName,
            $count,
            $me,
            $resultOmikujiText,
        ]);
        $chatLog = $this->ActionLog->setSystemMessage($message, $chatEntry, $chatRoom);
        if (!$this->ChatLogs->save($chatLog)) {
            $connection->rollback();

            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '500', 'message' => 'DB更新に失敗しました。']));
            return $response;
        }

        $connection->commit();

        $response = $this->response;
        $response = $response->withType('application/json')
            ->withStringBody(json_encode(['code' => '200', 'message' => '正常終了']));
        return $response;
    }

    public function deckflip()
    {
        $this->autoRender = false;
        $chatCharacterId = $this->request->getData(); // ここは key

        $userId = $this->Authentication->getIdentityData('id');
        $chatCharacterId = $this->request->getData('chat_character_key'); // ここは key
        $chatCharacterId = $this->CheckChat->userCharacterId($userId, $chatCharacterId);
        $this->ChatSession->setChatCharacterId($chatCharacterId);
        // Routesにて、正規表現で数値制限済み
        $chatRoomId = $this->request->getParam('chatRoomId');

        $chatRoom = $this->ChatRooms->get($chatRoomId);
        $chatEntry = $this->ChatEntries->find()
            ->where(['chat_room_id' => $chatRoomId])
            ->where(['user_id' => $userId])
            ->where(['chat_character_id' => $chatCharacterId])
            ->first();
        $chatCharacter = $this->ChatCharacters
            ->get($chatCharacterId);

        $deckText = $chatRoom->deck1text;
        $deckName = $chatRoom->deck1name;

        if (empty($deckText)) {
            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '400', 'message' => '山札が設定されていません。']));
            return $response;
        }

        $deckArray = explode(',', $deckText);
        if (empty($deckArray) || count($deckArray) < 1) {
            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '400', 'message' => '山札が設定されていません。']));
            return $response;
        }

        list($deckText, $headCount, $tailCount, $resultdeckText) = $this->Deck->flip($deckText);

        if (is_null($deckText) || empty($deckText)) {
            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '400', 'message' => '山札がありません。リセットしてください。']));
            return $response;
        }

        $connection = ConnectionManager::get('default');
        $connection->begin();

        // 山札
        $format = Configure::read('Room.deck');
        $message = __($format, [
            $chatCharacter->fullname,
            $deckName,
            ($headCount + $tailCount),
            ($headCount + 1),
            ($headCount + $tailCount),
            $resultdeckText,
        ]);
        $chatLog = $this->ActionLog->setSystemMessage($message, $chatEntry, $chatRoom);
        if (!$this->ChatLogs->save($chatLog)) {
            $connection->rollback();

            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '500', 'message' => 'DB更新に失敗しました。']));
            return $response;
        }

        // 山札のDBを更新する
        $chatRoom->deck1text = $deckText;
        if (!$this->ChatRooms->save($chatRoom)) {
            $connection->rollback();

            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '500', 'message' => 'DB更新に失敗しました。']));
            return $response;
        }

        $connection->commit();

        $response = $this->response;
        $response = $response->withType('application/json')
            ->withStringBody(json_encode(['code' => '200', 'message' => '正常終了']));
        return $response;
    }

    public function deckreset()
    {
        $this->autoRender = false;
        $chatCharacterId = $this->request->getData(); // ここは key

        $userId = $this->Authentication->getIdentityData('id');
        $chatCharacterId = $this->request->getData('chat_character_key'); // ここは key
        $chatCharacterId = $this->CheckChat->userCharacterId($userId, $chatCharacterId);
        $this->ChatSession->setChatCharacterId($chatCharacterId);
        // Routesにて、正規表現で数値制限済み
        $chatRoomId = $this->request->getParam('chatRoomId');

        $chatRoom = $this->ChatRooms->get($chatRoomId);
        $chatEntry = $this->ChatEntries->find()
            ->where(['chat_room_id' => $chatRoomId])
            ->where(['user_id' => $userId])
            ->where(['chat_character_id' => $chatCharacterId])
            ->first();
        $chatCharacter = $this->ChatCharacters
            ->get($chatCharacterId);

        $deckText = $chatRoom->deck1text;
        $deckName = $chatRoom->deck1name;

        if (empty($deckText)) {
            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '400', 'message' => '山札が設定されていません。']));
            return $response;
        }

        $deckArray = explode(',', $deckText);
        if (empty($deckArray) || count($deckArray) < 1) {
            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '400', 'message' => '山札が設定されていません。']));
            return $response;
        }

        $resetDeckText = $this->Deck->reset($deckText);

        $connection = ConnectionManager::get('default');
        $connection->begin();

        // 山札のDBを更新する
        $chatRoom->deck1text = $resetDeckText;
        if (!$this->ChatRooms->save($chatRoom)) {
            $connection->rollback();

            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '500', 'message' => 'DB更新に失敗しました。']));
            return $response;
        }

        // 山札リセット
        $format = Configure::read('Room.deckreset');
        $message = __($format, [
            $chatCharacter->fullname,
            $deckName,
        ]);
        $chatLog = $this->ActionLog->setSystemMessage($message, $chatEntry, $chatRoom);
        if (!$this->ChatLogs->save($chatLog)) {
            $connection->rollback();

            $response = $this->response;
            $response = $response->withType('application/json')
                ->withStringBody(json_encode(['code' => '500', 'message' => 'DB更新に失敗しました。']));
            return $response;
        }

        $connection->commit();

        $response = $this->response;
        $response = $response->withType('application/json')
            ->withStringBody(json_encode(['code' => '200', 'message' => '正常終了']));
        return $response;
    }

    public function htmlTagList()
    {
        $colorCodes = Configure::read('ColorCodes');
        $this->set(compact('colorCodes'));
    }
}
