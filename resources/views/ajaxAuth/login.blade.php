<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>Readerstacks laravel 8 Custom login and registration </title>

  <script src="https://code.jquery.com/jquery-3.6.0.min.js" crossorigin="anonymous"></script>
  <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.1/jquery.validate.min.js"></script>
  <link href="//netdna.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" />
  <script type="text/javascript" src="index.js"></script>
  <style>
    .error {
      color: red
    }
  </style>
</head>

<body class="antialiased">
  <div class="container">
    <!-- main app container -->
    <div class="readersack">
      <div class="container">
        <div class="row">
          <div class="col-md-6 offset-md-3">
            <h3>  Login </h3>

            <div id="errors-list"></div>
            <form method="post" id="handleAjax" action="{{url('ajax/do-login')}}" name="postform">
              <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" value="{{old('email')}}" class="form-control" />
             @csrf
              </div>
              <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control" />
              </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary">LOGIN</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <!-- credits -->
    <div class="text-center">
      <p>
        <a href="{{url('ajax/register')}}" target="_top">login and registration </a>
      </p>

    </div>
  </div>


</body>
<script>
    $(function() {
    // handle submit event of form
      $(document).on("submit", "#handleAjax", function() {
        var e = this;
        // change login button text before ajax
        $(this).find("[type='submit']").html("LOGIN...");

        $.post($(this).attr('action'), $(this).serialize(), function(data) {

          $(e).find("[type='submit']").html("LOGIN");
          if (data.status) { // If success then redirect to login url
            window.location = data.redirect_location;
          }
        }).fail(function(response) {
            // handle error and show in html
          $(e).find("[type='submit']").html("LOGIN");
          $(".alert").remove();
          var erroJson = JSON.parse(response.responseText);
          for (var err in erroJson) {
            for (var errstr of erroJson[err])
              $("#errors-list").append("<div class='alert alert-danger'>" + errstr + "</div>");
          }

        });
        return false;
      });
    });
  </script>
</html>
