<html>
 <head>
   <title>FFS - Login</title>
 </head>
 <body>
   <?php echo validation_errors(); ?>
   <?php echo form_open('verifylogin'); ?>
     <label for="email">Email: </label>
     <input type="text" size="20" id="email" name="email"/>
     <br/>
     <label for="password">Password: </label>
     <input type="password" size="20" id="password" name="password"/>
     <br/>
     <input type="submit" value="Login"/>
   </form>
    <div>
        <span>First time? </span>
        <?php echo anchor('signup/','Sign Up!',array('id'=>'signup_link'));?>
    </div>
 </body>
</html>
