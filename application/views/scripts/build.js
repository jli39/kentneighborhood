({
    appDir: './',
    baseUrl: './',
	dir: '../optimize',
	optimizeCss: 'standard',
	urlArgs: "bust=" + (new Date()).getTime(),
	paths: {
		jquery: 'libs/jquery/jquery',
		backbone: 'libs/backbone/backbone',
		underscore: 'libs/underscore/underscore',
		spin: 'libs/spin/spin',
		constUtil: 'util/const',
		regexUtil: 'util/regex',
		'model/menu': 'models/menu/menuModel',
		shortcutView: 'views/util/shortcutView',
		menuListView: 'views/menu/listView'
	},
    modules: [
		{name: 'app/index/main'},
		{name: 'app/menu_list/main'}
    ],
	fileExclusionRegExp: /^(r|build|jasmine|optimize)\.{0,1}(js|bat){0,1}$/,
	shim: {
		'backbone': {
					//These script dependencies should be loaded before loading
					//backbone.js
					deps: ['underscore', 'jquery'],
					//Once loaded, use the global 'Backbone' as the
					//module value.
					exports: 'Backbone'
		},
		'underscore': {
				exports: '_'
		}
	}
})
