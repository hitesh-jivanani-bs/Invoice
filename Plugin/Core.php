<?php

class Bill_Plugin_Core
{

public function onUserDeleteBefore($event)
  {
    $payload = $event->getPayload();
    if( $payload instanceof User_Model_User ) {
      // Delete blogs
      $invoiceTable = Engine_Api::_()->getDbtable('bills', 'bill')
      ->updateOwner($payload->getIdentity(),$payload->getTitle());
      

    }
  }
}
?>

