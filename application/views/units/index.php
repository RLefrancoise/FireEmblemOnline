<?php foreach ($units as $units_item): ?>

    <h2><?php echo $units_item['name'] ?></h2>
	
	<table>
		<tr>
			<th>HP</th>
			<th>Strength</th>
			<th>Magic</th>
			<th>Skill</th>
			<th>Speed</th>
			<th>Luck</th>
			<th>Defence</th>
			<th>Resistance</th>
			<th>Constitution</th>
			<th>Weight</th>
			<th>Movement</th>
		</tr>
		<tr>
			<td><?php echo $units_item['hp'] ?></td>
			<td><?php echo $units_item['strength'] ?></td>
			<td><?php echo $units_item['magic'] ?></td>
			<td><?php echo $units_item['skill'] ?></td>
			<td><?php echo $units_item['speed'] ?></td>
			<td><?php echo $units_item['luck'] ?></td>
			<td><?php echo $units_item['defence'] ?></td>
			<td><?php echo $units_item['resistance'] ?></td>
			<td><?php echo $units_item['constitution'] ?></td>
			<td><?php echo $units_item['weight'] ?></td>
			<td><?php echo $units_item['movement'] ?></td>
		</tr>
	</table>
	<br />
<?php endforeach ?>