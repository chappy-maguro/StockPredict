import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/js/app.js'],
            refresh: true,
        }),
    ],
    // ここから追記
    server: {
            host: '0.0.0.0', // コンテナ外からの接続を許可
            port: 5173,
            hmr: {
                host: 'localhost', // ブラウザからはlocalhostで見に行く
            },
            watch: {
                usePolling: true, // Docker環境でファイルの変更を検知しやすくする
            },
        },
});
