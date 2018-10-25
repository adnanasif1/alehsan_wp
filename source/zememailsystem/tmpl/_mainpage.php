<div id="jjes-main-area" class="zem_controlpanel">
    <div class="zemcphead"><?php echo __('Dashboard','zem_emailsystem');?><span class="zem-ver">Beta Version 1.0.0</span></div>
    
    <div class="jjes-zemcpsub"><?php echo __('Admin','zem_emailsystem');?></div>
    <div class="categories-admin">
        <a href="<?php echo admin_url('admin.php?page=purchaseitemnames');?>" class="jjbox">
            <img class="jjimg" src="<?php echo ZEMES_PLUGIN_URL; ?>_resource/images/admincp/pitems.png">
            <div class="jjtext">
                <div class="jjnobold">Purchase Items</div>
            </div>
        </a>
        <a href="<?php echo admin_url('admin.php?page=saleitemnames');?>" class="jjbox">
            <img class="jjimg" src="<?php echo ZEMES_PLUGIN_URL; ?>_resource/images/admincp/sitems.png">
            <div class="jjtext">
                <div class="jjnobold">Sale Items</div>
            </div>
        </a>
        <a href="<?php echo admin_url('admin.php?page=expenseitemnames');?>" class="jjbox">
            <img class="jjimg" src="<?php echo ZEMES_PLUGIN_URL; ?>_resource/images/admincp/exp.png">
            <div class="jjtext">
                <div class="jjnobold">Expense Items</div>
            </div>
        </a>
        <a href="<?php echo admin_url('admin.php?page=expensetypes');?>" class="jjbox">
            <img class="jjimg" src="<?php echo ZEMES_PLUGIN_URL; ?>_resource/images/admincp/exp2.png">
            <div class="jjtext">
                <div class="jjnobold">Expense Items Types</div>
            </div>
        </a>
        <a href="<?php echo admin_url('admin.php?page=customers');?>" class="jjbox">
            <img class="jjimg" src="<?php echo ZEMES_PLUGIN_URL; ?>_resource/images/admincp/user1.png">
            <div class="jjtext">
                <div class="jjnobold">Customers</div>
            </div>
        </a>
        <a href="<?php echo admin_url('admin.php?page=employees');?>" class="jjbox">
            <img class="jjimg" src="<?php echo ZEMES_PLUGIN_URL; ?>_resource/images/admincp/user2.png">
            <div class="jjtext">
                <div class="jjnobold">Employees</div>
            </div>
        </a>
    </div>

    <div class="jjes-zemcpsub"><?php echo __('Main Area','zem_emailsystem');?></div>
    <div class="categories-admin">
        <a href="<?php echo admin_url('admin.php?page=purchases');?>" class="jjbox">
            <img class="jjimg" src="<?php echo ZEMES_PLUGIN_URL; ?>_resource/images/admincp/purchase.png">
            <div class="jjtext">
                <div class="jjnobold">Purchases</div>
            </div>
        </a>
        <a href="<?php echo admin_url('admin.php?page=sales');?>" class="jjbox">
            <img class="jjimg" src="<?php echo ZEMES_PLUGIN_URL; ?>_resource/images/admincp/sale.png">
            <div class="jjtext">
                <div class="jjnobold">Sales</div>
            </div>
        </a>
        <a href="<?php echo admin_url('admin.php?page=expenses');?>" class="jjbox">
            <img class="jjimg" src="<?php echo ZEMES_PLUGIN_URL; ?>_resource/images/admincp/expenses.png">
            <div class="jjtext">
                <div class="jjnobold">Expenses</div>
            </div>
        </a>
        <a href="<?php echo admin_url('admin.php?page=salaries');?>" class="jjbox">
            <img class="jjimg" src="<?php echo ZEMES_PLUGIN_URL; ?>_resource/images/admincp/salary.png">
            <div class="jjtext">
                <div class="jjnobold">Salaries</div>
            </div>
        </a>
        <a href="<?php echo admin_url('admin.php?page=cashreceived');?>" class="jjbox">
            <img class="jjimg" src="<?php echo ZEMES_PLUGIN_URL; ?>_resource/images/admincp/cashin.png">
            <div class="jjtext">
                <div class="jjnobold">Cash-in</div>
            </div>
        </a>
    </div>
    
    <div class="jjes-zemcpsub"><?php echo __('Stats','zem_emailsystem');?></div>
    <div class="categories-admin">
        <a href="<?php echo admin_url('admin.php?page=accountreceiveables');?>" class="jjbox">
            <img class="jjimg" src="<?php echo ZEMES_PLUGIN_URL; ?>_resource/images/admincp/receiveables.png">
            <div class="jjtext">
                <div class="jjnobold">Receivables</div>
            </div> 
        </a>
        <a href="<?php echo admin_url('admin.php?page=stats');?>" class="jjbox">
            <img class="jjimg" src="<?php echo ZEMES_PLUGIN_URL; ?>_resource/images/admincp/stats.png">
            <div class="jjtext">
                <div class="jjnobold">Stats</div>
            </div>
        </a>
        <a href="<?php echo admin_url('admin.php?page=stats');?>" class="jjbox">
            <img class="jjimg" src="<?php echo ZEMES_PLUGIN_URL; ?>_resource/images/admincp/reports.png">
            <div class="jjtext">
                <div class="jjnobold">Reports</div>
            </div>
        </a>
    </div>
    
    <div class="jjes-zemcpsub"><?php echo __('Misc.','zem_emailsystem');?></div>
    <div class="categories-admin">
        <a href="<?php echo admin_url('admin.php?page=phonebook');?>" class="jjbox">
            <img class="jjimg" src="<?php echo ZEMES_PLUGIN_URL; ?>_resource/images/admincp/user.png">
            <div class="jjtext">
                <div class="jjnobold">Phone Book</div>
            </div> 
        </a>
    </div>
            
    
    <div class="jjes-zemcpsub"><?php echo __('Configuration','zem_emailsystem');?></div>
    <?php 
        $indname = get_option('zemes_industry_name');
        $indmobile = get_option('zemes_industry_mobile');
        $indemail = get_option('zemes_industry_email');
        $psize = get_option('zemes_p_size');

    ?>
