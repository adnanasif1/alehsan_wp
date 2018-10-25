<?php
	zemesMessages::getLayoutMessage();
?>
<script type="text/javascript">
	function resetFrom(){
		document.getElementById('purchaser').value ='';
		document.getElementById('itemname').value ='';
		document.getElementById('jjes-searchform').submit();
	}
</script>
<div id="jjes-main-area">
	<div class="es-admin-title"><?php echo __('Sales','zem_emailsystem');?><a class="es-add-button-link" href="?page=sales&zemel=formsale"><i class="fa fa-plus-circle fa-lg fa-fw"></i>&nbsp;<?php echo __('Add New Sale','zem_emailsystem');?></a></div>
	<div class="jjes-content-area">
		<form name="jjes-searchform" id="jjes-searchform" method="post" action="<?php echo admin_url("admin.php?page=sales"); ?>">
			<?php
			echo zemeshtml::text('purchaser', zememailsystem::$items['filter']['purchaser'], array('class' => 'inputbox', 'placeholder' => __('Customer','zem_emailsystem')));
			echo zemeshtml::text('itemname', zememailsystem::$items['filter']['itemname'], array('class' => 'inputbox', 'placeholder' => __('Item','zem_emailsystem')));
			echo zemeshtml::submit('btnsubmit', __('Search','zem_emailsystem'), array('class' => 'button'));
			echo zemeshtml::button('reset', __('Reset','zem_emailsystem'), array('class' => 'button', 'onclick' => 'resetFrom();')); 
			?>
		</form>

<?php
    $colors = array(1 => '#99ccff', 2 => '#ffcc99', 3 => '#99ff99', 4 => '#99bbff', 5 => '#ffff99', 6 => '#adadeb', 7 => '#ffcc99', 8 => '#b3ffff', 9 => '#d9d9d9', 10 => '#ffad99', 11 => '#b3e6b3', 12 => '#ffe6f7', );
  	if(!empty(zememailsystem::$items[0])){ ?>
        <table id="jjes-table">
            <thead>
	            <tr>
			    	<th class="left-row"><?php echo __('Purchaser','zem_emailsystem'); ?></th>
			    	<th class="left-row"><?php echo __('Item','zem_emailsystem'); ?></th>
			    	<th class="centered"><?php echo __('Quantity','zem_emailsystem'); ?></th>
			    	<th class="centered"><?php echo __('Rate','zem_emailsystem'); ?></th>
			    	<th class="centered"><?php echo __('Carriage','zem_emailsystem'); ?></th>
			    	<th class="centered"><?php echo __('Total','zem_emailsystem'); ?></th>
			    	<th class="centered"><?php echo __('Sold Date','zem_emailsystem'); ?></th>
			    	<th class="action"><?php echo __('Action','zem_emailsystem'); ?></th>
	            </tr>
            </thead>
            <tbody>
				<?php
					$total = count( zememailsystem::$items[0] );
					for ( $i = 0; $i < $total; $i++ ){
						$row = zememailsystem::$items[0][$i];
						$color = date('n' , strtotime($row->saledate));
						?>
						<tr valign="top">
							<td class="left-row">
							 	<a href="?page=customers&zemel=formcustomer&zemesid=<?php echo $row->customerid; ?>"> <?php echo $row->customername; ?></a>
							</td>
							<td class="left-row" title="<?php echo $row->description; ?>">
							 	<a href="?page=saleitemnames&zemel=formsaleitemname&zemesid=<?php echo $row->saleitemnameid; ?>"> <?php echo $row->saleitemname; ?></a>
								<?php if(!empty($row->description)){
									echo '<i style="float:right; color:#399e18" class="fa fa-lightbulb-o fa-fw"></i>';
								} ?>
							</td>
							<td class="centered">
								<?php echo $row->quantity; ?>
							</td>
							<td class="centered">
								<?php echo $row->rate; ?>
							</td>
							<td class="centered">
								<?php echo $row->carriage; ?>
							</td>
							<td class="centered">
								<?php echo number_format( ($row->total) ); ?>
							</td>
					    	<td style="background:<?php echo $colors[$color]; ?>;">
					    		<?php echo date('d-M-Y', strtotime($row->saledate)); ?>
				    		</td>
					    	<td class="action">
					    		<a href="?page=sales&zemel=formsale&zemesid=<?php echo $row->id; ?>"><i style="color:black;" class="fa fa-pencil fa-lg fa-fw"></i></a>
					    		<a class="zem-confirm" href="?page=sales&task=remove&action=zemesaction&zemesid=<?php echo $row->id; ?>"><i style="color:black;" class="fa fa-trash-o fa-lg fa-fw"></i></a>
				    		</td>
						</tr> <?php 
					} ?>             
            </tbody>
        </table>
        </div>
</div>
		<?php
		if ( zememailsystem::$pager['pagination'] ) {
		    echo '<div id="zemes-pagination"><div class="zemes-pagination-pages">' . zememailsystem::$pager['pagination'] . '</div></div>';
		}
	}else{
		echo zemeslayout::noRecordFound();
	}
?>