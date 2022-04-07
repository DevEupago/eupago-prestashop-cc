{*
*  20013-2016 euPago, instituição de pagamento LDA
*
*  @author    euPago <suporte@eupago.pt>
*  @copyright 20013-2016 euPago, instituição de pagamento LDA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

<div>
	<h3>{l s='Redirect your customer' mod='eupago_cc'}:</h3>
	<ul class="alert alert-info">
			<li>{l s='This action should be used to redirect your customer to the website of your payment processor' mod='eupago_cc'}.</li>
	</ul>
	
	<div class="alert alert-warning">
		{l s='You can redirect your customer with an error message' mod='eupago_cc'}:
		<a href="{$link->getModuleLink('eupago_cc', 'redirect', ['action' => 'error'], true)|escape:'htmlall':'UTF-8'}" title="{l s='Look at the error' mod='eupago_cc'}">
			<strong>{l s='Look at the error message' mod='eupago_cc'}</strong>
		</a>
	</div>
	
	<div class="alert alert-success">
		{l s='You can also redirect your customer to the confirmation page' mod='eupago_cc'}:
		<a href="{$link->getModuleLink('eupago_cc', 'confirmation', ['cart_id' => $cart_id, 'secure_key' => $secure_key], true)|escape:'htmlall':'UTF-8'}" title="{l s='Confirm' mod='eupago_cc'}">
			<strong>{l s='Go to the confirmation page' mod='eupago_cc'}</strong>
		</a>
	</div>
</div>
