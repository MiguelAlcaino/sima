/**
 * Created by malcaino on 06/09/15.
 */
var excludedInputs = [
    'primero_numero_contenedor',
    'segundo_numero_contenedor',
    'tercero_numero_contenedor'
];
var listaCambios = {};
listaCambios.cambios = {};
$('input, select, textarea').on('change',function(){
    if(!isInArray($(this).attr('name'), excludedInputs)) {
        if ($(this).is('select')) {
            trackerFunctionForSelect($(this), $(this).attr("name"));
        }else{
            trackerFunction($(this), $(this).attr('name'));
        }
    }
});

function trackerFunction(element, name){
    listaCambios['cambios'][name] = {};
    listaCambios['cambios'][name]['label'] = element.prev().prev('label').text() == "" ? name : element.prev().prev('label').text();
    listaCambios['cambios'][name]['value'] = element.val();
    console.log(listaCambios);
}

function trackerFunctionForSelect(element, name){
    listaCambios['cambios'][name] = {};
    listaCambios['cambios'][name]['label'] = element.prev().prev('label').text() == "" ? name : element.prev().prev('label').text();
    listaCambios['cambios'][name]['value'] = element.find(":selected").text();
    console.log(listaCambios);
}

function isInArray(value, array) {
    return array.indexOf(value) > -1;
}

function setTipoTracking(tipoTracking){
    listaCambios.tipo_tracking = tipoTracking;
}

function setTipoEntidad(tipoEntidad){
    listaCambios.tipo_entidad = tipoEntidad;
}

function setIdEntidad(idEntidad){
    listaCambios.id_entidad = idEntidad;
}

function sendCambios(callback){
    $.ajax({
        url: "/ajax/saveTrackingChanges",
        type: "POST",
        data:{
            'lista_cambios' : listaCambios
        },
        success: function(data){
            callback;
        }
    });
}

function getListaCambios(){
    return listaCambios;
}