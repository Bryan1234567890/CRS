<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:locale" content="en_us" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="" />
    <meta property="og:description" content="" />

    <link rel="icon" href="<?= IMG_PATH ?>fav/favicon.ico" />

    <title><?= PAGE_TITLE . (isset($data['title']) ? ' - ' . $data['title'] : '') ?></title>

    <link href="https://fonts.googleapis.com/css2?family=Lato&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <link href="<?= CSS_PATH ?>main.min.css" rel="stylesheet">
    <link href="<?= CSS_PATH ?>layout.min.css" rel="stylesheet">
    <link rel="stylesheet" href="<?= CSS_PATH ?>refund-modal-2.min.css">
    <link rel="stylesheet" href="<?= CSS_PATH ?>subscription-modal.css">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>