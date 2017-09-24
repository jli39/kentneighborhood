define(['jquery', 'spin'], function($, Spinner) {
	var constUtil = {
		domain : 'http://' + window.location.host + '/',
		lastUrl : 'last_url',
		//webDomain : 'http://' + window.location.host + '/',
		resultSuccess: 0,
		resultFailure: 1,
		ajaxMenu : 'admin/ajax/operate.php',
		template : 'templates/',
		absUrl : function(url) { //绝对URL
			return this.domain + url;
		},
		isJsonSuccess: function(json) {
			return +json.result === this.resultSuccess && json.result !== null;//类型转换做判断
		},
		isJsonFailure: function(json) {
			return +json.result === this.resultFailure;
		},
		isRelogin: function(json) {
			return json.code === this.apiCodeKeyRelogin;
		},
		redirectLogin: function() {
			location.href = this.absUrl(this.webUserLogin);
		},
		redirectLastUrl: function() {
			var url = $.cookie(this.lastUrl);
			url = !url ? this.domain : url;
			location.href = url;
		},
		evalStrJson: function(json) { //str转换为json
			if(!json) return {};
			var data = (0,eval)('(' + json + ')');
			return data;
		},
		setReloadTimeout: function(millisec, url) { //等待几秒后刷新页面
			var hasInput = !!millisec;
			setTimeout(function() {
				if(!url) {location.reload();}else{location.href = url;}
			}, hasInput ? millisec : 1000);
		},
		setMyTimeout: function(millisec, fun, context) { //等待几秒后执行函数
			var hasInput = !!millisec;
			var args = [].slice.call(arguments, 3);
			setTimeout(function() {
				if(typeof fun == 'function') {
					fun.apply(context, args);
				}
			}, hasInput ? millisec : 1000);
		},
		showJsonPrompt: function(json, fn, context) {//通用JSON返回格式操作
			//移除ajax遮罩层
			this.stopAjaxLoading();
			var data;
			if(!json) {
				//返回空字符串的情况 返回空格式
				data = {"msg":"","code":"","result":1};
			}else
				data = (0,eval)('(' + json + ')');
			var params = [data];
			return function() {
				//console.log(123);
				params = params.concat([].slice.call(arguments, 0));
				// if(+data.result === constUtil.resultSuccess && !!fnSuccess) {
					// fnSuccess.apply(context, params);
				// }
				// if(+data.result === constUtil.resultFailure && !!fnFailure) {
					// fnSuccess.apply(context, params);
				// }
				if(fn) {
					fn.apply(context, params);
				}
			};
		},
		showAjaxLoading: function(btn) {
			var left = $(btn).offset().left;
			var top = $(btn).offset().top;
			var width = $(btn).width();
			var height = $(btn).height();
			var opts = {
				  lines: 9, // The number of lines to draw
				  length: 0, // The length of each line
				  width: 10, // The line thickness
				  radius: 15, // The radius of the inner circle
				  corners: 1, // Corner roundness (0..1)
				  rotate: 0, // The rotation offset
				  direction: 1, // 1: clockwise, -1: counterclockwise
				  color: '#000', // #rgb or #rrggbb or array of colors
				  speed: 1, // Rounds per second
				  trail: 81, // Afterglow percentage
				  shadow: false, // Whether to render a shadow
				  hwaccel: false, // Whether to use hardware acceleration
				  className: 'spinner', // The CSS class to assign to the spinner
				  zIndex: 2e9, // The z-index (defaults to 2000000000)
				  top: '50%', // Top position relative to parent
				  left: '50%' // Left position relative to parent
			};
			$('#ajax_spin').remove();
			$('body').append('<div id="ajax_spin" style="position:absolute;background:#FFF;filter:alpha(opacity=30);opacity:0.3"><div id="ajax_spin_inner" style="position:relative;height:50px;"></div></div>');
			$('#ajax_spin').css({'top':top, 'left': left, 'width': width, 'height':height});
			var target = document.getElementById('ajax_spin_inner');  
			var spinner = new Spinner(opts).spin(target);
			//return spinner;
		},
		stopAjaxLoading: function() {
			$('#ajax_spin').remove();
			//new Spinner(opts).spin(target)
			//spinner.stop();
		},
		showValidateHtmlPrompt: function(id, msg) {//通用的HTML错误提示
			if(msg) {
				$('#' + id).html(msg);
				return false;
			}
			return true;
		}
	};
	return constUtil;
});