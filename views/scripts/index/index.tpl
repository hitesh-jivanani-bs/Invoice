
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


