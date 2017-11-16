Login =
  Main: ()->
    options =
      menu_extended: false,
      message_apple: 'Muy pronto',
      message_android: 'Muy pronto'


    @init = ()->
      $(window).on('scroll', @.onScroll);
      $(window).on('resize', @.onResize);
      sessionStorage.clear()

      @eventHandler(options)
      return


    @onScroll = () ->
      return

    @onResize = () ->
      return

    @eventHandler = (options)->

      $('#sigeturbo_apple').bind "click", (e)->
        e.preventDefault()
        alert options.message_apple
        false

      $('#sigeturbo_google').bind "click", (e)->
        e.preventDefault()
        alert options.message_android
        false

    @init();

$ ()->
  window.main = new Login.Main();



