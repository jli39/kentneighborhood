define([
	'jquery'
], function ($) {
	var shortcut = {
		allNeed: function() {//都需要的方法
			this.equalHeight();
			this.showChildren();
			this.setSlide();
		},
		equalHeight: function(target) {
			// find the tallest height in the collection
			// that was passed in (.column)
			target = target || $('.column');
            tallest = 0;
            target.each(function(){
                thisHeight = $(this).height();
				//get padding
				//bottom = $(this).css('paddingBottom');
				//bottom = parseInt($(this).css('paddingBottom'), 10)
                if( thisHeight > tallest)
                    tallest = thisHeight + 40;
            });

            // set each items height to use the tallest value found
            target.each(function(){
                $(this).height(tallest);
            });
		},
		showChildren: function() {
			$('#sidebar .toggle').delegate('li', 'mouseenter', function() {
				$(this).addClass('active').children('menu').show();
			}).delegate('li', 'mouseleave', function() {
				$(this).removeClass('active').children('menu').hide();
			}).delegate('li', 'click', function() {
				location.href = $(this).children('a').attr('href');
			});
		},
		setSlide: function() {
			// choose text for the show/hide link - can contain HTML (e.g. an image)
			var showText='Show';
			var hideText='Hide';

			// initialise the visibility check
			var is_visible = false;

			// append show/hide links to the element directly preceding the element with a class of "toggle"
			$('.toggle').prev().append(' <a href="#" class="toggleLink">'+hideText+'</a>');

			// hide all of the elements with a class of 'toggle'
			$('.toggle').show();

			// capture clicks on the toggle links
			$('a.toggleLink').click(function() {

				// switch visibility
				is_visible = !is_visible;

				// change the link text depending on whether the element is shown or hidden
				if ($(this).text()==showText) {
				$(this).text(hideText);
				$(this).parent().next('.toggle').slideDown('slow');
				}
				else {
				$(this).text(showText);
				$(this).parent().next('.toggle').slideUp('slow');
				}

				// return false so any link destination is not followed
				return false;
			});
		}
	};
	return shortcut;
});