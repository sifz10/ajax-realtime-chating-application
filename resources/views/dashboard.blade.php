<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Chat Ajax</title>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
  </head>
  <body>
    @php
      $messages = DB::table('messages')->get();
    @endphp
    <div class="container">
      <div class="row">
        <div class="col-md-12 mt-5">
          <div class="card">
            <div class="card-header">
              Sifat Kazi
            </div>
            <div class="card-body">
              <div id="text">
              </div>
              <form action="" method="">
                @csrf
                <div class="input-group">
                  <input type="hidden" id="user_id" value="{{ Auth::id() }}">
                  <input type="text" class="form-control" aria-label="Text input with segmented dropdown button" id="message">
                  <div class="input-group-append">
                    <a href="#" class="btn btn-outline-success" id="form_submit">Send</a>
                  </div>
                </div>
              </form>
          </div>
        </div>
      </div>
    </div>
    <script>

   let myInterval = setInterval(messageUpdate, 1000);

    function messageUpdate() {
      $(document).ready(function(){
        $.ajax({
            url: 'messages',
            type: 'GET',
            dataType: 'json',

         success: function(data) {
           $("#text").empty();
           for (var i = 0; i < data.length; i++) {
             $("#text").append('<div class="alert alert-warning">'+data[i].message+'</div>');
           }
         },
         error: function () { alert('error'); },
         });
      });
    }


        $("#form_submit").click(function(e) {
            e.preventDefault();
            var user_id = $('#user_id').val();
            var message = $('#message').val();


            $(document).ready(function() {
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('Content')
                    }
                });


                $.ajax({
                    type: "POST",
                    url: "/sent",
                    data: {
                        "user_id": user_id,
                        "message": message,
                    },
                    success: function(data) {
                      $("#message").val(' ')
                      $.ajax({
                          url: 'messages',
                          type: 'GET',
                          dataType: 'json',

                       success: function(data) {
                           $("#text").append('<div class="alert alert-warning">'+data[data.length-1].message+'</div>');

                       },
                       error: function () { alert('error'); },
                       });
                    }
                });
            });
        });
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    {{-- <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script> --}}
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script> --}}
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
