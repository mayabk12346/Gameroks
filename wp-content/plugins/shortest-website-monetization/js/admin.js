(function ( $ ) {
  "use strict";

    $(function () {
        $(".shortest-switcher").click(function(){
            var checkbox = $(this).find("input");
            var switcher = $(this).find(".switch");
            var options = $("."+$(this).attr("id"));
            options.toggleClass("active");


            if($(this).hasClass("active")){
                checkbox.removeAttr("checked");
                checkbox.checked = false;
                checkbox.attr("value",0);

                switcher.removeClass("on");
                $(this).removeClass("active");
            }
            else{
                checkbox.attr("checked","checked");
                checkbox.checked = true;
                checkbox.attr("value",1);

                switcher.addClass("on");
                $(this).addClass("active");
            }
        });
        $("#shst_es_types").change(function(){
            var optSelected = $(this).find("option:selected");
            var optSelectedCont = $(".js-timeout-opt");
            if(optSelected.hasClass("js-timeout")){
                optSelectedCont.addClass("active");
            }
            else{
                optSelectedCont.removeClass("active");
            }
        });

        $("#shst_refresh").click(function(event){
            event.preventDefault();
            $('#submit').click();
        });

        document.getElementById('shortest-connection-method-email').onclick = function(event){
            event.preventDefault();
            document.getElementById('shortest-connection-method-email').classList.add('active');
            document.getElementById('shortest-connection-method-token').classList.remove('active');
            document.getElementsByName('shst_connection_method')[0].value = 'email';

            document.getElementById('shortest-options-with-email').classList.add('active');
            document.getElementById('shortest-options-with-token').classList.remove('active');

        };
        document.getElementById('shortest-connection-method-token').onclick = function(event){
            event.preventDefault();
            document.getElementById('shortest-connection-method-email').classList.remove('active');
            document.getElementById('shortest-connection-method-token').classList.add('active');
            document.getElementsByName('shst_connection_method')[0].value = 'token';

            document.getElementById('shortest-options-with-email').classList.remove('active');
            document.getElementById('shortest-options-with-token').classList.add('active');
        };

        var apiTokenSwitch = document.getElementById('shortest-api-token-switch');
        if (apiTokenSwitch) {
            document.getElementById('shortest-api-token-switch').onclick = function (event) {
                event.preventDefault();
                document.getElementById('shortest-connection-method-token').click();
            }
        }
    });


}(jQuery));
