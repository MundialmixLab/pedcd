
function delcarga() {
	//alert(document.getElementById('idelreq').checked);
	if (document.getElementById('idelreq').checked == true) {
	document.getElementById('btconf').value = 'CANCELAR';
	}
	else {
		document.getElementById('btconf').value = 'FINALIZAR';
	}
}



function selcarga(valor) {
	
	
	qtdpedidos = document.getElementById('qtped').value;
	qtaux = 1;
	nroreqaux = document.getElementById('v'+valor).value;
	wnroreqaux = document.getElementById('v'+qtaux).value;
	pnroreqaux = document.getElementById('s'+valor).value;
	pwnroreqaux = document.getElementById('s'+qtaux).value;
	vchech = document.getElementById(valor).checked;
	//alert(vchech);
	if (nroreqaux == ""){
		
	}
	else {
		while ( qtaux <= qtdpedidos) {
			
			
				if (vchech == true) {
					if (nroreqaux == wnroreqaux) {
						document.getElementById(qtaux).checked = true;
					}
					else {
						document.getElementById(qtaux).checked = false;
					}
				}
				else {
						if (nroreqaux == wnroreqaux) {
							document.getElementById(qtaux).checked = false;
						}
				}
				
			
			qtaux++;
			wnroreqaux = document.getElementById('v'+qtaux).value;
		}
	}
}