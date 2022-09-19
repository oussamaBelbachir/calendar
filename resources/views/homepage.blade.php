<!DOCTYPE html>
<html lang="en">
    <head>
        <title>How to Use Fullcalendar in Laravel 8</title>

        <meta name="csrf-token" content="{{ csrf_token() }}" />

        <link rel="stylesheet" href={{asset('css/app.css')}}>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.css" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.9.0/fullcalendar.js"></script>




    </head>
<body>
    <div class="container">
        <br />
        {{-- <h1 class="text-center text-primary"><u>How to Use Fullcalendar in Laravel 8</u></h1> --}}
        <br />
        <div id="calendar"></div>

        <div class="add" id="add">
            <form method="POST" action={{route("store")}}>
            @csrf
                <div>
                    <label for="">title</label>
                    <input name="date" type="date" class="date" format="yyyy-mm-dd">
                </div>
                <div>
                    <label for="">start</label>
                    <select name="start_h" class="start_h" id="" >
                        <option value="08:00" selected>08:00</option>
                        <option value="">08:00</option>
                        <option value="">08:00</option>
                        <option value="">08:00</option>
                        <option value="">08:00</option>
                        <option value="">08:00</option>
                    </select>
                </div>
                <div>
                    <label for="">end</label>
                    <select name="end_h" class="end_h" id="">
                        <option value="12:00" selected>12:00</option>
                        <option value="">08:00</option>
                        <option value="">08:00</option>
                        <option value="">08:00</option>
                        <option value="">08:00</option>
                        <option value="">08:00</option>
                    </select>
                </div>

                <button type="submit">submit</button>
            </form>
        </div>

    </div>
    <script  type="text/javascript">
        let currentDate = null;
        $(document).ready(function () {
            $.ajaxSetup({
                headers : {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            })




            var calendar = $('#calendar').fullCalendar({
                selectable : true,
                timeFormat : "H:mm",
                header : {
                    left : "prev,next today",
                    center : "title",
                    right : "month,agendaWeek,agendaDay"
                },
                events : "{{route('add')}}",
                eventRender: function(event, element) {


                    if(event.reserved == true) {
                        element.css('background-color', 'red');
                        element.css('color', '#fff');
                        // element.css('cursor', 'pointer');
                    }
                    element.css({
                        'cursor': 'pointer',
                        'padding' : '3px',
                        'color' : '#fff',
                        'font-weight' : 'bold'
                        // 'border' : 'none'
                    });
                    element.append(
                        "<span class='dash'> - </span>"+
                        "<div>"+
                        event.end.format("H:mm")+
                        "</div>"
                        )
                },

                dayClick : function(date,event,view){
                    $('#add').fadeIn(500);
                    $('#add').css("display","flex");

                    currentDate = date.format();
                    console.log(currentDate);
                    $('.date').val(currentDate);
                },
                select : function(start,end){
                    console.log(start,end);
                },
                contentHeight: 'auto',
                eventClick : function(info){
                    console.log(info.end.format("HH:mm"));

                }

            })



        });


    </script>


</body>
</html>
