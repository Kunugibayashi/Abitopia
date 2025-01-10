<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\ORM\Locator\LocatorAwareTrait;

class BattleCorrectionConfigComponent extends Component
{
    use LocatorAwareTrait;

    public $BattleCorrectionConfigs = null;

    public $isCorrectSeimitsuKaihi = 0;
    public $seimitsuKaihiValue = 0;
    public $seimitsuKaihiDefault = 0;

    public $isCorrectBuiStr = 0;
    public $buiStrValue = 0;
    public $buiStrDefault = 0;

    public $isCorrectKonbiStr = 0;
    public $konbiStrValue = 0;
    public $konbiStrDefault = 0;

    public $isCorrectKonbiMeityu = 0;
    public $konbiMeityuValue = 0;
    public $konbiMeityuDefault = 0;

    public $isCorrectSeniKaifuku = 0;
    public $seniKaifukuValue = 0;
    public $seniKaifukuDefault = 0;

    public $isCorrectSeisinKaifuku = 0;
    public $seisinKaifukuValue = 0;
    public $seisinKaifukuDefault = 0;

    public $isCorrectSennenKaihi = 0;
    public $sennenKaihiValue = 0;
    public $sennenKaihiDefault = 0;

    public $isCorrectRansuKaihi = 0;
    public $ransuKaihiValue = 0;
    public $ransuKaihiDefault = 0;

    public $isCorrectKoubouStr = 0;
    public $koubouStrValue = 0;
    public $koubouStrDefault = 0;

    public $isCorrectKauntaStr = 0;
    public $kauntaStrValue = 0;
    public $kauntaStrDefault = 0;

    public $isCorrectKauntaKaihi = 0;
    public $kauntaKaihiValue = 0;
    public $kauntaKaihiDefault = 0;

    public function initialize($config): void
    {
        parent::initialize($config);

        $this->BattleCorrectionConfigs = $this->fetchTable('BattleCorrectionConfigs');

        // DBデータをセット
        $this->setBattleCorrectionConfig();
    }

    /*
     * 最新のDB情報を取得。Constの順序に合わせる。
     */
    public function getMergeBattleCorrection() {
        $battleCorrections = Configure::read('BattleCorrection');

        if (is_null($this->BattleCorrectionConfigs)) {
            return $battleCorrections;
        }

        $battleCorrectionConfigs = $this->BattleCorrectionConfigs->find();
        if (is_null($battleCorrectionConfigs) || count($battleCorrectionConfigs->toArray()) <= 0) {
            return $battleCorrections;
        }
        // $this->log(print_r($battleCorrectionConfigs, true), "debug");

        foreach ($battleCorrectionConfigs as $dbCnt => $battleCorrectionConfig) {
            // $this->log($battleCorrectionConfig->id, "debug");
            foreach ($battleCorrections as $configCode => $siteBattleCorrection) {
                if ($configCode != $battleCorrectionConfig->id) {
                    continue;
                }
                $battleCorrections[$configCode]['value'] = $battleCorrectionConfig->battle_correction_value;
                $battleCorrections[$configCode]['active'] = $battleCorrectionConfig->active_flag;
            }
        }
        return $battleCorrections;
    }
    /*
     * 以下、判定関数。
     * 登録されていない場合は null になるためチェックを入れる関数を作成。
     */
    private function getBattleCorrectionConfig($id) {
        $battleCorrections = Configure::read('BattleCorrection');
        $defaultActive = $battleCorrections[$id]['active'];
        $defaultValue = $battleCorrections[$id]['default'];

        if (is_null($this->BattleCorrectionConfigs)) {
            return [$defaultActive, $defaultValue, $defaultValue];
        }

        $battleCorrectionConfigs = $this->BattleCorrectionConfigs->find()->where(['id' => $id, ]);
        if (is_null($battleCorrectionConfigs) || count($battleCorrectionConfigs->toArray()) <= 0) {
            return [$defaultActive, $defaultValue, $defaultValue];
        }

        $battleCorrectionConfig = $this->BattleCorrectionConfigs->get($id);
        if (is_null($battleCorrectionConfig)) {
            return [$defaultActive, $defaultValue, $defaultValue];
        }
        return [$battleCorrectionConfig->active_flag, $battleCorrectionConfig->battle_correction_value, $defaultValue];
    }

    private function setBattleCorrectionConfig() {
        [$this->isCorrectSeimitsuKaihi, $this->seimitsuKaihiValue, $this->seimitsuKaihiDefault] = $this->getBattleCorrectionConfig(BT_CORRECTION_SEIMITSU_KAIHI);
        [$this->isCorrectBuiStr       , $this->buiStrValue       , $this->buiStrDefault       ] = $this->getBattleCorrectionConfig(BT_CORRECTION_BUI_STR);
        [$this->isCorrectKonbiStr     , $this->konbiStrValue     , $this->konbiStrDefault     ] = $this->getBattleCorrectionConfig(BT_CORRECTION_KONBI_STR);
        [$this->isCorrectKonbiMeityu  , $this->konbiMeityuValue  , $this->konbiMeityuDefault  ] = $this->getBattleCorrectionConfig(BT_CORRECTION_KONBI_MEITYU);
        [$this->isCorrectSeniKaifuku  , $this->seniKaifukuValue  , $this->seniKaifukuDefault  ] = $this->getBattleCorrectionConfig(BT_CORRECTION_SENI_KAIFUKU);
        [$this->isCorrectSeisinKaifuku, $this->seisinKaifukuValue, $this->seisinKaifukuDefault] = $this->getBattleCorrectionConfig(BT_CORRECTION_SEISIN_KAIFUKU);
        [$this->isCorrectSennenKaihi  , $this->sennenKaihiValue  , $this->sennenKaihiDefault  ] = $this->getBattleCorrectionConfig(BT_CORRECTION_SENNEN_KAIHI);
        [$this->isCorrectRansuKaihi   , $this->ransuKaihiValue   , $this->ransuKaihiDefault   ] = $this->getBattleCorrectionConfig(BT_CORRECTION_RANSU_KAIHI);
        [$this->isCorrectKoubouStr    , $this->koubouStrValue    , $this->koubouStrDefault    ] = $this->getBattleCorrectionConfig(BT_CORRECTION_KOUBOU_STR);
        [$this->isCorrectKauntaStr    , $this->kauntaStrValue    , $this->kauntaStrDefault    ] = $this->getBattleCorrectionConfig(BT_CORRECTION_KAUNTA_STR);
        [$this->isCorrectKauntaKaihi  , $this->kauntaKaihiValue  , $this->kauntaKaihiDefault  ] = $this->getBattleCorrectionConfig(BT_CORRECTION_KAUNTA_KAIHI);
    }

