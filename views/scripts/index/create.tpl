


<?php
$this->headScript()
      ->appendFile($this->layout()->staticBaseUrl . '/application/modules/Bill/externals/scripts/js.js');
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
scriptJquery(document).ready(function() {
  var objTo = document.getElementById('number-element')
    var divtest = document.createElement("div");
    divtest.setAttribute('id','initial_row');
    divtest.innerHTML = '<div class="label">Product Details:</div><div class="content"><span><input type="text" style="height:40px;width:300px;" name="p_name1" value="" placeholder="Product Name"/></span>&nbsp;<span><input type="number" step ="any" style="height:40px;width:80px;" name="quantity1" value="0" placeholder="Quantity"/></span>&nbsp;<span><input type="number" step ="any" style="height:40px;width:80px;" name="price1" value="0" onkeyup="total_price(this)" placeholder="Price"/></span>&nbsp;<span><input type="number" step ="any" style="height:40px;width:80px;" name="total1" value="" placeholder="Total"/></span></div>';

    objTo.append(divtest);



    //for state........

    isUsd(0);
    // document.getElementById("initial_row").style.border = "thin dotted rgb(53, 38, 16)";

  });

 function isUsd(value) {
    if(value == 0) {
      scriptJquery('#state-wrapper').hide();
      scriptJquery('#state').val('Out of Haryana');
    }else{
      scriptJquery('#state-wrapper').show();
      // scriptJquery('#state').val('');
    }
  }
  var element = document.getElementById('number');
element.style.height = "30px";
</script>