(function(){
	var dep = [];
	var app = angular.module('tests', dep)
	.factory('tests', function($http){
		return 	{
			create: function(test){
				return $http.post('/api/tests', test);
			},

			delete: function(test_id){
				return $http.delete('/api/tests/' + test_id);
			},

			getByUser: function(user_id){
				return $http.get('/api/tests/' + user_id);
			},

			getTest: function(test_id){
				return $http.get('/api/tests/' + test_id + '/edit')
			},

			modify: function(test){
				return $http.put('/api/tests/' + test.id, test);
			}
		}
	});
})()