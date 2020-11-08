
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user`
(
    `id`       int(11)      NOT NULL AUTO_INCREMENT,
    `username` varchar(255) DEFAULT NULL,
    `password` varchar(255) NULL DEFAULT NULL,
    `email`    varchar(255) NULL DEFAULT NULL,
    `full_name`    varchar(255) NULL DEFAULT NULL,
    `account_number`    varchar(255) NULL DEFAULT NULL,
    `phone`    varchar(16)      NULL DEFAULT NULL,
    `balance`  int(20)      NULL DEFAULT NULL,
    `bank_id`  varchar(11)      NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;
INSERT INTO `user`
VALUES (1, 'user1', '81dc9bdb52d04dc20036dbd8313ed055', 'user1@bank-a.com', 'Nguyen Van A', '123456789', '84123456789',
       10000000, 'bank_a');
INSERT INTO `user`
VALUES (2, 'user2', '81dc9bdb52d04dc20036dbd8313ed055', 'user2@bank-b.com', 'Nguyen Van B', '123456780', '8414567894',
       10000000, 'bank_b');

DROP TABLE IF EXISTS `log`;
CREATE TABLE `log`
(
    `id`       int(11)      NOT NULL AUTO_INCREMENT,
    `source` int(11)  NULL DEFAULT NULL,
    `destination` int(255) NULL DEFAULT NULL,
    `request_log`    varchar(255) NULL DEFAULT NULL,
    `response_log`    varchar(16)      NULL DEFAULT NULL,
    `amount`  int(20)      NULL DEFAULT NULL,
    `content`  varchar(255)      NULL DEFAULT NULL,
    `date`  varchar(20)      NULL DEFAULT NULL,

    PRIMARY KEY (`id`)
) ENGINE = InnoDB AUTO_INCREMENT = 1 CHARACTER SET = utf8 COLLATE = utf8_unicode_ci ROW_FORMAT = Dynamic;
