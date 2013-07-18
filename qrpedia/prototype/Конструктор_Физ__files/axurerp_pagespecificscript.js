for(var i = 0; i < 272; i++) { var scriptId = 'u' + i; window[scriptId] = document.getElementById(scriptId); }

$axure.eventManager.pageLoad(
function (e) {

});

u115.style.cursor = 'pointer';
$axure.eventManager.click('u115', function(e) {

if (true) {

	SetPanelVisibility('u116','','none',500);

}
});
gv_vAlignTable['u122'] = 'top';
$axure.eventManager.change('u21', function(e) {

if ((GetSelectedOption('u21')) == ('Визитка человека')) {

	SetPanelVisibility('u23','','none',500);

	SetPanelVisibility('u79','hidden','none',500);

	SetPanelVisibility('u143','hidden','none',500);

	SetPanelVisibility('u201','hidden','none',500);

}
else
if ((GetSelectedOption('u21')) == ('Визитка компании')) {

	SetPanelVisibility('u79','','none',500);

	SetPanelVisibility('u23','hidden','none',500);

	SetPanelVisibility('u143','hidden','none',500);

	SetPanelVisibility('u201','hidden','none',500);

}
else
if ((GetSelectedOption('u21')) == ('Страница')) {

	SetPanelVisibility('u143','','none',500);

	SetPanelVisibility('u23','hidden','none',500);

	SetPanelVisibility('u79','hidden','none',500);

	SetPanelVisibility('u201','hidden','none',500);

}
else
if ((GetSelectedOption('u21')) == ('Мероприятие')) {

	SetPanelVisibility('u201','','none',500);

	SetPanelVisibility('u23','hidden','none',500);

	SetPanelVisibility('u79','hidden','none',500);

	SetPanelVisibility('u143','hidden','none',500);

}
});
gv_vAlignTable['u32'] = 'top';document.getElementById('u243_img').tabIndex = 0;

u243.style.cursor = 'pointer';
$axure.eventManager.click('u243', function(e) {

if (true) {

	SetPanelVisibility('u247','','none',500);

}
});

$axure.eventManager.mouseover('u243', function(e) {
if (!IsTrueMouseOver('u243',e)) return;
if (true) {

	SetPanelVisibility('u247','','none',500);

}
});

$axure.eventManager.mouseout('u243', function(e) {
if (!IsTrueMouseOut('u243',e)) return;
if (true) {

	SetPanelVisibility('u235','hidden','none',500);

	SetPanelVisibility('u238','hidden','none',500);

	SetPanelVisibility('u247','hidden','none',500);

}
});
gv_vAlignTable['u207'] = 'top';gv_vAlignTable['u7'] = 'center';gv_vAlignTable['u153'] = 'top';gv_vAlignTable['u226'] = 'center';gv_vAlignTable['u140'] = 'top';gv_vAlignTable['u222'] = 'center';gv_vAlignTable['u212'] = 'top';gv_vAlignTable['u256'] = 'top';gv_vAlignTable['u159'] = 'top';gv_vAlignTable['u229'] = 'top';gv_vAlignTable['u55'] = 'top';gv_vAlignTable['u138'] = 'center';gv_vAlignTable['u20'] = 'center';gv_vAlignTable['u67'] = 'top';gv_vAlignTable['u65'] = 'top';gv_vAlignTable['u120'] = 'top';gv_vAlignTable['u152'] = 'top';gv_vAlignTable['u110'] = 'top';document.getElementById('u6_img').tabIndex = 0;

u6.style.cursor = 'pointer';
$axure.eventManager.click('u6', function(e) {

if (true) {

	self.location.href=$axure.globalVariableProvider.getLinkUrl('Личные_данные.html');

}
});
gv_vAlignTable['u205'] = 'top';gv_vAlignTable['u108'] = 'top';gv_vAlignTable['u133'] = 'top';gv_vAlignTable['u200'] = 'center';gv_vAlignTable['u34'] = 'top';gv_vAlignTable['u68'] = 'top';gv_vAlignTable['u89'] = 'top';gv_vAlignTable['u39'] = 'top';gv_vAlignTable['u266'] = 'top';gv_vAlignTable['u47'] = 'top';gv_vAlignTable['u184'] = 'top';gv_vAlignTable['u185'] = 'top';gv_vAlignTable['u264'] = 'top';gv_vAlignTable['u258'] = 'center';gv_vAlignTable['u66'] = 'top';gv_vAlignTable['u112'] = 'center';gv_vAlignTable['u78'] = 'top';gv_vAlignTable['u179'] = 'top';gv_vAlignTable['u231'] = 'top';gv_vAlignTable['u57'] = 'center';gv_vAlignTable['u191'] = 'top';gv_vAlignTable['u119'] = 'top';gv_vAlignTable['u41'] = 'top';gv_vAlignTable['u172'] = 'top';gv_vAlignTable['u246'] = 'top';gv_vAlignTable['u149'] = 'top';gv_vAlignTable['u118'] = 'center';gv_vAlignTable['u197'] = 'top';gv_vAlignTable['u88'] = 'top';gv_vAlignTable['u189'] = 'center';gv_vAlignTable['u176'] = 'top';gv_vAlignTable['u267'] = 'top';gv_vAlignTable['u174'] = 'top';gv_vAlignTable['u216'] = 'top';gv_vAlignTable['u254'] = 'top';gv_vAlignTable['u85'] = 'top';gv_vAlignTable['u51'] = 'top';gv_vAlignTable['u182'] = 'center';gv_vAlignTable['u252'] = 'top';gv_vAlignTable['u10'] = 'center';gv_vAlignTable['u100'] = 'top';document.getElementById('u166_img').tabIndex = 0;

