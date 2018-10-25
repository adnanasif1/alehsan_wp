<?php
    zemesMessages::getLayoutMessage();
?>
<script type="text/javascript">
    function resetFrom(){
        document.getElementById('itemname').value ='';
        document.getElementById('jjes-searchform').submit();
    }
</script>

<div id="jjes-main-area">
    <div class="es-admin-title"><?php echo __('Purchases','zem_emailsystem');?><a class="es-add-button-link" href="?page=purchases&zemel=formpurchases"><i class="fa fa-plus-circle fa-lg fa-fw"></i>&nbsp;<?php echo __('Add Purchase','zem_emailsystem');?></a></div>
    <div class="jjes-content-area">
        <form name="jjes-searchform" id="jjes-searchform" method="post" action="<?php echo admin_url("admin.php?page=purchases"); ?>">
            <?php
            echo zemeshtml::text('itemname', zememailsystem::$items['filter']['itemname'], array('class' => 'inputbox', 'placeholder' => __('Search','zem_emailsystem')));
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
                    <th class="left-row"><?php echo __('Title','zem_emailsystem'); ?></th>
                    <th class="centered"><?php echo __('Quantity','zem_emailsystem'); ?></th>
                    <th class="centered"><?php echo __('Rate','zem_emailsystem'); ?></th>
                    <th class="centered"><?php echo __('Unit','zem_emailsystem'); ?></th>
                    <th class="centered"><?php echo __('Total','zem_emailsystem'); ?> <small>&nbsp;Rs</small> </th>
                    <th class="centered"><?php echo __('Purchase','zem_emailsystem'); ?></th>
                    <th class="action"><?php echo __('Action','zem_emailsystem'); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $total = count( zememailsystem::$items[0] );
                    for ( $i = 0; $i < $total; $i++ ){
                        $row = zememailsystem::$items[0][$i];
                        $color = date('n' , strtotime($row->purchasedate));
                        ?>
                        <tr valign="top">
                            <td class="left-row" title="<?php echo $row->note; ?>">
                                <a href="?page=purchases&zemel=formpurchases&zemesid=<?php echo $row->id; ?>"> <?php echo $row->title; ?></a>
                                <?php if(!empty($row->note)){
                                    echo '<i style="float:right; color:#399e18" class="fa fa-lightbulb-o fa-fw"></i>';
                                } ?>
                            </td>
                            <td class="centered">
                                <?php echo $row->quantity; ?>
                            </td>
                            <td class="centered">
                                <?php echo $row->rate; ?>
                            </td>
                            <td class="centered">
                                <?php echo ($row->unit == 1) ? 'Per kg' : 'Per ton'; ?>
                            </td>
                            <td class="centered">
                                <?php echo $row->total; ?>
                            </td>
                            <td style="background:<?php echo $colors[$color]; ?>;">
                                <?php echo date('d-M-Y', strtotime($row->purchasedate)); ?>
                            </td>
                            <td class="action">
                                <a href="?page=purchases&zemel=formpurchases&zemesid=<?php echo $row->id; ?>"><i style="color:black;" class="fa fa-pencil fa-lg fa-fw"></i></a>
                                <a class="zem-confirm" href="?page=purchases&task=remove&action=zemesaction&zemesid=<?php echo $row->id; ?>"><i style="color:black;" class="fa fa-trash-o fa-lg fa-fw"></i></a>
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
