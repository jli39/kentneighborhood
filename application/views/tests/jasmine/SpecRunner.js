require.config({
  baseUrl: "../../scripts/",
  urlArgs: 'cb=' + Math.random(),
  paths: {
    jquery: 'libs/jquery/jquery',
    underscore: 'libs/underscore/underscore',
    backbone: 'libs/backbone/backbone',
	constUtil: 'util/const',
	regexUtil: 'util/regex',
	spin: 'libs/spin/spin',
    jasmine: 'libs/jasmine/jasmine',
    'jasmine-html': 'libs/jasmine/jasmine-html',
	'jasmine-jquery': 'libs/jasmine/jasmine-jquery',
	'jasmine-ajax': 'libs/jasmine/jasmine-ajax',
	'model/menu': 'models/menu/menuModel',
	spec: '../tests/jasmine/spec/'
  },
  shim: {
    underscore: {
      exports: "_"
    },
    backbone: {
      deps: ['underscore', 'jquery'],
      exports: 'Backbone'
    },
    jasmine: {
      exports: 'jasmine'
    },
    'jasmine-html': {
      deps: ['jasmine'],
      exports: 'jasmine'
    },
	'jasmine-jquery': {
      deps: ['jasmine'],
      exports: 'jasmine_jquery'
    },
	'jasmine-ajax': {
      deps: ['jasmine'],
      exports: 'jasmine_ajax'
    }
  }
});


window.store = "TestStore"; // override local storage store name - for testing

//遍历对象中的各种key
alertKeys = function(object) {
		var keys = [];
		for(var key in object) keys.push(key);
		alert(keys.join(","));
};

require(['underscore', 'jquery', 'jasmine-html', 'jasmine-jquery', 'jasmine-ajax'], function(_, $, jasmine){

  var jasmineEnv = jasmine.getEnv();
  jasmineEnv.updateInterval = 1000;

  var htmlReporter = new jasmine.HtmlReporter();

  jasmineEnv.addReporter(htmlReporter);

  jasmineEnv.specFilter = function(spec) {
    return htmlReporter.specFilter(spec);
  };
  //设置模板路径
  jasmine.getFixtures().fixturesPath = 'spec/fixtures';
  
  
  var specs = [];
//  www.pwstrick.net/admin/tests/jasmine 测试地址
    specs.push('spec/models/menu/menuSpec');
	//specs.push('spec/models/admin_keyword/listSpec');
	//specs.push('spec/views/admin_keyword/listSpec');
  //specs.push('spec/views/CountViewSpec');
  //specs.push('spec/views/FooterViewSpec');
  //specs.push('spec/views/MarkAllSpec');
  //specs.push('spec/views/NewTaskSpec');
  //specs.push('spec/views/TaskListSpec');
  //specs.push('spec/views/task/TaskViewSpec');
  //specs.push('spec/views/task/ViewTaskViewSpec');
  //specs.push('spec/views/task/EditTaskViewSpec');

  $(function(){
    require(specs, function(){
      jasmineEnv.execute();
    });
  });

});
