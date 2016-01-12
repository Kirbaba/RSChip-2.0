<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <link rel="icon" href="/wp-content/uploads/2015/03/657068.ico" type="image/x-icon" />
    <link rel="shortcut icon" href="/wp-content/uploads/2015/03/657068.ico" type="image/x-icon" />
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAaOWKyamSxMTXclSDFmJ2N4Am20PCTD6I&sensor=FALSE">
    </script>
    <title><?php bloginfo('name'); ?> <?php wp_title(); ?></title>
    <?php wp_head(); ?>
</head>
<body>
	<header class="header">
		<div class="container">
			<div class="row">
				<div class="header__logo">
					<img src="<?php bloginfo('template_directory'); ?>/img/logo.png" alt="">
				</div>
			</div>
		</div>
	</header>

	<section class="homescreen">
		
	</section>

	<section class="whatisrs">
		<div class="container">
			<div class="row">
				<div class="col-md-8 col-sm-9 col-xs-12">
					<h2>Знаете ли вы, почему опытные водители предпочитают RS чип тюнинг?</h2>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
					<p>Настоящая заводская мощность вашего двигателя “задушена” в 4 этапа прямо на заводе. </p>
					<h4>RS чип тюнинг – это значительные улучшения функциональных возможностей силового агрегата, включая экономию и увеличение ресурса. </h4>
				</div>
				<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
					<img src="<?php bloginfo('template_directory'); ?>/img/Sonic-turbocharged-engine.png" alt="">
				</div>
			</div>
		
		</div>
	</section>

	<section class="searchresult">
		<div class="container">
			<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">				
				<div class="searchresult__model">
					<h4>Результаты прироста для вашего автомобиля</h4>
					<p id="versionInfo">X6 / xDrive35d (286) / 2013</p>
					<!-- Убери катиринку
					<img src="<?php /*bloginfo('template_directory');*/ ?>/img/bmw_icon.png" alt="placeholder+image">-->
				</div>
				<!--<a href="#nowhere">сменить авто</a>-->
				<form action="#">
					<input type="email" class="searchresult__model__input" placeholder="Введите e-mail">
					<input type="submit" class="searchresult__model__sub" value="Отправить себе на e-mail"></input>
				</form>
			</div>
			<div class="col-lg-8 col-md-8 col-sm-6 col-xs-12">
				<h2>ЧИП-ТЮНИНГ RSCHIP</h2>
	    		<h3>снимет все заводские ограничения</h3>
	    		<img src="<?php bloginfo('template_directory'); ?>/img/numbs.png" alt="">
			</div>
		</div>
	</section>
    
<?php wp_footer(); ?>
</body>
</html>