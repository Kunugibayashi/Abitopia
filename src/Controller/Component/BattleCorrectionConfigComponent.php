<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Core\Configure;
use Cake\ORM\Locator\LocatorAwareTrait;

class BattleCorrectionConfigComponent extends Component
{
    use LocatorAwareTrait;

    public $BattleCorrectionConfigs = null;

    public $isCorrectTurnDexplus = 0;
    public $turnDexplusValue = 0;
    public $turnDexplusDefault = 0;

    public $isCorrectTurnDamage = 0;
    public $turnDamageValue = 0;
    public $turnDamageDefault = 0;

    public $isCorrectKasuri = 0;
    public $kasuriValue = 0;
    public $kasuriDefault = 0;

    public $isCorrectSoko = 0;
    public $sokoValue = 0;
    public $sokoDefault = 0;

    public $isCorrectLimit01Str = 0;
    public $limit01StrValue = 0;
    public $limit01StrDefault = 0;

    public $isCorrectLimit02Sp = 0;
    public $limit02SpValue = 0;
    public $limit02SpDefault = 0;

    public $isCorrectLimit02Meityu = 0;
    public $limit02MeityuValue = 0;
    public $limit02MeityuDefault = 0;

    public $isCorrectLimit02Kaihi = 0;
    public $limit02KaihiValue = 0;
    public $limit02KaihiDefault = 0;

    public $isCorrectLimit03Meityu = 0;
    public $limit03MeityuValue = 0;
    public $limit03MeityuDefault = 0;

    public $isCorrectPavKou = 0;
    public $pavKouValue = 0;
    public $pavKouDefault = 0;

    public $isCorrectPavMei = 0;
    public $pavMeiValue = 0;
    public $pavMeiDefault = 0;

    public $isCorrectPavSp = 0;
    public $pavSpValue = 0;
    public $pavSpDefault = 0;

    public $isCorrectPavKonbo = 0;
    public $pavKonboValue = 0;
    public $pavKonboDefault = 0;

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
        [$this->isCorrectTurnDexplus, $this->turnDexplusValue, $this->turnDexplusDefault] = $this->getBattleCorrectionConfig(BT_CORRECTION_1TURN_DEXPLUS);
        [$this->isCorrectTurnDamage, $this->turnDamageValue, $this->turnDamageDefault] = $this->getBattleCorrectionConfig(BT_CORRECTION_1TURN_DAMAGE);
        [$this->isCorrectKasuri, $this->kasuriValue, $this->kasuriDefault] = $this->getBattleCorrectionConfig(BT_CORRECTION_KASURI);
        [$this->isCorrectSoko, $this->sokoValue, $this->sokoDefault] = $this->getBattleCorrectionConfig(BT_CORRECTION_SOKO);
        [$this->isCorrectLimit01Str, $this->limit01StrValue, $this->limit01StrDefault] = $this->getBattleCorrectionConfig(BT_CORRECTION_LIMIT_01_STR);
        [$this->isCorrectLimit02Sp, $this->limit02SpValue, $this->limit02SpDefault] = $this->getBattleCorrectionConfig(BT_CORRECTION_LIMIT_02_SP);
        [$this->isCorrectLimit02Meityu, $this->limit02MeityuValue, $this->limit02MeityuDefault] = $this->getBattleCorrectionConfig(BT_CORRECTION_LIMIT_02_MEITYU);
        [$this->isCorrectLimit02Kaihi, $this->limit02KaihiValue, $this->limit02KaihiDefault] = $this->getBattleCorrectionConfig(BT_CORRECTION_LIMIT_02_KAIHI);
        [$this->isCorrectLimit03Meityu, $this->limit03MeityuValue, $this->limit03MeityuDefault] = $this->getBattleCorrectionConfig(BT_CORRECTION_LIMIT_03_MEITYU);
        [$this->isCorrectPavKou, $this->pavKouValue, $this->pavKouDefault] = $this->getBattleCorrectionConfig(BT_CORRECTION_PAV_KOU);
        [$this->isCorrectPavMei, $this->pavMeiValue, $this->pavMeiDefault] = $this->getBattleCorrectionConfig(BT_CORRECTION_PAV_MEI);
        [$this->isCorrectPavSp, $this->pavSpValue, $this->pavSpDefault] = $this->getBattleCorrectionConfig(BT_CORRECTION_PAV_SP);
        [$this->isCorrectPavKonbo, $this->pavKonboValue, $this->pavKonboDefault] = $this->getBattleCorrectionConfig(BT_CORRECTION_PAV_KONBO);
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
        return
        implode(',', [$this->isCorrectTurnDexplus, $this->turnDexplusValue, $this->turnDexplusDefault]). '／'.
        implode(',', [$this->isCorrectTurnDamage, $this->turnDamageValue, $this->turnDamageDefault]). '／'.
        implode(',', [$this->isCorrectKasuri, $this->kasuriValue, $this->kasuriDefault]). '／'.
        implode(',', [$this->isCorrectSoko, $this->sokoValue, $this->sokoDefault]). '／'.
        implode(',', [$this->isCorrectLimit01Str, $this->limit01StrValue, $this->limit01StrDefault]). '／'.
        implode(',', [$this->isCorrectLimit02Sp, $this->limit02SpValue, $this->limit02SpDefault]). '／'.
        implode(',', [$this->isCorrectLimit02Meityu, $this->limit02MeityuValue, $this->limit02MeityuDefault]). '／'.
        implode(',', [$this->isCorrectLimit02Kaihi, $this->limit02KaihiValue, $this->limit02KaihiDefault]). '／'.
        implode(',', [$this->isCorrectLimit03Meityu, $this->limit03MeityuValue, $this->limit03MeityuDefault]). '／'.
        implode(',', [$this->isCorrectPavKou, $this->pavKouValue, $this->pavKouDefault]). '／'.
        implode(',', [$this->isCorrectPavMei, $this->pavMeiValue, $this->pavMeiDefault]). '／'.
        implode(',', [$this->isCorrectPavSp, $this->pavSpValue, $this->pavSpDefault]). '／'.
        implode(',', [$this->isCorrectPavKonbo, $this->pavKonboValue, $this->pavKonboDefault]). '／'.
        implode(',', [$this->isCorrectSeimitsuKaihi, $this->seimitsuKaihiValue, $this->seimitsuKaihiDefault]). '／'.
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

