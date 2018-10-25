<?php

    wp_enqueue_style('jquery-ui-css', ZEMES_PLUGIN_URL . '_resource/styles/jqueryui-smoothness.min.css');
    wp_enqueue_script('formvalidate.js',ZEMES_PLUGIN_URL . '_resource/js/jquery.form-validator.js');

	zemesMessages::getLayoutMessage();
?>
<script type="text/javascript">
	function resetFrom(){
		document.getElementById('employeename').value ='';
		document.getElementById('jjes-searchform').submit();
	}
</script>
<div id="jjes-main-area">
	<div class="es-admin-title"><?php echo __('Salaries','zem_emailsystem');?><a class="es-add-button-link" href="?page=salaries&zemel=formsalary"><i class="fa fa-plus-circle fa-lg fa-fw"></i>&nbsp;<?php echo __('Add New Salary','zem_emailsystem');?></a></div>
	<div class="jjes-content-area">
		<form name="jjes-searchform" id="jjes-searchform" method="post" action="<?php echo admin_url("admin.php?page=salaries"); ?>">
			<?php
			echo zemeshtml::text('employeename', zememailsystem::$items['filter']['employeename'], array('class' => 'inputbox', 'placeholder' => __('Employee','zem_emailsystem')));
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
			    	<th class="left-row"><?php echo __('Employee','zem_emailsystem'); ?></th>
			    	<th class="left-row"><?php echo __('Amounts','zem_emailsystem'); ?></th>
			    	<th class="centered"><?php echo __('Total Salary','zem_emailsystem'); ?></th>
			    	<th class="centered"><?php echo __('Salary Month','zem_emailsystem'); ?></th>
			    	<th class="action"><?php echo __('Action','zem_emailsystem'); ?></th>
	            </tr>
            </thead>
            <tbody>
				<?php
					$total = count( zememailsystem::$items[0] );
					for ( $i = 0; $i < $total; $i++ ){
						$row = zememailsystem::$items[0][$i];
						$color = date('n' , strtotime($row->salarydate));
						?>
						<tr>
							<td class="left-row">
							 	<a href="?page=salaries&zemel=formsalary&zemesid=<?php echo $row->id; ?>"> <?php echo $row->employeename; ?></a>
							</td>
							<td class="centered">
								<?php 
								$amount = json_decode($row->amount); 
								$stop = count($amount);
								$r = 1;
								foreach ($amount as $value) {
									echo "$value";
									if($r != $stop)
										echo " - ";
									$r++;
								}
								?>
							</td>
							<td class="centered">
								<?php echo number_format( ($row->salary) ); ?>
							</td>
					    	<td style="background:<?php echo $colors[$color]; ?>;">
					    		<?php echo date('d-M-Y', strtotime($row->salarydate)); ?>
				    		</td>
					    	<td class="action">
					    		<a href="?page=salaries&zemel=formsalary&zemesid=<?php echo $row->id; ?>"><i style="color:black;" class="fa fa-pencil fa-lg fa-fw"></i></a>
					    		<a class="zem-confirm" href="?page=salaries&task=remove&action=zemesaction&zemesid=<?php echo $row->id; ?>"><i style="color:black;" class="fa fa-trash-o fa-lg fa-fw"></i></a>
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