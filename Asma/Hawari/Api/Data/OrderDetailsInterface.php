<?php
/**
 * Created By Eng.Asma Hawari
 */

namespace Asma\Hawari\Api\Data;
use Magento\Framework\Api\ExtensibleDataInterface;

/**
 * Interface
 *
 * @package Asma\Hawari\Api
 */
interface OrderDetailsInterface extends ExtensibleDataInterface
{
    public const ENTITY_ID ='id';
    public const ORDERID ='order_id';
    public const ORDER_ITEMS_COUNT ='order_items_count';
    public const ORDER_SHIPPING_AMOUNT ='order_shipping_amount';
    public const ORDER_GRAND_TOTAL ='order_grand_total';
    public const ADDITION_INFO ='addition_info';
    /**
     * @return int
     */
    public function getId();

    /**
     * @param int $id
     * @return void
     */
    public function setId($id);

    /**
     * @return int
     */
    public function getOrderId();

    /**
     * @param int $id
     * @return void
     */
    public function setOrderId($id);

    /**
     * @return int
     */
    public function getOrderItemsCount();

    /**
     * @param int $id
     * @return void
     */
    public function setOrderItemsCount($count);
    /**
     * @return int
     */
    public function getOrderShippingAmount();

    /**
     * @param int $id
     * @return void
     */
    public function setOrderShippingAmount($amount);
    /**
     * @return double
     */
    public function getOrderGrandTotal();

    /**
     * @param double $id
     * @return void
     */
    public function setOrderGrandTotal($total);

    /**
     * @return string
     */
    public function getAdditionInfo();

    /**
     * @param string $info
     * @return void
     */
    public function setAdditionInfo($info);
}
