
$(document).ready(function() {
    var path = $('#body').attr('data-path');
    var subpath = $('#body').attr('data-subpath');
    var id = $('#body').attr('data-id');

    switch (path) {
        case 'shop':

            if (subpath == 'UID') {
                var pathEdit = 'product';
                var idEdit = id;
            }
            else if (subpath == 'CID') {
                var pathEdit = 'catalog';
                var idEdit = id;
            }
            break;

        case 'page':

            if (subpath == 'CID') {
                var pathEdit = 'page.catalog';
                var idEdit = id;
            }
            else {
                var pathEdit = 'page';
                var idEdit = id;
            }
            break;

        case 'index':
            var pathEdit = 'page';
            var idEdit = id;
            break;


        default:
            if (id > 0) {
                var pathEdit = path;
                var idEdit = id;
            }

    }

    // ������ ������
    if (pathEdit !== undefined && idEdit !== undefined)
        $('#adminModalHelp').show();

    $(".openAdminModal").on('click', function() {
        $('.admin-modal-content').attr('height',$(window).height()-150);
        var frame = $('.admin-modal-content').attr('src');

        if (frame === undefined){
            $('.progress-bar').css('width', '30%');
            $('.admin-modal-content').attr('src', '/phpshop/admpanel/admin.php?path=' + pathEdit + '&id=' + idEdit + '&frame=true');
            $('.progress-bar').css('width', '40%');
        }

        $('#adminModal').modal('toggle');

    });

    // Editor � ��������� ����
    $('#editorwindow').on('click', function() {
        var url = $('.admin-modal-content').attr('src');
        filemanager = window.open(url.split('&frame').join(''));
        filemanager.focus();
        $('#adminModal').modal('hide');
    });


    // ���������� ������� ����
    $('#collapseCSS,#collapseAdmin').on('hide.bs.collapse', function() {
        $('[data-parent="'+$(this).attr('id')+'"]').toggleClass('glyphicon-menu-down').toggleClass('glyphicon-menu-up');
        
        $.cookie('style_collapse_'+$(this).attr('id'), 'enabled', {
                path: '/'
            });
    });
    
    // ���������� ������� ����
    $('#collapseCSS,#collapseAdmin').on('show.bs.collapse', function() {
        $('[data-parent="'+$(this).attr('id')+'"]').toggleClass('glyphicon-menu-down').toggleClass('glyphicon-menu-up');
        $.removeCookie('style_collapse_'+$(this).attr('id'), {
                path: '/'
            });
    });
    
    // �olorpicker
    if ($('.color').length) {
        $('.color').colorpicker({format: 'hex'});


        // �olorpicker Live
        $('.color').colorpicker().on('changeColor', function(e) {
            var el = $(this).find('.color-value').attr('data-option');
            var name = $(this).find('.color-value').attr('name');
            $(el).css('cssText', name + ':' + e.color.toHex() + ' !important');
        });

    }

    // ���������� ���������� c �olorpicker
    $(".saveTheme").on('click', function() {

        var data = 'type=json&parser=css&';
        $('.color-value').each(function() {
            data += 'color[' + $(this).attr('id').split('color-').join('') + '][' + $(this).attr('name') + ']=' + $(this).val() + '&';
        });

        $.ajax({
            url: ROOT_PATH + '/phpshop/ajax/skin.php',
            type: 'post',
            data: data,
            dataType: 'json',
            success: function(json) {
                if (json['success']) {
                    showAlertMessage(json['status']);
                }
            }
        });
    });

    // ����� ����������
    $(".bootstrap-theme").on('click', function() {
        $.cookie($('#bootstrap_theme').attr('data-name') + '_theme', $(this).attr('data-skin'), {
            path: '/'
        });

        setTimeout(function() {

            $('#body').fadeIn("slow", window.location.reload());
            //$('.color').colorpicker('update');
            //$('.color').colorpicker('reposition');

        }, 1000);


    });

    $("#color-slide").slider({
        range: false,
        step: 5,
        min: 0,
        max: 360,
        values: [$("#color-slide").attr('data-option')],
        slide: function(event, ui) {
            $($(".color-filter").attr('data-option')).css('cssText', 'filter: hue-rotate(' + ui.values[0] + 'deg) !important');
            $(".color-filter").val(ui.values[0]);
        }
    });


    $('#style-selector .style-toggle').click(function(e) {
        e.preventDefault();
        if ($(this).hasClass('ss-close')) {
            $(this).removeClass('ss-close');
            $(this).addClass('ss-open');
            $('#style-selector').animate({'right': '-' + $('#style-selector').width() + 'px'}, 'slow');

            $.cookie('style_selector_status', 'disabled', {
                path: '/'
            });
        } else {
            $(this).removeClass('ss-open');
            $(this).addClass('ss-close');
            $('#style-selector').animate({'right': '0px'}, 'slow');

            $.cookie('style_selector_status', 'enabled', {
                path: '/'
            });
        }
    });

});

