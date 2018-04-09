(function(){
	describe('Login Form', function(){
		var $scope, $compile, $httpBackend, $window;
		var viewPath = 'app/operator/patient-content/patient-content_view.html';
		beforeEach(module('login-form', viewPath ));
		beforeEach(inject(['$compile', '$rootScope', '$httpBackend', '$window', '$templateCache', function(__$compile__, __$rootScope__, __$httpBackend__, __$window__, __$templateCache__){
			$scope = __$rootScope__.$new();
			var template = __$templateCache__.get(viewPath);
			__$templateCache__.put('/' + viewPath, template);
			$compile = function(){
				var e = angular.element('<patient-content></patient-content');
				var elem = __$compile__(e)($scope);
				$scope.$digest();
				return elem;
			}
			$httpBackend = __$httpBackend__;
		}]));
		it('should exist', function(){
			var elem = $compile();
			expect(elem).toBeDefined();
		});

		it('should display', function(){
			var elem = $compile();
			spyOn($scope, '$on');
			$scope.$emit('manageContent', {user_id:1});
			$scope.$digest();
			expect($scope.$on).not.toHaveBeenCalled();
		});
	});
})()