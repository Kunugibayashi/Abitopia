<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\ORM\Locator\LocatorAwareTrait;

class SiteSystemConfigComponent extends Component
{
    use LocatorAwareTrait;

    public $SiteSystemConfigs = null;

    public $isInputTechniqueName = 0;
    public $isResurrection = 0;
    public $isScratch = 0;
    public $is1TurnDexplus = 0;
    public $is1TurnDamage = 0;

    public function initialize($config): void
    {
        parent::initialize($config);

        $this->SiteSystemConfigs = $this->fetchTable('SiteSystemConfigs');

        // DBデータをセット
        $this->setSiteSystemConfig();
    }

    /*
     * 最新のDB情報を取得。Constの順序に合わせる。
     */
    public function getMergeRule() {
        $siteRules = Configure::read('Rule');

        if (is_null($this->SiteSystemConfigs)) {
            return $siteRules;
        }

        $siteSystemConfigs = $this->SiteSystemConfigs->find();
        if (is_null($siteSystemConfigs) || count($siteSystemConfigs->toArray()) <= 0) {
            return $siteRules;
        }

        foreach ($siteSystemConfigs as $systemCnt => $siteSystemConfig) {
            foreach ($siteRules as $ruleCnt => $siteRule) {
                $siteRules[$ruleCnt]['active'] = $siteSystemConfig->active_flag;
            }
        }
        return $siteRules;
    }
    /*
     * 以下、判定関数。
     * 登録されていない場合は null になるためチェックを入れる関数を作成。
     */
    private function getSiteSystemConfig($id) {
        if (is_null($this->SiteSystemConfigs)) {
            return 0;
        }

        $siteSystemConfigs = $this->SiteSystemConfigs->find();
        if (is_null($siteSystemConfigs) || count($siteSystemConfigs->toArray()) <= 0) {
            return 0;
        }

        $siteSystemConfig = $this->SiteSystemConfigs->get($id);
        if (is_null($siteSystemConfig)) {
            return 0;
        }
        return $siteSystemConfig->active_flag;
    }

    private function setSiteSystemConfig() {
        $this->isInputTechniqueName = $this->getSiteSystemConfig(RULE_INPUT_TECHNIQUE_NAME);
        $this->isResurrection = $this->getSiteSystemConfig(RULE_RESURRECTION);
        $this->isScratch = $this->getSiteSystemConfig(RULE_SCRATCH);
        $this->is1TurnDexplus = $this->getSiteSystemConfig(RULE_1TURN_DEXPLUS);
        $this->is1TurnDamage = $this->getSiteSystemConfig(RULE_1TURN_DAMAGE);
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
