$( document ).ready(function () {
    $('#free').change(function(){
        if ($('#free').is(':checked') == true){
            $('#price').val('0').prop('disabled', true);
        } else {
            $('#price').val('').prop('disabled', false);
        }
    });
    /*
    $("#webcam").webcam({
     width: 320,
     height: 240,
     mode: "callback",
     swffile: "/js/jscam_canvas_only.swf",
     onTick: function(remain) {
        if (0 == remain) {
            $("#status").text("Cheese!");
        } else {
            $("#status").text(remain + " seconds remaining...");
        }
     },
     onSave: function() {},
     onCapture: function() {
        webcam.save();
     },
     debug: function() {},
     onLoad: function() {}
    });
    */
    
});