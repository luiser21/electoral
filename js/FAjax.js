// JavaScript Document
function creaAjax()
{
	var objetoAjax=false;
	try
	{
		/*Para navegadores distintos a internet explorer*/
		objetoAjax = new ActiveXObject("Msxml2.XMLHTTP");
	} 
	catch (e) 
	{
		try 
		{
		/*Para explorer*/
		objetoAjax = new ActiveXObject("Microsoft.XMLHTTP");
		} 
		catch (E) 
		{
			objetoAjax = false;
		}
	}
	if (!objetoAjax && typeof XMLHttpRequest!='undefined') 
	{
		objetoAjax = new XMLHttpRequest();
	}
	return objetoAjax;
}

function FAjax (url,capa,valores,metodo,flagcontainer)
{
	var ajax=creaAjax();
	var capaContenedora = document.getElementById(capa);
	capaContenedora.innerHTML=''; 
	/*Creamos y ejecutamos la instancia si el metodo elegido es POST*/

	
	if(metodo.toUpperCase()=='POST')
	{
		ajax.open ('POST', url, true);
		ajax.onreadystatechange = function()
		{
			if (ajax.readyState==1)
			{
				//capaContenedora.innerHTML="Cargando.......";
				capaContenedora.innerHTML= '<div align="center"><img src="/etom_web/menu/Etom1/img/ajax_loader.gif"></div>';
				

			}
			else if (ajax.readyState==4)
			{
				if(ajax.status==200)
				{	
					if(flagcontainer){
						document.getElementById(capa).innerHTML =  ajax.responseText;						
					}else{						
						//document.getElementById(capa).value = ajax.responseText; // para cambios objetos						
						document.getElementById(capa).innerHTML =  ajax.responseText;	
						}
					
				}
				else if(ajax.status==404)
				{
					capaContenedora.innerHTML = "Error";
				}
				else
				{
					capaContenedora.innerHTML = "<b>No es posible Ubicar El Recurso Solicitado.</b>: ".ajax.status;
				}
			}
		}
		ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');		
		ajax.send(valores);		
		return ;
	}
	/*Creamos y ejecutamos la instancia si el metodo elegido es GET*/
	if (metodo.toUpperCase()=='GET')
	{
		ajax.open ('GET', url, true);
		ajax.onreadystatechange = function()
		{
			if (ajax.readyState==1)
			{
				capaContenedora.innerHTML= '<div align="center"><img src="/etom_web/menu/Etom1/img/ajax_loader.gif"></div>';
			}
			else if (ajax.readyState==4)
			{
				if(ajax.status==200)
				{ 
					document.getElementById(capa).innerHTML=ajax.responseText; 
				}
				else if(ajax.status==404)
				{
					capaContenedora.innerHTML = "<b>No es posible Ubicar El Recurso Solicitado.</b>";
				}
				else
				{
					capaContenedora.innerHTML = "Error: ".ajax.status;
				}
			}
		}
		ajax.setRequestHeader('Content-Type','application/x-www-form-urlencoded');
		ajax.send(null);
		return
	}
}