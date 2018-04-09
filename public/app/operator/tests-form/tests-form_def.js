(function(){
	var dep = [
		'dialogs',
		'processing-bar',
		'tests'
	];
	var app = angular.module('tests-form', dep)
	.directive('testsForm', function(processingBar, dialogs, tests){
		return {
			restrict: 'E',
			templateUrl: '/app/operator/tests-form/tests-form_view.html',
			link: function(scope, elem){
				scope.newTest = {};
				var user_id = 0;
				scope.formClass;
				scope.$on('newTest', function(e, data){
					elem.show(250);
					user_id = data.user_id;
					scope.formClass = 'create'
				});

				scope.$on('modifyTest', function(e, data){
						scope.formClass = 'modify';	
						processingBar.showProcessBar(scope);
						tests.getTest(data.test_id).then(function(res){
							try
							{
								if(res.data.status === "success")
								{
									scope.newTest = res.data.test								
								}
								else
								{
									throw true;
								}
							}
							catch(err)
							{
								processingBar.unshowProcessBar();
								showDialog('Error', 'I couln\'t process that. Have you checked the information', scope);
							}
						}, function(){
							dialogs.showDialog('Error', 'Ops! server is angry, couldn\'t do that', scope);
							processingBar.unshowProcessBar();		
						});					
				})

				elem.click(function(e){
					if(elem.is(e.target))
					{
						elem.hide();
					}
				})

				scope.createTest = function(){
					scope.newTest.user_id = user_id;	
						processingBar.showProcessBar(scope);
						tests.create(scope.newTest).then(function(res){
							processingBar.unshowProcessBar();
						try
						{
							if(res.data.status === "success")
							{
								elem.hide();
								dialogs.showDialog('Success', 'Task Completed', scope);									
								scope.newTest = {};
							}
							else
							{
								throw true;
							}
						}
						catch(err)
						{
							processingBar.unshowProcessBar();
							showDialog('Error', 'I couln\'t process that. Have you checked the information', scope);
						}
						}, function(){
						 	processingBar.unshowProcessBar();
							dialogs.showDialog('Error', 'ops! something went wrong with your request. try again or contact support', scope);
						});
					}								

				scope.modifyTest = function(){					
						processingBar.showProcessBar(scope)
						tests.modify(scope.newTest).then(function(res){
						try
						{
							processingBar.unshowProcessBar();
							if(res.data.status === "success")
							{
								dialogs.showDialog('Success', 'Task Completed!');
							}
							else
							{
								throw true;
							}
						}
						catch(err)
						{
							processingBar.unshowProcessBar();
							showDialog('Error', 'I couln\'t process that. Have you checked the information', scope);
						}
						}, function(){
							processingBar.unshowProcessBar();
							dialogs.showDialog('Error', 'Ops! server is angry, couldn\'t do that', scope);
						});
					}				
			}
		}
	});
	app.directive('datePicker', function(){
		return {
			restrict: 'A',
			link: function(scope, elem){
				elem.prop('readonly', true);
				elem.datepicker({dateFormat:'yy-mm-dd'});				
			}
		}
	});
})()