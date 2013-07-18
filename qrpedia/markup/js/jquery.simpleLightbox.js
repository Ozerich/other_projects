// simpleLightbox version = 2.1.1
(function($, window, document, undefined){
	$.fn.simpleLightbox = function(_options){
		// defaults options	
		var _options = $.extend({
			faderOpacity    : 0.7,
			duration        : 300,
			faderBackground : '#000',
			closeLink       : 'a.close',
			pngIE           : false,
			structure       : '<div class="popup"><div class="appendcontent"></div></div>',
			appendSelector  : '.appendcontent',
			useStructure    : false,
			ajaxSuccess     : null,
			ajaxFilter      : null,
			fnBeforeOpen    : null,
			fnAfterOpen     : null,
			fnBeforeClose   : null,
			fnAfterClose    : null
		},_options);
		
		if (!$(this).length) return false;
		
		var _fader = $('div.lightbox-fader');
		if (!_fader.length) {
			_fader = $('<div class="lightbox-fader"><span class="loader">&nbsp;</span></div>');
			$('body').append(_fader);
			
			_fader.css({
				opacity:_options.faderOpacity,
				backgroundColor:_options.faderBackground,
				position:'absolute',
				top:0,
				left:0,
				zIndex:998,
				width:'100%'
			}).hide();
		}
		var $loader = $('div.lightbox-fader .loader').hide();
		
		var _ie = _options.pngIE && $.browser.msie && $.browser.version > 6;
		if (_ie) _options.duration = 0;
		
		function preloadImage(_imgArray, callbackFn){
			var _imgSumm = _imgArray.length, _loadImg = 0, _image = [];
			_preloadTimer = setTimeout(function(){
				callbackFn(_imgArray, false);
			}, 6000);
			for (var i = 0; i < _imgSumm; i++) {
				_image[i] = new Image();
				_image[i].src = _imgArray[i].src;
				if (_image[i].complete) {
					_loadImg++;
					if (_loadImg >= _imgSumm && typeof callbackFn == 'function') {
						if (_preloadTimer) clearTimeout(_preloadTimer);
						callbackFn(_imgArray, true);
					}
				} else {
					_image[i].onload = function(){
						_loadImg++;
						if (_loadImg >= _imgSumm && typeof callbackFn == 'function') {
							if (_preloadTimer) clearTimeout(_preloadTimer);
							callbackFn(_imgArray, true);
						}
					}
				}
			}
		}
		
		if (_options.useStructure) {
			var _lb = $(_options.structure).appendTo('body');
		}
		
		return this.each(function(i){
			var _this = $(this), _thisNative = this, _firstOpen = false;
			_this.hrefObj = _this.attr('href');
			if (_options.useStructure) {
				_lightbox = _lb;
				_this.click(function(){
					_this.trigger('ajax');
					$.ajax({
						url:$(this).attr('href'),
						dataType: 'html',
						success: function(data){
							if ($.isFunction(_options.ajaxFilter)) {
								var _returnData = _options.ajaxFilter.apply(_thisNative, [data]);
								if (_returnData != undefined) data = _returnData;
							}
							_lightbox.find(_options.appendSelector).html(data);
							if (_lightbox.find('img').length) {
								preloadImage(_lightbox.find('img').get(), ajaxOpen);
							} else {
								ajaxOpen();
							}
						}
					});
					return false;
				});
				function ajaxOpen(){
					_this.trigger('open');
					if ($.isFunction(_options.ajaxSuccess)) {
						var _returnObj = _options.ajaxSuccess.apply(_thisNative, [_lightbox]);
						if (_returnObj != undefined) return _returnObj;
					}
				}
			} else if (!_this.is('a')) {
				_lightbox = _this;
			} else if (_this.hrefObj.indexOf('#') != -1 && _this.hrefObj.length > 1) {
				var _lightbox = $(_this.hrefObj);
				_this.click(function(){
					_this.trigger('open');
					return false;
				});
			}
			_lightbox.addClass('simpleLightbox').css({
				'zIndex':999,
				'position':'absolute',
				'top':-9999,
				'left':-9999
			});
			var _lbSelect = $('select',_lightbox),
				_sl = $('select').not(_lbSelect);
				
			_this.on('ajax', function(){
				var _existLb = $('.simpleLightbox:visible');
				if (_existLb.length && _firstOpen) {
					_existLb.fadeOut(_options.duration);
				} else {
					$loader.show();
					_fader.fadeIn(_options.duration);
				}
				_fader.addClass('loading');
			});
				
			_this.on('open', function(){
				$loader.hide();
				_firstOpen = true;
				if ($.isFunction(_options.fnBeforeOpen)) {
					var _returnObj = _options.fnBeforeOpen.apply(_thisNative, [_lightbox]);
					if (_returnObj != undefined) return _returnObj;
				}
				if (_ie) _sl.css('visibility','hidden');
				var _existLb = $('.simpleLightbox:visible').not(_lightbox);
				if (_existLb.length) {
					_existLb.fadeOut(_options.duration, showLb);
				} else if (_fader.is(':visible')) {
					showLb();
				} else {
					_fader.fadeIn(_options.duration, showLb);
				}
				_fader.removeClass('loading');
				
				function showLb(){
					_lightbox.fadeIn(_options.duration, function(){
						if ($.isFunction(_options.fnAfterOpen)) {
							var _returnObj = _options.fnAfterOpen.apply(_thisNative, [_lightbox]);
							if (_returnObj != undefined) return _returnObj;
						}
					});
					_thisNative.positionLightbox(_lightbox, _fader);
				}
			});
			_this.on('close', function(){
				if ($.isFunction(_options.fnBeforeClose)) {
					var _returnObj = _options.fnBeforeClose.apply(_thisNative, [_lightbox]);
					if (_returnObj != undefined) return _returnObj;
				}
				_lightbox.fadeOut(_options.duration, function(){
					_fader.fadeOut(_options.duration, function(){
						if ($.browser.msie) _sl.css('visibility','visible');
						if ($.isFunction(_options.fnAfterClose)) {
							var _returnObj = _options.fnAfterClose.apply(_thisNative, [_lightbox]);
							if (_returnObj != undefined) return _returnObj;
						}
					});
				});
			});
			_fader.click(function(){
				_this.trigger('close');
				return false;
			});
			$(_options.closeLink, _lightbox).click(function(){
				_this.trigger('close');
				return false;
			});
			
			var _scroll = false, _container = $(_options.pageContainer);
			_thisNative.positionLightbox = function(_lbox, _f) {
				var _height = 0, _width = 0;
				if (window.innerHeight) {_height = window.innerHeight;_width = window.innerWidth;}
				else {_height = document.documentElement.clientHeight;_width = document.documentElement.clientWidth;}
				var	_thisHeight = _lbox.outerHeight(),
					_thisWidth = _lbox.outerWidth(),
					_docHeight = $(document).height(),
					_docWidth = $(document).width();
				if (_lbox.length) {
					if (_width > _docWidth) _docWidth = '100%';
					_f.css({
						'width':_docWidth,
						'height':_docHeight
					});
					if (_height > _thisHeight) {
						_lbox.css({
							position:'fixed',
							top: ((_height - _lbox.outerHeight()) / 2)
						});
						_scroll = false;
					} else {
						if (!_scroll) {
							if (_docHeight - _thisHeight > parseInt($(document).scrollTop())) {
								_scroll = parseInt($(document).scrollTop());
							} else {
								_scroll = _docHeight - _thisHeight;
							}
						}
						_lbox.css({
							position:'absolute',
							top: _scroll
						});
					}
					if (_width > _thisWidth) _lbox.css({left:(_width - _thisWidth)/2});
					else _lbox.css({position:'absolute',left: 0});
				}
			}
			setTimeout(function(){
				_lightbox.hide();
				_thisNative.positionLightbox(_lightbox, _fader)
				_firstOpen = true;
			}, 500);
			$(window).resize(function(){
				if (_lightbox.is(':visible') && _firstOpen) _thisNative.positionLightbox(_lightbox, _fader);
			});
			$(window).scroll(function(){
				if (_lightbox.is(':visible') && _firstOpen) _thisNative.positionLightbox(_lightbox, _fader);
			});
			$(document).keydown(function (e) {
				if (!e) e = window.event;
				if (e.keyCode == 27) _this.trigger('close');
			});
		});
	}
})(jQuery, window, document);