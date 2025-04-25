# Deskripsi
rapidapi link = https://rapidapi.com/pierregoutheraud/api/movies-ratings2/playground/apiendpoint_ed20c5db-1426-431c-997b-7e72207b2f01
link local = http://127.0.0.1/api/movie/{imdbId}

imdbId merupakan id unik dari movie yang terdaftar dalam imdb. Anda bisa mendapatkannya dari link movie imdB. Contoh:
https://www.imdb.com/title/tt0081505/

Dalam hal ini, imdbId dari link di atas adalah tt0081505

# Instalasi
1. Clone repository.
2. Ubah .env.example menjadi .env
3. Sesuaikan RAPIDAPI_KEY dengan kode API yang didapat dari link rapidapi di atas.
4. Jalankan perintah php artisan serve
5. Masuk ke link local dan sesuaikan {imdbId} dengan id Imdb yang anda inginkan
