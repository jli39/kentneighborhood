define(['backbone', 'underscore', 'constUtil'], function(Backbone, _, constUtil) {
	var list = Backbone.Model.extend({
		url: constUtil.domain + constUtil.adminAjaxKeywordUrl,
		defaults: { 
			data:{ pclass:'', pmodel:'', ptype:'', txt:''}
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
		}
		//parse: function(response, options) {
			//response = fetch抓取到的信息 options = {"data":"page=1","parse":true,"emulateHTTP":false,"emulateJSON":false,"xhr":{"readyState":4,"responseText":"[{\"title\":\"无障碍网页应用\"},{\"title\":\"利用状态模式处理多个模态弹出层的显示隐藏\"}]","status":200,"statusText":"OK"}}
			
			//alert(JSON.stringify(response));
		//}
	});
	return list;
});