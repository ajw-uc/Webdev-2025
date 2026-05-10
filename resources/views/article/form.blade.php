<x-template title="Buat Artikel">
    <div class="container">
        <form method="post" class="was-validated">
            @csrf
            <x-form.group for="title" label="Judul">
                <input type="text" name="title" id="title" class="form-control" required>
            </x-form.group>
            <x-form.group for="content" label="Isi">
                <textarea name="content" id="content" class="form-control" required></textarea>
            </x-form.group>
            <div class="mb-3">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
    </div>
</x-template>
