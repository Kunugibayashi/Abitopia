CREATE TABLE `sessions` (
  `id`       char(40)     CHARACTER SET ascii COLLATE ascii_bin NOT NULL,
  `created`  datetime     DEFAULT CURRENT_TIMESTAMP,
  `modified` datetime     DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `data`     blob,
  `expires`  int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='セッション'
;

CREATE TABLE `users` (
  `id`       int unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50)  NOT NULL,
  `password` varchar(255) NOT NULL,
  `role`     varchar(20)  NOT NULL,
  `created`  datetime     NOT NULL,
  `modified` datetime     NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE=InnoDB
  AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='ユーザー'
;

CREATE TABLE `battle_rule_configs` (
  `id`                int unsigned NOT NULL AUTO_INCREMENT COMMENT '戦闘ルール設定ID',
  `battle_rule_code`  int unsigned NOT NULL DEFAULT '0'    COMMENT '戦闘ルールコード',
  `active_flag`       int unsigned NOT NULL DEFAULT '0'    COMMENT '有効フラグ',
  `modified`          datetime     NOT NULL                COMMENT '更新日',
  `created`           datetime     NOT NULL                COMMENT '作成日',
  PRIMARY KEY (`id`)
)
  ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='戦闘ルール設定'
;

CREATE TABLE `battle_correction_configs` (
  `id`                       int unsigned NOT NULL AUTO_INCREMENT COMMENT '戦闘補正値設定ID',
  `battle_correction_code`   int unsigned NOT NULL DEFAULT '0'    COMMENT '戦闘補正値コード',
  `battle_correction_value`  int          NOT NULL DEFAULT '0'    COMMENT '戦闘補正値',
  `active_flag`              int unsigned NOT NULL DEFAULT '0'    COMMENT '有効フラグ（0：デフォルト  1：戦闘補正値を適応）',
  `modified`                 datetime     NOT NULL                COMMENT '更新日',
  `created`                  datetime     NOT NULL                COMMENT '作成日',
  PRIMARY KEY (`id`)
)
  ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='戦闘補正値設定'
;

CREATE TABLE `chat_characters` (
  `id`              int unsigned NOT NULL AUTO_INCREMENT    COMMENT 'チャットキャラクターID',
  `user_id`         int unsigned NOT NULL                   COMMENT 'ユーザーID',
  `fullname`        varchar(50)  NOT NULL                   COMMENT 'キャラクター名',
  `sex`             varchar(7)            DEFAULT NULL      COMMENT '性別',
  `color`           varchar(7)   NOT NULL DEFAULT '#ffffff' COMMENT 'メッセージ文字色',
  `backgroundcolor` varchar(7)   NOT NULL DEFAULT '#000000' COMMENT 'メッセージ背景色',
  `nickname`        varchar(20)           DEFAULT NULL      COMMENT '二つ名',
  `team`            varchar(20)           DEFAULT NULL      COMMENT '所属',
  `tag`             varchar(255)          DEFAULT NULL      COMMENT 'タグ',
  `url`             varchar(255)          DEFAULT NULL      COMMENT 'URL',
  `free1`           text                                    COMMENT 'フリー欄',
  `detail`          text                                    COMMENT '詳細',
  `modified`        datetime     NOT NULL                   COMMENT '更新日',
  `created`         datetime     NOT NULL                   COMMENT '作成日',
  PRIMARY KEY (`id`),
  KEY `userid` (`user_id`),
  CONSTRAINT `chat_characters_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
  ENGINE=InnoDB
  AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='チャットキャラクター'
;

CREATE TABLE `send_messages` (
  `id`                         int unsigned NOT NULL AUTO_INCREMENT COMMENT '私書送信ID',
  `user_id`                    int unsigned NOT NULL                COMMENT 'ユーザーID',
  `chat_character_key`         int unsigned NOT NULL                COMMENT '差出人チャットキャラクターID',
  `chat_character_fullname`    varchar(50)  NOT NULL                COMMENT '差出人キャラクター名',
  `to_chat_character_key`      int unsigned NOT NULL                COMMENT '宛先チャットキャラクターID',
  `to_chat_character_fullname` varchar(50)  NOT NULL                COMMENT '宛先キャラクター名',
  `title`                      varchar(255) NOT NULL                COMMENT '私書タイトル',
  `message`                    text         NOT NULL                COMMENT '私書メッセージ',
  `modified`                   datetime     NOT NULL                COMMENT '更新日',
  `created`                    datetime     NOT NULL                COMMENT '作成日',
  PRIMARY KEY (`id`),
  KEY `chat_character_id` (`to_chat_character_key`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `send_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
  ENGINE=InnoDB
  AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='私書送信'
;

CREATE TABLE `received_messages` (
  `id`                           int unsigned NOT NULL AUTO_INCREMENT COMMENT '私書受信ID',
  `user_id`                      int unsigned NOT NULL                COMMENT 'ユーザーID',
  `chat_character_key`           int unsigned NOT NULL                COMMENT '宛先チャットキャラクターID',
  `chat_character_fullname`      varchar(50)  NOT NULL                COMMENT '宛先キャラクター名',
  `from_chat_character_key`      int unsigned NOT NULL                COMMENT '差出人チャットキャラクターID',
  `from_chat_character_fullname` varchar(50)  NOT NULL                COMMENT '差出人キャラクター名',
  `title`                        varchar(255) NOT NULL                COMMENT '私書タイトル',
  `message`                      text         NOT NULL                COMMENT '私書メッセージ',
  `opend`                        int unsigned NOT NULL DEFAULT '0'    COMMENT '開封したか？',
  `modified`                     datetime     NOT NULL                COMMENT '更新日',
  `created`                      datetime     NOT NULL                COMMENT '作成日',
  PRIMARY KEY (`id`),
  KEY `chat_character_id` (`from_chat_character_key`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `received_messages_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
  ENGINE=InnoDB
  AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='私書受信'
;

CREATE TABLE `informations` (
  `id`              int unsigned NOT NULL AUTO_INCREMENT COMMENT 'お知らせID',
  `title`           varchar(255) NOT NULL                COMMENT 'お知らせタイトル',
  `detail`          text         NOT NULL                COMMENT 'お知らせメッセージ',
  `modified`        datetime     NOT NULL                COMMENT '更新日',
  `created`         datetime     NOT NULL                COMMENT '作成日',
  PRIMARY KEY (`id`)
)
  ENGINE=InnoDB
  AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='お知らせ'
;

CREATE TABLE `chat_rooms` (
  `id`            int unsigned  NOT NULL AUTO_INCREMENT         COMMENT 'チャットルームID',
  `title`         varchar(15)   NOT NULL                        COMMENT 'チャットルームタイトル',
  `information`   text                                          COMMENT 'チャットルーム説明',
  `design`        int unsigned  NOT NULL DEFAULT '0'            COMMENT 'チャットログデザイン（0：文字色＆背景色ありのデフォルト 1：文字色のみ情報量重視）',
  `published`     int unsigned  NOT NULL DEFAULT '1'            COMMENT '公開するか？（0:非公開 1:公開）',
  `readonly`      int unsigned  NOT NULL DEFAULT '1'            COMMENT '管理人のみルーム説明編集可能か？（0:ユーザーも可能な自由設定ルーム 1:管理人のみ可能）',
  `displayno`     int unsigned  NOT NULL DEFAULT '0'            COMMENT '表示順序',
  `omikuji1flg`   int unsigned  NOT NULL DEFAULT '0'            COMMENT 'おみくじ1を表示するか？（0:非表示 1:表示）',
  `omikuji1name`  varchar(10)   NOT NULL DEFAULT 'おみくじ1'     COMMENT 'おみくじ1タイトル',
  `omikuji1text`  text                                          COMMENT 'おみくじ1内容（複数の場合は,区切り）',
  `omikuji2flg`   int unsigned  NOT NULL DEFAULT '0'            COMMENT 'おみくじ2を表示するか？（0:非表示 1:表示）',
  `omikuji2name`  varchar(10)   NOT NULL DEFAULT 'おみくじ2'     COMMENT 'おみくじ2タイトル',
  `omikuji2text`  text                                          COMMENT 'おみくじ2内容（複数の場合は,区切り）',
  `deck1flg`      int unsigned  NOT NULL DEFAULT '0'            COMMENT '手札1を表示するか？',
  `deck1name`     varchar(10)   NOT NULL DEFAULT '手札'         COMMENT '手札1タイトル',
  `deck1text`     text                                          COMMENT '手札1内容（複数の場合は,区切り。初期処理後は頭に#が付与。0#が山札内、1#がひかれたカード。文章内に#がある場合意図しない挙動になる可能性あり）',
  `modified`      datetime      NOT NULL                        COMMENT '更新日',
  `created`       datetime      NOT NULL                        COMMENT '作成日',
  PRIMARY KEY (`id`)
)
  ENGINE=InnoDB
  AUTO_INCREMENT=1
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='チャットルーム'
;

CREATE TABLE `chat_logs` (
  `id`                    int unsigned  NOT NULL AUTO_INCREMENT        COMMENT 'チャットログID',
  `entry_key`             char(40)      NOT NULL DEFAULT '0'           COMMENT 'エントリーキー',
  `chat_room_key`         int unsigned  NOT NULL DEFAULT '0'           COMMENT 'チャットルームID',
  `chat_room_title`       varchar(15)   NOT NULL DEFAULT ''            COMMENT 'チャットルームタイトル',
  `chat_room_information` text                                         COMMENT 'チャットルーム説明',
  `color`                 varchar(7)    NOT NULL DEFAULT 'inherit'     COMMENT 'メッセージ文字色',
  `backgroundcolor`       varchar(11)   NOT NULL DEFAULT 'transparent' COMMENT 'メッセージ背景色',
  `chat_character_key`    int unsigned  NOT NULL DEFAULT '0'           COMMENT 'チャットキャラクターID',
  `fullname`              varchar(50)   DEFAULT NULL                   COMMENT 'チャットキャラクター名',
  `note`                  varchar(255)  DEFAULT NULL                   COMMENT 'チャット備考',
  `message`               text                                         COMMENT 'チャットメッセージ',
  `modified`              datetime      NOT NULL                       COMMENT '更新日',
  `created`               datetime      NOT NULL                       COMMENT '作成日',
  PRIMARY KEY (`id`),
  KEY `index_entry_key` (`entry_key`) USING BTREE
)
  ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='チャットログ'
;

CREATE TABLE `chat_log_warehouses` (
  `id`              int unsigned NOT NULL AUTO_INCREMENT COMMENT 'チャットログ倉庫ID',
  `entry_key`       char(40)     NOT NULL                COMMENT 'エントリーキー',
  `chat_room_title` varchar(15)  NOT NULL                COMMENT 'チャットルームタイトル',
  `characters`      text                                 COMMENT '参加者',
  `logs`            longtext                             COMMENT 'ログ文字列',
  `modified`        datetime     NOT NULL                COMMENT '更新日',
  `created`         datetime     NOT NULL                COMMENT '作成日',
  PRIMARY KEY (`id`)
)
  ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='チャットログ倉庫'
;

CREATE TABLE `chat_entries` (
  `id`                int unsigned NOT NULL AUTO_INCREMENT COMMENT 'チャット参加者ID',
  `chat_room_id`      int unsigned NOT NULL                COMMENT 'チャットルームID',
  `user_id`           int unsigned NOT NULL                COMMENT 'ユーザーID',
  `chat_character_id` int unsigned NOT NULL                COMMENT 'チャットキャラクターID',
  `entry_key`         char(40)     NOT NULL                COMMENT 'エントリーキー',
  `modified`          datetime     NOT NULL                COMMENT '更新日',
  `created`           datetime     NOT NULL                COMMENT '作成日',
  PRIMARY KEY (`id`),
  UNIQUE KEY `chat_entries_ibuk_1` (`chat_character_id`),
  KEY `chat_roomid` (`chat_room_id`),
  KEY `userid` (`user_id`),
  CONSTRAINT `chat_entries_ibfk_1` FOREIGN KEY (`chat_room_id`) REFERENCES `chat_rooms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `chat_entries_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `chat_entries_ibfk_3` FOREIGN KEY (`chat_character_id`) REFERENCES `chat_characters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
  ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='チャット参加者'
;

CREATE TABLE `battle_turns` (
  `id`                         int unsigned NOT NULL AUTO_INCREMENT COMMENT '戦闘ターン保存ID',
  `vs_fukoku_key`              int unsigned NOT NULL DEFAULT '0'    COMMENT '対戦相手キャラクターID',
  `vs_before_key`              int unsigned NOT NULL                COMMENT '先攻キャラクターID',
  `vs_after_key`               int unsigned NOT NULL                COMMENT '後攻キャラクターID',
  `battle_status`              int unsigned NOT NULL                COMMENT '戦闘ステータス',
  `battle_turn_count`          int unsigned NOT NULL DEFAULT '0'    COMMENT '戦闘ターン数',
  `attack_chat_character_key`  int unsigned NOT NULL DEFAULT '0'    COMMENT '攻撃キャラクターID',
  `defense_chat_character_key` int unsigned NOT NULL DEFAULT '0'    COMMENT '防御キャラクターID',
  `modified`                   datetime     NOT NULL                COMMENT '更新日',
  `created`                    datetime     NOT NULL                COMMENT '作成日',
  PRIMARY KEY (`id`)
)
  ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='戦闘ターン保存'
;

CREATE TABLE `battle_save_skills` (
  `id`                       int unsigned NOT NULL AUTO_INCREMENT COMMENT '戦闘スキル保存ID',
  `battle_turn_id`           int unsigned NOT NULL                COMMENT '戦闘ターン保存ID',
  `chat_character_id`        int unsigned NOT NULL                COMMENT 'チャットキャラクターID',
  `enemy_chat_character_key` int unsigned          DEFAULT NULL   COMMENT '対戦相手キャラクターID',
  `limit_skill_code`         int unsigned NOT NULL                COMMENT '覚醒スキルコード',
  `passive_skill_code`       int unsigned NOT NULL                COMMENT 'パッシブスキルコード',
  `battle_skill1_code`       int unsigned NOT NULL                COMMENT '戦闘スキルコード1',
  `battle_skill2_code`       int unsigned NOT NULL                COMMENT '戦闘スキルコード2',
  `battle_skill3_code`       int unsigned NOT NULL                COMMENT '戦闘スキルコード3',
  `battle_skill4_code`       int unsigned NOT NULL                COMMENT '戦闘スキルコード4',
  `battle_skill5_code`       int unsigned NOT NULL                COMMENT '戦闘スキルコード5',
  `battle_skill6_code`       int unsigned NOT NULL                COMMENT '戦闘スキルコード6',
  `battle_skill7_code`       int unsigned NOT NULL                COMMENT '戦闘スキルコード7',
  `modified`                 datetime     NOT NULL                COMMENT '更新日',
  `created`                  datetime     NOT NULL                COMMENT '作成日',
  PRIMARY KEY (`id`),
  KEY `battle_turn_id` (`battle_turn_id`),
  CONSTRAINT `battle_save_skills_ibfk_1` FOREIGN KEY (`battle_turn_id`) REFERENCES `battle_turns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
  ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='戦闘スキル保存'
;

CREATE TABLE `battle_logs` (
  `id`              int unsigned NOT NULL AUTO_INCREMENT COMMENT '戦闘ログID',
  `chat_log_id`     int unsigned NOT NULL                COMMENT 'チャットログID',
  `status`          text                                 COMMENT 'ステータス',
  `narration`       text                                 COMMENT 'ナレーション',
  `memo`            text                                 COMMENT '判定結果メモ',
  `modified`        datetime     NOT NULL                COMMENT '更新日',
  `created`         datetime     NOT NULL                COMMENT '作成日',
  PRIMARY KEY (`id`),
  KEY `chat_log_id` (`chat_log_id`),
  CONSTRAINT `battle_logs_ibfk_1` FOREIGN KEY (`chat_log_id`) REFERENCES `chat_logs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
  ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='戦闘ログ'
;

CREATE TABLE `battle_characters` (
  `id`                      int unsigned NOT NULL AUTO_INCREMENT COMMENT '戦闘キャラクター保存ID',
  `battle_turn_id`          int unsigned NOT NULL                COMMENT '戦闘ターン保存ID',
  `chat_character_id`       int unsigned NOT NULL                COMMENT 'チャットキャラクターID',
  `strength`                int unsigned NOT NULL                COMMENT '腕力',
  `dexterity`               int unsigned NOT NULL                COMMENT '敏捷',
  `stamina`                 int unsigned NOT NULL                COMMENT '体力',
  `spirit`                  int unsigned NOT NULL                COMMENT '精神',
  `hp`                      int NOT NULL                         COMMENT 'HP',
  `sp`                      int NOT NULL                         COMMENT 'SP',
  `combo`                   int NOT NULL          DEFAULT '0'    COMMENT 'コンボ',
  `continuous_turn_count`   int unsigned NOT NULL DEFAULT '0'    COMMENT '連続攻撃回数',
  `is_limit`                int NOT NULL          DEFAULT '0'    COMMENT '覚醒したか？',
  `limit_skill_code`        int unsigned NOT NULL DEFAULT '0'    COMMENT '覚醒スキルコード',
  `permanent_strength`      int unsigned NOT NULL DEFAULT '0'    COMMENT '恒久腕力補正',
  `temporary_strength`      int unsigned NOT NULL DEFAULT '0'    COMMENT '一時腕力補正',
  `permanent_hit_rate`      int unsigned NOT NULL DEFAULT '0'    COMMENT '恒久命中率補正',
  `temporary_hit_rate`      int unsigned NOT NULL DEFAULT '0'    COMMENT '一時命中率補正',
  `permanent_dodge_rate`    int unsigned NOT NULL DEFAULT '0'    COMMENT '恒久回避率補正',
  `temporary_dodge_rate`    int unsigned NOT NULL DEFAULT '0'    COMMENT '一時回避率補正',
  `defense_skill_code`      int unsigned NOT NULL DEFAULT '0'    COMMENT '防御スキルコード',
  `defense_skill_attribute` int unsigned NOT NULL DEFAULT '0'    COMMENT '防御スキル属性',
  `modified`                datetime     NOT NULL                COMMENT '更新日',
  `created`                 datetime     NOT NULL                COMMENT '作成日',
  PRIMARY KEY (`id`),
  KEY `chat_character_id` (`chat_character_id`),
  KEY `battle_turn_id` (`battle_turn_id`),
  CONSTRAINT `battle_characters_ibfk_1` FOREIGN KEY (`chat_character_id`) REFERENCES `chat_characters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `battle_characters_ibfk_2` FOREIGN KEY (`battle_turn_id`) REFERENCES `battle_turns` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
  ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='戦闘キャラクター保存'
;

CREATE TABLE `battle_character_statuses` (
  `id`                int unsigned NOT NULL AUTO_INCREMENT COMMENT '戦闘キャラクターステータス保存ID',
  `chat_character_id` int unsigned NOT NULL                COMMENT 'チャットキャラクターID',
  `level`             int unsigned NOT NULL DEFAULT '0'    COMMENT 'レベル',
  `strength`          int unsigned NOT NULL DEFAULT '0'    COMMENT '腕力',
  `dexterity`         int unsigned NOT NULL DEFAULT '0'    COMMENT '敏捷',
  `stamina`           int unsigned NOT NULL DEFAULT '0'    COMMENT '体力',
  `spirit`            int unsigned NOT NULL DEFAULT '0'    COMMENT '精神',
  PRIMARY KEY (`id`),
  KEY `chat_character_id` (`chat_character_id`),
  CONSTRAINT `battle_character_statuses_ibfk_1` FOREIGN KEY (`chat_character_id`) REFERENCES `chat_characters` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
)
  ENGINE=InnoDB
  DEFAULT CHARSET=utf8mb4
  COLLATE=utf8mb4_general_ci
  COMMENT='戦闘キャラクターステータス保存'
;
