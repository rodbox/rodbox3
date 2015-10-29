$(document).ready(function($) {

$.eventsUpd = function (event,type){
	var url = $.routeExec("user_exec_set_events");
	var data = {
            title: event.title,
            start: event.start,
            end:   event.end,
            type:type
        };
	$.post(url,data,function (json){},"JSON");
}

$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: 'month,agendaWeek,agendaDay'
			},
			defaultDate: $.now(),
			lang: 'fr',
			selectable:true,
			editable: true,
			eventLimit: true, // allow "more" link when too many events
			events: {
				url: $.routeExec("user_exec_get_events"),
				error: function() {
					alert("probleme fullCalendar");
				}

			},
			eventDrop: function (event, dayDelta, minuteDelta) {
               // $.eventsUpd(event,"upd");
           },
			eventClick:  function(event, jsEvent, view) {
       
        console.log(event);
				// $('#calendar').fullCalendar('updateEvent', event);
                var dataEvent = {
                    id:event._id,
                    title:event.title,
                    start:event._start._i,
                    end:event._end._i,
                    type:event.type,
                    descrition:event.descrition
                } 
                $.routeModal("app_view_event_edit",dataEvent,function(){
                    $('#modal-title').append('<span class="small "> : '+event.title+'</span>');
                    initDate();
                });
            	// $('#modal-title').html(event.title);
            	// $('#modal-body').html(event.type);
            	// $('#eventUrl').attr('href',event.url);
            	// $('#myModal').modal();
                console.log(jsEvent);
            	console.log(event);
        	},
        	select:function (start, end, allDay){
            var dataEvent = {
                    start:start._i,
                    end:end._i,
                    type:"",
                    descrition:""
                };
                console.log(dataEvent);
                $.routeModal("app_view_event_edit",dataEvent,function(){});
                  // ,function(){
                //     $('#modal-title').append('<span class="small "> : Nouveau</span>');
                //     initDate();
                // });




        		// var title = prompt('Event Title:');
          //   var eventData;
          //   if (title) {
          //     eventData = {
          //       title: title,
          //       start: start,
          //       end: end
          //     };
          //     $.setFlash("Evenement ajouté","info");
          //     $.eventsUpd(data,"add");
          //     $('#calendar').fullCalendar('renderEvent', eventData, true); // stick? = true
          //   }
          //   $('#calendar').fullCalendar('unselect');

        	}
		});

$(document).on("click",".removeEvent",function (e){
  e.preventDefault();  
  var t = $(this);
   $('#calendar').fullCalendar( 'removeEvents' ,t.data("id") );
   $.setFlash("Evenement supprimé","error");
  $('#myModal').modal('hide');
})



initDate();

function initDate(){
    $("input[type='date']").not("[name=UserDateBorn]").datepicker({
      format: "dd/mm/yyyy",
      startDate: "01/01/1900",
      endDate: "31/12/2100",
      todayBtn: true,
      clearBtn: true,
      language: "fr",
      calendarWeeks: true,
      todayHighlight: true
    });
}



/* Pour facilité la saisie d'ancienne date */
$("input[type='date'][name=UserDateBorn]").datepicker({
  startView: 2,
  format: "dd/mm/yyyy",
  startDate: "01/01/1900",
  endDate: "31/12/2100",
  language: "fr"
});

/**** NE FONCTIONNE PAS ????? alors que bien charger par l'autoload ****/
  $('[data-toggle="tooltip"]').tooltip();
  $("[rel='tooltip']").tooltip('show');
 
/**** END NE FONCTIONNE PAS ????? ****/
});