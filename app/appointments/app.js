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
                title: row.patient_first_name + ' ' + row.patient_last_name,
                start: row.start_date,
                end: row.end_date
            });
        })
    }

    var date = new Date()
    var h = (date.getHours() < 10 ? '0' : '') + date.getHours(),
        m = (date.getMinutes() < 10 ? '0' : '') + date.getMinutes(),
        s = date.getSeconds()
    var time = h + ":" + m + ":" + s;


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
                _details.find('#patient').text(scheds[id].patient_first_name + ' ' + scheds[id].patient_last_name)
                _details.find('#employee_id').text(scheds[id].employee_first_name + ' ' + scheds[id].employee_last_name)
                _details.find('#start').text(scheds[id].start_date)
                _details.find('#end').text(scheds[id].end_date)
                _details.find('#edit,#delete').attr('data-id', id)
                _details.modal('show')
            } else {
                alert("Event is undefined");
            }
        },
        eventDidMount: function (info) {
            // Do Something after events mounted
        },
        editable: true,
        //handle eventDrop function
        eventDrop: function (info) {
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
                success: function (response) {
                    if (response == 1) {
                        alert('Event updated');
                    } else {
                        alert('Event not updated');
                    }
                }
            })
        },
        // javascript get current time


        //when event is selected
        select: function (info) {
            var start = info.startStr
            var end = info.endStr
            $('#schedule-form').find('#start_datetime').val(start + 'T' + time)
            $('#schedule-form').find('#end_datetime').val(end + 'T' + time)
        }
    });

    calendar.render();

    // Form reset listener
    $('#schedule-form').on('reset', function () {
        $(this).find('input:hidden').val('')
        $(this).find('input:visible').first().focus()
    })



})