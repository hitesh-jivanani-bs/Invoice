INSERT IGNORE INTO `engine4_core_modules` (`name`, `title`, `description`, `version`, `enabled`, `type`) VALUES  ('bill', 'Bill', '', '4.0.0', 1, 'extra') ;

INSERT IGNORE INTO `engine4_core_menuitems` (`name`, `module`, `label`, `plugin`, `params`, `menu`, `submenu`, `order`) VALUES
('core_main_bill', 'bill', 'Bills', '', '{"route":"bill_general","icon":"fa fa-pencil-alt"}', 'core_main', '', 4),
('bill_main_browse', 'bill', 'Browse Entries', 'Bill_Plugin_Menus::canViewBills', '{"route":"bill_general","icon":"fa fa-search"}', 'bill_main', '', 1),
('bill_main_manage', 'bill', 'My Entries', 'Bill_Plugin_Menus::canCreateBills', '{"route":"bill_general","action":"manage","icon":"fa fa-user"}', 'bill_main', '', 2),
('bill_main_create', 'bill', 'Write New Entry', 'Bill_Plugin_Menus::canCreateBills', '{"route":"bill_general","action":"create","icon":"fa fa-pencil-alt"}', 'bill_main', '', 3),


('bill_admin_main_manage', 'bill', 'View Bills', '', '{"route":"admin_default","module":"bill","controller":"manage"}', 'bill_admin_main', '', 1),
('bill_admin_main_settings', 'bill', 'Global Settings', '', '{"route":"admin_default","module":"bill","controller":"settings"}', 'bill_admin_main', '', 2),
('bill_admin_main_level', 'bill', 'Member Level Settings', '', '{"route":"admin_default","module":"bill","controller":"level"}', 'bill_admin_main', '', 3),
('core_admin_main_plugins_bill', 'bill', 'Bills', '', '{"route":"admin_default","module":"bill","controller":"manage"}', 'core_admin_main_plugins', '', 999);




INSERT INTO engine4_authorization_levels ( title, description, type, flag) 
VALUES ('Creator', 'Invoice Creator', 'user', NULL);


--
-- Dumping data for table engine4_authorization_permissions
--

INSERT INTO engine4_authorization_permissions (level_id, type, name, value, params) VALUES
(1, 'bill', 'create', 1, NULL),
(1, 'bill', 'delete', 2, NULL),
(1, 'bill', 'edit', 2, NULL),
(1, 'bill', 'view', 2, NULL),
(2, 'bill', 'create', 1, NULL),
(2, 'bill', 'delete', 2, NULL),
(2, 'bill', 'edit', 2, NULL),
(2, 'bill', 'view', 2, NULL),
(3, 'bill', 'create', 0, NULL),
(3, 'bill', 'delete', 0, NULL),
(3, 'bill', 'edit', 0, NULL),
(3, 'bill', 'view', 0, NULL),
(4, 'bill', 'create', 0, NULL),
(4, 'bill', 'delete', 0, NULL),
(4, 'bill', 'edit', 0, NULL),
(4, 'bill', 'view', 0, NULL),
(5, 'bill', 'view', 0, NULL),
(6, 'bill', 'create', 1, NULL),
(6, 'bill', 'delete', 1, NULL),
(6, 'bill', 'edit', 1, NULL),
(6, 'bill', 'view', 1, NULL);



--
-- Dumping data for table `engine4_core_settings`
--

INSERT INTO `engine4_core_settings` (`name`, `value`) VALUES
('bill.allow.unauthorized', '1'),
('bill.cgst', '9'),
('bill.igst', '18'),
('bill.page', '6'),
('bill.sgst', '9'),
('blog.allow.unauthorized', '0'),
('blog.page', '2');

