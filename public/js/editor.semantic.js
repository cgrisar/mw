/**
 * Created by charlesgrisar on 20/04/15.
 */
(function($) {
    var defaults = {
        entity:     '',
        url:        '',
        action:     '',
        modalCU:    '',
        modalD:     '<i class="close icon"></i>' +
                    '<div class="header">Warning</div>' +
                    '<div class="content">Do you really want to delete ' + this.entity + '?</div>' +
                    '<div class="actions">' +
                        '<div class="ui cancel button">Cancel</div>' +
                        '<div class="ui ok button">OK</div>' +
                    '</div>'
    };

    var methods = {
        init: function(options) {
            if(options) {
                $.extend(defaults,options);
            }
            alert(defaults.string1 + defaults.string2);
        },
        // show a Semantic Modal. Arg
        show: function(arg) {
            var dialog = $(defaults.modalD);
            $(this)
                .append(dialog)
                .modal('show');
        },
        hide: function() {

        }
    };
    $.fn.SemanticEditor = function(method) {
        var args = arguments;
        var $this = this;
        return this.each(function() {
            if ( methods[method] ) {
                return methods[method].apply( $(this), Array.prototype.slice.call( args, 1 ));
            } else if ( typeof method === 'object' || ! method ) {
                return methods.init.apply( $this, Array.prototype.slice.call( args, 0 ) );
            } else {
                $.error( 'Method ' +  method + ' does not exist on jQuery.plugin' );
            }
        });
    };

})(jQuery);
