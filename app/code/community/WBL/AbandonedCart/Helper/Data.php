<?php
class WBL_AbandonedCart_Helper_Data  extends Mage_Core_Helper_Abstract 
{
    /**
     * @return string
     */
    public function getVersion()
    {
        return (string) Mage::getConfig()->getNode('modules/WBL_AbandonedCart/version');
    }


    /**
     * @return array
     */
    public function getDatePeriods()
    {
        return array(
            '24h' => $this->__('Last 24 Hours'),
            '7d'  => $this->__('Last 7 Days'),
            '30d'  => $this->__('Last 30 Days'),
            '60d'  => $this->__('Last 60 Days'),
            '90d'  => $this->__('Last 90 Days'),
            'lifetime' => $this->__('Lifetime'),
        );
    }
    public function log($message)
    {
        if(Mage::getStoreConfig(WBL_AbandonedCart_Model_Config::LOG)) {
            Mage::log($message);
        }
    }
    public function saveMail($mailType,$mail,$name,$couponCode,$storeId)
    {
        if($couponCode!='') {
            $coupon = Mage::getModel('salesrule/coupon')->load($couponCode, 'code');
            $rule = Mage::getModel('salesrule/rule')->load($coupon->getRuleId());
            $couponAmount = $rule->getDiscountAmount();
            switch($rule->getSimpleAction()) {
                case 'cart_fixed':
                    $couponType = 1;
                    break;
                case 'by_percent':
                    $couponType = 2;
                    break;
            }
        }
        else {
            $couponType = 0;
            $couponAmount = 0;
        }
        $sent = Mage::getModel('wbl_abandonedcart/mailssent');
        $sent->setMailType($mailType)
             ->setStoreId($storeId)
             ->setCustomerEmail($mail)
             ->setCustomerName($name)
             ->setCouponNumber($couponCode)
             ->setCouponType($couponType)
             ->setCouponAmount($couponAmount)
             ->setSentAt(Mage::getModel('core/date')->gmtDate())
             ->save();
    }
}