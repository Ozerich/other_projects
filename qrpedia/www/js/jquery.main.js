(function($){
	$(function(){


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
})}(jQuery));

