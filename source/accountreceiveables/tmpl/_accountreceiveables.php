<?php
	zemesMessages::getLayoutMessage();
?>
<script type="text/javascript">
	function resetFrom(){
		document.getElementById('customername').value ='';
		document.getElementById('jjes-searchform').submit();
	}
</script>
<div id="jjes-main-area">
	<div class="es-admin-title"><?php echo __('Accountreceiveables','zem_emailsystem');?></div>
	<div class="jjes-content-area">
		<form name="jjes-searchform" id="jjes-searchform" method="post" action="<?php echo admin_url("admin.php?page=accountreceiveables"); ?>">
			<?php
			echo zemeshtml::text('customername', zememailsystem::$items['filter']['customername'], array('class' => 'inputbox', 'placeholder' => __('Customer name','zem_emailsystem')));
			echo zemeshtml::submit('btnsubmit', __('Search','zem_emailsystem'), array('class' => 'button'));
			echo zemeshtml::button('reset', __('Reset','zem_emailsystem'), array('class' => 'button', 'onclick' => 'resetFrom();')); 
			?>
		</form>

<?php
  	if(!empty(zememailsystem::$items[0])){ ?>
        <table id="jjes-table">
            <thead>
	            <tr>
			    	<th class="left-row"><?php echo __('Customer Name','zem_emailsystem'); ?></th>
			    	<th class="left-row"><?php echo __('Mobile','zem_emailsystem'); ?></th>
			    	<th class="left-row"><?php echo __('Phone','zem_emailsystem'); ?></th>
			    	<th class="centered"><?php echo __('Balance','zem_emailsystem'); ?></th>
			    	<th class="left-row"><?php echo __('Last Sale','zem_emailsystem'); ?></th>
			    	<th class="left-row"><?php echo __('Last Cashin','zem_emailsystem'); ?></th>
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
							 	<?php echo $row->customername; ?>
							</td>
							<td class="left-row">
							 	<?php echo $row->mobile; ?>
							</td>
							<td class="left-row">
							 	<?php echo $row->phone; ?>
							</td>
							<td class="centered">
								<?php echo number_format($row->balance); ?>
								<span class="jj_v_balance" data-cid="<?php echo $row->customerid;?>" data-balance="<?php echo $row->balance;?>" style="float: right;"><i title="Click to validate" style="float:right; color:yellow" class="fa fa-check-square-o fa-fw"></i></span>
							</td>
							<td class="left-row" title="Latest Sale Date. <?php echo date('d-M-Y' , strtotime( $row->lastsale)); ?>">
								<?php echo time_elapsed_string($row->lastsale); ?>
								<!-- <i style="float:right; color:#399e18" class="fa fa-lightbulb-o fa-fw"></i> -->
							</td>
							<td class="left-row" title="Latest Cashin Date. <?php echo date('d-M-Y' , strtotime( $row->lastcashin)); ?>">
								<?php echo time_elapsed_string($row->lastcashin); ?>
								<!-- <i style="float:right; color:#399e18" class="fa fa-lightbulb-o fa-fw"></i> -->
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
	
	function time_elapsed_string($datetime, $full = true) {
		if($datetime == '0000-00-00')
			return 'Never';
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago' : 'Today';
	}

/*
	function time_elapsed_string($datetime, $full = false) {
	    $now = new DateTime;
	    $ago = new DateTime($datetime);
	    $diff = $now->diff($ago);

	    $diff->w = floor($diff->d / 7);
	    $diff->d -= $diff->w * 7;

	    $string = array(
	        'y' => 'year',
	        'm' => 'month',
	        'w' => 'week',
	        'd' => 'day',
	        'h' => 'hour',
	        'i' => 'minute',
	        's' => 'second',
	    );
	    foreach ($string as $k => &$v) {
	        if ($diff->$k) {
	            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
	        } else {
	            unset($string[$k]);
	        }
	    }

	    if (!$full) $string = array_slice($string, 0, 1);
	    return $string ? implode(', ', $string) . ' ago' : 'just now';
	}
*/
?>

<script type="text/javascript">
    jQuery(document).ready(function($){
        jQuery('span.jj_v_balance').on('click', function(e){
        	var obj = jQuery(this);
        	var cid = obj.attr('data-cid');
        	var balance = obj.attr('data-balance');
            $.post( '<?php echo admin_url('admin-ajax.php'); ?>' , { action: 'zemes_ajax' , zemod: 'accountreceiveables', task: 'validateBalanceAjax', customerid : cid },
            function(data){
                if(data != 'error'){
                	if(balance == data){
                    	obj.html('<i title="Validated" style="float:right; color:#399e18" class="fa fa-check-square-o fa-fw"></i>');
                	}else{
                    	obj.html('<i title="Validate error" style="float:right; color:red" class="fa fa-times-circle fa-fw"></i>');
                	}
                }else{
                    obj.html('<i title="Validate error" style="float:right; color:red" class="fa fa-times-circle fa-fw"></i>');
                }
            });
        });
    });
</script>