<!DOCTYPE html>
<html>
<head>
	<title>Daily Interior Design - Interior Design & Home Decor Inspiration</title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="shortcut icon" type="image/png" href="<?php echo URL; ?>public/dailyinteriordesign/img/logo.png">
	<link href="https://fonts.googleapis.com/css?family=Muli:300,600" rel="stylesheet">
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script type="text/javascript" src="<?php echo URL; ?>public/dailyinteriordesign/lib/jquery-transform/jquery-transform.js"></script>

	<style type="text/css">
		body {
			font-family: 'Muli', sans-serif;
			height: 100%;
			margin: 0px;
			padding: 0px;
			background-color: #f4f4f4;
		}
		a {
			text-decoration: none;
		}
		.wrapper {
			width: 100%;
		}
		.header {
			position: relative;
			height: 210px;
		}
		.header-image {
			position: absolute;
			top: 0px;
			right: 0px;
			bottom: 0px;
			left: 0px;
			width: 100%;
			height: 100%;
			overflow: hidden;
		}
		.header img {
			width: 100%;
			max-height: 100%;
			vertical-align: bottom;
		}
		.header-mask {
			position: absolute;
			top: 0px;
			right: 0px;
			bottom: 0px;
			left: 0px;
			width: 100%;
			height: 100%;
			background: linear-gradient(to bottom, transparent, rgba(0, 0, 0, 0.8));
		}
		.header-profile {
			position: absolute;
			width: 100px;
			height: 100px;
			margin: 0px auto;
			left: 0px;
			right: 0px;
			bottom: -50px;
			background-color: #fff;
			border-radius: 50%;
			box-shadow: 0px 0px 5px 2px rgba(0, 0, 0, 0.1);
			overflow: hidden;
		}
		.header-profile img {
			max-width: 100%;
		}
		.body {
			text-align: center;
			padding: 50px 30px 30px 30px;
		}
		h1 {
			color: #1e1e1e;
			font-size: 24px;
		  line-height: 26px;
		  font-weight: 300;
		  letter-spacing: 0.5px;
		  margin-bottom: 10px;
		}
		.subtitle {
			color: #8a9eae;
			font-size: 13px;
		  line-height: 16px;
		  font-weight: 300;
		  letter-spacing: 0.2px;
		}
		.social-links {
			text-align: center;
			margin-top: 30px;
		}
		.social-links a {
			display: inline-block;
			width: 28px;
			height: 28px;
			margin: 0px 15px;
		}
		.social-links a:first-of-type {
			margin-left: 0px;
		}
		.social-links a:last-of-type {
			margin-right: 0px;
		}
		.social-links a img {
			max-width: 100%;
		}
		.boxes {
			margin-top: 30px;
		}
		.box {
			background-color: #fff;
			box-shadow: 0px 0px 10px 2px #e9e9e9;
			padding: 15px;
			text-align: center;
			font-weight: 600;
			font-size: 11px;
			line-height: 11px;
			letter-spacing: 1px;
			margin-bottom: 15px;
			color: #1e1e1e;
		}
		.box.last {
			margin-bottom: 0px;
		}
	</style>
</head>
<body>
	<div class="wrapper">
		<div class="header">
			<div class="header-image">
				<img src="<?php echo URL; ?>public/dailyinteriordesign/img/img-1.jpg" class="header-img">
			</div>
			<div class="header-mask">
			</div>
			<div class="header-profile">
				<img src="<?php echo URL; ?>public/dailyinteriordesign/img/logo.png">
			</div>
		</div>
		<div class="body">
			<h1>Daily Interior Design</h1>
			<div class="subtitle">Interior Design & Home Decor</div>
			<div class="social-links">
				<a href="https://instagram.com/daily_interior_design" target="_blank">
					<img src="<?php echo URL; ?>public/dailyinteriordesign/img/social/instagram.svg">
				</a>
				<a href="https://medium.com/@dailyinteriordesign" target="_blank">
					<img src="<?php echo URL; ?>public/dailyinteriordesign/img/social/medium.svg">
				</a>
				<a href="https://twitter.com/d_interiordecor" target="_blank">
					<img src="<?php echo URL; ?>public/dailyinteriordesign/img/social/twitter.svg">
				</a>
				<a href="https://www.facebook.com/dailyinteriordesign" target="_blank">
					<img src="<?php echo URL; ?>public/dailyinteriordesign/img/social/facebook.svg">
				</a>
				<a href="https://www.pinterest.com/dailyinteriordesign/" target="_blank">
					<img src="<?php echo URL; ?>public/dailyinteriordesign/img/social/pinterest.svg">
				</a>
			</div>
			<div class="boxes">
				<a href="https://medium.com/@dailyinteriordesign/top-interior-design-styles-the-most-popular-interior-design-styles-characteristics-scandinavian-dacd4c474634" target="_blank"><div class="box">LATEST BLOG POST</div></a>
				<!--<a href="#" target="_blank">--><div class="box">INTERIOR DESIGN PRODUCTS [SOON]</div><!--</a>-->
				<a href="mailto:info.dailyinteriordecor@gmail.com" target="_blank"><div class="box">SEND US AN E-MAIL</div></a>
			</div>
		</div>
	</div>

	<script type="text/javascript">
		var headerImages = [
			'<?php echo URL; ?>public/dailyinteriordesign/img/img-1.jpg',
			'<?php echo URL; ?>public/dailyinteriordesign/img/img-2.jpg',
			'<?php echo URL; ?>public/dailyinteriordesign/img/img-3.jpg',
			'<?php echo URL; ?>public/dailyinteriordesign/img/img-4.jpg',
			'<?php echo URL; ?>public/dailyinteriordesign/img/img-5.jpg'
		];

		var prev = 1;
		function headerAnimation(img) {
			$('.header-img').animate({
				transform: 'scale(1.1)'
			}, 10000, function() {
				$(this).attr('src', '');
				$(this).css('transform', 'scale(1)');
				img = notPrev();
				$(this).attr('src', headerImages[img]);
				headerAnimation(img);
			});
		}

		function notPrev() {
			var img = Math.floor(Math.random() * headerImages.length);
			if(img == prev) {
				img = notPrev();
				return img;
			} else {
				prev = img;
				return img;
			}
		}

		var random = Math.floor(Math.random() * headerImages.length);
		headerAnimation(random);
	</script>
</body>
</html>