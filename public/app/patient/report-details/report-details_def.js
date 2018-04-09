(function(){
	var dep = [
		'dialogs',
		'processing-bar',
		'patientReports'
	];
	var app = angular.module('report-details', dep)
	.directive('reportDetails', function(dialogs, processingBar, patientReports){
		return {
			restrict: 'E',
			templateUrl: '/app/patient/report-details/report-details_view.html',
			link: function(scope, elem){
				scope.reportTests = [];

				scope.$on('reportSelected', function(e, data){
					processingBar.showProcessBar(scope);
					patientReports.reportDetails(data.report_id).then(function(res){
						processingBar.unshowProcessBar();
						try
						{
							if(res.data.status === 'success')
							{
								scope.reportTests = res.data.tests;
							}
							else
							{
								throw true;
							}
						}
						catch(err)
						{
							processingBar.unshowProcessBar();
							dialogs.showDialog('Error', 'Sorry, the server didn\'t properly respond. Try again later or contact support', scope);
						}
					}, function(){
						processingBar.unshowProcessBar();
						dialogs.showDialog('Error', 'Sorry, couln\'t load the information. Try again later or contact support', scope);
					});
				});
			}
		}
	});
})()