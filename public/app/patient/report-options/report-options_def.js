(function(){
	var dep = [
		'processing-bar',
		'dialogs',
		'reportsAsFile'
	];
	var app = angular.module('report-options', dep)
	.directive('reportOptions', function(processingBar, dialogs, reportsAsFile){
		return {
			restrict: 'E',
			templateUrl: '/app/patient/report-options/report-options_view.html',
			link: function(scope, elem)
			{
				var report_id = 0;

				scope.$on('reportSelected', function(e, data){
					report_id = data.report_id;
				});

				scope.reportOptionsVisibility = function()
				{
					if(report_id != 0)
					{
						return true;
					}
					return false;
				}

				scope.showReportAsPage = function()
				{
					reportsAsFile.showAsPage(report_id);
				}

				scope.showReportAsPdf = function(){					
					reportsAsFile.showAsPdf(report_id);
				}

				scope.sendEmail = function(){
					processingBar.showProcessBar(scope);
					reportsAsFile.sendAsEmail(report_id).then(function(res){
						processingBar.unshowProcessBar();
						try
						{
							if(res.data.status === 'success')
							{
								dialogs.showDialog('Information', 'The Email has been sent. you will receive it shortly!', scope);		
							}
						}
						catch(err)
						{
							dialogs.showDialog('Error', 'I wasn\'t able to process the email sent. Try again later or contact support.', scope);	
						}
						
					}, function(){						
						dialogs.showDialog('Error', 'I wasn\'t able to process the email sent. Try again later or contact support.', scope);
					});
				}
			}
		}
	});
})()