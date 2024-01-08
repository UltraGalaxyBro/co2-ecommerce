<?php

//FUNÇÃO DE VALIDAÇÃO DE CAMPO VAZIO
function checkEmptyOrNull($field, $fieldName)
{
    if (empty($field) || is_null($field)) {
        echo "O campo '$fieldName' não pode estar vazio ou nulo.";
        exit;
    }
    return true;
}

//FUNÇÕES PARA REDIMENSIONAR AS IMAGENS SALVAS EM UM PADRÃO DE TAMANHO E FAZER UPLOAD 
function uploadImage($fieldFile, $directory, $partialName, $partialName1, $partialName2, $imageClass)
{
    if (!isset($_FILES[$fieldFile])) {
        throw new Exception("Campo de arquivo não encontrado.");
    }

    $fileImg = $_FILES[$fieldFile];

    if ($fileImg['error'] !== UPLOAD_ERR_OK) {
        throw new Exception("Erro no upload do arquivo.");
    }

    if ($fileImg['size'] == 0) {
        throw new Exception("O arquivo está vazio.");
    }

    // Verifica o tipo do arquivo usando getimagesize()
    $imgInfo = getimagesize($fileImg['tmp_name']);
    if ($imgInfo === false) {
        throw new Exception("O arquivo não é uma image válida.");
    }

    // Verifica a extensão do arquivo
    $allowedExt = ['png', 'jpg', 'jpeg', 'gif'];
    $ext = pathinfo($fileImg['name'], PATHINFO_EXTENSION);

    if (!in_array(strtolower($ext), $allowedExt)) {
        throw new Exception("A extensão do arquivo não é permitida. Use PNG, JPG, JPEG ou GIF.");
    }

    // Carrega a imagem
    $image = null;
    switch ($ext) {
        case 'png':
            $image = imagecreatefrompng($fileImg['tmp_name']);
            break;
        case 'jpg':
        case 'jpeg':
            $image = imagecreatefromjpeg($fileImg['tmp_name']);
            break;
        case 'gif':
            $image = imagecreatefromgif($fileImg['tmp_name']);
            break;
    }

    if ($image === false) {
        throw new Exception("Falha ao criar a image a partir do arquivo.");
    }

    // Redimensiona a imagem para 500x500 pixels
    $larguraDesejada = 500;
    $alturaDesejada = 500;
    $newImage = imagescale($image, $larguraDesejada, $alturaDesejada);

    if ($newImage === false) {
        throw new Exception("Falha ao redimensionar a image.");
    }

    $newNameImg = $partialName . '_' . $partialName1 . '_' . $partialName2 . '_' . $imageClass;
    // Caminho completo para o novo arquivo
    $completePath = $directory . $newNameImg . '.' . $ext;

    // Salva a nova imagem no diretório especificado
    switch ($ext) {
        case 'png':
            imagepng($newImage, $completePath);
            break;
        case 'jpg':
        case 'jpeg':
            imagejpeg($newImage, $completePath);
            break;
        case 'gif':
            imagegif($newImage, $completePath);
            break;
    }

    // Libera a memória
    imagedestroy($image);
    imagedestroy($newImage);
    // Nome da imagem para salvar no banco de dados
    $definitiveName = $newNameImg . '.' . $ext;
    return $definitiveName;
}
