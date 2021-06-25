<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2020 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: Global.php 9747 2012-07-26 02:08:08Z john $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    Blog
 * @copyright  Copyright 2006-2020 Webligo Developments
 * @license    http://www.socialengine.com/license/
 */
class Bill_Form_Admin_Global extends Engine_Form
{
  public function init()
  {

    $this
      ->setTitle('Global Settings')
      ->setDescription('These settings affect all members in your community.');
/*
    $this->addElement('Radio', 'blog_public', array(
      'label' => 'Public Permissions',
      'description' => "BLOG_FORM_ADMIN_GLOBAL_BLOGPUBLIC_DESCRIPTION",
      'multiOptions' => array(
        1 => 'Yes, the public can view blogs unless they are made private.',
        0 => 'No, the public cannot view blogs.'
      ),
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('blog.public', 1),
    ));
*/
    $this->addElement('Text', 'bill_page', array(
      'label' => 'Entries Per Page',
      'description' => 'How many Bill entries will be shown per page? (Enter a number between 1 and 999)',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('bill.page', 10),
    ));
    // $this->bill_page->getDecorator("Description")->setOption("placement", "append");


     $this->addElement('Text', 'bill_cgst', array(
      'label' => 'CGST Tax %(For Haryana state)',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('bill.cgst', 9),
    ));
    // $this->cgst->getDecorator("Description")->setOption("placement", "prepend");


      $this->addElement('Text', 'bill_sgst', array(
      'label' => 'SGST Tax %(For Haryana state)',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('bill.sgst', 9),
    ));
    // $this->sgst->getDecorator("Description")->setOption("placement", "prepend");


      $this->addElement('Text', 'bill_igst', array(
      'label' => 'IGST Tax %(For Out of Haryana state)',
      'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('bill.igst', 18),
    ));
    // $this->igst->getDecorator("Description")->setOption("placement", "prepend");


      $this->addElement('Radio', 'bill_allow_unauthorized', array(
          'label' => 'Make unauthorized bills searchable?',
          'description' => 'Do you want to make a unauthorized bills searchable? (If set to no, bills that are not authorized for the current user will not be displayed in the bills search results and widgets.)',
          'value' => Engine_Api::_()->getApi('settings', 'core')->getSetting('bill.allow.unauthorized',0),
          'multiOptions' => array(
              '1' => 'Yes',
              '0' => 'No',
          ),
      ));
    // Add submit button
    $this->addElement('Button', 'submit', array(
      'label' => 'Save Changes',
      'type' => 'submit',
      'ignore' => true
    ));
  }
}
