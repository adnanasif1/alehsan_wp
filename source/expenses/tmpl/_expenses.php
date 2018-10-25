<?php
	zemesMessages::getLayoutMessage();
?>
<script type="text/javascript">
	function resetFrom(){
		document.getElementById('expensename').value ='';
		document.getElementById('expensetype').value ='';
		document.getElementById('jjes-searchform').submit();
	}
</script>
<div id="jjes-main-area">
	<div class="es-admin-title"><?php echo __('Expenses','zem_emailsystem');?><a class="es-add-button-link" href="?page=expenses&zemel=formexpense"><i class="fa fa-plus-circle fa-lg fa-fw"></i>&nbsp;<?php echo __('Add New Expense','zem_emailsystem');?></a></div>
	<div class="jjes-content-area">
		<form name="jjes-searchform" id="jjes-searchform" method="post" action="<?php echo admin_url("admin.php?page=expenses"); ?>">
			<?php
			echo zemeshtml::text('expensename', zememailsystem::$items['filter']['expensename'], array('class' => 'inputbox', 'placeholder' => __('Expense name','zem_emailsystem')));
			echo zemeshtml::text('expensetype', zememailsystem::$items['filter']['expensetype'], array('class' => 'inputbox', 'placeholder' => __('Expense type','zem_emailsystem')));
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
			    	<th class="left-row"><?php echo __('Expense name','zem_emailsystem'); ?></th>
			    	<th class="left-row"><?php echo __('Expense Type','zem_emailsystem'); ?></th>
			    	<th class="centered"><?php echo __('Expense','zem_emailsystem'); ?><small>&nbsp;Rs</small> </th>
			    	<th class="centered"><?php echo __('Expense Date','zem_emailsystem'); ?></th>
			    	<th class="action"><?php echo __('Action','zem_emailsystem'); ?></th>
	            </tr>
            </thead>
            <tbody>
				<?php
					$total = count( zememailsystem::$items[0] );
					for ( $i = 0; $i < $total; $i++ ){
						$row = zememailsystem::$items[0][$i];
						$color = date('n' , strtotime($row->expensedate));
						?>
						<tr valign="top">
							<td class="left-row">
							 	<a href="?page=expenses&zemel=formexpense&zemesid=<?php echo $row->id; ?>"> <?php echo $row->expensename; ?></a>
							</td>
							<td class="left-row">
								<?php echo $row->expensetype; ?>
					    	</td>
							<td class="centered">
								<?php echo number_format( ($row->price) ); ?>
							</td>
					    	<td style="background:<?php echo $colors[$color]; ?>;">
					    		<?php echo date('d-M-Y', strtotime($row->expensedate)); ?>
				    		</td>
					    	<td class="action">
					    		<a href="?page=expenses&zemel=formexpense&zemesid=<?php echo $row->id; ?>"><i style="color:black;" class="fa fa-pencil fa-lg fa-fw"></i></a>
					    		<a class="zem-confirm" href="?page=expenses&task=remove&action=zemesaction&zemesid=<?php echo $row->id; ?>"><i style="color:black;" class="fa fa-trash-o fa-lg fa-fw"></i></a>
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