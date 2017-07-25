describe('menuModel', function() {
	beforeEach(function() {
		var that = this, done = false;
		require(['model/menu'], function(menu) {
			that.menuModel = new menu();
			done = true;
		});
		//等待初始化完成
		waitsFor(function() {
			  return done;
		}, "init");
	});

	afterEach(function() {
		
	});

	describe('validateOrder', function() {
	    it("测试数字", function() {
	    	var actual = this.menuModel.validateOrder({order:1});
			expect(actual).toBe(false);
			var actual = this.menuModel.validateOrder({order:-1});
			expect(actual).toBe('请输入数字');
			var actual = this.menuModel.validateOrder({order:'1'});
			expect(actual).toBe(false);
			var actual = this.menuModel.validateOrder({order:'01'});
			expect(actual).toBe(false);
			var actual = this.menuModel.validateOrder({order:''});
			expect(actual).toBe('请输入数字');
			var actual = this.menuModel.validateOrder({order:null});
			expect(actual).toBe('请输入数字');
			var actual = this.menuModel.validateOrder({order:undefined});
			expect(actual).toBe('请输入数字');
	    });
	});
});