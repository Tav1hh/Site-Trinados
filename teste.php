<?php 
echo "Olá <br>";
$caminho = 'teste/Ary Barroso/ari-barroso_rev_0.jpg';
$tipo = mime_content_type($caminho);

// Saber qual é a extensão
$mime_map = [
    'text/plain' => 'txt',
    'text/html' => 'html',
    'image/jpeg' => 'jpg',
    'image/png' => 'png',
    'application/pdf' => 'pdf',
    'application/zip' => 'zip',
    'audio/mpeg' => 'mp3',
    'video/mp4' => 'mp4',
    // Adicione mais mapeamentos conforme necessário
];

$tipo = $mime_map[$tipo];

echo $tipo

// rename($caminho,'teste/Ary Barroso/Ary-Barroso');
?>