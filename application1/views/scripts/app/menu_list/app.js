define([
	'shortcutView',
	'model/menu',
	'menuListView'
], function(shortcut, menuModel, menuView) {
  var initialize = function() {
		var model = new menuModel();
		shortcut.allNeed();
		var view = new menuView({model:model});
		view.setListDelete();
		view.setListOrder();
  };
  return { 
    initialize: initialize
  };
});
