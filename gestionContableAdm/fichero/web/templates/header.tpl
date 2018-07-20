<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es-AR" lang="es-AR">
    <head>
        <title>Fichero Morosos - {$title}</title>
        <base href="{f_basehref}" />

        <meta name="Robots" content="No-Index,No-Follow">
        <meta http-equiv="content-language" content="es-AR" />
        <meta name="copyright" content="Copyright 2007-{$smarty.now|date_format:"%Y"}." />
        <meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
        <link rel="stylesheet" href="css/screen.css" type="text/css" media="screen" title="default" />
        <!--[if IE]>
        <link rel="stylesheet" media="all" type="text/css" href="css/pro_dropline_ie.css" />
        <![endif]-->

        <!--  jquery core -->
        <script src="js/jquery/jquery-1.4.1.min.js" type="text/javascript"></script>

        {if $section != "login"}
            <script src="js/common.js" type="text/javascript"></script>


            <!--  checkbox styling script -->
            <script src="js/jquery/ui.core.js" type="text/javascript"></script>
            <script src="js/jquery/ui.checkbox.js" type="text/javascript"></script>
            <script src="js/jquery/jquery.bind.js" type="text/javascript"></script>
            <script type="text/javascript">

            $(function(){ldelim}
	            $('input').checkBox();
	            $('#toggle-all').click(function(){ldelim}
             	$('#toggle-all').toggleClass('toggle-checked');
	            $('#mainform input[type=checkbox]').checkBox('toggle');
	            return false;
	            {rdelim});
            {rdelim});
            </script>

            <![if !IE 7]>

            <!--  styled select box script version 1 -->
            <script src="js/jquery/jquery.selectbox-0.5.js" type="text/javascript"></script>
            <script type="text/javascript">
            $(document).ready(function() {ldelim}
	            $('.styledselect').selectbox({ldelim} inputClass: "selectbox_styled" {rdelim});
            {rdelim});
            </script>


            <![endif]>

            <!--  styled select box script version 2 -->
            <script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
            <script type="text/javascript">
            $(document).ready(function() {ldelim}
	            $('.styledselect_form_1').selectbox({ldelim} inputClass: "styledselect_form_1" {rdelim});
	            $('.styledselect_form_2').selectbox({ldelim} inputClass: "styledselect_form_2" {rdelim});
            {rdelim});
            </script>

            <!--  styled select box script version 3 -->
            <script src="js/jquery/jquery.selectbox-0.5_style_2.js" type="text/javascript"></script>
            <script type="text/javascript">
            $(document).ready(function() {ldelim}
	            $('.styledselect_pages').selectbox({ldelim} inputClass: "styledselect_pages" {rdelim});
            {rdelim});
            </script>

            <!--  styled file upload script -->
            <script src="js/jquery/jquery.filestyle.js" type="text/javascript"></script>
            <script type="text/javascript" charset="utf-8">
              $(function() {ldelim}
                  $("input.file_1").filestyle({ldelim}
                      image: "images/forms/choose-file.gif",
                      imageheight : 21,
                      imagewidth : 78,
                      width : 310
                  {rdelim});
              {rdelim});
            </script>

            <!-- Custom jquery scripts -->
            <script src="js/jquery/custom_jquery.js" type="text/javascript"></script>

            <!-- Tooltips -->
            <script src="js/jquery/jquery.tooltip.js" type="text/javascript"></script>
            <script src="js/jquery/jquery.dimensions.js" type="text/javascript"></script>
            <script type="text/javascript">
            $(function() {ldelim}
	            $('a.info-tooltip ').tooltip({ldelim}
		            track: true,
		            delay: 0,
		            fixPNG: true,
		            showURL: false,
		            showBody: " - ",
		            top: -35,
		            left: 5
	            {rdelim});
            {rdelim});
            </script>
            
            {literal}
            <!--  date picker script -->
            <link rel="stylesheet" href="css/datePicker.css" type="text/css" />
            <script src="js/jquery/date.js" type="text/javascript"></script>
            <script src="js/jquery/jquery.datePicker.js" type="text/javascript"></script>
            <script type="text/javascript" charset="utf-8">
                    $(function()
            {

            // initialise the "Select date" link
            $('#date-pick')
	            .datePicker(
		            // associate the link with a date picker
		            {
			            createButton:false,
			            startDate:'01/01/2005',
			            endDate:'31/12/2030'
		            }
	            ).bind(
		            // when the link is clicked display the date picker
		            'click',
		            function()
		            {
		                //var today = new Date();
                        //updateSelects(today.getTime());
			            //updateSelects($(this).dpGetSelected()[0]);
			            $(this).dpDisplay();
			            return false;
		            }
	            ).bind(
		            // when a date is selected update the SELECTs
		            'dateSelected',
		            function(e, selectedDate, $td, state)
		            {
			            updateSelects(selectedDate);
		            }
	            ).bind(
		            'dpClosed',
		            function(e, selected)
		            {
			            updateSelects(selected[0]);
		            }
	            );
	
            var updateSelects = function (selectedDate)
            {
                /*
                alert(selectedDate);
                if(this.selectedDate == undefined) {
                    var selectedDate = new Date();
                    alert(1);
                }else{
                    var selectedDate = new Date(selectedDate);
                    alert(2);
                }
                */

                //var selectedDate = new Date(selectedDate);
	            
	            //$('#d option[value=' + selectedDate.getDate() + ']').attr('selected', 'selected');
	            //$('#m option[value=' + (selectedDate.getMonth()+1) + ']').attr('selected', 'selected');
	            //$('#y option[value=' + (selectedDate.getFullYear()) + ']').attr('selected', 'selected');
	            document.getElementById('fechas').value = selectedDate.getFullYear()+'-'+(selectedDate.getMonth()+1)+'-'+selectedDate.getDate();
	            //document.getElementById('fechas').value = selectedDate.getDate()+'-'+(selectedDate.getMonth()+1)+'-'+selectedDate.getFullYear();
            }
            

            // default the position of the selects to today
            var today = new Date();
            updateSelects(today.getTime());

            });
            </script>
            {/literal}
        {/if}

        <!-- MUST BE THE LAST SCRIPT IN <HEAD></HEAD></HEAD> png fix -->
        <script src="js/jquery/jquery.pngFix.pack.js" type="text/javascript"></script>
        <script type="text/javascript">
        $(document).ready(function(){ldelim}
        $(document).pngFix( );
        {rdelim});
        </script>


</head>

{if $section=="login"}
    <body id="login-bg">
{else}
    <body>
    {include file="botonera.tpl"}
{/if}

