<div>
    <div id="chat_products_div">
        <span id="chat_products_mystuff_div">My Stuff</span>
        <ul id="chat_products_list">
            <?php foreach ($myproducts as $item):?>
                <li id="<?php echo $item['ID'];?>"><img class="chat_products_images" src="<?php echo $item['imglocation']?>" />
                    <ol>
                        <?php
                            $home_control = & get_instance();
                            $home_control->load->database;
                            $query = $home_control->db->query("SELECT * FROM interests INNER JOIN users ON users.ID=interests.userID AND interests.productID='".$item['ID']."' ORDER BY interests.timestamp ASC");
                            if ($query->num_rows() > 0)
                            {
                               foreach ($query->result() as $row)
                               {
                                  echo '<li><a href="#">'.$row->firstname.' '.$row->lastname.'</li>';
                               }
                            }
                            
                        ?>
                        
                    </ol>
                </li>
            <?php endforeach?>
        </ul>
        <span id="chat_products_interests_div">Your Interests</span>
        <ul id="chat_products_list">
            <?php foreach ($products as $item):?>
                <li id="<?php echo $item['ID'];?>"><a href="#" class="chat_products_links"><img class="chat_products_images" src="<?php echo $item['imglocation']?>" /><span class="chat_productsusername_divs"><?php echo $item['firstname'].' '.$item['lastname']; ?></span></a></li>
            <?php endforeach?>
        </ul>
    </div>
    <div id="chat_chatgroup_div"></div>
</div>

</body>
</html>