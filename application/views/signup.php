<html>
    <head>
        <title>FFS - Sign Up</title>
    </head>
    <body>
        <div>
            <?php echo validation_errors(); ?>
            <?php echo form_open('register');?>
            <label for="email">Email: </label>
            <input type="text" name="email" id="email"/><br/>
            <label for="password">Password: </label>
            <input type="password" name="password" id="password"><br/>
            <label for="password">Retype Password: </label>
     <input type="password" size="20" id="passwordconfirmation" name="passwordconfirmation"/><br/>
            <label for="email">First Name: </label>
            <input type="text" name="firstname" id="firstname"/><br/>
            <label for="email">Last Name: </label>
            <input type="text" name="lastname" id="lastname"/><br/>
            <input type="submit" value="Sign Up" />
            </form>
        </div>
        
    </body>
</html>