var indi="ATLANTICO";
var datos_capital;
var key="";
var key_temp="";
$(function(){
	$(".nac-votos-si").css("width",0);
	$(".nac-votos-no").css("width",0);
	setInterval(function(){
		cargarValoresGeneral();
		cargarValores(key);
		cargarValoresNacional();
	}, 2000);
	
	var map = $('#map1').vectorMap({map: 'co_merc'});
    $("svg").find("path").click(function(){
    	elemento=$(this);
    	key=$(this).attr("data-code");
    	cargarValores(key, elemento);
    });
    sanandres();
});

function count($element, total_sufragantes){
	var valActual = parseInt($element.html(), 10);
	var valData=$element.attr('data-count');
	valActual = valActual + 1; 
	total_sufragantes=parseInt(total_sufragantes);
	$element.html(++valActual);
	if(valActual > valData){//Se detiene
		$element.html(valData);
	} else {//Sigue
		setTimeout(function(){
			porc=Math.round(((valActual*100)/total_sufragantes));
			$element.css("width", porc+"%");
			count($element, total_sufragantes);
		}, 50);
	}
}

function cargarDefault(){
	var ts = new Date().getTime();
	var time = {_: ts};
	if (key=="") {
		$.getJSON("js-vector/data.json", time, function(data){ // consolidado Departamental
			datos=data;
			var items = [];
			/*Mostrar info Depto Atlantico por defecto*/
				$(".dept-Depto").html("Departamento: <span class='resul-depto'>"+data['CO-ATL'].data[0][0]+"</span>");
				$(".dept-bol").html("Boletin Numero: <span class='resul-depto'>"+data['CO-ATL'].data[1][0]+"</span>");
				$(".dept-hora").html("Hora de Actualizacion: <span class='resul-depto'>"+data['CO-ATL'].data[2]+"</span>");
				$(".dept-fecha").html("Fecha de Actualizacion: <span class='resul-depto'>"+data['CO-ATL'].data[3]+"</span>");
				$(".dept-mesas").html("Mesas informadas de las Instalas: <span class='resul-depto'>"+data['CO-ATL'].data[4]+"</span>");
				$(".dept-votos").html("Votos contados del potencial de sufragantes: <span class='resul-depto'>"+data['CO-ATL'].data[5]+"</span>");
				$(".dept-nulos").html("Votos nulos: <span class='resul-depto'>"+data['CO-ATL'].data[6][0]+"</span>");
				$(".dept-marcados").html("Votos no marcados: <span class='resul-depto'>"+data['CO-ATL'].data[7][0]+"</span>");
				$(".dept-votos-si").find(".CO-ATL").attr("data-count", data['CO-ATL'].si[0]);
		    	total_sufragantes=data['CO-ATL'].data[5].split("de");
				total_sufragantes=total_sufragantes[1];
		    	element=$(".dept-votos-si").find(".CO-ATL").addClass("mostrar");
		    	count(element, total_sufragantes);
				$(".dept-votos-no").find(".CO-ATL").attr("data-count", data['CO-ATL'].no[0]);
				element=$(".dept-votos-no").find(".CO-ATL").addClass("mostrar");
		    	count(element, total_sufragantes);


			/*Fin datos por defecto*/
		});

		// Mostrar Barranquilla por defecto
		$.getJSON("js-vector/data-cap.json", time, function(datos_capital){
			var items = [];
			/*Mostrar Barranquilla por defecto*/
				$(".capt-capt").html("Ciudad: <span class='result-capt'>"+datos_capital[indi].data[0][0]+"</span>");
				$(".capt-bol").html("Boletin Numero:<span class='result-capt'>"+datos_capital[indi].data[1][0]+"</span>");
				$(".capt-hora").html("Hora de Actualizacion:<span class='result-capt'>"+datos_capital[indi].data[2]+"</span>");
				$(".capt-fecha").html("Fecha de Actualizacion:<span class='result-capt'>"+datos_capital[indi].data[3]+"</span>");
				$(".capt-mesas").html("Mesas informadas de las Instalas:<span class='result-capt'>"+datos_capital[indi].data[4]+"</span>");
				$(".capt-votos").html("Votos contados del potencial de sufragantes:<span class='result-capt'>"+datos_capital[indi].data[5]+"</span>");
				$(".capt-nulos").html("Votos nulos:<span class='result-capt'>"+datos_capital[indi].data[6][0]+"</span>");
				$(".capt-marcados").html("Votos no marcados:<span class='result-capt'>"+datos_capital[indi].data[7][0]+"</span>");
				$(".capt-votos-si").find(".ATLANTICO").attr("data-count", datos_capital[indi].si[0]);
				//debugger;
		    	total_sufragantes=datos_capital[indi].data[5].split("de");
				total_sufragantes=total_sufragantes[1];
		    	element=$(".capt-votos-si").find(".ATLANTICO").addClass("mostrar");
		    	count(element, total_sufragantes);
				$(".capt-votos-no").find(".ATLANTICO").attr("data-count", datos_capital[indi].no[0]);
				element=$(".capt-votos-no").find(".ATLANTICO").addClass("mostrar");
		    	count(element, total_sufragantes);
			/*Fin datos por defecto*/
		});
	}
}

