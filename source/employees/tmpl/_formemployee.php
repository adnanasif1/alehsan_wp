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
    <div class="es-admin-title"><?php echo __('Add New Employee','zem_emailsystem');?></div>
    <div class="jjes-content-area">
        <form id="jjes-saveform" method="post" action="<?php echo admin_url("admin.php?page=employees&task=save"); ?>">
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Employee Name','zem_emailsystem'); ?><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('name', isset(zememailsystem::$items[0]->name) ? zememailsystem::$items[0]->name : '', array('class' => 'inputbox', 'data-validation' => 'required')) ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Phone','zem_emailsystem'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('phone', isset(zememailsystem::$items[0]->phone) ? zememailsystem::$items[0]->phone : '', array('class' => 'inputbox')) ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Address'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::textarea('address', isset(zememailsystem::$items[0]->address) ? zememailsystem::$items[0]->address : '', array('class' => 'inputbox')); ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Reference','zem_emailsystem'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('reference', isset(zememailsystem::$items[0]->reference) ? zememailsystem::$items[0]->reference : '', array('class' => 'inputbox')) ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Reference Mobile','zem_emailsystem'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('referencephone', isset(zememailsystem::$items[0]->referencephone) ? zememailsystem::$items[0]->referencephone : '', array('class' => 'inputbox')) ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Advance','zem_emailsystem'); ?><small>&nbsp;(Rs)</small></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('advance', isset(zememailsystem::$items[0]->advance) ? zememailsystem::$items[0]->advance : '', array('class' => 'inputbox')) ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Joining Date'); ?><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('joiningdate', isset(zememailsystem::$items[0]->joiningdate) ? zememailsystem::$items[0]->joiningdate : '', array('class' => 'inputbox custom_date', 'data-validation' => 'required')); ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Leave Date'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('leavedate', isset(zememailsystem::$items[0]->leavedate) ? zememailsystem::$items[0]->leavedate : '', array('class' => 'inputbox custom_date')); ?></div>
            </div>

            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Status','zem_emailsystem'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::radio('status', array('1' => __('Active','zem_emailsystem'), '0' => __('Disabled','zem_emailsystem')), isset(zememailsystem::$items[0]->status) ? zememailsystem::$items[0]->status : 1 , array('class' => 'radiobutton')); ?></div>
            </div>
            <?php echo zemeshtml::hidden('id', isset(zememailsystem::$items[0]->id) ? zememailsystem::$items[0]->id : ''); ?>
            <?php echo zemeshtml::hidden('created', isset(zememailsystem::$items[0]->created) ? zememailsystem::$items[0]->created : date('Y-m-d H:i:s') ); ?>
            <?php echo zemeshtml::hidden('formrequest', 'zemesform'); ?>
            <div class="jjes-submit-wrapper">
                <?php echo zemeshtml::submit('save', __('Save Employee','zem_emailsystem'), array('class' => 'button')); ?>
            </div>
        </form>
    </div> 
</div>
