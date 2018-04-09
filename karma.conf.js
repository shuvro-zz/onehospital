// Karma configuration
// Generated on Wed Jul 27 2016 11:50:22 GMT-0500 (SA Pacific Standard Time)

module.exports = function(config) {
  config.set({

    // base path that will be used to resolve all patterns (eg. files, exclude)
    basePath: '',

    frameworks: ['jasmine'],
	plugins:[
		'karma-ng-html2js-preprocessor',
		'karma-jasmine',
		'karma-chrome-launcher'
	],
    // frameworks to use
    // available frameworks: https://npmjs.org/browse/keyword/karma-adapter
    


    // list of files / patterns to load in the browser
    files: [	  	
	    'public/include/jquery.min.js',	 
	    'public/include/angular.min.js',
	    'node_modules/angular-mocks/angular-mocks.js',
      'public/include/jasmine-jquery.js',
      'public/app/services/dialogs/dialogs_def.js',
      'public/app/services/dialogs/dialogs_view.html',
      'public/app/services/auth.js',  
      'public/app/services/tests.js',
      'public/app/services/reports.js',
      'public/app/services/patients.js',
      'public/app/services/patientReports.js',
      'public/app/services/processing-bar/processing-bar_def.js',
      'public/app/services/processing-bar/processing-bar_view.html',
      'public/app/login-form/login-form_def.js',
      'public/app/login-form/login-form_view.html',
      'public/tests/login-form_test.js',
      'public/app/operator/patient-content/patient-content_def.js',
      'public/app/operator/patient-content/patient-content_view.html',
      'public/tests/patient-content_test.js'
    ],


    // list of files to exclude
    exclude: [
    ],


    // preprocess matching files before serving them to the browser
    // available preprocessors: https://npmjs.org/browse/keyword/karma-preprocessor
    preprocessors: {
		'public/app/login-form/login-form_view.html':'ng-html2js',
    'public/app/operator/patient-content/patient-content_view.html':'ng-html2js'
    },
	
	ngHtml2JsPreprocessor: {
		// strip app from the file path
		stripPrefix: 'public/'
	},

    // test results reporter to use
    // possible values: 'dots', 'progress'
    // available reporters: https://npmjs.org/browse/keyword/karma-reporter
    reporters: ['progress'],


    // web server port
    port: 9876,


    // enable / disable colors in the output (reporters and logs)
    colors: true,


    // level of logging
    // possible values: config.LOG_DISABLE || config.LOG_ERROR || config.LOG_WARN || config.LOG_INFO || config.LOG_DEBUG
    logLevel: config.LOG_INFO,


    // enable / disable watching file and executing tests whenever any file changes
    autoWatch: true,


    // start these browsers
    // available browser launchers: https://npmjs.org/browse/keyword/karma-launcher
    browsers: ['Chrome'],


    // Continuous Integration mode
    // if true, Karma captures browsers, runs the tests and exits
    singleRun: false,

    // Concurrency level
    // how many browser should be started simultaneous
    concurrency: Infinity
  })
}
