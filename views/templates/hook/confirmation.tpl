{*
*  20013-2016 euPago, instituição de pagamento LDA
*
*  @author    euPago <suporte@eupago.pt>
*  @copyright 20013-2016 euPago, instituição de pagamento LDA
*  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*}

{if (isset($status) == true) && ($status == 'ok')}
<h3>{l s='Your order in ' mod='eupago_cc'} <strong> {$shop_name|escape:'htmlall':'UTF-8'} </strong>  {l s='is completed. ' mod='eupago_cc'}</h3>
<p>
	<br />- {l s='Amount' mod='eupago_cc'} : <span class="price"><strong>{$total|escape:'htmlall':'UTF-8'}</strong></span>
	<br />- {l s='Reference' mod='eupago_cc'} : <span class="reference"><strong>{$reference|escape:'html':'UTF-8'}</strong></span>
	<br /><br />{l s='An email has been sent with this information.' mod='eupago_cc'}
	<br /><br />{l s='If you have questions, comments or concerns, please contact our' mod='eupago_cc'} <a href="{$link->getPageLink('contact', true)|escape:'html':'UTF-8'}">{l s='expert customer support team.' mod='eupago_cc'}</a>
</p>
{else}
<h3>{l s='Your order in ' mod='eupago_cc'} <strong> {$shop_name|escape:'htmlall':'UTF-8'} </strong>  {l s='has not been accepted. ' mod='eupago_cc'}</h3>
<p>
	<br />- {l s='Reference' mod='eupago_cc'} <span class="reference"> <strong>{$reference|escape:'html':'UTF-8'}</strong></span>
	<br /><br />{l s='Please, try to order again.' mod='eupago_cc'}
	<br /><br />{l s='If you have questions, comments or concerns, please contact our' mod='eupago_cc'} <a href="{$link->getPageLink('contact', true)|escape:'html':'UTF-8'}">{l s='expert customer support team.' mod='eupago_cc'}</a>
</p>
{/if}
<hr />