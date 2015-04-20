@extends('templates.1column')

@section('content')

    <h2 class="ui header">Create Relationship</h2>

    <h3 class="ui dividing header">Relationship information
        <div class="floatrighticon">
            <a href="{!! url('relationships/create') !!}" title="Save">
                <i class="black save circle icon"></i>
            </a>
            <a title="Cancel">
                <i class="red cancel circle icon"></i>
            </a>
        </div>
    </h3>

    {!! Form::open(['class' => 'ui form', 'url' => 'relationships/create']) !!}
        <div class="ui grid">
            <div class="row">
                <div class="eight wide column">

                    @include('partials.errors')


                    <div class="required field">
                        <label for="name">Name</label>
                        <input type="text" placeholder="Name" name="name" value="{{old('name')}}" class="six wide column">
                    </div>

                    <div class="required field">
                        <label for="vat">VAT</label>
                        <input type="text" placeholder="VAT" name="vat" value="{{old('vat')}}">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="twelve wide column">
                    <div class="hidden divider"></div>
                    <h4 class="ui dividing header">Adresses
                        <div class="floatrighticon">
                            <i class="green plus icon" title="Create a new address"></i>
                        </div>
                    </h4>
                    <table id="adressesTable" class="ui sortable table verticalalign">
                        <thead>
                            <tr>
                                <th class="one wide">Type</th>
                                <th class="six wide">Address</th>
                                <th class="two wide">Phone</th>
                                <th class="two wide">Email</th>
                            </tr>
                        </thead>
                    </table>

                    {!! Form::submit('Save', ['class' => 'ui blue right floated button']) !!}

                </div>
            </div>
        </div>
    {!! Form::close() !!}

    <!-- modal dialog for adding an address -->
    <div class="ui modal" id="createAddress">
        <div class="header">
            Adresses
        </div>
        <div class="content">
            <div class="ui form" id="createAddressForm">
                <?php
                $encrypter = app('Illuminate\Encryption\Encrypter');
                $encrypted_token = $encrypter->encrypt(csrf_token());
                ?>
                <input id="token" type="hidden" value="{{$encrypted_token}}">

                <div class="required field">
                    <label>Address</label>
                    <input type="text" id="address">
                </div>
                <div class="two fields">
                    <div class="field">
                        <label>Zip</label>
                        <input type="text" id="zip">
                    </div>
                    <div class="field">
                        <label>County</label>
                        <input type="text" id="county">
                    </div>
                </div>
                <div class="field">
                    <label>Country</label>
                    <input type="text" id="country">
                </div>
                <div class="field">
                    <label>Phone</label>
                    <input type="text" id="phone">
                </div>
                <div class="field">
                    <label>E-mail</label>
                    <input type="text" id="email">
                </div>
            </div>
        </div>
        <div class="actions">
            <div class="ui red cancel button">Cancel</div>
            <div class="ui positive button">Save</div>
        </div>
    </div>
@endsection

@section('dTScript')
    <script>
        $(document).ready(function(){

            // New record
            $('i.plus').on('click', function (e) {
                e.preventDefault();
                var ajaxSucceeded = false;

                $('#createAddress')
                        .modal({
                            onShow: function(){
                                var settings = $(this).settings;

                                $("#createAddressForm .field")
                                        .removeClass("error");
                                $("#createAddressForm .field :input")
                                        .attr("placeholder", "")
                                        .val("");
                                alert(settings.action)
                            },

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

                                return ajaxSucceeded;

                            }
                        })
                        .modal('show')
            } );

            $('#createAddressForm .field').change(function(){
                $(this).removeClass("error")
            });

            $('#adressesTable').dataTable({

                "layout": '<div data-feature="dt_Table"></div>',

                "ajax": "/admin/relationshipAddressesAjax",

                "columns": [
                    { "data": null,
                      "render": function(row, type, val, meta){
                          return "1"
                      }
                    },
                    { "data": null,
                      "render": function(row, type, val, meta){
                          return row.address + "</br>" + row.zip + "&nbsp;" + row.county + "</br>" + row.country
                      }},
                    { "data": "phone" },
                    { "data": "email" }
                ]
              });

            $('.ui.dropdown')
                    .dropdown();
        });
    </script>
@stop