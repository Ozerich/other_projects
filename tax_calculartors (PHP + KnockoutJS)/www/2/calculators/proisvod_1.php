<? $name = 'Общая система налогообложения' ?>
<? $text = 'Для организаций, применяющих общую систему налогообложения, основными налогами являются налог на прибыль, НДС и налог на имущество, которые, по общему правилу, не уплачиваются при применении спецрежимов.
<br/><br/>Однако в некоторых случаях применение общей системы налогообложения может быть выгоднее. Например, компания с небольшими оборотами может снизить налоги, применив освобождение от уплаты НДС. Кроме того, движимое имущество, принятое к учету с 1 января 2013 года, не включается в базу по налогу на имущество. Поэтому для оптимизации налоговой нагрузки целесообразно проверить все возможные варианты.'?>
<? include "calculators/header.php" ?>


<form action="#" method="post">

<ul class="step-list">

<li class="step">
    <div class="step-title">
        <span class="step-number">1</span><!-- end_step-number -->
        <h2>Налог на прибыль</h2>
    </div>
    <!-- end_step-title -->
    <ul class="calculation-list">
        <li>
            <div class="field-row">
                <div class="label">
                    <input type="radio" name="is_step1_manual"
                           class="hide" <?=isset($vars['is_step1_manual']) && $vars['is_step1_manual'] == 1 ? 'selected' : ''?>
                           value="1" data-bind="checked: isNalogManual"><span>Указать</span>
                    <input type="text" data-bind="value: nalogManual" value="<?=isset($vars['step1_manual']) ? $vars['step1_manual'] : ''?>"
                           name="step1_manual" class="custom-text"><span>руб.</span>
                </div>

            </div>
            <!-- end_field-row -->
        </li>
        <li>
            <div class="field-row">
                <div class="label"><input type="radio"
                              name="is_step1_manual" <?=isset($vars['is_step1_manual']) && $vars['is_step1_manual'] === 0 ? 'selected' : ''?>
                              class="show" value="0" data-bind="checked: isNalogManual"><span>Рассчитать</span></div>
            </div>
            <!-- end_field-row -->
            <div class="calculation-block"
                 style="display: <?=isset($vars['is_step1_manual']) && $vars['is_step1_manual'] === 0 ? 'block' : 'none'?>">
                <table>
                    <tr>
                        <td colspan="2"><b>Расчет</b></td>
                    </tr>
                    <tr>
                        <td>Доходы, облагаемые по ставке 20%</td>
                        <td>
                            <div class="field">
                                <input type="text" name="var_1_1" value="<?=v('var_1_1')?>" data-bind="value: var_1_1"
                                       class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Расходы, облагаемые по ставке 20% (включая убытки)</td>
                        <td>
                            <div class="field">
                                <input type="text" name="var_1_2" value="<?=v('var_1_2')?>" class="custom-text"
                                       data-bind="value: var_1_2" id="phoneNumber"><span>руб.</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>База по налогу на прибыль</b></td>
                        <td><span data-bind="text: var_1_3"></span> <span>руб.</span></td>
                    </tr>
                    <tr>
                        <td><b>Налог на прибыль к уплате</b></td>
                        <td><span data-bind="text: nalogCustom"></span> <span>руб.</span></td>
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
        <h2>НДС</h2>
    </div>
    <!-- end_step-title -->
    <ul class="calculation-list">
        <li>
            <div class="field-row">
                <div class="label"><input type="radio" name="is_nds_need" <?=v('is_nds_need') === 0 ? 'selected' : ''?> value="0"
                              data-bind="checked: nds_need" class="hide-nds"><span>Организация использует освобождение от
                    уплаты НДС</span></div>
            </div>
            <!-- end_field-row -->
            <div id="nds_no_block" class="calculation-block"
                 style="display: <?=v('is_nds_need') === 0 ? 'block' : 'none'?>">
                <table>
                    <tr>
                        <td colspan="2"><b>Расчет</b></td>
                    </tr>
                    <tr>
                        <td><span>НДС, уплачиваемый организацией при импорте, в качестве налогового агента и иных ситуациях</span>
                        </td>
                        <td>
                            <div class="field"><input type="text" value="<?=v('nds_no_value')?>" name="nds_no_value"
                                                      data-bind="value: nds_no_value" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </li>
        <li>
            <div class="field-row">
                <div class="label">
                    <input type="radio" name="is_nds_need" <?=v('is_nds_need') == 1 ? 'selected' : ''?>
                           value="1" data-bind="checked: nds_need" class="show-nds">
                    <span>Организация уплачивает НДС в обычном порядке</span>
                </div>
            </div>
            <!-- end_field-row -->
            <div id="nds_yes_block" class="calculation-row"
                 style="display: <?=v('is_nds_need') == 1 ? 'block' : 'none'?>">
                <div class="field-row">
                    <div class="label"><input type="radio" name="is_nds_manual" <?=v('is_nds_manual') == 1 ? 'selected' : ''?>
                                  value="1" data-bind="checked: nds_is_manual" class="hide"><span>Указать</span>
                        <input type="text" data-bind="value: nds_manual" value="<?=v('nds_manual')?>" name="nds_manual"
                               class="custom-text"><span>руб.</span></div>
                </div>
                <!-- end_field-row -->
                <div class="field-row">
                    <div class="label"><input type="radio" name="is_nds_manual" <?=v('is_nds_manual') === 0 ? 'selected' : ''?>
                                  value="0" data-bind="checked: nds_is_manual" class="show"><span>Рассчитать</span></div>
                </div>
                <!-- end_field-row -->
                <div class="calculation-block" style="display: <?=v('is_nds_manual') === 0 ? 'block' : 'none'?>">
                    <table>
                        <tr>
                            <td colspan="2"><b>Расчет</b></td>
                        </tr>
                        <tr>
                            <td>НДС, начисленный с реализации</td>
                            <td>
                                <div class="field"><input type="text" value="<?=v('var_2_1')?>" name="var_2_1"
                                                          data-bind="value: var_2_1" class="custom-text"><span>руб.</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>НДС, начисленный с полученных авансов</td>
                            <td>
                                <div class="field"><input type="text" value="<?=v('var_2_2')?>" name="var_2_2"
                                                          data-bind="value: var_2_2" class="custom-text"><span>руб.</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>НДС, уплачиваемый организацией при импорте, в качестве налогового агента и иных
                                ситуациях
                            </td>
                            <td>
                                <div class="field"><input type="text" value="<?=v('var_2_3')?>" name="var_2_3"
                                                          data-bind="value: var_2_3" class="custom-text"><span>руб.</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>НДС, предъявленный с перечисленных авансов</td>
                            <td>
                                <div class="field"><input type="text" value="<?=v('var_2_4')?>" name="var_2_4"
                                                          data-bind="value: var_2_4" class="custom-text"><span>руб.</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>НДС с полученных авансов, принимаемый к вычету при отгрузке товаров</td>
                            <td>
                                <div class="field"><input type="text" value="<?=v('var_2_5')?>" name="var_2_5"
                                                          data-bind="value: var_2_5" class="custom-text"><span>руб.</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>Иные суммы НДС, принимаемые к вычету</td>
                            <td>
                                <div class="field"><input type="text" value="<?=v('var_2_6')?>" name="var_2_6"
                                                          data-bind="value: var_2_6" class="custom-text"><span>руб.</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><b>НДС к уплате</b></td>
                            <td><span data-bind="text: nds_1"></span> <span>руб.</span></td>
                        </tr>
                        <tr>
                            <td><b>НДС к возмещению</b></td>
                            <td><span data-bind="text: nds_2"></span> <span>руб.</span></td>
                        </tr>
                    </table>
                </div>
                <!-- end_calculation-block -->
            </div>
            <!-- end_calculation-row -->
        </li>
    </ul>
    <!-- end_calculation-list -->
