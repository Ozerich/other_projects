function Calendar(_block) {

    this.block = _block;

    this.monthNames = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

    this.currentMonth = new Date().getMonth();
    this.currentYear = new Date().getFullYear();

    this.getDay = function (date) {
        return date.getDay() == 0 ? 7 : date.getDay();
    };

    this.html = function (day_num, month_state, bullet) {
        var klass = month_state == 1 ? 'next' : (month_state == -1 ? 'previous' : '');

        bullet = bullet || false;

        var bullet_html = bullet ? '<div class="bullet bullet-' + bullet + '"></div>' : '';

        return '<div class="day ' + klass + '">' + bullet_html + day_num + "</div>";
    };

    this.updateMonth = function () {

        var html = '';
        var firstDay = new Date(this.currentYear, this.currentMonth, 1);
        var lastDay = new Date(this.currentYear, this.currentMonth + 1, 0);
        var prevMonthDaysCount = new Date(this.currentYear, this.currentMonth, 0).getDate();
        var monthDaysCount = lastDay.getDate();

        for (var i = this.getDay(firstDay) - 2; i >= 0; i--) {
            html += this.html(prevMonthDaysCount - i, -1);
        }

        for (var i = 1; i <= monthDaysCount; i++) {
            html += this.html(i, 0, i % 5 === 0 ? 'red' : (i % 6 === 0 ? 'blue' : false));
        }

        for (var i = this.getDay(lastDay); i < 7; i++) {
            html += this.html(i, 1);
        }

        $(this.block).find('.days').html(html);
        $(this.block).find('.month-name').html(this.monthNames[this.currentMonth] + ' ' + this.currentYear);

    };

    this.Go = function (step) {
        this.currentMonth += step;

        if (this.currentMonth < 0) {
            this.currentMonth = 11;
            this.currentYear--;
        }

        if (this.currentMonth > 11) {
            this.currentMonth = 0;
            this.currentYear++;
        }

        this.updateMonth();
    };


    this.updateMonth();
}


$(function () {
    if ($("#calendar").length == 0)return;

    var calendar = new Calendar($('#calendar'));

    $('#calendar .arrow-left').click(function () {
        calendar.Go(-1);
        return false;
    });

    $('#calendar .arrow-right').click(function () {
        calendar.Go(1);
        return false;
    });

});