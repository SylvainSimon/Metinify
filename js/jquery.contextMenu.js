/*!
 * jQuery contextMenu - Plugin for simple contextMenu handling
 *
 * Version: 1.6.5
 *
 * Authors: Rodney Rehm, Addy Osmani (patches for FF)
 * Web: http://medialize.github.com/jQuery-contextMenu/
 *
 * Licensed under
 *   MIT License http://www.opensource.org/licenses/mit-license
 *   GPL v3 http://opensource.org/licenses/GPL-3.0
 *
 */

(function($, undefined){
    
    // TODO: -
    // ARIA stuff: menuitem, menuitemcheckbox und menuitemradio
    // create <menu> structure if $.support[htmlCommand || htmlMenuitem] and !opt.disableNative

    // determine html5 compatibility
    $.support.htmlMenuitem = ('HTMLMenuItemElement' in window);
    $.support.htmlCommand = ('HTMLCommandElement' in window);
    $.support.eventSelectstart = ("onselectstart" in document.documentElement);
    /* // should the need arise, test for css user-select
$.support.cssUserSelect = (function(){
    var t = false,
        e = document.createElement('div');
    
    $.each('Moz|Webkit|Khtml|O|ms|Icab|'.split('|'), function(i, prefix) {
        var propCC = prefix + (prefix ? 'U' : 'u') + 'serSelect',
            prop = (prefix ? ('-' + prefix.toLowerCase() + '-') : '') + 'user-select';
            
        e.style.cssText = prop + ': text;';
        if (e.style[propCC] == 'text') {
            t = true;
            return false;
        }
        
        return true;
    });
    
    return t;
})();
*/

    if (!$.ui || !$.ui.widget) {
        // duck punch $.cleanData like jQueryUI does to get that remove event
        // https://github.com/jquery/jquery-ui/blob/master/ui/jquery.ui.widget.js#L16-24
        var _cleanData = $.cleanData;
        $.cleanData = function( elems ) {
            for ( var i = 0, elem; (elem = elems[i]) != null; i++ ) {
                try {
                    $( elem ).triggerHandler( "remove" );
                // http://bugs.jquery.com/ticket/8235
                } catch( e ) {}
            }
            _cleanData( elems );
        };
    }

    var // currently active contextMenu trigger
    $currentTrigger = null,
    // is contextMenu initialized with at least one menu?
    initialized = false,
    // window handle
    $win = $(window),
    // number of registered menus
    counter = 0,
    // mapping selector to namespace
    namespaces = {},
    // mapping namespace to options
    menus = {},
    // custom command type handlers
    types = {},
    // default values
    defaults = {
        // selector of contextMenu trigger
        selector: null,
        // where to append the menu to
        appendTo: null,
        // method to trigger context menu ["right", "left", "hover"]
        trigger: "right",
        // hide menu when mouse leaves trigger / menu elements
        autoHide: false,
        // ms to wait before showing a hover-triggered context menu
        delay: 200,
        // flag denoting if a second trigger should simply move (true) or rebuild (false) an open menu
        // as long as the trigger happened on one of the trigger-element's child nodes
        reposition: true,
        // determine position to show menu at
        determinePosition: function($menu) {
            // position to the lower middle of the trigger element
            if ($.ui && $.ui.position) {
                // .position() is provided as a jQuery UI utility
                // (...and it won't work on hidden elements)
                $menu.css('display', 'block').position({
                    my: "center top",
                    at: "center bottom",
                    of: this,
                    offset: "0 5",
                    collision: "fit"
                }).css('display', 'none');
            } else {
                // determine contextMenu position
                var offset = this.offset();
                offset.top += this.outerHeight();
                offset.left += this.outerWidth() / 2 - $menu.outerWidth() / 2;
                $menu.css(offset);
            }
        },
        // position menu
        position: function(opt, x, y) {
            var $this = this,
            offset;
            // determine contextMenu position
            if (!x && !y) {
                opt.determinePosition.call(this, opt.$menu);
                return;
            } else if (x === "maintain" && y === "maintain") {
                // x and y must not be changed (after re-show on command click)
                offset = opt.$menu.position();
            } else {
                // x and y are given (by mouse event)
                offset = {
                    top: y, 
                    left: x
                };
            }
            
            // correct offset if viewport demands it
            var bottom = $win.scrollTop() + $win.height(),
            right = $win.scrollLeft() + $win.width(),
            height = opt.$menu.height(),
            width = opt.$menu.width();
            
            if (offset.top + height > bottom) {
                offset.top -= height;
            }
            
            if (offset.left + width > right) {
                offset.left -= width;
            }
            
            opt.$menu.css(offset);
        },
        // position the sub-menu
        positionSubmenu: function($menu) {
            if ($.ui && $.ui.position) {
                // .position() is provided as a jQuery UI utility
                // (...and it won't work on hidden elements)
                $menu.css('display', 'block').position({
                    my: "left top",
                    at: "right top",
                    of: this,
                    collision: "flipfit fit"
                }).css('display', '');
            } else {
                // determine contextMenu position
                var offset = {
                    top: 0,
                    left: this.outerWidth()
                };
                $menu.css(offset);
            }
        },
        // offset to add to zIndex
        zIndex: 1,
        // show hide animation settings
        animation: {
            duration: 50,
            show: 'slideDown',
            hide: 'slideUp'
        },
        // events
        events: {
            show: $.noop,
            hide: $.noop
        },
        // default callback
        callback: null,
        // list of contextMenu items
        items: {}
    },
    // mouse position for hover activation
    hoveract = {
        timer: null,
        pageX: null,
        pageY: null
    },
    // determine zIndex
    zindex = function($t) {
        var zin = 0,
        $tt = $t;

        while (true) {
            zin = Math.max(zin, parseInt($tt.css('z-index'), 10) || 0);
            $tt = $tt.parent();
            if (!$tt || !$tt.length || "html body".indexOf($tt.prop('nodeName').toLowerCase()) > -1 ) {
                break;
            }
        }
        
        return zin;
    },
    // event handlers
    handle = {
        // abort anything
        abortevent: function(e){
            e.preventDefault();
            e.stopImmediatePropagation();
        },
        
        // contextmenu show dispatcher
        contextmenu: function(e) {
            var $this = $(this);
            
            // disable actual context-menu
            e.preventDefault();
            e.stopImmediatePropagation();
            
            // abort native-triggered events unless we're triggering on right click
            if (e.data.trigger != 'right' && e.originalEvent) {
                return;
            }
            
            // abort event if menu is visible for this trigger
            if ($this.hasClass('context-menu-active')) {
                return;
            }
            
            if (!$this.hasClass('context-menu-disabled')) {
                // theoretically need to fire a show event at <menu>
                // http://www.whatwg.org/specs/web-apps/current-work/multipage/interactive-elements.html#context-menus
                // var evt = jQuery.Event("show", { data: data, pageX: e.pageX, pageY: e.pageY, relatedTarget: this });
                // e.data.$menu.trigger(evt);
                
                $currentTrigger = $this;
                if (e.data.build) {
                    var built = e.data.build($currentTrigger, e);
                    // abort if build() returned false
                    if (built === false) {
                        return;
                    }
                    
                    // dynamically build menu on invocation
                    e.data = $.extend(true, {}, defaults, e.data, built || {});

                    // abort if there are no items to display
                    if (!e.data.items || $.isEmptyObject(e.data.items)) {
                        // Note: jQuery captures and ignores errors from event handlers
                        if (window.console) {
                            (console.error || console.log)("No items specified to show in contextMenu");
                        }
                        
                        throw new Error('No Items sepcified');
                    }
                    
                    // backreference for custom command type creation
                    e.data.$trigger = $currentTrigger;
                    
                    op.create(e.data);
                }
                // show menu
                op.show.call($this, e.data, e.pageX, e.pageY);
            }
        },
        // contextMenu left-click trigger
        click: function(e) {
            e.preventDefault();
            e.stopImmediatePropagation();
            $(this).trigger($.Event("contextmenu", {
                data: e.data, 
                pageX: e.pageX, 
                pageY: e.pageY
            }));
        },
        // contextMenu right-click trigger
        mousedown: function(e) {
            // register mouse down
            var $this = $(this);
            
            // hide any previous menus
            if ($currentTrigger && $currentTrigger.length && !$currentTrigger.is($this)) {
                $currentTrigger.data('contextMenu').$menu.trigger('contextmenu:hide');
            }
            
            // activate on right click
            if (e.button == 2) {
                $currentTrigger = $this.data('contextMenuActive', true);
            }
        },
        // contextMenu right-click trigger
        mouseup: function(e) {
            // show menu
            var $this = $(this);
            if ($this.data('contextMenuActive') && $currentTrigger && $currentTrigger.length && $currentTrigger.is($this) && !$this.hasClass('context-menu-disabled')) {
                e.preventDefault();
                e.stopImmediatePropagation();
                $currentTrigger = $this;
                $this.trigger($.Event("contextmenu", {
                    data: e.data, 
                    pageX: e.pageX, 
                    pageY: e.pageY
                }));
            }
            
            $this.removeData('contextMenuActive');
        },
        // contextMenu hover trigger
        mouseenter: function(e) {
            var $this = $(this),
            $related = $(e.relatedTarget),
            $document = $(document);
            
            // abort if we're coming from a menu
            if ($related.is('.context-menu-list') || $related.closest('.context-menu-list').length) {
                return;
            }
            
            // abort if a menu is shown
            if ($currentTrigger && $currentTrigger.length) {
                return;
            }
            
            hoveract.pageX = e.pageX;
            hoveract.pageY = e.pageY;
            hoveract.data = e.data;
            $document.on('mousemove.contextMenuShow', handle.mousemove);
            hoveract.timer = setTimeout(function() {
                hoveract.timer = null;
                $document.off('mousemove.contextMenuShow');
                $currentTrigger = $this;
                $this.trigger($.Event("contextmenu", {
                    data: hoveract.data, 
                    pageX: hoveract.pageX, 
                    pageY: hoveract.pageY
                }));
            }, e.data.delay );
        },
        // contextMenu hover trigger
        mousemove: function(e) {
            hoveract.pageX = e.pageX;
            hoveract.pageY = e.pageY;
        },
        // contextMenu hover trigger
        mouseleave: function(e) {
            // abort if we're leaving for a menu
            var $related = $(e.relatedTarget);
            if ($related.is('.context-menu-list') || $related.closest('.context-menu-list').length) {
                return;
            }
            
            try {
                clearTimeout(hoveract.timer);
            } catch(e) {}
            
            hoveract.timer = null;
        },
        
        // click on layer to hide contextMenu
        layerClick: function(e) {
            var $this = $(this),
            root = $this.data('contextMenuRoot'),
            mouseup = false,
            button = e.button,
            x = e.pageX,
            y = e.pageY,
            target, 
            offset,
            selectors;
                
            e.preventDefault();
            e.stopImmediatePropagation();
            
            setTimeout(function() {
                var $window, hideshow, possibleTarget;
                var triggerAction = ((root.trigger == 'left' && button === 0) || (root.trigger == 'right' && button === 2));
                
                // find the element that would've been clicked, wasn't the layer in the way
                if (document.elementFromPoint) {
                    root.$layer.hide();
                    target = document.elementFromPoint(x - $win.scrollLeft(), y - $win.scrollTop());
                    root.$layer.show();
                }
                
                if (root.reposition && triggerAction) {
                    if (document.elementFromPoint) {
                        if (root.$trigger.is(target) || root.$trigger.has(target).length) {
                            root.position.call(root.$trigger, root, x, y);
                            return;
                        }
                    } else {
                        offset = root.$trigger.offset();
                        $window = $(window);
                        // while this looks kinda awful, it's the best way to avoid
                        // unnecessarily calculating any positions
                        offset.top += $window.scrollTop();
                        if (offset.top <= e.pageY) {
                            offset.left += $window.scrollLeft();
                            if (offset.left <= e.pageX) {
                                offset.bottom = offset.top + root.$trigger.outerHeight();
                                if (offset.bottom >= e.pageY) {
                                    offset.right = offset.left + root.$trigger.outerWidth();
                                    if (offset.right >= e.pageX) {
                                        // reposition
                                        root.position.call(root.$trigger, root, x, y);
                                        return;
                                    }
                                }
                            }
                        }
                    }
                }
                
                if (target && triggerAction) {
                    root.$trigger.one('contextmenu:hidden', function() {
                        $(target).contextMenu({
                            x: x, 
                            y: y
                        });
                    });
                }

                root.$menu.trigger('contextmenu:hide');
            }, 50);
        },
        // key handled :hover
        keyStop: function(e, opt) {
            if (!opt.isInput) {
                e.preventDefault();
            }
            
            e.stopPropagation();
        },
        key: function(e) {
            var opt = $currentTrigger.data('contextMenu') || {};

            switch (e.keyCode) {
                case 9:
                case 38: // up
                    handle.keyStop(e, opt);
                    // if keyCode is [38 (up)] or [9 (tab) with shift]
                    if (opt.isInput) {
                        if (e.keyCode == 9 && e.shiftKey) {
                            e.preventDefault();
                            opt.$selected && opt.$selected.find('input, textarea, select').blur();
                            opt.$menu.trigger('prevcommand');
                            return;
                        } else if (e.keyCode == 38 && opt.$selected.find('input, textarea, select').prop('type') == 'checkbox') {
                            // checkboxes don't capture this key
                            e.preventDefault();
                            return;
                        }
                    } else if (e.keyCode != 9 || e.shiftKey) {
                        opt.$menu.trigger('prevcommand');
                        return;
                    }
                // omitting break;
                    
                // case 9: // tab - reached through omitted break;
                case 40: // down
                    handle.keyStop(e, opt);
                    if (opt.isInput) {
                        if (e.keyCode == 9) {
                            e.preventDefault();
                            opt.$selected && opt.$selected.find('input, textarea, select').blur();
                            opt.$menu.trigger('nextcommand');
                            return;
                        } else if (e.keyCode == 40 && opt.$selected.find('input, textarea, select').prop('type') == 'checkbox') {
                            // checkboxes don't capture this key
                            e.preventDefault();
                            return;
                        }
                    } else {
                        opt.$menu.trigger('nextcommand');
                        return;
                    }
                    break;
                
                case 37: // left
                    handle.keyStop(e, opt);
                    if (opt.isInput || !opt.$selected || !opt.$selected.length) {
                        break;
                    }
                
                    if (!opt.$selected.parent().hasClass('context-menu-root')) {
                        var $parent = opt.$selected.parent().parent();
                        opt.$selected.trigger('contextmenu:blur');
                        opt.$selected = $parent;
                        return;
                    }
                    break;
                    
                case 39: // right
                    handle.keyStop(e, opt);
                    if (opt.isInput || !opt.$selected || !opt.$selected.length) {
                        break;
                    }
                    
                    var itemdata = opt.$selected.data('contextMenu') || {};
                    if (itemdata.$menu && opt.$selected.hasClass('context-menu-submenu')) {
                        opt.$selected = null;
                        itemdata.$selected = null;
                        itemdata.$menu.trigger('nextcommand');
                        return;
                    }
                    break;
                
                case 35: // end
                case 36: // home
                    if (opt.$selected && opt.$selected.find('input, textarea, select').length) {
                        return;
                    } else {
                        (opt.$selected && opt.$selected.parent() || opt.$menu)
                        .children(':not(.disabled, .not-selectable)')[e.keyCode == 36 ? 'first' : 'last']()
                        .trigger('contextmenu:focus');
                        e.preventDefault();
                        return;
                    }
                    break;
                    
                case 13: // enter
                    handle.keyStop(e, opt);
                    if (opt.isInput) {
                        if (opt.$selected && !opt.$selected.is('textarea, select')) {
                            e.preventDefault();
                            return;
                        }
                        break;
                    }
                    opt.$selected && opt.$selected.trigger('mouseup');
                    return;
                    
                case 32: // space
                case 33: // page up
                case 34: // page down
                    // prevent browser from scrolling down while menu is visible
                    handle.keyStop(e, opt);
                    return;
                    
                case 27: // esc
                    handle.keyStop(e, opt);
                    opt.$menu.trigger('contextmenu:hide');
                    return;
                    
                default: // 0-9, a-z
                    var k = (String.fromCharCode(e.keyCode)).toUpperCase();
                    if (opt.accesskeys[k]) {
                        // according to the specs accesskeys must be invoked immediately
                        opt.accesskeys[k].$node.trigger(opt.accesskeys[k].$menu
                            ? 'contextmenu:focus'
                            : 'mouseup'
                            );
                        return;
                    }
                    break;
            }
            // pass event to selected item, 
            // stop propagation to avoid endless recursion
            e.stopPropagation();
            opt.$selected && opt.$selected.trigger(e);
        },

        // select previous possible command in menu
        prevItem: function(e) {
            e.stopPropagation();
            var opt = $(this).data('contextMenu') || {};

            // obtain currently selected menu
            if (opt.$selected) {
                var $s = opt.$selected;
                opt = opt.$selected.parent().data('contextMenu') || {};
                opt.$selected = $s;
            }
            
            var $children = opt.$menu.children(),
            $prev = !opt.$selected || !opt.$selected.prev().length ? $children.last() : opt.$selected.prev(),
            $round = $prev;
            
            // skip disabled
            while ($prev.hasClass('disabled') || $prev.hasClass('not-selectable')) {
                if ($prev.prev().length) {
                    $prev = $prev.prev();
                } else {
                    $prev = $children.last();
                }
                if ($prev.is($round)) {
                    // break endless loop
                    return;
                }
            }
            
            // leave current
            if (opt.$selected) {
                handle.itemMouseleave.call(opt.$selected.get(0), e);
            }
            
            // activate next
            handle.itemMouseenter.call($prev.get(0), e);
            
            // focus input
            var $input = $prev.find('input, textarea, select');
            if ($input.length) {
                $input.focus();
            }
        },
        // select next possible command in menu
        nextItem: function(e) {
            e.stopPropagation();
            var opt = $(this).data('contextMenu') || {};

            // obtain currently selected menu
            if (opt.$selected) {
                var $s = opt.$selected;
                opt = opt.$selected.parent().data('contextMenu') || {};
                opt.$selected = $s;
            }

            var $children = opt.$menu.children(),
            $next = !opt.$selected || !opt.$selected.next().length ? $children.first() : opt.$selected.next(),
            $round = $next;

            // skip disabled
            while ($next.hasClass('disabled') || $next.hasClass('not-selectable')) {
                if ($next.next().length) {
                    $next = $next.next();
                } else {
                    $next = $children.first();
                }
                if ($next.is($round)) {
                    // break endless loop
                    return;
                }
            }
            
            // leave current
            if (opt.$selected) {
                handle.itemMouseleave.call(opt.$selected.get(0), e);
            }
            
            // activate next
            handle.itemMouseenter.call($next.get(0), e);
            
            // focus input
            var $input = $next.find('input, textarea, select');
            if ($input.length) {
                $input.focus();
            }
        },
        
        // flag that we're inside an input so the key handler can act accordingly
        focusInput: function(e) {
            var $this = $(this).closest('.context-menu-item'),
            data = $this.data(),
            opt = data.contextMenu,
            root = data.contextMenuRoot;

            root.$selected = opt.$selected = $this;
            root.isInput = opt.isInput = true;
        },
        // flag that we're inside an input so the key handler can act accordingly
        blurInput: function(e) {
            var $this = $(this).closest('.context-menu-item'),
            data = $this.data(),
            opt = data.contextMenu,
            root = data.contextMenuRoot;

            root.isInput = opt.isInput = false;
        },
        
        // :hover on menu
        menuMouseenter: function(e) {
            var root = $(this).data().contextMenuRoot;
            root.hovering = true;
        },
        // :hover on menu
        menuMouseleave: function(e) {
            var root = $(this).data().contextMenuRoot;
            if (root.$layer && root.$layer.is(e.relatedTarget)) {
                root.hovering = false;
            }
        },
        
        // :hover done manually so key handling is possible
        itemMouseenter: function(e) {
            var $this = $(this),
            data = $this.data(),
            opt = data.contextMenu,
            root = data.contextMenuRoot;
            
            root.hovering = true;

            // abort if we're re-entering
            if (e && root.$layer && root.$layer.is(e.relatedTarget)) {
                e.preventDefault();
                e.stopImmediatePropagation();
            }

            // make sure only one item is selected
            (opt.$menu ? opt : root).$menu
            .children('.hover').trigger('contextmenu:blur');

            if ($this.hasClass('disabled') || $this.hasClass('not-selectable')) {
                opt.$selected = null;
                return;
            }
            
            $this.trigger('contextmenu:focus');
        },
        // :hover done manually so key handling is possible
        itemMouseleave: function(e) {
            var $this = $(this),
            data = $this.data(),
            opt = data.contextMenu,
            root = data.contextMenuRoot;

            if (root !== opt && root.$layer && root.$layer.is(e.relatedTarget)) {
                root.$selected && root.$selected.trigger('contextmenu:blur');
                e.preventDefault();
                e.stopImmediatePropagation();
                root.$selected = opt.$selected = opt.$node;
                return;
            }
            
            $this.trigger('contextmenu:blur');
        },
        // contextMenu item click
        itemClick: function(e) {
            var $this = $(this),
            data = $this.data(),
            opt = data.contextMenu,
            root = data.contextMenuRoot,
            key = data.contextMenuKey,
            callback;

            // abort if the key is unknown or disabled or is a menu
            if (!opt.items[key] || $this.is('.disabled, .context-menu-submenu, .context-menu-separator, .not-selectable')) {
                return;
            }

            e.preventDefault();
            e.stopImmediatePropagation();

            if ($.isFunction(root.callbacks[key]) && Object.prototype.hasOwnProperty.call(root.callbacks, key)) {
                // item-specific callback
                callback = root.callbacks[key];
            } else if ($.isFunction(root.callback)) {
                // default callback
                callback = root.callback;                
            } else {
                // no callback, no action
                return;
            }

            // hide menu if callback doesn't stop that
            if (callback.call(root.$trigger, key, root) !== false) {
                root.$menu.trigger('contextmenu:hide');
            } else if (root.$menu.parent().length) {
                op.update.call(root.$trigger, root);
            }
        },
        // ignore click events on input elements
        inputClick: function(e) {
            e.stopImmediatePropagation();
        },
        
        // hide <menu>
        hideMenu: function(e, data) {
            var root = $(this).data('contextMenuRoot');
            op.hide.call(root.$trigger, root, data && data.force);
        },
        // focus <command>
        focusItem: function(e) {
            e.stopPropagation();
            var $this = $(this),
            data = $this.data(),
            opt = data.contextMenu,
            root = data.contextMenuRoot;

            $this.addClass('hover')
            .siblings('.hover').trigger('contextmenu:blur');
            
            // remember selected
            opt.$selected = root.$selected = $this;
            
            // position sub-menu - do after show so dumb $.ui.position can keep up
            if (opt.$node) {
                root.positionSubmenu.call(opt.$node, opt.$menu);
            }
        },
        // blur <command>
        blurItem: function(e) {
            e.stopPropagation();
            var $this = $(this),
            data = $this.data(),
            opt = data.contextMenu,
            root = data.contextMenuRoot;
            
            $this.removeClass('hover');
            opt.$selected = null;
        }
    },
    // operations
    op = {
        show: function(opt, x, y) {
            var $trigger = $(this),
            offset,
            css = {};

            // hide any open menus
            $('#context-menu-layer').trigger('mousedown');

            // backreference for callbacks
            opt.$trigger = $trigger;

            // show event
            if (opt.events.show.call($trigger, opt) === false) {
                $currentTrigger = null;
                return;
            }

            // create or update context menu
            op.update.call($trigger, opt);
            
            // position menu
            opt.position.call($trigger, opt, x, y);

            // make sure we're in front
            if (opt.zIndex) {
                css.zIndex = zindex($trigger) + opt.zIndex;
            }
            
            // add layer
            op.layer.call(opt.$menu, opt, css.zIndex);
            
            // adjust sub-menu zIndexes
            opt.$menu.find('ul').css('zIndex', css.zIndex + 1);
            
            // position and show context menu
            opt.$menu.css( css )[opt.animation.show](opt.animation.duration, function() {
                $trigger.trigger('contextmenu:visible');
            });
            // make options available and set state
            $trigger
            .data('contextMenu', opt)
            .addClass("context-menu-active");
            
            // register key handler
            $(document).off('keydown.contextMenu').on('keydown.contextMenu', handle.key);
            // register autoHide handler
            if (opt.autoHide) {
                // mouse position handler
                $(document).on('mousemove.contextMenuAutoHide', function(e) {
                    // need to capture the offset on mousemove,
                    // since the page might've been scrolled since activation
                    var pos = $trigger.offset();
                    pos.right = pos.left + $trigger.outerWidth();
                    pos.bottom = pos.top + $trigger.outerHeight();
                    
                    if (opt.$layer && !opt.hovering && (!(e.pageX >= pos.left && e.pageX <= pos.right) || !(e.pageY >= pos.top && e.pageY <= pos.bottom))) {
                        // if mouse in menu...
                        opt.$menu.trigger('contextmenu:hide');
                    }
                });
            }
        },
        hide: function(opt, force) {
            var $trigger = $(this);
            if (!opt) {
                opt = $trigger.data('contextMenu') || {};
            }
            
            // hide event
            if (!force && opt.events && opt.events.hide.call($trigger, opt) === false) {
                return;
            }
            
            // remove options and revert state
            $trigger
            .removeData('contextMenu')
            .removeClass("context-menu-active");
            
            if (opt.$layer) {
                // keep layer for a bit so the contextmenu event can be aborted properly by opera
                setTimeout((function($layer) {
                    return function(){
                        $layer.remove();
                    };
                })(opt.$layer), 10);
                
                try {
                    delete opt.$layer;
                } catch(e) {
                    opt.$layer = null;
                }
            }
            
            // remove handle
            $currentTrigger = null;
            // remove selected
            opt.$menu.find('.hover').trigger('contextmenu:blur');
            opt.$selected = null;
            // unregister key and mouse handlers
            //$(document).off('.contextMenuAutoHide keydown.contextMenu'); // http://bugs.jquery.com/ticket/10705
            $(document).off('.contextMenuAutoHide').off('keydown.contextMenu');
            // hide menu
            opt.$menu && opt.$menu[opt.animation.hide](opt.animation.duration, function (){
                // tear down dynamically built menu after animation is completed.
                if (opt.build) {
                    opt.$menu.remove();
                    $.each(opt, function(key, value) {
                        switch (key) {
                            case 'ns':
                            case 'selector':
                            case 'build':
                            case 'trigger':
                                return true;

                            default:
                                opt[key] = undefined;
                                try {
                                    delete opt[key];
                                } catch (e) {}
                                return true;
                        }
                    });
                }
                
                setTimeout(function() {
                    $trigger.trigger('contextmenu:hidden');
                }, 10);
            });
        },
        create: function(opt, root) {
            if (root === undefined) {
                root = opt;
            }
            // create contextMenu
            opt.$menu = $('<ul class="context-menu-list"></ul>').addClass(opt.className || "").data({
                'contextMenu': opt,
                'contextMenuRoot': root
            });
            
            $.each(['callbacks', 'commands', 'inputs'], function(i,k){
                opt[k] = {};
                if (!root[k]) {
                    root[k] = {};
                }
            });
            
            root.accesskeys || (root.accesskeys = {});
            
            // create contextMenu items
            $.each(opt.items, function(key, item){
                var $t = $('<li class="context-menu-item"></li>').addClass(item.className || ""),
                $label = null,
                $input = null;
                
                // iOS needs to see a click-event bound to an element to actually
                // have the TouchEvents infrastructure trigger the click event
                $t.on('click', $.noop);
                
                item.$node = $t.data({
                    'contextMenu': opt,
                    'contextMenuRoot': root,
                    'contextMenuKey': key
                });
                
                // register accesskey
                // NOTE: the accesskey attribute should be applicable to any element, but Safari5 and Chrome13 still can't do that
                if (item.accesskey) {
                    var aks = splitAccesskey(item.accesskey);
                    for (var i=0, ak; ak = aks[i]; i++) {
                        if (!root.accesskeys[ak]) {
                            root.accesskeys[ak] = item;
                            item._name = item.name.replace(new RegExp('(' + ak + ')', 'i'), '<span class="context-menu-accesskey">$1</span>');
                            break;
                        }
                    }
                }
                
                if (typeof item == "string") {
                    $t.addClass('context-menu-separator not-selectable');
                } else if (item.type && types[item.type]) {
                    // run custom type handler
                    types[item.type].call($t, item, opt, root);
                    // register commands
                    $.each([opt, root], function(i,k){
                        k.commands[key] = item;
                        if ($.isFunction(item.callback)) {
                            k.callbacks[key] = item.callback;
                        }
                    });
                } else {
                    // add label for input
                    if (item.type == 'html') {
                        $t.addClass('context-menu-html not-selectable');
                    } else if (item.type) {
                        $label = $('<label></label>').appendTo($t);
                        $('<span></span>').html(item._name || item.name).appendTo($label);
                        $t.addClass('context-menu-input');
                        opt.hasTypes = true;
                        $.each([opt, root], function(i,k){
                            k.commands[key] = item;
                            k.inputs[key] = item;
                        });
                    } else if (item.items) {
                        item.type = 'sub';
                    }
                
                    switch (item.type) {
                        case 'text':
                            $input = $('<input type="text" value="1" name="" value="">')
                            .attr('name', 'context-menu-input-' + key)
                            .val(item.value || "")
                            .appendTo($label);
                            break;
                    
                        case 'textarea':
                            $input = $('<textarea name=""></textarea>')
                            .attr('name', 'context-menu-input-' + key)
                            .val(item.value || "")
                            .appendTo($label);

                            if (item.height) {
                                $input.height(item.height);
                            }
                            break;

                        case 'checkbox':
                            $input = $('<input type="checkbox" value="1" name="" value="">')
                            .attr('name', 'context-menu-input-' + key)
                            .val(item.value || "")
                            .prop("checked", !!item.selected)
                            .prependTo($label);
                            break;

                        case 'radio':
                            $input = $('<input type="radio" value="1" name="" value="">')
                            .attr('name', 'context-menu-input-' + item.radio)
                            .val(item.value || "")
                            .prop("checked", !!item.selected)
                            .prependTo($label);
                            break;
                    
                        case 'select':
                            $input = $('<select name="">')
                            .attr('name', 'context-menu-input-' + key)
                            .appendTo($label);
                            if (item.options) {
                                $.each(item.options, function(value, text) {
                                    $('<option></option>').val(value).text(text).appendTo($input);
                                });
                                $input.val(item.selected);
                            }
                            break;
                        
                        case 'sub':
                            // FIXME: shouldn't this .html() be a .text()?
                            $('<span></span>').html(item._name || item.name).appendTo($t);
                            item.appendTo = item.$node;
                            op.create(item, root);
                            $t.data('contextMenu', item).addClass('context-menu-submenu');
                            item.callback = null;
                            break;
                        
                        case 'html':
                            $(item.html).appendTo($t);
                            break;
                        
                        default:
                            $.each([opt, root], function(i,k){
                                k.commands[key] = item;
                                if ($.isFunction(item.callback)) {
                                    k.callbacks[key] = item.callback;
                                }
                            });
                            // FIXME: shouldn't this .html() be a .text()?
                            $('<span></span>').html(item._name || item.name || "").appendTo($t);
                            break;
                    }
                    
                    // disable key listener in <input>
                    if (item.type && item.type != 'sub' && item.type != 'html') {
                        $input
                        .on('focus', handle.focusInput)
                        .on('blur', handle.blurInput);
                        
                        if (item.events) {
                            $input.on(item.events, opt);
                        }
                    }
                
                    // add icons
                    if (item.icon) {
                        $t.addClass("icon icon-" + item.icon);
                    }
                }
                
                // cache contained elements
                item.$input = $input;
                item.$label = $label;

                // attach item to menu
                $t.appendTo(opt.$menu);
                
                // Disable text selection
                if (!opt.hasTypes && $.support.eventSelectstart) {
                    // browsers support user-select: none, 
                    // IE has a special event for text-selection
                    // browsers supporting neither will not be preventing text-selection
                    $t.on('selectstart.disableTextSelect', handle.abortevent);
                }
            });
            // attach contextMenu to <body> (to bypass any possible overflow:hidden issues on parents of the trigger element)
            if (!opt.$node) {
                opt.$menu.css('display', 'none').addClass('context-menu-root');
            }
            opt.$menu.appendTo(opt.appendTo || document.body);
        },
        resize: function($menu, nested) {
            // determine widths of submenus, as CSS won't grow them automatically
            // position:absolute within position:absolute; min-width:100; max-width:200; results in width: 100;
            // kinda sucks hard...

            // determine width of absolutely positioned element
            $menu.css({
                position: 'absolute', 
                display: 'block'
            });
            // don't apply yet, because that would break nested elements' widths
            // add a pixel to circumvent word-break issue in IE9 - #80
            $menu.data('width', Math.ceil($menu.width()) + 1);
            // reset styles so they allow nested elements to grow/shrink naturally
            $menu.css({
                position: 'static',
                minWidth: '0px',
                maxWidth: '100000px'
            });
            // identify width of nested menus
            $menu.find('> li > ul').each(function() {
                op.resize($(this), true);
            });
            // reset and apply changes in the end because nested
            // elements' widths wouldn't be calculatable otherwise
            if (!nested) {
                $menu.find('ul').andSelf().css({
                    position: '', 
                    display: '',
                    minWidth: '',
                    maxWidth: ''
                }).width(function() {
                    return $(this).data('width');
                });
            }
        },
        update: function(opt, root) {
            var $trigger = this;
            if (root === undefined) {
                root = opt;
                op.resize(opt.$menu);
            }
            // re-check disabled for each item
            opt.$menu.children().each(function(){
                var $item = $(this),
                key = $item.data('contextMenuKey'),
                item = opt.items[key],
                disabled = ($.isFunction(item.disabled) && item.disabled.call($trigger, key, root)) || item.disabled === true;

                // dis- / enable item
                $item[disabled ? 'addClass' : 'removeClass']('disabled');
                
                if (item.type) {
                    // dis- / enable input elements
                    $item.find('input, select, textarea').prop('disabled', disabled);
                    
                    // update input states
                    switch (item.type) {
                        case 'text':
                        case 'textarea':
                            item.$input.val(item.value || "");
                            break;
                            
                        case 'checkbox':
                        case 'radio':
                            item.$input.val(item.value || "").prop('checked', !!item.selected);
                            break;
                            
                        case 'select':
                            item.$input.val(item.selected || "");
                            break;
                    }
                }
                
                if (item.$menu) {
                    // update sub-menu
                    op.update.call($trigger, item, root);
                }
            });
        },
        layer: function(opt, zIndex) {
            // add transparent layer for click area
            // filter and background for Internet Explorer, Issue #23
            var $layer = opt.$layer = $('<div id="context-menu-layer" style="position:fixed; z-index:' + zIndex + '; top:0; left:0; opacity: 0; filter: alpha(opacity=0); background-color: #000;"></div>')
            .css({
                height: $win.height(), 
                width: $win.width(), 
                display: 'block'
            })
            .data('contextMenuRoot', opt)
            .insertBefore(this)
            .on('contextmenu', handle.abortevent)
            .on('mousedown', handle.layerClick);
            
            // IE6 doesn't know position:fixed;
            if (!$.support.fixedPosition) {
                $layer.css({
                    'position' : 'absolute',
                    'height' : $(document).height()
                });
            }
            
            return $layer;
        }
    };

    // split accesskey according to http://www.whatwg.org/specs/web-apps/current-work/multipage/editing.html#assigned-access-key
    function splitAccesskey(val) {
        var t = val.split(/\s+/),
        keys = [];
        
        for (var i=0, k; k = t[i]; i++) {
            k = k[0].toUpperCase(); // first character only
            // theoretically non-accessible characters should be ignored, but different systems, different keyboard layouts, ... screw it.
            // a map to look up already used access keys would be nice
            keys.push(k);
        }
    
        return keys;
    }

    // handle contextMenu triggers
    $.fn.contextMenu = function(operation) {
        if (operation === undefined) {
            this.first().trigger('contextmenu');
        } else if (operation.x && operation.y) {
            this.first().trigger($.Event("contextmenu", {
                pageX: operation.x, 
                pageY: operation.y
                }));
        } else if (operation === "hide") {
            var $menu = this.data('contextMenu').$menu;
            $menu && $menu.trigger('contextmenu:hide');
        } else if (operation === "destroy") {
            $.contextMenu("destroy", {
                context: this
            });
        } else if ($.isPlainObject(operation)) {
            operation.context = this;
            $.contextMenu("create", operation);
        } else if (operation) {
            this.removeClass('context-menu-disabled');
        } else if (!operation) {
            this.addClass('context-menu-disabled');
        }
    
        return this;
    };

    // manage contextMenu instances
    $.contextMenu = function(operation, options) {
        if (typeof operation != 'string') {
            options = operation;
            operation = 'create';
        }
    
        if (typeof options == 'string') {
            options = {
                selector: options
            };
        } else if (options === undefined) {
            options = {};
        }
    
        // merge with default options
        var o = $.extend(true, {}, defaults, options || {});
        var $document = $(document);
        var $context = $document;
        var _hasContext = false;
    
        if (!o.context || !o.context.length) {
            o.context = document;
        } else {
            // you never know what they throw at you...
            $context = $(o.context).first();
            o.context = $context.get(0);
            _hasContext = o.context !== document;
        }
    
        switch (operation) {
            case 'create':
                // no selector no joy
                if (!o.selector) {
                    throw new Error('No selector specified');
                }
                // make sure internal classes are not bound to
                if (o.selector.match(/.context-menu-(list|item|input)($|\s)/)) {
                    throw new Error('Cannot bind to selector "' + o.selector + '" as it contains a reserved className');
                }
                if (!o.build && (!o.items || $.isEmptyObject(o.items))) {
                    throw new Error('No Items sepcified');
                }
                counter ++;
                o.ns = '.contextMenu' + counter;
                if (!_hasContext) {
                    namespaces[o.selector] = o.ns;
                }
                menus[o.ns] = o;
            
                // default to right click
                if (!o.trigger) {
                    o.trigger = 'right';
                }
            
                if (!initialized) {
                    // make sure item click is registered first
                    $document
                    .on({
                        'contextmenu:hide.contextMenu': handle.hideMenu,
                        'prevcommand.contextMenu': handle.prevItem,
                        'nextcommand.contextMenu': handle.nextItem,
                        'contextmenu.contextMenu': handle.abortevent,
                        'mouseenter.contextMenu': handle.menuMouseenter,
                        'mouseleave.contextMenu': handle.menuMouseleave
                    }, '.context-menu-list')
                    .on('mouseup.contextMenu', '.context-menu-input', handle.inputClick)
                    .on({
                        'mouseup.contextMenu': handle.itemClick,
                        'contextmenu:focus.contextMenu': handle.focusItem,
                        'contextmenu:blur.contextMenu': handle.blurItem,
                        'contextmenu.contextMenu': handle.abortevent,
                        'mouseenter.contextMenu': handle.itemMouseenter,
                        'mouseleave.contextMenu': handle.itemMouseleave
                    }, '.context-menu-item');

                    initialized = true;
                }
            
                // engage native contextmenu event
                $context
                .on('contextmenu' + o.ns, o.selector, o, handle.contextmenu);
            
                if (_hasContext) {
                    // add remove hook, just in case
                    $context.on('remove' + o.ns, function() {
                        $(this).contextMenu("destroy");
                    });
                }
            
                switch (o.trigger) {
                    case 'hover':
                        $context
                        .on('mouseenter' + o.ns, o.selector, o, handle.mouseenter)
                        .on('mouseleave' + o.ns, o.selector, o, handle.mouseleave);                    
                        break;
                    
                    case 'left':
                        $context.on('click' + o.ns, o.selector, o, handle.click);
                        break;
                /*
                default:
                    // http://www.quirksmode.org/dom/events/contextmenu.html
                    $document
                        .on('mousedown' + o.ns, o.selector, o, handle.mousedown)
                        .on('mouseup' + o.ns, o.selector, o, handle.mouseup);
                    break;
                */
                }
            
                // create menu
                if (!o.build) {
                    op.create(o);
                }
                break;
        
            case 'destroy':
                var $visibleMenu;
                if (_hasContext) {
                    // get proper options 
                    var context = o.context;
                    $.each(menus, function(ns, o) {
                        if (o.context !== context) {
                            return true;
                        }
                    
                        $visibleMenu = $('.context-menu-list').filter(':visible');
                        if ($visibleMenu.length && $visibleMenu.data().contextMenuRoot.$trigger.is($(o.context).find(o.selector))) {
                            $visibleMenu.trigger('contextmenu:hide', {
                                force: true
                            });
                        }

                        try {
                            if (menus[o.ns].$menu) {
                                menus[o.ns].$menu.remove();
                            }

                            delete menus[o.ns];
                        } catch(e) {
                            menus[o.ns] = null;
                        }

                        $(o.context).off(o.ns);
                    
                        return true;
                    });
                } else if (!o.selector) {
                    $document.off('.contextMenu .contextMenuAutoHide');
                    $.each(menus, function(ns, o) {
                        $(o.context).off(o.ns);
                    });
                
                    namespaces = {};
                    menus = {};
                    counter = 0;
                    initialized = false;
                
                    $('#context-menu-layer, .context-menu-list').remove();
                } else if (namespaces[o.selector]) {
                    $visibleMenu = $('.context-menu-list').filter(':visible');
                    if ($visibleMenu.length && $visibleMenu.data().contextMenuRoot.$trigger.is(o.selector)) {
                        $visibleMenu.trigger('contextmenu:hide', {
                            force: true
                        });
                    }
                
                    try {
                        if (menus[namespaces[o.selector]].$menu) {
                            menus[namespaces[o.selector]].$menu.remove();
                        }
                    
                        delete menus[namespaces[o.selector]];
                    } catch(e) {
                        menus[namespaces[o.selector]] = null;
                    }
                
                    $document.off(namespaces[o.selector]);
                }
                break;
        
            case 'html5':
                // if <command> or <menuitem> are not handled by the browser,
                // or options was a bool true,
                // initialize $.contextMenu for them
                if ((!$.support.htmlCommand && !$.support.htmlMenuitem) || (typeof options == "boolean" && options)) {
                    $('menu[type="context"]').each(function() {
                        if (this.id) {
                            $.contextMenu({
                                selector: '[contextmenu=' + this.id +']',
                                items: $.contextMenu.fromMenu(this)
                            });
                        }
                    }).css('display', 'none');
                }
                break;
        
            default:
                throw new Error('Unknown operation "' + operation + '"');
        }
    
        return this;
    };

    // import values into <input> commands
    $.contextMenu.setInputValues = function(opt, data) {
        if (data === undefined) {
            data = {};
        }
    
        $.each(opt.inputs, function(key, item) {
            switch (item.type) {
                case 'text':
                case 'textarea':
                    item.value = data[key] || "";
                    break;

                case 'checkbox':
                    item.selected = data[key] ? true : false;
                    break;
                
                case 'radio':
                    item.selected = (data[item.radio] || "") == item.value ? true : false;
                    break;
            
                case 'select':
                    item.selected = data[key] || "";
                    break;
            }
        });
    };

    // export values from <input> commands
    $.contextMenu.getInputValues = function(opt, data) {
        if (data === undefined) {
            data = {};
        }
    
        $.each(opt.inputs, function(key, item) {
            switch (item.type) {
                case 'text':
                case 'textarea':
                case 'select':
                    data[key] = item.$input.val();
                    break;

                case 'checkbox':
                    data[key] = item.$input.prop('checked');
                    break;
                
                case 'radio':
                    if (item.$input.prop('checked')) {
                        data[item.radio] = item.value;
                    }
                    break;
            }
        });
    
        return data;
    };

    // find <label for="xyz">
    function inputLabel(node) {
        return (node.id && $('label[for="'+ node.id +'"]').val()) || node.name;
    }

    // convert <menu> to items object
    function menuChildren(items, $children, counter) {
        if (!counter) {
            counter = 0;
        }
    
        $children.each(function() {
            var $node = $(this),
            node = this,
            nodeName = this.nodeName.toLowerCase(),
            label,
            item;
        
            // extract <label><input>
            if (nodeName == 'label' && $node.find('input, textarea, select').length) {
                label = $node.text();
                $node = $node.children().first();
                node = $node.get(0);
                nodeName = node.nodeName.toLowerCase();
            }
        
            /*
         * <menu> accepts flow-content as children. that means <embed>, <canvas> and such are valid menu items.
         * Not being the sadistic kind, $.contextMenu only accepts:
         * <command>, <menuitem>, <hr>, <span>, <p> <input [text, radio, checkbox]>, <textarea>, <select> and of course <menu>.
         * Everything else will be imported as an html node, which is not interfaced with contextMenu.
         */
        
            // http://www.whatwg.org/specs/web-apps/current-work/multipage/commands.html#concept-command
            switch (nodeName) {
                // http://www.whatwg.org/specs/web-apps/current-work/multipage/interactive-elements.html#the-menu-element
                case 'menu':
                    item = {
                        name: $node.attr('label'), 
                        items: {}
                };
                counter = menuChildren(item.items, $node.children(), counter);
                break;
            
            // http://www.whatwg.org/specs/web-apps/current-work/multipage/commands.html#using-the-a-element-to-define-a-command
            case 'a':
            // http://www.whatwg.org/specs/web-apps/current-work/multipage/commands.html#using-the-button-element-to-define-a-command
            case 'button':
                item = {
                    name: $node.text(),
                    disabled: !!$node.attr('disabled'),
                    callback: (function(){
                        return function(){
                            $node.click();
                        };                    
                    })()
            };
            break;
            
        // http://www.whatwg.org/specs/web-apps/current-work/multipage/commands.html#using-the-command-element-to-define-a-command

        case 'menuitem':
            case 'command':
                switch ($node.attr('type')) {
                    case undefined:
                    case 'command':
                    case 'menuitem':
                        item = {
                            name: $node.attr('label'),
                            disabled: !!$node.attr('disabled'),
                            callback: (function(){
                                return function(){
                                    $node.click();
                                };                            
                            })()
                    };
                    break;
                        
                case 'checkbox':
                    item = {
                        type: 'checkbox',
                        disabled: !!$node.attr('disabled'),
                        name: $node.attr('label'),
                        selected: !!$node.attr('checked')
                    };
                    break;
                        
                case 'radio':
                    item = {
                        type: 'radio',
                        disabled: !!$node.attr('disabled'),
                        name: $node.attr('label'),
                        radio: $node.attr('radiogroup'),
                        value: $node.attr('id'),
                        selected: !!$node.attr('checked')
                    };
                    break;
                        
                default:
                    item = undefined;
            }
            break;
 
        case 'hr':
            item = '-------';
            break;
                
        case 'input':
            switch ($node.attr('type')) {
                case 'text':
                    item = {
                        type: 'text',
                        name: label || inputLabel(node),
                        disabled: !!$node.attr('disabled'),
                        value: $node.val()
                    };
                    break;
                        
                case 'checkbox':
                    item = {
                        type: 'checkbox',
                        name: label || inputLabel(node),
                        disabled: !!$node.attr('disabled'),
                        selected: !!$node.attr('checked')
                    };
                    break;
                        
                case 'radio':
                    item = {
                        type: 'radio',
                        name: label || inputLabel(node),
                        disabled: !!$node.attr('disabled'),
                        radio: !!$node.attr('name'),
                        value: $node.val(),
                        selected: !!$node.attr('checked')
                    };
                    break;
                    
                default:
                    item = undefined;
                    break;
            }
            break;
                
        case 'select':
            item = {
                type: 'select',
                name: label || inputLabel(node),
                disabled: !!$node.attr('disabled'),
                selected: $node.val(),
                options: {}
            };
            $node.children().each(function(){
                item.options[this.value] = $(this).text();
            });
            break;
                
        case 'textarea':
            item = {
                type: 'textarea',
                name: label || inputLabel(node),
                disabled: !!$node.attr('disabled'),
                value: $node.val()
            };
            break;
            
        case 'label':
            break;
            
        default:
            item = {
                type: 'html', 
                html: $node.clone(true)
                };
            break;
    }
        
    if (item) {
        counter++;
        items['key' + counter] = item;
    }
});
    
return counter;
}

// convert html5 menu
$.contextMenu.fromMenu = function(element) {
    var $this = $(element),
    items = {};
        
    menuChildren(items, $this.children());
    
    return items;
};

// make defaults accessible
$.contextMenu.defaults = defaults;
$.contextMenu.types = types;
// export internal functions - undocumented, for hacking only!
$.contextMenu.handle = handle;
$.contextMenu.op = op;
$.contextMenu.menus = menus;

})(jQuery);


