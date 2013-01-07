function ViewModel(type) {

    this.type = type;

    // STEP 1

    this.isNalogManual = ko.observable(rv('is_step1_manual'));
    this.nalogManual = ko.observable($('[name="step1_manual"]').val());

    this.var_1_1 = ko.observable($('[name="var_1_1"]').val());
    this.var_1_2 = ko.observable($('[name="var_1_2"]').val());

    this.var_1_3 = ko.computed(function () {
        var a = this.var_1_1() ? parseFloat(this.var_1_1()) : 0;
        var b = this.var_1_2() ? parseFloat(this.var_1_2()) : 0;

        return a < b ? 0 : a - b;
    }, this);

    this.nalogCustom = ko.computed(function () {
        return num(this.var_1_3() * 0.2);
    }, this);


    this.result_1 = ko.computed(function () {

        if (this.isNalogManual() == 1) {
            return num(this.nalogManual());
        }
        else if (this.isNalogManual() == 0) {
            return this.nalogCustom();
        }
        return 0;

    }, this);


    // STEP 2

    this.nds_need = ko.observable(rv('is_nds_need'));
    this.nds_is_manual = ko.observable(rv('is_nds_manual'));
    this.nds_manual = ko.observable($('[name="nds_manual"]').val());

    this.nds_no_value = ko.observable(iv('nds_no_value'));

    this.var_2_1 = ko.observable($('[name="var_2_1"]').val());
    this.var_2_2 = ko.observable($('[name="var_2_2"]').val());
    this.var_2_3 = ko.observable($('[name="var_2_3"]').val());
    this.var_2_4 = ko.observable($('[name="var_2_4"]').val());
    this.var_2_5 = ko.observable($('[name="var_2_5"]').val());
    this.var_2_6 = ko.observable($('[name="var_2_6"]').val());

    this.nds_1 = ko.computed(function () {
        var v1 = this.var_2_1();
        var v2 = this.var_2_2();
        var v3 = this.var_2_3();
        var v4 = this.var_2_4();
        var v5 = this.var_2_5();
        var v6 = this.var_2_6();


        return Math.max(0, num(v1) + num(v2) + num(v3) - num(v4) - num(v5) - num(v6));

    }, this);

    this.nds_2 = ko.computed(function () {

        var v1 = this.var_2_1();
        var v2 = this.var_2_2();
        var v3 = this.var_2_3();
        var v4 = this.var_2_4();
        var v5 = this.var_2_5();
        var v6 = this.var_2_6();


        return Math.abs(Math.min(0, num(v1) + num(v2) + num(v3) - num(v4) - num(v5) - num(v6)));

    }, this);


    this.nds = ko.computed(function () {

        if (this.nds_need() == -1) {
            return 0;
        }
        else if (this.nds_need() == 0) {
            return parseFloat(this.nds_no_value() ? this.nds_no_value() : 0);
        }
        else {

            if (parseInt(this.nds_is_manual()) == 1) {
                return val_or_zero(this.nds_manual());
            }
            else {
                return this.nds_1() - this.nds_2();
            }

        }

    }, this);


    // STEP 3

    this.step3_is_manual = ko.observable(rv('is_step3_manual'));
    this.step3_manual = ko.observable($('[name="step3_manual"]').val());

    this.var_3_1 = ko.observable($('[name="var_3_1"]').val());
    this.var_3_2 = ko.observable($('[name="var_3_2"]').val());
    this.step3_custom = ko.computed(function () {
        var a = num(this.var_3_1());
        var b = this.var_3_2();

        return a && b ? Math.round(a * b / 100) : 0;
    }, this);

    this.result_3 = ko.computed(function () {
        if (parseInt(this.step3_is_manual()) == -1)return 0;
        return parseInt(this.step3_is_manual()) == 1 ? (this.step3_manual() ? num(this.step3_manual()) : 0) : this.step3_custom();
    }, this);


    // STEP 4 (Insurance)

    this.ins_is_manual = ko.observable(rv('ins_is_manual'));
    this.ins_manual = ko.observable(iv('ins_manual'));

    this._ins_var_1 = ko.observable(iv('ins_var_1'));
    this._ins_var_2 = ko.observable(iv('ins_var_2'));
    this._ins_var_3 = ko.observable(iv('ins_var_3'));
    this._ins_var_4 = ko.observable(iv('ins_var_4'));
    this._ins_var_5 = ko.observable(iv('ins_var_5'));
    this._ins_var_6 = ko.observable(iv('ins_var_6'));
    this._ins_var_7 = ko.observable(iv('ins_var_7'));
    this._ins_var_8 = ko.observable(iv('ins_var_8'));
    this._ins_var_9 = ko.observable(iv('ins_var_9'));
    this._ins_var_10 = ko.observable(iv('ins_var_10'));
    this._ins_var_11 = ko.observable(iv('ins_var_11'));
    this._ins_var_12 = ko.observable(iv('ins_var_12'));
    this._ins_var_13 = ko.observable(iv('ins_var_13'));
    this._ins_custom = ko.observable(iv('ins_custom'));

    this.ins_c1 = ko.observable(cv('ins_c1'));
    this.ins_c2 = ko.observable(cv('ins_c2'));

    var that = this;

    this.ins_var_1 = ko.computed({
        'read':function () {
            return that._ins_var_1();
        },
        'write':function (val) {
            that._ins_var_1(val);
        }
    }, this);
    this.ins_var_2 = ko.computed({
        'read':function () {
            return that._ins_var_2();
        },
        'write':function (val) {
            that._ins_var_2(val);
        }
    }, this);
    this.ins_var_5 = ko.computed({
        'read':function () {
            return that._ins_var_5();
        },
        'write':function (val) {
            that._ins_var_5(val);
        }
    }, this);
    this.ins_var_8 = ko.computed({
        'read':function () {
            return that._ins_var_8();
        },
        'write':function (val) {
            that._ins_var_8(val);
        }
    }, this);
    this.ins_var_9 = ko.computed({
        'read':function () {
            return that._ins_var_9();
        },
        'write':function (val) {
            that._ins_var_9(val);
        }
    }, this);

    this.ins_var_11 = ko.computed({
        'read':function () {
            return that._ins_var_11();
        },
        'write':function (val) {
            that._ins_var_11(val);
        }
    }, this);

    this.ins_var_12 = ko.computed({
        'read':function () {
            return that._ins_var_12();
        },
        'write':function (val) {
            that._ins_var_12(val);
        }
    }, this);

    this.ins_var_3 = ko.computed({
        'read':function () {
            var res = that.ins_var_2() !== '' ? that.ins_var_2() * 0.22 : '';
            that._ins_var_3(num(res));
            return num(res);
        },
        'write':function (val) {
            that._ins_var_3(val);
        }
    }, this);

    this.ins_var_4 = ko.computed({
        'read':function () {
            var res = that.ins_var_2() !== '' ? that.ins_var_2() * 0.029 : '';
            that._ins_var_4(num(res));
            return num(res);
        },
        'write':function (val) {
            that._ins_var_4(val);
        }
    }, this);

    this.ins_var_6 = ko.computed({
        'read':function () {
            var res = that.ins_var_2() !== '' ? that.ins_var_2() * 0.051 : '';
            that._ins_var_6(num(res));
            return num(res);
        },
        'write':function (val) {
            that._ins_var_6(val);
        }
    }, this);

    this.ins_var_7 = ko.computed({
        'read':function () {
            var res = that.ins_var_2() !== '' && that.ins_var_1() !== '' ? that.ins_var_2() * parseFloat(that.ins_var_1()) / 100 : '';
            that._ins_var_7(num(res));
            return num(res);
        },
        'write':function (val) {
            that._ins_var_7(val);
        }
    }, this);

    this.ins_var_10 = ko.computed({
        'read':function () {
            var res = that.ins_var_9() !== '' ? that.ins_var_9() * 0.1 : '';
            that._ins_var_10(num(res));
            return num(res);
        },
        'write':function (val) {
            that._ins_var_10(val);
        }
    }, this);

    this.ins_var_13 = ko.computed({
        'read':function () {
            var res =  parseFloat(that.ins_var_11() != '' ? that.ins_var_11() : 0) * 0.04 +
                parseFloat(that.ins_var_12() != '' ? that.ins_var_12() : 0) * 0.02;
            that._ins_var_13(num(res));
            return num(res);
        },
        'write':function (val) {
            that._ins_var_13(val);
        }
    }, this);


    this.ins_custom = ko.computed({
        'read':function () {

            var v1 = parseFloat(that._ins_var_1() || 0);
            var v2 = parseFloat(that._ins_var_2() || 0);
            var v3 = parseFloat(that._ins_var_3() || 0);
            var v4 = parseFloat(that._ins_var_4() || 0);
            var v5 = parseFloat(that._ins_var_5() || 0);
            var v6 = parseFloat(that._ins_var_6() || 0);
            var v7 = parseFloat(that._ins_var_7() || 0);
            var v8 = parseFloat(that._ins_var_8() || 0);
            var v9 = parseFloat(that._ins_var_9() || 0);
            var v10 = parseFloat(that._ins_var_10() || 0);
            var v11 = parseFloat(that._ins_var_11() || 0);
            var v12 = parseFloat(that._ins_var_12() || 0);
            var v13 = parseFloat(that._ins_var_13() || 0);

            if (!that.ins_c1() && !that.ins_c2()) {
                res = v3 + v4 - v5 + v6 + v7 - v8;
            }
            else if (that.ins_c1() && !that.ins_c2()) {
                res = v3 + v4 - v5 + v6 + v7 - v8 + v10;
            }
            else if (!that.ins_c1() && that.ins_c2()) {
                res = v3 + v4 - v5 + v6 + v7 - v8 + v13;
            }
            else if (that.ins_c1() && that.ins_c2()) {
                res = v3 + v4 - v5 + v6 + v7 - v8 + v10 + v13;
            }

            res = num(res);

            that._ins_custom(res);
            return res;
        },
        'write':function (val) {
            that._ins_custom(val);
        }
    });

    this.ins = ko.computed(function () {
        if (parseInt(this.ins_is_manual()) == -1)return 0;
        return parseInt(this.ins_is_manual()) == 1 ? (this.ins_manual() ? num(this.ins_manual()) : 0) : this._ins_custom();
    }, this);


    this.result = ko.computed(function () {

        return Math.round(this.result_1() ? parseFloat(this.result_1()) : 0) + (this.nds() ? parseFloat(this.nds()) : 0) + parseFloat(this.result_3())
            + parseFloat(this.ins());
    }, this);


    this.prev_year_result = ko.computed(function () {

        var res = this.result() - this.ins();
        var ins = parseInt(this.ins_is_manual()) == 1 ? num(this.ins_manual()) : 0;

        if (!num(this.ins_is_manual())) {
            var var_3 = this._ins_var_2() * 0.22;
            var var_4 = this._ins_var_2() * 0.029;
            var var_6 = this._ins_var_2() * 0.051;

            ins = this.ins() - this._ins_var_3() - this._ins_var_4() - this._ins_var_6() + var_3 + var_4 + var_6;
            ins -= (this.ins_c2() ? parseFloat(that._ins_var_13() || 0) : 0);
        }
        return Math.round(res + ins);

    }, this);


    this.error = ko.computed(function () {

        if (this.isNalogManual() == -1 || this.nds_need() == -1 || this.ins_is_manual() == -1 || this.step3_is_manual() == -1)
            return true;

        if (num(this.nds_need()) == 1 && this.nds_is_manual() == -1)
            return true;

        if (num(this.isNalogManual()) == 1 && !this.nalogManual())
            return true;

        if (num(this.isNalogManual()) == 0 && (!this.var_1_1() || !this.var_1_2()))
            return true;

        if (num(this.nds_need()) == 1) {
            if (num(this.nds_is_manual()) == 1 && !this.nds_manual())
                return true;

            if (num(this.nds_is_manual()) == 0 && this.var_2_1().length == 0)
                return true;
        }

        if (num(this.ins_is_manual()) == 0 &&
            (this.ins_var_1() === '' || this.ins_var_2() === '' ||  this.ins_custom() === ''))
            return true;

        return false;
    }, this);


    this.submit_calc = function () {
        if (this.error()) {
            return false;
        }
        else {
            $('form').submit();
        }
    };
}