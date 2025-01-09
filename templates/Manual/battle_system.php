<?php
?>
<div class="row">
    <aside class="column-side">
        <?php echo $this->element('manual_side_nav_item'); ?>
    </aside>
    <div class="column-responsive main-container">
        <div class="content">
            <h3 id="kihon">戦闘の基本</h3>
            <div class="content-description">
                <p>
                    戦闘は以下の流れで行われます。
                    <ul>
                        <li>対戦相手を選択する。</li>
                        <li>覚醒スキル、パッシブスキル、戦闘スキルを選択する。</li>
                        <li>宣戦布告を行う。</li>
                        <li>防御側が防御スキルのセットを行う。</li>
                        <li>攻撃側が攻撃スキルのセットを行い、攻撃する。</li>
                        <li>どちらかが戦闘不能になるまで、防御セットと攻撃セットを繰り返す。</li>
                    </ul>
                </p>
            </div>
        </div>
        <div class="content">
            <h3 id="nagare">戦闘の流れ</h3>
            <div class="content-description">
                <dl>
                    <dt>●対戦相手を選択する。</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/bt_01_01.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 200, 'width' => 300,
                                'url' => '/img/manual/bt_01_01.png',
                            ]
                        ); ?>
                        <p>
                            左上のセレクトボックスから対戦相手を選んでください。<br>
                            セレクトボックスに名前がない場合は【索敵】を押下するとリストが更新されます。<br>
                        </p>
                    </dd>
                    <dt>●覚醒スキル、パッシブスキル、戦闘スキルを選択する。</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/bt_01_02.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 200, 'width' => 300,
                                'url' => '/img/manual/bt_01_02.png',
                            ]
                        ); ?>
                        <p>
                            覚醒スキルを1つ、パッシブスキルを1つ、戦闘スキルを7つ選択します。<br>
                            戦闘スキルは重複して選択することはできません。<br>
                        </p>
                    </dd>
                    <dt>●宣戦布告を行う。</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/bt_01_03.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 200, 'width' => 300,
                                'url' => '/img/manual/bt_01_03.png',
                            ]
                        ); ?>
                        <p>
                            【宣戦布告】を押下します。<br>
                            PCがお互いに宣戦布告を行うと戦闘が開始されます。<br>
                            敏捷が高いPCが先攻となります。同値の場合はダイスで決定されます。<br>
                        </p>
                    </dd>
                    <dt>●防御側が防御スキルのセットを行う。</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/bt_02_01.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 200, 'width' => 300,
                                'url' => '/img/manual/bt_02_01.png',
                            ]
                        ); ?>
                        <p>
                            防御側が防御セットを行います。<br>
                            「（自PC名）の防御スキルセットを待機中」が表示されていれば防御が可能です。<br>
                            『属性』と『防御スキル』を選択し【防御スキルセット】を押下してください。<br>
                        </p>
                        <p>
                            相手が攻撃するまで何度でもセットし直すことが可能です。<br>
                        </p>
                    </dd>
                    <dt>●攻撃側が攻撃スキルのセットを行い、攻撃する。</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/bt_03_01.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 200, 'width' => 300,
                                'url' => '/img/manual/bt_03_01.png',
                            ]
                        ); ?>
                        <p>
                            攻撃側が攻撃セットを行います。<br>
                            「（自PC名）の攻撃スキルセットを待機中」が表示されていれば攻撃が可能です。<br>
                            まず、『属性』と『通常攻撃／必殺技』と『攻撃スキル』を選択してください。<br>
                            次に、『技名』と『発言』を入力してください。防御側と異なり攻撃には発言が必要です。<br>
                            最後に、『攻撃スキルセット』にチェックをいれて【攻撃】を押下してください。<br>
                        </p>
                        <p>
                            【攻撃】を押下時に攻撃判定が行われるため取り消しはできません。<br>
                        </p>
                    </dd>
                        <dt>●どちらかが戦闘不能になるまで、防御セットと攻撃セットを繰り返す。</dt>
                        <dd>
                            <?php echo $this->Html->image('manual/bt_04_01.png' .'?date=' .CSS_UPDATE_DATE,
                                [
                                    'height' => 200, 'width' => 300,
                                    'url' => '/img/manual/bt_04_01.png',
                                ]
                            ); ?>
                            <p>
                                どちらかのHPが0になるまで攻撃と防御を行います。<br>
                                戦闘終了後、中央のボタンを押下すると通常のチャット画面へ遷移します。<br>
                            </p>
                        </dd>
                </dl>
            </div>
        </div>
        <div class="content">
            <h3 id="tyudan">戦闘の中断・再開</h3>
            <div class="content-description">
                <dl>
                    <dt>中断する</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/bt_03_02.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 100, 'width' => 300,
                                'url' => '/img/manual/bt_03_02.png',
                            ]
                        ); ?>
                        <p>
                            戦闘開始後、右下の【戦闘中断】ボタンを押下してください。<br>
                            通常のチャット画面へ遷移します。<br>
                        </p>
                    </dd>
                    <dt>再開する</dt>
                    <dd>
                        <?php echo $this->Html->image('manual/bt_01_04.png' .'?date=' .CSS_UPDATE_DATE,
                            [
                                'height' => 200, 'width' => 300,
                                'url' => '/img/manual/bt_01_04.png',
                            ]
                        ); ?>
                        <p>
                            対戦相手を選択し【戦闘再開】ボタンを押下してください。<br>
                            【宣戦布告】を押下すると、中断のデータは削除されます。ご注意ください。<br>
                        </p>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="content">
            <h3 id="zokusei">属性</h3>
            <div class="content-description">
                <p>
                    攻撃時、防御時に属性を指定します。属性の指定により攻撃の成功失敗が判定されます。<br>
                    属性は『炎』『地』『風』『水』の4つです。<br>
                    『炎』→『地』→『風』→『水』→『炎』の順で優劣が決まります。<br>
                    <?php echo $this->Html->image('manual/skill_01.png' .'?date=' .CSS_UPDATE_DATE,
                        [
                            'height' => 150, 'width' => 150,
                            'url' => '/img/manual/skill_01.png',
                        ]
                    ); ?><br>
                    基本的に属性『有利』となれば攻撃が命中しますが、スキルによって判定が変化します。<br>
                    <dl>
                        <dt>●属性『有利』</dt>
                        <dd>
                            攻撃が命中。<br>
                        </dd>
                        <dt>●属性『拮抗』</dt>
                        <dd>
                            (20+敏捷*10)% の確率で攻撃が命中。<br>
                        </dd>
                        <dt>●属性『不利』</dt>
                        <dd>
                            攻撃が失敗。<br>
                        </dd>
                    </dl>
                </p>
                <h4>属性とスキルの関係</h4>
                <p>
                    自分の攻撃属性が[炎]の場合、通常は以下のような判定となります。<br>
                    相手の防御属性[地]：『有利』<br>
                    相手の防御属性[炎]：『拮抗』<br>
                    相手の防御属性[風]：『拮抗』<br>
                    相手の防御属性[水]：『不利』<br>
                </p>
                <p>
                    青が『有利』、黄色が『拮抗』、黒が『不利』として記載しています。<br>
                    <?php echo $this->Html->image('manual/skill_02.png' .'?date=' .CSS_UPDATE_DATE,
                        [
                        'height' => 150, 'width' => 150,
                        'url' => '/img/manual/skill_02.png',
                        ]
                    ); ?>
                </p>
            </div>
        </div>
        <div class="content">
            <h3 id="combo">コンボ</h3>
            <div class="content-description">
                <p>
                    通常攻撃でダメージを与えた際にたまる戦闘時のみのポイントです。<br>
                    ためればためるほど戦闘では有利に働きます。<br>
                    特殊スキル【コンビネーション】【戦意高揚】【精神統一】使用時に必要となります。<br>
                    またHP0になった際に復活する底力の発動率にも関係します。<br>
                </p>
            </div>
        </div>
        <div class="content">
            <h3 id="sukiru">スキル</h3>
            <div class="content-description">
                <p>
                    スキルは、覚醒スキル、パッシブスキル、戦闘スキルに分けられます。
                </p>
                <h4>覚醒スキル</h4>
                <p>
                    自PCのHPが相手のHP半分以下になった場合に発動するスキルです。発動した覚醒スキルは戦闘終了まで継続します。<br>
                    発動すれば逆転が起こり得る強力な切り札です。<br>
                </p>
                <dl>
                    <dt>●リミットブレイク</dt>
                    <dd>
                        腕力+5。<br>
                    </dd>
                    <dt>●コンセントレイト</dt>
                    <dd>
                        SP+4、命中率+20%、回避率+20%。<br>
                    </dd>
                    <dt>●デュアルドライブ</dt>
                    <dd>
                        攻撃命中時、確定で連続攻撃。<br>
                        攻撃を外した場合、補正なしの命中率で連続攻撃。<br>
                    </dd>
                </dl>
                <h4>パッシブスキル</h4>
                <p>
                    常時発動するスキルです。<br>
                    効果は小さいですが戦略に深く関わります。<br>
                </p>
                <dl>
                    <dt>●攻撃力強化</dt>
                    <dd>
                        腕力+1。<br>
                    </dd>
                    <dt>●命中率強化</dt>
                    <dd>
                        命中率+10%。<br>
                    </dd>
                    <dt>●SP強化</dt>
                    <dd>
                        初期SP+3。<br>
                    </dd>
                    <dt>●コンボ充填</dt>
                    <dd>
                        初期コンボ+2。<br>
                    </dd>
                </dl>
                <h4>戦闘スキル</h4>
                <p>
                    攻撃ターン、防御ターンで使用可能なスキルです。戦闘開始時に7つのスキルを選択します。<br>
                    戦闘スキルはさらに3つに分類することができます。<br>
                    <dl>
                        <dd>○攻撃ターンで使用可能な技スキル</dd>
                        <dd>◉攻撃ターンで使用可能な特殊スキル</dd>
                        <dd>■防御ターンで使用可能な防御スキル</dd>
                    </dl>
                </p>
                <dl>
                    <dt>○精密射撃</dt>
                    <dd>
                        四属性に対応するスキルが存在する。<br>
                        攻撃属性を一致させた場合、その攻撃のみ命中率+35%。<br>
                        例）<br>
                        　攻撃属性[炎]でスキル【精密射撃（炎）】を使用した場合、命中率+35%。<br>
                        　攻撃属性[水]でスキル【精密射撃（炎）】を使用した場合、効果なし。<br>
                    </dd>
                    <dt>○部位破壊</dt>
                    <dd>
                        四属性に対応するスキルが存在する。<br>
                        攻撃属性を一致させた場合、その攻撃のみ腕力+4。<br>
                        例）<br>
                        　攻撃属性[炎]でスキル【部位破壊（炎）】を使用した場合、腕力+4。<br>
                        　攻撃属性[水]でスキル【部位破壊（炎）】を使用した場合、効果なし。<br>
                    </dd>
                    <dt>○ガードブレイク</dt>
                    <dd>
                        相手の【攻防一体】の発動を阻害。<br>
                        相手が【防御専念】の場合、属性『不利』と『拮抗』が命中。『有利』は相殺される。<br>
                        相手が【回避専念】の場合、属性『不利』が命中。『拮抗』と『有利』は回避される。<br>
                        上記以外の場合、属性『不利』が命中、『拮抗』が確率命中、『有利』が相殺される。<br>
                        <dl>
                            <dt>【ガードブレイク】vs【防御専念】</dt>
                            <dd>
                                攻撃が命中しやすくなります。<br>
                                <?php echo $this->Html->image('manual/skill_03.png' .'?date=' .CSS_UPDATE_DATE,
                                    [
                                        'height' => 150, 'width' => 150,
                                        'url' => '/img/manual/skill_03.png',
                                    ]
                                ); ?>
                            </dd>
                            <dt>【ガードブレイク】vs【回避専念】</dt>
                            <dd>
                                攻撃が命中しくくなります。<br>
                                <?php echo $this->Html->image('manual/skill_04.png' .'?date=' .CSS_UPDATE_DATE,
                                    [
                                        'height' => 150, 'width' => 150,
                                        'url' => '/img/manual/skill_04.png',
                                    ]
                                ); ?>
                            </dd>
                            <dt>【ガードブレイク】vs【攻防一体/カウンター/他】</dt>
                            <dd>
                                通常攻撃と命中属性が逆転します。<br>
                                <?php echo $this->Html->image('manual/skill_05.png',
                                    [
                                        'height' => 150, 'width' => 150,
                                        'url' => '/img/manual/skill_05.png',
                                    ]
                                ); ?>
                            </dd>
                        </dl>
                    </dd>
                    <dt>○ホーミング</dt>
                    <dd>
                        相手の【カウンター】の発動を阻害。<br>
                        相手が【乱数回避】の場合、どの属性も命中。<br>
                        相手が【回避専念】の場合、属性『不利』と『拮抗』が命中。『有利』は相殺される。<br>
                        相手が【防御専念】の場合、同属性のみ命中。<br>
                        上記以外の場合、同属性のみ命中、その他の『拮抗』が確率命中、『不利』と『有利』が防御される。<br>
                        <dl>
                            <dt>【ホーミング】vs【乱数回避】</dt>
                            <dd>
                                全ての属性が命中します。<br>
                                <?php echo $this->Html->image('manual/skill_10.png' .'?date=' .CSS_UPDATE_DATE,
                                    [
                                        'height' => 150, 'width' => 150,
                                        'url' => '/img/manual/skill_10.png',
                                    ]
                                ); ?>
                            </dd>
                            <dt>【ホーミング】vs【回避専念】</dt>
                            <dd>
                                攻撃が命中しやすくなります。<br>
                                <?php echo $this->Html->image('manual/skill_06.png' .'?date=' .CSS_UPDATE_DATE,
                                    [
                                        'height' => 150, 'width' => 150,
                                        'url' => '/img/manual/skill_06.png',
                                    ]
                                ); ?>
                            </dd>
                            <dt>【ホーミング】vs【防御専念】</dt>
                            <dd>
                                攻撃が命中しにくくなります。<br>
                                <?php echo $this->Html->image('manual/skill_07.png' .'?date=' .CSS_UPDATE_DATE,
                                    [
                                        'height' => 150, 'width' => 150,
                                        'url' => '/img/manual/skill_07.png',
                                    ]
                                ); ?>
                            </dd>
                            <dt>【ホーミング】vs【攻防一体/カウンター/他】</dt>
                            <dd>
                                攻撃が命中しにくくなります。<br>
                                <?php echo $this->Html->image('manual/skill_08.png' .'?date=' .CSS_UPDATE_DATE,
                                    [
                                        'height' => 150, 'width' => 150,
                                        'url' => '/img/manual/skill_08.png',
                                    ]
                                ); ?>
                            </dd>
                        </dl>
                    </dd>
                    <dt>○コンビネーション</dt>
                    <dd>
                        その攻撃のみ、腕力が（コンボ数+1）上昇、命中率が（コンボ数*10）%上昇。<br>
                        コンボがない場合、不発。<br>
                    </dd>
                    <dt>○明鏡止水</dt>
                    <dd>
                        必殺技の使用時に発動可能。<br>
                        相手が【覚悟完了】の場合、ダメージ2倍。<br>
                        相手が【覚悟完了】の以外の場合、ダメージ0.75倍。<br>
                        必殺技を使用するSPがない場合、不発。<br>
                    </dd>
                    <dt>◉戦意高揚</dt>
                    <dd>
                        （コンボ数*4）のHP回復。<br>
                        どの属性であっても、有利不利関係なく発動する。<br>
                        コンボがない場合、不発。<br>
                    </dd>
                    <dt>◉精神統一</dt>
                    <dd>
                        （コンボ数*2）のSP回復。<br>
                        どの属性であっても、有利不利関係なく発動する。<br>
                        コンボがない場合、不発。<br>
                    </dd>
                    <dt>■防御専念</dt>
                    <dd>
                        属性『拮抗』時、回避率+25%。<br>
                        相手が【ガードブレイク】の場合、攻撃を避けにくい。詳細は【ガードブレイク】を参照。<br>
                    </dd>
                    <dt>■回避専念</dt>
                    <dd>
                        属性『拮抗』時、回避率+25%。<br>
                        相手が【ホーミング】の場合、攻撃を避けにくい。詳細は【ホーミング】を参照。<br>
                    </dd>
                    <dt>■乱数回避</dt>
                    <dd>
                        全ての属性で属性『拮抗』と同様の回避率になる。<br>
                        属性『拮抗』時、回避率+15%。<br>
                        相手が【ホーミング】の場合、攻撃を避けられない。<br>
                        <dl>
                            <dt>【精密射撃/部位破壊/他】vs【乱数回避】</dt>
                            <dd>
                                全ての属性が『拮抗』判定になります。<br>
                                <?php echo $this->Html->image('manual/skill_09.png' .'?date=' .CSS_UPDATE_DATE,
                                    [
                                        'height' => 150, 'width' => 150,
                                        'url' => '/img/manual/skill_09.png',
                                    ]
                                ); ?>
                            </dd>
                            <dt>【ホーミング】vs【乱数回避】</dt>
                            <dd>
                                全ての属性が命中します。<br>
                                <?php echo $this->Html->image('manual/skill_10.png' .'?date=' .CSS_UPDATE_DATE,
                                    [
                                        'height' => 150, 'width' => 150,
                                        'url' => '/img/manual/skill_10.png',
                                    ]
                                ); ?>
                            </dd>
                        </dl>
                    </dd>
                    <dt>■攻防一体</dt>
                    <dd>
                        相手の攻撃を防御した場合、次ターンで腕力+3。<br>
                        相手が【ガードブレイク】の場合、発動しない。<br>
                    </dd>
                    <dt>■カウンター</dt>
                    <dd>
                        相手の攻撃を回避した場合、次ターンで腕力+2。<br>
                        属性『拮抗』時、回避率+15%。<br>
                        相手が【ホーミング】の場合、発動しない。<br>
                    </dd>
                    <dt>■覚悟完了</dt>
                    <dd>
                        相手が必殺技の場合、ダメージが半減。<br>
                        相手が【明鏡止水】の場合、ダメージ2倍。<br>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="content">
            <h3 id="hissatu">必殺技</h3>
            <div class="content-description">
                <p>
                    攻撃時にSPを消費することによってダメージを倍増させます。<br>
                </p>
                <dl>
                    <dt>●必殺技（小）</dt>
                    <dd>
                        消費SP2。ダメージ1.25倍。<br>
                    </dd>
                    <dt>●必殺技（中）</dt>
                    <dd>
                        消費SP3。ダメージ2倍。<br>
                    </dd>
                    <dt>●必殺技（大）</dt>
                    <dd>
                        消費SP4。ダメージ2.5倍。<br>
                    </dd>
                </dl>
            </div>
        </div>
        <div class="content">
            <h3 id="soko">底力</h3>
            <div class="content-description">
                <p>
                    HPが0になった際、ある一定の確率で復活します。<br>
                    HP1、SP0、コンボ×0となりますが、覚醒スキルが発動判定が入るため逆転のチャンスとなります。<br>
                    相手がHP1の場合、覚醒スキルは発動しないため注意してください。<br>
                </p>
                <p>
                    底力の発動確率：（SP + コンボ * 2）%<br>
                </p>
            </div>
        </div>
        <div class="content">
            <h3 id="kasuri">かすり傷</h3>
            <div class="content-description">
                <p>
                    攻撃が確率で失敗した場合、同確率でかすり傷のダメージの判定が入ります。<br>
                    判定に成功した場合、半減ダメージを与えます。失敗した場合はダメージを与えられません。<br>
                    また、かすり傷が命中した場合でもコンボはたまりません。<br>
                </p>
            </div>
        </div>
        <div class="content">
            <h3 id="hantei">判定式</h3>
            <div class="content-description">
                <p>
                    バトル時にはダイス結果を確認するため判定式が出力されています。<br>
                    確認するためには、スキル名vsスキル名などのナレーション部分にマウスカーソルをのせてください。<br>
                </p>
                <dl>
                    <dt>●ダメージ計算</dt>
                    <dd>((5+腕力)+(攻撃スキル補正)+(恒久腕力補正+一時腕力補正))*(必殺掛け率)*(明鏡覚悟掛け率)*(かすり傷掛け率)=ダメージ</dd>
                    <dt>●命中判定</dt>
                    <dd>(20+敏捷*10)+(攻撃スキル補正)+(恒久命中率補正+一時命中率補正)-(防御スキル補正+恒久回避率補正+一時回避率補正)=命中率 / ダイス / 結果</dd>
                    <dt>●かすり傷判定</dt>
                    <dd>(20+敏捷*10)=かすり傷命中率 / ダイス / 結果</dd>
                    <dt>●連撃判定</dt>
                    <dd>(20+敏捷*10)=連撃発生率 / ダイス / 結果</dd>
                    <dt>●底力判定</dt>
                    <dd>(SP)+(コンボ*2)=底力発生率 / ダイス / 結果</dd>
                </dl>
            </div>
        </div>
        <div class="content">
            <h3 id="osusume">組み合わせ例</h3>
            <div class="content-description">
                <p>
                    ステータスやスキルの組み合わせの例を挙げています。<br>
                    これに則る必要はありませんので自由に試行錯誤してください。<br>
                </p>
                <dl>
                    <dt>●バランス型</dt>
                    <dd>
                        ステータス：3333/3324/4233 など<br>
                        スキル：精密射撃3種、コンビネーション、回避専念or防御専念、明鏡止水、覚悟完了<br>
                        <p>
                            精密射撃3種で命中確率を上げて削り、コンビネーションで火力を上げ、必殺で決めるタイプです。<br>
                            相手が必殺を使いそうになった場合は覚悟完了、その他は専念で攻撃を防ぎます。<br>
                        </p>
                    </dd>
                </dl>
                <dl>
                    <dt>●腕力型</dt>
                    <dd>
                        ステータス：6042/5124 など<br>
                        スキル：精密射撃2種、ガードブレイク、ホーミング、回避専念or防御専念、明鏡止水、覚悟完了<br>
                        <p>
                            相手が専念で回避防御する場合、命中率を考えずに命中が可能なスキルの組み合わせです。<br>
                            相手が専念を使わない場合は精密射撃でダメージを与えます。<br>
                        </p>
                    </dd>
                </dl>
                <dl>
                    <dt>●敏捷型</dt>
                    <dd>
                        ステータス：1524/1515 など<br>
                        スキル：部位破壊2種、精密射撃1種、コンビネーション、回避専念or防御専念、明鏡止水、覚悟完了<br>
                        <p>
                            部位破壊で火力を上げ、半減ダメージを狙いながら削っていくタイプです。<br>
                            SPを高めに設定し、適宜必殺を使用していきます。<br>
                        </p>
                    </dd>
                </dl>
            </div>
        </div>
    </div>
</div>
