Stream =
  Main: ()->

    @init = ()->
      @eventHandler()
      return

    @onScroll = () ->
      return

    @onResize = () ->
      return

    @eventHandler = ()->

      #Socket
      socket = io('https://sigeturbo.thenewschool.edu.co:3000');

      #Events
      socket.on 'sigeturbo-channel:SigeTurbo\\Events\\Stream', (stream) ->

        if timeID
          clearTimeout(timeID)
          false
        stream_container = $("#sigeturbo_stream")
        stream_container.css({ bottom: "0px",display: "block"});
        stream_node = stream_container.find(".stream")
        stream_node.html(stream.data.message);

        timeID = setTimeout ->
          stream_container.css({ bottom: "-70px",display: "none"});
          false
        , 10000
        false

    @init();

$ ()->
  window.main = new Stream.Main();



