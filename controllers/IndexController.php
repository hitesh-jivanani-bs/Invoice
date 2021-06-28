<?php

class Bill_IndexController extends Core_Controller_Action_Standard
{
  public function indexAction()
  {
    $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
    ->getNavigation('bill_main');

    $this->_helper->content
            //->setNoRender()
    ->setEnabled()
    ;
if( !$this->_helper->requireAuth()->setAuthParams('bill', null, 'view')->isValid()) return;
    if (!$this->_helper->requireUser()->isValid()) return;



    $this->view->form = $form = new Bill_Form_Search();

    $viewer = Engine_Api::_()->user()->getViewer();
    $form->removeElement('draft');
    if( !$viewer->getIdentity() ) {
     $form->removeElement('show');
   }
 $defaultValues = $form->getValues();
  if( $form->isValid($this->_getAllParams()) ) {
            $values = $form->getValues();
        } else {
            $values = $defaultValues;
        }
        $this->view->formValues = array_filter($values);

      $this->view->assign($values);

       $this->view->paginator = $paginator = Engine_Api::_()->getItemTable('bill')->getInvoicesPaginator($values);
    $items_per_page = Engine_Api::_()->getApi('settings', 'core')->bill_page;
    $paginator->setItemCountPerPage($items_per_page);
    $this->view->paginator = $paginator->setCurrentPageNumber($this->_getParam('page'));


 }
 public function manageAction()
 {

  $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
  ->getNavigation('bill_main');
  if( !$this->_helper->requireUser()->isValid() ) return;
  $viewer = Engine_Api::_()->user()->getViewer();
  $values = $viewer->getIdentity();
if( !$this->_helper->requireAuth()->setAuthParams('bill', null, 'view')->isValid()) return;

  $this->view->paginator = $paginator = Engine_Api::_()->getItemTable('bill')->getOwnerBillsPaginator($values);
  $items_per_page = Engine_Api::_()->getApi('settings', 'core')->bill_page;
  $paginator->setItemCountPerPage($items_per_page);
  $this->view->paginator = $paginator->setCurrentPageNumber($this->_getParam('page'));


}
public function createAction()
{
  if (!$this->_helper->requireUser()->isValid()) return;
  $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
  ->getNavigation('bill_main');
if( !$this->_helper->requireAuth()->setAuthParams('bill', null, 'create')->isValid()) return;
  $viewer = Engine_Api::_()->user()->getViewer();
  $values['user_id'] = $viewer->getIdentity();
  $this->view->form = $form = new Bill_Form_Create();

  if (!$this->getRequest()->isPost()) {
    return;
  }

  if (!$form->isValid($this->getRequest()->getPost())) {
    return;
  }
  $v = $this->getRequest()->getPost();
  $formValues = $form->getValues();
    //getting tax value:
  $cgst = Engine_Api::_()->getApi('settings', 'core')->getSetting('bill.cgst', 9);
  $sgst = Engine_Api::_()->getApi('settings', 'core')->getSetting('bill.sgst', 9);
  $igst = Engine_Api::_()->getApi('settings', 'core')->getSetting('bill.igst', 18);


    //adding products....

  $servername = "localhost";
  $username = "root";
  $password = "bigstep";
  $dbname = "socialengine";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }


