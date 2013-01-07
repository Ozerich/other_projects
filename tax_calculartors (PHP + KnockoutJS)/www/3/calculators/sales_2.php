<? $name = '«Упрощенка» с объектом «доходы минус расходы»' ?>
<? $text = 'Ставка единого «упрощенного» налога составляет 15 процентов от доходов, уменьшенных на величину расходов. Кроме того, налоговую базу можно уменьшить на сумму убытков, а также на сумму разницы между уплаченным за предыдущие периоды минимальным налогом и налогом, исчисленным в общем порядке.
<br/><br/>
Доходы и расходы определяются кассовым методом. Порядок учета доходов установлен статьей 346.15 НК РФ, расходов – статьей 346.16 НК РФ.'
?>
<? include "calculators/header.php" ?>


<ul class="step-list">

<li class="step">
    <div class="step-title">
        <span class="step-number">1</span><!-- end_step-number -->
        <h2>Единый "упрощенный" налог</h2>
    </div>
    <!-- end_step-title -->
    <ul class="calculation-list">
        <li>
            <div class="field-row">
                <div class="label">
                    <input type="radio" <?=v('step1_is_manual') == 1 ? 'selected' : ''?> value="1" data-bind="checked: step1_is_manual" name="step1_is_manual" class="hide"><span>Указать</span>
                    <input type="text" data-bind="value: step1_manual" class="custom-text" name="step1_manual" value="<?=v('step1_manual')?>"><span>руб.</span></div>
            </div>
            <!-- end_field-row -->
        </li>
        <li>
            <div class="field-row">
                <div class="label"><input type="radio" <?=v('step1_is_manual') ===0 ? 'selected' : ''?> value="0" data-bind="checked: step1_is_manual" name="step1_is_manual" class="show"><span>Рассчитать</span></div>
            </div>
            <!-- end_field-row -->
            <div class="calculation-block" style="display: <?=v('step1_is_manual') === 0 ? 'block' : 'none'?>">
                <table>
                    <tr>
                        <td colspan="2"><b>Расчет</b></td>
                    </tr>
                    <tr>
                        <td>Доходы, включаемые в налоговую базу</td>
                        <td>
                            <div class="field"><input type="text" name="var_1_1" value="<?=v('var_1_1')?>" data-bind="value: var_1_1" class="custom-text"><span>руб.</span></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Расходы, уменьшающие налоговую базу</td>
                        <td>
                            <div class="field"><input type="text" name="var_1_2" value="<?=v('var_1_2')?>" data-bind="value: var_1_2" class="custom-text"><span>руб.</span></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Убытки прошлых лет, уменьшающие налоговую базу</td>
                        <td>
                            <div class="field"><input type="text" name="var_1_3" value="<?=v('var_1_3')?>" data-bind="value: var_1_3" class="custom-text"><span>руб.</span></div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>База по налогу</b></td>
                        <td><span data-bind="text: var_1_4"></span> <span>руб.</span></td>
                    </tr>
                    <tr>
                        <td><b>Начисленный налог</b></td>
                        <td><span data-bind="text: var_1_5"></span> <span>руб.</span></td>
                    </tr>
                    <tr>
                        <td><b>Минимальный налог</b></td>
                        <td><span data-bind="text: var_1_6"></span> <span>руб.</span></td>
                    </tr>
                    <tr>
                        <td><b>Налог к уплате</b></td>
                        <td><span data-bind="text: step1_custom"></span> <span>руб.</span></td>
                    </tr>
                </table>
            </div>
            <!-- end_calculation-block -->
        </li>
    </ul>
    <!-- end_calculation-block -->
</li>

