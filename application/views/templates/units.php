<table style="width:990px;border-spacing:5px;margin:auto;">
<?php
	for($i = 0 ; $i < count($units) ; $i += 3)
	{	
		$unit = $units[$i];
		$face_coords = explode("_", $unit->getFace());
		$affinity_coords = explode("_", $unit->getAffinity()->getIcon());

		echo '<tr>';

		echo '<td class="unit_display_block">';
		generate_unit_html($unit, $face_coords, $affinity_coords);
		echo '</td>';

		if(isset($units[$i+1])) {
			$unit = $units[$i+1];
			$face_coords = explode("_", $unit->getFace());
			$affinity_coords = explode("_", $unit->getAffinity()->getIcon());

			echo '<td class="unit_display_block">';
			generate_unit_html($unit, $face_coords, $affinity_coords);
			echo '</td>';
		}

		if(isset($units[$i+2])) {
			$unit = $units[$i+2];
			$face_coords = explode("_", $unit->getFace());
			$affinity_coords = explode("_", $unit->getAffinity()->getIcon());

			echo '<td class="unit_display_block">';
			generate_unit_html($unit, $face_coords, $affinity_coords);
			echo '</td>';
		}

		echo '</tr>';
	}
?>
</table>

<?php
function generate_unit_html($unit, $face_coords, $affinity_coords) {
?>
	<a style="text-decoration:none;" href="javascript:window.open('<?php echo base_url(); ?>units/view/<?php echo $unit->getId(); ?>', 'unit_window')">
		<div id="unit_img_<?php echo $unit->getId() ?>" class="unit_display_face" style="background-image:url('<?php echo base_url(); ?>/img/units/faces.png')">
			<script type='text/javascript'>
				image_rect(document.getElementById('unit_img_<?php echo $unit->getId() ?>'), 64, 64, <?php echo $face_coords[0]; ?>, <?php echo $face_coords[1]; ?>);
			</script>
		</div>
		<div style="line-height:80px;height:80px;width:85%;">
			
			<div id="unit_affinity_<?php echo $unit->getId() ?>" class="unit_display_affinity" style="background-image:url('<?php echo base_url(); ?>/img/icons/icons.png')">
				<script type='text/javascript'>
					image_rect(document.getElementById('unit_affinity_<?php echo $unit->getId() ?>'), 24, 24, <?php echo $affinity_coords[0]; ?>, <?php echo $affinity_coords[1]; ?>);
				</script>
			</div>
			<span class="unit_display_text" style="margin-right:20px;"><?php echo $unit->getName(); ?></span>
		</div>
	</a>
<?php
}
?>