<?php

class Creare_Deposit_Helper_Data extends Mage_Core_Helper_Abstract
{
	public function getDepositValue()
	{
		$deposit = 0;
		$cart = Mage::getModel('checkout/cart')->getQuote();
		foreach ($cart->getAllVisibleItems() as $item) {
		    $product = Mage::getModel('catalog/product')->load($item->getProductId());
		    $itemQty = $item->getQty();
		    
		    if ($product->getCreareDeposit())
		    {
		    	$deposit += $product->getCreareDeposit()*$itemQty;
		    }
		}

		return $deposit;
	}

	public function depositLabel()
	{
		return $this->__('Zero VAT Deposit');
	}

	public function depositCode()
	{
		return 'deposit';
	}

	public function getDepositTotal()
	{
		foreach( Mage::getSingleton('checkout/session')->getQuote()->getTotals() as $total )
        {
        	if ($total->getCode() == 'creare_deposit')
        	{
        		return $total->getValue();
        	}
        }
	}
}