<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="assets/jquery-1.8.2.js"></script>
  <script src="js-vector/logica-mobile.js"></script>
  <style>
	  @import 'https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800';
	  body{margin: 0;font-family: 'Open Sans', sans-serif;}
    	label.dept-votos-no,.nac-votos-no,.capt-votos-no {
    color: red;
    }
    div.dept-votos-si,.nac-votos-si,.capt-votos-si {
    color: #000;
    transition:1s ease;
    }
    div.dept-votos-no,.nac-votos-no,.capt-votos-no {
    color: #FFF;
    transition:1s ease;
    }
    label {display: block;}
    .si,.no{
      color:black;
    }
    .consol-dep,.consol-cap{
    	display: none;
    }
    .dept-votos-si div{display: none; background: #dcdcdc;transition:1s ease;}
    .dept-votos-no div{display: none; background: #dcdcdc;transition:1s ease;}
    .capt-votos-no div{display: none; background: #dcdcdc;transition:1s ease;}
    .capt-votos-si div{display: none; background: #dcdcdc;transition:1s ease;}
    div.mostrar{display: block !important;}
	  
	  
	.content-barra {height: 36px;width: 100%;}
	.label {
		width: 12vw;
		height: 36px;
		display: flex;
		justify-content: center;
		align-content: center;
		flex-direction: column;
		text-align: center;
		background: #e5e1e1;
		float: left;
		font-size: 18px;
		font-weight: 800;
	}
	.label-si {margin: 0 0 0 5vw;}
	.label-no {margin: 0 5vw 0 0;}
	.barra {width: 66vw;height: 36px;margin: 0 auto; float:left;position: relative;background: #e5e1e1;}
	.barra div{height: 36px; float: left;font-size: 14px;line-height: 36px;background: #e2da47 !important;padding: 0 10px;box-sizing: border-box;}
	.barra div:last-child, .barra div.dept-votos-no, .barra div.capt-votos-no{float: right;text-align: right;background: #2f86a8 !important;}
    .barra div.dept-votos-no,.barra div.dept-votos-si, .barra div.capt-votos-si, .barra div.capt-votos-no{display:none;}
	.consolidados h2{margin: 0;font-size: 16px; font-weight: 600;text-align: center;margin: 5vw; 0;}
	.consolidados .consol-nac > h3 {display: inline-block;margin: 0 0 5vw 5vw;font-size: 14px;font-weight: 400;text-transform: uppercase;}
	.consolidados .consol-nac > div{float: left; width: 100%;}
	.consolidados .consol-nac > div h4.text_umbral {
		display: inline-block;
		margin: 5vw 0 5vw 5vw;
		font-size: 14px;
		font-weight: 400;
		text-transform: uppercase;
	}
	.consolidados .consol-nac aside, .consolidados .consol-dep .estadistica {float: left;margin: 0 5vw 5vw;padding: 5vw 0;border: 1px solid #ccc;border-width: 1px 0;}
	.consolidados .consol-nac aside label, .consolidados .consol-dep .estadistica label {font-size: 11px; font-weight: 300; color: #999999;float: left;height: 60px;text-align: center;}
	.consolidados .consol-nac aside label span, .consolidados .consol-dep .estadistica label span {font-size: 21px; font-weight: 700; color: #003147}
	  .consolidados .consol-nac aside label.nac-bol, .consolidados .consol-nac aside label.nac-hora {width: 30%;}
	  .consolidados .consol-nac aside label.nac-mesas, .consolidados .consol-nac aside label.nac-nulos {width: 40%;}
	  .consolidados .consol-nac aside label.nac-fecha, .consolidados .consol-nac aside label.nac-marcados {display: none;}
	  .consolidados .consol-nac aside label.nac-votos {width: 60%;}
	.consolidados .btn-desplegar {float: left;width: 100%;padding: 0 0 5vw;text-align: center;}
	.consolidados .btn-desplegar span {font-size: 13px;font-weight: 300;color: #535e66;width: 100%;display: inline-block;}
	.consolidados .btn-desplegar button {width: 50px;height: 50px; border-radius: 50%; border: 1px solid #c1c1c1;background: transparent; margin: 3vw 0;}

  </style>


<div class="consolidados">
    <h2>Resultados en vivo</h2>
	<div class="consol-nac">
    <h3>Consolidado Nacional</h3>
		<div class="content-barra">
			<label class="label label-si">SI</label>
			<div class="barra">
				<div class="nac-votos-si">0</div>      
				<div class="nac-votos-no">0</div>
			</div>
			<label class="label label-no">NO</label>
		</div>

        <div>
            <h4 class="text_umbral">Umbral de aprobaci&oacute;n&nbsp;</h4><span class="res_umbral"></span>
            <span class="nac-umbral" style="background: #E95B5B;"></span>
        </div>
	    <aside>
            <label class="nac-bol">Boletin</label>
            <label class="nac-hora">Hora de Actualizacion</label>
            <label class="nac-fecha">Fecha de Actualizacion</label>
            <label class="nac-mesas">Mesas informadas de las Instalas</label>
            <label class="nac-votos">Votos contados del potencial de sufragantes</label>
            <label class="nac-nulos">Votos nulos</label>
            <label class="nac-marcados">Votos no marcados</label>
        </aside>
		
	</div>

    <div class="listado"></div>  

	<div class="consol-dep"> 
        <h3>Consolidado Departamental</h3> 
		<div class="estadistica">
            <label class="dept-Depto">Departamento</label>
            <label class="dept-mesas">Mesas informadas de las Instalas</label>
        </div>
		<div class="content-barra">
			<label class="label label-si">SI</label>
        	
			<div class="barra">
            <!--SI-->    
             
				<div class="dept-votos-si CO-ANT">0</div>
				<div class="dept-votos-si CO-ATL">0</div>
				<div class="dept-votos-si CO-BOL">0</div>
				<div class="dept-votos-si CO-BOY">0</div>
				<div class="dept-votos-si CO-CAL">0</div>
				<div class="dept-votos-si CO-CAU">0</div>
				<div class="dept-votos-si CO-CES">0</div>
				<div class="dept-votos-si CO-COR">0</div>
				<div class="dept-votos-si CO-CUN">0</div>
				<div class="dept-votos-si CO-DC">0</div>
				<div class="dept-votos-si CO-CHO">0</div>
				<div class="dept-votos-si CO-HUI">0</div>
				<div class="dept-votos-si CO-MAG">0</div>
				<div class="dept-votos-si CO-NAR">0</div>
				<div class="dept-votos-si CO-RIS">0</div>
				<div class="dept-votos-si CO-NSA">0</div>
				<div class="dept-votos-si CO-QUI">0</div>
				<div class="dept-votos-si CO-SAN">0</div>
				<div class="dept-votos-si CO-SUC">0</div>
				<div class="dept-votos-si CO-TOL">0</div>
				<div class="dept-votos-si CO-VAC">0</div>
				<div class="dept-votos-si CO-ARA">0</div>
				<div class="dept-votos-si CO-CAQ">0</div>
				<div class="dept-votos-si CO-CAS">0</div>
				<div class="dept-votos-si CO-LAG">0</div>
				<div class="dept-votos-si CO-GUA">0</div>
				<div class="dept-votos-si CO-MET">0</div>
				<div class="dept-votos-si CO-GUV">0</div>
				<div class="dept-votos-si CO-SAP">0</div>
				<div class="dept-votos-si CO-AMA">0</div>
				<div class="dept-votos-si CO-PUT">0</div>
				<div class="dept-votos-si CO-VAU">0</div>
				<div class="dept-votos-si CO-VID">0</div>
           
				<!--NO-->
       
					<div class="dept-votos-no CO-ANT">0</div>
					<div class="dept-votos-no CO-ATL">0</div>
					<div class="dept-votos-no CO-BOL">0</div>
					<div class="dept-votos-no CO-BOY">0</div>
					<div class="dept-votos-no CO-CAL">0</div>
					<div class="dept-votos-no CO-CAU">0</div>
					<div class="dept-votos-no CO-CES">0</div>
					<div class="dept-votos-no CO-COR">0</div>
					<div class="dept-votos-no CO-CUN">0</div>
					<div class="dept-votos-no CO-DC">0</div>
					<div class="dept-votos-no CO-CHO">0</div>
					<div class="dept-votos-no CO-HUI">0</div>
					<div class="dept-votos-no CO-MAG">0</div>
					<div class="dept-votos-no CO-NAR">0</div>
					<div class="dept-votos-no CO-RIS">0</div>
					<div class="dept-votos-no CO-NSA">0</div>
					<div class="dept-votos-no CO-QUI">0</div>
					<div class="dept-votos-no CO-SAN">0</div>
					<div class="dept-votos-no CO-SUC">0</div>
					<div class="dept-votos-no CO-TOL">0</div>
					<div class="dept-votos-no CO-VAC">0</div>
					<div class="dept-votos-no CO-ARA">0</div>
					<div class="dept-votos-no CO-CAQ">0</div>
					<div class="dept-votos-no CO-CAS">0</div>
					<div class="dept-votos-no CO-LAG">0</div>
					<div class="dept-votos-no CO-GUA">0</div>
					<div class="dept-votos-no CO-MET">0</div>
					<div class="dept-votos-no CO-GUV">0</div>
					<div class="dept-votos-no CO-SAP">0</div>
					<div class="dept-votos-no CO-AMA">0</div>
					<div class="dept-votos-no CO-PUT">0</div>
					<div class="dept-votos-no CO-VAU">0</div>
					<div class="dept-votos-no CO-VID">0</div>
             
			</div>  
			<label class="label label-no">NO</label>	
			
			
		</div>
		
        
	</div>

	<div class="consol-cap">
        <div class="estadistica">
            <label class="capt-capt">Capital</label>
            <label class="capt-mesas">Mesas informadas de las Instalas</label>
        </div>
        <div class="content-barra">
            <label class="label label-si">SI</label>

            <div class="barra">
                <!--SI capitales-->              
                    <div class='capt-votos-si ANTIOQUIA'>0</div>
                    <div class='capt-votos-si ATLANTICO'>0</div>
                    <div class='capt-votos-si BOLIVAR'>0</div>
                    <div class='capt-votos-si BOYACA'>0</div>
                    <div class='capt-votos-si CALDAS'>0</div>
                    <div class='capt-votos-si CAUCA'>0</div>
                    <div class='capt-votos-si CESAR'>0</div>
                    <div class='capt-votos-si CORDOBA'>0</div>
                    <div class='capt-votos-si BOGOTA_D.C.'>0</div>
                    <div class='capt-votos-si CHOCO'>0</div>
                    <div class='capt-votos-si HUILA'>0</div>
                    <div class='capt-votos-si MAGDALENA'>0</div>
                    <div class='capt-votos-si NARIÑO'>0</div>
                    <div class='capt-votos-si RISARALDA'>0</div>
                    <div class='capt-votos-si NORTE_DE_SAN'>0</div>
                    <div class='capt-votos-si QUINDIO'>0</div>
                    <div class='capt-votos-si SANTANDER'>0</div>
                    <div class='capt-votos-si SUCRE'>0</div>
                    <div class='capt-votos-si TOLIMA'>0</div>
                    <div class='capt-votos-si VALLE'>0</div>
                    <div class='capt-votos-si ARAUCA'>0</div>
                    <div class='capt-votos-si CAQUETA'>0</div>
                    <div class='capt-votos-si CASANARE'>0</div>
                    <div class='capt-votos-si LA_GUAJIRA'>0</div>
                    <div class='capt-votos-si GUAINIA'>0</div>
                    <div class='capt-votos-si META'>0</div>
                    <div class='capt-votos-si GUAVIARE'>0</div>
                    <div class='capt-votos-si SAN_ANDRES'>0</div>
                    <div class='capt-votos-si AMAZONAS'>0</div>
                    <div class='capt-votos-si PUTUMAYO'>0</div>
                    <div class='capt-votos-si VAUPES'>0</div>
                    <div class='capt-votos-si VICHADA'>0</div>
               
                <!--NO capitales-->
                    <div class='capt-votos-no ANTIOQUIA'>0</div>
                    <div class='capt-votos-no ATLANTICO'>0</div>
                    <div class='capt-votos-no BOLIVAR'>0</div>
                    <div class='capt-votos-no BOYACA'>0</div>
                    <div class='capt-votos-no CALDAS'>0</div>
                    <div class='capt-votos-no CAUCA'>0</div>
                    <div class='capt-votos-no CESAR'>0</div>
                    <div class='capt-votos-no CORDOBA'>0</div>
                    <div class='capt-votos-no BOGOTA_D.C.'>0</div>
                    <div class='capt-votos-no CHOCO'>0</div>
                    <div class='capt-votos-no HUILA'>0</div>
                    <div class='capt-votos-no MAGDALENA'>0</div>
                    <div class='capt-votos-no NARIÑO'>0</div>
                    <div class='capt-votos-no RISARALDA'>0</div>
                    <div class='capt-votos-no NORTE_DE_SAN'>0</div>
                    <div class='capt-votos-no QUINDIO'>0</div>
                    <div class='capt-votos-no SANTANDER'>0</div>
                    <div class='capt-votos-no SUCRE'>0</div>
                    <div class='capt-votos-no TOLIMA'>0</div>
                    <div class='capt-votos-no VALLE'>0</div>
                    <div class='capt-votos-no ARAUCA'>0</div>
                    <div class='capt-votos-no CAQUETA'>0</div>
                    <div class='capt-votos-no CASANARE'>0</div>
                    <div class='capt-votos-no LA_GUAJIRA'>0</div>
                    <div class='capt-votos-no GUAINIA'>0</div>
                    <div class='capt-votos-no META'>0</div>
                    <div class='capt-votos-no GUAVIARE'>0</div>
                    <div class='capt-votos-no SAN_ANDRES'>0</div>
                    <div class='capt-votos-no AMAZONAS'>0</div>
                    <div class='capt-votos-no PUTUMAYO'>0</div>
                    <div class='capt-votos-no VAUPES'>0</div>
                    <div class='capt-votos-no VICHADA'>0</div>
                   
                
            </div>
            <label class="label label-no">NO</label>
        </div>
       
	</div>

</div>
