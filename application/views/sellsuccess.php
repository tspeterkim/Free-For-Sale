<html>
    <head>
        <title>FFS - Product Online</title>
    </head>
    <body>
        <div>
            <div id="success_message_div">Your stuff is now for sale.</div>
    <?php echo anchor('sell/','Sell Another',array('id'=>'sell_link')); ?><br/>
    <!--<?php echo anchor('home/product/'.$ID,'See Your Stuff',array('id'=>'view_link')); ?><br/>-->
    <?php echo anchor('home/', 'Go Back To The Home Page', array('id' => 'home_link')); ?>
        </div>
    </body>
</html>