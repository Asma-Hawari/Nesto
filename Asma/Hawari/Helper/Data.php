<?php
/**
 * Created By Eng.Asma Hawari
 */

declare(strict_types=1);

namespace Asma\Hawari\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\DataObject\Copy\Config;
use Psr\Log\LoggerInterface;

class Data extends AbstractHelper
{
    /**
     * @var Config
     */
    protected $fieldsetConfig;

    /**
     * @var LoggerInterface
     */
    protected $logger;

    /**
     * Data constructor.
     *
     * @param Config $fieldsetConfig
     * @param LoggerInterface $logger
     */
    public function __construct(
        Config $fieldsetConfig,
        LoggerInterface $logger
    ) {
        $this->fieldsetConfig = $fieldsetConfig;
        $this->logger = $logger;
    }

    /**
     * @param string $fieldset
     * @param string $root
     * @return array
     */
    public function getExtraCheckoutAddressFields($fieldset='extra_checkout_billing_address_fields', $root='global')
    {
        $fields = $this->fieldsetConfig->getFieldset($fieldset, $root);

        $extraCheckoutFields = [];

        if (is_array($fields)) {
            foreach ($fields as $field => $fieldInfo) {
                $extraCheckoutFields[] = $field;
            }
        }

        return $extraCheckoutFields;
    }

    /**
     * @param $fromObject
     * @param $toObject
     * @param string $fieldset
     * @return mixed
     */
    public function transportFieldsFromExtensionAttributesToObject(
        $fromObject,
        $toObject,
        $fieldset='extra_checkout_billing_address_fields'
    ) {
        $writer = new \Laminas\Log\Writer\Stream(BP . '/var/log/customfile.log');
        $logger = new \Laminas\Log\Logger();
        $logger->addWriter($writer);
        $logger->info('hello log');
        $logger->info("From Object ".$fieldset."---".json_encode($fromObject) );
        foreach ($this->getExtraCheckoutAddressFields($fieldset) as $extraField) {
            $this->logger->debug('from'.$fieldset);
            $this->logger->debug($extraField);
            $set = 'set' . str_replace(' ', '', ucwords(str_replace('_', ' ', $extraField)));
            $get = 'get' . str_replace(' ', '', ucwords(str_replace('_', ' ', $extraField)));

            $value = $fromObject->$get();
            $this->logger->debug($value);
            try {
                $toObject->$set($value);
            } catch (\Exception $e) {
                $this->logger->critical($e->getMessage());
            }
        }
        $logger->info("to Object ".$fieldset."---".json_encode($toObject->getData()) );
        return $toObject;
    }
}
