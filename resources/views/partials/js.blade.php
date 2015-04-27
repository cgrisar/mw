<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<!--
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.2/js/bootstrap.min.js" type="text/javascript"></script>
-->
<script src="/js/semantic.js" type="text/javascript"></script>
<script src="/js/jquery.dataTables.js" type="text/javascript"></script>
<script src="/js/dataTables.tableTools.js" type="text/javascript"></script>
<script src="/js/dataTables.editor.js" type="text/javascript"></script>
<script src="/js/dataTables.semanticpluginv2.js" type="text/javascript"></script>
<script src="/js/editor.semantic.js" type="text/javascript"></script>
<!-- scripts related to semantic -->

<script>

    /* activate the dropdowns */
    $('.ui.dropdown')
            .dropdown();


    /* activate the message close icons */
    $('.message .close').on('click', function() {
        $(this).closest('.message').transition('fade down', '500ms');
    });

</script>

