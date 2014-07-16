<body>
    <div>
        <h3><?php echo $name;?></h3>
        <?php foreach ($products as $item):?>
            <div class="products_single_divs">
            <span class="products_description_spans"><?php echo $item['description']?></span>
            <a class="products_preview_links" href="<?php echo site_url('home/product/'.$item['ID'])?>"><img class="products_images" src="<?php echo $item['imglocation']?>"/></a>
            <span class="products_price_spans">$<?php echo $item['price']?></span>
            </div>
        <?php endforeach?>
    </div>
