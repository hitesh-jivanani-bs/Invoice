<?php
$this->headScript()
      ->appendFile($this->layout()->staticBaseUrl . '/application/modules/Bill/externals/scripts/view.js');
?>

<?php      
$bill_number=$this->$bill_number;
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

$rows = array();
while($row = mysqli_fetch_assoc($result)) {
	$rows[] = $row;
}


      // while ($row = mysqli_fetch_assoc($result)) {
      //            // echo $row['product_name'].'<br>';

      //           }

?>
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

	<?php echo $this->form->render($this);?>
	<script type="text/javascript">
		
		let productsArr = <?php echo json_encode($rows);?>;
		let room=productsArr.length;
document.getElementById('room').value=room;
let totalfiels=room;


		
for(let i=0;i<productsArr.length;i++){
	if(i==0){
		addfield_f(productsArr[0],1);
	}
	else{
	addfield(productsArr[i],i+1);
}
}

// en4.core.runonce.add(()=> {
// document.getElementById('room').value=productsArr.length;
// })
console.log(document.getElementById('room'));

//function for updating the total values.............





</script>
