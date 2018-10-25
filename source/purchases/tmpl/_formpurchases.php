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
<?php
$units_array = array();
$units_array[] = (object) array('id' => 2 , 'text' => __('Per metric ton'));
$units_array[] = (object) array('id' => 1 , 'text' => __('Per kilo gram'));
?>
<div id="jjes-main-area">
    <div class="es-admin-title"><?php echo __('Add Purchase','zem_emailsystem');?></div>
    <div class="jjes-content-area">
        <form id="jjes-saveform" method="post" action="<?php echo admin_url("admin.php?page=purchases&task=save"); ?>">
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Item Name'); ?><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::select('purchaseitemnameid', zemesincluder::getObject('purchaseitemnames')->getPurchaseItemNameCombo() , isset(zememailsystem::$items[0]->purchaseitemnameid) ? zememailsystem::$items[0]->purchaseitemnameid : '', '' ,array('class' => 'inputbox select', 'data-validation' => 'required')); ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Description'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::textarea('note', isset(zememailsystem::$items[0]->note) ? zememailsystem::$items[0]->note : '', array('class' => 'inputbox')); ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Quantity'); ?><small></small><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('quantity', isset(zememailsystem::$items[0]->quantity) ? zememailsystem::$items[0]->quantity : '', array('class' => 'inputbox', 'data-validation' => 'required number' , 'data-validation-allowing' => 'float')); ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Rate'); ?><small>&nbsp;(As defined)</small><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('rate', isset(zememailsystem::$items[0]->rate) ? zememailsystem::$items[0]->rate : '', array('class' => 'inputbox', 'data-validation' => 'required number')); ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Unit'); ?><small>&nbsp;(kg or ton)</small><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::select('unit', $units_array , isset(zememailsystem::$items[0]->unit) ? zememailsystem::$items[0]->unit : '', '' ,array('class' => 'inputbox select', 'data-validation' => 'required')); ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Purchasing Date'); ?><font class="jjes-required">*</font></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::text('purchasedate', isset(zememailsystem::$items[0]->purchasedate) ? zememailsystem::$items[0]->purchasedate : '', array('class' => 'inputbox custom_date', 'data-validation' => 'required')); ?></div>
            </div>
            <div class="jjes-field-wrapper">
                <div class="col-xs-4 col-md-3 jjes-title"><?php echo __('Published','zem_emailsystem'); ?></div>
                <div class="col-xs-8 col-md-9 jjes-value"><?php echo zemeshtml::radio('status', array('1' => __('Yes','zem_emailsystem'), '0' => __('No','zem_emailsystem')), isset(zememailsystem::$items[0]->status) ? zememailsystem::$items[0]->status : 1 , array('class' => 'radiobutton')); ?></div>
            </div>
            <?php echo zemeshtml::hidden('id', isset(zememailsystem::$items[0]->id) ? zememailsystem::$items[0]->id : ''); ?>
            <?php echo zemeshtml::hidden('created', isset(zememailsystem::$items[0]->created) ? zememailsystem::$items[0]->created : date('Y-m-d H:i:s') ); ?>
            <?php echo zemeshtml::hidden('formrequest', 'zemesform'); ?>
            <div class="jjes-submit-wrapper">
                <?php echo zemeshtml::submit('save', __('Save Purchase','zem_emailsystem'), array('class' => 'button')); ?>
            </div>
        </form>
    </div>
</div>
