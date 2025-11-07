@push('styles')
    <link href='https://unpkg.com/@fullcalendar/core@6.1.8/main.min.css' rel='stylesheet' />
    <link href='https://unpkg.com/@fullcalendar/daygrid@6.1.8/main.min.css' rel='stylesheet' />

    <style>
    /* Estilos personalizados para el calendario */
    .fc { font-family: inherit; }
    .fc .fc-toolbar-title { font-size: 1.2em; font-weight: bold; }
    .fc .fc-button { background-color: #f8f9fa; border-color: #dee2e6; color: #212529; }
    .fc .fc-button-primary:not(:disabled).fc-button-active,
    .fc .fc-button-primary:not(:disabled):active { background-color: #0d6efd; border-color: #0d6efd; }
    .fc-daygrid-event { border-radius: 3px; padding: 2px 4px; font-size: 0.8em; color: #fff; }
    .fc-event-title { color: #fff !important; }
    </style>
@endpush


    <script src='https://unpkg.com/@fullcalendar/core@6.1.8/index.global.min.js'></script>
    <script src='https://unpkg.com/@fullcalendar/daygrid@6.1.8/index.global.min.js'></script>
    
    <script src='https://unpkg.com/@fullcalendar/core@6.1.8/locales-all.global.min.js'></script>
    
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        var calendarEl = document.getElementById('calendario-asistencias');
        if (calendarEl) {
            
            // Verificamos si la variable existe (para evitar errores si no estamos en la pág. del historial)
            var calendarEvents = typeof eventosCalendario !== 'undefined' ? eventosCalendario : @json($eventosCalendario ?? []);

            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                locale: 'es', // Usar el idioma español
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: ''
                },
                events: calendarEvents,
                eventDidMount: function(info) {
                    info.el.title = info.event.title;
                },
                dayMaxEvents: true,
                displayEventTime: false,
                firstDay: 1,
            });
            calendar.render();
        }
    });
    </script>
