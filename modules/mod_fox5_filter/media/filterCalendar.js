$(document).ready(function () {
        $("#button_filter").click(function () {
            $("#filterCollapse").toggle("fast");
        })


        if ($("#roll_filter_button").data('view') == 'calendar') {
            $("#roll_filter_form").submit(function () {
                $.ajax({
                    url: "index.php?option=com_courtroll&view=courtroll&format=json",
                    type: 'POST',
                    data: $("#roll_filter_form").serialize(),

                    success: function (data) {
                        // ajax check if data is empty
                        if (data.length == 0) {
                            let div = document.getElementById('m-container');
                            let el = document.createElement('div');
                            // show message
                            el.innerHTML = "<div class=\"alert alert-warning alert-dismissible fade show\" role=\"alert\">\n" +
                                "  <strong>No Data Found</strong>\n" +
                                "  <button type=\"button\" class=\"btn-close\" data-bs-dismiss=\"alert\" aria-label=\"Close\"></button>\n" +
                                "</div>";
                            div.append(el);


                            //if close button is clicked, hide the message
                            $(".btn-close").click(function () {
                                div.removeChild(el);
                            });


                        }

                        // check if the data is valid
                        if (data !== undefined) {
                            let toDate;
                            let headerToolbar = {
                                left: 'prev,next today',
                                center: 'title',
                                right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek',
                            };
                            let events = data;
                            let timeZone = 'local';
                            let calendarE = document.getElementById('calendar');
                            let calendar = new FullCalendar.Calendar(
                                calendarE, {headerToolbar, timeZone, events}
                            )

                            if ($("#jform_date").val() != "") {
                                toDate = $('#jform_date').val();
                                calendar.gotoDate(toDate);
                            }
                            calendar.render();

                        }
                        $("#filterCollapse").toggle("fast");
                    }

                });
                return false;
            })
            ;
        }
    }
)
;
