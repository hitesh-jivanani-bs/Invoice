let room=1;
let totalfiels=1;
en4.core.runonce.add(()=> {
	document.getElementById('room').value=room;
})


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
		divtest.innerHTML = `<div class="label"></div><div class="content"><span><input type="text" style="height:40px;width:300px;" name="p_name${room}"value="" placeholder="Product Name"/></span>&nbsp;<span><input type="number" step ="any" style="height:40px;width:80px;" name="quantity${room}" value="0" placeholder="Quantity"/></span>&nbsp;<span><input type="number" step ="any" style="height:40px;width:80px;" name="price${room}" onkeyup="total_price(this)" placeholder="Price"/></span>&nbsp;<span><input type="number" step ="any" style="height:40px;width:80px;" name="total${room}" value="" placeholder="Total"/></span>&nbsp;<span><button onclick="remove_product(this)" id="row${room}" style="height:40px; ">x</button></span></div><hr>`;

		objTo.append(divtest);
		document.getElementById('room').value=room;

	}
}

function remove_product(element)
{
	totalfiels--;
	let id = element.id.substring(3);
	let elem = document.getElementById(id);
	elem.remove();
}

function total_price(element){
	let id = element.name.substring(5);
	let qe=document.getElementsByName('quantity'+id)[0];
	let qv=qe.value;
	let pv=element.value
	let totalp=qv*pv;
	let te=document.getElementsByName('total'+id)[0];
	te.value=totalp;
}
