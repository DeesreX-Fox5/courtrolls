<?php
// No direct access to this file
defined('_JEXEC') or die('Ristricted access');

$document = JFactory::getDocument();
$document->addStyleSheet("components/com_courtroll/tmpl/calendar/lib/main.css");
$document->addScript("components/com_courtroll/tmpl/calendar/lib/main.js");
$input = JFactory::getApplication()->input;
$category = $input->get('category', 'courtrolls', 'string');
?>


<div id="m-container" >
    <div id="messages"></div>
</div>
<div id="calendar"></div>

<script>
    document.addEventListener('DOMContentLoaded' ,function(){
        var headerToolbar = {
            left: 'prev,next today',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
        };
        var timeZone = 'local';
        var events = "/index.php?option=com_courtroll&view=courtroll&format=json&category=<?php echo $category ?>"
        var calendarE = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarE, {headerToolbar, timeZone, events});
        calendar.render(); //here we render the calendar
    });
</script>
