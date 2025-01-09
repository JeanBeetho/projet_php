
document.getElementById("form-plat").addEventListener("submit", function(event) {
    let nomPlat = document.getElementById("nom-plat").value;
    if (nomPlat === "") {
        alert("Le nom du plat ne peut pas être vide !");
        event.preventDefault();
    }
});


function confirmDelete() {
    return confirm("Êtes-vous sûr de vouloir faire cette supression  ?");
}
