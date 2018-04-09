(function(){
	var dep = [];
	var app = angular.module('processing-bar', dep)
	.directive('processingBar', function(){
		return {
			restrict: 'E',
			template: '<img src="/images/blue.gif"/>'
		}
	});

	app.factory('processingBar', function($compile){
		return {
			showProcessBar: function(scope){
				var processBar = $compile('<processing-bar></processing-bar>');
				$('body').append(processBar(scope));
			},
			unshowProcessBar: function(scope){
				$('body').find('processing-bar').remove();
			}
		}
	});
})()