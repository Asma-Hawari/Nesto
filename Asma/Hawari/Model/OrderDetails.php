<?php
/**
 * Created By Eng.Asma Hawari
 */
namespace Asma\Hawari\Model;


use Asma\Hawari\Api\Data\OrderDetailsInterface;

class OrderDetails extends \Magento\Framework\Model\AbstractModel implements OrderDetailsInterface
{

    const CACHE_TAG = 'order_details';

    protected $_cacheTag = 'order_details';

    protected $_eventPrefix = 'order_details';

    protected function _construct()
    {
        $this->_init('Asma\Hawari\Model\ResourceModel\OrderDetails');
        $this->setIdFieldName(\Asma\Hawari\Api\Data\OrderDetailsInterface::ENTITY_ID);
    }

    public function getOrderId()
    {
        return $this->_getData(OrderDetailsInterface::ORDERID);
    }

    public function setOrderId($id)
    {
        $this->setData(OrderDetailsInterface::ORDERID, $id);

        return $this;
    }

    public function getOrderItemsCount()
    {
        return $this->_getData(OrderDetailsInterface::ORDER_ITEMS_COUNT);
    }

    public function setOrderItemsCount($count)
    {
        $this->setData(OrderDetailsInterface::ORDER_ITEMS_COUNT, $count);

        return $this;
    }

    public function getOrderShippingAmount()
    {
        return $this->_getData(OrderDetailsInterface::ORDER_SHIPPING_AMOUNT);
    }

    public function setOrderShippingAmount($amount)
    {
        $this->setData(OrderDetailsInterface::ORDER_SHIPPING_AMOUNT, $amount);

        return $this;
    }

    public function getOrderGrandTotal()
    {
        return $this->_getData(OrderDetailsInterface::ORDER_GRAND_TOTAL);
    }

    public function setOrderGrandTotal($total)
    {
        $this->setData(OrderDetailsInterface::ORDER_GRAND_TOTAL, $total);

        return $this;
    }

    public function getAdditionInfo()
    {
        return $this->_getData(OrderDetailsInterface::ADDITION_INFO);
    }

    public function setAdditionInfo($info)
    {
        $this->setData(OrderDetailsInterface::ADDITION_INFO, $info);

        return $this;
    }
}