  $values = array_merge($formValues, array(
    'owner_type' => $viewer->getType(),
    'owner_id' => $viewer->getIdentity(),
    'view_privacy' => $formValues['auth_view'],
  ));
    //getting invoice number........
  $bill_number = '';
  $bill_number = Engine_Api::_()->getDbTable('bills', 'bill')->setBillNumber($values['domain'], $values['currencies']);
    // print_r($v);
    // die;
  $totalamount = 0.0;
  for ($i = 1; $i <= $v['room']; $i++) {
    if (!empty($v['p_name' . $i]) or !empty($v['quantity' . $i]) or !empty($v['price' . $i])or !empty($v['total' . $i])) {
      $p = $v['p_name' . $i];
      $q = $v['quantity' . $i];
      $pr = $v['price' . $i];
      $t = $v['total' . $i];
      $totalamount = (float)($totalamount + $t);
      $sql = "INSERT INTO engine4_bill_products VALUES (NULL,'$bill_number','$p','$q','$pr','$t')";
      if (!$conn->query($sql) === TRUE) {
        echo "Error: " . $sql . "<br>" . $conn->error;
        die();
      }
    }
  }
    //discount........
  $subtotal=$totalamount;
  $totalamount = (float)($totalamount - (($totalamount * $values['discount']) / 100));
  try {
      // Create blog
    $viewer = Engine_Api::_()->user()->getViewer();
    $formValues = $form->getValues();
    $values = array_merge($formValues, array(
      'owner_type' => $viewer->getType(),
      'owner_id' => $viewer->getIdentity(),
      'view_privacy' => $formValues['auth_view'],
    ));
      //set tax using currencies
    $r = $totalamount;
    if ($values['currencies'] == 0) {
      $cgst = $igst = $sgst = 0;
    }
    if ($values['currencies'] == 1) {
      if ($values['state'] === 'Haryana') {
        $igst = 0;
        $totalamount = (float)($totalamount + (float)((float)($r * $cgst) / 100));
        $totalamount = (float)($totalamount + (float)((float)($r * $sgst) / 100));
      }
      if ($values['state'] === 'Out of Haryana') {
        $cgst = $sgst = 0;
        $totalamount = (float)($totalamount + (($r * $igst) / 100));
      }
    }




      //invoice number generation

    $values['creator'] = $viewer->getTitle();
    date_default_timezone_set("Asia/Calcutta");
    $date = date('Y-m-d');
    $values['date'] = $date;
    $values['modified_date'] = $date;
    $values['subtotal']=$subtotal;
    $values['bill_number'] = $bill_number;
    $values['bill_number'] = $bill_number;
    $values['igst'] = $igst;
    $values['cgst'] = $cgst;
    $values['sgst'] = $sgst;
    $values['total'] = $totalamount;
    $table = Engine_Api::_()->getItemTable('bill');
    $db = $table->getAdapter();
    $db->beginTransaction();

    $bill = $table->createRow();
    $bill->setFromArray($values);
    $bill->save();
    $db->commit();
  } catch (Exception $e) {
    echo $e;
    die();
    return $this->exceptionWrapper($e, $form, $db);
  }
  return $this->_helper->redirector->gotoRoute(array('action' => 'create'));
}



public function editAction()
{
  $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
  ->getNavigation('bill_main');

  $viewer = Engine_Api::_()->user()->getViewer();
  $bill = Engine_Api::_()->getItem('bill', $this->_getParam('bill_id'));
  if( !$this->_helper->requireAuth()->setAuthParams('bill', null, 'edit')->isValid()) return;

    //database connection:

  $servername = "localhost";
  $username = "root";
  $password = "bigstep";
  $dbname = "socialengine";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $this->view->form = $form = new Bill_Form_Create();
  $form->populate($bill->toArray());
  $this->view->$bill_number = $bill['bill_number'];
  $billn=$bill_number;

  if (!$this->getRequest()->isPost()) {
    return;
  }
  if (!$form->isValid($this->getRequest()->getPost())) {
    return;
  }
  $v=$this->getRequest()->getPost();

//updating values.../updating in products table

  for($i=1;$i<=$v['room'];$i++){
    $sql = "DELETE FROM engine4_bill_products WHERE bill_number='$bill[bill_number]'";

    if ($conn->query($sql) === TRUE) {
    } else {
      echo "Error deleting record: " . $conn->error;
      die();
    }
  }
  $totalamount=0;
  for($i=1;$i<=$v['room'];$i++){

   if (!empty($v['p_name' . $i]) or !empty($v['quantity' . $i]) or !empty($v['price' . $i])or !empty($v['total' . $i])) {
    $p = $v['p_name' . $i];
    $q = $v['quantity' . $i];
    $pr = $v['price' . $i];
    $t = $v['total' . $i];
    $totalamount = (float)($totalamount + $t);

    $sql = "INSERT INTO engine4_bill_products VALUES (NULL,'$bill[bill_number]','$p','$q','$pr','$t')";
    if (!$conn->query($sql) === TRUE) {
      echo "Error: " . $sql . "<br>" . $conn->error;
      die();
    }
  }

}
$subtotal=$totalamount;

$table = Engine_Api::_()->getItemTable('bill');
$db = Engine_Db_Table::getDefaultAdapter();
$db->beginTransaction();
  //getting tax value:
$cgst = Engine_Api::_()->getApi('settings', 'core')->getSetting('bill.cgst', 9);
$sgst = Engine_Api::_()->getApi('settings', 'core')->getSetting('bill.sgst', 9);
$igst = Engine_Api::_()->getApi('settings', 'core')->getSetting('bill.igst', 18);
try {
      // Create bill
  $viewer = Engine_Api::_()->user()->getViewer();
  $values = $form->getValues();
  $totalamount = (float)($totalamount - (($totalamount * $formValues['discount']) / 100));
    //need to check all updation again..........
  $r = $totalamount;
  if ($values['currencies'] == 0) {
    $cgst = $igst = $sgst = 0;
  }
  if ($values['currencies'] == 1) {
    if ($values['state'] === 'Haryana') {
      $igst = 0;
      $totalamount = (float)($totalamount + (float)((float)($r * $cgst) / 100));
      $totalamount = (float)($totalamount + (float)((float)($r * $sgst) / 100));
    }
    if ($values['state'] === 'Out of Haryana') {
      $cgst = $sgst = 0;
      $totalamount = (float)($totalamount + (($r * $igst) / 100));
    }
  }
  $values['creator'] = $viewer->getTitle();
  date_default_timezone_set("Asia/Calcutta");
  $date = date('Y-m-d');
  $values['subtotal'] = $subtotal;
  $values['modified_date'] = $date;
  $values['igst'] = $igst;
  $values['cgst'] = $cgst;
  $values['sgst'] = $sgst;
  $values['total'] = $totalamount;



  $bill->setFromArray($values);
  $bill->save();
  $db->commit();
} catch (Exception $e) {
  return $this->exceptionWrapper($e, $form, $db);
}






return $this->_helper->redirector->gotoRoute(array('action' => 'manage'));
}


