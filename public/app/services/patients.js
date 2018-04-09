(function(){
	var dep = [];
	var app = angular.module('patients', dep)
	.factory('patients', function($http){
		return {
			create: function(patient){
				return $http.post('/api/patient', patient);
			},

			delete: function(patient){
				return $http.delete('/api/patient/' + patient.id);
			},

			getAll: function(){
				return $http.get('/api/patient');
			},

			getOne: function(id){
				return $http.get('/api/patient/' + id);
			},

			update: function(patient){
				return $http.put('/api/patient/' + patient.id, patient);
			}
		}
	});
})()