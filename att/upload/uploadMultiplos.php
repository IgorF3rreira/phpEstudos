<?php

    if(isset($_POST['enviar-form'])){
        $formatosPermitidos = array("png", "jpeg", "jpg", "gif");

        //variavel com count para poder contar quantos arquivos foram enviados
        $quantidadeArquivos = count($_FILES["arquivo"]['name']);
        $contador = 0;


        //Criar laço de repetição porque são enviados mais de 1 arquivo
        while($contador < $quantidadeArquivos):

        //criar uma variavel para pegar a extensão do arquivo para verificar se é permitida
        $extensao = pathinfo($_FILES['arquivo']['name'][$contador], PATHINFO_EXTENSION);

        //verificar se a extensao existe dentro do array
        if(in_array($extensao, $formatosPermitidos)){
            //criar o caminho para onde vai mandar os aruivos enviados 
            $pasta = "arquivos/";
            $temporario = $_FILES['arquivo']['tmp_name'][$contador];
            $novoNome = uniqid().".$extensao";

            //verificar se ouve o upload
            if(move_uploaded_file($temporario, $pasta.$novoNome)){
                echo "Upload feito com sucesso para $pasta$novoNome<br>";
            }else
                echo "Erro, não foi possivel fazer o upload para $temporario";
            }else
                echo   "$extensao não é permitida";
        
        
    $contador++;
    endwhile;
}


    

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
        <form action="<?php echo $_SERVER['PHP_SELF']; ?>"  method="POST" enctype="multipart/form-data">
            <input type="file" name="arquivo[]" multiple>
            <input type="submit" name="enviar-form" >
        </form>
</body>
</html>