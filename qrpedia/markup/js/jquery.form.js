(function($){
	$(function(){
		$('select').customSelect();
	})
	/*------------------------ CUSTOM SELECT'S -----------------------------*/
	$.fn.customSelect = function(_options) {
	var _options = $.extend({
		selectStructure: '<div class="selectArea"><div class="selectLeft"></div><a href="#" class="selectButton">&nbsp;</a><div class="selectCenter"></div><div class="disabled"></div></div>',
		selectText: '.selectCenter',
		selectBtn: '.selectButton',
		selectDisabled: '.disabled',
		optStructure: '<div class="selectOptions"><ul></ul></div>',
		optList: 'ul',
		additionalWidth:20,
		maxDropHeight: 110
	}, _options);
	return this.each(function() {
		var select = $(this);
		if(!select.hasClass('outtaHere')) {
			var replaced = $(_options.selectStructure);
			var selectText = replaced.find(_options.selectText);
			var selectBtn = replaced.find(_options.selectBtn);
			var selectDisabled = replaced.find(_options.selectDisabled).hide();
			var optHolder = $(_options.optStructure);
			var optList = optHolder.find(_options.optList);
			if(select.attr('disabled')) selectDisabled.show();
			select.find('option').each(function(index) {
				var selOpt = $(this);
				var _opt = $('<li><a href="#">' + selOpt.html() + '</a></li>');
				if(selOpt.attr('selected')) {
					selectText.html(selOpt.html());
					_opt.addClass('selected');
				}
				_opt.children('a').click(function() {
					select.get(0).selectedIndex = index;
					optList.find('li').removeClass('selected');
					$(this).parent().addClass('selected');
					selectText.html(selOpt.html());
					select.change();
					optHolder.hide();
					return false;
				});
				optList.append(_opt);
			});
			replaced.width(select.outerWidth()+_options.additionalWidth);
			replaced.insertBefore(select);
			var _class = select.attr('class');
			replaced.addClass(_class);
				optHolder.css({
					width: select.outerWidth(),
					display: 'none',
					position: 'absolute'
				});
			if (_class) optHolder.addClass('drop-'+_class);
			$(document.body).append(optHolder);
			
			var optTimer;
			replaced.hover(function() {
				if(optTimer) clearTimeout(optTimer);
			}, function() {
				optTimer = setTimeout(function() {
					optHolder.hide();
				}, 200);
			});
			optHolder.hover(function(){
				if(optTimer) clearTimeout(optTimer);
			}, function() {
				optTimer = setTimeout(function() {
					optHolder.hide();
				}, 200);
			});
			
			var charArr = [], _pressTimer = false;
			$(window).keypress(function(e){
				if (_pressTimer) clearTimeout(_pressTimer);
				if (optHolder.is(':visible')) {
					charArr.push(String.fromCharCode(e.charCode))
					_pressTimer = setTimeout(function(){
						var _text = charArr.join('');
						if (optHolder.hasScrollBar()) {
							scrollToOpt(_text, optHolder);
						}
						if (optHolder.find('ul').hasScrollBar()) {
							scrollToOpt(_text, optHolder.find('ul'));
						}
						charArr = [];
					},400);
				}
			});
			function scrollToSelected (){
				var _text = optHolder.find('li.selected').text();
				if (optHolder.hasScrollBar()) {
					scrollToOpt(_text, optHolder);
				}
				if (optHolder.find('ul').hasScrollBar()) {
					scrollToOpt(_text, optHolder.find('ul'));
				}
			}
			function scrollToOpt(_text, $obj){
				_text = _text.toLowerCase();
				$obj.find('li').each(function(){
					var _thisText = $(this).text();
					if (_thisText.toLowerCase().indexOf(_text) == 0) {
						$obj.scrollTop($(this).position().top);
					}
				});
			}
			
			replaced.click(function() {
				if(optHolder.is(':visible')) {
					optHolder.hide();
				}
				else{
					optHolder.children('ul').css({height:'auto', overflow:'hidden'});
					optHolder.css({
						top: replaced.offset().top + replaced.outerHeight(),
						left: replaced.offset().left,
						display: 'block'
					});
					if(optHolder.children('ul').height() > _options.maxDropHeight) optHolder.children('ul').css({height:_options.maxDropHeight, overflow:'auto'});
					scrollToSelected();
				}
				return false;
			});
			select.addClass('outtaHere');
		}
	});
	}
	$.fn.hasScrollBar = function() {
		return this.get(0).scrollHeight > this.height();
	}
	
})(jQuery);
/**
 * --------------------------------------------------------------------
 * jQuery customfileinput plugin
 * Author: Scott Jehl, scott@filamentgroup.com
 * Copyright (c) 2009 Filament Group 
 * licensed under MIT (filamentgroup.com/examples/mit-license.txt)
 * --------------------------------------------------------------------
 */