    public function print() {
        return implode(',', [$this->isCorrectSeimitsuKaihi, $this->seimitsuKaihiValue, $this->seimitsuKaihiDefault]). '／'.
        implode(',', [$this->isCorrectBuiStr       , $this->buiStrValue       , $this->buiStrDefault       ]). '／'.
        implode(',', [$this->isCorrectKonbiStr     , $this->konbiStrValue     , $this->konbiStrDefault     ]). '／'.
        implode(',', [$this->isCorrectKonbiMeityu  , $this->konbiMeityuValue  , $this->konbiMeityuDefault  ]). '／'.
        implode(',', [$this->isCorrectSeniKaifuku  , $this->seniKaifukuValue  , $this->seniKaifukuDefault  ]). '／'.
        implode(',', [$this->isCorrectSeisinKaifuku, $this->seisinKaifukuValue, $this->seisinKaifukuDefault]). '／'.
        implode(',', [$this->isCorrectSennenKaihi  , $this->sennenKaihiValue  , $this->sennenKaihiDefault  ]). '／'.
        implode(',', [$this->isCorrectRansuKaihi   , $this->ransuKaihiValue   , $this->ransuKaihiDefault   ]). '／'.
        implode(',', [$this->isCorrectKoubouStr    , $this->koubouStrValue    , $this->koubouStrDefault    ]). '／'.
        implode(',', [$this->isCorrectKauntaStr    , $this->kauntaStrValue    , $this->kauntaStrDefault    ]). '／'.
        implode(',', [$this->isCorrectKauntaKaihi  , $this->kauntaKaihiValue  , $this->kauntaKaihiDefault  ]);
    }

    public function isCorrectSeimitsuKaihi() {
        return $this->isCorrectSeimitsuKaihi;
    }
    public function getSeimitsuKaihiValue() {
        return $this->seimitsuKaihiValue;
    }
    public function getSeimitsuKaihiDefault() {
        return $this->seimitsuKaihiDefault;
    }

    public function isCorrectBuiStr() {
        return $this->isCorrectBuiStr;
    }
    public function getBuiStrValue() {
        return $this->buiStrValue;
    }
    public function getBuiStrDefault() {
        return $this->buiStrDefault;
    }

    public function isCorrectKonbiStr() {
        return $this->isCorrectKonbiStr;
    }
    public function getKonbiStrValue() {
        return $this->konbiStrValue;
    }
    public function getKonbiStrDefault() {
        return $this->konbiStrDefault;
    }

    public function isCorrectKonbiMeityu() {
        return $this->isCorrectKonbiMeityu;
    }
    public function getKonbiMeityuValue() {
        return $this->konbiMeityuValue;
    }
    public function getKonbiMeityuDefault() {
        return $this->konbiMeityuDefault;
    }

    public function isCorrectSeniKaifuku() {
        return $this->isCorrectSeniKaifuku;
    }
    public function getSeniKaifukuValue() {
        return $this->buiStrValue;
    }
    public function getSeniKaifukuDefault() {
        return $this->seniKaifukuDefault;
    }

    public function isCorrectSeisinKaifuku() {
        return $this->isCorrectSeisinKaifuku;
    }
    public function getSeisinKaifukuValue() {
        return $this->seisinKaifukuValue;
    }
    public function getSeisinKaifukuDefault() {
        return $this->seisinKaifukuDefault;
    }

    public function isCorrectSennenKaihi() {
        return $this->isCorrectSennenKaihi;
    }
    public function getSennenKaihiValue() {
        return $this->sennenKaihiValue;
    }
    public function getSennenKaihiDefault() {
        return $this->sennenKaihiDefault;
    }

    public function isCorrectRansuKaihi() {
        return $this->isCorrectRansuKaihi;
    }
    public function getRansuKaihiValue() {
        return $this->ransuKaihiValue;
    }
    public function getRansuKaihiDefault() {
        return $this->ransuKaihiDefault;
    }

    public function isCorrectKoubouStr() {
        return $this->isCorrectKoubouStr;
    }
    public function getKoubouStrValue() {
        return $this->koubouStrValue;
    }
    public function getKoubouStrDefault() {
        return $this->koubouStrDefault;
    }

    public function isCorrectKauntaStr() {
        return $this->isCorrectKauntaStr;
    }
    public function getKauntaStrValue() {
        return $this->kauntaStrValue;
    }
    public function getKauntaStrDefault() {
        return $this->kauntaStrDefault;
    }

    public function isCorrectKauntaKaihi() {
        return $this->isCorrectKauntaKaihi;
    }
    public function getKauntaKaihiValue() {
        return $this->kauntaKaihiValue;
    }
    public function getKauntaKaihiDefault() {
        return $this->kauntaKaihiDefault;
    }
}
