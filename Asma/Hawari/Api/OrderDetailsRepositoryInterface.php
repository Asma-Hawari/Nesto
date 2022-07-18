<?php
/**
 * Created By Eng.Asma Hawari
 */

namespace Asma\Hawari\Api;
use Asma\Hawari\Api\Data\OrderDetailsInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

/**
 * Interface CustomApiInterface
 *
 * @package Asma\Hawari\Api
 */
interface OrderDetailsRepositoryInterface
{

    /**
     * @param int $id
     * @return \Asma\Hawari\Api\Data\OrderDetailsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function getById($id);

    /**
     * @param \Asma\Hawari\Api\Data\OrderDetailsInterface $orderDetails
     * @return \Asma\Hawari\Api\Data\OrderDetailsInterface
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     */
    public function editEntity(OrderDetailsInterface $orderDetails);

    /**
     * @param \Asma\Hawari\Api\Data\OrderDetailsInterface $orderDetails
     * @return \Asma\Hawari\Api\Data\OrderDetailsInterface
     */
    public function save(OrderDetailsInterface $orderDetails);

    /**
     * @param \Asma\Hawari\Api\Data\OrderDetailsInterface $orderDetails
     * @return void
     */
    public function delete(OrderDetailsInterface $orderDetailsEntity);

    /**
     * @param int $id
     * @return void
     */
    public function deleteById($id);

    /**
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \Magento\Framework\Api\SearchResultsInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria);
}
