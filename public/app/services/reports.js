(function(){
	var dep = [];
	var app = angular.module('reports', dep)
	.factory('reports', function($http){
		return {
			create: function(report){
				return $http.post('/api/reports', report);
			},
			get: function(user_id){
				return $http.get('/api/reports/' + user_id + '/edit');
			},
			modify: function(report){
				return $http.put('/api/reports/' + report.id);
			},
			delete: function(id){
				return $http.delete('/api/reports/' + id);
			}

		}
	});
})()