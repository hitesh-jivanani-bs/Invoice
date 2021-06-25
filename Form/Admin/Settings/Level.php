<?php
/**
 * SocialEngine
 *
 * @category   Application_Extensions
 * @package    bill
 * @copyright  Copyright 2006-2020 Webligo Developments
 * @license    http://www.socialengine.com/license/
 * @version    $Id: Level.php 10100 2013-10-24 23:09:16Z guido $
 * @author     Jung
 */

/**
 * @category   Application_Extensions
 * @package    bill
 * @copyright  Copyright 2006-2020 Webligo Developments
 * @license    http://www.socialengine.com/license/
 */
class Bill_Form_Admin_Settings_Level extends Authorization_Form_Admin_Level_Abstract
{
    public function init()
    {
        parent::init();

        // My stuff
        $this
            ->setTitle('Member Level Settings')
            ->setDescription("These settings are applied on a per member level basis. Start by selecting the member level you want to modify, then adjust the settings for that level below.
            ");

        // Element: view
        $this->addElement('Radio', 'view', array(
            'label' => 'Allow Viewing of bills?',
            'description' => 'Do you want to let members view bills? If set to no, some other settings on this page may not apply.',
            'multiOptions' => array(
                2 => 'Yes, allow viewing of all bills, even private ones.',
                1 => 'Yes, allow viewing of bills.',
                0 => 'No, do not allow bills to be viewed.',
            ),
            'value' => ( $this->isModerator() ? 2 : 1 ),
        ));
        if( !$this->isModerator() ) {
            unset($this->view->options[2]);
        }

        if( !$this->isPublic() ) {

            // Element: create
            $this->addElement('Radio', 'create', array(
                'label' => 'Allow Creation of bills?',
                'description' => 'Do you want to let members create bills? If set to no, some other settings on this page may not apply. This is useful if you want members to be able to view bills, but only want certain levels to be able to create bills.',
                'multiOptions' => array(
                    1 => 'Yes, allow creation of bills.',
                    0 => 'No, do not allow bills to be created.'
                ),
                'value' => 1,
            ));

            // Element: edit
            $this->addElement('Radio', 'edit', array(
                'label' => 'Allow Editing of bills?',
                'description' => 'Do you want to let members edit bills? If set to no, some other settings on this page may not apply.',
                'multiOptions' => array(
                    2 => 'Yes, allow members to edit all bills.',
                    1 => 'Yes, allow members to edit their own bills.',
                    0 => 'No, do not allow members to edit their bills.',
                ),
                'value' => ( $this->isModerator() ? 2 : 1 ),
            ));
            if( !$this->isModerator() ) {
                unset($this->edit->options[2]);
            }

            // Element: delete
            $this->addElement('Radio', 'delete', array(
                'label' => 'Allow Deletion of bills?',
                'description' => 'Do you want to let members delete bills? If set to no, some other settings on this page may not apply.',
                'multiOptions' => array(
                    2 => 'Yes, allow members to delete all bills.',
                    1 => 'Yes, allow members to delete their own bills.',
                    0 => 'No, do not allow members to delete their bills.',
                ),
                'value' => ( $this->isModerator() ? 2 : 1 ),
            ));
            if( !$this->isModerator() ) {
                unset($this->delete->options[2]);
            }

            // Element: comment
            $this->addElement('Radio', 'comment', array(
                'label' => 'Allow Commenting on bills?',
                'description' => 'Do you want to let members of this level comment on bills?',
                'multiOptions' => array(
                    2 => 'Yes, allow members to comment on all bills, including private ones.',
                    1 => 'Yes, allow members to comment on bills.',
                    0 => 'No, do not allow members to comment on bills.',
                ),
                'value' => ( $this->isModerator() ? 2 : 1 ),
            ));
            if( !$this->isModerator() ) {
                unset($this->comment->options[2]);
            }

            // Element: auth_view
            $this->addElement('MultiCheckbox', 'auth_view', array(
                'label' => 'bill Entry Privacy',
                'description' => 'Your members can choose from any of the options checked below when they decide who can see their bill entries. These options appear on your members\' "Add Entry" and "Edit Entry" pages. If you do not check any options, settings will default to the last saved configuration. If you select only one option, members of this level will not have a choice.',
                'multiOptions' => array(
                    'everyone'            => 'Everyone',
                    'registered'          => 'All Registered Members',
                    'owner_network'       => 'Friends and Networks',
                    'owner_member_member' => 'Friends of Friends',
                    'owner_member'        => 'Friends Only',
                    'owner'               => 'Just Me'
                ),
                'value' => array('everyone', 'owner_network', 'owner_member_member', 'owner_member', 'owner'),
            ));

            // Element: auth_comment
            $this->addElement('MultiCheckbox', 'auth_comment', array(
                'label' => 'bill Comment Options',
                'description' => 'Your members can choose from any of the options checked below when they decide who can post comments on their entries. If you do not check any options, settings will default to the last saved configuration. If you select only one option, members of this level will not have a choice.',
                'multiOptions' => array(
                    'everyone'            => 'Everyone',
                    'registered'          => 'All Registered Members',
                    'owner_network'       => 'Friends and Networks',
                    'owner_member_member' => 'Friends of Friends',
                    'owner_member'        => 'Friends Only',
                    'owner'               => 'Just Me'
                ),
                'value' => array('everyone', 'owner_network', 'owner_member_member', 'owner_member', 'owner'),
            ));

            // Element: allow_network
            $this->addElement('Radio', 'allow_network', array(
                'label' => 'Allow to Choose Network Privacy?',
                'description' => 'Do you want to let members of this level choose Network Privacy for their bills? These options appear on your members\' "Add Entry" and "Edit Entry" pages.',
                'multiOptions' => array(
                    1 => 'Yes, allow to choose Network Privacy.',
                    0 => 'No, do not allow to choose Network Privacy. '
                ),
                'value' => 1,
            ));

            // Element: style
            $this->addElement('Radio', 'style', array(
                'label' => 'Allow Custom CSS Styles?',
                'description' => 'If you enable this feature, your members will be able to customize the colors and fonts of their bills by altering their CSS styles.',
                'multiOptions' => array(
                    1 => 'Yes, enable custom CSS styles.',
                    0 => 'No, disable custom CSS styles.',
                ),
                'value' => 1,
            ));

            // Element: auth_html
            $this->addElement('Text', 'auth_html', array(
                'label' => 'HTML in bill Entries?',
                'description' => 'If you want to allow specific HTML tags, you can enter them below (separated by commas). Example: b, img, a, embed, font',
                'value' => 'strong, b, em, i, u, strike, sub, sup, p, div, pre, address, h1, h2, h3, h4, h5, h6, span, ol, li, ul, a, img, embed, br, hr'
            ));

            // Element: max
            $this->addElement('Text', 'max', array(
                'label' => 'Maximum Allowed bill Entries?',
                'description' => 'Enter the maximum number of allowed bill entries. The field must contain an integer between 1 and 999, or 0 for unlimited.',
                'validators' => array(
                    array('Int', true),
                    new Engine_Validate_AtLeast(0),
                ),
            ));
            $this->addElement('FloodControl', 'flood', array(
                'label' => 'Maximum Allowed bill Entries per Duration',
                'description' => 'Enter the maximum number of bill entries allowed for the selected duration (per minute / per hour / per day) for members of this level. The field must contain an integer between 1 and 9999, or 0 for unlimited.',
                'required' => true,
                'allowEmpty' => false,
                'value' => array(0, 'minute'),
            ));
        }
    }
}
