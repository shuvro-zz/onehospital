(function(){
	var dep = [
		'dialogs',
		'processing-bar',
		'patientReports'
	];
	var app = angular.module('report-list', dep)
	.directive('reportList', function(dialogs, processingBar, patientReports){
		return {
			restrict: 'E',
			templateUrl: '/app/patient/report-list/report-list_view.html',
			link: function(scope, elem){
				scope.patientReports = [];
				processingBar.showProcessBar(scope);
				var selectedReport = 0;			
					processingBar.showProcessBar
					patientReports.reportList().then(function(res){
						processingBar.unshowProcessBar();
						try
						{
							if(res.data.status === 'success')
							{
								processingBar.unshowProcessBar();
								scope.patientReports = res.data.reports;
							}
							else
							{
								throw true;
							}
						}
						catch(err)
						{
							processingBar.unshowProcessBar();
							dialogs.showDialog('Error', 'Sorry, I wasn\'t able to retrieve this. try again later or contact support', scope);	
						}
					}, function(){
						processingBar.unshowProcessBar();
						dialogs.showDialog('Error', 'Sorry, I wasn\'t able to retrieve this. try again later or contact support', scope);
					});
				

				scope.isReportSelected = function(id)
				{
					if(id == selectedReport)
					{
						return 'selected';
					}
					return '';
				}

				scope.selectReport = function(id){					
					selectedReport = id;
					scope.$emit('reportSelected', {report_id: id});
				}
			}
		}
	});
})()