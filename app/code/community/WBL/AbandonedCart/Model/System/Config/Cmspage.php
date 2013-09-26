<?php
class WBL_AbandonedCart_Model_System_Config_Cmspage
{

    public function toOptionArray()
    {
        $collection = Mage::getModel('cms/page')->getCollection()->addOrder('title', 'asc');
        return array('checkout/cart'=> "Shopping Cart (default page)") + $collection->toOptionIdArray();
    }

}
