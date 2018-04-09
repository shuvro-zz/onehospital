(function(){
	var dep = [];
	var app = angular.module('patientReports', dep)
	.factory('patientReports', function($http){
		return {
			reportList: function(){
				return $http.get('/api/patientReports');
			},
			reportDetails: function(id){
				return $http.get('/api/patientReports/' + id);
			}
		}
	});
})()