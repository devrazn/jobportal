ALTER TABLE `tbl_users`
MODIFY COLUMN `user_type`  varchar(255) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL COMMENT '0: JobSeeker, 1:Employer' AFTER `phone`;

ALTER TABLE `tbl_user_messages`
ADD COLUMN `user_id`  integer NULL DEFAULT NULL AFTER `email`;