    public function isCorrectTurnDexplus() {
        return $this->isCorrectTurnDexplus;
    }
    public function getTurnDexplusValue() {
        return $this->turnDexplusValue;
    }
    public function getTurnDexplusDefault() {
        return $this->turnDexplusDefault;
    }

    public function isCorrectTurnDamage() {
        return $this->isCorrectTurnDamage;
    }
    public function getTurnDamageValue() {
        return $this->turnDamageValue;
    }
    public function getTurnDamageDefault() {
        return $this->turnDamageDefault;
    }

    public function isCorrectKasuri() {
        return $this->isCorrectKasuri;
    }
    public function getKasuriValue() {
        return $this->kasuriValue;
    }
    public function getKasuriDefault() {
        return $this->kasuriDefault;
    }

    public function isCorrectSoko() {
        return $this->isCorrectSoko;
    }
    public function getSokoValue() {
        return $this->sokoValue;
    }
    public function getSokoDefault() {
        return $this->sokoDefault;
    }

    public function isCorrectLimit01Str() {
        return $this->isCorrectLimit01Str;
    }
    public function getLimit01StrValue() {
        return $this->limit01StrValue;
    }
    public function getLimit01StrDefault() {
        return $this->limit01StrDefault;
    }

    public function isCorrectLimit02Sp() {
        return $this->isCorrectLimit02Sp;
    }
    public function getLimit02SpValue() {
        return $this->limit02SpValue;
    }
    public function getLimit02SpDefault() {
        return $this->limit02SpDefault;
    }

    public function isCorrectLimit02Meityu() {
        return $this->isCorrectLimit02Meityu;
    }
    public function getLimit02MeityuValue() {
        return $this->limit02MeityuValue;
    }
    public function getLimit02MeityuDefault() {
        return $this->limit02MeityuDefault;
    }

    public function isCorrectLimit02Kaihi() {
        return $this->isCorrectLimit02Kaihi;
    }
    public function getLimit02KaihiValue() {
        return $this->limit02KaihiValue;
    }
    public function getLimit02KaihiDefault() {
        return $this->limit02KaihiDefault;
    }

    public function isCorrectLimit03Meityu() {
        return $this->isCorrectLimit03Meityu;
    }
    public function getLimit03MeityuValue() {
        return $this->limit03MeityuValue;
    }
    public function getLimit03MeityuDefault() {
        return $this->limit03MeityuDefault;
    }

    public function isCorrectPavKou() {
        return $this->isCorrectPavKou;
    }
    public function getPavKouValue() {
        return $this->pavKouValue;
    }
    public function getPavKouDefault() {
        return $this->pavKouDefault;
    }

    public function isCorrectPavMei() {
        return $this->isCorrectPavMei;
    }
    public function getPavMeiValue() {
        return $this->pavMeiValue;
    }
    public function getPavMeiDefault() {
        return $this->pavMeiDefault;
    }

    public function isCorrectPavSp() {
        return $this->isCorrectPavSp;
    }
    public function getPavSpValue() {
        return $this->pavSpValue;
    }
    public function getPavSpDefault() {
        return $this->pavSpDefault;
    }

    public function isCorrectPavKonbo() {
        return $this->isCorrectPavKonbo;
    }
    public function getPavKonboValue() {
        return $this->pavKonboValue;
    }
    public function getPavKonboDefault() {
        return $this->pavKonboDefault;
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
