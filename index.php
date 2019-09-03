<?php
//index.php

$error = '';
$name = '';
$email = '';
$empresa = '';
$telefone = '';

function clean_text($string)
{
	$string = trim($string);
	$string = stripslashes($string);
	$string = htmlspecialchars($string);

	return $string;
}

if (isset($_POST['submit'])) {
	if (empty($_POST['name'])) {
		$error .= '<p><label class="text-danger">Por favor adicione seu nome</label></p>';
	} else {
		$name = clean_text($_POST['name']);
		if (!preg_match('/^[a-zA-Z ]*$/', $name)) {
			$error .= '<p><label class="text-danger">Somente letras e espaços em branco são permitidos</label></p>';
		}
	}
	if (empty($_POST['email'])) {
		$error .= '<p><label class="text-danger">Por favor introduza o seu e-mail</label></p>';
	} else {
		$email = clean_text($_POST['email']);
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
			$error .= '<p><label class="text-danger">Formato de email inválido</label></p>';
		}
	}
	if (empty($_POST['empresa'])) {
		$error .= '<p><label class="text-danger">Por gentileza adicione a empresa</label></p>';
	} else {
		$empresa = clean_text($_POST['empresa']);
	}
	if (empty($_POST['telefone'])) {
		$error .= '<p><label class="text-danger">Por gentileza adicione o telefone</label></p>';
	} else {
		$telefone = clean_text($_POST['telefone']);
	}
	if ($error == '') {
		require 'class/class.phpmailer.php';
		$mail = new PHPMailer();
		$mail->IsSMTP();								//Define o email para envio via SMTP
		$mail->Host = 'mail.poplanding.com.br';		//Define os hosts SMTP da sua hospedagem de e-mail
		$mail->Port = '465';								//Define a porta do servidor SMTP padrão
		$mail->SMTPAuth = true;							//Define a autenticação SMTP. Utiliza as variáveis ​​Nome de usuário e Senha
		$mail->Username = 'poplanding@poplanding.com.br';					//Define usuário para autenticação
		$mail->Password = '12345';					//Define a senha para envio de e-mail
		$mail->SMTPSecure = 'ssl';							//Define o tipo de conexão se SSL ou TLS
		$mail->From = $_POST['email'];					//Define o endereço de
		$mail->FromName = $_POST['name'];				//Define o nome do email no envio
		$mail->AddAddress('poplanding@poplanding.com.br', 'Antilhas Stretch Hood');		//Adiciona um endereço "Para" envio
		//$mail->AddCC($_POST['email'], $_POST['name']);	//Adiciona um endereço de envio como cópia do e-mail
		$mail->WordWrap = 50;							//Define a quebra de linha no corpo do email para um determinado número de caracteres
		$mail->IsHTML(true);							//Define o tipo de email como HTML
		$mail->Subject = $_POST['empresa'];				//Define a empresa do e-mail
		//$mail->Body = $_POST['telefone'] . "\r \n" . $_POST['empresa'] . PHP_EOL . $_POST['email'] . PHP_EOL . $_POST['name'];			//Um corpo de email em HTML ou texto sem formatação
		$mail->Body =
			<<<ENVIO

		<div>Nome:<strong> $name</strong></div>
		<div>Email:<strong> $email</strong></div>
		<div>Empresa:<strong> $empresa</strong></div>
		<div>Telefone:<strong> $telefone</strong></div>
ENVIO;

		if ($mail->Send()) {								//Enviar um email. Retornar verdadeiro com êxito ou falso com erro
			$error = '';
		} else {
			$error = '<label class="text-danger">Ocorreu um erro ao enviar o e-mail</label>';
		}
		$name = '';
		$email = '';
		$empresa = '';
		$telefone = '';
	}
}

header(sprintf('Location: %s', ''));

?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta charset="utf-8">
	<title>Antilhas Flexiveis</title>
	<meta name="description" content="Antilhas Flexiveis,filme para embalar e proteger cargas paletizadas">
	<meta name="author" content="Robson Oliveira">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="icon" type="image/png" href="images/favicon.ico">
	<link href='http://fonts.googleapis.com/css?family=Roboto:400,100,300,500,700' rel='stylesheet' type='text/css'>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>


	<!--CSS-->
	<link rel="stylesheet" href="css/rwdgrid.css">
	<link rel="stylesheet" href="css/skew.css">
	<link rel="stylesheet" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/cbp-fwslider.css">
	<link rel="stylesheet" href="css/responsive-nav.css">
	<link rel="stylesheet" href="css/owl.carousel.css">
	<link rel="stylesheet" href="css/owl.theme.css">
	<link rel="stylesheet" href="css/owl.transitions.css">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/prettyPhoto.css" />
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/mediaqueries.css">
	<link rel="stylesheet" href="css/mail.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
	<![endif]-->
	<!--[if lt IE 9]>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->


