<?php 

    include 'TlgTools.php';
    include "Telegram.php";
    ini_set("display_errors", 1);
    ini_set("display_startup_errors", 1);
    error_reporting(E_ALL);
    
    
    $token = BOT_TOKEN;
    $hook = SITE_URL."/botfree/bot.php";
    
    $bot = new Telegram($token);
    // Setando o Webhook
    $bot->setWebhook($hook);
    
    // variaveis
    $chat_id = $bot->ChatID();
    $texto = $bot->Text();
    
    if($texto == "/start")
    {   

    	 $nome = $bot->FirstName()." ".$bot->LastName();
         $nomeurl = $bot->FirstName()."%20".$bot->LastName();
         $mensagem = ["chat_id" => $chat_id, "text" => $bemvindo];
    
        $bot->sendMessage($mensagem);
       
        $apresentacao = "<b>ðââï¸ OLÃ ".$nome." SEJA BEM VINDO</b>\n\nCompre seu login ou gere seu teste agora mesmo!";
    
        $option = [
        
        array($bot->buildInlineKeyBoardButton("ð§ð· CRIAR TESTE ð§ð·", null, "/teste")),
        array($bot->buildInlineKeyBoardButton("ð§ð· COMPRAR SSH ð§ð·", SITE_URL."/botfree/processando.php?nome=".$nomeurl."&userid=".$chat_id)),
        array($bot->buildInlineKeyBoardButton("ð² BAIXAR APP ð²", null, "/app")),
		array($bot->buildInlineKeyBoardButton("ð² PlaStore APP ð²", null, "https://eduardosshofc.com.br")),
        array($bot->buildInlineKeyBoardButton("ð¨âð» SUPORTE ð¨âð»", "https://t.me/Couty_SSH"))
    
        ];
    
        $keyb = $bot->buildInlineKeyBoard($option);
        $content = ["chat_id" => $chat_id, "reply_markup" => $keyb, "parse_mode" => "html", "text" => $apresentacao];
        $bot->sendMessage($content);
        
    
    }
    elseif($texto == "/teste")
    {
    $user = "teste-".$geral->gerador2(4); 
    $senha = rand(11111, 99999);
    $limite = 1;  
    criar_teste($user, $senha, $tempo, $limite);
   
   $retorno = "â TESTE CRIADO COM SUCESSO! â

ð: ".TESTEBOT."

USER    ð¤: ".$user."

SENHA   ð: ".$senha."

LIMITER ð»: 1

ð: ".TESTE_TEMPO." Minutos

";
    $mensagem = ["chat_id" => $chat_id, "text" => $retorno];

    
         $bot->sendMessage($mensagem);

        
    
    }
    elseif($texto == "/app")
    {   
    $doc = "apk/".APK_NOME;
$document = new CURLFile(realpath($doc));
$content = array('chat_id' => $chat_id, 'document' => $document);
$bot->sendDocument($content);
    
    
    }
    

?>
