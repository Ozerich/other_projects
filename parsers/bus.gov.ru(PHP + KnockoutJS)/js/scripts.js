var DataPoint = {
    request: function (cmd, params, callback, errorCallback) {
        $.post('/php/ajax.php?cmd=' + cmd, params, function (data) {
            if (callback !== undefined) {
                callback(jQuery.parseJSON(data));
            }
        }, errorCallback);
    },

    GetFilterData: function (callback, errorCallback) {
        this.request('GetFilterData', {}, callback, errorCallback);
    },

    ParseCity: function (type, okrug, subjects, cities, callback) {
        this.request('ParseCity', {
            'type': type,
            'okrug': okrug,
            'subjects': subjects,
            'cities': cities,
        }, callback);
    },

    ParseItem: function (item_id, file, callback) {
        this.request('ParseItem', {id: item_id, file: file}, callback);
    },

    CheckDoneCity: function (task, callback) {
        this.request('CheckDoneCity', {
            okrug: task.okrug,
            type: task.type,
            subjects: task.subjects,
            cities: task.cities,
            start_time: task.time_start,
            file: task.file,
            count: task.all_count(),
        }, callback);
    },

    GetHistory: function (callback) {
        this.request('GetHistory', {}, callback);
    },

    DeleteFile: function (file, callback) {
        this.request('DeleteFile', {file: file}, callback);
    },

    CreateSession: function () {
        this.request("CreateSession");
    },

    DestroySession: function () {
        this.request("DestroySession");
    },

    CheckSession: function (callback) {
        this.request("CheckSession", {}, callback);
    }
};

var HISTORY_ITEMS_PER_PAGE = 3;

function Task() {

    this.time_start = 0;
    this.file = '';

    this.okrug = null;
    this.type = null;

    this.subjects = [];
    this.cities = [];

    this.subjects_str = function () {
        var result = [];

        for (var i = 0; i < this.subjects.length; i++) {
            result.push(this.subjects[i].label);
        }

        return  result.length > 0 ? result.join(', ') : '-';
    };

    this.cities_str = function () {
        var result = [];

        for (var i = 0; i < this.cities.length; i++) {
            result.push(this.cities[i].label);
        }

        return result.length > 0 ? result.join(', ') : '-';
    };


    this.all_count = ko.observable(0);
    this.parsed_count = ko.observable(0);

    this.load_status = ko.observable(0);

    this.progress = ko.computed(function () {

        if (this.load_status() === 0)return '-';
        if (this.load_status() === 1)return '...';

        return this.parsed_count() + '/' + this.all_count();

    }, this);
}

