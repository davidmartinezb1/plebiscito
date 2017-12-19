<meta charset="utf-8">
  <script src="assets/jquery-1.8.2.js"></script>
  <script src="js-vector/logica-mobile.js"></script>
  <style>
        label.dept-votos-no,.nac-votos-no,.capt-votos-no {
    color: red;
    }
    label.dept-votos-si,.nac-votos-si,.capt-votos-si {
    color: blue;
    }
    label {display: block;}
    .si,.no{
      color:black;
    }
    .consol-dep,.consol-cap{
        display: none;
    }
    .dept-votos-si div{display: none; background: #dcdcdc;}
    .dept-votos-no div{display: none; background: #dcdcdc;}
    .capt-votos-no div{display: none; background: #dcdcdc;}
    .capt-votos-si div{display: none; background: #dcdcdc;}
    div.mostrar{display: block;}

  </style>


<div class="consolidados">
    <h2>Resultados en vivo</h2>
    <div class="consol-nac">
    <h3>Consolidado Nacional</h3>
        <div class="barra">
            <label>SI</label>
            <div class="nac-votos-si" style="background: #4BB1F2;">0</div>      
            <div class="nac-votos-no" style="background: #E95B5B;">0</div>
            <label>NO</label>
        </div>

        <div>
            <h4 class="text_umbral">Umbral de aprobacion</h4>
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
        <div class="barra">
            <!--SI-->         
            <div class="dept-votos-si">
                <label>SI</label>
                <div class="CO-ANT">0</div>
                <div class="CO-ATL">0</div>
                <div class="CO-BOL">0</div>
                <div class="CO-BOY">0</div>
                <div class="CO-CAL">0</div>
                <div class="CO-CAU">0</div>
                <div class="CO-CES">0</div>
                <div class="CO-COR">0</div>
                <div class="CO-CUN">0</div>
                <div class="CO-DC">0</div>
                <div class="CO-CHO">0</div>
                <div class="CO-HUI">0</div>
                <div class="CO-MAG">0</div>
                <div class="CO-NAR">0</div>
                <div class="CO-RIS">0</div>
                <div class="CO-NSA">0</div>
                <div class="CO-QUI">0</div>
                <div class="CO-SAN">0</div>
                <div class="CO-SUC">0</div>
                <div class="CO-TOL">0</div>
                <div class="CO-VAC">0</div>
                <div class="CO-ARA">0</div>
                <div class="CO-CAQ">0</div>
                <div class="CO-CAS">0</div>
                <div class="CO-LAG">0</div>
                <div class="CO-GUA">0</div>
                <div class="CO-MET">0</div>
                <div class="CO-GUV">0</div>
                <div class="CO-SAP">0</div>
                <div class="CO-AMA">0</div>
                <div class="CO-PUT">0</div>
                <div class="CO-VAU">0</div>
                <div class="CO-VID">0</div>
            </div>
            <!--NO-->
            <div class="dept-votos-no">           
                <div class="CO-ANT">0</div>
                <div class="CO-ATL">0</div>
                <div class="CO-BOL">0</div>
                <div class="CO-BOY">0</div>
                <div class="CO-CAL">0</div>
                <div class="CO-CAU">0</div>
                <div class="CO-CES">0</div>
                <div class="CO-COR">0</div>
                <div class="CO-CUN">0</div>
                <div class="CO-DC">0</div>
                <div class="CO-CHO">0</div>
                <div class="CO-HUI">0</div>
                <div class="CO-MAG">0</div>
                <div class="CO-NAR">0</div>
                <div class="CO-RIS">0</div>
                <div class="CO-NSA">0</div>
                <div class="CO-QUI">0</div>
                <div class="CO-SAN">0</div>
                <div class="CO-SUC">0</div>
                <div class="CO-TOL">0</div>
                <div class="CO-VAC">0</div>
                <div class="CO-ARA">0</div>
                <div class="CO-CAQ">0</div>
                <div class="CO-CAS">0</div>
                <div class="CO-LAG">0</div>
                <div class="CO-GUA">0</div>
                <div class="CO-MET">0</div>
                <div class="CO-GUV">0</div>
                <div class="CO-SAP">0</div>
                <div class="CO-AMA">0</div>
                <div class="CO-PUT">0</div>
                <div class="CO-VAU">0</div>
                <div class="CO-VID">0</div>
                <label>NO</label>
            </div>
        </div>   
        <div class="estadistica">
            <label class="dept-Depto">Departamento</label>
            <label class="dept-bol">Boletin</label>
            <label class="dept-hora">Hora de Actualizacion</label>
            <label class="dept-fecha">Fecha de Actualizacion</label>
            <label class="dept-mesas">Mesas informadas de las Instalas</label>
            <label class="dept-votos">Votos contados del potencial de sufragantes</label>
            <label class="dept-nulos">Votos nulos</label>
            <label class="dept-marcados">Votos no marcados</label>
        </div>
    </div>

    <div class="consol-cap">
        <h3>Consolidado Por capitales</h3>
        <div class="barra">
            <!--SI capitales-->
            <div class="capt-votos-si">
                <label>SI</label>
                <div class='ANTIOQUIA'>0</div>
                <div class='ATLANTICO'>0</div>
                <div class='BOLIVAR'>0</div>
                <div class='BOYACA'>0</div>
                <div class='CALDAS'>0</div>
                <div class='CAUCA'>0</div>
                <div class='CESAR'>0</div>
                <div class='CORDOBA'>0</div>
                <div class='BOGOTA_D.C.'>0</div>
                <div class='CHOCO'>0</div>
                <div class='HUILA'>0</div>
                <div class='MAGDALENA'>0</div>
                <div class='NARIÑO'>0</div>
                <div class='RISARALDA'>0</div>
                <div class='NORTE_DE_SAN'>0</div>
                <div class='QUINDIO'>0</div>
                <div class='SANTANDER'>0</div>
                <div class='SUCRE'>0</div>
                <div class='TOLIMA'>0</div>
                <div class='VALLE'>0</div>
                <div class='ARAUCA'>0</div>
                <div class='CAQUETA'>0</div>
                <div class='CASANARE'>0</div>
                <div class='LA_GUAJIRA'>0</div>
                <div class='GUAINIA'>0</div>
                <div class='META'>0</div>
                <div class='GUAVIARE'>0</div>
                <div class='SAN_ANDRES'>0</div>
                <div class='AMAZONAS'>0</div>
                <div class='PUTUMAYO'>0</div>
                <div class='VAUPES'>0</div>
                <div class='VICHADA'>0</div>
            </div>
            <!--NO capitales-->
            <div class="capt-votos-no">
                <div class='ANTIOQUIA'>0</div>
                <div class='ATLANTICO'>0</div>
                <div class='BOLIVAR'>0</div>
                <div class='BOYACA'>0</div>
                <div class='CALDAS'>0</div>
                <div class='CAUCA'>0</div>
                <div class='CESAR'>0</div>
                <div class='CORDOBA'>0</div>
                <div class='BOGOTA_D.C.'>0</div>
                <div class='CHOCO'>0</div>
                <div class='HUILA'>0</div>
                <div class='MAGDALENA'>0</div>
                <div class='NARIÑO'>0</div>
                <div class='RISARALDA'>0</div>
                <div class='NORTE_DE_SAN'>0</div>
                <div class='QUINDIO'>0</div>
                <div class='SANTANDER'>0</div>
                <div class='SUCRE'>0</div>
                <div class='TOLIMA'>0</div>
                <div class='VALLE'>0</div>
                <div class='ARAUCA'>0</div>
                <div class='CAQUETA'>0</div>
                <div class='CASANARE'>0</div>
                <div class='LA_GUAJIRA'>0</div>
                <div class='GUAINIA'>0</div>
                <div class='META'>0</div>
                <div class='GUAVIARE'>0</div>
                <div class='SAN_ANDRES'>0</div>
                <div class='AMAZONAS'>0</div>
                <div class='PUTUMAYO'>0</div>
                <div class='VAUPES'>0</div>
                <div class='VICHADA'>0</div>
                <label>NO</label>
            </div>
        </div>
        <div class="estadistica">
            <label class="capt-capt">Capital</label>
            <label class="capt-bol">Boletin</label>
            <label class="capt-hora">Hora de Actualizacion</label>
            <label class="capt-fecha">Fecha de Actualizacion</label>
            <label class="capt-mesas">Mesas informadas de las Instalas</label>
            <label class="capt-votos">Votos contados del potencial de sufragantes</label>
            <label class="capt-nulos">Votos nulos</label>
            <label class="capt-marcados">Votos no marcados</label>  
        </div>
    </div>

    <div class="btn-desplegar">
        <span>Ver resultados completos</span>
        <button></button>
    </div>

</div>
