<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title><?= $title ?? "Titre de page" ?></title>
    <meta name="description" content="<?= $description ?? "ceci est la description de ma page" ?>">
    <link rel="stylesheet" href="/Public/assests/css/main.css">
</head>

<body>
    <?php include "../Views/partials/header.php" ?>
<!--    <h1>--><?php //= $title ?? "" ?><!--</h1>-->
    <?php include "../Views/" . $this->v; ?>
</body>

</html>
