var ITEMS_IN_MYBOARD = 1;
var ITEMS_IN_STARBOARD = 2;
var ITEMS_IN_PAGINATOR = 3;


function hideBlock(blockId)
{
    $('#' + blockId + ' .show-all').show();
    $('#' + blockId + ' .hide-all').hide();
}

function initToggle(blockId, maxCount){
	$('#' + blockId + ' .item').hide();
	var count = $('#' + blockId + ' .item').length;
	if (count > maxCount)
	{ 
		$('#' + blockId + ' .show-all a').click(function(){
			$('#' + blockId + ' .item').show();
			$('#' + blockId + ' .show-all').hide();
			$('#' + blockId + ' .hide-all').show();
			return false;
		});
		$('#' + blockId + ' .hide-all a').click(function(){
			$('#' + blockId + ' .item').slice(0, maxCount).show();
			$('#' + blockId + ' .item').slice(maxCount).hide();
			$('#' + blockId + ' .hide-all').hide();
			$('#' + blockId + ' .show-all').show();
			return false;
		});
	}
	
    var items = $('#' + blockId + ' .item');
	$('#' + blockId + ' .hide-all').hide();
	
	if(items.length > maxCount)
    	$('#' + blockId + ' .show-all').show();
	$('#' + blockId + ' .item').slice(0, maxCount).show();
}

function initRubricator(){
	$('.category li, .category .switch-show, .category .switch-hide').hide();
	$('.category').each(function(){
		$(this).find('li').slice(0, ITEMS_IN_PAGINATOR).show();	
		if($(this).find('li').size() > ITEMS_IN_PAGINATOR)
			$(this).find('.switch-show').show();
		var category = this;
		$(category).find('li:visible:last').addClass('last');
		$(this).find('.switch-show').click(function(){
			$(category).find('.switch-show').hide();
			$(category).find('.switch-hide').css('display','block');
			$(category).find('li').show();
			$(category).find('li:visible:last').addClass('last');
			return false;		
		});	
		$(this).find('.switch-hide').click(function(){
			$(category).find('.switch-hide').hide();
			$(category).find('.switch-show').css('display','block');
			$(category).find('li').slice(ITEMS_IN_PAGINATOR).hide();
			$(category).find('li:visible:last').addClass('last');
			return false;		
		});	
	});
}  


$(document).ready(function()
{
    initToggle("star-board", ITEMS_IN_STARBOARD);
    initToggle("my-board", ITEMS_IN_MYBOARD);
	initRubricator();
});
