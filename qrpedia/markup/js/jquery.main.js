(function($){
	$(function(){
		if (typeof $().simpleLightbox == 'function') {
			$('a.button-new, a.name').simpleLightbox({
				faderOpacity    : 0.1,
				duration        : 200,
				faderBackground : '#fff',
				closeLink       : 'a.close, a.close-btn'
			});
			$('a.but').simpleLightbox({
				duration        : 200,
				faderBackground : '#fff',
				closeLink       : 'a.close, a.close-btn',
				fnBeforeClose   : function(){
					$('a.button-new').trigger('open');
					return false;
				}
			});
			window.saveFn = function(){
				alert('ваше событие, после чего открывается попап');
				$('a.button-new').trigger('open');
				return false;
			}
		}
		
	$('textarea, input:text, input:password').bind('focus click', function(){
		 if (this.value == this.defaultValue) {
		  this.value = '';
		 }
		}).bind('blur', function(){
		 if (this.value == '') {
		  this.value = this.defaultValue;
		 }
		});
		
		simpleTab();
	});

	function simpleTab() {
		$('ul.tabset').each(function(i, tabset){
			var _tabLinks = $('a',tabset), _active;
			if (!_tabLinks.parent().hasClass('active')) _tabLinks.eq(0).parent().addClass('active');
			_tabLinks.each(function(j, link){
				var _id = $(link.href.substr(link.href.indexOf('#')));
				if ($(link).parent().hasClass('active')){_id.show();_active = _id;}
				else _id.hide();
				
				$(link).click(function(){
					if (!$(this).parent().hasClass('active')) {
						_tabLinks.parent().removeClass('active');
						$(link).parent().addClass('active');
						_active.hide();
						_id.show();
						_active = _id;
					}
					return false;
				})
			});
		});
	}
})(jQuery);

