<?php
/**
 * @package   F8\AttibutLock\Helper
 * @author    Ntabethemba Ntshoza
 * @date      08-03-2023
 * @copyright Copyright © 2023 f8 Group IT
 */

namespace F8\AttibutLock\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Class ConfigData
 * @package F8\AttibutLock\Helper
 */
class ConfigData extends AbstractHelper
{
    const XML_PATH_CATALOG = 'f8catalog/f8_product_attributes/';

    /**
     * @param $field
     * @param null $storeId
     * @return mixed
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    /**
     * @param $code
     * @param null $storeId
     * @return mixed
     */
    public function getProductAttributesConfig($code, $storeId = null)
    {
        return $this->getConfigValue(
            self::XML_PATH_CATALOG . $code, $storeId
        );
    }
}