u166.style.cursor = 'pointer';
$axure.eventManager.click('u166', function(e) {

if (true) {

	SetPanelVisibility('u180','','none',500);

}
});

$axure.eventManager.mouseover('u166', function(e) {
if (!IsTrueMouseOver('u166',e)) return;
if (true) {

	SetPanelVisibility('u183','','none',500);

}
});

$axure.eventManager.mouseout('u166', function(e) {
if (!IsTrueMouseOut('u166',e)) return;
if (true) {

	SetPanelVisibility('u180','hidden','none',500);

	SetPanelVisibility('u183','hidden','none',500);

	SetPanelVisibility('u192','hidden','none',500);

}
});
gv_vAlignTable['u36'] = 'top';gv_vAlignTable['u30'] = 'top';gv_vAlignTable['u195'] = 'center';gv_vAlignTable['u74'] = 'center';gv_vAlignTable['u123'] = 'top';
u223.style.cursor = 'pointer';
$axure.eventManager.click('u223', function(e) {

if (true) {

	SetPanelVisibility('u224','','none',500);

}
});
gv_vAlignTable['u114'] = 'center';gv_vAlignTable['u157'] = 'top';document.getElementById('u221_img').tabIndex = 0;

u221.style.cursor = 'pointer';
$axure.eventManager.click('u221', function(e) {

if (true) {

	SetPanelVisibility('u235','','none',500);

}
});

$axure.eventManager.mouseover('u221', function(e) {
if (!IsTrueMouseOver('u221',e)) return;
if (true) {

	SetPanelVisibility('u238','','none',500);

}
});

$axure.eventManager.mouseout('u221', function(e) {
if (!IsTrueMouseOut('u221',e)) return;
if (true) {

	SetPanelVisibility('u235','hidden','none',500);

	SetPanelVisibility('u238','hidden','none',500);

	SetPanelVisibility('u247','hidden','none',500);

}
});
gv_vAlignTable['u126'] = 'top';gv_vAlignTable['u71'] = 'top';gv_vAlignTable['u5'] = 'center';gv_vAlignTable['u98'] = 'top';gv_vAlignTable['u214'] = 'top';gv_vAlignTable['u43'] = 'top';gv_vAlignTable['u240'] = 'top';gv_vAlignTable['u142'] = 'top';gv_vAlignTable['u106'] = 'top';
u168.style.cursor = 'pointer';
$axure.eventManager.click('u168', function(e) {

if (true) {

	SetPanelVisibility('u169','','none',500);

}
});
gv_vAlignTable['u227'] = 'top';gv_vAlignTable['u87'] = 'top';gv_vAlignTable['u53'] = 'top';gv_vAlignTable['u193'] = 'top';gv_vAlignTable['u104'] = 'top';gv_vAlignTable['u269'] = 'top';gv_vAlignTable['u121'] = 'top';gv_vAlignTable['u250'] = 'center';document.getElementById('u19_img').tabIndex = 0;

u19.style.cursor = 'pointer';
$axure.eventManager.click('u19', function(e) {

if (true) {

	self.location.href=$axure.globalVariableProvider.getLinkUrl('Платежи_и_документы_1.html');

}
});
gv_vAlignTable['u155'] = 'top';gv_vAlignTable['u206'] = 'top';gv_vAlignTable['u84'] = 'top';gv_vAlignTable['u239'] = 'top';gv_vAlignTable['u63'] = 'center';gv_vAlignTable['u260'] = 'top';gv_vAlignTable['u76'] = 'top';gv_vAlignTable['u134'] = 'top';gv_vAlignTable['u271'] = 'center';gv_vAlignTable['u228'] = 'top';gv_vAlignTable['u94'] = 'top';
u60.style.cursor = 'pointer';
$axure.eventManager.click('u60', function(e) {

if (true) {

	SetPanelVisibility('u61','','none',500);

}
});
gv_vAlignTable['u102'] = 'top';document.getElementById('u9_img').tabIndex = 0;

