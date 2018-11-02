<?php

require_once(__DIR__ . '/../../models/classes/Account.class.php');

$this->load->helper('session');
$account = get_account();

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<!--[if lt IE 9]>
			<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
		<title><?php echo $title ?> - Fire Emblem Online</title>

		<script>JSCLASS_PATH = '/FE/js/JS.Class 4.0.5/min'</script>

		<?php
		echo link_tag('css/tooltip.css', 'stylesheet', 'text/css') . PHP_EOL;
		echo link_tag('css/mainmenu.css', 'stylesheet', 'text/css') . PHP_EOL;
		echo link_tag('css/gamemenu.css', 'stylesheet', 'text/css') . PHP_EOL;
		echo link_tag('css/map.css', 'stylesheet', 'text/css') . PHP_EOL;
		echo link_tag('css/units.css', 'stylesheet', 'text/css') . PHP_EOL;
		echo link_tag('css/unit.css', 'stylesheet', 'text/css') . PHP_EOL;
		echo link_tag('css/home.css', 'stylesheet', 'text/css') . PHP_EOL;
		echo link_tag('css/items.css', 'stylesheet', 'text/css') . PHP_EOL;

		echo script_tag('js/tooltip.js', 'text/javascript') . PHP_EOL;
		echo script_tag('js/jquery-1.11.1.js', 'text/javascript') . PHP_EOL;
		echo script_tag('js/home.js', 'text/javascript') . PHP_EOL;
		echo script_tag('js/utils.js', 'text/javascript') . PHP_EOL;
		echo script_tag('js/unit.js', 'text/javascript') . PHP_EOL;
		echo script_tag('js/JS.Class 4.0.5/min/loader-browser.js', 'text/javascript') . PHP_EOL;

		echo script_tag('js/classes/Key.js', 'text/javascript') . PHP_EOL;
		?>

		<script type="text/javascript">
			window.requestAnimationFrame = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame;

			var base_url = '<?php echo base_url(); ?>';

			var loadJSCallback = null;

			JS.require('JS.Class', function(Class) {
				<?php
					include_once(__DIR__ . '/../../../js/classes/BattleMap.class.js');
					include_once(__DIR__ . '/../../../js/classes/BattleScene.class.js');
				?>

				if(loadJSCallback) loadJSCallback();
			});
		</script>
	</head>

	<body>
		<div id="tooltip">
		</div>

		<?php
				$img_properties = array(
									'src' => 'img/Rolf_en.png',
									'id' => 'bg_rolf');
				echo img($img_properties);

				$img_properties = array(
									'src' => 'img/ed.png',
									'id' => 'bg_edward');
				echo img($img_properties);
			?>

		<div id="main_div">
			<header id="header">
				<div id="banniere">
					<nav id="main_menu">
						<?php include_once(__DIR__ . '/main_menu.php'); ?>

						<?php if(!is_logged_in($this->session)) { ?>
						<div id="login_div" class="bordered_block_blue">
							<?php echo form_open('', array('id' => 'login_form', 'name' => 'login_form')); ?>
								<label for="username">Username:</label><input type="text" size="30" class="login_input" id="username" name="username"/>
								<label for="password">Password:</label><input type="password" size="30" class="login_input" id="password" name="password"/>
								<input onclick="javascript:login()" type="button" value="Login" />
							</form>
							<br>

						</div>

						<script>
							$('#mainmenu_login').click(function() {
								$('#login_div').fadeTo(1000, 1.0);
								return false;
							});
						</script>

						<?php } ?>

						<p style="padding:0;color:white" id="login_info">
						<?php
							if(is_logged_in($this->session)) {
								echo "Welcome, {$account->getUsername()}";
						?>
								<p style="width:300px;margin:auto;" class="bordered_block_blue"><span id="login_info_gold"><?php echo $account->getGold(); ?></span> Gold</p>
						<?php
							}
						?>
						</p>

					</nav>
				</div>
			</header>

			<?php if(is_logged_in($this->session)) { ?>
			<div id="game_menu">
				<?php include_once(__DIR__ . '/game_menu.php'); ?>
			</div>
			<?php } ?>

			<section id="main_section" class="bordered_block_brown">
