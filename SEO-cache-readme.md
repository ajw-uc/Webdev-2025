# SEO (Search Engine Optimization)

## Apa itu SEO?
Praktik untuk mengoptimasi website agar lebih mudah ditemukan oleh search engine (Google, Bing, dll.)

## Apa yang dilakukan oleh search engine?
1. Menggunakan bot untuk melakukan crawling (membuka, membaca, dan mengikuti link dalam website)
2. Menganalisa konten dari halaman web dan menyimpannya ke dalam index database
3. Menentukan ranking kemunculan di search engine

## Cara membuat aplikasi web menjadi SEO friendly
1. Gunakan slug daripada ID
2. Tambahkan tag title dan meta description (contoh: /resources/views/components/layout.blade.php)
3. Penggunaan tag heading yang tepat (Contoh: h1 untuk judul, h2 untuk sub judul, h3 untuk detail sub judul)
4. Tambahkan atribut alt di setiap gambar
5. Gunakan SSR untuk halaman fokusnya menampilkan konten publik
6. Buat robots.txt untuk memberikan instruksi ke search engine tentang halaman mana di website yang bolah dan tidak boleh diakses (Contoh: https://shopee.co.id/robots.txt, https://www.tokopedia.com/robots.txt)
7. Buat sitemap XML (bisa dibuat secara otomatis dengan package spatie/laravel-sitemap di composer)
8. Gunakan HTTPS
9. Buat design yang responsive
10. Pastikan load time cepat (salah satunya dengan penggunaan cache)

## Monitoring
Gunakan tools Google Search Console: https://search.google.com/search-console/welcome?utm_source=about-page

## Disclaimer
Cara tersebut tidak langsung membuat website muncul di pencarian teratas search engine, tetapi hanya memperbesar peluangnya saja.

## Referensi
https://developers.google.com/search/docs/fundamentals/seo-starter-guide?hl=en


# Cache

## Apa itu cache?
Ruang penyimpanan data sementara.

## Kenapa perlu cache?
Agar aplikasi dapat memuat data lebih cepat tanpa harus mengulangi prosesnya dari awal

## Cara kerja cache?
1. Pada proses pertama, aplikasi akan memuat/memproses data dan menyimpannya ke dalam cache
2. Pada proses selanjutnya, aplikasi akan menampilkan data yang telah dimuat di dalam cache

## Contoh penerapan cache di Laravel
1. Isi atribut `CACHE_STORE` di .env dengan engine yang digunakan (contoh: file, database, redis, memcache, dsb)
2. Pastikan atribut `serializable_classes` di config/cache.php sudah diubah menjadi true, agar cache dapat menyimpan dan memuat cache dalam bentuk class
3. Contoh penggunaan cache untuk menampilkan produk ada di file app/Http/Controllers/ArticleController.php pada fungsi list

## Cache cocok dipakai untuk apa?
Cache sangat cocok untuk data yang sering dibaca tapi jarang diubah dan data dengan proses loading yang berat.
Contoh:
- Session user login
- Hasil paginate halaman pertama
- Laporan untuk periode waktu tertentu (tidak realtime)
