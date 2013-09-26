<?php

class WBL_AbandonedCart_Model_Resource_Mailssent_Collection extends Mage_Core_Model_Mysql4_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('wbl_abandonedcart/mailssent');
    }
}

