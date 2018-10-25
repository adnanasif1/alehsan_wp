<?php
	zemesMessages::getLayoutMessage();
?>
<script type="text/javascript">
	function resetFrom(){
		document.getElementById('searchname').value ='';
		document.getElementById('jjes-searchform').submit();
	}
</script>
<div id="jjes-main-area">
	<div class="es-admin-title"><?php echo __('Phonebook','zem_emailsystem');?><a class="es-add-button-link" href="?page=phonebook&zemel=formphonebook"><i class="fa fa-plus-circle fa-lg fa-fw"></i>&nbsp;<?php echo __('Add New Contact','zem_emailsystem');?></a></div>
	<div class="jjes-content-area">
		<form name="jjes-searchform" id="jjes-searchform" method="post" action="<?php echo admin_url("admin.php?page=phonebook"); ?>">
			<?php
			echo zemeshtml::text('searchname', zememailsystem::$items['filter']['searchname'], array('class' => 'inputbox', 'placeholder' => __('Contact Name','zem_emailsystem')));
			echo zemeshtml::submit('btnsubmit', __('Search','zem_emailsystem'), array('class' => 'button'));
			echo zemeshtml::button('reset', __('Reset','zem_emailsystem'), array('class' => 'button', 'onclick' => 'resetFrom();')); 
			?>
		</form>
<?php
  	if(!empty(zememailsystem::$items[0])){ ?>
        <table id="jjes-table">
            <thead>
	            <tr>
			    	<th class="left-row"><?php echo __('Name','zem_emailsystem'); ?></th>
			    	<th class="left-row"><?php echo __('Mobile','zem_emailsystem'); ?></th>
			    	<th class="left-row"><?php echo __('Address','zem_emailsystem'); ?></th>
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
							 	<a href="?page=phonebook&zemel=formphonebook&zemesid=<?php echo $row->id; ?>"> <?php echo $row->name; ?></a>
							</td>
							<td class="left-row">
								<?php echo $row->mobile; ?>
							</td>
							<td class="left-row">
								<?php echo $row->address; ?>
							</td>
							<td class="centered">
								<?php echo ($row->status == 1) ? '<i style="color:#399e18" class="fa fa-check fa-fw"></i>' : '<i style="color:#D42801" class="fa fa-times fa-fw"></i>'; ?>
							</td>
					    	<td>
					    		<?php echo date('d-M-Y', strtotime($row->created)); ?>
				    		</td>							
					    	<td class="action">
					    		<a href="?page=phonebook&zemel=formphonebook&zemesid=<?php echo $row->id; ?>"><i style="color:black;" class="fa fa-pencil fa-lg fa-fw"></i></a>
					    		<a class="zem-confirm" href="?page=phonebook&task=remove&action=zemesaction&zemesid=<?php echo $row->id; ?>"><i style="color:black;" class="fa fa-trash-o fa-lg fa-fw"></i></a>
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
