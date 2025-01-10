<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use Cake\Core\Configure;

use App\Controller\AppController;

/**
 * BattleCorrectionConfigs Controller
 *
 */
class BattleCorrectionConfigsController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('BattleCorrectionConfig');
    }
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->BattleCorrectionConfigs->find();
        $battleCorrectionConfigs = $this->paginate($query);

        $this->set(compact('battleCorrectionConfigs'));
    }

    /**
     * View method
     *
     * @param string|null $id Battle Correction Config id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $battleCorrectionConfig = $this->BattleCorrectionConfigs->get($id, contain: []);
        $this->set(compact('battleCorrectionConfig'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $battleCorrectionConfig = $this->BattleCorrectionConfigs->newEmptyEntity();
        if ($this->request->is('post')) {
            $battleCorrectionConfig = $this->BattleCorrectionConfigs->patchEntity($battleCorrectionConfig, $this->request->getData());
            if ($this->BattleCorrectionConfigs->save($battleCorrectionConfig)) {
                $this->Flash->success(__('The battle correction config has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The battle correction config could not be saved. Please, try again.'));
        }
        $this->set(compact('battleCorrectionConfig'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Battle Correction Config id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $battleCorrectionConfig = $this->BattleCorrectionConfigs->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $battleCorrectionConfig = $this->BattleCorrectionConfigs->patchEntity($battleCorrectionConfig, $this->request->getData());
            if ($this->BattleCorrectionConfigs->save($battleCorrectionConfig)) {
                $this->Flash->success(__('The battle correction config has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The battle correction config could not be saved. Please, try again.'));
        }
        $this->set(compact('battleCorrectionConfig'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Battle Correction Config id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $battleCorrectionConfig = $this->BattleCorrectionConfigs->get($id);
        if ($this->BattleCorrectionConfigs->delete($battleCorrectionConfig)) {
            $this->Flash->success(__('The battle correction config has been deleted.'));
        } else {
            $this->Flash->error(__('The battle correction config could not be deleted. Please, try again.'));
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
            $codeAndValues = $request['values'];

            $errorMessage = "";
            foreach ($codeAndActives as $code => $activeFlag) {
                // $this->log(__CLASS__.":".__FUNCTION__.":" ."code = $code / activeFlag = $activeFlag", 'debug');
                $value = $codeAndValues[$code];

                $battleCorrectionConfig = $this->BattleCorrectionConfigs->newEmptyEntity();
                $battleCorrectionConfig->set('id', $code);
                $battleCorrectionConfig->set('battle_correction_code', $code);
                $battleCorrectionConfig->set('battle_correction_value', $value);
                $battleCorrectionConfig->set('active_flag', $activeFlag);

                // リクエスト分DB更新
                if (!$this->BattleCorrectionConfigs->save($battleCorrectionConfig)) {
                    $errorMessage = 'The site battle correction could not be saved. Please, try again.';
                }
            }

            // エラーがあった場合はエラーを表示
            if (!empty($errorMessage)){
                $this->Flash->error(__($errorMessage));
            } else {
                $this->Flash->success(__('The site battle correction has been saved.'));
            }

            // 最新の情報を取得
            $battleCorrections = $this->BattleCorrectionConfig->getMergeBattleCorrection();
            $this->set(compact('battleCorrections'));

            return $this->redirect(['action' => 'indexCustom']);
        }

        // 最新の情報を取得
        $battleCorrections = $this->BattleCorrectionConfig->getMergeBattleCorrection();
        $this->set(compact('battleCorrections'));
    }
}
