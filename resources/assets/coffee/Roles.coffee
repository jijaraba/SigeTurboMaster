Roles =
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
      $('input:radio').bind "click", (e)->
        e.preventDefault()
        $('#sigeFormRole').submit()
        return

    @init();

$ ()->
  window.main = new Roles.Main();



