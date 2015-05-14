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

        sEditor.defaults = {
            parent:     '',
            entity:     '',
            fields:     '{}',
            url:        '/admin/',
            action:     '',
            modalCU:    '',
            modalD:     ''
        };

        sEditor.prototype._constructor = function ( init ) {
            this.options = $.extend( true, {}, sEditor.defaults, init );
            this.options.modalCU = $(sEditor.CUForm.create(this.options));
            this.options.modalD = $(sEditor.DForm.create(this.options))
        };

        sEditor.prototype.show = function(action){
            if (action != 'delete') {
                var entity = this.options.entity;
                var form = '#' + entity + "CUForm";
                var tmpTable = this.options.url + 'tmp' + entity + 'StoreAjax';

                if (action = 'edit') {
                    // fill the fields with the data from the record

                };

                $("body").append(this.options.modalCU);
                $(form)
                    .modal({

                        onShow: function() {
                            var settings = $(this).settings;

                            $(form + " .field")
                                .removeClass("error");
                            $(form + " .field :input")
                                .attr("placeholder", "")
                                .val("")
                        },

                        onApprove: function() {
                            var dataJS = {};
                            var ajaxSucceeded = false;

                            // loop through all the input tags
                            $(form + ' :input').each(function(index, data) {
                                var key = $(this).attr("name");
                                var value = $(this).val();
                                dataJS[key] = value
                            });
                            console.log(dataJS);
                            $.ajax({
                                type: 'POST',
                                async: false,
                                headers: { 'X-CSRF-Token': $('meta[name="_token"]').attr('content') },
                                dataType: 'json',
                                data: dataJS,
                                url: tmpTable,

                                success: function(){
                                    ajaxSucceeded = true;
                                    console.log('did it')
                                },

                                error: function (xhr, textstatus, errorThrown) {
                                    ajaxSucceeded = false;
                                    $.each(JSON.parse(xhr.responseText), function (index, element) {
                                        $("input[name=" + index + "]")
                                            .attr("placeholder", element)
                                            .parent().addClass("error")

                                    });
                                }
                            });

                            $('#' + entity +'Table').DataTable().ajax.reload();
                            return ajaxSucceeded

                        }
                    })
                    .modal('show');

            } else {    // it's a Delete
                var form = '#' + this.options.entity + "DForm";
                $("body").append(this.options.modalD);
                $(form)
                    .modal('show');

            }
        };

        sEditor.CUForm = {
            modalH: function(entity) {
                return '<div class="ui modal" id="' + entity + 'CUForm">' +
                    '<i class="close icon"></i>' +
                    '<div class="header">' + entity + '</div>' +
                    '<div class="content">' +
                    '<div class="ui form">';
            },

            modalE: function(entity){
                return      '</div>' +       // form
                        '</div>' +              // content
                        '<div class="actions">' +
                            '<div class="ui red cancel button">Cancel</div>' +
                            '<div class="ui positive button">Save</div>' +
                        '</div>' +
                    '</div>';
            },

            create: function (options) {
                return this.modalH(options.entity) + this.addFields(options.fields) + this.modalE();
            },

            addFields: function (fields) {
                var enumerator = ['one', 'two', 'three', 'four', 'five'];

                // opening modal, content and form divs
                var modalCU = '';

                // add the fields
                for (var i = 0, iLen = fields.length; i < iLen; i++) {
                    if (fields[i].structure == "multiple") {
                        modalCU += '<div class="' + enumerator[fields[i].field.length - 1] + ' fields">' +
                        this.addFields(fields[i].field) +
                        '</div>';
                    } else {
                        var tmpModalCU =
                            '<div class="field">' +
                                '<label>' + fields[i].label + '</label>' +
                                '<input type="text" name="' + fields[i].name + '">' +
                            '</div>';
                        if (fields[i].width) {
                            tmpModalCU = '<div class="' + fields[i].width + ' wide field">' + tmpModalCU + '</div>'
                        }
                        modalCU += tmpModalCU
                    }
                }

                return modalCU;
            }
        };

        sEditor.DForm = {
            create: function(options){
                if(options.modalD == '') {
                    return  '<div class="ui modal" id="' + options.entity + 'DForm">' +
                                '<i class="close icon"></i>' +
                                '<div class="header">Delete</div>' +
                                    '<div class="content">Do you really want to delete this ' + options.entity + ' ?</div>' +
                                        '<div class="actions">' +
                                            '<div class="ui red cancel button">Cancel</div>' +
                                            '<div class="ui positive button">OK</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>' +
                            '</div>';
                } else {
                    return options.modalD
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