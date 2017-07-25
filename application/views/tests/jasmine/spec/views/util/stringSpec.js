describe('stringView', function() {
	beforeEach(function() {
		var that = this, done = false;
		require(['stringUtil', 'jqueryCookie'], function(String) {
			that.String = String;
			done = true;
		});
		//等待初始化完成
		waitsFor(function() {
			  return done;
		}, "Create Models");
	});

	afterEach(function() {
		
	});
	
	describe('字符串格式化', function() {
	    it('string', function() {
			var str = "my name is {0}";
	    	var actual = this.String.format(str, 'ada');
			expect(actual).toEqual("my name is ada");
	    });
		it('html', function() {
			var str = "my name is {0}";
	    	var actual = this.String.format(str, '<div>123</div>');
			expect(actual).toEqual("my name is <div>123</div>");
	    });
		it('two string', function() {
			var str = "my name is '{0} {1}'";
	    	var actual = this.String.format(str, 'ada', 'alax');
			expect(actual).toEqual("my name is 'ada alax'");
	    });
		it('undefined', function() {
			var str = "my name is '{0}'";
	    	var actual = this.String.format(str, undefined);
			expect(actual).toEqual("my name is 'undefined'");
	    });
		it('null', function() {
			var str = "my name is '{0}'";
	    	var actual = this.String.format(str, null);
			expect(actual).toEqual("my name is 'null'");
	    });
		it('true', function() {
			var str = "my name is '{0}'";
	    	var actual = this.String.format(str, true);
			expect(actual).toEqual("my name is 'true'");
	    });
	});
	describe('字符串分割', function() {
		it('split', function() {
			var str = "周边 长途 户外";
	    	var actuals = str.split(" ");
			expect(actuals.join(",")).toEqual("周边,长途,户外");
			
			var str = "周边  长途 户外";
			var actuals = str.split(" ");
			expect(actuals.join(",")).toEqual("周边,,长途,户外");
			
			var str = "周边  长途 户外";
			var actuals = str.split(" ");
			actuals = _.filter(actuals, function(tag){ return !!tag; });
			expect(actuals.join(",")).toEqual("周边,长途,户外");
			
			expect(!'').toBe(true);
			expect(!"").toBe(true);
			expect(!0).toBe(true);
			expect(!+'0').toBe(true);
			expect(!null).toBe(true);
			expect(!undefined).toBe(true);
			expect(!{}).toBe(false);
			expect(![]).toBe(false);
			expect(!'0').toBe(false);
			expect(!' ').toBe(false);
			
			expect(+'').toBe(0);
			expect(+null).toBe(0);
			//expect(+undefined).toBe(0);
			expect(+'2').toBe(2);
			expect(!-1).toBe(false);
	    });
	});
	describe('cookie', function() {
		it('空cookie', function() {
			//console.log($.cookie('123'));
			var cook = $.cookie('123');
			expect(!cook).toBe(true);
		});
	});
	
	describe('字符串长度', function() {
		it('length', function() {
			//console.log($.cookie('123'));
			var str = '最多能';
			expect(str.length).toBe(3);
		});
	});
});