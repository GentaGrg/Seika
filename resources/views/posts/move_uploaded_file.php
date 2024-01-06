<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ファイルが正常にアップロードされたか確認
    if (isset($_FILES["post"]["name"]["file_attachment"]) && !empty($_FILES["post"]["name"]["file_attachment"])) {
        $uploadDir = "uploads/"; // 保存先ディレクトリ
        $uploadedFile = $uploadDir . basename($_FILES["post"]["name"]["file_attachment"]);

        // ファイルを移動
        if (move_uploaded_file($_FILES["post"]["tmp_name"]["file_attachment"], $uploadedFile)) {
            // ファイルが正常に移動された場合、表示用のエリアに画像タグを埋め込んで表示
            echo '<img src="' . $uploadedFile . '" alt="Uploaded Image" style="max-width: 100%;">';
        } else {
            echo "ファイルのアップロードに失敗しました。";
        }
    } else {
        echo "ファイルが選択されていません。";
    }
}
?>
