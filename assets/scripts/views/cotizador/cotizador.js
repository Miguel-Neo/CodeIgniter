/************************************************
* Esta función va a tomar los datos ingresados  *
* debtro del cotizador. 						*
*************************************************/

function applyFormatCurrency(sender) {
            $(sender).formatCurrency({
                region: 'es-MX'
                , roundToDecimalPlace: 2
            });
        }
function valores(){
	var tipEmp = document.getElementById('tipoEmpresa').value;
	var catEmp = document.getElementById('categoriaEm').value;
	var tmpEmp = document.getElementById('tiempoEmpre').value;
	var canEmp = document.getElementById('cantidadTmp').value;

	var categoria='';
	var precio = 0;
	var iva = 0;
	var costo = 0;
	var total = 0;
	
	/*******************************************
	* Está siendo contemplado para trabajar la *
	* cotización en cuanto al diseño. 		   *
	********************************************/
		if((catEmp == "diseno") && (tipEmp != "cero") ){
			categoria = 'Diseño';
			if((tmpEmp == "horas") ){	
				precio = 504.31 * parseInt(canEmp);
			}
			if(tmpEmp == "dias"){	
				precio = 4034.48 * parseInt(canEmp);
			}
			if(tmpEmp == "semanas"){	
				precio = 20172.41 * parseInt(canEmp);
			}
			if(tmpEmp == "meses"){	
				precio = 80689.66 * parseInt(canEmp);
			}
			if(tmpEmp == "anos"){	
				precio = 968275.86 * parseInt(canEmp);
		}
		}
	/*******************************************
	* Está siendo contemplado para trabajar la *
	* cotización en cuanto a la Fotografía.    *
	********************************************/
		if((catEmp == "foto") && (tipEmp != "cero") ){
			categoria = 'Fotografía';
			if((tmpEmp == "horas") ){	
				precio = 456.90 * parseInt(canEmp);
			}
			if(tmpEmp == "dias"){	
				precio = 3655.17 * parseInt(canEmp);
			}
			if(tmpEmp == "semanas"){	
				precio = 18275.86 * parseInt(canEmp);
			}
			if(tmpEmp == "meses"){	
				precio = 73103.45 * parseInt(canEmp);
			}
			if(tmpEmp == "anos"){	
				precio = 877241.38 * parseInt(canEmp);
			}
		}
	/*******************************************
	* Está siendo contemplado para trabajar la *
	* cotización en cuanto a la Programación.  *
	********************************************/
		if((catEmp == "progra") && (tipEmp != "cero") ){
			categoria = 'Programación';
			if((tmpEmp == "horas") ){	
				precio = 732.76 * parseInt(canEmp);
			}
			if(tmpEmp == "dias"){	
				precio = 5862.07 * parseInt(canEmp);
			}
			if(tmpEmp == "semanas"){	
				precio = 29310.34 * parseInt(canEmp);
			}
			if(tmpEmp == "meses"){	
				precio = 117241.38 * parseInt(canEmp);
			}
			if(tmpEmp == "anos"){	
				precio = 1406896.55 * parseInt(canEmp);
			}
		}

		iva = (precio*0.16);
		total = precio + iva;
		

		$('#datosGenerales').html('<br><table align="center"><tr> <td>Nombre de Usuario : </td></tr> <tr><td>Tipo de Empresa : </td><td> '+ tipEmp +' </td></tr> <tr><td>Categoria : </td><td> '+categoria+' </td></tr> <tr><td> Tiempo : </td><td>'+canEmp+' '+tmpEmp+' </td></tr></table><br><br>');
		$('#datoCotizacion').html('<table align="center"><tr><td>Precio  : </td><td><input type="text" class="moneda" value="'+precio+'"/></td></tr><tr> <td>IVA  : </td><td><input type="text" class="moneda" value="'+iva+'"/> </td></tr><tr><td>Precio Total : </td><td> <input type="text" class="moneda" value="'+total+'"/> </td></tr></table>');
			
		applyFormatCurrency($('.moneda'));
}