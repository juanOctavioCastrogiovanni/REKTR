<!-- Todos las paginas llamaran con un include a footer -->
<!-- All the pages will call with an include footer -->
<!-- Footer ================================================================== -->

<div id="footerSection">
	<div class="container">
		<div class="row">
				<?php if(isset($_SESSION['user'])){?>
			<div class="span3">
				<h5>ACCOUNT</h5>
				<a href="<?php echo $point ?>/user/panel"><?php echo strtoupper($_SESSION['user']['firstname'])?></a>
				<a href="<?php echo $point ?>/user/panel?action=orderList">ORDER LIST</a>
				<a href="<?php echo $point ?>/user/panel?action=passwordChange">PASSWORD CHANGE</a>
				<a href="<?php echo $point ?>/user/panel?action=accountDelete">ACCOUNT DELETE</a>
			</div>
			<?php 
				}
			?>

			<div class="span3">
				<h5>INFORMATION</h5>
				<a href="<?php echo $point ?>/contact">CONTACT</a>
				<?php if(!isset($_SESSION['user'])){?>
				<a href="<?php echo $point ?>/login">LOGIN</a>
				<a href="<?php echo $point ?>/register">REGISTRATION</a>
				<?php }?>
				<a href="<?php echo $point ?>/products">PRODUCTS</a>
			</div>
			<div class="span3">
				<h5>CATEGORY</h5>
				<a href="<?php echo $point ?>/products?category=1">CAMERAS</a>
				<a href="<?php echo $point ?>/products?category=2">CARDS</a>
				<a href="<?php echo $point ?>/products?category=3">CARD READER</a>
			</div>
			<div id="socialMedia" class="span3 pull-right">
				<h5>SOCIAL MEDIA </h5>
				<a href="#"><img width="60" height="60" src="<?php echo $point ?>/themes/images/facebook.png"
						title="facebook" alt="facebook" /></a>
				<a href="#"><img width="60" height="60" src="<?php echo $point ?>/themes/images/twitter.png"
						title="twitter" alt="twitter" /></a>
				<a href="#"><img width="60" height="60" src="<?php echo $point ?>/themes/images/youtube.png"
						title="youtube" alt="youtube" /></a>
			</div>
		</div>

		<div class='pull-right'>
			<p><a href='http://themesseo.com/bootshop-1-1.html'><strong>Copyright templete © Bootshop 1.1/Bootshop.
						Thanks.</strong></a></p>
		</div>
	</div><!-- Container End -->
</div>
<script src="<?php echo $point ?>/themes/js/jquery.js" type="text/javascript"></script>
<script src="<?php echo $point ?>/themes/js/bootstrap.min.js" type="text/javascript"></script>
<script src="<?php echo $point ?>/themes/js/google-code-prettify/prettify.js"></script>
<script src="<?php echo $point ?>/themes/js/bootshop.js"></script>
<script src="<?php echo $point ?>/themes/js/jquery.lightbox-0.5.js"></script>

<div id="secectionBox">
	<link rel="stylesheet" href="<?php echo $point ?>/themes/switch/themeswitch.css" type="text/css" media="screen" />
	<script src="<?php echo $point ?>/themes/switch/theamswitcher.js" type="text/javascript" charset="utf-8"></script>
	<!-- <script src="themes/js/priceFilter.js" type="text/javascript" charset="utf-8"></script> -->
</div>
</body>
<!-- </html> echo "<div class='span6'>Copyright templete © <a href='http://themesseo.com/bootshop-1-1.html'><strong> Bootshop 1.1</strong></a> Thanks Juan Octavio Castrogiovanni</div>"; -->