<ul class="bordered_block_blue">
	<li><?php echo a_tag('Home', 'home'); ?></li>
	<li><?php echo a_tag('About', 'about'); ?></li>
	<?php if(!$this->session->userdata('logged_in')){ ?>
	<li><?php echo a_tag('Register', 'register'); ?></li>
	<li><?php echo a_tag('Log in', array('href' => '#', 'id' => 'mainmenu_login')); ?></li>
	<?php } else {?>
	<li><?php echo a_tag('My Account', 'account'); ?></li>
	<li><?php echo a_tag('Logout', 'logout'); ?></li>
	<?php } ?>
	<li><?php echo a_tag('Forum', 'forum'); ?></li>
</ul>