<html>
    <head>
        <title>FFS - Sell</title>
        <link rel="stylesheet" type="text/css" href="/css/sell.css"/>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>
        <script src="/js/jquery.webcam.min.js" type="text/javascript" ></script>
        <script src="/js/sell.js" type="text/javascript" charset="utf-8"></script>
    </head>
    <body>
        <div>
            <div>Sell Your Stuff</div>
            <?php echo validation_errors(); ?>
            <?php echo $error;?>
            <?php echo form_open_multipart('sell/add');?>
                <label for="description">Description: </label>
                <input autocomplete="off" placeholder="Just a brief description of what it is + other info" type="text" name="description" id="description"/ size="60"/><br/>
                <label for="image">Image: </label>
                <input type="file" name="image" size="20"/><!-- Or <button id="takepicture_button">Take A Picture</button><br/>
                <div id='webcam'></div>-->
                <label for="price">Price: $</label>
                <input autocomplete="off" type="text" name="price" id="price" />
            <input type="checkbox" name="free" id="free" value="1"> Free<br/>
                <!--<input type="checkbox" name="obo" value="is_obo"> OBO (or best offer)--><br/>
                <input type="submit" name="sell" value="Sell" />
            </form>
        </div>
    </body>
</html>