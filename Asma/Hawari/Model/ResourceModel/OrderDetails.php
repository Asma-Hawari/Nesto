<?php
/**
 * Created By Eng.Asma Hawari
 */
namespace Asma\Hawari\Model\ResourceModel;


class OrderDetails extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context
    )
    {
        parent::__construct($context);
    }

    protected function _construct()
    {
        $this->_init('order_details', 'id');
    }
}
