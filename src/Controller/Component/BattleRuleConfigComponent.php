<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\ORM\Locator\LocatorAwareTrait;

class BattleRuleConfigComponent extends Component
{
    use LocatorAwareTrait;

    public $BattleRuleConfigs = null;

    public $isInputTechniqueName = 0;
    public $isResurrection = 0;
    public $isScratch = 0;
    public $is1TurnDexplus = 0;
    public $is1TurnDamage = 0;

    public function initialize($config): void
    {
        parent::initialize($config);

        $this->BattleRuleConfigs = $this->fetchTable('BattleRuleConfigs');

        // DBデータをセット
        $this->setBattleRuleConfig();
    }

    /*
     * 最新のDB情報を取得。Constの順序に合わせる。
     */
    public function getMergeBattleRule() {
        $battleRules = Configure::read('BattleRule');

        if (is_null($this->BattleRuleConfigs)) {
            return $battleRules;
        }

        $battleRuleConfigs = $this->BattleRuleConfigs->find();
        if (is_null($battleRuleConfigs) || count($battleRuleConfigs->toArray()) <= 0) {
            return $battleRules;
        }
        // $this->log(print_r($battleRuleConfigs, true), "debug");

        foreach ($battleRuleConfigs as $systemCnt => $battleRuleConfig) {
            // $this->log($battleRuleConfig->id, "debug");
            foreach ($battleRules as $ruleCnt => $battleRule) {
                if ($ruleCnt != $battleRuleConfig->id) {
                    continue;
                }
                $battleRules[$ruleCnt]['active'] = $battleRuleConfig->active_flag;
            }
        }
        return $battleRules;
    }
    /*
     * 以下、判定関数。
     * 登録されていない場合は null になるためチェックを入れる関数を作成。
     */
    private function getBattleRuleConfig($id) {
        if (is_null($this->BattleRuleConfigs)) {
            return 0;
        }

        $battleRuleConfigs = $this->BattleRuleConfigs->find()->where(['id' => $id, ]);
        if (is_null($battleRuleConfigs) || count($battleRuleConfigs->toArray()) <= 0) {
            return 0;
        }

        $battleRuleConfig = $this->BattleRuleConfigs->get($id);
        if (is_null($battleRuleConfig)) {
            return 0;
        }
        return $battleRuleConfig->active_flag;
    }

    private function setBattleRuleConfig() {
        $this->isInputTechniqueName = $this->getBattleRuleConfig(BT_RULE_INPUT_TECHNIQUE_NAME);
        $this->isResurrection = $this->getBattleRuleConfig(BT_RULE_RESURRECTION);
        $this->isScratch = $this->getBattleRuleConfig(BT_RULE_SCRATCH);
        $this->is1TurnDexplus = $this->getBattleRuleConfig(BT_RULE_1TURN_DEXPLUS);
        $this->is1TurnDamage = $this->getBattleRuleConfig(BT_RULE_1TURN_DAMAGE);
    }

    public function isInputTechniqueName() {
        return $this->isInputTechniqueName;
    }

    public function isResurrection() {
        return $this->isResurrection;
    }

    public function isScratch() {
        return $this->isScratch;
    }

    public function is1TurnDexplus() {
        return $this->is1TurnDexplus;
    }

    public function is1TurnDamage() {
        return $this->is1TurnDamage;
    }
}
