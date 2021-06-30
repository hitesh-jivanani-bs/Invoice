<?php return array (
  'package' => 
  array (
    'type' => 'module',
    'name' => 'bill',
    'version' => '4.0.0',
    'path' => 'application/modules/Bill',
    'title' => 'Bill',
    'description' => '',
    'author' => '',
    'callback' => 
    array (
      'class' => 'Engine_Package_Installer_Module',
    ),
    'actions' => 
    array (
      0 => 'install',
      1 => 'upgrade',
      2 => 'refresh',
      3 => 'enable',
      4 => 'disable',
    ),

    'callback' => array(
      'path' => 'application/modules/Bill/settings/install.php',
      'class' => 'Bill_Installer',
    ),
    'directories' => 
    array (
      0 => 'application/modules/Bill',
    ),
    'files' => 
    array (
      0 => 'application/languages/en/bill.csv',
    ),
  ),
'items' => array(
    'bill',
    'products',
  ),



 // Hooks ---------------------------------------------------------------------
  'hooks' => array(
    array(
      'event' => 'onUserDeleteBefore',
      'resource' => 'Bill_Plugin_Core',
    ),
  ),

  'routes' => array(
    // Public
    
    'bill_general' => array(
      'route' => 'bill/:action/*',
      'defaults' => array(
        'module' => 'bill',
        'controller' => 'index',
        'action' => 'index',
      ),
      'reqs' => array(
        'action' => '(index|create|manage|style|tag|upload-photo)',
      ),
    ),

      'bill_edit' => array(
    'route' => 'bill/:action/:bill_id',
    'defaults' => array(
      'module' => 'bill',
      'controller' => 'index',
      'action' => 'edit',
    ),
    'reqs' => array(
      'action' => '(edit|delete|view)',
    ),
  ),
    
  ),

); ?>