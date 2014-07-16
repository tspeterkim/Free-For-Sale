<div>
    <span id="greeting_span">Hi, <?echo $firstname;?></span><br/>
    <?php echo anchor('profile/byid/'.$id,'Your Profile',array('id'=>'profile_link')); ?><br/>
    <?php echo anchor('sell/','Sell Stuff',array('id'=>'sell_link')); ?><br/>
    <?php echo anchor('home/logout/','Log Out',array('id'=>'logout_link')); ?>
</div>
</head>