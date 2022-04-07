<?php
/**
* 2007-2015 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author    PrestaShop SA <contact@prestashop.com>
*  @copyright 2007-2015 PrestaShop SA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

class Eupago_ccRedirectModuleFrontController extends ModuleFrontController
{
    /**
     * Do whatever you have to before redirecting the customer on the website of your payment processor.
     */
    public function postProcess()
    {
        /**
         * Oops, an error occured.
         */
        if (Tools::getValue('action') == 'error') {
            return $this->displayError('An error occurred while trying to redirect the customer');
        } else {
            $this->context->smarty->assign(array(
                'cart_id' => Context::getContext()->cart->id,
                'secure_key' => Context::getContext()->customer->secure_key,
            ));
			
			// controi array do carrinho
			$cart = new Cart((int)Context::getContext()->cart->id);
			$customer = new Customer((int)$cart->id_customer);
							
			/**
			 * Since it's an example we are validating the order right here,
			 * You should not do it this way in your own module.
			 */
			$payment_status = Configuration::get('EUPAGO_A_AGUARDAR_PAGAMENTO_CC'); // Status for pendind order
			$message = null; // You can add a comment directly into the order so the merchant will see it in the BO.

			/**
			 * Converting cart into a valid order
			 */
			$module_name = $this->module->displayName;
			$currency_id = (int)Context::getContext()->currency->id;

			// validamos a encomenda aqui porque precisamos de guardar o order id do nosso lado
			$this->module->validateOrder($cart->id, $payment_status, $cart->getOrderTotal(), $module_name, $message, array(), $currency_id, false, $customer->secure_key);

			/**
			 * If the order has been validated we try to retrieve it
			 */
			$order_id = Order::getOrderByCartId((int)$cart->id);

			if ($order_id && $customer->secure_key) {
				
				// faz chamada e retorna link 
				$chamadaSoap = $this->module->soapCall($cart,$customer,$order_id);
				if($chamadaSoap->estado == 0){
					Tools::redirect($chamadaSoap->url); // redirect
				}else{
					$history = new OrderHistory();
					$history->id_order = $order_id;
					$history->changeIdOrderState((int)Configuration::get('PS_OS_ERROR'), $order_id);
					$this->errors[] = $this->module->l('An error occured. Please contact the merchant to have more informations. Error: '.$chamadaSoap->estado);
					return $this->setTemplate('error.tpl');
				}		
				
			} else {
				/**
				 * An error occured and is shown on a new page.
				 */
				$this->errors[] = $this->module->l('An error occured. Please contact the merchant to have more informations');
				return $this->setTemplate('error.tpl');
			}
        }
    }

    protected function displayError($message, $description = false)
    {
        /**
         * Create the breadcrumb for your ModuleFrontController.
         */
        $this->context->smarty->assign('path', '
			<a href="'.$this->context->link->getPageLink('order', null, null, 'step=3').'">'.$this->module->l('Payment').'</a>
			<span class="navigation-pipe">&gt;</span>'.$this->module->l('Error'));

        /**
         * Set error message and description for the template.
         */
        array_push($this->errors, $this->module->l($message), $description);

        return $this->setTemplate('error.tpl');
    }
}
