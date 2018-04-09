(function(){
	var dep = [
		'auth',
		'dialogs',
		'processing-bar'
	];
	var app = angular.module('login-form', dep)
	.directive('loginForm', function(auth, $window, dialogs, processingBar){
		return {
			restrict: 'E',
			templateUrl: '/app/login-form/login-form_view.html',
			link: function(scope, elem) {
				 scope.user = {};
				 scope.user.username = window.username || '';

				 scope.logIn = function()
				 {			 	
		 			processingBar.showProcessBar(scope);
				 	auth.login(scope.user).then(function(res){
					 	try
					 	{	
					 		processingBar.unshowProcessBar();
					 		if(res.data.status === "success") {
					 			$window.location = res.data.redirectPath;
					 		}
					 		else
					 		{
					 			throw true;
					 		}
					 	}
					 	catch(err)
					 	{
					 		dialogs.showDialog('Not Valid', 'Invalid information provided', scope);
					 	}
				 	}, function(){
				 		processingBar.unshowProcessBar();
						dialogs.showDialog('Error', 'Ops! the server didn\'t response as expected. Try again or contact support', scope);
				 	});					
				}					 
			}
		}
	});
})()