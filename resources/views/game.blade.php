<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" href="{{ asset('web/css/style.css') }}" />
    <title>RetroFlix</title>
    <meta name="author" content="" />
    <style type="text/css"> body { background-color: #000; }</style>

  </head>
  <body>
    <div id="game">
      <canvas id="mainCanvas" >No Canvas Support</canvas>
    </div>
    <div id="controller">
      <div id="controller_dpad">
        <div id="controller_left"></div>
        <div id="controller_right"></div>
        <div id="controller_up"></div>
        <div id="controller_down"></div>
      </div>
      <div id="controller_select" class="capsuleBtn">Select</div>
      <div id="controller_start" class="capsuleBtn">Start</div>
      <div id="controller_b" class="roundBtn">B</div>
      <div id="controller_a" class="roundBtn">A</div>
    </div>
    <script>
      const customControls = {}
      const ROM_FILENAME = "/game/rom/{{$fileName}}";
    </script>

    <script src="{{ asset('web/binjgb.js') }}"></script>
    <script src="{{ asset('web/js/script.js') }}"></script>
</body>