function cargarValoresGeneral(){
	var ts = new Date().getTime();
	var time = {_: ts};
	$.getJSON("js-vector/data.json", time, function(data){ // consolidado Departamental
		datos=data;
		var items = [];
     	$.each( data, function( key, val ){
		    clave=items.push(key);
		    valor=items.push(val);
		    if(val.no[0]>val.si[0]) // Gana el NO ROJO
			{
				$("svg").find("[data-code='"+key+"']").css('fill',  'red','important');
			}
		    if(val.si[0]>val.no[0]) // Gana el SI AZUL
		    {
		     	$("svg").find("[data-code='"+key+"']").css('fill',  'blue','important');
		    }
		});
	});
}

function cargarValoresNacional(){

	var ts = new Date().getTime();
	var time = {_: ts};
	$.getJSON("js-vector/data-nac.json?", time, function(data_nac){ // consolidado nacional
		var items_nac = [];
     	$.each(data_nac, function( key_nac, val_nac ){
     		clave_nac=items_nac.push(key_nac);
		    valor_nac=items_nac.push(val_nac);
			$(".nac-bol").html("Boletin Numero: <span class='resul-nac'>"+val_nac.data[1][0]+"</span>");
			$(".nac-hora").html("Hora de Actualizacion: <span class='resul-nac'>"+val_nac.data[2]+"</span>");
			$(".nac-fecha").html("Fecha de Actualizacion: <span class='resul-nac'>"+val_nac.data[3]+"</span>");
			$(".nac-mesas").html("Mesas informadas de las Instalas: <span class='resul-nac'>"+val_nac.data[4]+"</span>");
			$(".nac-votos").html("Votos contados del potencial de sufragantes: <span class='resul-nac'>"+val_nac.data[5]+"</span>");
			$(".nac-nulos").html("Votos nulos: <span class='resul-nac'>"+val_nac.data[6][0]+"</span>");
			$(".nac-marcados").html("Votos no marcados: <span class='resul-nac'>"+val_nac.data[7][0]+"</span>");
	    	$(".nac-votos-si").attr("data-count", val_nac.si[0]);
	    	total_sufragantes=val_nac.data[5].split("de");
			total_sufragantes=total_sufragantes[1];
	    	element=$(".nac-votos-si");
	    	count(element, total_sufragantes);
			$(".nac-votos-no").attr("data-count", val_nac.no[0]);
			element=$(".nac-votos-no");
	    	count(element, total_sufragantes);
		});
	});

}

