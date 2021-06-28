	<div class="layout_middle">
		<div class="generic_layout_container">
			<div class="headline">
				<h2>
					<?php echo $this->translate('Bills');?>
				</h2>
				<div class="tabs">
					<?php
          // Render the menu
					echo $this->navigation()
					->menu()
					->setContainer($this->navigation)
					->render();
					?>
				</div>
			</div>
		</div>
	</div>

<?php      
$bill_number=$this->$bill_number;
$currency="USD";
$igst=$cgst=$sgst='';
$c='$';
if($this->bill_details['currencies']==1)
{
    $c='<span>&#x20B9;<span>';
    $currency="INR";
    if($this->bill_details['state']=='Haryana'){
        $sgst=$this->bill_details['sgst'];
        $cgst=$this->bill_details['cgst'];
    }
    else{
     $igst=$this->bill_details['igst'];   
    }
}
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

// $rows = array();
// while($row = mysqli_fetch_assoc($result)) {

//   $rows[] = $row;
// }
?>
<script type="text/javascript">

		</script>



<head>
        <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-beta.2/css/bootstrap.css'>
</head>
<body>
    <div class="container">
        <div class="card">
            <div class="card-header">
                Invoice 
                <strong><?php echo $this->bill_details['bill_number']?></strong>
                <a class="btn btn-sm btn-secondary float-right mr-1 d-print-none" href="#" onclick="javascript:window.print();" data-abc="true">
                        <i class="fa fa-print"></i> Print</a>
                    <a class="btn btn-sm btn-info float-right mr-1 d-print-none" href="#" data-abc="true">
                        <i class="fa fa-save"></i> Save</a>
               
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-4">
                        <h6 class="mb-3">From:</h6>
                        <div>
                            <strong>Bigstep Technologies Private Limited</strong>
                        </div>
                        <div>Justdail Complex Sector 15</div>
                        <div>Gurgaon-122001, Haryana, India</div>
                        <div>Email: info@bigstep.com</div>
                        <div>CIN: U72200HR2009PTC038717</div>
                        <div>Phone: +91 9136773059</div>
                    </div>
                    <div class="col-sm-4">
                        <h6 class="mb-3">To:</h6>
                        <div>
                            <strong><?php echo $this->bill_details['name']?></strong>
                        </div>
                        <div>Email: <?php echo $this->bill_details['email']?></div>
                        <div>Phone: <?php echo $this->bill_details['number']?></div>
                        <div>Address: <?php echo $this->bill_details['address']?></div>
                    </div>

                    <div class="col-sm-4">
                        <h6 class="mb-3">Details</h6>
                        <div>Invoice
                            <strong><?php echo $this->bill_details['bill_number']?></strong>
                        </div>
                        <div>Created By:  <?php echo "  ".$this->bill_details['creator']?></div>
                        <div>Date:  <?php echo "  ".$this->bill_details['date']?></div>
                        <div>Currency:  <?php echo "  ".$currency?></div>
                        <div>Status: <?php echo "    ".$this->bill_details['status']?></div>
                        <div>Last Update:  <?php echo "    ".$this->bill_details['modified_date']?></div>
                    </div>

                </div>

                <div class="table-responsive-sm">
                    <table class="table table-striped" id='items'>
                        <thead>
                            <tr>
                                <th class="center">#</th>
                                <th>Item</th>

                                <th class="right">Quantity</th>
                                <th class="center">Unit Cost</th>
                                <th class="right">Total</th>
                            </tr>
                        </thead>
                        <tbody><?php 
                        $i=0;
                        while($row = mysqli_fetch_assoc($result)) {$i++;

                        echo'
                            <tr>
                                <td class="center">'.$i.'</td>
                                <td class="left strong">'.$row["product_name"].'</td>
                            

                                <td class="right">'.$row["quantity"].'</td>
                                <td class="center">'.$c.$row["price"].'</td>
                                <td class="right">'.$c.$row["total"].'</td>
                            </tr>';
                          }
                            ?>
                           
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">

                    </div>

                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>
                                <tr>
                                    <td class="left">
                                        <strong>Subtotal</strong>
                                    </td>
                                    <td class="right"> <?php echo $c.$this->bill_details['subtotal']?></td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong>Discount</strong>
                                    </td>
                                    <td class="right"> <?php echo $this->bill_details['discount']?>%</td>
                                </tr>
                                <?php
                                if($this->bill_details['currencies']==1){
                                    if($igst){
                                        echo '
                                    <tr>
                                    <td class="left">
                                        <strong>IGST</strong>
                                    </td>
                                    <td class="right">'.$igst.'%</td>
                                    </tr>
                                        ';
                                    }
                                    else{
                                         echo '
                                    <tr>
                                    <td class="left">
                                        <strong>CGST</strong>
                                        </td>
                                        <td class="left">
                                        <strong>'.$cgst.'%</strong>
                                    </td>
                                    </tr>
                                    <tr>
                                    <td class="left">
                                        <strong>SGST</strong>
                                        </td>
                                        <td class="left">
                                        <strong>'.$sgst.'%</strong>
                                    </td>
                                    </tr>
                                        ';

                                    }
                                }

                                ?>
                                <tr>
                                    <td class="left">
                                        <strong>Total</strong>
                                    </td>
                                    <td class="right">
                                        <strong> <?php echo $c.$this->bill_details['total']?></strong>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
