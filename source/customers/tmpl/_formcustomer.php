<?php
    wp_enqueue_script('formvalidate.js',ZEMES_PLUGIN_URL . '_resource/js/jquery.form-validator.js');
?>
<script type="text/javascript">
    jQuery(document).ready(function ($) {
        $.validate();
    });
</script>
<div id="jjes-main-area">
    <div class="es-admin-title"><?php echo __('Add New Customer','zem_emailsystem');?></div>
    <div class="jjes-content-area">
        <form id="jjes-saveform" method="post" action="<?php echo admin_url("admin.php?page=customers&task=save"); ?>">
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Customer Name','zem_emailsystem'); ?><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('name', isset(zememailsystem::$items[0]->name) ? zememailsystem::$items[0]->name : '', array('class' => 'inputbox', 'data-validation' => 'required')) ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Shop Name','zem_emailsystem'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('shopname', isset(zememailsystem::$items[0]->shopname) ? zememailsystem::$items[0]->shopname : '', array('class' => 'inputbox')) ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Email address','zem_emailsystem'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('emailaddress', isset(zememailsystem::$items[0]->emailaddress) ? zememailsystem::$items[0]->emailaddress : '', array('class' => 'inputbox')) ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Mobile','zem_emailsystem'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('mobile', isset(zememailsystem::$items[0]->mobile) ? zememailsystem::$items[0]->mobile : '', array('class' => 'inputbox')) ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Phone','zem_emailsystem'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('phone', isset(zememailsystem::$items[0]->phone) ? zememailsystem::$items[0]->phone : '', array('class' => 'inputbox')) ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Address','zem_emailsystem'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('address', isset(zememailsystem::$items[0]->address) ? zememailsystem::$items[0]->address : '', array('class' => 'inputbox')) ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Published','zem_emailsystem'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::radio('status', array('1' => __('Yes','zem_emailsystem'), '0' => __('No','zem_emailsystem')), isset(zememailsystem::$items[0]->status) ? zememailsystem::$items[0]->status : 1 , array('class' => 'radiobutton')); ?></div>
            </div>
            <?php echo zemeshtml::hidden('id', isset(zememailsystem::$items[0]->id) ? zememailsystem::$items[0]->id : ''); ?>
            <?php echo zemeshtml::hidden('created', isset(zememailsystem::$items[0]->created) ? zememailsystem::$items[0]->created : date('Y-m-d H:i:s') ); ?>
            <?php echo zemeshtml::hidden('formrequest', 'zemesform'); ?>
            <div class="jjes-submit-wrapper">
                <?php echo zemeshtml::submit('save', __('Save Customer','zem_emailsystem'), array('class' => 'button')); ?>
            </div>
        </form>
    </div> 
</div>