u9.style.cursor = 'pointer';
$axure.eventManager.click('u9', function(e) {

if (true) {

	self.location.href=$axure.globalVariableProvider.getLinkUrl('ОБЪЯВЛЕНИЯ_РЕКЛМ__.html');

}
});
gv_vAlignTable['u234'] = 'top';gv_vAlignTable['u147'] = 'top';gv_vAlignTable['u163'] = 'top';gv_vAlignTable['u91'] = 'top';gv_vAlignTable['u131'] = 'top';gv_vAlignTable['u64'] = 'top';document.getElementById('u188_img').tabIndex = 0;

u188.style.cursor = 'pointer';
$axure.eventManager.click('u188', function(e) {

if (true) {

	SetPanelVisibility('u192','','none',500);

}
});

$axure.eventManager.mouseover('u188', function(e) {
if (!IsTrueMouseOver('u188',e)) return;
if (true) {

	SetPanelVisibility('u192','','none',500);

}
});

$axure.eventManager.mouseout('u188', function(e) {
if (!IsTrueMouseOut('u188',e)) return;
if (true) {

	SetPanelVisibility('u180','hidden','none',500);

	SetPanelVisibility('u183','hidden','none',500);

	SetPanelVisibility('u192','hidden','none',500);

}
});
gv_vAlignTable['u230'] = 'top';gv_vAlignTable['u204'] = 'top';gv_vAlignTable['u210'] = 'top';gv_vAlignTable['u13'] = 'top';document.getElementById('u113_img').tabIndex = 0;

u113.style.cursor = 'pointer';
$axure.eventManager.click('u113', function(e) {

if (true) {

	SetPanelVisibility('u127','','none',500);

}
});

$axure.eventManager.mouseover('u113', function(e) {
if (!IsTrueMouseOver('u113',e)) return;
if (true) {

	SetPanelVisibility('u130','','none',500);

}
});

$axure.eventManager.mouseout('u113', function(e) {
if (!IsTrueMouseOut('u113',e)) return;
if (true) {

	SetPanelVisibility('u127','hidden','none',500);

	SetPanelVisibility('u130','hidden','none',500);

	SetPanelVisibility('u141','hidden','none',500);

}
});
gv_vAlignTable['u29'] = 'top';gv_vAlignTable['u262'] = 'top';gv_vAlignTable['u175'] = 'top';gv_vAlignTable['u129'] = 'center';gv_vAlignTable['u86'] = 'top';document.getElementById('u58_img').tabIndex = 0;

u58.style.cursor = 'pointer';
$axure.eventManager.click('u58', function(e) {

if (true) {

	SetPanelVisibility('u72','','none',500);

}
});

$axure.eventManager.mouseover('u58', function(e) {
if (!IsTrueMouseOver('u58',e)) return;
if (true) {

	SetPanelVisibility('u75','','none',500);

}
});

$axure.eventManager.mouseout('u58', function(e) {
if (!IsTrueMouseOut('u58',e)) return;
if (true) {

	SetPanelVisibility('u72','hidden','none',500);

	SetPanelVisibility('u75','hidden','none',500);

}
});
gv_vAlignTable['u173'] = 'top';gv_vAlignTable['u171'] = 'center';gv_vAlignTable['u31'] = 'top';gv_vAlignTable['u3'] = 'center';gv_vAlignTable['u96'] = 'top';gv_vAlignTable['u146'] = 'top';gv_vAlignTable['u15'] = 'top';gv_vAlignTable['u49'] = 'top';gv_vAlignTable['u1'] = 'center';gv_vAlignTable['u148'] = 'top';gv_vAlignTable['u167'] = 'center';gv_vAlignTable['u237'] = 'center';gv_vAlignTable['u12'] = 'center';gv_vAlignTable['u165'] = 'center';gv_vAlignTable['u59'] = 'center';document.getElementById('u137_img').tabIndex = 0;

u137.style.cursor = 'pointer';
$axure.eventManager.click('u137', function(e) {

if (true) {

	SetPanelVisibility('u141','','none',500);

}
});

$axure.eventManager.mouseover('u137', function(e) {
if (!IsTrueMouseOver('u137',e)) return;
if (true) {

	SetPanelVisibility('u141','','none',500);

}
});

$axure.eventManager.mouseout('u137', function(e) {
if (!IsTrueMouseOut('u137',e)) return;
if (true) {

	SetPanelVisibility('u127','hidden','none',500);

	SetPanelVisibility('u130','hidden','none',500);

	SetPanelVisibility('u141','hidden','none',500);

}
});
gv_vAlignTable['u244'] = 'center';gv_vAlignTable['u18'] = 'top';gv_vAlignTable['u248'] = 'top';gv_vAlignTable['u161'] = 'top';gv_vAlignTable['u45'] = 'top';gv_vAlignTable['u22'] = 'top';gv_vAlignTable['u220'] = 'center';gv_vAlignTable['u218'] = 'top';gv_vAlignTable['u28'] = 'top';