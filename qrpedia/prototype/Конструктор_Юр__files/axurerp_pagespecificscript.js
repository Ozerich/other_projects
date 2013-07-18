for(var i = 0; i < 127; i++) { var scriptId = 'u' + i; window[scriptId] = document.getElementById(scriptId); }

$axure.eventManager.pageLoad(
function (e) {

});

$axure.eventManager.change('u21', function(e) {

if ((GetSelectedOption('u21')) == ('Визитка компании')) {

	SetPanelVisibility('u23','','none',500);

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u65','hidden','none',500);

	SetPanelVisibility('u80','hidden','none',500);

}
else
if ((GetSelectedOption('u21')) == ('Расширенная визитка компании')) {

	SetPanelVisibility('u43','','none',500);

	SetPanelVisibility('u23','hidden','none',500);

	SetPanelVisibility('u65','hidden','none',500);

	SetPanelVisibility('u80','hidden','none',500);

}
else
if ((GetSelectedOption('u21')) == ('Базовая страница')) {

	SetPanelVisibility('u65','','none',500);

	SetPanelVisibility('u23','hidden','none',500);

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u80','hidden','none',500);

}
else
if ((GetSelectedOption('u21')) == ('Произвольная страница')) {

	SetPanelVisibility('u80','','none',500);

	SetPanelVisibility('u23','hidden','none',500);

	SetPanelVisibility('u43','hidden','none',500);

	SetPanelVisibility('u65','hidden','none',500);

}
});
gv_vAlignTable['u51'] = 'top';gv_vAlignTable['u102'] = 'center';gv_vAlignTable['u31'] = 'top';gv_vAlignTable['u32'] = 'top';gv_vAlignTable['u62'] = 'top';gv_vAlignTable['u53'] = 'top';gv_vAlignTable['u87'] = 'top';gv_vAlignTable['u1'] = 'center';gv_vAlignTable['u119'] = 'top';gv_vAlignTable['u7'] = 'center';
u115.style.cursor = 'pointer';
$axure.eventManager.click('u115', function(e) {

if (true) {

	SetPanelVisibility('u116','','none',500);

}
});
gv_vAlignTable['u104'] = 'center';gv_vAlignTable['u30'] = 'top';gv_vAlignTable['u122'] = 'top';gv_vAlignTable['u34'] = 'top';gv_vAlignTable['u64'] = 'top';gv_vAlignTable['u100'] = 'center';document.getElementById('u19_img').tabIndex = 0;

u19.style.cursor = 'pointer';
$axure.eventManager.click('u19', function(e) {

if (true) {

	self.location.href=$axure.globalVariableProvider.getLinkUrl('Платежи_и_документы_1.html');

}
});
gv_vAlignTable['u49'] = 'top';document.getElementById('u103_img').tabIndex = 0;

u103.style.cursor = 'pointer';
$axure.eventManager.click('u103', function(e) {

if (true) {

	SetPanelVisibility('u112','','none',500);

}
});

$axure.eventManager.mouseover('u103', function(e) {
if (!IsTrueMouseOver('u103',e)) return;
if (true) {

	SetPanelVisibility('u105','','none',500);

}
});

$axure.eventManager.mouseout('u103', function(e) {
if (!IsTrueMouseOut('u103',e)) return;
if (true) {

	SetPanelVisibility('u105','hidden','none',500);

	SetPanelVisibility('u112','hidden','none',500);

}
});
gv_vAlignTable['u79'] = 'top';gv_vAlignTable['u118'] = 'center';gv_vAlignTable['u85'] = 'top';gv_vAlignTable['u41'] = 'center';gv_vAlignTable['u108'] = 'top';gv_vAlignTable['u71'] = 'top';gv_vAlignTable['u15'] = 'top';gv_vAlignTable['u36'] = 'top';gv_vAlignTable['u126'] = 'top';gv_vAlignTable['u92'] = 'top';gv_vAlignTable['u83'] = 'top';gv_vAlignTable['u22'] = 'top';gv_vAlignTable['u13'] = 'top';gv_vAlignTable['u52'] = 'top';gv_vAlignTable['u3'] = 'center';gv_vAlignTable['u84'] = 'top';gv_vAlignTable['u20'] = 'center';gv_vAlignTable['u50'] = 'top';gv_vAlignTable['u106'] = 'top';gv_vAlignTable['u54'] = 'top';document.getElementById('u99_img').tabIndex = 0;

u99.style.cursor = 'pointer';
$axure.eventManager.click('u99', function(e) {

if (true) {

	SetPanelVisibility('u112','','none',500);

}
});

$axure.eventManager.mouseover('u99', function(e) {
if (!IsTrueMouseOver('u99',e)) return;
if (true) {

	SetPanelVisibility('u107','','none',500);

}
});

$axure.eventManager.mouseout('u99', function(e) {
if (!IsTrueMouseOut('u99',e)) return;
if (true) {

	SetPanelVisibility('u107','hidden','none',500);

	SetPanelVisibility('u112','hidden','none',500);

}
});
gv_vAlignTable['u69'] = 'top';gv_vAlignTable['u78'] = 'center';gv_vAlignTable['u120'] = 'top';gv_vAlignTable['u114'] = 'center';gv_vAlignTable['u94'] = 'center';document.getElementById('u6_img').tabIndex = 0;

u6.style.cursor = 'pointer';
$axure.eventManager.click('u6', function(e) {

if (true) {

	self.location.href=$axure.globalVariableProvider.getLinkUrl('Личные_данные.html');

}
});
gv_vAlignTable['u96'] = 'top';gv_vAlignTable['u61'] = 'center';gv_vAlignTable['u91'] = 'center';gv_vAlignTable['u56'] = 'top';gv_vAlignTable['u123'] = 'top';gv_vAlignTable['u5'] = 'center';gv_vAlignTable['u12'] = 'center';document.getElementById('u9_img').tabIndex = 0;

u9.style.cursor = 'pointer';
$axure.eventManager.click('u9', function(e) {

if (true) {

	self.location.href=$axure.globalVariableProvider.getLinkUrl('ОБЪЯВЛЕНИЯ_РЕКЛМ__.html');

}
});
gv_vAlignTable['u42'] = 'top';gv_vAlignTable['u33'] = 'top';gv_vAlignTable['u72'] = 'top';gv_vAlignTable['u18'] = 'top';gv_vAlignTable['u110'] = 'top';document.getElementById('u101_img').tabIndex = 0;

u101.style.cursor = 'pointer';
$axure.eventManager.click('u101', function(e) {

if (true) {

	SetPanelVisibility('u112','','none',500);

}
});

$axure.eventManager.mouseover('u101', function(e) {
if (!IsTrueMouseOver('u101',e)) return;
if (true) {

	SetPanelVisibility('u109','','none',500);

}
});

$axure.eventManager.mouseout('u101', function(e) {
if (!IsTrueMouseOut('u101',e)) return;
if (true) {

	SetPanelVisibility('u109','hidden','none',500);

	SetPanelVisibility('u112','hidden','none',500);

}
});
gv_vAlignTable['u10'] = 'center';gv_vAlignTable['u70'] = 'top';gv_vAlignTable['u74'] = 'top';gv_vAlignTable['u29'] = 'top';gv_vAlignTable['u98'] = 'center';gv_vAlignTable['u121'] = 'top';