INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES  ('bill', 'Bill', '', '4.0.0', 1, 'extra') ;

INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('core_main_bill', 'bill', 'Bills', '', '{"route":"bill_general","icon":"fa fa-pencil-alt"}', 'core_main', '', 4),

('bill_admin_main_manage', 'bill', 'View Bills', '', '{"route":"admin_default","module":"bill","controller":"manage"}', 'bill_admin_main', '', 1),
('bill_admin_main_settings', 'bill', 'Global Settings', '', '{"route":"admin_default","module":"bill","controller":"settings"}', 'bill_admin_main', '', 2),
('bill_admin_main_level', 'bill', 'Member Level Settings', '', '{"route":"admin_default","module":"bill","controller":"level"}', 'bill_admin_main', '', 3),
('core_admin_main_plugins_bill', 'bill', 'Bills', '', '{"route":"admin_default","module":"bill","controller":"manage"}', 'core_admin_main_plugins', '', 999);