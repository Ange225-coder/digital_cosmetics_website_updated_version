<?php

    declare(strict_types = 1);

    namespace App\model\productManager;

    use App\model\database\DbManager;

    class ProductInCartManager extends DbManager
    {
        /**
         * this function set a product in cart in the same where
         * the user is defined
         */
        public function setProductInCart(string $buyer_name, string $buyer_email, string $buyer_contact, string $purchased_product, string $product_id, string $product_quantity, int $total_price, $p_img): bool
        {
            $db = $this->dbConnect();
            $queryInsertProductInCart = $db->prepare('INSERT INTO product_order(buyer_name, buyer_email, buyer_contact, purchased_product, product_id, product_quantity, total_price, p_img, order_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW())');

            return $queryInsertProductInCart->execute(array($buyer_name, $buyer_email, $buyer_contact, $purchased_product, $product_id, $product_quantity, $total_price, $p_img));
        }


        /** updating product quantity based on quantity to buy */
        public function updatingProductQuantity(int $product_quantity, string $product_id): bool
        {
            $db = $this->dbConnect();
            $queryUpdatingProductQuantity = $db->prepare('UPDATE products SET p_quantity = ? WHERE product_id = ? ');

            return $queryUpdatingProductQuantity->execute(array($product_quantity, $product_id));
        }


        /** this function get order in process based on his id */
        public function getAnOrder(string $order_id)
        {
            $db = $this->dbConnect();
            $queryGetOnOrder = $db->prepare('SELECT *, DATE_FORMAT(order_date, "%d/%m/%Y à %Hh:%imin:%ss") as orderDate_fr FROM product_order WHERE order_id = ?');
            $queryGetOnOrder->execute(array($order_id));

            return $queryGetOnOrder->fetch();
        }


        /** this function retrieve total orders prices based on user session  */
        public function getTotalPrice(string $buyer_name): bool|array
        {
            $db = $this->dbConnect();
            $queryGetTotalPrice = $db->prepare('SELECT SUM(total_price) as allTotal FROM product_order WHERE buyer_name = ?');
            $queryGetTotalPrice->execute(array($buyer_name));

            return $queryGetTotalPrice->fetchAll();
        }
    }