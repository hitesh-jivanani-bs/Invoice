
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





<?php if ($this->paginator->getTotalItemCount() > 0) : ?>
  <ul class="blogs_manage list_wrapper">
    <?php foreach( $this->paginator as $item ): ?>
      <li>
        <div class='blogs_options'>
          <?php echo $this->htmlLink(array(
            'action' => 'view',
            'bill_id' => $item->getIdentity(),
            'route' => 'bill_edit',
            'reset' => true,
          ), $this->translate('View Entry'), array(
            'class' => 'buttonlink icon_blog_edit',
          )) ?>
          <?php echo $this->htmlLink(array(
            'action' => 'edit',
            'bill_id' => $item->getIdentity(),
            'route' => 'bill_edit',
            'reset' => true,
          ), $this->translate('Download'), array(
            'class' => 'buttonlink icon_blog_edit',
          )) ?>
        </div>

        <div class='blogs_info'>
          <span class='blogs_browse_info_title'>
            <h5><?php echo 'Invoice Number: '.$item['bill_number'].' Created By : ' . $item['creator'] ?></h5>
          </span>

        </div>
        

        <div class='blogs_info'>
          <span class='blogs_browse_info_title'>
            <h5><?php echo 'Recipient: ' . $item['name'] ?></h5>
          </span>

        </div>
        <div class='blogs_info'>
          <span class='blogs_browse_info_title'>
            <h5><?php echo 'Creation Date: ' . $item['date']?></h5>
          </span>
          
        </div>
          <div class='blogs_info'>
          <span class='blogs_browse_info_title'>
            <h5><?php echo 'Last Modify Date: ' . $item['modified_date']?></h5>
          </span>
          
        </div>
        <div class='blogs_info'>
          <span class='blogs_browse_info_title'>
            <h5><?php echo 'Total Amount: ' . $item['total'] ?></h5>
          </span>
          
        </div>
        <div class='blogs_info'>
          <span class='blogs_browse_info_title'>
            <h5><?php echo 'Discount: ' . $item['discount'] ?></h5>
          </span>
          
        </div>




      </li>
    <?php endforeach; ?>
  </ul>


<?php else : ?>
  <div class="tip">
    <span>
      <?php echo $this->translate('No entry yet.'); ?>


    </span>
  </div>
<?php endif; ?>

<?php echo $this->paginationControl($this->paginator, null, null, array(
  'pageAsQuery' => true,
  'query' => $this->formValues,
        //'params' => $this->formValues,
)); ?>