    var calendar;
    var Calendar = FullCalendar.Calendar;
    // var events = [];


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
                right: 'dayGridMonth,dayGridWeek,list',
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

        // Edit Button
        $('#edit').click(function() {
            var id = $(this).attr('data-id')
            if (!!scheds[id]) {
                var _form = $('#schedule-form')
                //console.log(String(scheds[id].start_datetime), String(scheds[id].start_datetime).replace(" ", "\\t"))
                console.log(scheds[id].appointment_id)
                _form.find('[name="id"]').val(scheds[id].appointment_id)
                _form.find('[name="patients"]').val(scheds[id].first_name)
                _form.find('[name="service"]').val(scheds[id].service)
                _form.find('[name="start_datetime"]').val(String(scheds[id].start_date).replace(" ", "T"))
                _form.find('[name="end_datetime"]').val(String(scheds[id].end_date).replace(" ", "T"))
                $('#event-details-modal').modal('hide')
                _form.find('[name="title"]').focus()
            } else {
                alert("Event is undefined");
            }
        })

        // Delete Button / Deleting an Event
        $('#delete').click(function() {
            var id = $(this).attr('data-id')
            if (!!scheds[id]) {
                var _conf = confirm("Are you sure to delete this scheduled event?");
                if (_conf === true) {
                    //location.href = "appointments/delete.php?id=" + scheds[id].appointment_id;
                    
                    $.ajax({
                        url:"appointments/delete.php",
                        type:"post",
                        data:{id:scheds[id].appointment_id},
                          success:function(data){
                            var obj = jQuery.parseJSON(data);
                            if (obj.status == 200) {
                                //close modal 
                                $('#event-details-modal').modal('hide');
                                //reload calendar
                                calendar.refetchEvents();
                                //reload page
                                location.reload();
                            }
                            if (obj.status == 404) {
                               // $("#state").text(obj.message);
                               alert(obj.message);
                            }
                        }
                      });

                }
            } else {
                alert("Event is undefined");
            }
        })
    })