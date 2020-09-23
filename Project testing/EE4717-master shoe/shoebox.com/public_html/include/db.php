<?php
    function db_connect() {
        // Define connection as a static variable, to avoid connecting more than once 
        static $connection;
        // Try and connect to the database, if a connection has not been established yet
        if(!isset($connection)) {
            $config = parse_ini_file(dirname(__FILE__) . '/../config.ini');     
            $connection = new mysqli($config['hostname'], $config['username'], $config['password'], $config['dbname']);    
            if($connection->connect_error === false){
                die("Connection failed: " . $conn->connect_error);           
            }
        }
        return $connection;
    }

    function query($stmt){
        return db_connect()->query($stmt);
    }

    function dbGetPopularItems(){
        $stmt = "SELECT p.*, sum(quantity) as count FROM cart_items c INNER JOIN products p WHERE c.product_id = p.product_id and c.order_id IS NOT NULL GROUP BY c.product_id ORDER BY SUM(quantity) DESC LIMIT 5;";
        return query($stmt);
        
    }

    function dbAddToCart($user_id, $product_id, $color, $size, $qty){
        $insert_query = "INSERT INTO cart_items (user_id, product_id , product_variant_id, quantity) VALUES ('$user_id', $product_id, (SELECT product_variant_id FROM product_variants WHERE product_id = $product_id AND color = '$color' AND size = $size LIMIT 1), $qty);";
        return query($insert_query);
    }

    function dbGetCartItems($user_id){
        $stmt = "SELECT p.pic_url, p.price * c.quantity as subtotal, p.product_id, p.product_name, pv.color, pv.size, c.item_id, c.product_variant_id, c.quantity
            FROM cart_items c 
                INNER JOIN products p 
                    ON c.product_id = p.product_id 
                    AND c.user_id = '$user_id' 
                    AND c.order_id IS NULL 
                    INNER JOIN product_variants pv 
                        ON c.product_variant_id = pv.product_variant_id;
        ";
        return query($stmt);
    }

    function dbGetItemByID($item_id){
        $stmt = "SELECT p.price * c.quantity as subtotal, c.item_id, c.product_variant_id, c.quantity, p.product_id, p.product_name, p.pic_url, pv.color, pv.size  
            FROM cart_items c
            INNER JOIN products p 
                ON c.product_id = p.product_id 
                AND c.item_id = $item_id
                INNER JOIN product_variants pv 
                    ON c.product_variant_id = pv.product_variant_id;";
        return query($stmt);
    }

    function dbRemoveItemByID($item_id){
        $stmt = "DELETE FROM cart_items WHERE item_id=$item_id";
        return query($stmt);
    }

    function dbPlaceOrder($user_id){
        $order_id = _genOrderId();
        $create_order = "INSERT INTO orders (order_id, user_id) VALUES ('$order_id', '$user_id');";
        $update_query = "UPDATE cart_items SET order_id = '$order_id' WHERE user_id = '$user_id' AND order_id IS NULL;";
        if(query($create_order)){
            if(query($update_query)){
                _sendMail($user_id, $order_id);
                return true;
            }
        }
        return false;
    }

    function getCartSubtotal($user_id){
        $stmt = "SELECT SUM(c.quantity * p.price) as total from cart_items c INNER JOIN products p WHERE c.product_id = p.product_id AND user_id = '$user_id' AND order_id IS NULL GROUP BY order_id;";
        $res = query($stmt);
        if($res->num_rows==1){
            $obj = $res->fetch_object();
            return $obj->total;
        }
        return 0;
    }

    function dbGetColorsForProduct($product_id){
        $stmt = "SELECT DISTINCT color FROM product_variants WHERE product_id=$product_id;";
        return query($stmt);
    }

    function dbGetSizesForProduct($product_id){
        $stmt = "SELECT DISTINCT size FROM product_variants WHERE product_id=$product_id;";
        return query($stmt);
    }

    function dbCartItemUpdate($item_id, $color, $size, $quantity){
        $product_id = _getProductIdForCartItem($item_id);
        if($product_id !== null){
            $stmt = "UPDATE cart_items
                SET product_variant_id = (SELECT product_variant_id FROM product_variants WHERE color='$color' AND size='$size' AND product_id = $product_id LIMIT 1),
                    quantity = $quantity
                WHERE item_id = $item_id;
            ";
            return query($stmt);
        }
        return null;
    }

    function _genOrderId(){
        return uniqid("odr-");
    }

    function _getProductIdForCartItem($item_id){
        $stmt = "SELECT product_id FROM cart_items WHERE item_id = $item_id LIMIT 1;";
        $results = query($stmt);
        if($results->num_rows===1){
            $item = $results->fetch_assoc();
            return $item["product_id"];
        }
        return null;
    }

    function _sendMail($user_id, $order_id){
        $stmt = "SELECT * from users WHERE user_id = '$user_id';";
        $user = query($stmt)->fetch_object();
        $subject = $order_id."-Your Order Has Been Placed";
        $msg = "
            Dear ".$user->username.", \n\n
            Your order from shoebox.com has been placed. Your Order Number is ".$order_id." \n
            You can login and check your order status. \n\n

            Thank you for shopping with us!\n\n

            Best, \n
            SHOEBOX Customer Service Team \n
            Email: cs@shoebox.com \n
            TEL: +65 66668888 \n
        ";
        $to = $user->email;
        mail($to, $subject, $msg);
    }

?>