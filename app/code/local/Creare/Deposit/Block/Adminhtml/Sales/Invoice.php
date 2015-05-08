<?php

class Creare_Deposit_Block_Adminhtml_Sales_Invoice extends Mage_Adminhtml_Block_Sales_Order_Invoice_Totals {

    public function creareHelper()
    {
        return Mage::helper('creare_deposit');
    }

    protected function _initTotals() {
        parent::_initTotals();

        $depositAmount = $this->getSource()->getDepositAmount();
        $baseDepositAmount = $this->getSource()->getBaseDepositAmount();

        if ($depositAmount != 0) {
            $this->addTotal(new Varien_Object(array(
                        'code' => $this->creareHelper()->depositCode(),
                        'value' => $depositAmount,
                        'base_value' => $baseDepositAmount,
                        'label' => $this->creareHelper()->depositLabel(),
                    )), $this->creareHelper()->depositCode());
        }
        return $this;
    }

}