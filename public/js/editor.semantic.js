/**
 * Created by charlesgrisar on 20/04/15.
 */
(function($) {
    var defaults = {
        entity:     '',
        url:        '',
        action:     '',
        modalCU:    '',
        modalD:     '<div class="ui modal" id="DeleteModal">' +
                        '<i class="close icon"></i>' +
                        '<div class="header">Delete</div>' +
                        '<div class="content">Do you really want to delete this row ?</div>' +
                        '<div class="actions">' +
                            '<div class="ui red cancel button">Cancel</div>' +
                            '<div class="ui positive button">OK</div>' +
                        '</div>' +
                    '</div>'
    };

    var methods = {
        init: function(options) {
            if(options) {
                $.extend(defaults,options);
            }
        },

        // show a Semantic Modal. arg = action
        show: function(arg) {
            if(arg == "delete") {
                var dialog = $(defaults.modalD);
                $('body').append(dialog);
                $('#DeleteModal').modal('show')
            } else {
                var dialog = $(defaults.modalCU);
                $('body').append(dialog);
                $('#CreateUpdateModal').modal('show');
            }
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