$(function(){
	$('input:file').customFileInput();
});
$.fn.customFileInput = function(){
	//apply events and styles for file input element
	return $(this).each(function(i){
		var fileInput = $(this)
			.addClass('customfile-input') //add class for CSS
			.css({
				'opacity': 0,
				'position': 'absolute'
			})
			.mouseover(function(){ upload.addClass('customfile-hover'); })
			.mouseout(function(){ upload.removeClass('customfile-hover'); })
			.focus(function(){
				upload.addClass('customfile-focus'); 
				fileInput.data('val', fileInput.val());
			})
			.blur(function(){ 
				upload.removeClass('customfile-focus');
				$(this).trigger('checkChange');
			 })
			.bind('disable',function(){
				fileInput.attr('disabled',true);
				upload.addClass('customfile-disabled');
			})
			.bind('enable',function(){
				fileInput.removeAttr('disabled');
				upload.removeClass('customfile-disabled');
			})
			.bind('checkChange', function(){
				if(fileInput.val() && fileInput.val() != fileInput.data('val')){
					fileInput.trigger('change');
				}
			})
			.bind('change',function(){
				//get file name
				var fileName = $(this).val().split(/\\/).pop();
				//get file extension
				var fileExt = 'customfile-ext-' + fileName.split('.').pop().toLowerCase();
				//update the feedback
				uploadFeedback
					.text(fileName) //set feedback text to filename
					.removeClass(uploadFeedback.data('fileExt') || '') //remove any existing file extension class
					.addClass(fileExt) //add file extension class
					.data('fileExt', fileExt) //store file extension for class removal on next change
					.addClass('customfile-feedback-populated'); //add class to show populated state
				//change text of button	
				//uploadButton.text('Выбрать другой');	
			})
			.click(function(){ //for IE and Opera, make sure change fires after choosing a file, using an async callback
				fileInput.data('val', fileInput.val());
				setTimeout(function(){
					fileInput.trigger('checkChange');
				},100);
			});
			
		//create custom control container
		var upload = $('<div class="customfile"></div>').addClass('input-file-'+i);
		//create custom control button
		var _title = 'Выбрать';
		if (fileInput.attr('title')) _title = fileInput.attr('title');
		var uploadButton = $('<span class="customfile-button" aria-hidden="true">'+_title+'</span>').appendTo(upload);
		var uploadFeedback = $('<span class="customfile-feedback" aria-hidden="true">&nbsp;</span>').appendTo(upload);
		
		//match disabled state
		if(fileInput.is('[disabled]')){
			fileInput.trigger('disable');
		}
			
		
		//on mousemove, keep file input under the cursor to steal click
		upload
			.mousemove(function(e){
				fileInput.css({
					'left': e.pageX - upload.offset().left - fileInput.outerWidth() + 20, //position right side 20px right of cursor X)
					'top': e.pageY - upload.offset().top - 10
				});	
			})
			.insertAfter(fileInput); //insert after the input
		
		fileInput.appendTo(upload);
			
		//return jQuery
	});	
};