<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no, width=device-width">
		<meta name="apple-mobile-web-app-capable" content="yes">
		<title></title>
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/img/poo.png">

		<link href="<?php echo get_template_directory_uri(); ?>/lib/ionic/css/ionic.css" rel="stylesheet">
		<link href="<?php echo get_template_directory_uri(); ?>/style.css" rel="stylesheet">

		<!-- IF using Sass (run gulp sass first), then remove the CSS include above
		<link href="css/ionic.app.css" rel="stylesheet">
		-->

		<!-- ionic/angularjs js -->
		<script src="<?php echo get_template_directory_uri(); ?>/lib/ionic/js/ionic.bundle.js"></script>

		<script>
			var WP_API_Settings = {
				root: '<?php echo esc_url_raw( get_json_url() ); ?>',
				nonce: '<?php echo wp_create_nonce( 'wp_json' ); ?>'
			}
		</script>
		<!-- your app's js -->
		<script src="<?php echo get_template_directory_uri(); ?>/js/app.js"></script>
	</head>

	<body ng-app="babyTracker">
		<?php
		if ( ! is_user_logged_in() ) :
			?>

			<ion-pane>
				<ion-header-bar class="bar-stable">
					<h1 class="title">Poo, Pee, or Eat?</h1>
				</ion-header-bar>
				<ion-content class="has-header">
					<div class="list">
						<?php
						echo '<form name="loginform" id="loginform" action="' . esc_url( site_url( 'wp-login.php', 'login_post' ) ) . '" method="post">
							<p class="login-username">
								<label class="item item-input" for="user_login">
									<input type="text" name="log" id="user_login" class="input" value="" size="20" placeholder="' . __( 'Username' ) . '"/>
								</label>
							</p>
							<p class="login-password">
								<label class="item item-input" for="user_pass">
								<input type="password" name="pwd" id="user_pass" class="input" value="" size="20" placeholder="' . __( 'Password' ) . '" />
								</label>
							</p>

							<div class="login-remember" class="item item-input"><label class="checkbox"><input name="rememberme" type="checkbox" id="rememberme" value="forever" /></label>' . __( 'Remember Me' ) . '</div>
							<div class="item item-input">
								<input type="hidden" name="redirect_to" value="' . ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] . '" />
								<button type="submit" name="wp-submit" id="wp-submit" class="button button-positive">' . __( 'Log In' ) . '</button>
							</div>
						</form>';
						?>
					</div>
				</ion-content>
			</ion-pane>


			<?php
		else :
		?>
			<ion-pane>
				<ion-header-bar class="bar-stable">
					<a href="<?php echo wp_logout_url( site_url() ); ?>"><button class="button icon ion-log-out">Log Out</button></a>
					<h1 class="title">Poo, Pee, or Eat?</h1>
				</ion-header-bar>
				<ion-content class="has-header">
					<div class="card" ng-controller="PooPeeEat">
						<div class="item item-divider">
							Last Poo
						</div>
						<div class="item item-text-wrap">
							<h3>{{lastPoo.date | date : 'h:mma on EEE, MMM d'}}</h3>
							<div ng-bind-html="lastPoo.content | allowHTML"></div>
							<p>by: {{lastPoo.author.name}}</p>
							<button class="button button-full button-balanced" ng-click="pooPopup()">Poo!</button>
						</div>
						<div class="item item-divider">
						  Last Pee
						</div>
						<div class="item item-text-wrap">
							<h3>{{lastPee.date | date : 'h:mma on EEE, MMM d'}}</h3>
							<div ng-bind-html="lastPee.content | allowHTML"></div>
							<p>by: {{lastPee.author.name}}</p>
							<button class="button button-full button-balanced" ng-click="peePopup()">Pee!</button>
						</div>
						<div class="item item-divider">
							Last Eat
						</div>
						<div class="item item-text-wrap">
							<h3>{{lastEat.date | date : 'h:mma on EEE, MMM d'}}</h3>
							<div ng-bind-html="lastEat.content | allowHTML"></div>
							<p>by: {{lastEat.author.name}}</p>
							<button class="button button-full button-balanced" ng-click="eatPopup()">Eat!</button>
						</div>
					</div>

				</ion-content>

			</ion-pane>
		<?php endif; ?>
	</body>

</html>