function ViewModel() {
    var that = this;

    this.cities_select = null;
    this.okrugs_select = null;
    this.subjects_select = null;
    this.types_select = null;

    this.filter_data = [];
    this.city_subject_map = {};
    this.subject_okrug_map = {};


    // Флаг о видимости формы добавления задачи
    this.task_form_visible = ko.observable(false);

    // Флаг о видимости списка добавленных задач
    this.tasks_list_visible = ko.observable(true);

    // Нажатие на кнопку "Добавить задачу"
    this.add_task_click = function () {
        this.task_form_visible(true);

        if (that.cities_select) {
            that.cities_select.reset();
            that.subjects_select.reset();
            that.types_select.reset();
            that.okrugs_select.reset();
        }
    };

    // Нажатие на кнопку "Отменить" в форме добавления задачи
    this.cancel_task_form_click = function () {
        this.task_form_visible(false);
        this.tasks_list_visible(true);
    };

    // Добавленные задачи
    this.tasks = ko.observableArray();


    // Нажатие на кнопку "Добавить" в форме добавления задачи
    this.submit_task_form_click = function () {

        var okrug = this.okrugs_select.getSelected();
        var subjects = this.subjects_select.getSelected();
        var cities = this.cities_select.getSelected();
        var type = this.types_select.getSelected();

        var task = new Task;

        task.okrug = okrug;
        task.type = type;

        for (var i = 0; i < subjects.length; i++) {
            task.subjects.push(subjects[i]);
        }

        for (var i = 0; i < cities.length; i++) {
            task.cities.push(cities[i]);
        }

        this.tasks.push(task);

        this.task_form_visible(false);
        this.tasks_list_visible(true);
    };


    this.in_progress = ko.observable(false);

    this.start_click = function () {
        this.in_progress(true);
        DataPoint.CheckSession(function (state) {
            if (state == 1) {
                alert('Сервис уже используется.');
                that.in_progress(false);
                return false;
            }

            DataPoint.CreateSession();

            that.tasks(ko.utils.arrayFilter(that.tasks(), function (item) {
                return item.load_status() == 0;
            }));

            var task_ind = 0;

            var parseCity = function (ind) {

                if (ind >= that.tasks().length || !that.in_progress()) {
                    that.in_progress(false);
                    DataPoint.DestroySession();
                    return;
                }

                var task = that.tasks()[ind];

                task.load_status(1);

                DataPoint.ParseCity(task.type, task.okrug, task.subjects, task.cities, function (data) {
                    task.load_status(2);
                    task.time_start = data.start_time;
                    task.file = data.file;
                    data = data.ids;
                    task.all_count(data.length);

                    var parseItem = function (item_ind) {

                        if (item_ind >= data.length) {

                            DataPoint.CheckDoneCity(task, function () {
                                that.updateList();

                                that.tasks(ko.utils.arrayFilter(that.tasks(), function (item) {
                                    return item.load_status() == 0 || item.parsed_count() < item.all_count();
                                }));

                                parseCity(0);
                            });

                            return;
                        }

                        if (!that.in_progress())return;
                        DataPoint.ParseItem(data[item_ind], task.file, function (data) {
                            task.parsed_count(task.parsed_count() + 1);

                            parseItem(item_ind + 1);
                        });
                    };

                    parseItem(0);

                });
            };

            parseCity(0);
        });
    };


    this.stop_click = function () {
        this.in_progress(false);

        DataPoint.DestroySession();
    };


    this.loading_filter = ko.observable(true);
    DataPoint.GetFilterData(function (data) {

        that.filter_data = data;

        for (var i = 0; i < data.okrugs.length; i++) {
            for (var j = 0; j < data.okrugs[i].subjects.length; j++) {
                that.subject_okrug_map[data.okrugs[i].subjects[j].id] = data.okrugs[i];
                for (var z = 0; z < data.okrugs[i].subjects[j].cities.length; z++) {
                    that.city_subject_map[data.okrugs[i].subjects[j].cities[z].id] = data.okrugs[i].subjects[j];
                }
            }
        }


        that.types_select = $('#types_select').select({
            data: data.types
        });

        var okrugs = [];
        for (var i = 0; i < data.okrugs.length; i++) {
            okrugs.push({id: data.okrugs[i].id, label: data.okrugs[i].label});
        }

        that.cities_select = $('#cities_select').manyselect({
            data: [],
            placeholder: 'Выберите один или несколько муниципальных районов',
        });

        that.subjects_select = $('#subjects_select').manyselect({
            data: [],
            placeholder: 'Выберите один или несколько субъектов Российской Федерации',
            onChange: function (selectedData) {
                that.cities_select.reset();
                var cities = [];

                for (var i = 0; i < data.okrugs.length; i++) {
                    for (var j = 0; j < data.okrugs[i].subjects.length; j++) {
                        var subject = data.okrugs[i].subjects[j];

                        var found = false;

                        for (var z = 0; z < selectedData.length; z++) {
                            if (selectedData[z].id == subject.id) {
                                found = true;
                                break;
                            }
                        }

                        if (!found)continue;

                        for (var z = 0; z < subject.cities.length; z++) {
                            cities.push({id: subject.cities[z].id, label: subject.cities[z].label});
                        }
                    }
                }

                that.cities_select.setData(cities);
            }
        });


        that.okrugs_select = $('#okrugs_select').select({
            data: okrugs,
            onChange: function (okrug_id) {

                that.subjects_select.reset();
                that.cities_select.reset();

                var subjects = [];

                for (var i = 0; i < data.okrugs.length; i++) {
                    if (data.okrugs[i].id === okrug_id) {

                        for (var j = 0; j < data.okrugs[i].subjects.length; j++) {
                            subjects.push({id: data.okrugs[i].subjects[j].id, label: data.okrugs[i].subjects[j].label});
                        }

                        break;
                    }
                }

                that.subjects_select.setData(subjects);
            }
        });

        that.loading_filter(false);
    });


    this.loading_list = ko.observable(false);
    this.history_items = ko.observableArray();

    this.history_page = ko.observable(1);

    this.history_items_paged = ko.computed(function () {
        var start = (that.history_page() - 1) * HISTORY_ITEMS_PER_PAGE;
        var finish = Math.min(that.history_items().length, start + HISTORY_ITEMS_PER_PAGE) - 1;

        var res = [];

        for (var i = start; i <= finish; i++) {
            if (this.history_items()[i]) {
                res.push(this.history_items()[i]);
            }
        }
        return res;
    }, this);

    this.history_pages_count = ko.computed(function () {
        return Math.floor((this.history_items().length - 1) / HISTORY_ITEMS_PER_PAGE) + 1;
    }, this);

    this.history_pages = ko.computed(function () {
        var res = [];
        for (var i = 0; i < this.history_pages_count(); i++) {
            res.push(i + 1);
        }
        return res;
    }, this);

    this.updateList = function () {
        this.loading_list(true);

        DataPoint.GetHistory(function (data) {

            that.history_items([]);

            for (var i in data) {
                var item = data[i];
                that.history_items.push(item);
            }

            that.loading_list(false);
        });
    };

    this.updateList();


    this.deleteFile = function (file) {
        if (!confirm('Уверены?'))return false;

        DataPoint.DeleteFile(file.url, function () {
            that.updateList();
        });
    };


    $(window).unload(function () {
        if (that.in_progress()) {
            DataPoint.DestroySession();
        }
    });
}


$(function () {
    ko.applyBindings(new ViewModel());
});