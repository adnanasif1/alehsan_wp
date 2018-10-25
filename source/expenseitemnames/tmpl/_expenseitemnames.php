<?php
	zemesMessages::getLayoutMessage();
?>
<script type="text/javascript">
	function resetFrom(){
		document.getElementById('itemname').value ='';
		document.getElementById('jjes-searchform').submit();
	}
</script>
<div id="jjes-main-area">
	<div class="es-admin-title"><?php echo __('Expense Items List','zem_emailsystem');?><a class="es-add-button-link" href="?page=expenseitemnames&zemel=formexpenseitemname"><i class="fa fa-plus-circle fa-lg fa-fw"></i>&nbsp;<?php echo __('Add New Expense item','zem_emailsystem');?></a></div>
	<div class="jjes-content-area">
		<form name="jjes-searchform" id="jjes-searchform" method="post" action="<?php echo admin_url("admin.php?page=expenseitemnames"); ?>">
			<?php
			echo zemeshtml::text('itemname', zememailsystem::$items['filter']['itemname'], array('class' => 'inputbox', 'placeholder' => __('Item Name','zem_emailsystem')));
			echo zemeshtml::submit('btnsubmit', __('Search','zem_emailsystem'), array('class' => 'button'));
			echo zemeshtml::button('reset', __('Reset','zem_emailsystem'), array('class' => 'button', 'onclick' => 'resetFrom();')); 
			?>
		</form>

<?php
  	if(!empty(zememailsystem::$items[0])){ ?>
        <table id="jjes-table">
            <thead>
	            <tr>
			    	<th class="left-row"><?php echo __('Item name','zem_emailsystem'); ?></th>
			    	<th class="centered"><?php echo __('Default','zem_emailsystem'); ?></th>
			    	<th class="centered"><?php echo __('Ordering','zem_emailsystem'); ?></th>
			    	<th class="centered"><?php echo __('Status','zem_emailsystem'); ?></th>
			    	<th class="centered"><?php echo __('Created','zem_emailsystem'); ?></th>
			    	<th class="action"><?php echo __('Action','zem_emailsystem'); ?></th>
	            </tr>
            </thead>
            <tbody>
				<?php
					$total = count( zememailsystem::$items[0] );
					for ( $i = 0; $i < $total; $i++ ){
						$row = zememailsystem::$items[0][$i];
						?>
						<tr valign="top">
							<td class="left-row">
							 	<a href="?page=expenseitemnames&zemel=formexpenseitemname&zemesid=<?php echo $row->id; ?>"> <?php echo $row->itemname; ?></a>
							</td>
							<td class="centered">
								<i style="color:#399e18" class="fa fa-check fa-fw"></i>
							</td>
							<td class="centered">
								<?php 
								if($i != 0){ ?>
					    			<a href="?page=expenseitemnames&task=updateordering&action=zemesaction&order=up&zemesid=<?php echo $row->id; ?>"><i style="color: #2980b9" class="fa fa-sort-asc fa-fw"></i></a>
								<?php
								} 
								echo $row->ordering;
								if($i != $total - 1){ ?>
					    			<a href="?page=expenseitemnames&task=updateordering&action=zemesaction&order=down&zemesid=<?php echo $row->id; ?>"><i style="color: #2980b9" class="fa fa-sort-desc fa-fw"></i></a>
								<?php
								} ?>
							</td>
							<td class="centered">
								<?php echo ($row->status == 1) ? '<i style="color:#399e18" class="fa fa-check fa-fw"></i>' : '<i style="color:#D42801" class="fa fa-times fa-fw"></i>'; ?>
							</td>
					    	<td>
					    		<?php echo date('d-m-Y', strtotime($row->created)); ?>
				    		</td>
					    	<td class="action">
					    		<a href="?page=expenseitemnames&zemel=formexpenseitemname&zemesid=<?php echo $row->id; ?>"><i style="color:black;" class="fa fa-pencil fa-lg fa-fw"></i></a>
					    		<a class="zem-confirm" href="?page=expenseitemnames&task=remove&action=zemesaction&zemesid=<?php echo $row->id; ?>"><i style="color:black;" class="fa fa-trash-o fa-lg fa-fw"></i></a>
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
