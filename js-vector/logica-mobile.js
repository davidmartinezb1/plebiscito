//var indi;
var tsMobile = new Date().getTime();
var timeMobile = {_: tsMobile};
var options ;
var clave_dpto="CO-ATL";
var selected_dpto="ATLANTICO";
var datos_capitalMobile;
var key_temp="";
$(function(){
	$(".nac-votos-si").css("width",0);
	$(".nac-votos-no").css("width",0);
	
	create_select(); // crear select dinamico	
	setInterval(function(){
		cargarValoresNacionalMobile();
		cargarValoresMobile(clave_dpto,selected_dpto);
	}, 2000);
});

function ShowSelected()	{
	/* Para obtener la key del departamento*/
	clave_dpto = document.getElementById("dpto").value;
	console.log(clave_dpto);
	//console.log(clave_dpto);
	 
	/* Para obtener nombre del departamento */
	var combo = document.getElementById("dpto");
	selected_dpto = combo.options[combo.selectedIndex].text;
	//console.log(selected_dpto);

	cargarValoresMobile(clave_dpto,selected_dpto);
	$(".consol-dep").css("display","block");
	$(".consol-cap").css("display","block");
}

/*function countMobile($element, total_sufragantes){
	var valActual = parseInt($element.html(), 10);//60
	var valData=$element.attr('data-count');
	valActual = valActual + 1; 
	// porc 
	total_sufragantes=parseInt(total_sufragantes);
	$element.html(++valActual);
	if(valActual > valData){//Se detiene
		$element.html(valData);
	} else {//Sigue
		setTimeout(function(){
			porc=Math.round(((valActual*100)/total_sufragantes));
			$element.css("width", porc+"%");
			countMobile($element, total_sufragantes);
		}, 50);
	}
}*/

function countMobile($element, orientacion, simasno){
	var valActual = parseInt($element.html(), 10);
	var valData=$element.attr('data-count');
	if (valActual!=0) {
		if(valActual < valData){
			valActual = valActual + 1; 
			$element.html(valActual);
			setTimeout(function(){
				countMobile($element, orientacion, simasno);
			}, 10);
		}
	} else{
		$element.html($element.attr('data-count'));
	}
	porc=Math.round(((valData*100)/simasno));
	if(orientacion=="w") {
		$element.css("width", porc+"%");
	}
}

function create_select(){
	$.getJSON("js-vector/data.json", timeMobile, function(data){ 
		var sel = $('<select id="dpto" onchange="ShowSelected();">').appendTo('.consolidados .listado');
			sel.append($("<option id='Seleccione'>").attr('value',"0").text("Seleccione un Departamento"));
		$.each( data, function( key, val ){
			sel.append($("<option id='"+key+"'>").attr({'value':key}).text(val.data[0][0]));
			$("#"+clave_dpto).attr({'data-departamento':selected_dpto,});
     	});
	});
	$(".consol-dep").css("display","block");
	$(".consol-cap").css("display","block");

}

function cargarValoresNacionalMobile(){
	var tsMobile = new Date().getTime();
	var timeMobile = {_: tsMobile};
	$.getJSON("js-vector/data-nac.json?", timeMobile, function(data_nac){ // consolidado nacional
		var items_nac = [];
     	$.each(data_nac, function( key_nac, val_nac ){
     		//console.log(val_nac.si[0]);
		    clave_nac=items_nac.push(key_nac);
		    valor_nac=items_nac.push(val_nac);
			$(".nac-bol").html("Boletin: <span class='resul-nac'>"+val_nac.data[1][0]+"</span>");
			$(".nac-hora").html("Hora: <span class='resul-nac'>"+val_nac.data[2]+"</span>");
			$(".nac-fecha").html("Fecha de Actualizacion: <span class='resul-nac'>"+val_nac.data[3]+"</span>");
			mesas_1=val_nac.data[4].split("de");
			simasno=parseInt(val_nac.si[0])+parseInt(val_nac.no[0]);
			val1=parseInt(mesas_1[0]);
			val2=parseInt(mesas_1[1]);
			porc=Math.round(((val1*100)/val2));	
			$(".nac-mesas").html("Mesas informadas: <span class='resul-nac'>"+porc+"%</span>");
			$(".nac-votos").html("Votos contados: <span class='resul-nac'>"+val_nac.data[5]+"</span>");
			$(".nac-nulos").html("Votos no validos: <span class='resul-nac'>"+val_nac.data[6][0]+"</span>");
			$(".nac-marcados").html("Votos no marcados: <span class='resul-nac'>"+val_nac.data[7][0]+"</span>");
	    	$(".nac-votos-si").attr("data-count", val_nac.si[0]);
	    	total_sufragantes=val_nac.data[5].split("de");
			total_sufragantes=total_sufragantes[1];
	    	element=$(".nac-votos-si");
	    	countMobile(element,"w", simasno);
			$(".nac-votos-no").attr("data-count", val_nac.no[0]);
			element=$(".nac-votos-no");
	    	countMobile(element,"w", simasno);
	    	if(simasno>=4378118){
	    		$(".res_umbral").text("Si alcanzado");
	    		$(".res_umbral").addClass("Si alcanzado");
	    	}else if(simasno<=4378118){
	    		$(".res_umbral").addClass("si_alcanzado");
	    		$(".res_umbral").addClass("no_alcanzado");
	    	}
		});
	});
}

