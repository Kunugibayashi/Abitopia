<?php
declare(strict_types=1);

namespace App\Controller\Admin;

use App\Controller\AppController;

/**
 * SiteSystemConfigs Controller
 *
 * @property \App\Model\Table\SiteSystemConfigsTable $SiteSystemConfigs
 */
class SiteSystemConfigsController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index()
    {
        $query = $this->SiteSystemConfigs->find();
        $siteSystemConfigs = $this->paginate($query);

        $this->set(compact('siteSystemConfigs'));
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
        $siteSystemConfig = $this->SiteSystemConfigs->get($id, contain: []);
        $this->set(compact('siteSystemConfig'));
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null|void Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $siteSystemConfig = $this->SiteSystemConfigs->newEmptyEntity();
        if ($this->request->is('post')) {
            $siteSystemConfig = $this->SiteSystemConfigs->patchEntity($siteSystemConfig, $this->request->getData());
            if ($this->SiteSystemConfigs->save($siteSystemConfig)) {
                $this->Flash->success(__('The site system config has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The site system config could not be saved. Please, try again.'));
        }
        $this->set(compact('siteSystemConfig'));
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
        $siteSystemConfig = $this->SiteSystemConfigs->get($id, contain: []);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $siteSystemConfig = $this->SiteSystemConfigs->patchEntity($siteSystemConfig, $this->request->getData());
            if ($this->SiteSystemConfigs->save($siteSystemConfig)) {
                $this->Flash->success(__('The site system config has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The site system config could not be saved. Please, try again.'));
        }
        $this->set(compact('siteSystemConfig'));
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
        $siteSystemConfig = $this->SiteSystemConfigs->get($id);
        if ($this->SiteSystemConfigs->delete($siteSystemConfig)) {
            $this->Flash->success(__('The site system config has been deleted.'));
        } else {
            $this->Flash->error(__('The site system config could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
