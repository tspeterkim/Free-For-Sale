$( document ).ready(function () {
    
    //Sidetab.js
    $(".sidetab_links").click(function(e){
        e.preventDefault();
        var pid = $(this).attr('id').substring(14);
        $.ajax({
            url: '/index.php/home/categories/',
            type: 'POST',
            data: 'type='+pid,
            success: function(data) {
                $('#products_main_div').html(data);
            },
            error: function(xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        });
    });
    
    //First show the recents...
    $("#sidetab_links_0").click();
    
    //Preview.js
    $('body').on('click', '.preview_interest_buttons', function (){
        
        if($(this).html()=="Interest!") //Interest the product
        {
            $(this).html("Uninterest...");            
            var action = 1;
        }
        else    //Not interest the product
        {
            $(this).html("Interest!");            
            var action = 0;
        }
        //alert("sds");
        var pid = $(this).parent().attr("id").substring(12);
        //alert(pid);
        ///*
        $.ajax({
            url: '/index.php/home/interest/'+action,
            type: 'POST',
            data: 'pid='+pid,
            context: this,
            success: function(data) {
                if(action==1)
                {
                    //alert("Interested!");
                    //Add to waitlist
                    //If first on waitlist, alert buyer that seller will contact you
                    //alert($(this).next('.preview_waitlists').html());
                    //alert($(this).next().children().is("span"));
                    if($(this).next().children().is("span"))
                    {
                        //$(this).siblings("ol").append(data);
                        alert("We've notified "+$(this).siblings(".products_bywho_links").html()+" of your interest. They'll contact you ASAP through chat.")
                    }
                    else
                    {
                        alert("You're on the waitlist. We'll notify you when the product becomes available to you or sold before.")
                    }
                //If not, alert that ffs will notify seller when you're first
                    
                }
                else
                {
                    //alert("Uninterested!");
                    //Remove from waitlist
                    
                }

                $(this).next().html(data);
                $.ajax({
                    url: '/index.php/home/update_interests/',
                    type: 'POST',
                    success: function(data) {
                        $('#chat_products_list').html(data);
                    },
                    error: function(xhr, desc, err) {
                        console.log(xhr);
                        console.log("Details: " + desc + "\nError:" + err);
                    }
                });
                
            },
            error: function(xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        });
        //*/
    });
    
    $("a.products_preview_links").fancybox({
            'type'              : 'ajax',
            helpers : {
                overlay : {
                        css : {
                            'background' : 'rgba(0, 0, 0, 0.7)'
                        }
                }
            }
    });
    
    
    //Chat.js
    $('#chat_products_div').on('click', '.chat_products_links', function (e){
        //alert("asd");
        e.preventDefault();
        var tid = $(this).parent().attr('id');
        if($('#chat_chatbox_div'+tid).length){
        
        }else{
            //var loc = $(this).children("img").attr("src");
            var name = $(this).children("span").html();
            $('#chat_chatgroup_div').prepend('<div id="chat_chatbox_div'+tid+'"  class="chat_chatbox_divs"><div class="chat_chatboxtitle_divs"><span>'+name+'</span></div><div class="chat_chatboxtext_divs"></div><div class="chat_chatboxinput_divs"><input type="text" class="chat_chatboxinput_inputs"/></div></div>');
            
            
            $('.chat_chatboxinput_inputs').keypress(function(e){
                if(e.which==13){
                    var mymessage = $(this).val();
                    $(this).val('');
                    $(this).focus();
                    
                    
                    $.ajax({
                        url: '/index.php/chat/add_message/'+mymessage,
                        type: 'POST',
                        data: 'talkingtoid='+tid,
                        context: this,
                        success: function(data){
                            alert(data);
                        }
                    });
                    
                }
            });
            
        }
        
        
        
    });
    
    
    
    
});