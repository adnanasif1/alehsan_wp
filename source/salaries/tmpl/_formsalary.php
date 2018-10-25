<?php
    wp_enqueue_script( 'jquery-ui-datepicker' );
    wp_register_style('jquery-ui', ZEMES_PLUGIN_URL . '_resource/styles/datepicker/jquery-ui.min.css');
    wp_enqueue_style('jquery-ui');
    wp_enqueue_script('formvalidate.js',ZEMES_PLUGIN_URL . '_resource/js/jquery.form-validator.js');
?>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $.validate();
        $('.custom_date').datepicker({
            dateFormat: 'yy-mm-dd'
        });

        $("#new_amount").click(function(){
            var elm = '<div style="margin-top:5px;"><input name="amount[]" value="" class="inputbox amounts" type="text" />&nbsp;&nbsp;<i style="color:#D42801" class="fa fa-times fa-fw deletethis"></i></div>';
            jQuery(this).parent().append(elm);
        });
        
        $("div#sayapa").on("click", "i.deletethis" , function(e){
            jQuery(this).parent().remove();
        });
    });
    
</script>

<div id="jjes-main-area">
    <div class="es-admin-title"><?php echo __('Add Salary','zem_emailsystem');?> <small style="float: right;">Per Month Record Of A Employee</small> </div>
    <div class="jjes-content-area">
        <form id="jjes-saveform" method="post" action="<?php echo admin_url("admin.php?page=salaries&task=save"); ?>">
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Employee'); ?><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::select('employeeid', zemesincluder::getObject('employees')->getEmployeesForCombo() , isset(zememailsystem::$items[0]->employeeid) ? zememailsystem::$items[0]->employeeid : '', __('Select Employee') ,array('class' => 'inputbox select', 'data-validation' => 'required')); ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Description'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::textarea('details', isset(zememailsystem::$items[0]->details) ? zememailsystem::$items[0]->details : '', array('class' => 'inputbox')); ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Salary'); ?><font class="jjes-required">*</font></div>
                <div id="sayapa" class="col-xs-8 col-md-9 jjes-value">
                    <?php
                    if(isset(zememailsystem::$items[0]->id) AND zememailsystem::$items[0]->amount != ''){
                        $amount = zememailsystem::$items[0]->amount;
                        $amount = json_decode($amount);
                        $i = 0;
                        foreach ($amount as $value) {
                            if($i == 0){
                                echo zemeshtml::text('amount[]', $value , array('class' => 'inputbox amounts', 'data-validation' => 'required number')); ?>
                                &nbsp;&nbsp;<span id="new_amount"><i style="color:#D42801;" class="fa fa-files-o fa-fw"></i></span>
                            <?php
                            }else{
                                echo '<div style="margin-top:5px;"><input name="amount[]" value="'.$value.'" class="inputbox amounts" type="text" />&nbsp;&nbsp;<i style="color:#D42801" class="fa fa-times fa-fw deletethis"></i></div>';
                            }
                            $i++;
                        }
                    }else{ ?>
                        <?php echo zemeshtml::text('amount[]', isset(zememailsystem::$items[0]->amount) ? zememailsystem::$items[0]->amount : '', array('class' => 'inputbox amounts', 'data-validation' => 'required number')); ?>
                        &nbsp;&nbsp;<span id="new_amount"><i style="color:#D42801;" class="fa fa-files-o fa-fw"></i></span>
                    <?php
                    }
                    ?>
                </div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Salary Month'); ?><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('salarydate', isset(zememailsystem::$items[0]->salarydate) ? zememailsystem::$items[0]->salarydate : '', array('class' => 'inputbox custom_date', 'data-validation' => 'required')); ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Published','zem_emailsystem'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::radio('status', array('1' => __('Yes','zem_emailsystem'), '0' => __('No','zem_emailsystem')), isset(zememailsystem::$items[0]->status) ? zememailsystem::$items[0]->status : 1 , array('class' => 'radiobutton')); ?></div>
            </div>
            <?php echo zemeshtml::hidden('id', isset(zememailsystem::$items[0]->id) ? zememailsystem::$items[0]->id : ''); ?>
            <?php echo zemeshtml::hidden('created', isset(zememailsystem::$items[0]->created) ? zememailsystem::$items[0]->created : date('Y-m-d H:i:s') ); ?>
            <?php echo zemeshtml::hidden('formrequest', 'zemesform'); ?>
            <div class="jjes-submit-wrapper">
                <?php echo zemeshtml::submit('save', __('Save Salary','zem_emailsystem'), array('class' => 'button')); ?>
            </div>
        </form>
    </div>
</div>
