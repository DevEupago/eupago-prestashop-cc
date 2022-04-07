{*
*  20013-2016 euPago, instituição de pagamento LDA
*
*  @author    euPago <suporte@eupago.pt>
*  @copyright 20013-2016 euPago, instituição de pagamento LDA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

<div class="panel">
	<div class="row eupago_cc-header">
		<div class="col-xs-6 col-md-4 text-center">
			<img src="{$module_dir|escape:'html':'UTF-8'}views/img/logolaranja.png" class="col-xs-6 col-md-4 text-center" id="payment-logo" />
		</div>
		<div class="col-xs-6 col-md-4 text-center header2">
			<h4>{l s='euPago - payment solutions' mod='eupago_cc'}</h4>
			<h4>{l s='credit card payment´s' mod='eupago_cc'}</h4>
		</div>
		<div class="col-xs-12 col-md-4 text-center header2">
			<a href="http://www.eupago.pt/registo?lang=en&prestashop#registo_form" target="black" class="btn btn-primary" id="create-account-btn">{l s='Create an account now!' mod='eupago_cc'}</a><br />
			{l s='Already have an account?' mod='eupago_cc'}<a href="https://eupago.pt/clientes/users/login" target="blank" > {l s='Log in' mod='eupago_cc'}</a>
		</div>
	</div>

	<hr />
	
	<div class="eupago_cc-content">
		<div class="row">
			<div class="col-md-6">
				<h5>{l s='euPago credit card payment offers the following benefits' mod='eupago_cc'}</h5>
				<dl>
					<dt>&middot; {l s='Increase customer payment options' mod='eupago_cc'}</dt>
					<dd>{l s='Payments with: Visa®, Mastercard®, CB®' mod='eupago_cc'}</dd>
					
					<dt>&middot; {l s='Help to improve cash flow' mod='eupago_cc'}</dt>
					<dd>{l s='Receive funds quickly from the bank of your choice.' mod='eupago_cc'}</dd>
					
					<dt>&middot; {l s='Enhanced security' mod='eupago_cc'}</dt>
					<dd>{l s='Multiple firewalls, encryption protocols and fraud protection.' mod='eupago_cc'}</dd>
					
					<dt>&middot; {l s='Available on all SEPA area' mod='eupago_cc'}</dt>
					<dd>{l s='Increase the area covered by your payment methods throughout Europe.' mod='eupago_cc'}<br>{l s='This payment method accepts payments from all countries in the SEPA area.' mod='eupago_cc'}</br>{l s=' To learn more please see the following ' mod='eupago_cc'}<a href="#">link</a></dd>
				</dl>
			</div>
			
			<div class="col-md-6">
				<h5>{l s='Check our backoffice' mod='eupago_cc'}</h5>
				<iframe width="100%" height="315" src="https://www.youtube.com/embed/aZ2nrbsU20A" frameborder="0" allowfullscreen></iframe>
			</div>
		</div>

		<hr />
		
		<div class="row">
			<div class="col-md-12">
				<h4>{l s='Accept payments in Europe with:' mod='eupago_cc'}</h4>
				
				<div class="row">
					<img style="max-width:300px;" src="{$module_dir|escape:'html':'UTF-8'}views/img/cards_big.png" class="col-md-6" id="payment-logo" />
					<div class="col-md-6">
						<h6 style="padding: 10px 0 0 0" class="text-branded">{l s='For transactions with SEPA region cards' mod='eupago_cc'}</h6>
						<p class="text-branded">{l s='Call +351 222 061 597 if you have any questions or need more information!' mod='eupago_cc'}</br>
						<a class="link" href="https://www.ecb.europa.eu/paym/retpaym/paymint/sepa/html/index.en.html" target="blank">{l s='What is SEPA?' mod='eupago_cc'}</a>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
