(function(){
	describe('Login Form', function(){
		var $scope, $compile, $httpBackend, $window;
		beforeEach(module('login-form', 'app/login-form/login-form_view.html', 'dialogs', 'auth'));
		beforeEach(inject(['$compile', '$rootScope', '$httpBackend', '$window', '$templateCache', function(__$compile__, __$rootScope__, __$httpBackend__, __$window__, __$templateCache__){
			$scope = __$rootScope__.$new();
			var template = __$templateCache__.get('app/login-form/login-form_view.html');
			__$templateCache__.put('/app/login-form/login-form_view.html', template);
			$compile = function(){
				var e = angular.element('<login-form></login-form');
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

		it('should have one text input', function(){
			var elem = $compile();
			expect(elem.find('input[type="text"]').length).toEqual(1);
		});

		it('shoult have one password input', function(){
			var elem = $compile();
			expect(elem.find('input[type="password"]').length).toEqual(1);
		});

		it('should have one button', function(){
			var elem = $compile();
			expect(elem.find('button').length).toEqual(1);

		});

		it('should login', function(){
			var elem = $compile();
			$httpBackend.expectPOST('/api/login').respond({status:'success'});			
			elem.find('button').click();

		});
	});
})()