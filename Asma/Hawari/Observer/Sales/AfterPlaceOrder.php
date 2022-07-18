<?php
/**
 * Created By Eng.Asma Hawari
 */

namespace Asma\Hawari\Observer\Sales;

use Asma\Hawari\Model\OrderDetails;
use Asma\Hawari\Model\OrderDetailsFactory;
use Asma\Hawari\Model\OrderDetailsRepository;
use Magento\Framework\Event\ObserverInterface;
use Psr\Log\LoggerInterface;

class AfterPlaceOrder implements ObserverInterface
{
    /**
     * @var OrderDetailsRepository
     */
    private $orderDetailsRepository;
    /**
     * @var OrderDetails
     */
    private $orderDetails;
    /**
     * @var LoggerInterface
     */
    private $logger;

    /**
     * @param OrderDetailsRepository $orderDetailsRepository
     * @param OrderDetailsFactory $orderDetails
     * @param LoggerInterface $logger
     */
    public function __construct(
        OrderDetailsRepository $orderDetailsRepository,
        OrderDetailsFactory $orderDetails,
        LoggerInterface $logger
    ){
        $this->orderDetailsRepository = $orderDetailsRepository;
        $this->orderDetails = $orderDetails;
        $this->logger = $logger;
    }

    /**
     * @param \Magento\Framework\Event\Observer $observer
     * @return void
     * @throws \Magento\Framework\Exception\CouldNotSaveException
     */
    public function execute(\Magento\Framework\Event\Observer $observer)
    {
        $order= $observer->getData('order');
        $orderId = $order->getId();
        $orderGrand = $order->getGrandTotal();
        $orderDetails = $this->orderDetails->create();
        $orderDetails->setOrderId($orderId);
        $orderDetails->setOrderGrandTotal($orderGrand);
        $orderDetails->setOrderItemsCount($this->getItemCount($order));
        $orderDetails->setOrderShippingAmount($order->getShippingAmount());
        $orderDetails->setAdditionInfo($order->getComment());
        $this->orderDetailsRepository->save($orderDetails);
    }
    public function getItemCount($order){
        $orderItems = $order->getAllItems();
        $total_qty = 0;
        foreach ($orderItems as $item)
        {
            $total_qty = $total_qty + $item->getQtyOrdered();
        }
        return $total_qty;
    }
}
