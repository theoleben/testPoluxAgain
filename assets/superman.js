import './styles/superman.scss'

const $ = require('jquery'); // pour utiliser jquery
global.$ = global.jQuery = $; // fix un pb d'utilisation de la variable $

require('bootstrap'); // pour utiliser le js de bootstrap

$(function(){
    console.log("superman.js");
})