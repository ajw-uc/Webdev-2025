<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Artikel</title>
</head>
<body>
    <a href="<?= route('article.create') ?>">Tambah artikel</a>
    <?php foreach ($articles as $article): ?>
    <div>
        <h4><?= $article['title'] ?></h4>
        <?= $article['content'] ?>
        <div>
            <small><?= $article['date'] ?></small>
        </div>
    </div>
    <hr/>
    <?php endforeach; ?>
</body>
</html>
