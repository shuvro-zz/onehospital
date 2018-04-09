(function(){
	var dep = [];
	var app = angular.module('reportsAsFile', dep)
	.factory('reportsAsFile', function($http, $window){
		return {
			showAsPdf: function(report_id)
			{
				$window.open('/reports/page/' + report_id + '/pdf');
			},
			showAsPage: function(report_id)
			{
				$window.open('/reports/page/' + report_id);
			},
			sendAsEmail: function(report_id)
			{
				return $http.get('/reports/page/' + report_id + '/email');
			}
		}
	});
})()