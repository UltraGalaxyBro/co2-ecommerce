<?php 

$url = 'http://localhost/co2-commerce/';
//$url = 'https://co2pecas.com.br/';

//VARIÁVEIS GLOBAIS
$email = 'loja@co2pecas.com.br';
$password_email = 'Pableira21!';
$telephone = '(62) 3622-6979';
$whatsapp = '(62) 9 9807-6711';
$whatsapp_link = 'http://api.whatsapp.com/send?1=pt_BR&phone=5562998076711';
$telefone_link = '+556236226979';
$instagram_link = 'https://www.instagram.com/co2.pecas/';
$cnpj = '42.560.905/0001-66';

//-------------------------------------------------VARIÁVEIS DO BANCO DE DADOS E CONEXÃO ----------------------
$server = 'localhost';
$user = 'root';
$password = '';
$database = 'co2-new';
//$server = 'localhost';
//$user = 'u589920784_paboru';
//$password = 'Pableira21!';
//$database = 'u589920784_banco_co2';

date_default_timezone_set('America/Sao_Paulo');

try {
    $pdo = new PDO("mysql:dbname=$database;host=$server;charset=utf8", $user, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

} catch (PDOException $e) {
    throw new Exception("Erro ao conectar com o banco de dados: " . $e->getMessage());
}

$apiLockProducts = "AI7x234567890qwertYuiopASDFGHJKLZXCVBNM";
//--------------------------------------------------VARIÁVEIS MERCADO PAGO (PARA TESTE)---------------------------------
//$publicKey = 'APP_USR-751ebaf9-fb3f-4c02-b358-18f833e72749';
//$accessToken = 'APP_USR-6264618872891318-102609-d94ce79c8735dad85b48fc2fc19ab485-1525869796';

//VARIÁVEIS MERCADO PAGO (PARA PRODUÇÃO)
$publicKey = 'APP_USR-22fe6711-6afe-4d1a-9a34-a886d7b35206';
$accessToken = 'APP_USR-5604643803045830-092116-a93271406eb6c510851e82d1b17f96a5-1202665972';

?>
