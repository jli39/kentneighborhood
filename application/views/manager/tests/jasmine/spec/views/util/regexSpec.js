describe('regexView', function() {
	beforeEach(function() {
		var that = this, done = false;
		require(['regexUtil'], function(regexUtil) {
			that.regexUtil = regexUtil;
			done = true;
		});
		//等待初始化完成
		waitsFor(function() {
			  return done;
		}, "");
	});

	afterEach(function() {
		
	});
	
	describe('邮箱验证', function() {
	    it('ds@sa.com', function() {
			var str = "ds@qq.com";
	    	var actual = this.regexUtil.checkEmail(str);
			expect(actual).toBe(true);
	    });
		it('ds@sa.tcp', function() {
			var str = "ds@qq.tcp";
	    	var actual = this.regexUtil.checkEmail(str);
			expect(actual).toBe(true);
	    });
		it('dssa.tcp', function() {
			var str = "dssa.tcp";
	    	var actual = this.regexUtil.checkEmail(str);
			expect(actual).toBe(false);
	    });
	});
	describe('数字验证', function() {
		it('2', function() {
			var str = "2";
	    	var actual = this.regexUtil.checkNum(str);
			expect(actual).toBe(true);
	    });
	    it('123', function() {
			var str = "123";
	    	var actual = this.regexUtil.checkNum(str);
			expect(actual).toBe(true);
	    });
		it('12x3', function() {
			var str = "12x3";
	    	var actual = this.regexUtil.checkNum(str);
			expect(actual).toBe(false);
	    });
	});
	describe('身份证验证', function() {
	    it('310227198810093617', function() {
			var str = "310227198810093617";
	    	var actual = this.regexUtil.checkCardNo(str);
			expect(actual).toBe(true);;
	    });
		it('310227198810093', function() {
			var str = "310227198810093";
	    	var actual = this.regexUtil.checkCardNo(str);
			expect(actual).toBe(false);
	    });
	});
});