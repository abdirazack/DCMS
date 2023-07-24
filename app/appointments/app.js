var calendar;
var Calendar = FullCalendar.Calendar;
var events = [];


$(function () {
    var events = []
    if (!!scheds) {
        Object.keys(scheds).map(k => {
            var row = scheds[k];
            events.push({
                id: row.appointment_id,
                title: row.patient_name,
                start: row.date,
                // end: row.date,

            });  
        })
    }
    

    calendar = new Calendar(document.getElementById('calendar'), {
        headerToolbar: {
            left: 'prev next today',
            right: 'dayGridMonth,dayGridWeek,list,day',
            center: 'title',
        },
        navLinks: true, // can click day/week names to navigate views
        selectable: true,
        themeSystem: 'bootstrap',
        //Random default events
        events: events,
        eventClick: function (info) {
            var _details = $('#event-details-modal')
            var id = info.event.id
            if (!!scheds[id]) {
                _details.find('#patient').text(scheds[id].patient_name)
                _details.find('#employee').text(scheds[id].employee_name)
                _details.find('#date').text(scheds[id].date)
                _details.find('#time').text(scheds[id].time)
                _details.find('#edit,#delete').attr('data-id', id)
                _details.modal('show')
            } else {
                alert("Event is undefined");
            }
        },
        eventDidMount: function (info) {
            // Do Something after events mounted
        },
    });

    calendar.render();
})

