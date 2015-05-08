<?php
class Creare_Deposit_Model_Observer {

	public function invoiceSaveAfter(Varien_Event_Observer $observer)
	{
		$invoice = $observer->getEvent()->getInvoice();
		if ($invoice->getBaseDepositAmount()) {
			$order = $invoice->getOrder();
			$order->setDepositAmountInvoiced($order->getDepositAmountInvoiced() + $invoice->getDepositAmount());
			$order->setBaseDepositAmountInvoiced($order->getBaseDepositAmountInvoiced() + $invoice->getBaseDepositAmount());
		}
		return $this;
	}
	public function creditmemoSaveAfter(Varien_Event_Observer $observer)
	{
		$creditmemo = $observer->getEvent()->getCreditmemo();

		// if there's a deposit amount being refunded, grab order and set the deposit amount  refunded as it's current level + the new refund request.
		if ($creditmemo->getDepositAmount()) {

			$order->setDepositAmountRefunded($order->getDepositAmountRefunded() + $creditmemo->getDepositAmount());
			$order->setBaseDepositAmountRefunded($order->getBaseDepositAmountRefunded() + $creditmemo->getBaseDepositAmount());
			// set Grand Total to correctly reflect the amount refunded including the deposit
			
			$order->setTotalRefunded($order->getTotalRefunded() - ($order->getDepositAmount()-$order->getDepositAmountRefunded()));
			$order->setBaseTotalRefunded($order->getBaseTotalRefunded() - ($order->getBaseDepositAmount()-$order->getBaseDepositAmountRefunded()));

			// If an offline refund

			if ($creditmemo->getOfflineRequested() == true)
			{
				$order->setTotalOfflineRefunded($order->getTotalOfflineRefunded() - ($order->getDepositAmount()-$order->getDepositAmountRefunded()));
				$order->setBaseTotalOfflineRefunded($order->getBaseTotalOfflineRefunded() - ($order->getBaseDepositAmount()-$order->getBaseDepositAmountRefunded()));

			}

			// If an online refund

			if ($creditmemo->getOfflineRequested() == false)
			{
				$order->setTotalOnlineRefunded($order->getTotalOnlineRefunded() - ($order->getDepositAmount()-$order->getDepositAmountRefunded()));
				$order->setBaseTotalOnlineRefunded($order->getBaseTotalOnlineRefunded() - ($order->getBaseDepositAmount()-$order->getBaseDepositAmountRefunded()));
			}

		}
		return $this;
	}
	public function creditmemoSaveBefore(Varien_Event_Observer $observer)
	{
		$post_data = Mage::app()->getRequest()->getPost();

		$creditmemo = $observer->getEvent()->getCreditmemo();
		$deposit_amount = $post_data['creditmemo']['deposit_amount'];
		if ($deposit_amount > 0)
		{
			$depositAmount = $creditmemo->getDepositAmount();
			$baseDepositAmount = $creditmemo->getDepositAmount();

			// Adjust Grand Total to reflect Deposit refund
			$creditmemo->setGrandTotal($creditmemo->getGrandTotal()-($depositAmount-$deposit_amount));
			$creditmemo->setBaseGrandTotal($creditmemo->getBaseGrandTotal()-($baseDepositAmount-$deposit_amount));

			// Set Deposit Total to actual refund amount
			$creditmemo->setDepositAmount($deposit_amount);
			$creditmemo->setBaseDepositAmount($deposit_amount);
		}

		return $this;
	}

	public function sendDepositToPaypal(Varien_Event_Observer $observer){
		$cart = $observer->getPaypalCart();

		if ($cart && $cart->getSalesEntity()->getDepositAmount() > 0) {
            $cart->addItem(Mage::helper('creare_deposit')->depositLabel(), 1, $cart->getSalesEntity()->getDepositAmount(), Mage::helper('creare_deposit')->depositCode());
        }
	}
}