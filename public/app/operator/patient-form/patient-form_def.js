(function(){
	var dep = [
		'patients',
		'dialogs',
		'processing-bar'
	];
	var app = angular.module('patient-form', dep)
	.directive('patientForm', function(patients, dialogs, processingBar){
		return {
			restrict: 'E',
			templateUrl: 'app/operator/patient-form/patient-form_view.html',
			link: function(scope, elem){
				scope.isReadyToDelete = false;

				scope.selectedPatient = {};
				
				scope.$on('patientSelected', function(e, data){
					
						processingBar.showProcessBar(scope);
						patients.getOne(data.id).then(function(res){
							processingBar.unshowProcessBar();
							try
							{								
								if(res.data.status === 'success')
								{
									scope.selectedPatient = res.data.patient;
								}
								else
								{
									throw 1;
								}
							}
							catch(err)
							{
								processingBar.unshowProcessBar();
								dialogs.showDialog('Error', 'Ops! the server didn\'t respond as i expected. Try again or contact support', scope);
							}
						}, function(){
							processingBar.unshowProcessBar();
							dialogs.showDialog('Error', 'Ops! the server didn\'t respond as i expected. Try again or contact support', scope);
						});
					
				});

				scope.activeUser = function(){
					if(typeof scope.selectedPatient.id === 'undefined')
					{
						return false;
					}
					return true;
				}

				scope.blankForm = function(){
					scope.selectedPatient = {};
				}

				scope.modifyPatient = function(){
					
						processingBar.showProcessBar(scope);
						patients.update(scope.selectedPatient).then(function(res){
							try
							{
								processingBar.unshowProcessBar()
								if(res.data.status === 'success')
								{
									dialogs.showDialog('Success', 'Changes successfully made!', scope);
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
								dialogs.showDialog('Error', 'it seems you have entered wrong information' , scope);
							}
						}, function(){
							processingBar.unshowProcessBar();
							dialogs.showDialog('Error', 'Ops! the server didn\'t respond as i expected. Try again or contact support', scope);
						});
					
				}

				/**
				 *
				 * this provides confirmation functionallity for avoiding delete a patient by accident
				 *
				 */
				scope.readyToDelete = function()
				{
					scope.isReadyToDelete = true;
				}

				scope.deletePatient = function(){
					
						processingBar.showProcessBar(scope);
						patients.delete(scope.selectedPatient).then(function(res){
							processingBar.unshowProcessBar();
							try
							{
								if(res.data.status === "success")
								{
									dialogs.showDialog('Success', 'Taks completed!', scope);
									scope.selectedPatient = {};
									isReadyToDelete = false;
									scope.$emit('patientsChanged');
								}
								else
								{
									throw 'unexpectedresponse';
								}
							}
							catch(err)
							{
								processingBar.unshowProcessBar();
								dialogs.showDialog('Error', 'Ops! the server didn\'t respond as i expected. Try again or contact support', scope);
							}
						}, function(){
							processingBar.unshowProcessBar();
							dialogs.showDialog('Error', 'Ops! the server didn\'t respond as i expected. You may have provided wron information. Try again or contact support', scope);
						});					
				}

				scope.isOperator = function(){
					if(scope.selectedPatient.operator == true)
					{
						elem.find('[password]').prop({'readonly':false, placeholder:'You must enter a password.'});
					}
					else
					{
						elem.find('[password]').prop({'readonly':true, placeholder:'A new random passcode is automatically generated at each transaction only for patients'});
					}
				}

				scope.createPatient = function(){					
						processingBar.showProcessBar(scope);
						patients.create(scope.selectedPatient).then(function(res){
							processingBar.unshowProcessBar();
							try
							{
								if(res.data.status === 'success')
								{
									dialogs.showDialog('Success', 'Task completed!', scope);
									scope.$emit('patientsChanged');
									scope.selectedPatient = {};
								}
								else
								{
									throw true;
								}
								}
							catch(err)
							{
								processingBar.unshowProcessBar();
								dialogs.showDialog('Error', 'it seems you provided wrong information<br>', scope);
							}
						}, function(){
							processingBar.unshowProcessBar();
							dialogs.showDialog('Error', 'Ops! the server didn\'t respond as i expected. You may have provided wrong information', scope);	
						});
					
				}

				scope.createNewTest = function(){
					scope.$emit('newTest', {user_id: scope.selectedPatient.id});
				}

				scope.createReport = function(){
					scope.$emit('newReport', {user_id: scope.selectedPatient.id});
				}

				scope.manageContent = function()
				{
					scope.$emit('manageContent', {user_id: scope.selectedPatient.id});
				}
			}			
		}
	});


})()