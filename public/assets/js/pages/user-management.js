document.addEventListener("DOMContentLoaded", function() {
    
    // Umschalten von Suche und Neuer User Buttons (Ein-/Ausblenden)
    const searchBtn = document.getElementById("toggle-search");
    const newUserBtn = document.getElementById("toggle-new-user");
    const searchSection = document.getElementById("search-section");
    const newUserSection = document.getElementById("new-user-section");

    searchBtn.addEventListener("click", function() {
        searchSection.classList.toggle("d-none");
        newUserSection.classList.add("d-none");
    });

    newUserBtn.addEventListener("click", function() {
        newUserSection.classList.toggle("d-none");
        searchSection.classList.add("d-none");
    });


    let lastClickedEditBtn = null;

    // Benutzer löschen
    $(".delete-form").submit(function(e) {
        e.preventDefault();

        let form = $(this);
        let userId = form.find("input[name='id']").val();
        let row = form.closest("tr");

        if (!confirm("Willst du diesen Benutzer wirklich löschen?")) return;

        $.ajax({
            url: "delete-user",
            type: "POST",
            data: { id: userId },
            dataType: "json",
            success: function(response) {
                if (response.success) {
                    row.fadeOut(500, function() { $(this).remove(); });
                } else {
                    alert("Löschen fehlgeschlagen: " + response.error);
                }
            },
            error: function(xhr, status, error) {
                console.error("Fehler beim Löschen:", status, error);
                alert("Server-Fehler beim Löschen!");
            }
        });
    });

    // Benutzer bearbeiten
    $(".edit-btn").on("click", function() {
        lastClickedEditBtn = $(this);
        lastClickedEditBtn.hide();

        $(".input-group").hide();
        $(".table-responsive").hide();
        $("#edit-user-form").removeClass("d-none");

        // Werte setzen
        $("#edit-id").val($(this).data("id"));
        $("#edit-name").val($(this).data("name"));
        $("#edit-surname").val($(this).data("surname"));
        $("#edit-email").val($(this).data("email"));
        $("#edit-phone").val($(this).data("phone"));

        // Debugging
        console.log("User ID gesetzt:", $("#edit-id").val()); // Hier überprüfen, ob ID richtig gesetzt ist.


        // Scroll zum Formular
        window.scrollTo({ top: $("#edit-user-form").offset().top - 50, behavior: 'smooth' });
    });

    // Abbrechen-Button (mit class statt ID!)
    $(".cancel-edit").click(function(e) {
        e.preventDefault();
        $("#edit-user-form").addClass("d-none");
        $(".input-group").show();
        $(".table-responsive").show();

        if (lastClickedEditBtn) {
            lastClickedEditBtn.show();
        }
    });
});