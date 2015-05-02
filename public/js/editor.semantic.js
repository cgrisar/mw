/**
 * Created by charlesgrisar on 20/04/15.
 */
(function($) {
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
                for
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

Editor.prototype.add = function ( cfg )
{
    // Allow multiple fields to be added at the same time
    if ( $.isArray( cfg ) ) {
        for ( var i=0, iLen=cfg.length ; i<iLen ; i++ ) {
            this.add( cfg[i] );
        }
    }
    else {
        var name = cfg.name;

        if ( name === undefined ) {
            throw "Error adding field. The field requires a `name` option";
        }

        if ( this.s.fields[ name ] ) {
            throw "Error adding field '"+name+"'. A field already exists with this name";
        }

        // Allow the data source to add / modify the field properties
        // Dev: would this be better as an event `preAddField`? And have the
        // data sources init only once, but can listen for such events? More
        // complexity, but probably more flexible...
        this._dataSource( 'initField', cfg );

        this.s.fields[ name ] = new Editor.Field( cfg, this.classes.field, this );
        this.s.order.push( name );
    }

    return this;
};