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
        $this->loadComponent('BattleRuleConfig');
        $this->loadComponent('BattleCorrectionConfig');
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
        $battleRules = $this->BattleRuleConfig->getMergeBattleRule();
        $battleCorrections = $this->BattleCorrectionConfig->getMergeBattleCorrection();

        $this->set(compact('battleRules'));
        $this->set(compact('battleCorrections'));
    }

    public function ruleSelect()
    {
        $battleRules = $this->BattleRuleConfig->getMergeBattleRule();
        $battleCorrections = $this->BattleCorrectionConfig->getMergeBattleCorrection();

        $this->set(compact('battleRules'));
        $this->set(compact('battleCorrections'));
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
