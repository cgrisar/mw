/**
 * Created by charlesgrisar on 20/04/15.
 */

(function($){

    $.fn.modal = function(options){
        options = $.extend({
            action: "create"
        }, options);
        $.fn.modal.settings = options;
        return this
        })
    }
})(jQuery);