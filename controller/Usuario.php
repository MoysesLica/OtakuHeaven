<?php 
namespace Controller\Usuario;
if(!isset($_SESSION))
	session_start();

require_once '../model/Cartao.php';
require_once '../model/Usuario.php';

require_once '../model/DAO/Cartao.php';
require_once '../model/DAO/Usuario.php';

use Model\Usuario as UsuarioClass;
use Model\Cartao as CartaoClass;
use DAO\Usuario as UsuarioDB;
use DAO\Cartao as CartaoDB;

switch ($_POST['acao']) {

	case 'deleteAccount':

		$id = $_POST['idUsuario'];

		$dados = UsuarioDB\Usuario::deletarConta($id);

		echo '<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Sucesso</h3> </div><div class="modal-body"> <p style="font-size: 20px;">Conta Deletada com Sucesso</p></div><div class="modal-footer"> <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button> </div></div></div></div><script type="text/javascript">$(\'.modal\').modal(\'show\'); setTimeout(function() {window.location.href="quit.php"}, 2000);</script>';

		break;
	
	case 'cadastrarUsuario':

		$banco         = $_POST['dadosCartao']['banco'];
		$agencia       = $_POST['dadosCartao']['agencia'];
		$digitoAgencia = $_POST['dadosCartao']['digito_agencia'];
		$conta         = $_POST['dadosCartao']['conta'];
		$digitoConta   = $_POST['dadosCartao']['digito_conta'];

		$CPF   = $_POST['dadosPessoa']['CPF']; $CPF = str_replace(".", "", $CPF); $CPF = str_replace("-", "", $CPF);
		$nome  = $_POST['dadosPessoa']['nome'];
		$email = $_POST['dadosPessoa']['email'];
		$senha = $_POST['dadosPessoa']['senha'];

		$cartao = new CartaoClass\Cartao(null, $banco, $agencia, $digitoAgencia, $conta, $digitoConta);

		$idCartao = CartaoDB\Cartao::createCartao($cartao);

		if($idCartao == -1){
			echo '<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Erro no Cadastro do Cartão</h3> </div><div class="modal-body"> <p style="font-size: 20px;">Cartão já Existe no Banco de Dados</p></div><div class="modal-footer"> <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button> </div></div></div></div><script type="text/javascript">$(\'.modal\').modal(\'show\')</script>';
			break;
		}

		$dataAtual = new \DateTime('now');
		
		$usuario = new UsuarioClass\Usuario(null, $nome, $CPF, $dataAtual->format('Y-m-d'), $idCartao, $email, hash("tiger192,3", $senha), 0);

		$response = UsuarioDB\Usuario::createUsuario($usuario);

		if($response == -1){
			echo '<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Erro no Cadastro do Usuário</h3> </div><div class="modal-body"> <p style="font-size: 20px;">CPF já Existe no Banco de Dados</p></div><div class="modal-footer"> <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button> </div></div></div></div><script type="text/javascript">$(\'.modal\').modal(\'show\')</script>';
			break;
		}else if($response == -2){
			echo '<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Erro no Cadastro do Usuário</h3> </div><div class="modal-body"> <p style="font-size: 20px;">E-Mail já Existe no Banco de Dados</p></div><div class="modal-footer"> <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button> </div></div></div></div><script type="text/javascript">$(\'.modal\').modal(\'show\')</script>';
			break;
		}

		echo '<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Usuário Cadastrado com Sucesso</h3> </div><div class="modal-body"> <p style="font-size: 20px;">Usuário Cadastrado com Sucesso</p></div></div></div></div><script type="text/javascript">$(\'.modal\').modal(\'show\'); setTimeout(function() {window.location.href="login.php"}, 1500);</script>';

		break;

	case 'logar':

		$email         = $_POST['email'];
		$senha         = hash("tiger192,3", $_POST['senha']);		

		$response = UsuarioDB\Usuario::login($email, $senha);

		if($response == false){

			echo '<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Erro</h3> </div><div class="modal-body"> <p style="font-size: 20px;">Dados de Acesso Inválidos</p></div></div></div></div><script type="text/javascript">$(\'.modal\').modal(\'show\'); </script>';

		}else{

			$usuario = new UsuarioClass\Usuario($response['ID'], $response['NOME'], $response['CPF'], $response['DATA_CADASTRO'], $response['CARTAO'], $response['EMAIL'], $response['SENHA'], $response['TIPO_USUARIO']);

			$_SESSION['USUARIO'] = [
				"id" => $usuario->id,
				"nome" => $usuario->nome,
				"cartao" => $usuario->cartao,
				"tipo_usuario" => $usuario->tipoUsuario
			];

			echo '<script type="text/javascript">setTimeout(function() {window.location.href="index.php"}, 100);</script>';

		}

		break;
	
	case 'getDados':

		$id = $_POST['idUsuario'];

		$dados = UsuarioDB\Usuario::getDados($id);

		echo json_encode($dados);

		break;
	
	case 'changeEmail':

		$id    = $_POST['idUsuario'];
		$email = $_POST['email'];

		$response = UsuarioDB\Usuario::changeEmail($id, $email);

		if($response != 0){

			echo '<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Sucesso</h3> </div><div class="modal-body"> <p style="font-size: 20px;">E-Mail Alterado com Sucesso</p></div></div></div></div><script type="text/javascript">$(\'.modal\').modal(\'show\'); </script>';

		}else{
			
			echo '<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Erro</h3> </div><div class="modal-body"> <p style="font-size: 20px;">E-Mail Indisponível para Uso</p></div></div></div></div><script type="text/javascript">$(\'.modal\').modal(\'show\'); </script>';

		}

		break;

	case 'changePassword':

		$id    = $_POST['idUsuario'];
		$senha = hash("tiger192,3", $_POST['senha']);

		$response = UsuarioDB\Usuario::changePassword($id, $senha);

		echo '<div class="modal" tabindex="-1" role="dialog"> <div class="modal-dialog" role="document"> <div class="modal-content"> <div class="modal-header"> <h3 class="modal-title">Sucesso</h3> </div><div class="modal-body"> <p style="font-size: 20px;">Senha Alterada com Sucesso</p></div></div></div></div><script type="text/javascript">$(\'.modal\').modal(\'show\'); </script>';

		break;
	
	
	default:
		/*ERROR*/

		ECHO "ERROR";

		break;
}

?>