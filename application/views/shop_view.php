<div id="warehouse_div" class="bordered_block_blue">
    <div id="warehouse_items_sword" style="display:none;">
    <?php
        foreach($items[WEAPON_TYPE_SWORD] as $i => $item) {
            generate_item_html($item, 'sword', $i);
        }
    ?>
    </div>

    <div id="warehouse_items_spear" style="display:none;">
    <?php
        foreach($items[WEAPON_TYPE_SPEAR] as $i => $item) {
            generate_item_html($item, 'spear', $i);
        }
    ?>
    </div>

    <div id="warehouse_items_axe" style="display:none;">
    <?php
        foreach($items[WEAPON_TYPE_AXE] as $i => $item) {
            generate_item_html($item, 'axe', $i);
        }
    ?>
    </div>

    <div id="warehouse_items_bow" style="display:none;">
    <?php
        foreach($items[WEAPON_TYPE_BOW] as $i => $item) {
            generate_item_html($item, 'bow', $i);
        }
    ?>
    </div>

    <div id="warehouse_items_knife" style="display:none;">
    <?php
        foreach($items[WEAPON_TYPE_KNIFE] as $i => $item) {
            generate_item_html($item, 'knife', $i);
        }
    ?>
    </div>

    <div id="warehouse_items_fire" style="display:none;">
    <?php
        foreach($items[WEAPON_TYPE_FIRE] as $i => $item) {
            generate_item_html($item, 'fire', $i);
        }
    ?>
    </div>

    <div id="warehouse_items_thunder" style="display:none;">
    <?php
        foreach($items[WEAPON_TYPE_THUNDER] as $i => $item) {
            generate_item_html($item, 'thunder', $i);
        }
    ?>
    </div>

    <div id="warehouse_items_wind" style="display:none;">
    <?php
        foreach($items[WEAPON_TYPE_WIND] as $i => $item) {
            generate_item_html($item, 'wind', $i);
        }
    ?>
    </div>

    <div id="warehouse_items_light" style="display:none;">
    <?php
        foreach($items[WEAPON_TYPE_LIGHT] as $i => $item) {
            generate_item_html($item, 'light', $i);
        }
    ?>
    </div>

    <div id="warehouse_items_dark" style="display:none;">
    <?php
        foreach($items[WEAPON_TYPE_DARK] as $i => $item) {
            generate_item_html($item, 'dark', $i);
        }
    ?>
    </div>

    <div id="warehouse_items_staff" style="display:none;">
    <?php
        foreach($items[WEAPON_TYPE_STAFF] as $i => $item) {
            generate_item_html($item, 'staff', $i);
        }
    ?>
    </div>

    <div id="warehouse_items_other" style="display:none;">
    <?php
        foreach($items[ITEM_TYPE_GENERIC_ITEM] as $i => $item) {
            generate_item_html($item, 'other', $i);
        }
    ?>
    </div>
</div>

<?php
function generate_item_html($item, $type, $place)
{
    $_ = explode("_", $item->getIcon());
?>
    <div onclick="javascript:buy_item('<?php echo $type; ?>', <?php echo $item->getId(); ?>)" class="menu_item_row" style="width:99%;height:30px;margin:auto;text-align: left;cursor:hand;" onmouseover="tooltip.show(this)" onmouseout="tooltip.hide(this)" title="<?php echo $item->getTooltipText(); ?>">
        <span style="float:right;display:inline-block;width:100px;height:24px;text-align:right;font-size:22px" ><?php echo $item->getWorth(); ?></span>

        <span style="position:relative;float:left;display:inline-block;width:60%;height:24px;line-height:24px;vertical-align:middle;">
            <span id="unit_item_<?php echo $type . '_' . $place; ?>" style="float:left;margin-right:5px;width:24px;height:24px;display:inline-block;background-image:url('<?php echo base_url(); ?>/img/icons/icons.png')">
                <script type='text/javascript'>
                    image_rect(document.getElementById('unit_item_<?php echo $type . '_' . $place; ?>'), 24, 24, <?php echo $_[0]; ?>, <?php echo $_[1]; ?>);
                </script>
            </span>

            <span style="font-size:22px" class="unit_display_text_white"><?php echo $item->getName(); ?></span>
        </span>

    </div>
<?php
}
?>

<script type="text/javascript">
var currentType = 'sword';

$('[id*=warehouse_items]').fadeOut(10, function() {
    $('#warehouse_items_sword').fadeIn(1);
});

function switch_warehouse_item_type(type) {
    console.log(type);
    $('#warehouse_items_' + currentType).fadeOut(250, function() {
        $('#warehouse_items_' + type).fadeIn(250);
        currentType = type;
    });
}

function buy_item(type, id) {

    var c = confirm('Buy ?');
    if(!c) return;

    $.get('shop/buy', {
        type: type,
        id: id
    })
    .done(function(data) {
        data = JSON.parse(data);
        if(data.success) {
            alert('buy ok : ' + JSON.stringify(data,null,4));
            $('#login_info_gold').text(data.gold);
        }
        else alert(data.error);
    })
    .fail(function(error) {
        alert('fail : ' + JSON.stringify(error, null, 4));
    });
}
</script>

<?php

//var_dump($items);