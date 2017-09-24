define('model/menu', ['jquery', 'backbone', 'underscore', 'constUtil', 'regexUtil'], function($, Backbone, _, constUtil, regexUtil) {
	var list = Backbone.Model.extend({
		url: constUtil.absUrl(constUtil.ajaxMenu),
		defaults: { 
			data:{ eid:'', order:'', type:''}
		},
		initialize: function() {
			 //set name的时候会触发
             //this.on("change:name", function(){
				//var name = this.get("name");
				//alert("你改变了name属性为：" + name);
			 //});
			 //this.on("invalid", function() {
				//alert('error2');
			 //});
        },
		validate: function(attributes, options) {
			if(_.isEmpty(attributes.pclass) || attributes.pclass == 0) {
				return '请选择类型！';
			}
			if(_.isEmpty(attributes.pmodel) || attributes.pmodel == 0) {
				return '请选择版块！';
			}
			if(_.isEmpty(attributes.ptype) || attributes.ptype == 0) {
				return '请选择分类！';
			}
			if(!_.isUndefined(attributes.word) && _.isEmpty(attributes.word)) {
				return '请输入关键字！';
			}
			if(!_.isUndefined(attributes.key) && _.isEmpty(attributes.key)) {
				return '请输入关键字类别！';
			}
			//当save的时候触发 attributes = {"cc":"123","name":"xxx"}提交的信息 options = {"validate":true}
			//alert(JSON.stringify(attributes));
			//if(_.isEmpty(attributes)) {
			//	return 'can not empty';
			//}
		},
		validateOrder: function(attributes) {
			//_.every([true, 1, null, 'yes'], _.identity);
			if(regexUtil.isPositiveInteger(attributes.order)) {
				return false;
			}
			return '请输入数字';
		},
		post: function(btn, input, fn) {//post通用函数
			constUtil.showAjaxLoading(btn);
			$.post(this.url, input, function(json) {
				constUtil.showJsonPrompt(json, fn)(constUtil);
			});
		}
	});
	return list;
});