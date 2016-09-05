ALTER TABLE `tbl_user_map_jobs`
ADD COLUMN `notify_status`  tinyint(4) NOT NULL DEFAULT 0 AFTER `read_flag`;