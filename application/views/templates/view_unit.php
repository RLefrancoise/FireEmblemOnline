<?php

require_once(__DIR__ . '/../../models/config/constants.php');

function generate_ability_stat_html($unit, $stat, $name)
{
?>
	<div class="unit_stat_text unit_display_text_gold"><?php echo $name; ?></div>
	<div class="unit_stat_value unit_display_text_<?php if($unit->getStat($stat) < $unit->getStatCap($stat)) echo 'white'; else echo 'green'; ?>"><?php echo $unit->getStat($stat); ?></div>
	<div class="unit_stat_bar">
		<div class="unit_stat_bar_layer1">
			<img src="<?php echo base_url(); ?>img/unit_stat_bar_left.png"/><img src="<?php echo base_url(); ?>img/unit_stat_bar_middle.png" style="width:<?php echo $unit->getStatCap($stat) * 3; ?>px;height:10px;"/><img src="<?php echo base_url(); ?>img/unit_stat_bar_right.png"/>
		</div>
		<?php if($unit->getStat($stat) > 0) { ?>
		<div class="unit_stat_bar_layer2">
			<img src="<?php echo base_url(); ?>img/unit_stat_bar_left2.png"/><img src="<?php echo base_url(); ?>img/unit_stat_bar_middle2.png" style="width:<?php echo $unit->getStat($stat) * 3; ?>px;height:8px;"/><img src="<?php echo base_url(); ?>img/unit_stat_bar_right2.png"/>
		</div>
		<?php } ?>
	</div>
<?php
}

function generate_weapon_rank_html($unit, $weapon, $name, $iconx, $icony)
{
?>
	<div style="width:285px;height:30px;">
		<span style="float:right;display:inline-block;width:50px;height:24px;text-align:right;font-size:22px" class="unit_display_text_<?php if( ($unit->getWeaponRank($weapon) !== false) and (strcmp($unit->getWeaponRank($weapon), $unit->getMaxWeaponRank($weapon)) === 0) ) echo 'green'; else 'white'; ?>"><?php if($unit->getWeaponRank($weapon)) echo $unit->getWeaponRank($weapon); else echo '--'; ?></span>

		<span style="float:left;display:inline-block;width:120px;height:24px;line-height:24px;vertical-align:middle;">
			<span id="unit_<?php echo $weapon; ?>_rank" style="float:left;margin-right:5px;width:24px;height:24px;display:inline-block;background-image:url('<?php echo base_url(); ?>/img/icons/icons.png')">
				<script type='text/javascript'>
					image_rect(document.getElementById('unit_<?php echo $weapon; ?>_rank'), 24, 24, <?php echo $iconx; ?>, <?php echo $icony; ?>);
				</script>
			</span>
			<span style="font-size:22px" class="unit_display_text_gold"><?php echo $name; ?></span>
		</span>
	</div>
<?php
}

function generate_item_html($unit, $place)
{
	$items = $unit->getItems();
	if(!isset($items[$place])) return;

	$item = $items[$place];
	$_ = explode("_", $item->getIcon());
?>
	<div class="menu_item_row" style="width:600px;height:30px;" onmouseover="tooltip.show(this)" onmouseout="tooltip.hide(this)" title="<?php echo $item->getTooltipText(); ?>">
		<span style="float:right;display:inline-block;width:100px;height:24px;text-align:right;font-size:22px" ><?php if($item->getUses() !== false) { echo $item->getCurrentUses(); ?> / <span class="unit_display_text_green"><?php echo $item->getUses(); } ?></span></span>

		<span style="position:relative;float:left;display:inline-block;width:300px;height:24px;line-height:24px;vertical-align:middle;">

		<?php
			//show equipped weapon icon or not ?
			$weapon_place = $unit->getEquippedWeaponPlace();
			if($weapon_place !== false and $weapon_place == $place) { ?>
			<span id="equipped_weapon_icon" style="position:absolute;left:-24px;display:inline-block;width:24px;height:24px;background-image:url('<?php echo base_url(); ?>/img/icons/icons.png')">
				<script type='text/javascript'>
					image_rect(document.getElementById('equipped_weapon_icon'), 24, 24, 22, 2);
				</script>
			</span>
		<?php }?>

			<span id="unit_item_<?php echo $place; ?>" style="float:left;margin-right:5px;width:24px;height:24px;display:inline-block;background-image:url('<?php echo base_url(); ?>/img/icons/icons.png')">
				<script type='text/javascript'>
					image_rect(document.getElementById('unit_item_<?php echo $place; ?>'), 24, 24, <?php echo $_[0]; ?>, <?php echo $_[1]; ?>);
				</script>
			</span>
			<?php if($item->isWeapon() && !$unit->canEquipWeapon($item)) { // should be a test of item usability instead ?>
			<span style="font-size:22px" class="unit_display_text_grey"><?php echo $item->getName(); ?></span>
			<?php } else { ?>
			<span style="font-size:22px" class="unit_display_text_white"><?php echo $item->getName(); ?></span>
			<?php } ?>
		</span>

	</div>
<?php
}

