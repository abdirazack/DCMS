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
                    title: row.first_name , 
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
            editable: true,
            eventLimit: true, // allow "more" link when too many events
            selectable: true,
            selectHelper: true,
            themeSystem: 'bootstrap',
            //Random default events
            events: events,
            eventClick: function(info) {
                var _details = $('#event-details-modal')
                var id = info.event.id
                if (!!scheds[id]) {
                    _details.find('#title').text(scheds[id].first_name)
                    _details.find('#description').text(scheds[id].service)
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
            editable: true
        });

        calendar.render();

        // Form reset listener
        $('#schedule-form').on('reset', function() {
            $(this).find('input:hidden').val('')
            $(this).find('input:visible').first().focus()
        })

    })