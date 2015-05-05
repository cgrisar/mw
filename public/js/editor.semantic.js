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

        sEditor.prototype._constructor = function ( init ) {
            this.options = $.extend( true, {}, sEditor.defaults, init );
            this.options.modalCU = $(sEditor.CUForm().create(init.fields))
           // init.modalD = $(this.createDForm());
        };

        sEditor.prototype.show = function(action){
            if(action != 'delete') {
                var form = '#' + this.options.entity + "CUForm";
                $("body").append(this.options.modalCU);
                $(form)
                    .modal('show');
                /*
                    .modal({
                        onShow: function(){
                            var settings = $(this).settings;

                            $(form + " .field")
                                .removeClass("error");
                            $(form + " .field :input")
                                .attr("placeholder", "")
                                .val("");
                        }
/*
                        onApprove: function () {

                            var $_token = $('#token').val();
                            var dataJs = {
                                address: $("#address").val(),
                                zip: $("#zip").val(),
                                county: $("#county").val(),
                                country: $("#country").val(),
                                tel: $("#tel").val(),
                                email: $("#email").val()
                            };

                            $.ajax({
                                type: 'POST',
                                async: false,
                                headers: {'X-XSRF-TOKEN': $_token},
                                dataType: 'json',
                                data: dataJs,
                                url: '/admin/relationshipTmpAddressesStoreAjax',

                                success: function(){
                                    ajaxSucceeded = true;
                                    console.log('did it')
                                },

                                error: function (xhr, textstatus, errorThrown) {
                                    ajaxSucceeded = false;
                                    $.each(JSON.parse(xhr.responseText), function (index, element) {
                                        $('#' + index)
                                            .attr("placeholder", element)
                                            .parent().addClass("error")

                                    });
                                }
                            });

                            $('#adressesTable').DataTable().ajax.reload();
                            return ajaxSucceeded;

                        }

                    })
*/
            }
        };

        sEditor.CUForm = {};
        sEditor.CUForm.prototype = {
            modalH: function() {
                return '<div class="ui modal" id=">' + this.options.entity + 'CUForm">' +
                    '<i class="close icon"></i>' +
                    '<div class="header">' + this.options.entity + '</div>' +
                    '<div class="content">' +
                    '<div class="ui form">';
            },

            modalE: function(){
                return          '</div>' +       // form
                    '</div>' +              // content
                    '<div class="actions">' +
                    '<div class="ui red cancel button">Cancel</div>' +
                    '<div class="ui positive button">Save</div>' +
                    '</div>' +
                    '</div>';
            },

            create: function (fields) {
                return this.modalH() + this.addFields(fields) + this.modalE();
            },

            addFields: function (fields) {
                var enumerator = ['one', 'two', 'three', 'four', 'five'];

                // opening modal, content and form divs
                var modalCU = '';

                // add the fields
                for (var i = 0, iLen = fields.length; i < iLen; i++) {
                    if (fields[i].structure == "multiple") {
                        modalCU += '<div class="' + enumerator[fields[i - 1].field.length] + ' fields">' +
                        this.CUForm.addFields(fields[i].field) +
                        '</div>';
                    } else {
                        modalCU += '<div class="field">' +
                        '<label>' + fields[i].label + '</label>' +
                        '<input type="text" name="' + fields[i].name + '">' +
                        '</div>';
                    }
                }
                console.log(modalCU);
                return modalCU;
            }
        }

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