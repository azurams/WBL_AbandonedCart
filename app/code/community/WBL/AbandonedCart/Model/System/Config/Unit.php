<?php
class WBL_AbandonedCart_Model_System_Config_Unit
{
    public function toOptionArray()
    {
        $options = array(
            array('value'=> WBL_AbandonedCart_Model_Config::IN_DAYS, 'label' => Mage::helper('wbl_abandonedcart')->__('Days')),
            array('value'=> WBL_AbandonedCart_Model_Config::IN_HOURS, 'label' => Mage::helper('wbl_abandonedcart')->__('Hours'))
        );
        return $options;
    }

}