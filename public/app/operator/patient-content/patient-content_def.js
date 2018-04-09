(function(){
	var dep = [
		'dialogs',
		'processing-bar',
		'reports',
		'tests'
	];
	var app = angular.module('patient-content', dep)
	.directive('patientContent', function(dialogs, processingBar, reports, tests){
		return {
			restrict: 'E',
			templateUrl: '/app/operator/patient-content/patient-content_view.html',
			link: function(scope, elem)
			{
				scope.manageReportList = [];
				scope.manageTestList = [];
				var user_id;
				scope.$on('manageContent', function(e, data){
					processingBar.showProcessBar(scope);
					user_id = data.user_id;
					reports.get(user_id).then(function(res){
						processingBar.unshowProcessBar();
						try
						{
							if(res.data.status === 'success')
							{
								scope.manageReportList = res.data.reports;
							}
							else
							{
								throw true;
							}
						}
						catch(err)
						{
							processingBar.unshowProcessBar();
							dialogs.showDialog('Error', 'I could\'t retrieve report list', scope);	
						}
					}, function(){
						processingBar.unshowProcessBar();
						dialogs.showDialog('Error', 'I could\'t retrieve report list', scope);
					});
					processingBar.showProcessBar(scope);
					tests.getByUser(data.user_id).then(function(res){
						processingBar.unshowProcessBar();
						try
						{
							if(res.data.status === 'success')
							{
								scope.manageTestList = res.data.tests;
							}
							else
							{
								throw true;
							}
						}
						catch(err)
						{
							processingBar.unshowProcessBar();
							dialogs.showDialog('Error', 'I could\'t retrieve test list', scope);	
						}
					}, function(){
						processingBar.unshowProcessBar();
						dialogs.showDialog('Error', 'I could\'t retrieve test list', scope);
					});
					elem.show()
				});

				elem.click(function(e){
					if(elem.is(e.target))
					{
						elem.hide();
					}
				});

				scope.deleteReport = function(report_id)
				{
					reports.delete(report_id).then(function(res){
						try
						{
							if(res.data.status === 'success')
							{
								dialogs.showDialog('Success', 'Task completed!', scope);
								scope.$emit('manageContent', {'user_id':user_id});
							}
							else
							{
								throw true;
							}
						}
						catch(err)
						{
							dialogs.showDialog('Error', 'I wasn\'t able to delete that', scope);
						}
					}, function(){
						dialogs.showDialog('Error', 'I wasn\'t able to delete that', scope);
					});
				}

				scope.deleteTest = function(test_id)
				{
					console.log(test_id);
					tests.delete(test_id).then(function(res){
						try
						{
							if(res.data.status === 'success')
							{
								dialogs.showDialog('Success', 'Task completed!', scope);
								scope.$emit('manageContent', {'user_id':user_id});
							}
							else
							{
								throw true;
							}
						}
						catch(err)
						{
							dialogs.showDialog('Error', 'I wasn\'t able to delete that', scope);
						}
					}, function(){
						dialogs.showDialog('Error', 'I wasn\'t able to delete that', scope);
					});
				}
			}
		}
	});
})()