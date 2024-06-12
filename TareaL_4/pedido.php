<?php
class Pedido {
    private $orderId;
    private $productList;
    private $totalAmount;

    public function __construct($orderId, $productList, $totalAmount) {
        $this->orderId = $orderId;
        $this->productList = $productList;
        $this->totalAmount = $totalAmount;
    }

    public function getOrderId() {
        return $this->orderId;
    }

    public function setOrderId($orderId) {
        $this->orderId = $orderId;
    }

    public function getProductList() {
        return $this->productList;
    }

    public function setProductList($productList) {
        $this->productList = $productList;
    }

    public function getTotalAmount() {
        return $this->totalAmount;
    }

    public function setTotalAmount($totalAmount) {
        $this->totalAmount = $totalAmount;
    }
}
?>
