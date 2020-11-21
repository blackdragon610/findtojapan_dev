<script type="text/javascript" src="/js/tinymce/tinymce.min.js"></script>
<script type="text/javascript">
    tinymce.init({
        selector : '#editor_{{$name}}',
        plugins  : 'link autolink preview',
        toolbar  : 'bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link | preview',
        menubar  : false,
        formats : {
            underline : {inline : 'u', exact : true}
        },
        relative_urls : false
    });
</script>


<?php if (!empty($isConfirmation)){ ?>
	<?php echo getVariable($inputs, $name); ?>
	<input type="hidden" name="{{$name}}" value="{{getVariable($inputs, $name)}}" />
<?php }else{ ?>
	<textarea style="height:40em;" id="editor_{{$name}}" name="{{$name}}" <?php echo $contents; ?>><?php echo getVariable($inputs, $name); ?></textarea>

    @include('layouts.parts.editor.error')
<?php } ?>
