<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * BattleCharacters Controller
 *
 * @property \App\Model\Table\BattleCharactersTable $BattleCharacters
 */
class BattleCharactersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->BattleCharacters->find()
            ->contain(['BattleTurns', 'ChatCharacters']);
        $battleCharacters = $this->paginate($query);

        $this->set(compact('battleCharacters'));
    }

    /**
     * View method
     *
     * @param string|null $id Battle Character id.
     * @return \Cake\Http\Response|null|void Renders view
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $battleCharacter = $this->BattleCharacters->get($id, contain: ['BattleTurns', 'ChatCharacters']);
        $this->set(compact('battleCharacter'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $battleCharacter = $this->BattleCharacters->newEmptyEntity();
        if ($this->request->is('post')) {
            $battleCharacter = $this->BattleCharacters->patchEntity($battleCharacter, $this->request->getData());
            if ($this->BattleCharacters->save($battleCharacter)) {
                $this->Flash->success(__('The battle character has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The battle character could not be saved. Please, try again.'));
        }
        $battleTurns = $this->BattleCharacters->BattleTurns->find('list', limit: 200)->all();
        $chatCharacters = $this->BattleCharacters->ChatCharacters->find('list', limit: 200)->all();
        $this->set(compact('battleCharacter', 'battleTurns', 'chatCharacters'));
    }

    /**
     * Edit method
     *
     * @param string|null $id Battle Character id.
     * @return \Cake\Http\Response|null|void Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $battleCharacter = $this->BattleCharacters->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $battleCharacter = $this->BattleCharacters->patchEntity($battleCharacter, $this->request->getData());
            if ($this->BattleCharacters->save($battleCharacter)) {
                $this->Flash->success(__('The battle character has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The battle character could not be saved. Please, try again.'));
        }
        $battleTurns = $this->BattleCharacters->BattleTurns->find('list', limit: 200)->all();
        $chatCharacters = $this->BattleCharacters->ChatCharacters->find('list', limit: 200)->all();
        $this->set(compact('battleCharacter', 'battleTurns', 'chatCharacters'));
    }

    /**
     * Delete method
     *
     * @param string|null $id Battle Character id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $battleCharacter = $this->BattleCharacters->get($id);
        if ($this->BattleCharacters->delete($battleCharacter)) {
            $this->Flash->success(__('The battle character has been deleted.'));
        } else {
            $this->Flash->error(__('The battle character could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
