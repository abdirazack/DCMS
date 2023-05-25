    var calendar;
    var Calendar = FullCalendar.Calendar;
     var events = [];


$(function() {
        var events = []
        if (!!scheds) {
            Object.keys(scheds).map(k => {
                var row = scheds[k];
                events.push({ 
                    id: row.appointment_id , 
                    title: row.patient_first_name + ' ' + row.patient_last_name, 
                    start: row.start_date, 
                    end: row.end_date  
                });
            })
}
        var date = new Date()
        var d = date.getDate(),
            m = date.getMonth(),
            y = date.getFullYear()

        calendar = new Calendar(document.getElementById('calendar'), {
            headerToolbar: {
                left: 'prev next today',
                right: 'dayGridMonth,dayGridWeek,list,day',
                center: 'title',
            },
            navLinks: true, // can click day/week names to navigate views
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            dropable: true,
            selectHelper: true,
            themeSystem: 'bootstrap',
            //Random default events
            events: events,
            eventClick: function(info) {
                var _details = $('#event-details-modal')
                var id = info.event.id
                if (!!scheds[id]) {
                    _details.find('#patient').text(scheds[id].patient_first_name + ' ' + scheds[id].patient_last_name)
                    _details.find('#dentist').text(scheds[id].dentist_first_name + ' ' + scheds[id].dentist_last_name)
                    _details.find('#start').text(scheds[id].start_date)
                    _details.find('#end').text(scheds[id].end_date)
                    _details.find('#edit,#delete').attr('data-id', id)
                    _details.modal('show')
                } else {
                    alert("Event is undefined");
                }
            },
            eventDidMount: function(info) {
                // Do Something after events mounted
            },
            editable: true,
            //handle eventDrop function
            eventDrop: function(info) {
                var id = info.event.id
                var start = info.event.start
                var end = info.event.end
                $.ajax({
                    url: './app/appointments/update.php',
                    type: 'POST',
                    data: {
                        id: id,
                        start: start,
                        end: end
                    },
                    success: function(response) {
                        if (response == 1) {
                            alert('Event updated');
                        } else {
                            alert('Event not updated');
                        }
                    }
                })
            },
        });

        calendar.render();

        // Form reset listener
        $('#schedule-form').on('reset', function() {
            $(this).find('input:hidden').val('')
            $(this).find('input:visible').first().focus()
        })

    })