</li>

<li class="step">
    <div class="step-title">
        <span class="step-number">3</span><!-- end_step-number -->
        <h2>Налог на имущество</h2>
    </div>
    <!-- end_step-title -->

    <ul class="calculation-list">
        <li>
            <div class="field-row">
                <div class="label"><input type="radio" name="is_step3_manual"
                              value="1" <?=v('is_step3_manual') == 1 ? 'selected' : ''?>
                              data-bind="checked: step3_is_manual" class="hide"><span>Указать</span>
                    <input type="text" data-bind="value: step3_manual" value="<?=v('step3_manual')?>"
                           name="step3_manual" class="custom-text"><span>руб.</span></div>
            </div>
            <!-- end_field-row -->
        </li>
        <li>
            <div class="field-row">
                <div class="label"><input type="radio" name="is_step3_manual"
                              value="0" <?=v('is_step3_manual') === 0 ? 'selected' : ''?>
                              data-bind="checked: step3_is_manual" class="show"><span>Рассчитать</span></div>
            </div>
            <!-- end_field-row -->
            <div class="calculation-block" style="display: <?=v('is_step3_manual') === 0 ? 'block' : 'none'?>">
                <table>
                    <tr>
                        <td colspan="2"><b>Расчет</b></td>
                    </tr>
                    <tr>
                        <td>Среднегодовая стоимость основных средств, облагаемых налогом на имущество</td>
                        <td>
                            <div class="field"><input type="text" name="var_3_1" value="<?=v('var_3_1');?>"
                                                      data-bind="value: var_3_1" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Ставка налога на имущество</td>
                        <td>
                            <div class="field"><input type="text" data-float="1" data-max="2.2" name="var_3_2"
                                                      value="<?=v('var_3_2', 2.2);?>" data-bind="value: var_3_2"
                                                      class="custom-text"><span>%</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><b>Налог на имущество к оплате</b></td>
                        <td><span data-bind="text: step3_custom"></span> <span>руб.</span></td>
                    </tr>
                </table>
            </div>
            <!-- end_calculation-block -->
        </li>
    </ul>
    <!-- end_calculation-list -->
