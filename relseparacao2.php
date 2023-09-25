<?php 
//include("mpdf60/mpdf.php");
require_once __DIR__ . '/vendor/autoload.php';
$contador = 1;

function geraCodigoBarra($numero){
    $fino = 1;
    $largo = 3;
    $altura = 30;
    
    $barcodes[0] = '00110';
    $barcodes[1] = '10001';
    $barcodes[2] = '01001';
    $barcodes[3] = '11000';
    $barcodes[4] = '00101';
    $barcodes[5] = '10100';
    $barcodes[6] = '01100';
    $barcodes[7] = '00011';
    $barcodes[8] = '10010';
    $barcodes[9] = '01010';
    
    for($f1 = 9; $f1 >= 0; $f1--){
        for($f2 = 9; $f2 >= 0; $f2--){
            $f = ($f1*10)+$f2;
            $texto = '';
            for($i = 1; $i < 6; $i++){
                $texto .= substr($barcodes[$f1], ($i-1), 1).substr($barcodes[$f2] ,($i-1), 1);
            }
            $barcodes[$f] = $texto;
        }
    }
    
    $impressao =  '<img src="imagens/p.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
    $impressao .= '<img src="imagens/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
    $impressao .= '<img src="imagens/p.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
    $impressao .= '<img src="imagens/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
    
    $impressao .= '<img ';
    
    $texto = $numero;
    
    if((strlen($texto) % 2) <> 0){
        $texto = '0'.$texto;
    }
    
    while(strlen($texto) > 0){
        $i = round(substr($texto, 0, 2));
        $texto = substr($texto, strlen($texto)-(strlen($texto)-2), (strlen($texto)-2));
        
        if(isset($barcodes[$i])){
            $f = $barcodes[$i];
        }
        
        for($i = 1; $i < 11; $i+=2){
            if(substr($f, ($i-1), 1) == '0'){
                  $f1 = $fino ;
              }else{
                  $f1 = $largo ;
              }
              
              $impressao .= 'src="imagens/p.gif" width="'.$f1.'" height="'.$altura.'" border="0">';
              $impressao .= '<img ';
              
              if(substr($f, $i, 1) == '0'){
                $f2 = $fino ;
            }else{
                $f2 = $largo ;
            }
            
            $impressao .= 'src="imagens/b.gif" width="'.$f2.'" height="'.$altura.'" border="0">';
            $impressao .= '<img ';
        }
    }
    $impressao .= 'src="imagens/p.gif" width="'.$largo.'" height="'.$altura.'" border="0" />';
    $impressao .= '<img src="imagens/b.gif" width="'.$fino.'" height="'.$altura.'" border="0" />';
    $impressao .= '<img src="imagens/p.gif" width="1" height="'.$altura.'" border="0" />';
    
    return $impressao;
}

