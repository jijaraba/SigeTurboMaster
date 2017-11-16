Homework =
  Main: ()->

    @init = ()->
      $(window).on('scroll', @.onScroll);
      $(window).on('resize', @.onResize);
      @eventHandler()
      return

    @onScroll = () ->
      return

    @onResize = () ->
      return

    @eventHandler = ()->
      $('#sige_help').bind "click", (e)->
        e.preventDefault()
        introJs().start();
        return

    @init();

$ ()->
  window.main = new Homework.Main();