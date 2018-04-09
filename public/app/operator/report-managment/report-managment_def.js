(function(){
	var dep = [
		'dialogs',
		'tests',
		'reports',
		'processing-bar'
	];
	var app = angular.module('report-managment', dep)
	.directive('reportManagment', function(dialogs, processingBar, tests, reports){
		return {
			restrict: 'E',
			templateUrl: '/app/operator/report-managment/report-managment_view.html',
			link: function(scope, elem){
				scope.patientTests = [];
				scope.reportTests = [];
				scope.reportFormClass;
				scope.newReport = {};

				var user_id;
				var report_id;

				scope.$on('newReport', function(e, data){
					scope.reportFormClass = 'create';
					elem.show(250);
					user_id = data.user_id;	
						processingBar.showProcessBar(scope);
						tests.getByUser(user_id).then(function(res){
							try
							{
								processingBar.unshowProcessBar();
								if(res.data.status === "success")
								{
									scope.patientTests = res.data.tests;
								}
								else
								{
									throw true;
								}
							}
							catch(err)
							{
								processingBar.unshowProcessBar();
								dialogs.showDialog('Error', 'Could\'t get a proper response from the server.', scope);	
								scope.patientTests = [];
							}
						}, function(){
							processingBar.unshowProcessBar();
							dialogs.showDialog('Error', 'Could\'t get a proper response from the server.', scope);
							scope.patientTests = [];
						});
				});

				scope.closeReportForm = function(){
					elem.hide(250);
				}

				scope.addTestToReport = function(test){
					var flag = false; //prevent duplicate keys
					$.each(scope.reportTests, function(key, value){
						if(value.id == test.id)
						{
							flag = true
						}
					});
					if(!flag)
					{
						scope.reportTests.push(test);
					}
				}

				scope.createNewReport = function(){
						scope.newReport.innerTests = scope.reportTests;
						scope.newReport.user_id = user_id;
						
							processingBar.showProcessBar(scope)
							reports.create(scope.newReport).then(function(res){
								try
								{	
									processingBar.unshowProcessBar();
									if(res.data.status === 'success')
									{
										elem.hide();
										dialogs.showDialog('Success', 'Task Completed', scope);									
										scope.reportTests = [];
										scope.newReport.name = '';
										scope.$emit('patientsChanged');
									}
									else
									{
										throw true;
									}
								}
								catch(err)
								{
									processingBar.unshowProcessBar();
									dialogs.showDialog('Error', 'I cannot process this request. Have you named this report and assign tests?', scope);	
								}
							}, function(){
								processingBar.unshowProcessBar();
								dialogs.showDialog('Error', 'I cannot process this request. Have you named this report and assign tests?', scope);
							});			
						
				}
			}
		}
	});
})()