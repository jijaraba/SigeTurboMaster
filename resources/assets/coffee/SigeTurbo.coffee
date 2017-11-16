SigeTurbo =
  Main: ()->
    options =
      menu_extended: false


    @init = ()->
      $(window).on('scroll', @.onScroll);
      $(window).on('resize', @.onResize);
      @eventHandler()
      return


    @onScroll = () ->
      if $(window).scrollTop() == 0
        $("ul#breadcrumb").removeClass("on");
      else
        $("ul#breadcrumb").addClass("on");
      #Detectar posición del nodo
      contained = $("#sige-content").height();
      if contained >= $(window).scrollTop()
        $("aside").css("top", ($(window).scrollTop()) + "px");
      return

    @onResize = () ->
      return

    @eventHandler = ()->
      toggle = false
      $("#mobile-toggle").bind "click", (toogle)->
        if toggle
          $("#sige-main-container").css({"left": "0px", "right": "0px"})
          $("#account-info").css({"display": "none"})
          $("#breadcrumb").css({"left": "0px", "right": "0px"})
          $("#navigation").css({"left": "initial", "right": "0px", "display": "none"})
          toggle = false
        else
          $("#sige-main-container").css({"left": "-250px", "right": "250px"})
          $("#account-info").css({"display": "block"})
          $("#breadcrumb").css({"left": "-250px", "right": "250px"})
          $("#navigation").css({"left": "initial", "right": "0", "display": "block"})
          toggle = true
        return

      menuVisible = false
      $('#profile-view').bind "click", (e)->
        e.preventDefault()
        if menuVisible
          $('#profile-dropdown').css({'display': 'none'})
          menuVisible = false
          return

        $('#profile-dropdown').css({'display': 'block'})
        menuVisible = true

      $('#profile-dropdown').bind "click", (e)->
        $(this).css({'display': 'none'})
        menuVisible = false
        return

      $('#sige-welcome-close').bind "click", (e)->
        $('#contained').fadeOut(2000)
        return

      $('#show_academic_info').bind "click", (e)->
        e.preventDefault()
        $('.info').fadeIn(2000)
        return

      $('#sigeturbo_apple').bind "click", (e)->
        e.preventDefault()
        alert "Muy pronto ..."
        false

      $('#sigeturbo_google').bind "click", (e)->
        e.preventDefault()
        alert "Muy pronto ..."
        false


      $( "#apps" ).on "change", ->
        window.location.href = '/' + this.value

    @init();

$ ()->
  window.main = new SigeTurbo.Main();



