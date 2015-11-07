<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Path finder</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
      .container {
        max-width: 50em;
      }
    </style>
  </head>
  <body>
  <div class="container">
    <h2>Find path</h2>
    <form action="/path" method="get" id="findForm">
      <div class="form-group">
        <label for="from">From</label>
        <input type="text" class="form-control" required="true" id="from" name="from" placeholder="From point">
      </div>
      <div class="form-group">
        <label for="to">to</label>
        <input type="text" class="form-control" required="true" id="to" name="to" placeholder="To point">
      </div>
      <button type="submit" id="" class="btn btn-primary">Find path</button>
    </form>
    
    <ul class="list-unstyled" id="path">
    </ul> 

    <h2>Add connection</h2>
    <form action="/connections" method="post" id="addForm">
      <div class="form-group">
        <label for="from">From</label>
        <input type="text" class="form-control" required="true" id="from" name="from" placeholder="From point">
      </div>
      <div class="form-group">
        <label for="to">to</label>
        <input type="text" class="form-control" required="true" id="to" name="to" placeholder="To point">
      </div>
      <div class="form-group">
        <label for="time">time</label>
        <div class="input-group">
          <input type="number" class="form-control" id="time" name="time" min="1" value="1" width="10px">
          <div class="input-group-addon">min</div>
        </div>
      </div>
      <button type="submit" id="" class="btn btn-primary">Add connection</button>
    </form>
    
    <h2>All connections</h2>
    <ul class="list-unstyled" id="connections">
      @forelse ($connections as $connection)
      <li>{{ $connection->from->name }} ⟷ {{ $connection->to->name }} <b>{{ $connection->time}}′</b></li>
      @empty
      <li>No connections</li>
      @endforelse
    </ul>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
    <script>

      $("#addForm").submit(function(e) {
          $.ajax({
            type: "POST",
              url: "/connections",
              data: $("#addForm").serialize(), // serializes the form's elements. 
              success: function(data)
              {
                alert(data); // show response from the php script.
              },
              error: function(data)
              {
                alert("error", data);
              }
          });
          e.preventDefault(); // avoid to execute the actual submit of the form.
      });

      $("#findForm").submit(function(e) {
          e.preventDefault();
          $("#path").empty();
          $.ajax({
            type: "GET",
              url: "/path",
              data: $("#findForm").serialize(), // serializes the form's elements. 
              success: function(points)
              {
                for (index = 0; index < points.length; ++index) {
                  $("#path").append("<li>" + points[index].name + " <b>" + points[index].time + "′</b></li>");
                }
              },
              error: function(data)
              {
                alert("error", data);
              }
          });
           // avoid to execute the actual submit of the form.
      });

    </script>
  </div>
  </body>
</html>