<li class="step">
    <div class="step-title">
        <span class="step-number">2</span><!-- end_step-number -->
        <h2>Страховые взносы</h2>
    </div>
    <!-- end_step-title -->

    <ul class="calculation-list">
        <li>
            <div class="field-row">
                <div class="label"><input type="radio" name="ins_is_manual" <?=v('ins_is_manual') == 1 ? 'selected' : ''?> value="1" data-bind="checked: ins_is_manual" class="hide"><span>Указать</span>
                    <input type="text" name="ins_manual" value="<?=v('ins_manual')?>" data-bind="value: ins_manual" class="custom-text"><span>руб.</span></div>
            </div>
            <!-- end_field-row -->
        </li>
        <li>
            <div class="field-row">
                <div class="label"><input type="radio" name="ins_is_manual" <?=v('ins_is_manual') === 0 ? 'selected' : ''?>  value="0" data-bind="checked: ins_is_manual" class="show"><span>Рассчитать</span></div>
            </div>
            <!-- end_field-row -->
            <div class="calculation-block" style="display: <?=v('ins_is_manual') === 0 ? 'block' : 'none'?> ">
                <table>
                    <tbody>
                    <tr>
                        <td colspan="2"><b>Расчет</b></td>
                    </tr>
                    <tr>
                        <td>Ставка страховых взносов на «травматизм»</td>
                        <td>
                            <div class="field">
                                <input type="text" data-max_value="100" data-float="1"  name="ins_var_1" value="<?=v('ins_var_1');?>" data-bind="value: ins_var_1" class="custom-text"><span>%</span></div>
                        </td>
                    </tr>

                    <tr>
                        <td>В организации есть работники, выплаты в пользу которых за год превышают предельную базу для начисления взносов</td>
                        <td><input type="checkbox" data-bind="checked: ins_c1" name="ins_c1" <?=v('ins_c1') == 1 ? 'checked' : ''?>/></td>
                    </tr>
                    <tr>
                        <td>В организации есть работники, с выплат которым начисляются дополнительные страховые взносы в ПФР</td>
                        <td><input type="checkbox" data-bind="checked: ins_c2" name="ins_c2" <?=v('ins_c2') == 1 ? 'checked' : ''?>/></td>
                    </tr>

                    <tr>
                        <td>Сумма выплат в пользу физлиц, на которые начисляются страховые взносы, не превышающие предельную базу для начисления взносов
                        </td>
                        <td>
                            <div class="field"><input type="text"  name="ins_var_2" value="<?=v('ins_var_2');?>" data-bind="value: ins_var_2" class="custom-text"><span>руб.</span></div>
                        </td>
                    </tr>
                    <tr>
                        <td>Взносы в ПФР<i>(рассчитывает автоматически)</i></td>
                        <td>
                            <div class="field">
                                <input type="text"  name="ins_var_3" value="<?=v('ins_var_3');?>" data-bind="value: ins_var_3" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Взносы в ФСС<i>(рассчитывает автоматически)</i></td>
                        <td>
                            <div class="field">
                                <input type="text"  name="ins_var_4" value="<?=v('ins_var_4');?>" data-bind="value: ins_var_4" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Расходы, возмещаемые за счет средств ФСС</td>
                        <td>
                            <div class="field"><input type="text"  name="ins_var_5" value="<?=v('ins_var_5');?>" data-bind="value: ins_var_5" class="custom-text"><span>руб.</span></div>
                        </td>
                    </tr>

                    <tr>
                        <td>Взносы в ФФОМС<i>(рассчитывает автоматически)</i></td>
                        <td>
                            <div class="field">
                                <input type="text"  name="ins_var_6" value="<?=v('ins_var_6');?>" data-bind="value: ins_var_6" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Взносы на «травматизм»<i>(рассчитывает автоматически)</i></td>
                        <td>
                            <div class="field">
                                <input type="text"  name="ins_var_7" value="<?=v('ins_var_7');?>" data-bind="value: ins_var_7" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Расходы, совершенные за счет взносов на «травматизм»</td>
                        <td>
                            <div class="field">
                                <input type="text"  name="ins_var_8" value="<?=v('ins_var_8');?>" data-bind="value: ins_var_8" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>

                    <tr data-bind="visible: ins_c1()">
                        <td>Сумма выплат в пользу физлиц, на которые начисляются страховые взносы, превышающие предельную базу для начисления взносов</td>
                        <td>
                            <div class="field"><input type="text"  name="ins_var_9" value="<?=v('ins_var_9');?>" data-bind="value: ins_var_9" class="custom-text"><span>руб.</span></div>
                        </td>
                    </tr>

                    <tr data-bind="visible: ins_c1()">
                        <td>Взносы в ПФР с превышения базы<i>(рассчитывает автоматически)</i></td>
                        <td>
                            <div class="field">
                                <input type="text" name="ins_var_10" value="<?=v('ins_var_10');?>"  data-bind="value: ins_var_10" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>

                    <tr data-bind="visible: ins_c2()">
                        <td>Сумма выплат в пользу физлиц, занятых на подземных работах, работах с вредными условиями труда и в горячих цехах</td>
                        <td>
                            <div class="field">
                                <input type="text" name="ins_var_11" value="<?=v('ins_var_11');?>"  data-bind="value: ins_var_11" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>

                    <tr data-bind="visible: ins_c2()">
                        <td>Сумма выплат в пользу иных физлиц, на выплаты которым начисляются дополнительные страховые взносы в ПФР</td>
                        <td>
                            <div class="field">
                                <input type="text" name="ins_var_12" value="<?=v('ins_var_12');?>"  data-bind="value: ins_var_12" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>

                    <tr data-bind="visible: ins_c2()">
                        <td>Дополнительные взносы в ПФР <i>(рассчитывает автоматически)</i></td>
                        <td>
                            <div class="field">
                                <input type="text" name="ins_var_13" value="<?=v('ins_var_13');?>"   data-bind="value: ins_var_13" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td><b>Общая сумма взносов</b></td>
                        <td><span data-bind="text: ins_custom"></span> <span>руб.</span></td>
                    </tr>

                    </tbody>
                </table>
            </div>
            <!-- end_calculation-block -->
        </li>
    </ul>
    <!-- end_calculation-list -->
</li>

<li class="step">
    <div class="step-title">
        <span class="step-number">3</span><!-- end_step-number -->
        <h2>НДС</h2>
    </div>
    <!-- end_step-title -->
    <ul class="calculation-list">
        <li>
            <div class="calculation-block" style="display: block !important;">
                <table>
                    <tr>
                        <td>НДС, уплачиваемый организацией при импорте</td>
                        <td>
                            <div class="field"><input type="text" name="nds" value="<?=v('nds')?>" data-bind="value: nds" class="custom-text"><span>руб.</span></div>
                        </td>
                    </tr>

                </table>
            </div>
            <!-- end_calculation-block -->
        </li>
    </ul>
    <!-- end_calculation-list -->
</li>


</ul>
<!-- end_step-list -->


<div class="calculation-total">
    <p>Общая сумма платежей в бюджет при применении "упрощенки" с объектом "доходы минус расходы"</p>
    <b><span data-bind="text: result"></span> <span>руб.</span></b>
</div>
<!-- end_calculate-total -->
<? include "calculators/footer.php" ?>