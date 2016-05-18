<? include 'header.php';?>
<link rel='stylesheet' type='text/css' href='fullcalendar/redmond/theme.css' />  
<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.css' />  
<script type='text/javascript' src='fullcalendar/jquery/jquery.js'></script>  
<script type='text/javascript' src='fullcalendar/jquery/jquery-ui-custom.js'></script>  
<script type="text/javascript" src="fullcalendar/fullcalendar.min.js"></script>


<!--<link rel='stylesheet' type='text/css' href='fullcalendar/redmond/theme.css' />  
<link rel='stylesheet' type='text/css' href='fullcalendar/fullcalendar.css' />
<link rel="stylesheet" type='text/css' href="fullcalendar/js/fullcalendar-2.1.1/fullcalendar.min.css">
<script type='text/javascript' src='fullcalendar/jquery/jquery.js'></script>  
<script type='text/javascript' src='fullcalendar/jquery/jquery-ui-custom.js'></script>
<script type='text/javascript' src="fullcalendar/js/fullcalendar-2.1.1/lib/jquery.min.js"></script>
<script type="text/javascript" src="fullcalendar/js/fullcalendar-2.1.1/lib/moment.min.js"></script>
<script type="text/javascript" src="fullcalendar/js/fullcalendar-2.1.1/lang/th.js"></script>
<script type="text/javascript" src="fullcalendar/js/fullcalendar-2.1.1/fullcalendar.min.js"></script>  -->

<script type="text/javascript">
            $(function() {
                $('#calendar').fullCalendar({
                    header: {
                        left: 'month,agendaWeek,agendaDay',
                        center: 'title',
                        right: 'prev,next today'
                    },
                    editable: true,
                    theme: true,
                    events: "getCalendar.php?gData=1",
                    loading: function(bool) {
                        if (bool)
                            $('#loading').show();
                        else
                            $('#loading').hide();
                    },
                    eventLimit:true,  
                    lang:'th'// put your options and callbacks here  
                });

            });
        </script>  

        <style type="text/css">  
            body{  
                padding:0px;  
                margin:0px;  
                font-size:14px;  
                font-family:Tahoma, Geneva, sans-serif;
            }  
            #calendar{  
                width:750px;      
                margin:auto;  
            }  
        </style>  
<br />  
<br /> <br />  
<div id="calendar"></div>  
  
</body>  
</html>  