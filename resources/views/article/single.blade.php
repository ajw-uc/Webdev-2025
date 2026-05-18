<x-template>
    <div class="container">
        <div class="mb-3 text-end">
            <a href="{{ route('article.edit', ['id' => $article->id]) }}" class="btn btn-info">
                Ubah
            </a>
            <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal">
                Hapus
            </button>
            <a href="{{ route('article.list') }}" class="btn btn-secondary">
                Kembali
            </a>
        </div>
        <h1>
            {{ $article->title }}
        </h1>
        <h5 class="mb-2 text-body-secondary">
            {{ $article->updated_at }}
        </h5>
        <p>
            {{ $article->content }}
        </p>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Hapus artikel</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Apakah Anda yakin ingin menghapus artikel ini?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Batal</button>
                    <form action="{{ route('article.delete', ['id' => $article->id]) }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-danger">Hapus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-template>
