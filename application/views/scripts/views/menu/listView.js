define([
	'jquery',
	'backbone',
	'constUtil'
], function ($, Backbone, constUtil) {
	var menu = Backbone.View.extend({
		initialize: function() {
			//console.log(123)
		},
		setListDelete: function() {
			var _this = this;
			//属性查找不太方便 还是使用绑定来做
			$('.tablesorter').delegate('a[name=del]', 'click', function() {
				if(!confirm('您确定要删除该菜单吗？')) {
					return false;
				}
				var input = {eid:$(this).attr('eid'), type:'delete'};
				_this.model.post(this, input,  _this.show);
				return false;
			});
		},
		setListOrder: function() {
			var _this = this;
			//属性查找不太方便 还是使用绑定来做
			$('a[name=btn_order]').bind('click', function() {
				var orders = [];
				$('.tablesorter>tbody tr td>input[type=text]').each(function() {
					orders.push({order:$(this).val(), eid:$(this).attr('eid')});
				});
				
				var input = {orders:orders, type:'order'};//将所有的排序数据传过去
				_this.model.post(this, input, _this.show);
				return false;
			});
		},
		show: function(data, con) {//返回后执行的函数
			if(con.isJsonSuccess(data)) {
				$('#perror').removeClass().addClass('alert_success').html(data.msg);
				//con.setReloadTimeout();
			}else {
				$('#perror').removeClass().addClass('alert_error').html(data.msg);
			}
		},
		setAddMenu: function() {//添加菜单
			var _this = this;
			$('#btnAdd').bind('click', function() {
			});
		}
	});
	return menu;
});