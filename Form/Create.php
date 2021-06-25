<?php

class Bill_Form_Create extends Engine_Form
{
    public function init()
    {

        $this->setTitle('Write New Entry')
            ->setDescription('Compose your new invoice entry below, then click "Post Entry" to save the entry.');
        // $user = Engine_Api::_()->user()->getViewer();
        // $userLevel = Engine_Api::_()->user()->getViewer()->level_id;
             $this->addElement('Select', 'domain', array(
            'label' => 'Domain',
            'description' => 'Please select the domain',
            'multiOptions' => array("0"=>"SocialEngineAddOns", "1"=>"Prime Messenger / Channelize.io", "2"=>"AlmaHub", "3"=>"MageCube",'"4'=>"Other Projects"),
        ));


        $this->addElement('Text', 'name', array(
            'label' => 'Name(Bill to)',
            'allowEmpty' => false,
            'required' => true,
            'maxlength' => '63',
            'filters' => array(
                new Engine_Filter_Censor(),
                'StripTags',
                new Engine_Filter_StringLength(array('max' => '63'))
            ),
            'autofocus' => 'autofocus',
        ));

        // init to
        $this->addElement('Text', 'address', array(
            'label'=>'Address',
            'autocomplete' => 'off',
            'allowEmpty' => false,
            'required' => true,
            'maxlength' => '500',
            'filters' => array(
                 new Engine_Filter_Censor(),
                'StripTags',
                new Engine_Filter_StringLength(array('max' => '500'))
            ),
        ));



            $this->addElement('Text', 'email', array(
            'label'=>'Email',
            'autocomplete' => 'off',
            'inputType' => 'email',
            'autofocus' => 'autofocus',
            'tabindex' => $tabIndex++,
            'allowEmpty' => false,
            'required' => true,
            'maxlength' => '50',
            'filters' => array(
                 new Engine_Filter_Censor(),
                'StripTags',
                new Engine_Filter_StringLength(array('max' => '50'))
            ),

        ));



 $this->addElement('Select', 'currencies', array(
            'label' => 'Currencies',
            'multiOptions' => array("0"=>"USD", "1"=>"INR"),
            'onchange' => 'isUsd(this.value);'
        ));


         $this->addElement('Select', 'state', array(
            'label' => 'State',
            'multiOptions' => array("Haryana"=>"Haryana", "Out of Haryana"=>"Out of Haryana"),
        ));
            $this->addElement('Text', 'number', array(
            'label'=>'Mobile Number',
            'id'=>'number',
            'autocomplete' => 'off',
            'allowEmpty' => false,
            'required' => true,
            'maxlength' => '12',
            'filters' => array(
                 new Engine_Filter_Censor(),
                'StripTags',
                new Engine_Filter_StringLength(array('max' => '12'))
            ),
        ));

       
            
 $this->addElement('hidden', 'room', array(
            'id'=>'room',
            'autocomplete' => 'off',
            'allowEmpty' => false,
            'inputType' => 'number',
        ));
$this->addElement('Text', 'discount', array(
            'label'=>'Discount(%)',
            'autocomplete' => 'off',
            'allowEmpty' => false,
            'required' => true,
            'maxlength' => '500',
        ));
 $this->addElement('Button', 'addmore', array(
            'label' => 'Add more products',
            'onclick' => "addelement()",
            'id'=>'addmore',
        ));

        // prepare categories

        // $categories = Engine_Api::_()->getDbtable('categories', 'blog')->getCategoriesAssoc();
        // if( count($categories) > 0 ) {
        //     $this->addElement('Select', 'category_id', array(
        //         'label' => 'Category',
        //         'multiOptions' => $categories,
        //     ));
        // }



    


        // $allowedHtml = Engine_Api::_()->authorization()->getPermission($userLevel, 'blog', 'auth_html');
        // $uploadUrl = "";

        // if( Engine_Api::_()->authorization()->isAllowed('album', $user, 'create') ) {
        //     $uploadUrl = Zend_Controller_Front::getInstance()->getRouter()->assemble(array('action' => 'upload-photo'), 'blog_general', true);
        // }

        // $editorOptions = array(
        //     'uploadUrl' => $uploadUrl,
        //     'html' => (bool) $allowedHtml,
        // );

        // $this->addElement('TinyMce', 'body', array(
        //     'disableLoadDefaultDecorators' => true,
        //     'required' => true,
        //     'allowEmpty' => false,
        //     'decorators' => array(
        //         'ViewHelper'
        //     ),
        //     'editorOptions' => $editorOptions,
        //     'filters' => array(
        //         new Engine_Filter_Censor(),
        //         new Engine_Filter_Html(array('AllowedTags' => $allowedHtml))),
        // ));

        // $this->addElement('File', 'photo', array(
        //     'label' => 'Choose Profile Photo',
        // ));
        // $this->photo->addValidator('Extension', false, 'jpg,png,gif,jpeg');

        // $this->addElement('Checkbox', 'search', array(
        //     'label' => 'Show this blog entry in search results',
        //     'value' => 1,
        // ));

        // if (Engine_Api::_()->authorization()->isAllowed('blog', $user, 'allow_network')) {
        //     $networkOptions = array();
        //     foreach (Engine_Api::_()->getDbTable('networks', 'network')->fetchAll() as $network) {
        //         $networkOptions[$network->network_id] = $network->getTitle();
        //     }
        //     //Networks
        //     $this->addElement('Multiselect', 'networks', array(
        //         'description' => 'Choose the Networks to which this Blog will be displayed.',
        //         'multiOptions' => $networkOptions,
        //     ));
        // }

        // // Element: auth_view
        // $viewOptions = (array) Engine_Api::_()->authorization()->getAdapter('levels')->getAllowed('blog', $user, 'auth_view');
        // // Element: auth_comment
        // $commentOptions = (array) Engine_Api::_()->authorization()->getAdapter('levels')->getAllowed('blog', $user, 'auth_comment');

        // if( $this->_parent_type == 'user' ) {
        //     $availableLabels = array(
        //         'everyone'            => 'Everyone',
        //         'registered'          => 'All Registered Members',
        //         'owner_network'       => 'Friends and Networks',
        //         'owner_member_member' => 'Friends of Friends',
        //         'owner_member'        => 'Friends Only',
        //         'owner'               => 'Just Me'
        //     );
        //     $viewOptions = array_intersect_key($availableLabels, array_flip($viewOptions));
        //     $commentOptions = array_intersect_key($availableLabels, array_flip($commentOptions));

        // } else if( $this->_parent_type == 'group' ) {

        //     $availableLabels = array(
        //         'everyone'      => 'Everyone',
        //         'registered'    => 'All Registered Members',
        //         'parent_member' => 'Group Members',
        //         'member'        => 'Blog Guests Only',
        //         'owner'         => 'Just Me',
        //     );
        //     $viewOptions = array_intersect_key($availableLabels, array_flip($viewOptions));
        //     $commentOptions = array_intersect_key($availableLabels, array_flip($commentOptions));
        // }

        // if( !empty($viewOptions) && count($viewOptions) >= 1 ) {
        //     // Make a hidden field
        //     if( count($viewOptions) == 1 ) {
        //         $this->addElement('hidden', 'auth_view', array( 'order' => 101, 'value' => key($viewOptions)));
        //         // Make select box
        //     } else {
        //         $this->addElement('Select', 'auth_view', array(
        //             'label' => 'Privacy',
        //             'description' => 'Who may see this blog entry?',
        //             'multiOptions' => $viewOptions,
        //             'value' => key($viewOptions),
        //         ));
        //         $this->auth_view->getDecorator('Description')->setOption('placement', 'append');
        //     }
        // }

        // if( !empty($commentOptions) && count($commentOptions) >= 1 ) {
        //     // Make a hidden field
        //     if( count($commentOptions) == 1 ) {
        //         $this->addElement('hidden', 'auth_comment', array('order' => 102, 'value' => key($commentOptions)));
        //         // Make select box
        //     } else {
        //         $this->addElement('Select', 'auth_comment', array(
        //             'label' => 'Comment Privacy',
        //             'description' => 'Who may post comments on this blog entry?',
        //             'multiOptions' => $commentOptions,
        //             'value' => key($commentOptions),
        //         ));
        //         $this->auth_comment->getDecorator('Description')->setOption('placement', 'append');
        //     }
        // }

        // $this->addElement('Hash', 'token', array(
        //     'timeout' => 3600,
        // ));
        
//         $spamSettings = Engine_Api::_()->getApi('settings', 'core')->core_spam;
//         $recaptchaVersionSettings = Engine_Api::_()->getApi('settings', 'core')->core_spam_recaptcha_version;
//         if($recaptchaVersionSettings == 0  && $spamSettings['recaptchaprivatev3'] && $spamSettings['recaptchapublicv3']) {
//           $this->addElement('captcha', 'captcha', Engine_Api::_()->core()->getCaptchaOptions());
//         }
        
        // Element: submit
        $this->addElement('Button', 'submit', array(
            'label' => 'Post Entry',
            'type' => 'submit',
        ));
    }


}






?>