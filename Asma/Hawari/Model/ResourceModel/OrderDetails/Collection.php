<?php
/**
 * Created By Eng.Asma Hawari
 */

namespace Asma\Hawari\Model\ResourceModel\OrderDetails;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    protected $_eventPrefix = 'order_details_collection';
    protected $_eventObject = 'order_details_collection';

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Asma\Hawari\Model\OrderDetails', 'Asma\Hawari\Model\ResourceModel\OrderDetails');
    }
}
