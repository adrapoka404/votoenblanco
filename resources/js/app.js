require('./bootstrap');

import Alpine from 'alpinejs';

window.Alpine = Alpine;

Alpine.start();

import $ from 'jquery';
import 'tw-elements';
window.$ = window.jQuery = $;

//import 'jquery-ui/ui/widgets/datepicker.js';


//Funcion para sibir imagenes en categorias
document.getElementById("file").addEventListener("change", cambiarImagen);
//document.getElementById("img_category").addEventListener("click", function(){document.getElementById("file").addEventListener("click")});
console.log('adx');

function cambiarImagen(event) {
    var file = event.target.files[0];

    var reader = new FileReader();
    reader.onload = (event) => {
        document.getElementById('img_category').setAttribute("src", event.target.result);
    }

    reader.readAsDataURL(file);
}
