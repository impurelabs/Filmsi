<script type="text/javascript" src="/js/vendor/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">

  tinyMCE.init({
    // General options
	  mode : "specific_textareas",
	  editor_selector : "mceEditor",
    theme : "advanced",
	skin: "emo-skin-0",
    plugins : "advlink,media,searchreplace,contextmenu,xhtmlxtras,wordcount,advlist,imagemanager",

    // Theme options
    theme_advanced_buttons1 : "bold,italic,underline,strikethrough,|,link,unlink|,outdent,indent,|,forecolor,backcolor",
    theme_advanced_buttons2 : "formatselect,|,bullist,numlist,justifyleft,justifycenter,justifyright,justifyfull,|,",
    theme_advanced_buttons3 : "",
    theme_advanced_toolbar_location : "external",
    theme_advanced_toolbar_align : "left",
    theme_advanced_statusbar_location : "bottom",
    theme_advanced_resize_horizontal : false,
    theme_advanced_resizing : true,

    width: <?php echo $width?>,
    height: <?php echo $height?>,

    // Example content CSS (should be your site CSS)
    content_css : "/css/editor.css"

  }); 
</script>