session_start();
    require "verifica.php"; 
    require "bd.php"; 
	unset($_SESSION['pedcdqtdped']);
	session_destroy($_SESSION['pedcdqtdped']);
	
    $nrcarga = $_GET[valor];
	
	$usuario = $_SESSION['pedcdusuario'];
    $nrol = 1;


    $sqlo = "select a.nrocarga,b.descsetor,a.seqproduto,c.desccompleta,sum(a.qtde) QTDE,d.embalagem QTDEMB,a.embalagem, 'R'||''||e.codrua||'-'||e.nropredio||'.'||e.nroapartamento||'.'||e.nrosala ENDERECO,e.codrua,e.nropredio,e.nroapartamento,e.nrosala,f.codacesso from consinco.imp_pedcd_cargareq a, consinco.imp_pedcd_setores b, consinco.map_produto c, consinco.map_famembalagem d, consinco.mlo_endereco e, consinco.imp_vprodcodpedcd f where e.nroempresa = 990 and a.nrocarga = ".$nrcarga." and a.seqproduto = f.seqproduto(+)  and a.seqsetor = b.seqsetor and a.seqproduto = c.seqproduto and c.seqfamilia = d.seqfamilia and a.embalagem = d.qtdembalagem and a.seqproduto = e.seqproduto(+) and e.especieendereco = 'A'group by a.nrocarga,b.descsetor,a.seqproduto,c.desccompleta,d.embalagem,a.embalagem, 'R'||''||e.codrua||'-'||e.nropredio||'.'||e.nroapartamento||'.'||e.nrosala,e.codrua,e.nropredio,e.nroapartamento,e.nrosala,f.codacesso order by b.descsetor, e.codrua,e.nropredio,e.nroapartamento,e.nrosala";
    //echo $sqlo;
	$orareq1=oci_parse($conn,$sqlo);
    oci_execute($orareq1);
    $setor = 1;


    echo $html1 = " 
    <table border='1' frame='void' id='agendinserte'>
    <tr>
    <th colspan='7'>CARGA: $nrcarga</th>
    </tr>
    ";
    $auxseqendpad = 0;
    $html = $html1;

    while ($r1 = oci_fetch_array($orareq1, OCI_ASSOC+OCI_RETURN_NULLS)) {			
        $descsetor = $r1['DESCSETOR'];
        $seqproduto = $r1['SEQPRODUTO'];
        $descproduto = $r1['DESCCOMPLETA'];
        $qtdpedida = $r1['QTDE'];
        $qtdembprod = $r1['QTDEMB'];
        $embprod = $r1['EMBALAGEM'];
        $end = $r1['ENDERECO'];
        $codacesso = $r1['CODACESSO'];
        if ($descsetor == "CENTRAL PRODUCAO PADARIA") {
            $sqlo2 = "select gg.seqendereco from consinco.mlo_endereco gg where gg.nroempresa = 990 and gg.codrua = '500' and gg.especieendereco = 'B' and gg.seqproduto = ".$seqproduto."";
        }
        else {
            $sqlo2 = "select gg.seqendereco from consinco.mlo_endereco gg where gg.nroempresa = 990 and gg.codrua = '500' and gg.especieendereco = 'D' and gg.seqproduto = ".$seqproduto."";
        }
        $orareq2=oci_parse($conn,$sqlo2);
		//echo $sqlo2;
        oci_execute($orareq2);
        $seqendpad = 0;
        while ($r2 = oci_fetch_array($orareq2, OCI_ASSOC+OCI_RETURN_NULLS)) {
            $seqendpad = $r2['SEQENDERECO'];
        }
        
        if ($descsetor == "CENTRAL PRODUCAO PADARIA") {
            if ($seqendpad == 0){
                $sqlo5 = "call consinco.imp_reservaendpad(".$seqproduto.")";
                $orareq5=oci_parse($conn,$sqlo5);
                $r5 =    oci_execute($orareq5);
                if ($r5 == 1){
                    $sqlo3 = "select a.seqendereco from consinco.imp_pedcd_respad a where a.seqproduto =".$seqproduto."";
                    $orareq3=oci_parse($conn,$sqlo3);
                    oci_execute($orareq3);
                    while ($r3 = oci_fetch_array($orareq3, OCI_ASSOC+OCI_RETURN_NULLS)) {
                    $seqendpad = $r3['SEQENDERECO'];
                    }
                    if ($auxseqendpad == 0) {
                    $auxseqendpad = $seqendpad;
                    }
                    else {
                    $auxseqendpad = $auxseqendpad . "," . $seqendpad;
                    }
                }
                else {
                    echo '<script type="text/JavaScript">alert( "Ocorreu algum erro na Geração da Separacao. Tente novamente. Em caso de erro, Contate a TI!" );location.href="rrelseparacao.php';
                }
            }
            else {
            
                if ($auxseqendpad == 0) {
                    $auxseqendpad = $seqendpad;
                }
                else {
                    $auxseqendpad = $auxseqendpad . "," . $seqendpad;
                }
            }
        }
        else {
            if ($seqendpad == 0){
                $sqlo5 = "call consinco.imp_reservaendout(".$seqproduto.")";
                $orareq5=oci_parse($conn,$sqlo5);
                $r5 =    oci_execute($orareq5);
                if ($r5 == 1){
                    $sqlo3 = "select a.seqendereco from consinco.imp_pedcd_resout a where a.seqproduto =".$seqproduto."";
                    $orareq3=oci_parse($conn,$sqlo3);
                    oci_execute($orareq3);
                    while ($r3 = oci_fetch_array($orareq3, OCI_ASSOC+OCI_RETURN_NULLS)) {
                    $seqendpad = $r3['SEQENDERECO'];
                    }
                    if ($auxseqendpad == 0) {
                    $auxseqendpad = $seqendpad;
                    }
                    else {
                    $auxseqendpad = $auxseqendpad . "," . $seqendpad;
                    }
                }
                else {
                    echo '<script type="text/JavaScript">alert( "Ocorreu algum erro na Geração da Separacao. Tente novamente. Em caso de erro, Contate a TI!" );location.href="rrelseparacao.php';
                }
            }
            else {
            
                if ($auxseqendpad == 0) {
                    $auxseqendpad = $seqendpad;
                }
                else {
                    $auxseqendpad = $auxseqendpad . "," . $seqendpad;
                }
            }
        }
        
        if ($setor == $descsetor){
            $vv = "
            <tr>
            <td> $seqproduto </td>
            <td id='descesquerda'> $descproduto </td>
            <td> $qtdpedida</td>
            <td> $qtdembprod </td>
            <td> $embprod </td>
            <td id='seqend'> $end <br>".geraCodigoBarra($seqendpad)."<br>$seqendpad</td>
            <td id='codacesso'>$codacesso</td>
            </tr>
            ";
            $setor = $descsetor;
        }
        else {
            $vv = "
            <tr>
            <th colspan='7'>$descsetor</th>
            </tr>
            <tr>
            <th> SEQ_PRODUTO </th>
            <th id='descdoprod'> DESC_PRODUTO </th>
            <th> QTDE_PEDIDA </th>
            <th> EMB </th>
            <th> QTDE </th>
            <th> ENDERECO </th>
            <th> COD_ACESSO </th>
            </tr>
            <tr>
            <td> $seqproduto </td>
            <td id='descesquerda'> $descproduto </td>
            <td> $qtdpedida </td>
            <td> $qtdembprod </td>
            <td> $embprod </td>
            <td id='seqend'> $end <br>".geraCodigoBarra($seqendpad)."<br>$seqendpad</td>
            <td id='codacesso'>$codacesso</td>
            </tr>
            ";
            $setor = $descsetor;
        }
        $contador++;
        $html = $html . $vv;
        //echo "TTTTTTTTTT<br>";
        //echo $html;
		$vv = "$"."html".$contador;
    }

 $html4000 = "</table>";
 
 $html = $html . $html4000;
 
 //$mpdf=new mPDF(); 
 //$mpdf->SetDisplayMode('fullpage');
 //$css = file_get_contents("_css/estilos.css");
 //$mpdf->WriteHTML($css,1);
 //$mpdf->WriteHTML($html);
 //$mpdf->Output();

//echo $html;
$mpdf = new \Mpdf\Mpdf(['tempDir' => __DIR__ . '/custom/temp/dir/path']);
$mpdf->SetDisplayMode('fullpage');
$css = file_get_contents("_css/estilos.css");
$mpdf->WriteHTML($css,1);
$mpdf->WriteHTML($html);
$mpdf->Output();

 exit;				