public function viewAction(){

  $this->view->navigation = $navigation = Engine_Api::_()->getApi('menus', 'core')
  ->getNavigation('bill_main');

  if( !$this->_helper->requireAuth()->setAuthParams('bill', null, 'view')->isValid()) return;

  $bill = Engine_Api::_()->getItem('bill', $this->_getParam('bill_id'));
          // print_r($bill->toArray());
          // die();
  $this->view->bill_details = $bill->toArray();
  $this->view->$bill_number = $bill['bill_number'];

}



public function deleteAction(){

  $viewer = Engine_Api::_()->user()->getViewer();
    $bill = Engine_Api::_()->getItem('bill', $this->getRequest()->getParam('bill_id'));
     if( !$this->_helper->requireAuth()->setAuthParams('bill', null, 'delete')->isValid()) return;
    $this->_helper->layout->setLayout('default-simple');
    $this->view->form = $form = new Bill_Form_Delete();
    $bill_number=$bill['bill_number'];

    $servername = "localhost";
  $username = "root";
  $password = "bigstep";
  $dbname = "socialengine";
  $conn = new mysqli($servername, $username, $password, $dbname);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }

  $query = "SELECT * FROM engine4_bill_products WHERE bill_number = '$bill_number'";
  $result = mysqli_query($conn, $query);
  $row_n = mysqli_num_rows($result);

  for($i=0;$i<$row_n;$i++){
     $sql = "DELETE FROM engine4_bill_products WHERE bill_number='$bill[bill_number]'";

    if ($conn->query($sql) === TRUE) {
    } else {
      echo "Error deleting record: " . $conn->error;
      die();
    }

  }

    if (!$bill) {
      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_("Invoice entry doesn't exist or not authorized to delete");
      return;
    }

    if (!$this->getRequest()->isPost()) {
      $this->view->status = false;
      $this->view->error = Zend_Registry::get('Zend_Translate')->_('Invalid request method');
      return;
    }

    $db = $bill->getTable()->getAdapter();
    $db->beginTransaction();

    try {
      $bill->delete();

      $db->commit();
    } catch (Exception $e) {
      $db->rollBack();
      throw $e;
    }

    $this->view->status = true;
    $this->view->message = Zend_Registry::get('Zend_Translate')->_('Your Invoice entry has been deleted.');
    return $this->_forward('success', 'utility', 'core', array(
      'parentRedirect' => Zend_Controller_Front::getInstance()->getRouter()->assemble(array('action' => 'manage'), 'bill_general', true),
      'messages' => array($this->view->message)
    ));
}


}