function cargarValores(key, elemento){
	if (key=="" || key==undefined) {
		key="CO-ATL";
	};
	if (key!=key_temp) {
		$(".dept-votos-si span").removeClass("mostrar");
		$(".dept-votos-no span").removeClass("mostrar");
		$(".capt-votos-si span").removeClass("mostrar");
		$(".capt-votos-no span").removeClass("mostrar");
	};
	key_temp=key;
	var ts = new Date().getTime();
	var time = {_: ts};
	$.getJSON("js-vector/data.json", time, function(datos){ // consolidado Departamental
		if (key!="" && key!=undefined) {
			var items = [];
		    if(datos[key].no[0]>datos[key].si[0]){ // Gana el NO ROJO
				$("svg").find("[data-code='"+datos[key]+"']").css('fill',  'red','important');
			} 
			if(datos[key].si[0]>datos[key].no[0]){ // Gana el SI AZUL
		    	$("svg").find("[data-code='"+datos[key]+"']").css('fill',  'blue','important');
		    }
		    /*evento para mostrar los demas departamentos*/
	    	indi=datos[key].data[0][0];
	    	$(elemento).attr("data-departamento", indi);
	    	$(".dept-Depto").html("Departamento: <span class='resul-depto'>"+datos[key].data[0][0]+"</span>");
			$(".dept-bol").html("Boletin Numero: <span class='resul-depto'>"+datos[key].data[1][0]+"</span>");
			$(".dept-hora").html("Hora de Actualizacion: <span class='resul-depto'>"+datos[key].data[2]+"</span>");
			$(".dept-fecha").html("Fecha de Actualizacion: <span class='resul-depto'>"+datos[key].data[3]+"</span>");
			$(".dept-mesas").html("Mesas informadas de las Instalas: <span class='resul-depto'>"+datos[key].data[4]+"</span>");
			$(".dept-votos").html("Votos contados del potencial de sufragantes: <span class='resul-depto'>"+datos[key].data[5]+"</span>");
			$(".dept-nulos").html("Votos nulos: <span class='resul-depto'>"+datos[key].data[6][0]+"</span>");
			$(".dept-marcados").html("Votos no marcados: <span class='resul-depto'>"+datos[key].data[7][0]+"</span>");
			$(".dept-votos-si").find("."+key).attr("data-count", datos[key].si[0]);
	    	total_sufragantes=datos[key].data[5].split("de");
			total_sufragantes=total_sufragantes[1];
	    	element=$(".dept-votos-si").find("."+key).addClass("mostrar");
	    	count(element, total_sufragantes);
			$(".dept-votos-no").attr("data-count", datos[key].no[0]);
			$(".dept-votos-no").find("."+key).attr("data-count", datos[key].no[0]);
			element=$(".dept-votos-no").find("."+key).addClass("mostrar");
	    	count(element, total_sufragantes);	

		}		
	});


	var ts = new Date().getTime();
	var time = {_: ts};
	$.getJSON("js-vector/data-cap.json", time, function(datos_capital){ // consolidado por capitales
		if(indi=="CUNDINAMARCA" || indi=="BOGOTA D.C."){
			$(".capitales").css("display","none");
		}
		if(indi!="CUNDINAMARCA"){
			$(".capitales").css("display","block");
			$(".capt-capt").html("Ciudad:<span class='result-capt'>"+datos_capital[indi].data[0][0]+"</span>");
			$(".capt-bol").html("Boletin Numero:<span class='result-capt'>"+datos_capital[indi].data[1][0]+"</span>");
			$(".capt-hora").html("Hora de Actualizacion:<span class='result-capt'>"+datos_capital[indi].data[2]+"</span>");
			$(".capt-fecha").html("Fecha de Actualizacion:<span class='result-capt'>"+datos_capital[indi].data[3]+"</span>");
			$(".capt-mesas").html("Mesas informadas de las Instalas:<span class='result-capt'>"+datos_capital[indi].data[4]+"</span>");
			$(".capt-votos").html("Votos contados del potencial de sufragantes:<span class='result-capt'>"+datos_capital[indi].data[5]+"</span>");
			$(".capt-nulos").html("Votos nulos:<span class='result-capt'>"+datos_capital[indi].data[6][0]+"</span>");
			$(".capt-marcados").html("Votos no marcados:<span class='result-capt'>"+datos_capital[indi].data[7][0]+"</span>");
			var indi2=indi.replace(' ','_');
			indi2=indi2.replace(' ','_');
			indi2=indi2.replace('.','');
			indi2=indi2.replace('.','');
			$(".capt-votos-si").find("."+indi2).attr("data-count", datos_capital[indi].si[0]);
			total_sufragantes=datos_capital[indi].data[5].split("de");
			total_sufragantes=total_sufragantes[1];
	    	element=$(".capt-votos-si").find("."+indi2).addClass("mostrar");
	    	count(element, total_sufragantes);
			$(".capt-votos-no").find("."+indi2).attr("data-count", datos_capital[indi].no[0]);
			element=$(".capt-votos-no").find("."+indi2).addClass("mostrar");
	    	count(element, total_sufragantes);
    	}
	});
}

