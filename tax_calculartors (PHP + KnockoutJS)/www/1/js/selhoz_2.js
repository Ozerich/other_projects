function ViewModel(type) {

    this.type = type;

    // STEP 1

    this.step1_is_manual = ko.observable(rv('step1_is_manual'));
    this.step1_manual = ko.observable(iv('step1_manual'));

    this.var_1_1 = ko.observable(iv('var_1_1'));
    this.var_1_2 = ko.observable(iv('var_1_2'));
    this.var_1_3 = ko.observable(iv('var_1_3'));

    this.var_1_4 = ko.computed(function () {

        var a = this.var_1_1() ? parseFloat(this.var_1_1()) : 0;
        var b = this.var_1_2() ? parseFloat(this.var_1_2()) : 0;
        var c = this.var_1_3() ? parseFloat(this.var_1_3()) : 0;

        return Math.max(num(a - b - c), 0);


    }, this);

    this.step1_custom = ko.computed(function(){
        return num(num(this.var_1_4()) * 0.06);
    }, this);


    this.step1_result = ko.computed(function () {
        if (parseInt(this.step1_is_manual()) == -1)return 0;
        return parseInt(this.step1_is_manual()) == 0 ? this.step1_custom() : (this.step1_manual() ? num(this.step1_manual()) : 0);
    }, this);


    // STEP 3

    this.nds = ko.observable(iv('nds'));


    // STEP  (Insurance)

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
            var res = that.ins_var_2() !== '' ? that.ins_var_2() * (that.type == 1 ? 0.21 : 0.22) : '';
            that._ins_var_3(num(res));
            return num(res);
        },
        'write':function (val) {
            that._ins_var_3(val);
        }
    }, this);

    this.ins_var_4 = ko.computed({
        'read':function () {
            var res = that.ins_var_2() !== '' ? that.ins_var_2() * (that.type == 1 ? 0.024 : 0.029) : '';
            that._ins_var_4(num(res));
            return num(res);
        },
        'write':function (val) {
            that._ins_var_4(val);
        }
    }, this);

    this.ins_var_6 = ko.computed({
        'read':function () {
            var res = that.ins_var_2() !== '' ? that.ins_var_2() * (that.type == 1 ? 0.037 : 0.051) : '';
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

            res = res;

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

        return Math.round(this.step1_result() + (this.nds() ? num(this.nds()) : 0) + this.ins());

    }, this);


    this.prev_year_result = ko.computed(function () {

        var res = this.result() - this.ins();
        var ins = parseInt(this.ins_is_manual()) == 1 ? num(this.ins_manual()) : 0;

        if (!num(this.ins_is_manual())) {
            var var_3 = this.ins_var_2() * 0.16;
            var var_4 = this.ins_var_2() * 0.019;
            var var_6 = this.ins_var_2() * 0.023;

            ins = this.ins() - this._ins_var_3() - this._ins_var_4() - this._ins_var_6() + var_3 + var_4 + var_6;

            ins -= (this.ins_c2() ? parseFloat(that._ins_var_13() || 0) : 0);
        }

        return Math.round(res + ins);

    }, this);





    this.error = ko.computed(function(){

        if(this.step1_is_manual() == -1 || this.ins_is_manual() == -1)
            return true;

        if (num(this.ins_is_manual()) == 0 &&
            (this.ins_var_1() === '' || this.ins_var_2() === '' ||  this.ins_custom() === ''))
            return true;

        return false;
    }, this);

    this.submit_calc = function () {
        if (this.error()) {
            return false;
        }
        else
        {
            $('form').submit();
        }
    };
}