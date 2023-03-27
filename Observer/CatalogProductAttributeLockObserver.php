<?php
/**
 * @package   F8\AttibutLock\Observer
 * @author    Ntabethemba Ntshoza
 * @date      08-03-2023
 * @copyright Copyright © 2023 F8
 */

namespace F8\AttibutLock\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use F8\AttibutLock\Helper\ConfigData;

/**
 * Class CatalogProductAttributeLockObserver
 * @package F8\AttibutLock\Observer
 */
class CatalogProductAttributeLockObserver implements ObserverInterface
{
    /**
     * @var ConfigData
     */
    private ConfigData $configDataHelper;

    /**
     * CatalogProductAttributeLockObserver constructor
     *
     * @param ConfigData $configData
     */
    public function __construct(
        ConfigData $configData
    ) {
        $this->configDataHelper = $configData;
    }

    /**
     * @param Observer $observer
     * @return array|void
     */
    public function execute(Observer $observer)
    {
        $event = $observer->getEvent();
        $product = $event->getProduct();

        // Get Attribute codes from admin
        $attributeCodes = explode(
            ',',
            $this->configDataHelper->getProductAttributesConfig('f8_product_attributes_list') ?? ''
        );

        // Trim white space on the array
        $attributeCodes = array_map('trim', $attributeCodes);

        foreach ($attributeCodes as $attributeCode) {
            if (!empty($attributeCode) && !is_null($attributeCode)) {
                //Lock an attribute to read-only
                $product->lockAttribute($attributeCode) ?? '';
            }
        }
    }
}
