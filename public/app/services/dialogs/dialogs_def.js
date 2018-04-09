(function(){
	var dep = [];
	var app = angular.module('dialogs', dep);
	
	app.directive('dialogScreen', function(){
		return {
			restrict: 'E',
			templateUrl: '/app/services/dialogs/dialogs_view.html',
			link: function(scope, elem, attr){
				scope.dialog = {};
				scope.dialog.title = attr.title;
				scope.dialog.message = attr.message;
				elem.click(function(){
					elem.remove();
				});
			}
		}
	});

	app.factory('dialogs', function($compile){
		return{
			showDialog: function(title, message, scope)
			{
				var dialog = $compile('<dialog-screen title="' + title + '" message="' + message + '"></dialog-screen>');
				$('body').append(dialog(scope));
			}
		}
	});
})()