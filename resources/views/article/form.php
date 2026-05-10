<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Artikel</title>
</head>
<body>
    <form method="post">
        <input type="hidden" name="_token" value="<?= csrf_token() ?>">

        <div>
            <label for="title">Judul</label>
            <input type="text" name="title" id="title">
        </div>
        <div>
            <label for="content">Isi</label>
            <textarea name="content" id="content"></textarea>
        </div>
        <button type="submit">Simpan</button>
    </form>
</body>
</html>
