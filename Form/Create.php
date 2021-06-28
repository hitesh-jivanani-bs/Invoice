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

$this->addElement('Select', 'status', array(
            'label' => 'Status',
            'multiOptions' => array("paid"=>"Paid", "unpaid"=>"Unpaid"),
        ));
        // Element: submit
        $this->addElement('Button', 'submit', array(
            'label' => 'Post Entry',
            'type' => 'submit',
        ));
    }


}






?>