function sanandres(){
	$("svg").find("[data-code='CO-SAP']").attr("d","M146.1,105.7c2.1,0.1,3-0.9,4.1-2.3c1.4-1.7,3.7-2.4,5.4-3.7c1.4-1,2.7-2.3,4-3.6c1.3-1.2,2.6-2.4,4.1-3.5     c1.7-1,4,0.3,5.2,2.7c0.5,1.2,0.8,2.6,1.4,3.6c0.6,0.9,1.5,1.8,2.4,2.3c2.6,1.3,5.3,2.2,7.7,3.6c2.3,1.3,2.2,1.7,0.3,3.6     c-2.6-1.8-7.5-1.4-9.8,0.5c-1.2,0.9-2.6,1.5-4,2.1c-2.7,0.9-3.2,1.4-3,3.6c1.7,1.2,2.8,2.2,4.4,3.4c-0.5,0.5-1,0.9-1.3,1     c-1.7-1-3.1-1.8-4.6-2.8c-0.6,3.2,0.5,4.8,3.7,5.3c0.3,0,0.5,0,0.6,0.1c0.8,0.6,1.4,1.3,2.2,1.9c-0.9,0.5-1.8,1.4-2.8,1.5     c-1.3,0.1-2.6-0.3-3.9-0.5c-0.6,2.7,0.3,3.9,2.8,3.5c0.1,1.7,0.4,3.4,0.4,5c0,3.5,0.1,6.8-0.1,10.3c0,1.2-0.5,2.8-1.3,3.4     c-2.8,1.8-2.8,4.5-2.3,7.1c1,4.9-0.9,8.5-4,11.9c-1.2,1.3-2.2,2.6-1.3,4.5c0.1,0.3,0.1,0.8-0.1,1c-2.3,3.4-1.7,7.5-2.6,11.1     c-1.4,5.9-3.4,11.5-6.1,16.9c-1.8,3.7-3.6,7.5-5.4,11.2c-0.5,1-1,2.1-1.7,3.1c-1.3,2.2-4.6,2.1-6.2-0.4c-1.5-2.3-3.2-4.8-3.9-7.3     c-0.5-2.2,0-4.8,0.8-7.1c0.9-3.1,2.3-5.9,3.6-9c0.6-1.5,1.4-3.1,1.9-4.8c0.3-0.9,0.3-1.8,0.4-2.8c0.3-1.9-0.1-3.7,0.6-5.8     c0.9-2.4,0.1-5.5,0.1-8.2c0-0.1-0.3-0.3-0.3-0.3c1.9-4.4-2.1-3.7-4-4.5c-1.9-0.8-3.2-3.2-2.2-5.7c1.3-3.6,2.2-7.6,4.1-10.8     c2.1-3.4,1.9-5.5-0.1-8.9c-1.5-2.7-1.4-6.3,0.8-8.9c1.7-1.9,4.1-3.2,6.2-4.8c1.9-1.4,3.4-3,3.4-5.5     C146.1,114.8,146.1,110.4,146.1,105.7z M193.7,153.1c-0.1,0.4,0.3,0.8,0.4,1.2c0.6,1.8,0.6,3.6-0.6,5.2c-0.3,0.4-0.4,1-0.3,1.3     c1,1.8,2.1,3.6,3.4,5.3c0.4,0.5,1.7,0.5,2.3,0.3c1.9-0.8,3.7-2.4,5.7-2.4c4.1-0.1,6.8-2.6,9.1-5.3c2.4-2.8,5-4.6,8.8-5.3     c3.5-0.6,7.5-7.9,6.8-11.7c-0.4-1.8-0.4-3.7-0.8-5.5c-0.4-2.1,0.8-3.1,2.4-3.7c0.6-0.3,1.3-0.4,1.7-0.8c1.7-1.3,4-2.3,3.1-5.4     c-0.6,0.1-1.3,0-1.9,0.3c-2.4,0.8-2.7,0.6-3.6-1.8c-0.8-2.1-1.5-4-2.3-6.1c-0.3-0.6-0.3-1.4,0-2.1c0.5-1.2,1.5-2.1,2.1-3.1     c0.5-1,0.9-2.2,0.8-3.4c0-0.5-1.4-0.9-2.2-1.3c-0.5-0.1-1.2,0-1.7-0.1c-1.4-0.4-3.1-0.6-3.6-2.4c-0.5-1.7-1.2-3.4-2.1-5.7     c-0.8,1.2-1.2,1.7-1.7,2.2c-0.5,0.6-0.9,1.7-1.5,1.8c-2.4,0.6-2.6,2.3-2.4,4.3c0,1,0,2.1,0,3.2c0,3.1-1.2,4.6-4.1,5.2     c-1.3,0.3-2.7,0.5-3.9-0.8c-1-1-2.2-1.2-4-0.5c-1.9,0.8-2.6,2.4-3.9,3.7c-3.2,3-5,6.6-6.1,10.6c-0.6,2.4-0.3,5.2-0.5,7.7     c0,1,0,2.1-0.4,3c-0.9,1.8-2.2,3.5-3.2,5C191.4,148.4,194.5,149.7,193.7,153.1z M216.2,92.3c-1.2,1.2-2.4,0.4-3.7,0.5     c-0.5,0-1,0.4-1.5,0.6c-0.9,0.4-1.8,1-2.7,1.3c-2.2,0.6-3.5,3.2-2.3,5.2c0.6,1.2,1.5,2.1,2.3,3.1c0.8,1.3,1.4,2.6,3.4,1.9     c1.4-0.4,3-0.4,4.1-1.2c0.9-0.5,1.3-1.9,1.7-3.1c0.1-0.3-1.2-0.9-1.5-1.4c-0.5-0.5-1-1.3-1.2-1.9c-0.1-1.8,0.3-3.6,2.6-4.5     C216.7,92.7,216.3,92.3,216.2,92.3z");
}
