<?php

class Creare_Deposit_Block_Adminhtml_Sales_Creditmemo_Adjustments extends Mage_Adminhtml_Block_Sales_Order_Creditmemo_Create_Adjustments
{
    
    public function initTotals()
    {
        parent::initTotals();
        $parent = $this->getParentBlock();
        $parent->removeTotal('deposit');
        return $this;
    }

    public function getDepositAmount()
    {
        $source = $this->getSource();
        $deposit = $source->getBaseDepositAmount();

        return Mage::app()->getStore()->roundPrice($deposit) * 1;
    }
}
