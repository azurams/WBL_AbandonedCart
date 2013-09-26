<?php

class WBL_AbandonedCart_Model_System_Config_Automatic
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        $options = array(
            array('value'=> 1, 'label' => Mage::helper('wbl_abandonedcart')->__('Specific')),
            array('value'=> 2, 'label' => Mage::helper('wbl_abandonedcart')->__('Automatic'))
        );
        return $options;
    }
}