(function(){
	var dep = [];
	var app = angular.module('auth', dep)
	.factory('auth', function($http){
		return {
			login: function(credentials){
				return $http.post('/api/login', credentials);
			}
		}
	});
})()