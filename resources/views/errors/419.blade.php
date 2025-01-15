<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Page Expired</title>
    <script>
        // 自動リロードスクリプト
        document.addEventListener('DOMContentLoaded', function () {
            const previousPage = document.referrer;
            if (previousPage) {
                // 前のページに戻る
                window.location.href = previousPage;
            } else {
                // 前のページがない場合、ホームにリダイレクト
                window.location.href = '/';
            }
        });
    </script>
</head>
<body>
    <h1>ページ期限切れ</h1>
    <p>このページは古いか、既に更新されています。もう一度操作をやり直してください。</p>
</body>
</html>