<!--         <div class="zem-alert-box zem-error"><span>error: </span>Write your error message here.</div>
        <div class="zem-alert-box zem-success"><span>success: </span>Write your success message here.</div>
        <div class="zem-alert-box zem-warning"><span>warning: </span>Write your warning message here.</div>
        <div class="zem-alert-box zem-notice"><span>notice: </span>Write your notice message here.</div>        
 -->

    <div id="result">
    </div>

    <form action="#" id="zemesquickform">
        <div class="jjes-field-wrapper">
            <div class="col-xs-4 col-md-4 jjestitle"><?php echo __('Factory Name','zem_emailsystem'); ?><font class="jjes-required">*</font></div>
            <div class="col-xs-8 col-md-8 jjesvalue"><?php echo zemeshtml::text('indname', $indname, array('class' => 'inputbox', 'data-validation' => 'required')) ?></div>
        </div>
        <div class="jjes-field-wrapper">
            <div class="col-xs-4 col-md-4 jjestitle"><?php echo __('Mobile','zem_emailsystem'); ?><font class="jjes-required">*</font></div>
            <div class="col-xs-8 col-md-8 jjesvalue"><?php echo zemeshtml::text('indmobile', $indmobile, array('class' => 'inputbox', 'data-validation' => 'required')) ?></div>
        </div>    
        <div class="jjes-field-wrapper">
            <div class="col-xs-4 col-md-4 jjestitle"><?php echo __('Email','zem_emailsystem'); ?><font class="jjes-required">*</font></div>
            <div class="col-xs-8 col-md-8 jjesvalue"><?php echo zemeshtml::text('indemail', $indemail, array('class' => 'inputbox', 'data-validation' => 'required')) ?></div>
        </div>    
        <div class="jjes-field-wrapper">
            <div class="col-xs-4 col-md-4 jjestitle"><?php echo __('Number of records show per page','zem_emailsystem'); ?><font class="jjes-required">*</font></div>
            <div class="col-xs-8 col-md-8 jjesvalue"><?php echo zemeshtml::text('psize', $psize, array('class' => 'inputbox', 'data-validation' => 'required')) ?></div>
        </div>    
        <div class="jjes-button-wrapper">
            <?php echo zemeshtml::submit('saveoption', __('Save options','zem_emailsystem'), array('class' => 'button')); ?>
        </div>
    </form>
</div>
<script type="text/javascript">
    jQuery(document).ready(function($){
        jQuery('#zemesquickform').submit(function(event){
            event.preventDefault();
            var indname = jQuery('#indname').val();
            var indmobile = jQuery('#indmobile').val();
            var indemail = jQuery('#indemail').val();
            var psize = jQuery('#psize').val();
            $.post( '<?php echo admin_url('admin-ajax.php'); ?>' , { action: 'zemes_ajax' , zemod: 'settings', task: 'setQuickSettingsAjax', indname : indname, indmobile : indmobile, indemail : indemail, psize : psize},
            function(data){
                if(data == 'ok'){
                    jQuery('#result').html('');
                    jQuery('#result').css('display','inline-block');
                    jQuery('div#result').html('<div class="zem-alert-box zem-success"><span>success: </span>Settings has been saved sucessfully.</div>');
                    setTimeout(function(){ 
                        jQuery('#result').fadeOut();

                    }, 3000);
                }
            });
        });
    });
</script>