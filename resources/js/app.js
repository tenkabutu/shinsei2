import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

// jQueryとtablesorterを追加
//import $ from 'jquery'; // jQueryをインポート
//window.$ = window.jQuery = $; // jQueryをグローバルに設定

//import 'tablesorter'; // npm経由でインストールした場合
// または
require('./jquery.tablesorter'); // `resources/js`内に保存している場合
require('./select2.min');
//require('./jquery.repeater');


//$(document).ready(function () {
//    $('#myTable').tablesorter(); // 必要に応じてテーブルIDを指定
//});


import Keyboard from "simple-keyboard";
import "simple-keyboard/build/css/index.css";
const keyboardContainer = document.querySelector('.simple-keyboard');
if (keyboardContainer) {
let keyboard = new Keyboard({
  onChange: input => onChange(input),
  onKeyPress: button => onKeyPress(button),
  layout: {
    default: ["1 2 3 4 5 6", "7 8 9 0 {bksp}"],
    shift: ["! / #", "$ % ^", "& * (", "{shift} ) +", "{bksp}"]
  },
  theme: "hg-theme-default hg-layout-numeric numeric-theme",
  buttonTheme: [
    {
      class: "hg-width",
      buttons: "1 2 3 4 5 6 7 8 9 0"
    }

  ]
});

}

function onChange(input){
  document.querySelector(".input").value = input;
  console.log("Input changed", input);
}

function onKeyPress(button){
  console.log("Button pressed", button);
}