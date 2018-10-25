<?php
    wp_enqueue_style('jquery-ui-css', ZEMES_PLUGIN_URL . '_resource/styles/jqueryui-smoothness.min.css');
    wp_enqueue_script('formvalidate.js',ZEMES_PLUGIN_URL . '_resource/js/jquery.form-validator.js');
?>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $.validate();
    });
</script>

<div id="jjes-main-area">
    <div class="es-admin-title"><?php echo __('Add Expense Item Name','zem_emailsystem');?></div>
    <div class="jjes-content-area">
        <form id="jjes-saveform" method="post" action="<?php echo admin_url("admin.php?page=expenseitemnames&task=save"); ?>">
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Item Name'); ?><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('itemname', isset(zememailsystem::$items[0]->itemname) ? zememailsystem::$items[0]->itemname : '', array('class' => 'inputbox', 'data-validation' => 'required')); ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Status','zem_emailsystem'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::radio('status', array('1' => __('Active','zem_emailsystem'), '0' => __('Disable','zem_emailsystem')), isset(zememailsystem::$items[0]->status) ? zememailsystem::$items[0]->status : 1 , array('class' => 'radiobutton')); ?></div>
            </div>
            <?php echo zemeshtml::hidden('id', isset(zememailsystem::$items[0]->id) ? zememailsystem::$items[0]->id : ''); ?>
            <?php echo zemeshtml::hidden('created', isset(zememailsystem::$items[0]->created) ? zememailsystem::$items[0]->created : date('Y-m-d H:i:s') ); ?>
            <?php echo zemeshtml::hidden('formrequest', 'zemesform'); ?>
            <div class="jjes-submit-wrapper">
                <?php echo zemeshtml::submit('save', __('Save','zem_emailsystem'), array('class' => 'button')); ?>            </div>
        </form>
    </div>
</div>