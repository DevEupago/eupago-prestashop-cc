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
 *  @author    euPago, Instituição de Pagamento Lda <suporte@eupago.pt>
 *  @copyright 2016 euPago, Instituição de Pagamento Lda
 *  @license   http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
 *  International Registered Trademark & Property of PrestaShop SA
 */
 
$useSSL = true;

include(dirname(__FILE__) . '/../../../config/config.inc.php');

$get_vars = (object)$_GET;

$callback = new eupago_callback();

$callback->execute($get_vars);

class eupago_callback
{

		public function execute($get_vars)
		{
			switch ($get_vars->mp) {
				case 'PC:PT':
					$modulo = 'multibanco';
					break;
				case 'PS:PT':
					$modulo = 'payshop';
					break;
				case 'MW:PT':
					$modulo = 'mbway';
					break;
				case 'PF:PT':
					$modulo = 'paysafecard';
					break;
				case 'PQ:PT':
					$modulo = 'pagaqui';
					break;
				case 'CC:PT':
					$modulo = 'cc';
					break;
				default:
					die('módulo nao encontrado');
			}


			if ($modulo=='payshop'){
				$modulo_ficheiro = '../../' . $modulo . '/' . $modulo . '.php';
			} else {
				$modulo_ficheiro = '../../eupago_' . $modulo . '/eupago_' . $modulo . '.php';
			}

			if (file_exists($modulo_ficheiro)) {
				include(dirname(__FILE__) . '/' . $modulo_ficheiro);
			} else {
				die('módulo nao encontrado');
			}

			switch ($modulo) {
				case 'multibanco':
					$modulo_obj = new eupago_multibanco();
					break;
				case 'payshop':
					$modulo_obj = new payshop();
					break;
				case 'mbway':
					$modulo_obj = new eupago_mbway();
					break;
				case 'paysafecard':
					$modulo_obj = new eupago_paysafecard();
					break;
				case 'pagaqui':
					$modulo_obj = new eupago_pagaqui();
					break;
				case 'cc':
					$modulo_obj = new eupago_cc();
					break;
				default:
					die('módulo nao encontrado');
			}

	// Executa o informação referencia
			if (class_exists("SOAPClient")) {
				$demo = explode("-", $get_vars->chave_api);
				if ($demo['0'] == 'demo') {
					$url = 'https://sandbox.eupago.pt/replica.eupagov20.wsdl';
				} else {
					$url = 'https://clientes.eupago.pt/eupagov20.wsdl';
				}

				$client = @new SoapClient($url, array('cache_wsdl' => WSDL_CACHE_NONE));
				$arraydados = array("chave" => $get_vars->chave_api, "referencia" => $get_vars->referencia, "entidade" => $get_vars->entidade);

				$result = $client->informacaoReferencia($arraydados);
				
				if ($result->estado_referencia == 'paga' && $result->valor == $get_vars->valor) {
					$resultado = $this->executeCallback($get_vars, $modulo_obj);
				} else {
					$resultado = "A encomenda não está paga";
				}
			} else {
				$this->executeCallback($get_vars, $modulo);
			}

			print_r($resultado);
		}

		// Executa o callback
		public function executeCallback($get_vars, $modulo_obj){

			if(isset($get_vars->tipo_callback) && $get_vars->tipo_callback == 'expirada'){
				// comunica expirada
				if(isset($get_vars->referencia, $get_vars->valor, $get_vars->chave_api, $get_vars->identificador)){
					$order = new Order($get_vars->identificador);
					echo "<pre>"; print_r($modulo_obj->getEmailVars($order,$get_vars->referencia)); echo"</pre>";
					$resultado = $modulo_obj->callBackExpirada($get_vars->referencia, $get_vars->valor, $get_vars->chave_api, $get_vars->identificador);
				}else{
					$resultado = "Faltam valores de get no callback";
				}
			}else{
				// comunica pagamento
				if(isset($get_vars->referencia, $get_vars->valor, $get_vars->chave_api, $get_vars->identificador)){
					$order = new Order($get_vars->identificador);
					//print_r($modulo_obj->getEmailVars($order,$get_vars->referencia));
					$resultado = $modulo_obj->callback($get_vars->referencia, $get_vars->valor, $get_vars->chave_api, $get_vars->identificador);
				}else{
					$resultado = "Faltam valores de get no callback";
				}
			}
			return $resultado;
		}

}


?>







