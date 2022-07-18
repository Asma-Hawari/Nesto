<?php
/**
 * Created By Eng.Asma Hawari
 */

namespace Asma\Hawari\Model;

use Asma\Hawari\Api\Data\OrderDetailsInterface;
use Asma\Hawari\Api\OrderDetailsRepositoryInterface;
use Asma\Hawari\Model\OrderDetailsFactory;
use Asma\Hawari\Model\ResourceModel\OrderDetails as OrderDetailsResource;
use Asma\Hawari\Model\ResourceModel\OrderDetails\CollectionFactory;
use Asma\Hawari\Model\ResourceModel\OrderDetails\Collection;
use Magento\Framework\Api\SearchCriteriaBuilder;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Framework\Exception\CouldNotDeleteException;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Api\Search\FilterGroup;
use Magento\Ui\Api\Data\BookmarkSearchResultsInterfaceFactory;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SortOrder;

/**
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class OrderDetailsRepository implements OrderDetailsRepositoryInterface
{
    public const OrderDetails_COUNT = 3;

    /**
     * @var BookmarkSearchResultsInterfaceFactory
     */
    private $searchResultsFactory;

    /**
     * @var OrderDetailsFactory
     */
    private $OrderDetailsFactory;

    /**
     * @var OrderDetailsResource
     */
    private $OrderDetailsResource;

    /**
     * Model data storage
     *
     * @var array
     */
    private $OrderDetails;

    /**
     * @var CollectionFactory
     */
    private $OrderDetailsCollectionFactory;

    /**
     * @var SearchCriteriaBuilder
     */
    private $criteriaBuilder;
    /**
     * @var CollectionProcessorInterface
     */
    private $collectionProcessor;
    /**
     * @var \Magento\Framework\Api\Search\SearchResultInterfaceFactory
     */
    private $searchResultInterfaceFactory;

    public function __construct(
        BookmarkSearchResultsInterfaceFactory $searchResultsFactory,
        \Magento\Framework\Api\Search\SearchResultInterfaceFactory $searchResultInterfaceFactory,
        OrderDetailsFactory $OrderDetailsFactory,
        OrderDetailsResource $OrderDetailsResource,
        CollectionFactory $OrderDetailsCollectionFactory,
        SearchCriteriaBuilder $criteriaBuilder,
        CollectionProcessorInterface $collectionProcessor
    ) {
        $this->searchResultsFactory = $searchResultsFactory;
        $this->OrderDetailsFactory = $OrderDetailsFactory;
        $this->OrderDetailsResource = $OrderDetailsResource;
        $this->OrderDetailsCollectionFactory = $OrderDetailsCollectionFactory;
        $this->criteriaBuilder = $criteriaBuilder;
        $this->collectionProcessor = $collectionProcessor;
        $this->searchResultInterfaceFactory = $searchResultInterfaceFactory;
    }

    /**
     * @inheritdoc
     */
    public function save(OrderDetailsInterface $OrderDetails)
    {
        try {
            if ($OrderDetails->getEntityId()) {
                $OrderDetails = $this->getById($OrderDetails->getEntityId())->addData($OrderDetails->getData());
            }
            $this->OrderDetailsResource->save($OrderDetails);
            unset($this->OrderDetails[$OrderDetails->getEntityId()]);
        } catch (\Exception $e) {
            if ($OrderDetails->getEntityId()) {
                throw new CouldNotSaveException(
                    __(
                        'Unable to save OrderDetails with ID %1. Error: %2',
                        [$OrderDetails->getEntityId(), $e->getMessage()]
                    )
                );
            }
            throw new CouldNotSaveException(__('Unable to save new OrderDetails. Error: %1', $e->getMessage()));
        }

        return $OrderDetails;
    }

    /**
     * @inheritdoc
     */
    public function getById($id)
    {
        $orderDetails = $this->OrderDetailsFactory->create();
        $orderDetails->getResource()->load($orderDetails, $id);
        if (! $orderDetails->getId()) {
            throw new NoSuchEntityException(__('Unable to find order with ID "%1"', $id));
        }
        return $orderDetails;
    }

    /**
     * @inheritdoc
     */
    public function delete(OrderDetailsInterface $OrderDetails)
    {
        try {
            $this->OrderDetailsResource->delete($OrderDetails);
            unset($this->OrderDetails[$OrderDetails->getEntityId()]);
        } catch (\Exception $e) {
            if ($OrderDetails->getEntityId()) {
                throw new CouldNotDeleteException(
                    __(
                        'Unable to remove OrderDetails with ID %1. Error: %2',
                        [$OrderDetails->getEntityId(), $e->getMessage()]
                    )
                );
            }
            throw new CouldNotDeleteException(__('Unable to remove OrderDetails. Error: %1', $e->getMessage()));
        }

        return true;
    }

    /**
     * @inheritdoc
     */
    public function deleteById($id)
    {
        $OrderDetailsModel = $this->getById($id);
        $this->delete($OrderDetailsModel);
        return true;
    }

    /**
     * @inheritdoc
     */
    public function getList(SearchCriteriaInterface $searchCriteria)
    {
        $collection = $this->OrderDetailsCollectionFactory->create();

        $this->collectionProcessor->process($searchCriteria, ($collection));

        $searchResults = $this->searchResultInterfaceFactory->create();

        $searchResults->setSearchCriteria($searchCriteria);

        $items = [];
        foreach ($collection as $item) {

            $items[] = $item->getData();
        }
        $searchResults->setItems($items);

        return $searchResults;
    }

    /**
     * @return OrderDetails
     */
    public function getEmptyModel()
    {
        return $this->OrderDetailsFactory->create();
    }

    /**
     * @param $orderDetails
     * @return bool
     */
    public function editEntity($orderDetails)
    {
        if (!empty($orderDetails)) {
            $error = false;
                try {
                    $orderDetailsObject = $this->getById($orderDetails->getId());
                    if($orderDetailsObject){
                        $orderDetailsObject->setOrderId($orderDetails->getOrderId());
                        $orderDetailsObject->setOrderItemsCount($orderDetails->getOrderItemsCount());
                        $orderDetailsObject->setOrderShippingAmount($orderDetails->getOrderShippingAmount());
                        $orderDetailsObject->setOrderGrandTotal($orderDetails->getOrderGrandTotal());
                        $orderDetailsObject->setAdditionInfo($orderDetails->getAdditionInfo());
                    }
                    try {
                        $this->save($orderDetailsObject);
                    } catch (\Exception $e) {
                        throw new NoSuchEntityException(__('Unable to find order with ID "%1"', $orderId));
                    }
                } catch (\Magento\Framework\Exception\LocalizedException $e) {
                    $messages[] = $orderId.' =>'.$e->getMessage();
                    $error = true;
                }
            if ($error) {
                return false;
            }
        }
        return true;

    }
}
