// Author: Pwstrick <pwstrick@163.com>
// Filename: config.js

// Require.js allows us to configure shortcut alias
// Their usage will become more apparent futher along in the tutorial.
var require = {
  urlArgs: "bust=" + (new Date()).getTime(),
  paths: {
    jquery: '../../libs/jquery/jquery',
	backbone: '../../libs/backbone/backbone',
	underscore: '../../libs/underscore/underscore',
	spin: '../../libs/spin/spin',
	constUtil: '../../util/const',
	regexUtil: '../../util/regex',
	'model/menu': '../../models/menu/menuModel',
	shortcutView: '../../views/util/shortcutView',
	menuListView: '../../views/menu/listView'
  },
  // packages: [
        // {
            // name: 'echarts',
            // location: '../../libs/echarts',      
            // main: 'echarts'
        // },
        // {
            // name: 'zrender',
            // location: '../../libs/zrender', // zrender与echarts在同一级目录
            // main: 'zrender'
        // }
  // ],
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
};