/**
 * Created by mero.push on 01.02.2015.
 */


;
(function($) {

    $.fn.airStickyBlock = function(options) {
        $.airStickyBlock = function($this, options) {
            // ��������� ����������
            var settings,
                stopBlock,
                stickyParent,
                windowHeight,
                stopBlockHeight,
                stopBlockWidth,
                stopBlockOffset,
                stickyParentOffset,
                stickyParentWidth,
                stickyHeight,
                stickyWidth,
                stickyStop,
                stickyStart,
                stickyAbsolute,
                scrollTop;

            /** ��������� */
            // ��������� �� ���������
            settings = $.extend({
                debug: false,
                stopBlock: '.airSticky_stop-block',
                offsetTop: 0
            }, options);
            // Sticky Stop Block
            stopBlock = $(settings.stopBlock);
            // �������
            stickyParent = $this.parent();

            /**
             * ������������� ��� ����������
             * (����������� ��� ��������� ������� ���� ��������, ���������� �������)
             */
            function setAmount() {
                /* ������ */
                // ������ ������� �������
                windowHeight = $(window).height();

                /**
                 * Sticky Stop Block
                 * ������������ ���� ��� �������� � ������� � ������� ����� Sticky Block,
                 * Sticky Block ����������� �� ���������� ���� ����� �����
                 */
                // ������
                stopBlockHeight = stopBlock.height();
                // ������
                stopBlockWidth = stopBlock.width();
                // ������ �� ������ ���������
                stopBlockOffset = stopBlock.offset().top;

                /**
                 * Sticky Parent Block
                 * ���� � ������� ��������� Sticky Block (�������)
                 */
                // ������ ��������
                stickyParentWidth = stickyParent.width();
                // ������ �������� �� ������ ���������
                stickyParentOffset = stickyParent.offset().top;

                /**
                 * Sticky Block
                 * ���� ������� ����� ������������� ��� ���������
                 */
                // ������ Sticky Block
                stickyHeight = $this.outerHeight(true);
                // ������ Sticky Block
                stickyWidth = stickyParentWidth;
                // ������ ��������� Sticky Block
                stickyStop = stopBlockHeight + stopBlockOffset - stickyHeight;
                // ������ Sticky Block �� ������ ���������
                stickyStart = stickyParentOffset;
                // ������ Sticky Block �� ������ �������� ��� ���������� ����������������
                stickyAbsolute = stickyStop - stickyParentOffset;
            }
            setAmount();

            /**
             * ���������� �������
             */
            function airStickyGo() {
                // ��������� �� ������ ���������
                scrollTop = $(window).scrollTop() + settings.offsetTop;
                if (settings.debug) {
                    console.clear();

                    console.warn('airStickyBlock debugger \n');
                    var debugTable = {
                        'windowHeight': { value: windowHeight },
                        'stopBlockHeight': { value: stopBlockHeight },
                        'stopBlockWidth': { value: stopBlockWidth },
                        'stopBlockOffset': { value: stopBlockOffset },
                        'stickyParentOffset': { value: stickyParentOffset },
                        'stickyParentWidth': { value: stickyParentWidth },
                        'stickyHeight': { value: stickyHeight },
                        'stickyWidth': { value: stickyWidth },
                        'stickyStop': { value: stickyStop },
                        'stickyStart': { value: stickyStart },
                        'stickyAbsolute': { value: stickyAbsolute },
                        'scrollTop': { value: scrollTop }
                    };
                    console.table(debugTable);
                }

                // ���� ��������� ������ ��� ������ Sticky Block �� ������ ���������
                if (scrollTop >= stickyStart && scrollTop <= stickyStop) {
                    setPosition('fixed');
                } else if ($this.css('position') != 'relative') {
                    setDefault(stickyParent);
                    setPosition('relative');
                }

                // ���� ��������� ������ ��� �������� ������� ��������� Sticky Block
                if (scrollTop >= stickyStart && scrollTop >= stickyStop) {
                    setPosition('absolute');
                }
                if (scrollTop > stickyStop + stickyHeight) {
                    setPosition('relative');
                }

            }
            airStickyGo();

            function setDefault(element) { element.removeAttr('style'); }

            function setPosition(position) {
                switch (position) {
                    case 'fixed':
                        $this.css({
                            'position': position,
                            'top': settings.offsetTop + 'px'
                        }).removeClass('airSticky_absolute airSticky_relative').addClass('airSticky_fixed');
                        break;
                    case 'absolute':
                        $this.css({
                            'position': position,
                            'top': stickyAbsolute + 'px'
                        }).removeClass('airSticky_fixed airSticky_relative').addClass('airSticky_absolute');
                        break;
                    case 'relative':
                        $this.css({
                            'position': 'relative',
                            'top': 'auto'
                        }).removeClass('airSticky_fixed airSticky_absolute').addClass('airSticky_relative');
                        break;
                }
            }

            function setWidthSticky() {
                $this.css({
                    'width': stickyWidth + 'px'
                });
            }
            setWidthSticky();

            /**
             * �����������
             */
            function render() {
                setDefault($this);
                setAmount();
                if (stickyStop > stickyStart && stopBlockWidth > stickyWidth) {
                    setWidthSticky();
                    airStickyGo();
                }
            }

            /**
             * ��������� �������
             */
            $(window).bind('resize.airStickyBlock scroll.airStickyBlock orientationchange.airStickyBlock', function(event) {

                if (event.type == 'scroll' && stickyStop > stickyStart && stopBlockWidth > stickyWidth) {
                    airStickyGo();
                } else {
                    render();
                }

            });

            /**
             * ���� ���������� �����������
             */
            $(window).bind('render.airStickyBlock', function(event) {
                render();
            });

        };

        return this.each(function() {
            (new $.airStickyBlock($(this), options));
        });

    };

})(jQuery);