<?php
declare(strict_types=1);

namespace App\Controller;

use Cake\Core\Configure;

/**
 * Manual Controller
 *
 * @method \App\Model\Entity\Manual[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class ManualController extends AppController
{
    public function initialize(): void
    {
        parent::initialize();
        $this->loadComponent('SiteSystemConfig');
    }

    public function beforeFilter(\Cake\Event\EventInterface $event)
    {
        parent::beforeFilter($event);
        $this->Authentication->addUnauthenticatedActions([
            'index', 'setting', 'chatSystem', 'battleSystem', 'battleStatus', 'setup',
        ]);
    }

    public function index()
    {
        $siteRules = $this->SiteSystemConfig->getMergeRule();

        $this->set(compact('siteRules'));
    }

    public function siteRule()
    {
        $siteRules = $this->SiteSystemConfig->getMergeRule();

        $this->set(compact('siteRules'));
    }

    public function setting()
    {
    }

    public function chatSystem()
    {
    }

    public function battleSystem()
    {
    }

    public function battleStatus()
    {
    }

    public function setup()
    {
    }

}
