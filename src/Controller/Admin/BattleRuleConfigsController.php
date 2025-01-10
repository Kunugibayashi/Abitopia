<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use Cake\Core\Configure;

use App\Controller\AppController;

/**
 * BattleRuleConfigs Controller
 *
 */
class BattleRuleConfigsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('BattleRuleConfig');
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->BattleRuleConfigs->find();
        $battleRuleConfigs = $this->paginate($query);

        $this->set(compact('battleRuleConfigs'));
    }

    /**
     * View method
     *
     * @param string|null $id Battle Rule Config id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $battleRuleConfig = $this->BattleRuleConfigs->get($id, contain: []);
        $this->set(compact('battleRuleConfig'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $battleRuleConfig = $this->BattleRuleConfigs->newEmptyEntity();
        if ($this->request->is('post')) {
            $battleRuleConfig = $this->BattleRuleConfigs->patchEntity($battleRuleConfig, $this->request->getData());
            if ($this->BattleRuleConfigs->save($battleRuleConfig)) {
                $this->Flash->success(__('The battle rule config has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The battle rule config could not be saved. Please, try again.'));
        }
        $this->set(compact('battleRuleConfig'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Battle Rule Config id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $battleRuleConfig = $this->BattleRuleConfigs->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $battleRuleConfig = $this->BattleRuleConfigs->patchEntity($battleRuleConfig, $this->request->getData());
            if ($this->BattleRuleConfigs->save($battleRuleConfig)) {
                $this->Flash->success(__('The battle rule config has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The battle rule config could not be saved. Please, try again.'));
        }
        $this->set(compact('battleRuleConfig'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Battle Rule Config id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $battleRuleConfig = $this->BattleRuleConfigs->get($id);
        if ($this->BattleRuleConfigs->delete($battleRuleConfig)) {
            $this->Flash->success(__('The battle rule config has been deleted.'));
        } else {
            $this->Flash->error(__('The battle rule config could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }

    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function indexCustom()
    {
        $request = $this->request->getData();
        // $this->log(__CLASS__.":".__FUNCTION__.":" ."request = " . print_r($request, true), 'debug');

        if ($this->request->is('post')) {
            $codeAndActives = $request['actives'];

            $errorMessage = "";
            foreach ($codeAndActives as $code => $activeFlag) {
                // $this->log(__CLASS__.":".__FUNCTION__.":" ."code = $code / activeFlag = $activeFlag", 'debug');

                $battleRuleConfig = $this->BattleRuleConfigs->newEmptyEntity();
                $battleRuleConfig->set('id', $code);
                $battleRuleConfig->set('battle_rule_code', $code);
                $battleRuleConfig->set('active_flag', $activeFlag);

                // リクエスト分DB更新
                if (!$this->BattleRuleConfigs->save($battleRuleConfig)) {
                    $errorMessage = 'The battle rule config could not be saved. Please, try again.';
                }
            }

            // エラーがあった場合はエラーを表示
            if (!empty($errorMessage)){
                $this->Flash->error(__($errorMessage));
            } else {
                $this->Flash->success(__('The battle rule config has been saved.'));
            }

            // 最新の情報を取得
            $battleRules = $this->BattleRuleConfig->getMergeBattleRule();
            $this->set(compact('battleRules'));

            return $this->redirect(['action' => 'indexCustom']);
        }

        // 最新の情報を取得
        $battleRules = $this->BattleRuleConfig->getMergeBattleRule();
        $this->set(compact('battleRules'));
    }
}