</head>

<body>

	<div id="cbp-fwslider" class="cbp-fwslider skew-bottom-ccw" style="background: url(images/bg-top-landing.jpg) no-repeat;background-size: cover;">

	</div>


	<!--texto do container do topo-->
	<div class="container header-inner">
		<h1 class="headline">Stretch Hood</h1>
		<h2 class="headline2">filme para embalar e proteger cargas paletizadas</h2>
	</div>


	<section>
		<div class="container">

			<div class="row">
				<div class="col">
					<video id="autoplay" class="responsive-vid" controls="controls" poster="images/back-video.PNG" width="820" height="480" autoplay="autoplay">
						<source src="video/Antilhas Flexíveis - Stretch Hood_Landing Page.mp4" type="video/mp4" />
						<source src="video/Antilhas-Flexíveis-Stretch-Hood_Landing-Page.webm" type="video/webm" />
						<source src="video/Antilhas-Flexíveis-Stretch-Hood_Landing-Page.ogv" type="video/ogg" />
						</object>
					</video>
				</div>


				<div class="col">
					<div class="text-block-left">
						<h2 class="headline3">BENEFICIOS</h2>
						<p class="subheading">Embalagem eficaz,inteligente e segura para uma ampla gama de produtos</p>



						<p class="imgcss"> <img src="images/icon_cert.png" width="50" height="50" align="left">
							Ganho logistico e de produtividade, devido à agilidade na paletização (até 230 paletes por hora)<br />
						</p><br>
						<p class="imgcss"> <img src="images/icon_cert.png" width="50" height="50" align="left">
							Personalizável - possibilidade de impressão da marca &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
						</p><br>
						<p class="imgcss"> <img src="images/icon_cert.png" width="50" height="50" align="left">
							Eficaz contra variações climáticas no armazenamento ao ar livre - dispensa uso de lona no caminhão<br />
						</p><br>
						<p class="imgcss"> <img src="images/icon_cert.png" width="50" height="50" align="left">
							Mais estabilidade - Maior proteção para reduzir perdas Segurança contra furtos<br />
						</p><br>
						<p class="imgcss"> <img src="images/icon_cert.png" width="50" height="50" align="left">
							Reduz a mão de obra em até 60% Aplicação 40% mais rápida que o strech convencional<br />
						</p>



					</div>
				</div>
			</div>
			<div class="clear"></div>
		</div>
	</section>



	<section class="alt-background skew-top-cw">
		<h3 align="center" class="font-six">Preencha o formulário abaixo que a nossa equipe de<br> especialistas entrará em contato.</h3>
		<div class="container-fluid width-fix" id="stylized">




			<div class="row">
				<div class="col-md-8" style="margin:0 auto; float:none;">

					<br />
					<?php echo $error; ?>
					<form method="post" action="">
						<div class="form-group">
							<label>Nome e Sobrenome</label>
							<input type="text" name="name" placeholder="Nome" class="form-control" value="<?php echo $name; ?>" />
						</div>
						<div class="form-group">
							<label>Empresa</label>
							<input type="text" name="empresa" class="form-control" placeholder="Empresa" value="<?php echo $empresa; ?>" />
						</div>

						<div class="form-group">
							<label>E-mail</label>
							<input type="text" name="email" class="form-control" placeholder="Email" value="<?php echo $email; ?>" />
						</div>
						<div class="form-group">
							<label>Telefone</label>
							<input type="text" name="telefone" class="form-control" placeholder="Telefone" value="<?php echo $telefone; ?>" />
						</div>
						<div class="form-group" align="center">
							<input type="submit" name="submit" value="Enviar" class="btn btn-secondary" />
						</div>
					</form>
				</div>
			</div>
		</div>
	</section>




	<script>
		document.getElementById('autoplay').autoplay();
	</script>

</body>

</html>