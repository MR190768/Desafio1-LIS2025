Btntodos = document.getElementById("allprod");
Btntextiles = document.getElementById("onlyTextiles");
Btnpromocionales = document.getElementById("btnProm");
promocionales = document.querySelectorAll("[categoria='promocional']");
textiles = document.querySelectorAll("[categoria='textil']");
loader = document.getElementById("loader");

async function mostrarLoader(callback) {
    loader.style.display = "block"; 
    await ocultarTodo();
    setTimeout(() => {
        callback(); 
        loader.style.display = "none"; 
    }, 500); 
}

async function ocultarTodo(){
    await promocionales.forEach(promo => promo.style.display = "none");
    await textiles.forEach(tex => tex.style.display = "none");
};

Btntextiles.addEventListener("click", function () {
    mostrarLoader(() => {
        textiles.forEach(tex => tex.style.display = "block");
    });
});

Btnpromocionales.addEventListener("click", function () {
    mostrarLoader(() => {
        promocionales.forEach(promo => promo.style.display = "block");
    });
});

Btntodos.addEventListener("click", function () {
    mostrarLoader(() => {
        textiles.forEach(tex => tex.style.display = "block");
        promocionales.forEach(promo => promo.style.display = "block");
    });
});

