$(function(){

    $('#calendar').fullCalendar({
        header: {
            left: 'prev,next today',  //  prevYear nextYea
            center: 'title',
            right: 'month,agendaWeek,agendaDay',
        },  
        buttonIcons:{
            prev: 'left-single-arrow',
            next: 'right-single-arrow',
            prevYear: 'left-double-arrow',
            nextYear: 'right-double-arrow'         
        },       
//        theme:false,
//        themeButtonIcons:{
//            prev: 'circle-triangle-w',
//            next: 'circle-triangle-e',
//            prevYear: 'seek-prev',
//            nextYear: 'seek-next'            
//        },
//        firstDay:1,
//        isRTL:false,
//        weekends:true,
//        weekNumbers:false,
//        weekNumberCalculation:'local',
//        height:'auto',
//        fixedWeekCount:false,
        events: {
            url: 'data_events.php',
            error: function() {

            }
        },    
        eventLimit:true,
//        hiddenDays: [ 2, 4 ],
        lang: 'th',
        dayClick: function() {
//            alert('a day has been clicked!');
//            var view = $('#calendar').fullCalendar('getView');
//            alert("The view's title is " + view.title);
        }        
    });
  
    
});