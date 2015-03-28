USE zombier1_bottletrade;

ALTER TABLE  `user` ADD  `CreatedTime` DATETIME NOT NULL DEFAULT  '0000-00-00 00:00:00' AFTER  `ForgotPasswordTokenExpiration` ;