<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <!-- Styles -->
     <link href="/css/bootstrap.css" rel="stylesheet" type="text/css">
     <link rel="stylesheet" href="/css/custom.min.css">
     <link rel="stylesheet" href="/css/custom.css">
     <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
    <title>Kalkulator Konversi</title>
    <style>
        .optiontext {
            position: absolute;
        bottom: 0.5em;
        color: #fff;
        left: 0.5em;
        pointer-events: none;
        z-index: 1;
        font-style: italic;
        }
    </style>

</head>
<body>

    <nav class="navbar navbar-expand-lg fixed-top navbar-dark bg-primary">
        <a class="navbar-brand">Konversi Energi</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
          <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
              <a class="nav-link" href="/">Beranda
                <span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/petunjukpenggunaan">Petunjuk</a>
            </li>
          </ul>
        </div>
    </nav>

<div class="container">
  <h3>Popover Example</h3>
  <a href="#" data-toggle="popover" title="Popover Header" data-content="Some content inside the popover">Toggle popover</a>
</div>
<script>
    $(document).ready(function(){
      $('[data-toggle="popover"]').popover();
    });
    </script>
    <script src="/js/custom.js"></script>
</body>
</html>
