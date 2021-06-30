<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2020 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: install.php 9895 2013-02-14 00:12:22Z shaun $
 * @author     Steve
 */

/**
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2020 Webligo Developments
 * @license    http://www.socialengine.com/license/
 */
class Bill_Installer extends Engine_Package_Installer_Module
{

    public function onInstall()
    {
        $db = $this->getDb();
        if($this->_databaseOperationType != 'upgrade'){
            $this->_addBillIndexPage();

        }
        // $this->_addPrivacyColumn();
        parent::onInstall();
    }

    protected function _addBillIndexPage()
    {
        $db = $this->getDb();

        // profile page
        $pageId = $db->select()
            ->from('engine4_core_pages', 'page_id')
            ->where('name = ?', 'bill_index_index')
            ->limit(1)
            ->query()
            ->fetchColumn();

        // insert if it doesn't exist yet
        if( !$pageId ) {
            // Insert page
            $db->insert('engine4_core_pages', array(
                'name' => 'bill_index_index',
                'displayname' => 'Invoices',
                'title' => 'Invoices',
                'description' => 'This page lists a user\'s invoices entries.',
                'custom' => 0,
            ));
            $pageId = $db->lastInsertId();

     

            // Insert main-middle
            $db->insert('engine4_core_content', array(
                'type' => 'container',
                'name' => 'middle',
                'page_id' => $pageId,
                'parent_content_id' => $mainId,
                'order' => 2,
            ));
            $mainMiddleId = $db->lastInsertId();

            // Insert main-right
            $db->insert('engine4_core_content', array(
                'type' => 'container',
                'name' => 'right',
                'page_id' => $pageId,
                'parent_content_id' => $mainId,
                'order' => 1,
            ));
            $mainRightId = $db->lastInsertId();

            

            // Insert content
            $db->insert('engine4_core_content', array(
                'type' => 'widget',
                'name' => 'core.content',
                'page_id' => $pageId,
                'parent_content_id' => $mainMiddleId,
                'order' => 1,
            ));

            // Insert search
            $db->insert('engine4_core_content', array(
                'type' => 'widget',
                'name' => 'bill.browse-search',
                'page_id' => $pageId,
                'parent_content_id' => $mainRightId,
                'order' => 1,
            ));

           
        }
    }


    
}
?>