function cargarValoresMobile(key,indi){
	if (key=="" || key==undefined) {
		key="CO-ATL";
	};
	if (key!=key_temp) {
		$(".dept-votos-si").removeClass("mostrar");
		$(".dept-votos-no").removeClass("mostrar");
		$(".capt-votos-si").removeClass("mostrar");
		$(".capt-votos-no").removeClass("mostrar");
	};
	key_temp=key;
	var tsMobile = new Date().getTime();
	var timeMobile = {_: tsMobile};
	$.getJSON("js-vector/data.json", timeMobile, function(datos){ // consolidado Departamental
		   	$(".dept-Depto").html("Departamento: <span class='resul-depto'>"+datos[key].data[0][0]+"</span>");
		   	mesas=datos[key].data[4].split("de");
			val1=parseInt(mesas[0]);
			val2=parseInt(mesas[1]);
			porc=Math.round(((val1*100)/val2));	
			$(".dept-mesas").html("Mesas informadas: <span class='resul-depto'>"+porc+"%</span>");
			$(".dept-votos-si."+key).attr("data-count", datos[key].si[0]);
			simasno=parseInt(datos[key].si[0])+parseInt(datos[key].no[0]);
	    	total_sufragantes=datos[key].data[5].split("de");
			total_sufragantes=total_sufragantes[1];
	    	element=$(".dept-votos-si."+key).addClass("mostrar");
	    	countMobile(element,"w", simasno);
			$(".dept-votos-no."+key).attr("data-count", datos[key].no[0]);
			element=$(".dept-votos-no."+key).addClass("mostrar");
	    	countMobile(element,"w", simasno);
		
	});
/*-------------------------------consolidado por capitales-----------------------------------------*/
	var tsMobile = new Date().getTime();
	var timeMobile = {_: tsMobile};
	$.getJSON("js-vector/data-cap.json", timeMobile, function(datos_capitalMobile){ 
		if(indi=="CUNDINAMARCA" || indi=="BOGOTA D.C."){
			$(".capitales").css("display","none");
		}
		if(indi=="" || indi==undefined){indi="ATLANTICO";}
		if(indi!="CUNDINAMARCA"){
			$(".capitales").css("display","block");
			$(".capt-capt").html("Ciudad:<span class='result-capt'>"+datos_capitalMobile[indi].data[0][0]+"</span>");
			mesas2=datos_capitalMobile[indi].data[4].split("de");
			val1=parseInt(mesas2[0]);
			val2=parseInt(mesas2[1]);
			porc=Math.round(((val1*100)/val2));
			$(".capt-mesas").html("Mesas informadas:<span class='result-capt'>"+porc+"%</span>");

			var indi2=indi.replace(' ','_');
			indi2=indi2.replace(' ','_');
			$(".capt-votos-si."+indi2).attr("data-count", datos_capitalMobile[indi].si[0]);
			simasno=parseInt(datos_capitalMobile[indi].si[0])+parseInt(datos_capitalMobile[indi].no[0]);
			total_sufragantes=datos_capitalMobile[indi].data[5].split("de");
			total_sufragantes=total_sufragantes[1];
	    	element=$(".capt-votos-si."+indi2).addClass("mostrar");
	    	countMobile(element,"w", simasno);
			$(".capt-votos-no."+indi2).attr("data-count", datos_capitalMobile[indi].no[0]);
			element=$(".capt-votos-no."+indi2).addClass("mostrar");
	    	countMobile(element,"w", simasno);
    	}
	});
}