</li>

<li class="step">
    <div class="step-title">
        <span class="step-number">4</span><!-- end_step-number -->
        <h2>Страховые взносы</h2>
    </div>
    <!-- end_step-title -->

    <ul class="calculation-list">
        <li>
            <div class="field-row">
                <div class="label"><input type="radio" name="ins_is_manual" <?=v('ins_is_manual') == 1 ? 'selected' : ''?> value="1"
                              data-bind="checked: ins_is_manual" class="hide"><span>Указать</span>
                    <input type="text" name="ins_manual" value="<?=v('ins_manual')?>" data-bind="value: ins_manual"
                           class="custom-text"><span>руб.</span></div>
            </div>
            <!-- end_field-row -->
        </li>
        <li>
            <div class="field-row">
                <div class="label"><input type="radio" name="ins_is_manual" <?=v('ins_is_manual') === 0 ? 'selected' : ''?>value="0"
                              data-bind="checked: ins_is_manual" class="show"><span>Рассчитать</span></div>
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
                                <input type="text" data-max_value="100" data-float="1" name="ins_var_1"
                                       value="<?=v('ins_var_1');?>" data-bind="value: ins_var_1" class="custom-text"><span>%</span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>В организации есть работники, выплаты в пользу которых за год превышают предельную базу для
                            начисления взносов
                        </td>
                        <td><input type="checkbox" data-bind="checked: ins_c1"
                                   name="ins_c1" <?=v('ins_c1') == 1 ? 'checked' : ''?>/></td>
                    </tr>
                    <tr>
                        <td>В организации есть работники, с выплат которым начисляются дополнительные страховые взносы в
                            ПФР
                        </td>
                        <td><input type="checkbox" data-bind="checked: ins_c2"
                                   name="ins_c2" <?=v('ins_c2') == 1 ? 'checked' : ''?>/></td>
                    </tr>

                    <tr>
                        <td>Сумма выплат в пользу физлиц, на которые начисляются страховые взносы, не превышающие предельную базу для начисления взносов
                        </td>
                        <td>
                            <div class="field"><input type="text" name="ins_var_2" value="<?=v('ins_var_2');?>"
                                                      data-bind="value: ins_var_2" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Взносы в ПФР<i>(рассчитывает автоматически)</i></td>
                        <td>
                            <div class="field">
                                <input type="text" name="ins_var_3" value="<?=v('ins_var_3');?>"
                                       data-bind="value: ins_var_3" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Взносы в ФСС<i>(рассчитывает автоматически)</i></td>
                        <td>
                            <div class="field">
                                <input type="text" name="ins_var_4" value="<?=v('ins_var_4');?>"
                                       data-bind="value: ins_var_4" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Расходы, возмещаемые за счет средств ФСС</td>
                        <td>
                            <div class="field"><input type="text" name="ins_var_5" value="<?=v('ins_var_5');?>"
                                                      data-bind="value: ins_var_5" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td>Взносы в ФФОМС<i>(рассчитывает автоматически)</i></td>
                        <td>
                            <div class="field">
                                <input type="text" name="ins_var_6" value="<?=v('ins_var_6');?>"
                                       data-bind="value: ins_var_6" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Взносы на «травматизм»<i>(рассчитывает автоматически)</i></td>
                        <td>
                            <div class="field">
                                <input type="text" name="ins_var_7" value="<?=v('ins_var_7');?>"
                                       data-bind="value: ins_var_7" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Расходы, совершенные за счет взносов на «травматизм»</td>
                        <td>
                            <div class="field">
                                <input type="text" name="ins_var_8" value="<?=v('ins_var_8');?>"
                                       data-bind="value: ins_var_8" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>

                    <tr data-bind="visible: ins_c1()">
                        <td>Сумма выплат в пользу физлиц, на которые начисляются страховые взносы, превышающие
                            предельную базу для начисления взносов
                        </td>
                        <td>
                            <div class="field"><input type="text" name="ins_var_9" value="<?=v('ins_var_9');?>"
                                                      data-bind="value: ins_var_9" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>

                    <tr data-bind="visible: ins_c1()">
                        <td>Взносы в ПФР с превышения базы<i>(рассчитывает автоматически)</i></td>
                        <td>
                            <div class="field">
                                <input type="text" name="ins_var_10" value="<?=v('ins_var_10');?>"
                                       data-bind="value: ins_var_10" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>

                    <tr data-bind="visible: ins_c2()">
                        <td>Сумма выплат в пользу физлиц, занятых на подземных работах, работах с вредными условиями
                            труда и в горячих цехах
                        </td>
                        <td>
                            <div class="field">
                                <input type="text" name="ins_var_11" value="<?=v('ins_var_11');?>"
                                       data-bind="value: ins_var_11" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>

                    <tr data-bind="visible: ins_c2()">
                        <td>Сумма выплат в пользу иных физлиц, на выплаты которым начисляются дополнительные страховые
                            взносы в ПФР
                        </td>
                        <td>
                            <div class="field">
                                <input type="text" name="ins_var_12" value="<?=v('ins_var_12');?>"
                                       data-bind="value: ins_var_12" class="custom-text"><span>руб.</span>
                            </div>
                        </td>
                    </tr>

                    <tr data-bind="visible: ins_c2()">
                        <td>Дополнительные взносы в ПФР <i>(рассчитывает автоматически)</i></td>
                        <td>
                            <div class="field">
                                <input type="text" name="ins_var_13" value="<?=v('ins_var_13');?>"
                                       data-bind="value: ins_var_13" class="custom-text"><span>руб.</span>
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

</ul>
<!-- end_step-list -->

<div class="calculation-total">
    <p>Общая сумма платежей в бюджет при применении общей системы налогообложения</p>
    <b><span data-bind="text: result"></span> <span>руб.</span></b>
</div>
<!-- end_calculate-total -->
<? include "calculators/footer.php" ?>