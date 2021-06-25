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