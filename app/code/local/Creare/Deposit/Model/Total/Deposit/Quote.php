<?php 
class Creare_Deposit_Model_Total_Deposit_Quote extends Mage_Sales_Model_Quote_Address_Total_Abstract
{
    protected $_code = 'deposit';

    public function collect(Mage_Sales_Model_Quote_Address $address)
    {

        parent::collect($address);
        if (($address->getAddressType() == 'billing')) {
            return $this;
        }
        $grandTotal = $address->getGrandTotal();
        $baseGrandTotal = $address->getBaseGrandTotal();

        $depositAmount = Mage::helper('creare_deposit')->getDepositValue();

        $address->setDepositAmount($depositAmount);
        $address->setBaseDepositAmount($depositAmount);

        $address->setGrandTotal($grandTotal + $address->getDepositAmount());
        $address->setBaseGrandTotal($baseGrandTotal + $address->getBaseDepositAmount());
 
        return $this;
    }
 

    public function fetch(Mage_Sales_Model_Quote_Address $address)
    {
       $deposit = $address->getDepositAmount();

        if ($deposit > 0) {
            $address->addTotal(array(
                'code'  => $this->_code,
                'title' => Mage::helper('creare_deposit')->depositLabel(),
                'value' => $deposit
            ));
        }
 
        return $this;
    }
}