/**
 * Created by charlesgrisar on 20/04/15.
 */
(function(window, document, undefined) {

    var SemanticEditor = function ( opts )
    {
        if ( ! this instanceof SemanticEditor ) {
            alert( "DataTables Editor must be initialised as a 'new' instance'" );
        }

        this._constructor( opts );
    };

// Export Editor as a DataTables property
    DataTable.SemanticEditor = SemanticEditor;
    $.fn.DataTable.SemanticEditor = Editor;

    SemanticEditor.prototype.addFields = function(fields){

    };

    var defaults = {
        entity:     '',
        fields:     '{}',
        url:        '',
        action:     '',
        modalCU:    '',
        modalD:     ''
    };

    var methods = {
        init: function(options) {
            if(options) {
                $.extend(defaults,options);
            };
            if(defaults.modalCU == '' && defaults.fields) {

                for (var i in defaults.fields) {
                    var obj = defaults.fields[i];
                    if (obj.multiple) {

                        console.log("Array " + obj.multiple)
                    } else {
                        console.log("Field " + obj.name)
                    }
                }
            }
        },

        // show a Semantic Modal. arg = action
        show: function(arg) {
            if(arg == "delete") {
                var dialog = $(methods._createDeleteForm());
                $('body').append(dialog);
                $('#' + defaults.entity + 'DeleteModal').modal('show')
            } else {
                var dialog = $(defaults.modalCU);
                $('body').append(dialog);
                $('#CreateUpdateModal').modal('show');
            }
        },

        hide: function() {

        },

        // private methods

        _createDeleteForm: function(){
            if(defaults.modalD == '') {
                return '<div class="ui modal" id="' + defaults.entity + 'DeleteModal">' +
                            '<i class="close icon"></i>' +
                            '<div class="header">Delete</div>' +
                            '<div class="content">Do you really want to delete this ' + defaults.entity + ' ?</div>' +
                            '<div class="actions">' +
                                '<div class="ui red cancel button">Cancel</div>' +
                                '<div class="ui positive button">OK</div>' +
                            '</div>' +
                        '</div>'
            } else {
                return defaults.modalD
            }
        },

        _createCreateUpdateForm: function(){
            if(defaults.modalCU == '' && defaults.fields){
                for( var i in defaults.fields){
                    if(defaults.fields[i].isArray()) {
                        console.log("Array " + defaults.fields[i])
                    } else {
                        console.log("Field " + defaults.fields[i].name)
                    }
                }
            } else {

            }
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