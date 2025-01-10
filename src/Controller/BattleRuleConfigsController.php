<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * BattleRuleConfigs Controller
 *
 */
class BattleRuleConfigsController extends AppController
{
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
     * @param string|null $id Site System Config id.
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
                $this->Flash->success(__('The site system config has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The site system config could not be saved. Please, try again.'));
        }
        $this->set(compact('battleRuleConfig'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Site System Config id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $battleRuleConfig = $this->BattleRuleConfigs->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $battleRuleConfig = $this->BattleRuleConfigs->patchEntity($battleRuleConfig, $this->request->getData());
            if ($this->BattleRuleConfigs->save($battleRuleConfig)) {
                $this->Flash->success(__('The site system config has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The site system config could not be saved. Please, try again.'));
        }
        $this->set(compact('battleRuleConfig'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Site System Config id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $battleRuleConfig = $this->BattleRuleConfigs->get($id);
        if ($this->BattleRuleConfigs->delete($battleRuleConfig)) {
            $this->Flash->success(__('The site system config has been deleted.'));
        } else {
            $this->Flash->error(__('The site system config could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
