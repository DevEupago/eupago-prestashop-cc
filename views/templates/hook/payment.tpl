{*
*  20013-2016 euPago, instituição de pagamento LDA
*
*  @author    euPago <suporte@eupago.pt>
*  @copyright 20013-2016 euPago, instituição de pagamento LDA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

<div class="row">
	<div class="col-xs-12">
		<p class="payment_module" id="euPago_cc_payment_button">
			{if $cart->getOrderTotal() >= 2}
				<a href="{$link->getModuleLink('eupago_cc', 'redirect', array(), true)|escape:'htmlall':'UTF-8'}" title="{l s='Pay with my payment module' mod='eupago_cc'}">
					<img src="{$module_dir|escape:'htmlall':'UTF-8'}/views/img/cards.png" alt="{l s='Pay with credit card' mod='eupago_cc'}" />
					{l s='Pay with credit card' mod='eupago_cc'}
				</a>
			{/if}
		</p>
	</div>
</div>
