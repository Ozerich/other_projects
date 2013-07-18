var Folders = {

    selectedFolderId:null,

    init:function () {

        var $tree = $('#advert_tree');

        $tree.find('.plus').live('click', Folders.addFolder);
        $tree.find(' .folder > a').live('click', Folders.clickFolder);

        var $folder = $('#folder_content');

        $folder.find('.icon-folder-delete').live('click', Folders.clickDeleteFolder);
        $folder.find('.icon-folder-edit').live('click', Folders.clickEditFolder);
        $folder.find('.icon-folder-save').live('click', Folders.clickSaveFolder);

        $folder.find('.checkbox-cell').find('input[type=checkbox]').live('click', Folders.clickCheckbox);
        $folder.find('#folder_move_submit').live('click', Folders.clickMove);
    },

    clickCheckbox:function () {
        var $folderMoveBlock = $('.folder-move-block');

        if ($('.checkbox-cell').find('input:checked').length > 0) {
            $folderMoveBlock.show();
        }
        else {
            $folderMoveBlock.hide();
        }
    },

    clickMove:function () {
        var $btn = $(this);
        if ($btn.hasClass('disabled')) {
            return false;
        }

        var btnLabel = $btn.html();
        var $folder = $('#folder_content');
        var items = $folder.find('tr');

        var folder_id = $('.folder-move-block').find('option:selected').val();
        if (folder_id == '-') {
            return false;
        }

        $btn.addClass('disabled').html('Подождите...');

        var items_param = '';
        $('.checkbox-cell').find('input:checked').each(function () {
            items_param += (items ? ',' : '') + $(this).data('id');
        });

        $.ajax({
            url:'/move',
            type:'post',
            data:{folder:folder_id, items:items_param},
            complete:function () {
                $btn.removeClass('disabled').html(btnLabel);
            },
            success:function (data) {
                if (data == '0') {

                    $folder.find('tr').each(function () {
                        if ($(this).find('.checkbox-cell input:checked').length > 0) {
                            $(this).hide();
                        }
                    });

                    $('.folder-move-block').hide();

                    Folders.openFolderTree(folder_id);
                    Folders.loadFolder(folder_id);
                }
            }
        });


        return false;
    },

    loadFirst:function () {
        Folders.selectedFolderId = -1;
        var firstFolder = $('#advert_tree').find('.folder').first();
        if (!firstFolder)return;

        Folders.loadFolder(firstFolder.data('id'));
    },

    getTreeFolder:function (id) {
        id = id === undefined ? Folders.selectedFolderId : id;

        return $('#advert_tree').find('.folder[data-id=' + id + ']');
    },

    openFolderTree:function (id) {
        var $folder = Folders.getTreeFolder(id);
        var isRoot = $folder.parent().hasClass('project');

        if (isRoot) {
            $folder.find('ul').slideToggle();
            $folder.addClass('open');
        }
        else {
            var $parent = $folder.parents('.folder');
            $parent.addClass('open');
            $parent.find('ul').slideToggle();
        }

    },

    loadFolder:function (id, first) {
        first = first === undefined ? false : first;

        if (id === Folders.selectedFolderId && !first)return;

        if (first) {
            Folders.openFolderTree(id);
        }

        $('#btn_new_advert').attr('href', '/item?folder=' + id);

        var $folder = Folders.getTreeFolder(id);
        var $loader = $folder.find('.loader').first();
        var $tree = $('#advert_tree');

        $('.page-loader-background').show();
        $('.folder-move-block').hide();


        $tree.find('li').removeClass('selected');
        $folder.addClass('selected');

        Folders.selectedFolderId = id;

        $tree.find('.folder > .loader').hide();
        $loader.show();

        $.ajax({
            url:'/load_folder',
            type:'post',
            data:{
                id:$folder.data('id')
            },
            complete:function () {
                $loader.hide();
                $('.page-loader-background').hide();
            },
            success:function (data) {
                $('#folder_content').find('.folder-list').html(data)
                if (data.length > 10) {
                }
            }
        });
    },

    addFolderToDom:function (id, name, parent) {
        parent = parent || 0;

        var $tree = $('#advert_tree');

        var folderHtml = '<li class="folder" data-id=' + id + '><a href="#">' + name + '</a><i class="loader"></i>';
        if (parent == 0) {
            folderHtml += '<ul style="display: none"><li><input type="text" placeholder="Создать папку" class="dob"/><span class="plus"></span><i class="loader"></i></li></ul>';
        }

        if (parent == 0) {
            $(folderHtml).insertBefore($tree.find('.new-folder-line'));
        }
        else {
            $(folderHtml).insertBefore($tree.find('.folder[data-id=' + parent + '] ul li:last-child'));
        }
    },

    addFolder:function () {
        var $btn = $(this);
        var $loader = $btn.next();
        var $input = $btn.prev();

        $input.removeClass('error');

        if ($input.val().length === 0) {
            $input.addClass('error');
            return false;
        }

        $input.attr('disabled', 'disabled');
        $btn.hide();
        $loader.show();

        var parent = $btn.parents('.folder').length > 0 ? $btn.parents('.folder').data('id') : 0;

        $.ajax({
            url:'/add_folder',
            type:'post',
            data:{
                name:$input.val(),
                parent:parent
            },
            complete:function () {
                $btn.show();
                $loader.hide();
                $input.removeAttr('disabled');
            },
            success:function (id) {
                if (id) {
                    Folders.addFolderToDom(id, $input.val(), parent);
                    $input.val('');
                }
            }
        });

        return false;
    },

    clickFolder:function () {
        var $folder = $(this).parent();

        $folder.toggleClass('open');

        var isRoot = $folder.parent().hasClass('project');

        if (isRoot) {
            $folder.find('ul').slideToggle();
        }

        Folders.loadFolder($folder.data('id'));

        return false;
    },

    clickEditFolder:function () {
        var $row = $(this).parents('.folder-title');

        $row.find('.icon-folder-edit, .icon-folder-delete').hide();
        $row.find('.icon-folder-save, .new-folder-name').show();

        return false;
    },

    clickSaveFolder:function () {
        var $folderInput = $('.new-folder-name');
        var name = $folderInput.val();

        $folderInput.removeClass('error');
        if (name.length === 0) {
            $folderInput.addClass('error');
            return false;
        }

        var $row = $(this).parents('.folder-title');

        $row.find('.icon-folder-save, .new-folder-name').hide();
        $row.find('.icon-folder-edit, .icon-folder-delete').show();

        $('.folder-name').html(name);
        Folders.getTreeFolder().find('> a').html(name);

        $.post('/save_folder', {id:Folders.selectedFolderId, name:name});

        return false;
    },

    clickDeleteFolder:function () {

        if (confirm('Вы уверены, что хотите удалить папку?')) {
            $.post('/delete_folder', {id:Folders.selectedFolderId});

            var $treeFolder = Folders.getTreeFolder();

            $('#folder_content').empty();
            $treeFolder.remove();

            if ($treeFolder.parents('.folder').length > 0) {
                Folders.loadFolder($treeFolder.parents('.folder').data('id'));
            }
            else {
                Folders.loadFirst();
            }

        }

        return false;
    }

};
Folders.init();