?>

<div style="text-align:center;">

	<!-- battle stats -->
	<?php
		$range = $unit->getBattleStat(BATTLESTAT_RANGE);
		if($range !== false) {
			if($range['min'] != $range['max']) $range = $range['min'] . '~' . $range['max'];
			else $range = $range['max'];
		} else {
			$range = '---';
		}
	?>
	<div style="display:inline-block;width:380px;height:250px;float:right;margin-right:5px;">
		<div style="width:185px;height:250px;display:inline-block;font-size:28px;line-height:48px;vertical-align:top;">
			<span class="unit_display_text" style="float:left;margin-left:15px;">Atk</span><span class="unit_display_text" style="float:right;margin-right:20px;"><?php if($unit->getBattleStat(BATTLESTAT_ATTACK) !== false) echo $unit->getBattleStat(BATTLESTAT_ATTACK); else echo '---'; ?></span><br>
			<span class="unit_display_text" style="float:left;margin-left:15px;">Acr</span><span class="unit_display_text" style="float:right;margin-right:20px;"><?php if($unit->getBattleStat(BATTLESTAT_ACCURACY) !== false) echo $unit->getBattleStat(BATTLESTAT_ACCURACY); else echo '---'; ?></span><br>
			<span class="unit_display_text" style="float:left;margin-left:15px;">Crit</span><span class="unit_display_text" style="float:right;margin-right:20px;"><?php if($unit->getBattleStat(BATTLESTAT_CRITICAL) !== false) echo $unit->getBattleStat(BATTLESTAT_CRITICAL); else echo '---'; ?></span><br>
			<span class="unit_display_text" style="float:left;margin-left:15px;">Rng</span><span class="unit_display_text" style="float:right;margin-right:20px;"><?php echo $range; ?></span><br>
			<span class="unit_display_text" style="float:left;margin-left:15px;">Bonus</span>
			<?php
				if($unit->getBattleStat(BATTLESTAT_BONUS) !== false) {
					$bonus = $unit->getBattleStat(BATTLESTAT_BONUS);
					for($i = 0 ; $i < count($bonus) ; $i++) {
						$bonus_icon = explode('_', $bonus[$i]->getIcon());
			?>
						<span id="bonus_icon_<?php echo $i; ?>" class="" style="float:right;margin-top:12px;margin-right:5px;display:inline-block;width:24px;height:24px;background-image:url('<?php echo base_url(); ?>/img/icons/icons.png')">
							<script type='text/javascript'>
								image_rect(document.getElementById('bonus_icon_<?php echo $i; ?>'), 24, 24, <?php echo $bonus_icon[0]; ?>, <?php echo $bonus_icon[1]; ?>);
							</script>
						</span>
			<?php 	
					}
				}
			?>
		</div>
		<div style="width:185px;height:250px;display:inline-block;font-size:28px;line-height:48px;vertical-align:top;">
			<span class="unit_display_text" style="float:left;margin-left:15px;">AS</span><span class="unit_display_text" style="float:right;margin-right:20px;"><?php if($unit->getBattleStat(BATTLESTAT_ATTACK_SPEED) !== false) echo $unit->getBattleStat(BATTLESTAT_ATTACK_SPEED); else echo '---'; ?></span><br>
			<span class="unit_display_text" style="float:left;margin-left:15px;">Avoid</span><span class="unit_display_text" style="float:right;margin-right:20px;"><?php if($unit->getBattleStat(BATTLESTAT_AVOID) !== false) echo $unit->getBattleStat(BATTLESTAT_AVOID); else echo '---'; ?></span><br>
			<span class="unit_display_text" style="float:left;margin-left:15px;">Dodge</span><span class="unit_display_text" style="float:right;margin-right:20px;"><?php if($unit->getBattleStat(BATTLESTAT_DODGE) !== false) echo $unit->getBattleStat(BATTLESTAT_DODGE); else echo '---'; ?></span>

			<div id="arrow_left" onclick="javascript:previous_unit_info();" style="cursor:pointer;position:relative;top:48px;display:inline-block;width:50px;height:50px;background-image:url('<?php echo base_url(); ?>img/icons/arrows.png')">
				<script type='text/javascript'>
					image_rect(document.getElementById('arrow_left'), 50, 50, 3, 0);
				</script>
			</div>
			<div id="arrow_right" onclick="javascript:next_unit_info();" style="cursor:pointer;position:relative;top:48px;display:inline-block;width:50px;height:50px;background-image:url('<?php echo base_url(); ?>img/icons/arrows.png')">
				<script type='text/javascript'>
					image_rect(document.getElementById('arrow_right'), 50, 50, 1, 0);
				</script>
			</div>
		</div>


	</div>
        
	<!-- main info -->
	<div id="unit_main_info">

		<div style="width:600px;height:250px;background-image:url('<?php echo base_url(); ?>img/units/<?php echo $unit->getResourcesFolder(); ?>/body.png');background-position:right bottom;background-repeat:no-repeat;">

			<div style="width:400px;height:250px;text-align:center;float:left;display:inline-block">
				<div style="z-index:1;width:297px;height:50px;line-height:50px;display:inline-block;background-image:url('<?php echo base_url(); ?>img/units/name_bg.png')">
					<span class="unit_display_text"><?php echo $unit->getName(); ?></span>
				</div>
				<div style="position:relative;top:-49px;z-index:2;width:328px;height:99px;display:inline-block;background-image:url('<?php echo base_url(); ?>img/units/class_bg.png')">
					<span class="unit_display_text" style="position:relative;top:52px;"><?php echo $unit->getClassName(); ?></span>
				</div>
				<div style="width:130px;display:inline-block;text-align:left;">
					<span class="unit_display_text" style="font-size:20px;">LV <?php echo $unit->getLevel(); ?></span>
					<span class="unit_display_text" style="font-size:20px;margin-left:20px;">EX <?php if($unit->getExp() !== false) echo $unit->getExp(); else echo '--'; ?></span>
				</div>
				<br>
				<div style="width:130px;display:inline-block;text-align:left;">
					<span class="unit_display_text" style="font-size:20px;">HP <?php echo $unit->getCurrentHP(); ?> /   <span class="unit_display_text_green"><?php echo $unit->getStat('hp'); ?></span></span>
				</div>
			</div>

		</div>

	</div>



	<!-- dynamic area -->
	<div id="unit_dynamic_area" class="bordered_block_blue">

		<div id="unit_ability_and_items">
			<!-- items -->
			<div style="width:680px;height:240px;text-align:center;float:right;">
				<div class="unit_display_text_darkblue" style="font-size:18px;">Items</div>
				<div style="width:580px;height:200px;display:inline-block;text-align:left;margin-left:30px;margin-right:30px;margin-top:10px;margin-bottom:10px;">
					<?php
					for($i = 0 ; $i < INVENTORY_SIZE ; $i++)
					{
						generate_item_html($unit, $i);
					}
					?>
				</div>
			</div>

			<!-- ability -->
			<div style="width:300px;height:240px;border-right:2px solid rgb(140,147,131);text-align:center;">
				<div class="unit_display_text_darkblue" style="font-size:18px;">Ability</div>
				<div style="margin-top:5px;font-size:20px;">

					<!-- Strength -->
					<div style="width:300px;height:30px;">
					<?php generate_ability_stat_html($unit, 'strength', 'Str'); ?>
					</div>
					<!-- Magic -->
					<div style="width:300px;height:30px;">
					<?php generate_ability_stat_html($unit, 'magic', 'Mgc'); ?>
					</div>
					<!-- Skill -->
					<div style="width:300px;height:30px;">
					<?php generate_ability_stat_html($unit, 'skill', 'Skl'); ?>
					</div>
					<!-- Speed -->
					<div style="width:300px;height:30px;">
					<?php generate_ability_stat_html($unit, 'speed', 'Spd'); ?>
					</div>
					<!-- Luck -->
					<div style="width:300px;height:30px;">
					<?php generate_ability_stat_html($unit, 'luck', 'Lck'); ?>
					</div>
					<!-- Defence -->
					<div style="width:300px;height:30px;">
					<?php generate_ability_stat_html($unit, 'defence', 'Def'); ?>
					</div>
					<!-- Resistance -->
					<div style="width:300px;height:30px;">
					<?php generate_ability_stat_html($unit, 'resistance', 'Res'); ?>
					</div>
				</div>
			</div>

		</div>

		<div id="unit_personal_data_and_weapon_level" style="display:none">
			<?php $affinity_coords = explode("_", $unit->getAffinity()->getIcon()); ?>
			<!-- weapon level -->
			<div style="width:700px;height:240px;text-align:center;float:right;">
				<div class="unit_display_text_darkblue" style="font-size:18px;">Weapon Level</div>


				<div style="width:285px;height:180px;display:inline-block;float:left;text-align:left;margin-left:30px;margin-right:30px;margin-top:20px;margin-bottom:10px;">

					<!-- sword -->
					<?php generate_weapon_rank_html($unit, WEAPON_TYPE_SWORD, 'Sword', 8, 0); ?>
					<!-- spear -->
					<?php generate_weapon_rank_html($unit, WEAPON_TYPE_SPEAR, 'Spear', 9, 0); ?>
					<!-- axe -->
					<?php generate_weapon_rank_html($unit, WEAPON_TYPE_AXE, 'Axe', 10, 0); ?>
					<!-- bow -->
					<?php generate_weapon_rank_html($unit, WEAPON_TYPE_BOW, 'Bow', 11, 0); ?>
					<!-- knife -->
					<?php generate_weapon_rank_html($unit, WEAPON_TYPE_KNIFE, 'Knife', 12, 0); ?>
					<!-- strike -->
					<?php generate_weapon_rank_html($unit, WEAPON_TYPE_STRIKE, 'Strike', 13, 0); ?>
				</div>

				<div style="width:285px;height:180px;display:inline-block;text-align:left;margin-left:30px;margin-right:30px;margin-top:20px;margin-bottom:10px;">

					<!-- fire -->
					<?php generate_weapon_rank_html($unit, WEAPON_TYPE_FIRE, 'Fire', 15, 0); ?>
					<!-- thunder -->
					<?php generate_weapon_rank_html($unit, WEAPON_TYPE_THUNDER, 'Thunder', 17, 0); ?>
					<!-- wind -->
					<?php generate_weapon_rank_html($unit, WEAPON_TYPE_WIND, 'Wind', 16, 0); ?>
					<!-- light -->
					<?php generate_weapon_rank_html($unit, WEAPON_TYPE_LIGHT, 'Light', 18, 0); ?>
					<!-- dark -->
					<?php generate_weapon_rank_html($unit, WEAPON_TYPE_DARK, 'Dark', 19, 0); ?>
					<!-- staff -->
					<?php generate_weapon_rank_html($unit, WEAPON_TYPE_STAFF, 'Staff', 14, 0); ?>

				</div>
			</div>

			<!-- personal data -->
			<div style="width:280px;height:240px;border-right:2px solid rgb(140,147,131);text-align:center;">
				<div class="unit_display_text_darkblue" style="font-size:18px;">Personal Data</div>
				<p style="padding-left:10px;font-size:20px;text-align:left;">
					<span style="display:inline-block;width:60px;height:25px;margin:0;" class="unit_display_text_gold">Con</span><span style="display:inline-block;width:100px;height:25px;" class="unit_display_text_white"><?php echo $unit->getStat('constitution'); ?></span><br>
					<span style="display:inline-block;width:60px;height:25px;margin:0;" class="unit_display_text_gold">Wgt</span><span style="display:inline-block;width:100px;height:25px;" class="unit_display_text_white"><?php echo $unit->getStat('weight'); ?></span><br>
					<span style="display:inline-block;width:60px;height:25px;margin:0;" class="unit_display_text_gold">Mvt</span><span style="display:inline-block;width:100px;height:25px;" class="unit_display_text_white"><?php echo $unit->getStat('movement'); ?></span><br>
					<span style="display:inline-block;width:60px;height:25px;margin:0;" class="unit_display_text_gold">Aff</span><span style="display:inline-block;width:100px;height:25px;" class="unit_display_text_white">
						<span id="unit_affinity_<?php echo $unit->getId() ?>" style="float:left;margin-right:5px;width:24px;height:24px;display:inline-block;background-image:url('<?php echo base_url(); ?>/img/icons/icons.png')">
							<script type='text/javascript'>
								image_rect(document.getElementById('unit_affinity_<?php echo $unit->getId() ?>'), 24, 24, <?php echo $affinity_coords[0]; ?>, <?php echo $affinity_coords[1]; ?>);
							</script>
						</span>
						<span class="unit_display_text_white"><?php echo $unit->getAffinity()->getName(); ?></span>
					</span><br>
					<span style="display:inline-block;width:60px;height:25px;margin:0;" class="unit_display_text_gold">Race</span><span style="display:inline-block;width:100px;height:25px;" class="unit_display_text_white"><?php echo $unit->getRace()->getName(); ?></span><br>
					<span style="display:inline-block;width:60px;height:25px;margin:0;" class="unit_display_text_gold">Carry</span><span style="display:inline-block;width:100px;height:25px;" class="unit_display_text_white"></span><br>
					<span style="display:inline-block;width:60px;height:25px;margin:0;" class="unit_display_text_gold">State</span><span style="display:inline-block;width:100px;height:25px;" class="unit_display_text_white"></span>
				</p>
			</div>
		</div>

		<!-- skills & support -->
		<div id="skills_and_support" style="display:none;">

			<!-- support -->
			<div style="width:400px;height:240px;text-align:center;float:right">
				<div class="unit_display_text_darkblue" style="font-size:18px;">Support</div>
				<div style="width:360px;height:26px;margin-top:10px;margin-left:20px;margin-right:20px;text-align:left;font-size:22px;">
					<span class="unit_display_text_white" style="float:right;text-align:right;"><?php echo $support['level']; ?></span>
					<span class="unit_display_text_white"><?php echo $support['name']; ?></span>
				</div>
				<div class="unit_display_text_darkblue" style="font-size:18px;">Bonus</div>
				<div style="margin-top:10px;padding-left:20px;padding-right:20px;font-size:22px;text-align:left;">
					<!-- Atk -->
					<span style="width:150px;float:right;">
						<span><span style="float:right;"><?php echo $support['atk']; ?></span><span style="float:left;" class="unit_display_text_gold">Atk</span></span>
					</span>
					<span style="display:inline-block;width:150px;height:28px;margin:0;" class="unit_display_text_white">Support</span><br>
					<!-- Def -->
					<span style="width:150px;float:right">
						<span><span style="float:right"><?php echo $support['def']; ?></span><span style="float:left;" class="unit_display_text_gold">Def</span></span>
					</span>
					<span style="display:inline-block;width:150px;height:28px;margin:0;" class="unit_display_text_white">Support</span><br>
					<!-- Hit -->
					<span style="width:150px;float:right">
						<span><span style="float:right"><?php echo $support['hit']; ?></span><span style="float:left;" class="unit_display_text_gold">Hit</span></span>
					</span>
					<span style="display:inline-block;width:150px;height:28px;margin:0;" class="unit_display_text_white">Support</span><br>
					<!-- Avoid-->
					<span style="width:150px;float:right">
						<span><span style="float:right"><?php echo $support['avd']; ?></span><span style="float:left;" class="unit_display_text_gold">Avd</span></span>
					</span>
					<span style="display:inline-block;width:150px;height:28px;margin:0;" class="unit_display_text_white">Support</span><br>
					<!-- Crit -->
					<span style="width:150px;float:right">
						<span><span style="float:right"><?php echo $bonds['bonus']; ?></span><span style="float:left;" class="unit_display_text_gold">Crit</span></span>
					</span>
					<span style="display:inline-block;width:150px;height:28px;margin:0;" class="unit_display_text_white">Bond</span>
				</div>
			</div>

			<!-- skills -->
			<div style="width:580px;height:240px;text-align:center;border-right:2px solid rgb(140,147,131);">
				<div class="unit_display_text_darkblue" style="font-size:18px;">Skills</div>

				<div style="width:320px;height:220px;margin-top:10px;float:right;vertical-align:middle;line-height:32px;text-align:left;font-size:22px;">

				<?php
					for($i = 0 ; $i < count($unit->getSkills()) ; $i++) {
						$skill = $unit->getSkills()[$i];
						$skill_icon = explode('_', $skill->getIcon());
						$skill_nb = $i + 1;
				?>
					<span style="display:inline-block;height:32px;margin-left:25px;margin-bottom:2px;position:relative;" onmouseover="tooltip.show(this)" onmouseout="tooltip.hide(this)" title="<?php echo $skill->getDescription(); ?>">
				<?php if($skill->isLocked()) { ?>
						<span id="skill_<?php echo $skill_nb; ?>_lock" style="position:absolute;left:-25px;top:5px;margin-right:5px;width:24px;height:24px;display:inline-block;background-image:url('<?php echo base_url(); ?>/img/icons/icons.png')">
							<script type='text/javascript'>
								image_rect(document.getElementById('skill_<?php echo $skill_nb; ?>_lock'), 24, 24, 24, 2);
							</script>
						</span>
				<?php } ?>
						<span id="skill_<?php echo $skill_nb; ?>" style="float:left;margin-right:5px;width:32px;height:32px;display:inline-block;background-image:url('<?php echo base_url(); ?>/img/icons/bigicons.png')">
							<script type='text/javascript'>
								image_rect(document.getElementById('skill_<?php echo $skill_nb; ?>'), 32, 32, <?php echo $skill_icon[0]; ?>, <?php echo $skill_icon[1]; ?>);
							</script>
						</span>
						<span class="unit_display_text_white" style="display:inline-block;width:240px;"><span style="float:right"><?php echo $skill->getCapacity(); ?></span><?php echo $skill->getName(); ?></span>
					</span>
				<?php
						if($i < count($unit->getSkills()) - 1) echo '<br>';
					}
				?>
				</div>

				<div style="display:inline-block;border:1px solid red;width:180px;height:200px;border-radius:5px;border:3px double rgb(140,147,131);background-color: rgba(69,72,71,1);">
					<div class="unit_display_text_darkblue" style="font-size:18px;">Capacity</div>
					<div style="font-size:22px;"><span class="unit_display_text_white"><?php echo $unit->getTotalSkillCost(); ?> / </span><span class="unit_display_text_green"><?php echo $unit->getSkillCapacity(); ?></span></div>
					<canvas id="skill_canvas" width="150" height="150">
						<script>
							var c = document.getElementById("skill_canvas");
							var ctx = c.getContext("2d");

							ctx.beginPath();
							ctx.fillStyle="grey";
							ctx.arc(75,75,65,0,2*Math.PI);
							ctx.fill();

							ctx.beginPath();
							ctx.strokeStyle="rgba(64,192,255,0.75)";
							ctx.fillStyle="rgba(64,192,255,0.75)";
							ctx.lineWidth=1;
							ctx.moveTo(75,75);
							ctx.lineTo(75,10);

							var angle = <?php
							if($unit->getTotalSkillCost() > 0) {
								echo ($unit->getTotalSkillCost() > 0 ? 360 / ($unit->getSkillCapacity() / $unit->getTotalSkillCost()) : 0);
							} else {
								echo 0;
							}?>;
							ctx.arc(75,75,65,1.5 * Math.PI, (1.5 * Math.PI) + angle * (Math.PI / 180));
							ctx.lineTo(75,75);
							ctx.stroke();
							ctx.fill();

							//border
							ctx.beginPath();
							ctx.strokeStyle="white";
							ctx.arc(75,75,65,0,2*Math.PI);
							ctx.stroke();

							ctx.beginPath();
							ctx.strokeStyle="white";
							ctx.arc(75,75,68,0,2*Math.PI);
							ctx.stroke();

							//center
							ctx.beginPath();
							ctx.strokeStyle="white";
							ctx.lineWidth=1;
							ctx.arc(75,75,15,0,2*Math.PI);
							ctx.stroke();

							ctx.beginPath();
							ctx.fillStyle="white";
							ctx.strokeStyle="white";
							ctx.lineWidth=1;
							ctx.arc(75,75,12,0,2*Math.PI);
							ctx.fill();
							ctx.stroke();
						</script>
					</canvas>
				</div>
			</div>

		</div>
		<!-- relations & biorhythm -->
		<div id="unit_relations_and_biorhythm" style="display:none;">

			<!-- biorhythm -->
			<div style="width:435px;height:240px;text-align:center;float:right;">
				<div class="unit_display_text_darkblue" style="font-size:18px;">Biorhythm</div>
				<span style="font-size:22px;display:inline-block;width:360px;height:30px;text-align:right;margin-top:10px;margin-right:30px;">
					<?php
					$biorhythm_status = $unit->getBiorhythmStatus();
					if($biorhythm_status !== false)
					{
						switch($biorhythm_status)
						{
							case BIORHYTHM_BEST:
							?>
								<span class="unit_display_text_green">
							<?php
								echo 'Best';
							?>
								</span>
							<?php
								break;
							case BIORHYTHM_GOOD:
							?>
								<span class="unit_display_text_green">
							<?php
								echo 'Good';
							?>
								</span>
							<?php
								break;
							case BIORHYTHM_NORMAL:
							?>
								<span class="unit_display_text_white">
							<?php
								echo 'Normal';
							?>
								</span>
							<?php
								break;
							case BIORHYTHM_BAD:
							?>
								<span class="unit_display_text_red">
							<?php
								echo 'Bad';
							?>
								</span>
							<?php
								break;
							case BIORHYTHM_WORST:
							?>
								<span class="unit_display_text_red">
							<?php
								echo 'Worst';
							?>
								</span>
							<?php
								break;
						}
					}
					?>
				</span>
				<canvas id="biorhythm_canvas" width="420" height="160" style="width:420px;height:160px;opacity:1;margin-left:7px;margin-right:7px;">
					<?php $wave_json = json_encode($unit->getBiorhythmWave()); ?>
					<script>
						<?php if($wave_json !== false) { ?>
						draw_biorhythm_wave('<?php echo $wave_json; ?>', <?php echo $unit->getBiorhythmTurnsNumber(); ?>, <?php echo $unit->getBiorhythmTurn(); ?>);
						<?php }?>
					</script>
				</canvas>
			</div>

			<!-- relations -->
			<div style="width:545px;height:240px;text-align:center;border-right:2px solid rgb(140,147,131);">
				<div class="unit_display_text_darkblue" style="font-size:18px;">Relations</div>
					<div style="margin-top:10px;padding-left:10px;font-size:20px;text-align:left;">
						<span style="display:inline-block;width:150px;height:25px;margin:0;" class="unit_display_text_gold">Affiliation</span><span style="display:inline-block;height:25px;" class="unit_display_text_white"><?php if($faction_name) echo $faction_name; ?></span><br>
						<span style="display:inline-block;width:150px;height:25px;margin:0;" class="unit_display_text_gold">Authority</span><span style="display:inline-block;height:25px;" class="unit_display_text_white"><?php if($unit->getAuthority()) { for($i = 0 ; $i < $unit->getAuthority() ; $i++) { echo '&#9733;'; } } ?></span><br>
						<span style="display:inline-block;width:150px;height:25px;margin:0;" class="unit_display_text_gold">Leader</span><span style="display:inline-block;height:25px;" class="unit_display_text_white"><?php if($leader_name) echo $leader_name; ?></span><br>
						<span style="display:inline-block;width:150px;height:25px;margin:0;float:left;" class="unit_display_text_gold">Bonds</span><span style="display:inline-block;" class="unit_display_text_white"><?php for($i = 0 ; $i < count($bonds['names']) ; $i++) { echo $bonds['names'][$i]; if($i < count($bonds['names']) - 1) echo '<br>'; } ?></span>
					</div>
			</div>
		</div>
	</div>

</div>
<?php

//var_dump($unit);
