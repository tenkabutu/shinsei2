import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// jQueryとtablesorterを追加
import $ from 'jquery'; // jQueryをインポート
window.$ = window.jQuery = $; // jQueryをグローバルに設定

//import 'tablesorter'; // npm経由でインストールした場合
// または
 require('./jquery.tablesorter'); // `resources/js`内に保存している場合

$(document).ready(function () {
    $('#myTable').tablesorter(); // 必要に応じてテーブルIDを指定
});