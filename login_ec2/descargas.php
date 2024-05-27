<?php 
    require_once 'config.php';
    require_once 'check_session.php';

function convertToDownloadUrl($viewUrl) {
    preg_match('/\/d\/(.*?)\//', $viewUrl, $matches);
    $fileId = $matches[1];
    return "https://drive.google.com/uc?export=download&id=" . $fileId;
}

// Lista de URLs de Google Drive
$driveFiles = [
    "Ensayo semana 1" => "https://drive.google.com/file/d/12Dbkq6PUaqK36sgGsRlRqhX5VsMzNSS9/view?usp=sharing",
    "Ensayo semana 2" => "https://drive.google.com/file/d/1EE-FKy2QO9yYDTZYBLUll91zChnyPXf1/view",
    "Ensayo semana 3" => "https://drive.google.com/file/d/1p21ZZavP05QtEvgdFp7StC_Y_ylxoE1c/view?usp=sharing",
    "Ensayo semana 4" => "https://drive.google.com/file/d/1zcf1pFYK_f_SxYtBt936UX3IbpZ68YOw/view?usp=sharing",
    "Ensayo semana 5" => "https://drive.google.com/file/d/13z5M7AndF7rnia-O451N15mUtnT23Vsd/view?usp=sharing",
    "Ensayo semana 6" => "https://drive.google.com/file/d/1wRTLVtPuno9s_fTAVz7OQqEsiSobUMI9/view?usp=sharing",
    "Ensayo semana 7" => "https://drive.google.com/file/d/15uBrhqVOixj3NkMH4DjbiWvw7hQU1-kX/view?usp=sharing",
    "Ensayo semana 8" => "https://drive.google.com/file/d/1IvSrjOrc9MLjTuw4VNz8NL0PgOWKrAQY/view?usp=sharing",
    "Ensayo semana 9" => "https://drive.google.com/file/d/1JYFCOIxtmxIefTP78a_IdEx4DxWxaUEU/view?usp=sharing",
    "Ensayo semana 10" => "https://drive.google.com/file/d/1wnkUhau2gvroD8QaLJ9MFcgyxO56DyKj/view?usp=sharing",
    "Ensayo semana 11" => "https://drive.google.com/file/d/1n19TpwmjnTFwjnwZt76inWVCeC1ikXz9/view?usp=sharing",
    "Ensayo semana 12" => "https://drive.google.com/file/d/1jM-ARF0RknYzkIUl-YqWtbnGaIu_yrsF/view?usp=drive_link",
    "Ensayo semana 13" => "https://drive.google.com/file/d/1e5PGXBaFhu4yawF73FwoMdJ6XL-PQ0F8/view?usp=sharing",
    "Ensayo semana 14" => "https://drive.google.com/file/d/12NJ8HqqfgHo3CSXrhuKC6341yZ37zvn-/view?usp=sharing",
];

?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Descargar Documentos de Google Drive</title>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        color: #333;
        margin: 0;
        padding: 0;
    }
    header {
        background-color: #6e5773;
        color: #fff;
        padding: 20px;
        text-align: center;
        position: relative;
    }
    header .back-button {
        position: absolute;
        top: 20px;
        left: 20px;
        background-color: #563d62;
        color: #fff;
        padding: 10px 20px;
        text-decoration: none;
        border-radius: 5px;
        font-size: 16px;
    }
    header .back-button:hover {
        background-color: #724d82;
    }
    h1 {
        color: #ffffff;
    }
    .container {
        width: 50%;
        margin: auto;
        padding: 50px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        margin-top: 50px;
    }
    .link-container {
        margin-bottom: 20px;
    }
    a {
        color: #724d82;
        text-decoration: none;
    }
    a:hover {
        text-decoration: underline;
    }
</style>
</head>
<body>
<header>
    <a href="welcome.php" class="back-button">Volver</a>
    <h1>Descargar Documentos de Google Drive</h1>
</header>
<div class="container">
    <?php foreach ($driveFiles as $title => $viewUrl): ?>
        <?php $downloadUrl = convertToDownloadUrl($viewUrl); ?>
        <div class="link-container">
            <p><?php echo $title; ?>: <a href="<?php echo $viewUrl; ?>" target="_blank">Abrir y Descargar</a></p>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
