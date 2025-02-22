
            codigo=document.getElementById("codigo");
            nombre=document.getElementById("nombre");
            descripcion=document.getElementById("descripcion");
            imagen=document.getElementById("imagen");
            categoria=document.getElementById("categoria");
            precio=document.getElementById("precio");
            existencias=document.getElementById("existencias");
            modales=document.querySelectorAll(".Amodal");

modales.forEach(modal => {
    modal.addEventListener("click",function(){
        datos=modal.getElementsByTagName("label");
        codigo.textContent=datos[0].textContent;
        nombre.textContent=modal.querySelector("#name").textContent;
        descripcion.textContent=datos[1].textContent;
        imagen.setAttribute("src", datos[2].textContent)
        categoria.textContent=datos[3].textContent;
        precio.textContent=modal.querySelector("#price").textContent;
        existencias.textContent="Quedan: "+datos[4].textContent;
    })
    
});

            
