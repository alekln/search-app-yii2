-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.31-log - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for halo
CREATE DATABASE IF NOT EXISTS `halo` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `halo`;

-- Dumping structure for table halo.migration
CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table halo.migration: ~121 rows (approximately)
/*!40000 ALTER TABLE `migration` DISABLE KEYS */;
INSERT IGNORE INTO `migration` (`version`, `apply_time`) VALUES
	('m130524_201442_init', 1568827046),
	('m140506_102106_rbac_init', 1568827046),
	('m150125_135015_init_config', 1571050821),
	('m200327_092846_change_email_template_name', 1585306586),
	('m200330_113703_change_referral', 1588665307),
	('m200505_075009_last_name_to_null', 1588665315),
	('m200521_102611_customer_update', 1590057321),
	('m200529_114802_customer_verification_case_update', 1591345073),
	('m200529_115209_customer_balance_2_contract_balance', 1591345088),
	('m200529_115828_contract_update', 1591345097),
	('m200602_101441_product_related_changes', 1591345106),
	('m200605_080542_contract_account_creation', 1591346112),
	('m200605_102241_contract_invitation_changes', 1591353996),
	('m200605_104523_contract_hotfix', 1591353996),
	('m200605_124600_verification_case_changes', 1591361999),
	('m200605_125725_contract_remove_account_data', 1591361999),
	('m200605_130505_product_interval_table', 1591362548),
	('m200609_125336_payment_plan_with_customer', 1591707334),
	('m200611_112936_product_group_add_code_name', 1592491180),
	('m200615_095247_intervals_table', 1592491180),
	('m200616_105249_bug_fixing', 1592491336),
	('m200617_093656_add_profile_image', 1592491419),
	('m200617_124513_HALO_minor_changes', 1592491420),
	('m200618_124513_HALO_create_contract_notification_table', 1594115543),
	('m200630_091343_add_contract_contributor', 1594386762),
	('m200706_070423_update_contract_invite_table', 1594652418),
	('m200709_075508_add_contract_notification_template', 1594652418),
	('m200710_073330_create_contract_contributor_table', 1594652418),
	('m200714_122712_admin_tempaltes_update_site_urls', 1595251333),
	('m200720_130831_contributors', 1595251333),
	('m200721_082750_collect_interest', 1595320197),
	('m200721_105206_rollover_product', 1595328809),
	('m200721_135118_contribution_amount', 1595339663),
	('m200722_104355_customer_able_to_apply_product', 1596099265),
	('m200723_115940_transfer_recipient_name', 1595505668),
	('m200729_083941_add_name_transfer_recipient', 1596099265),
	('m200811_120905_sync_payment_plan_cron_job_add_to_queue', 1598951784),
	('m200825_120926_contribuotr', 1598357782),
	('m200827_133901_contributor_contstraint', 1598536032),
	('m200831_200646_contract_contributor_update', 1600080391),
	('m200901_091435_contract_collect_interest_true_default', 1598952011),
	('m200903_042029_update_customer_balance_by_type_column', 1600073326),
	('m200903_091518_product_group_update', 1599556213),
	('m200904_122024_proudct_group_permissions', 1599556213),
	('m200908_043606_udpate_contract_message', 1600080391),
	('m200914_084646_nickname', 1600073467),
	('m200921_210655_product_group_update', 1600941432),
	('m200924_112347_league', 1600947675),
	('m200924_114403_league_permissions', 1600948988),
	('m200924_114610_intervals_permissions', 1600948988),
	('m200924_115025_league_products', 1600948988),
	('m200924_130028_league_on_contract', 1601282005),
	('m200924_130317_score_ponts_contract', 1601282005),
	('m200925_082233_template_fix', 1601282005),
	('m200925_083915_contract_id_default_fix_notification', 1601282005),
	('m200928_083020_contract_balance_update', 1601282023),
	('m200928_141954_update_contract_notifications', 1602150218),
	('m201005_064935_transaction_update', 1602150219),
	('m201006_081300_customer_nuban', 1602156231),
	('m201009_114745_verification_case_paystack', 1602587257),
	('m201011_120909_nubangeneration_job', 1628005828),
	('m201013_110310_customer_update_fullname', 1602587297),
	('m201013_145139_customer_bvn_public', 1603278919),
	('m201020_074311_admin_template_customer_default', 1603804034),
	('m201020_084311_product_group', 1603278919),
	('m201021_111212_notifications_created', 1603278981),
	('m201022_100707_email_updates', 1603361874),
	('m201022_122808_email_contract_contribution', 1603369908),
	('m201023_100708_email_updates', 1631111839),
	('m201027_130426_add', 1603815062),
	('m201027_163039_customer_bvn_table', 1603816582),
	('m201030_104708_eventlog', 1604055160),
	('m201106_103730_nuban_notification', 1604659300),
	('m201106_122106_nubanjob', 1604665668),
	('m201110_102625_referral_syntax_uid', 1605613879),
	('m201110_102625_referral_uid', 1605613879),
	('m201117_115229_referral', 1605614041),
	('m201118_144906_can_invite_league', 1605711033),
	('m201118_150412_invitation_uid_key', 1605711913),
	('m201118_170252_authorization_changes', 1605719207),
	('m201119_133532_flexi_account_to_my_cash_account', 1605793646),
	('m201120_121927_email_layout_updates', 1605877776),
	('m201120_133646_contract_authorization_id', 1605879456),
	('m201120_134859_CUSTOMER_GOAL_INVITATION', 1605881085),
	('m201120_192025_signature', 1605900232),
	('m201123_083809_templates_update', 1606124982),
	('m201124_153818_template', 1606322633),
	('m201125_164149_authorizaiton_transaction', 1606322662),
	('m201125_164554_customer_bank_account_drop', 1606323168),
	('m201127_122220_league_invitatio_accepted_notification', 1606739861),
	('m201130_123515_customer_league_owner', 1606739861),
	('m201202_104448_templates_update', 1606906002),
	('m201202_133839_league_withdraw_disable', 1606916430),
	('m201203_103455_league_publicity_control', 1606991746),
	('m201204_110559_layout_update_4122020', 1607080033),
	('m201218_151742_impersonation_table', 1608307593),
	('m201218_165141_default_invitation_template', 1608310718),
	('m201228_110030_contract_is_personal', 1609153288),
	('m201229_080128_templates_league_update', 1609229066),
	('m201229_085407_flexi_2_cash_account', 1609232196),
	('m201231_121820_intervals_update', 1609417546),
	('m210104_085945_contract_finishing_templates', 1609752982),
	('m210109_110207_custom_product', 1610352645),
	('m210111_080200_custom_product_permission', 1628005828),
	('m210111_091643_new_custom_product', 1628005828),
	('m210208_091811_otp_pass_tmpl', 1628005828),
	('m210222_080303_contribution_anonymous', 1628005828),
	('m210302_073944_notifications_changes', 1628005828),
	('m210303_074427_fixed_unit_price', 1628005828),
	('m210305_160141_product_units_count', 1628005828),
	('m210311_160603_earning_invitation', 1628005828),
	('m210326_101522_missing_notification', 1628005828),
	('m210406_113318_product_category_2_category_id', 1628005828),
	('m210409_152732_product_dividend', 1628005828),
	('m210412_070728_earning_stat', 1628005828),
	('m210413_110434_distribution_id_earning', 1628005828),
	('m210630_140148_alter_expected_return_column_to_custom_product_table', 1628005903),
	('m210705_072924_alter_links_in_email_template', 1628005903),
	('m210706_072925_alter_links_in_email_template', 1631111839),
	('m210708_080805_missing_sync_job', 1628005903),
	('m210810_130235_daily_interest_calculation_job', 1628600705),
	('zhuravljov\\yii\\queue\\monitor\\migrations\\M180807000000Schema', 1571814746),
	('zhuravljov\\yii\\queue\\monitor\\migrations\\M190420000000ExecResult', 1598952004);
/*!40000 ALTER TABLE `migration` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
