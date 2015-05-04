(function( window, document, undefined ) {

    var factory = function( $, DataTable ) {
        "use strict";


        if ( ! DataTable || ! DataTable.versionCheck || ! DataTable.versionCheck('1.10') ) {
            throw 'Editor requires DataTables 1.10 or newer';
        }


        var sEditor = function ( opts )
        {
            if ( ! this instanceof sEditor ) {
                alert( "DataTables Editor must be initialised as a 'new' instance'" );
            }

            this._constructor( opts );
        };

        // Export Editor as a DataTables property
        DataTable.sEditor = sEditor;
        $.fn.DataTable.sEditor = sEditor;

        sEditor.prototype._constructor = function ( init )
        {
            init = $.extend( true, {}, sEditor.defaults, init );
            this.s = $.extend( true, {}, sEditor.models.settings, {
                table:      init.domTable || init.table,
                dbTable:    init.dbTable || null, // legacy
                ajaxUrl:    init.ajaxUrl,
                ajax:       init.ajax,
                idSrc:      init.idSrc,
                dataSource: init.domTable || init.table ?
                    Editor.dataSources.dataTable :
                    Editor.dataSources.html,
                formOptions: init.formOptions
            } );
        };

        sEditor.prototype.addFields = function(fields){
            var fieldWrapper = '';

            for(var i=0, iLen = fields.length; i < iLen; i++){
                if(fields[i].structure == "multiple"){
                    fieldWrapper = fieldWrapper + '<div class="multiple">';
                    this.addFields(fields[i].field);
                    fieldWrapper = fieldWrapper + '</div>'
                } else {
                    fieldWrapper = fieldWrapper + '<div class="field"> ' +
                    fields[i].label +
                    ' </div>';
                }
            }
            return fieldWrapper
        };

        sEditor.models = {};
        sEditor.models.settings = {
            "ajaxUrl": null,

            /**
             * Ajax submit function.
             * This is directly set by the initialisation parameter / default of the same name.
             *  @type function
             *  @default null
             */
            "ajax": null,

            /**
             * Data source for get and set data actions. This allows Editor to perform
             * as an Editor for virtually any data source simply by defining additional
             * data sources.
             *  @type object
             *  @default null
             */
            "dataSource": null,

            /**
             * DataTable selector, can be anything that the Api supports
             * This is directly set by the initialisation parameter / default of the same name.
             *  @type string
             *  @default null
             */
            "domTable": null,

            /**
             * The initialisation object that was given by the user - stored for future reference.
             * This is directly set by the initialisation parameter / default of the same name.
             *  @type string
             *  @default null
             */
            "opts": null,

            /**
             * The display controller object for the Form.
             * This is directly set by the initialisation parameter / default of the same name.
             *  @type string
             *  @default null
             */
            "displayController": null,

            /**
             * The form fields - see {@link Editor.models.field} for details of the
             * objects held in this array.
             *  @type object
             *  @default null
             */
            "fields": {},

            /**
             * Field order - order that the fields will appear in on the form. Array of strings,
             * the names of the fields.
             *  @type array
             *  @default null
             */
            "order": [],

            /**
             * The ID of the row being edited (set to -1 on create and remove actions)
             *  @type string
             *  @default null
             */
            "id": -1,

            /**
             * Flag to indicate if the form is currently displayed (true) or not (false)
             *  @type string
             *  @default null
             */
            "displayed": false,

            /**
             * Flag to indicate if the form is current in a processing state (true) or not (false)
             *  @type string
             *  @default null
             */
            "processing": false,

            /**
             * Developer provided identifier for the elements to be edited (i.e. at
             * `dt-type row-selector` to select rows to edit or delete.
             *  @type array
             *  @default null
             */
            "modifier": null,

            /**
             * The current form action - 'create', 'edit' or 'remove'. If no current action then
             * it is set to null.
             *  @type string
             *  @default null
             */
            "action": null,

            /**
             * JSON property from which to read / write the row's ID property.
             *  @type string
             *  @default null
             */
            "idSrc": null};

        sEditor.defaults = {
            entity:     '',
            fields:     '{}',
            url:        '',
            action:     '',
            modalCU:    '',
            modalD:     ''
        };

        sEditor.methods = {

            // initialisation method
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


        return sEditor;
    };

    if ( typeof define === 'function' && define.amd ) {
        // Define as an AMD module if possible
        define( ['jquery', 'datatables'], factory );
    }
    else if ( typeof exports === 'object' ) {
        // Node/CommonJS
        factory( require( 'jquery' ), require( 'datatables' ) );
    }
    else if ( jQuery && !jQuery.fn.dataTable.sEditor ) {
        // Otherwise simply initialise as normal, stopping multiple evaluation
        factory( jQuery, jQuery.fn.dataTable );
    }

}(window, document));