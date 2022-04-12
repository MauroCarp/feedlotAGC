// var btn_reporte_compras = document.getElementById('daterange-btn');
// btn_reporte_compras.addEventListener('click',function(){

    

// });


var btnCompras = document.getElementById('btnCompras');
var btnVentas = document.getElementById('btnVentas');
var btnMuertes = document.getElementById('btnMuertes');

$('#btnCompras').on('click',()=>{

    console.log('asdasd');

    
});


btnVentas.addEventListener('click',function(){    

    localStorage.removeItem("rango");
console.log('asdasd');

    $('#daterange-btn').html('<span><i class="fa fa-calendar"></i> Rango de fecha </span><i class="fa fa-caret-down"></i>');


});

btnMuertes.addEventListener('click',()=>{    

    localStorage.removeItem("rangoMuertes");

    $('#daterange-btnMuertes').html('<span><i class="fa fa-calendar"></i> Rango de fecha </span><i class="fa fa-caret-down"></i>');


});