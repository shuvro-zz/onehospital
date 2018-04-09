(function(){
	var dep = [
		'patients',
		'dialogs',
		'processing-bar'
	];
	var app = angular.module('patient-list', dep)
	.directive('patientList', function(patients, dialogs, processingBar){
		return {
			restrict: 'E',
			templateUrl: '/app/operator/patient-list/patient-list_view.html',
			link: function(scope, elem){
				scope.patientList = [];
				var currentPatient = 0;
				var loadPatients = function(){					
						processingBar.showProcessBar(scope);
						patients.getAll().then(function(res){
							try
							{
								processingBar.unshowProcessBar();
								if(res.data.status === "success")
								{
									scope.patientList = res.data.patients;
								}
								else
								{
									throw 'unexpected response';
								}
							}
							catch(err)
							{
								processingBar.unshowProcessBar();
								dialogs.showDialog('Error', 'Ops! the server didn\'response as I expected. Try again or contact support', scope);
							}
						}, function(){
							processingBar.unshowProcessBar();
							dialogs.showDialog('Error', 'Ops! the server didn\'response as I expected. Try again or contact support', scope);
				
						})
				}
					
				

				loadPatients();
				
				scope.isSelected = function(patientId){
					if(patientId == currentPatient){
						return 'selected';
					}
					return '';
				}

				
				scope.changeSelection = function(patient) {
					currentPatient = patient.id;
					scope.$emit('patientSelected', patient);

				}

				scope.$on('patientsChanged', function(){
					loadPatients();
				});
			}
		}
	});
})()