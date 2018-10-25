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
    });
</script>

<div id="jjes-main-area">
    <div class="es-admin-title"><?php echo __('Add Expense','zem_emailsystem');?></div>
    <div class="jjes-content-area">
        <form id="jjes-saveform" method="post" action="<?php echo admin_url("admin.php?page=expenses&task=save"); ?>">
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Name'); ?><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::select('expenseitemnameid', zemesincluder::getObject('expenseitemnames')->getExpenseItemNamesCombo() , isset(zememailsystem::$items[0]->expenseitemnameid) ? zememailsystem::$items[0]->expenseitemnameid : '', '' ,array('class' => 'inputbox select', 'data-validation' => 'required')); ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Type'); ?><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::select('expensetypeid', zemesincluder::getObject('expensetypes')->getExpenseTypesCombo() , isset(zememailsystem::$items[0]->expensetypeid) ? zememailsystem::$items[0]->expensetypeid : '', '' ,array('class' => 'inputbox select', 'data-validation' => 'required')); ?></div>
            </div>            
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Description'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::textarea('note', isset(zememailsystem::$items[0]->note) ? zememailsystem::$items[0]->note : '', array('class' => 'inputbox')); ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Price'); ?><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('price', isset(zememailsystem::$items[0]->price) ? zememailsystem::$items[0]->price : '', array('class' => 'inputbox', 'data-validation' => 'required number')); ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Expense Date'); ?><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('expensedate', isset(zememailsystem::$items[0]->expensedate) ? zememailsystem::$items[0]->expensedate : '', array('class' => 'inputbox custom_date', 'data-validation' => 'required')); ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Published','zem_emailsystem'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::radio('status', array('1' => __('Yes','zem_emailsystem'), '0' => __('No','zem_emailsystem')), isset(zememailsystem::$items[0]->status) ? zememailsystem::$items[0]->status : 1 , array('class' => 'radiobutton')); ?></div>
            </div>
            <?php echo zemeshtml::hidden('id', isset(zememailsystem::$items[0]->id) ? zememailsystem::$items[0]->id : ''); ?>
            <?php echo zemeshtml::hidden('created', isset(zememailsystem::$items[0]->created) ? zememailsystem::$items[0]->created : date('Y-m-d H:i:s') ); ?>
            <?php echo zemeshtml::hidden('formrequest', 'zemesform'); ?>
            <div class="jjes-submit-wrapper">
                <?php echo zemeshtml::submit('save', __('Save Expense','zem_emailsystem'), array('class' => 'button')); ?>
            </div>
        </form>
    </div>
</div>