(function($, undefined){

    $(function() {
        if (!window.prettyPrint) {
            return;
        }
        
        $('.showcase').each(function(){
            
            var $this = $(that || this),
            text, nodeName, lang, that;
            
            if ($this.data('showcaseImport')) {
                $this = $($this.data('showcaseImport'));
                that = $this.get(0);
            }
            
            nodeName = (that || this).nodeName.toLowerCase();
            lang = nodeName == 'script' 
            ? 'js' 
            : (nodeName == 'style' ? 'css' : 'html');
            
            if (lang == 'html') {
                text = $('<div></div>').append($this.clone()).html();
            } else {
                text = $this.text();
            }

            $('<pre class="prettyprint lang-'+ lang +'"></pre>')
            .text(text)
            .insertBefore(this);
            
            that && $(this).remove();
        });

        prettyPrint();
    });

})(jQuery);


var q=null;
window.PR_SHOULD_USE_CONTINUATION=!0;
(function(){
    function L(a){
        function m(a){
            var f=a.charCodeAt(0);
            if(f!==92)return f;
            var b=a.charAt(1);
            return(f=r[b])?f:"0"<=b&&b<="7"?parseInt(a.substring(1),8):b==="u"||b==="x"?parseInt(a.substring(2),16):a.charCodeAt(1)
            }
            function e(a){
            if(a<32)return(a<16?"\\x0":"\\x")+a.toString(16);
            a=String.fromCharCode(a);
            if(a==="\\"||a==="-"||a==="["||a==="]")a="\\"+a;
            return a
            }
            function h(a){
            for(var f=a.substring(1,a.length-1).match(/\\u[\dA-Fa-f]{4}|\\x[\dA-Fa-f]{2}|\\[0-3][0-7]{0,2}|\\[0-7]{1,2}|\\[\S\s]|[^\\]/g),a=
                [],b=[],o=f[0]==="^",c=o?1:0,i=f.length;c<i;++c){
                var j=f[c];
                if(/\\[bdsw]/i.test(j))a.push(j);
                else{
                    var j=m(j),d;
                    c+2<i&&"-"===f[c+1]?(d=m(f[c+2]),c+=2):d=j;
                    b.push([j,d]);
                    d<65||j>122||(d<65||j>90||b.push([Math.max(65,j)|32,Math.min(d,90)|32]),d<97||j>122||b.push([Math.max(97,j)&-33,Math.min(d,122)&-33]))
                    }
                }
            b.sort(function(a,f){
            return a[0]-f[0]||f[1]-a[1]
            });
        f=[];
        j=[NaN,NaN];
        for(c=0;c<b.length;++c)i=b[c],i[0]<=j[1]+1?j[1]=Math.max(j[1],i[1]):f.push(j=i);
        b=["["];
        o&&b.push("^");
        b.push.apply(b,a);
        for(c=0;c<
            f.length;++c)i=f[c],b.push(e(i[0])),i[1]>i[0]&&(i[1]+1>i[0]&&b.push("-"),b.push(e(i[1])));
        b.push("]");
        return b.join("")
        }
        function y(a){
        for(var f=a.source.match(/\[(?:[^\\\]]|\\[\S\s])*]|\\u[\dA-Fa-f]{4}|\\x[\dA-Fa-f]{2}|\\\d+|\\[^\dux]|\(\?[!:=]|[()^]|[^()[\\^]+/g),b=f.length,d=[],c=0,i=0;c<b;++c){
            var j=f[c];
            j==="("?++i:"\\"===j.charAt(0)&&(j=+j.substring(1))&&j<=i&&(d[j]=-1)
            }
            for(c=1;c<d.length;++c)-1===d[c]&&(d[c]=++t);
        for(i=c=0;c<b;++c)j=f[c],j==="("?(++i,d[i]===void 0&&(f[c]="(?:")):"\\"===j.charAt(0)&&
            (j=+j.substring(1))&&j<=i&&(f[c]="\\"+d[i]);
        for(i=c=0;c<b;++c)"^"===f[c]&&"^"!==f[c+1]&&(f[c]="");
        if(a.ignoreCase&&s)for(c=0;c<b;++c)j=f[c],a=j.charAt(0),j.length>=2&&a==="["?f[c]=h(j):a!=="\\"&&(f[c]=j.replace(/[A-Za-z]/g,function(a){
            a=a.charCodeAt(0);
            return"["+String.fromCharCode(a&-33,a|32)+"]"
            }));
        return f.join("")
        }
        for(var t=0,s=!1,l=!1,p=0,d=a.length;p<d;++p){
        var g=a[p];
        if(g.ignoreCase)l=!0;
        else if(/[a-z]/i.test(g.source.replace(/\\u[\da-f]{4}|\\x[\da-f]{2}|\\[^UXux]/gi,""))){
            s=!0;
            l=!1;
            break
        }
    }
    for(var r=

    {
    b:8,
    t:9,
    n:10,
    v:11,
    f:12,
    r:13
},n=[],p=0,d=a.length;p<d;++p){
    g=a[p];
    if(g.global||g.multiline)throw Error(""+g);
    n.push("(?:"+y(g)+")")
    }
    return RegExp(n.join("|"),l?"gi":"g")
    }
    function M(a){
    function m(a){
        switch(a.nodeType){
            case 1:
                if(e.test(a.className))break;
                for(var g=a.firstChild;g;g=g.nextSibling)m(g);
                g=a.nodeName;
                if("BR"===g||"LI"===g)h[s]="\n",t[s<<1]=y++,t[s++<<1|1]=a;
                break;
            case 3:case 4:
                g=a.nodeValue,g.length&&(g=p?g.replace(/\r\n?/g,"\n"):g.replace(/[\t\n\r ]+/g," "),h[s]=g,t[s<<1]=y,y+=g.length,
                t[s++<<1|1]=a)
            }
            }
    var e=/(?:^|\s)nocode(?:\s|$)/,h=[],y=0,t=[],s=0,l;
a.currentStyle?l=a.currentStyle.whiteSpace:window.getComputedStyle&&(l=document.defaultView.getComputedStyle(a,q).getPropertyValue("white-space"));
    var p=l&&"pre"===l.substring(0,3);
    m(a);
    return{
    a:h.join("").replace(/\n$/,""),
    c:t
}
}
function B(a,m,e,h){
    m&&(a={
        a:m,
        d:a
    },e(a),h.push.apply(h,a.e))
    }
    function x(a,m){
    function e(a){
        for(var l=a.d,p=[l,"pln"],d=0,g=a.a.match(y)||[],r={},n=0,z=g.length;n<z;++n){
            var f=g[n],b=r[f],o=void 0,c;
            if(typeof b===
                "string")c=!1;
            else{
                var i=h[f.charAt(0)];
                if(i)o=f.match(i[1]),b=i[0];
                else{
                    for(c=0;c<t;++c)if(i=m[c],o=f.match(i[1])){
                        b=i[0];
                        break
                    }
                    o||(b="pln")
                    }
                    if((c=b.length>=5&&"lang-"===b.substring(0,5))&&!(o&&typeof o[1]==="string"))c=!1,b="src";
                c||(r[f]=b)
                }
                i=d;
            d+=f.length;
            if(c){
                c=o[1];
                var j=f.indexOf(c),k=j+c.length;
                o[2]&&(k=f.length-o[2].length,j=k-c.length);
                b=b.substring(5);
                B(l+i,f.substring(0,j),e,p);
                B(l+i+j,c,C(b,c),p);
                B(l+i+k,f.substring(k),e,p)
                }else p.push(l+i,b)
                }
                a.e=p
        }
        var h={},y;
    (function(){
        for(var e=a.concat(m),
            l=[],p={},d=0,g=e.length;d<g;++d){
            var r=e[d],n=r[3];
            if(n)for(var k=n.length;--k>=0;)h[n.charAt(k)]=r;
            r=r[1];
            n=""+r;
            p.hasOwnProperty(n)||(l.push(r),p[n]=q)
            }
            l.push(/[\S\s]/);
        y=L(l)
        })();
    var t=m.length;
    return e
    }
    function u(a){
    var m=[],e=[];
    a.tripleQuotedStrings?m.push(["str",/^(?:'''(?:[^'\\]|\\[\S\s]|''?(?=[^']))*(?:'''|$)|"""(?:[^"\\]|\\[\S\s]|""?(?=[^"]))*(?:"""|$)|'(?:[^'\\]|\\[\S\s])*(?:'|$)|"(?:[^"\\]|\\[\S\s])*(?:"|$))/,q,"'\""]):a.multiLineStrings?m.push(["str",/^(?:'(?:[^'\\]|\\[\S\s])*(?:'|$)|"(?:[^"\\]|\\[\S\s])*(?:"|$)|`(?:[^\\`]|\\[\S\s])*(?:`|$))/,
        q,"'\"`"]):m.push(["str",/^(?:'(?:[^\n\r'\\]|\\.)*(?:'|$)|"(?:[^\n\r"\\]|\\.)*(?:"|$))/,q,"\"'"]);
    a.verbatimStrings&&e.push(["str",/^@"(?:[^"]|"")*(?:"|$)/,q]);
    var h=a.hashComments;
    h&&(a.cStyleComments?(h>1?m.push(["com",/^#(?:##(?:[^#]|#(?!##))*(?:###|$)|.*)/,q,"#"]):m.push(["com",/^#(?:(?:define|elif|else|endif|error|ifdef|include|ifndef|line|pragma|undef|warning)\b|[^\n\r]*)/,q,"#"]),e.push(["str",/^<(?:(?:(?:\.\.\/)*|\/?)(?:[\w-]+(?:\/[\w-]+)+)?[\w-]+\.h|[a-z]\w*)>/,q])):m.push(["com",/^#[^\n\r]*/,
        q,"#"]));
    a.cStyleComments&&(e.push(["com",/^\/\/[^\n\r]*/,q]),e.push(["com",/^\/\*[\S\s]*?(?:\*\/|$)/,q]));
    a.regexLiterals&&e.push(["lang-regex",/^(?:^^\.?|[!+-]|!=|!==|#|%|%=|&|&&|&&=|&=|\(|\*|\*=|\+=|,|-=|->|\/|\/=|:|::|;|<|<<|<<=|<=|=|==|===|>|>=|>>|>>=|>>>|>>>=|[?@[^]|\^=|\^\^|\^\^=|{|\||\|=|\|\||\|\|=|~|break|case|continue|delete|do|else|finally|instanceof|return|throw|try|typeof)\s*(\/(?=[^*/])(?:[^/[\\]|\\[\S\s]|\[(?:[^\\\]]|\\[\S\s])*(?:]|$))+\/)/]);
    (h=a.types)&&e.push(["typ",h]);
    a=(""+a.keywords).replace(/^ | $/g,
        "");
    a.length&&e.push(["kwd",RegExp("^(?:"+a.replace(/[\s,]+/g,"|")+")\\b"),q]);
    m.push(["pln",/^\s+/,q," \r\n\t\xa0"]);
    e.push(["lit",/^@[$_a-z][\w$@]*/i,q],["typ",/^(?:[@_]?[A-Z]+[a-z][\w$@]*|\w+_t\b)/,q],["pln",/^[$_a-z][\w$@]*/i,q],["lit",/^(?:0x[\da-f]+|(?:\d(?:_\d+)*\d*(?:\.\d*)?|\.\d\+)(?:e[+-]?\d+)?)[a-z]*/i,q,"0123456789"],["pln",/^\\[\S\s]?/,q],["pun",/^.[^\s\w"-$'./@\\`]*/,q]);
    return x(m,e)
    }
    function D(a,m){
    function e(a){
        switch(a.nodeType){
            case 1:
                if(k.test(a.className))break;
                if("BR"===a.nodeName)h(a),
                a.parentNode&&a.parentNode.removeChild(a);else for(a=a.firstChild;a;a=a.nextSibling)e(a);
                break;
            case 3:case 4:
                if(p){
                var b=a.nodeValue,d=b.match(t);
                if(d){
                    var c=b.substring(0,d.index);
                    a.nodeValue=c;
                    (b=b.substring(d.index+d[0].length))&&a.parentNode.insertBefore(s.createTextNode(b),a.nextSibling);
                    h(a);
                    c||a.parentNode.removeChild(a)
                    }
                }
            }
    }
function h(a){
    function b(a,d){
        var e=d?a.cloneNode(!1):a,f=a.parentNode;
        if(f){
            var f=b(f,1),g=a.nextSibling;
            f.appendChild(e);
            for(var h=g;h;h=g)g=h.nextSibling,f.appendChild(h)
                }
                return e
        }
    for(;!a.nextSibling;)if(a=a.parentNode,!a)return;for(var a=b(a.nextSibling,0),e;(e=a.parentNode)&&e.nodeType===1;)a=e;
    d.push(a)
    }
    var k=/(?:^|\s)nocode(?:\s|$)/,t=/\r\n?|\n/,s=a.ownerDocument,l;
a.currentStyle?l=a.currentStyle.whiteSpace:window.getComputedStyle&&(l=s.defaultView.getComputedStyle(a,q).getPropertyValue("white-space"));
var p=l&&"pre"===l.substring(0,3);
for(l=s.createElement("LI");a.firstChild;)l.appendChild(a.firstChild);
for(var d=[l],g=0;g<d.length;++g)e(d[g]);
m===(m|0)&&d[0].setAttribute("value",
    m);
var r=s.createElement("OL");
r.className="linenums";
for(var n=Math.max(0,m-1|0)||0,g=0,z=d.length;g<z;++g)l=d[g],l.className="L"+(g+n)%10,l.firstChild||l.appendChild(s.createTextNode("\xa0")),r.appendChild(l);
a.appendChild(r)
}
function k(a,m){
    for(var e=m.length;--e>=0;){
        var h=m[e];
        A.hasOwnProperty(h)?window.console&&console.warn("cannot override language handler %s",h):A[h]=a
        }
    }
    function C(a,m){
    if(!a||!A.hasOwnProperty(a))a=/^\s*</.test(m)?"default-markup":"default-code";
    return A[a]
    }
    function E(a){
    var m=
    a.g;
    try{
        var e=M(a.h),h=e.a;
        a.a=h;
        a.c=e.c;
        a.d=0;
        C(m,h)(a);
        var k=/\bMSIE\b/.test(navigator.userAgent),m=/\n/g,t=a.a,s=t.length,e=0,l=a.c,p=l.length,h=0,d=a.e,g=d.length,a=0;
        d[g]=s;
        var r,n;
        for(n=r=0;n<g;)d[n]!==d[n+2]?(d[r++]=d[n++],d[r++]=d[n++]):n+=2;
        g=r;
        for(n=r=0;n<g;){
            for(var z=d[n],f=d[n+1],b=n+2;b+2<=g&&d[b+1]===f;)b+=2;
            d[r++]=z;
            d[r++]=f;
            n=b
            }
            for(d.length=r;h<p;){
            var o=l[h+2]||s,c=d[a+2]||s,b=Math.min(o,c),i=l[h+1],j;
            if(i.nodeType!==1&&(j=t.substring(e,b))){
                k&&(j=j.replace(m,"\r"));
                i.nodeValue=
                j;
                var u=i.ownerDocument,v=u.createElement("SPAN");
                v.className=d[a+1];
                var x=i.parentNode;
                x.replaceChild(v,i);
                v.appendChild(i);
                e<o&&(l[h+1]=i=u.createTextNode(t.substring(b,o)),x.insertBefore(i,v.nextSibling))
                }
                e=b;
            e>=o&&(h+=2);
            e>=c&&(a+=2)
            }
        }catch(w){
    "console"in window&&console.log(w&&w.stack?w.stack:w)
    }
}
var v=["break,continue,do,else,for,if,return,while"],w=[[v,"auto,case,char,const,default,double,enum,extern,float,goto,int,long,register,short,signed,sizeof,static,struct,switch,typedef,union,unsigned,void,volatile"],
"catch,class,delete,false,import,new,operator,private,protected,public,this,throw,true,try,typeof"],F=[w,"alignof,align_union,asm,axiom,bool,concept,concept_map,const_cast,constexpr,decltype,dynamic_cast,explicit,export,friend,inline,late_check,mutable,namespace,nullptr,reinterpret_cast,static_assert,static_cast,template,typeid,typename,using,virtual,where"],G=[w,"abstract,boolean,byte,extends,final,finally,implements,import,instanceof,null,native,package,strictfp,super,synchronized,throws,transient"],
H=[G,"as,base,by,checked,decimal,delegate,descending,dynamic,event,fixed,foreach,from,group,implicit,in,interface,internal,into,is,lock,object,out,override,orderby,params,partial,readonly,ref,sbyte,sealed,stackalloc,string,select,uint,ulong,unchecked,unsafe,ushort,var"],w=[w,"debugger,eval,export,function,get,null,set,undefined,var,with,Infinity,NaN"],I=[v,"and,as,assert,class,def,del,elif,except,exec,finally,from,global,import,in,is,lambda,nonlocal,not,or,pass,print,raise,try,with,yield,False,True,None"],
J=[v,"alias,and,begin,case,class,def,defined,elsif,end,ensure,false,in,module,next,nil,not,or,redo,rescue,retry,self,super,then,true,undef,unless,until,when,yield,BEGIN,END"],v=[v,"case,done,elif,esac,eval,fi,function,in,local,set,then,until"],K=/^(DIR|FILE|vector|(de|priority_)?queue|list|stack|(const_)?iterator|(multi)?(set|map)|bitset|u?(int|float)\d*)/,N=/\S/,O=u({
    keywords:[F,H,w,"caller,delete,die,do,dump,elsif,eval,exit,foreach,for,goto,if,import,last,local,my,next,no,our,print,package,redo,require,sub,undef,unless,until,use,wantarray,while,BEGIN,END"+
    I,J,v],
    hashComments:!0,
    cStyleComments:!0,
    multiLineStrings:!0,
    regexLiterals:!0
    }),A={};

k(O,["default-code"]);
k(x([],[["pln",/^[^<?]+/],["dec",/^<!\w[^>]*(?:>|$)/],["com",/^<\!--[\S\s]*?(?:--\>|$)/],["lang-",/^<\?([\S\s]+?)(?:\?>|$)/],["lang-",/^<%([\S\s]+?)(?:%>|$)/],["pun",/^(?:<[%?]|[%?]>)/],["lang-",/^<xmp\b[^>]*>([\S\s]+?)<\/xmp\b[^>]*>/i],["lang-js",/^<script\b[^>]*>([\S\s]*?)(<\/script\b[^>]*>)/i],["lang-css",/^<style\b[^>]*>([\S\s]*?)(<\/style\b[^>]*>)/i],["lang-in.tag",/^(<\/?[a-z][^<>]*>)/i]]),
    ["default-markup","htm","html","mxml","xhtml","xml","xsl"]);
k(x([["pln",/^\s+/,q," \t\r\n"],["atv",/^(?:"[^"]*"?|'[^']*'?)/,q,"\"'"]],[["tag",/^^<\/?[a-z](?:[\w-.:]*\w)?|\/?>$/i],["atn",/^(?!style[\s=]|on)[a-z](?:[\w:-]*\w)?/i],["lang-uq.val",/^=\s*([^\s"'>]*(?:[^\s"'/>]|\/(?=\s)))/],["pun",/^[/<->]+/],["lang-js",/^on\w+\s*=\s*"([^"]+)"/i],["lang-js",/^on\w+\s*=\s*'([^']+)'/i],["lang-js",/^on\w+\s*=\s*([^\s"'>]+)/i],["lang-css",/^style\s*=\s*"([^"]+)"/i],["lang-css",/^style\s*=\s*'([^']+)'/i],["lang-css",
    /^style\s*=\s*([^\s"'>]+)/i]]),["in.tag"]);
k(x([],[["atv",/^[\S\s]+/]]),["uq.val"]);
k(u({
    keywords:F,
    hashComments:!0,
    cStyleComments:!0,
    types:K
}),["c","cc","cpp","cxx","cyc","m"]);
k(u({
    keywords:"null,true,false"
}),["json"]);
k(u({
    keywords:H,
    hashComments:!0,
    cStyleComments:!0,
    verbatimStrings:!0,
    types:K
}),["cs"]);
k(u({
    keywords:G,
    cStyleComments:!0
    }),["java"]);
k(u({
    keywords:v,
    hashComments:!0,
    multiLineStrings:!0
    }),["bsh","csh","sh"]);
k(u({
    keywords:I,
    hashComments:!0,
    multiLineStrings:!0,
    tripleQuotedStrings:!0
    }),
["cv","py"]);
k(u({
    keywords:"caller,delete,die,do,dump,elsif,eval,exit,foreach,for,goto,if,import,last,local,my,next,no,our,print,package,redo,require,sub,undef,unless,until,use,wantarray,while,BEGIN,END",
    hashComments:!0,
    multiLineStrings:!0,
    regexLiterals:!0
    }),["perl","pl","pm"]);
k(u({
    keywords:J,
    hashComments:!0,
    multiLineStrings:!0,
    regexLiterals:!0
    }),["rb"]);
k(u({
    keywords:w,
    cStyleComments:!0,
    regexLiterals:!0
    }),["js"]);
k(u({
    keywords:"all,and,by,catch,class,else,extends,false,finally,for,if,in,is,isnt,loop,new,no,not,null,of,off,on,or,return,super,then,true,try,unless,until,when,while,yes",
    hashComments:3,
    cStyleComments:!0,
    multilineStrings:!0,
    tripleQuotedStrings:!0,
    regexLiterals:!0
    }),["coffee"]);
k(x([],[["str",/^[\S\s]+/]]),["regex"]);
window.prettyPrintOne=function(a,m,e){
    var h=document.createElement("PRE");
    h.innerHTML=a;
    e&&D(h,e);
    E({
        g:m,
        i:e,
        h:h
    });
    return h.innerHTML
    };
    
window.prettyPrint=function(a){
    function m(){
        for(var e=window.PR_SHOULD_USE_CONTINUATION?l.now()+250:Infinity;p<h.length&&l.now()<e;p++){
            var n=h[p],k=n.className;
            if(k.indexOf("prettyprint")>=0){
                var k=k.match(g),f,b;
                if(b=
                    !k){
                    b=n;
                    for(var o=void 0,c=b.firstChild;c;c=c.nextSibling)var i=c.nodeType,o=i===1?o?b:c:i===3?N.test(c.nodeValue)?b:o:o;
                    b=(f=o===b?void 0:o)&&"CODE"===f.tagName
                    }
                    b&&(k=f.className.match(g));
                k&&(k=k[1]);
                b=!1;
                for(o=n.parentNode;o;o=o.parentNode)if((o.tagName==="pre"||o.tagName==="code"||o.tagName==="xmp")&&o.className&&o.className.indexOf("prettyprint")>=0){
                    b=!0;
                    break
                }
                b||((b=(b=n.className.match(/\blinenums\b(?::(\d+))?/))?b[1]&&b[1].length?+b[1]:!0:!1)&&D(n,b),d={
                    g:k,
                    h:n,
                    i:b
                },E(d))
                }
            }
        p<h.length?setTimeout(m,
        250):a&&a()
    }
    for(var e=[document.getElementsByTagName("pre"),document.getElementsByTagName("code"),document.getElementsByTagName("xmp")],h=[],k=0;k<e.length;++k)for(var t=0,s=e[k].length;t<s;++t)h.push(e[k][t]);
var e=q,l=Date;
l.now||(l={
    now:function(){
        return+new Date
        }
    });
var p=0,d,g=/\blang(?:uage)?-([\w.]+)(?!\S)/;
m()
};

window.PR={
    createSimpleLexer:x,
    registerLangHandler:k,
    sourceDecorator:u,
    PR_ATTRIB_NAME:"atn",
    PR_ATTRIB_VALUE:"atv",
    PR_COMMENT:"com",
    PR_DECLARATION:"dec",
    PR_KEYWORD:"kwd",
    PR_LITERAL:"lit",
    PR_NOCODE:"nocode",
    PR_PLAIN:"pln",
    PR_PUNCTUATION:"pun",
    PR_SOURCE:"src",
    PR_STRING:"str",
    PR_TAG:"tag",
    PR_TYPE:"typ"
}
})();