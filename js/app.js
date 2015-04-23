// Ionic Starter App

// angular.module is a global place for creating, registering and retrieving Angular modules
// 'starter' is the name of this angular module example (also set in a <body> attribute in index.html)
// the 2nd parameter is an array of 'requires'
var app = angular.module('babyTracker', ['ionic'])

app.run(function($ionicPlatform) {
  $ionicPlatform.ready(function() {
    // Hide the accessory bar by default (remove this to show the accessory bar above the keyboard
    // for form inputs).
    // The reason we default this to hidden is that native apps don't usually show an accessory bar, at 
    // least on iOS. It's a dead giveaway that an app is using a Web View. However, it's sometimes
    // useful especially with forms, though we would prefer giving the user a little more room
    // to interact with the app.
    if(window.cordova && window.cordova.plugins.Keyboard) {
      cordova.plugins.Keyboard.hideKeyboardAccessoryBar(true);
    }
    if(window.StatusBar) {
      // Set the statusbar to use the default style, tweak this to
      // remove the status bar on iOS or change it to use white instead of dark colors.
      StatusBar.styleDefault();
    }
  });
});

app.controller('PooPeeEat', [ '$scope', '$http', '$window', '$ionicPopup', function($scope, $http, $window, $ionicPopup) {
	$http({
		method: 'GET',
		url: 'http://babytracker.dev/wp-json/posts',
		params: {
			type: 'baby_action',
			'filter[meta_key]': 'baby_action_type',
			'filter[meta_value]': 'poo',
			'filter[posts_per_page]': 1,
			'filter[orderby]': 'date'
		}

	})
	.success(function(data) {
		$scope.lastPoo = data[0];
	});

	$http({
		method: 'GET',
		url: 'http://babytracker.dev/wp-json/posts',
		params: {
			type: 'baby_action',
			'filter[meta_key]': 'baby_action_type',
			'filter[meta_value]': 'pee',
			'filter[posts_per_page]': 1,
			'filter[orderby]': 'date'
		}

	})
	.success(function(data) {
			console.log(data);
		$scope.lastPee = data[0];
	});

	$http({
		method: 'GET',
		url: 'http://babytracker.dev/wp-json/posts',
		params: {
			type: 'baby_action',
			'filter[meta_key]': 'baby_action_type',
			'filter[meta_value]': 'eat',
			'filter[posts_per_page]': 1,
			'filter[orderby]': 'date'
		}

	})
	.success(function(data) {
		$scope.lastEat = data[0];
	});

	$scope.pooPopup = function() {
		$scope.newPoo = {}

		var pooPopup = $ionicPopup.show({
			template: '<input type="textarea" ng-model="newPoo.note">',
			title: 'Log a Poo!',
			subTitle: 'Leave a note if you\'d like',
			scope: $scope,
			buttons: [
				{ text: 'Cancel' },
				{
					text: '<b>Save</b>',
					type: 'button-positive',
					onTap: function(e) {
						var req = {
							method: 'POST',
							url: 'http://babytracker.dev/wp-json/posts',
							headers: {
								'X-WP-Nonce': WP_API_Settings.nonce
							},
							data: {
								title: '',
								content_raw: $scope.newPoo.note,
								type: 'baby_action',
								status: 'publish',
								post_meta: [{key:'baby_action_type', value: 'poo'}]
							}
						}
						$http(req)
						.success(function(response) {
							console.log(response);
							$window.location.reload();
						});

					}
				}
			]
		});

	};

	$scope.peePopup = function() {
		$scope.newPee = {}

		var peePopup = $ionicPopup.show({
			template: '<input type="textarea" ng-model="newPee.note">',
			title: 'Log a Pee!',
			subTitle: 'Leave a note if you\'d like',
			scope: $scope,
			buttons: [
				{ text: 'Cancel' },
				{
					text: '<b>Save</b>',
					type: 'button-positive',
					onTap: function(e) {
						var req = {
							method: 'POST',
							url: 'http://babytracker.dev/wp-json/posts',
							headers: {
								'X-WP-Nonce': WP_API_Settings.nonce
							},
							data: {
								title: '',
								content_raw: $scope.newPee.note,
								type: 'baby_action',
								status: 'publish',
								post_meta: [{key:'baby_action_type', value: 'pee'}]
							}
						}
						$http(req)
							.success(function(response) {
								console.log(response);
								$window.location.reload();
							});

					}
				}
			]
		});

	};

	$scope.eatPopup = function() {
		$scope.newEat = {}

		var eatPopup = $ionicPopup.show({
			template: '<input type="textarea" ng-model="newEat.note">',
			title: 'Log an Eat!',
			subTitle: 'Leave a note if you\'d like',
			scope: $scope,
			buttons: [
				{ text: 'Cancel' },
				{
					text: '<b>Save</b>',
					type: 'button-positive',
					onTap: function(e) {
						var req = {
							method: 'POST',
							url: 'http://babytracker.dev/wp-json/posts',
							headers: {
								'X-WP-Nonce': WP_API_Settings.nonce
							},
							data: {
								title: '',
								content_raw: $scope.newEat.note,
								type: 'baby_action',
								status: 'publish',
								post_meta: [{key:'baby_action_type', value: 'eat'}]
							}
						}
						$http(req)
							.success(function(response) {
								console.log(response);
								$window.location.reload();
							});

					}
				}
			]
		});

	};

}]);

/**
 * Allow HTML to be output from the model
 */
app.filter('allowHTML', [ '$sce', function( $sce ) {
	return function(val) {
		return $sce.trustAsHtml(val);
	};
}]);