

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


		function addfield(product,i){

			var objTo = document.getElementById('initial_row')
			var divtest = document.createElement("div");
			divtest.setAttribute('id',i);
    divtest.innerHTML = `<div class="label"></div><div class="content">

    <span><input type="text" style="height:40px;width:300px;" name="p_name${i}" value="${product['product_name']}" placeholder="Product Name"/></span>&nbsp;

    <span><input type="number" step ="any" style="height:40px;width:80px;" name="quantity${i}" value="${product['quantity']}" placeholder="Quantity"/></span>&nbsp;

    <span><input type="number" step ="any" style="height:40px;width:80px;" name="price${i}" value="${product['price']}" onkeyup="total_price(this)" placeholder="Price"/></span>&nbsp;

    <span><input type="number" step ="any" style="height:40px;width:80px;" name="total${i}" value="${product['total']}" placeholder="Total"/></span>
&nbsp;<span><button onclick="remove_product(this)" id="row${i}" style="height:40px; ">x</button></span>
    </div>`;

    objTo.append(divtest);
}

function addfield_f(product, i){ 

			var objTo = document.getElementById('number-element')
			var divtest = document.createElement("div");
			divtest.setAttribute('id','initial_row');
    divtest.innerHTML = `<div class="label">Product Details:</div><div class="content">

    <span><input type="text" style="height:40px;width:300px;" name="p_name${i}" value="${product['product_name']}" placeholder="Product Name"/></span>&nbsp;

    <span><input type="number" step ="any" style="height:40px;width:80px;" name="quantity${i}" value="${product['quantity']}" placeholder="Quantity"/></span>&nbsp;

    <span><input type="number" step ="any" style="height:40px;width:80px;" name="price${i}" value="${product['price']}" onkeyup="total_price(this)" placeholder="Price"/></span>&nbsp;

    <span><input type="number" step ="any" style="height:40px;width:80px;" name="total${i}" value="${product['total']}" placeholder="Total"/></span></div>`;

    objTo.append(divtest);
}


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


function total_price(element){
	let id = element.name.substring(5);
	let qe=document.getElementsByName('quantity'+id)[0];
	let qv=qe.value;
	let pv=element.value
	let totalp=qv*pv;
	let te=document.getElementsByName('total'+id)[0];
	te.value=totalp;
}


 function isUsd(value) {
    if(value == 0) {
      scriptJquery('#state-wrapper').hide();
      scriptJquery('#state').val('Out of Haryana');
    }else{
      scriptJquery('#state-wrapper').show();
      // scriptJquery('#state').val('');
    }
  }
function remove_product(element)
{
	totalfiels--;
	let id = element.id.substring(3);
	let elem = document.getElementById(id);
	elem.remove();
}


function addelement(){
	if(totalfiels>=5){
		alert("you can not add products more than 5")
	}
	else{
		room++;
		totalfiels++;
		var objTo = document.getElementById('initial_row')
		var divtest = document.createElement("div");
		divtest.setAttribute('id',room);
		divtest.innerHTML = `<div class="label"></div><div class="content"><span><input type="text" style="height:40px;width:300px;" name="p_name${room}"value="" placeholder="Product Name"/></span>&nbsp;
		<span><input type="number" step ="any" style="height:40px;width:80px;" name="quantity${room}" value="0" placeholder="Quantity"/></span>&nbsp;
		<span><input type="number" step ="any" style="height:40px;width:80px;" name="price${room}" onkeyup="total_price(this)" placeholder="Price"/></span>&nbsp;
		<span><input type="number" step ="any" style="height:40px;width:80px;" name="total${room}" value="" placeholder="Total"/></span>&nbsp;
		<span><button onclick="remove_product(this)" id="row${room}" style="height:40px; ">x</button></span></div>`;

		objTo.append(divtest);
		document.getElementById('room').value=room;

	}
}


</script>
