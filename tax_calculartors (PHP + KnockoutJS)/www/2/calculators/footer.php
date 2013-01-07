<!-- end_calculate-total -->
<mark data-bind="visible: error">Внимание! Не заполнены обязательные поля.</mark>
<div class="step-action footer-save">
    <a href="#" title="Сохранить результаты" data-bind="click: submit_calc" class="btn-green">Сохранить результаты</a>
    <a href="#" onclick="window.print(); return false" title="Распечатать" class="ico-print">Распечатать</a>
   </div>
<!-- end_step-action -->

<input type="hidden" name="next_year" data-bind="value: result"/>
<input type="hidden" name="prev_year" data-bind="value: prev_year_result"/>
</form>
</div>
<!-- end_calculation -->
</section>
<!-- middle-->