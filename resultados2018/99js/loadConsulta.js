var loadConsulta=function(o,e){(window.sessionStorage.removeItem("eleccion"),window.sessionStorage.removeItem("departamento"),window.sessionStorage.removeItem("municipio"),window.sessionStorage.setItem("eleccion",o),e)?window.location.href.includes("registraduria.gov")?window.location.href="resultados/htmlfijo/consulta.html":window.location.href="generado/resultados/htmlfijo/consulta.html":window.location.href="../../htmlfijo/consulta.html"};