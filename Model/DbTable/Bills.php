<?php

class Bill_Model_DbTable_Bills extends Core_Model_Item_DbTable_Abstract
{
    protected $_rowClass = "Bill_Model_Bill";



public function getOwnerBillsPaginator($owner){
        $select=$this->select();
        $where=$select->where('owner_id = ?' ,$owner);
        $paginator= Zend_Paginator::factory($where);
        return $paginator;
    }

public function getInvoicesSelect($params = array()){
        $viewer = Engine_Api::_()->user()->getViewer();
        $viewerId = $viewer->getIdentity();
        $table = Engine_Api::_()->getDbtable('bills', 'bill');
        $rName = $table->info('name');

        $tmTable = Engine_Api::_()->getDbtable('TagMaps', 'core');
        $tmName = $tmTable->info('name');


        $select=$this->select();

        if(!empty($params['date'])){
        $select=$this->select();
        // $where=$select->where('title LIKE ?', '%'.$params['search'].'%');
        $select=$select->where($rName.".date LIKE ?", '%'.$params['date'].'%');
    }
        if(!empty($params['status'])){
        // $where=$select->where('title LIKE ?', '%'.$params['search'].'%');
        $select=$select->where($rName.'.status = ?', $params['status']);
    }
    if(!empty($params['search'])){
         $select=$select->where($rName.".bill_number LIKE ?", '%'.$params['bill_number'].'%');
    }

    if(!empty($params['name'])){
         $select=$select->where($rName.".creator LIKE ?", '%'.$params['name'].'%');
    }
return $select;
}




public function getInvoicesPaginator($params = array()){        
        $paginator = Zend_Paginator::factory($this->getInvoicesSelect($params));
        if( !empty($params['page']) )
        {
            $paginator->setCurrentPageNumber($params['page']);
        }
        if( !empty($params['limit']) )
        {
            $paginator->setItemCountPerPage($params['limit']);
        }

        if( empty($params['limit']) )
        {
            $page = (int) Engine_Api::_()->getApi('settings', 'core')->getSetting('bill.page', 10);
            $paginator->setItemCountPerPage($page);
        }
        return $paginator;
    }

















    public function setBillNumber($domain,$currencies){
 	$bill_number='';

 	if($domain==0){
            	$a='SE';
            	if($currencies==0)
            	{
            		$a='SEP';
            	}

            	$k=1;
            	$k=str_pad($k, 4, '0', STR_PAD_LEFT);
            	$m=date("m");
            	if($m<4){
            		$y=date("y");
            		$py=$y-1;
            		$bill_number.=$k.'/'.$a.'/'.$py.'-'.$y;
            	}
            	if($m>=4){
            		$y=date("y");
            		$py=$y+1;
            		$bill_number=$k.'/'.$a.'/'.$y.'-'.$py;
            	}

            }
            if($domain==1){
            	$a='PM';
            	if($currencies==0)
            	{
            		$a='PMP';
            	}

            	$k=1;
            	$k=str_pad($k, 4, '0', STR_PAD_LEFT);
            	$m=date("m");
            	if($m<4){
            		$y=date("y");
            		$py=$y-1;
            		$bill_number.=$k.'/'.$a.'/'.$py.'-'.$y;
            	}
            	if($m>=4){
            		$y=date("y");
            		$py=$y+1;
            		$bill_number=$k.'/'.$a.'/'.$y.'-'.$py;
            	}

            }

            if($domain==2){
            	$a='GSTA';
            	if($currencies==0)
            	{
            		$a='AHP';
            	}

            	$k=89;
            	$k=str_pad($k, 4, '0', STR_PAD_LEFT);
            	$m=date("m");
            	if($m<4){
            		$y=date("y");
            		$py=$y-1;
            		$bill_number.=$k.'/'.$a.'/'.$py.'-'.$y;
            	}
            	if($m>=4){
            		$y=date("y");
            		$py=$y+1;
            		$bill_number=$k.'/'.$a.'/'.$y.'-'.$py;
            	}

            }

            if($domain==3){
            	$a='GSTM';
            	if($currencies==0)
            	{
            		$a='MCP';
            	}

            	$k=1;
            	$k=str_pad($k, 4, '0', STR_PAD_LEFT);
            	$m=date("m");
            	if($m<4){
            		$y=date("y");
            		$py=$y-1;
            		$bill_number.=$k.'/'.$a.'/'.$py.'-'.$y;
            	}
            	if($m>=4){
            		$y=date("y");
            		$py=$y+1;
            		$bill_number=$k.'/'.$a.'/'.$y.'-'.$py;
            	}

            }

            if($domain==0){
            	$a='OPP';
            	if($currencies==0)
            	{
            		$a='GSTO';
            	}

            	$k=1;
            	$k=str_pad($k, 4, '0', STR_PAD_LEFT);
            	$m=date("m");
            	if($m<4){
            		$y=date("y");
            		$py=$y-1;
            		$bill_number.=$k.'/'.$a.'/'.$py.'-'.$y;
            	}
            	if($m>=4){
            		$y=date("y");
            		$py=$y+1;
            		$bill_number=$k.'/'.$a.'/'.$y.'-'.$py;
            	}

            }
            return $bill_number;

 }
}
?>