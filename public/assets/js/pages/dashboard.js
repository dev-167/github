document.addEventListener("DOMContentLoaded", function () {
// Funktion zum setzen des Timestamps
function updateTimestamp()
{
    
    let timestampElement = document.getElementById("DashboardHeader_Module_timestamp");
    if(timestampElement)
    {
        const options = { weekday: 'long', day: 'numeric', month:'long'};
        const now = new Date();
        timestampElement.textContent = now.toLocaleDateString("de-DE",options);
    }
    else
    {
        //alert("Kein Element gefunden");
    }
}
    // Timestamp wird beim Laden der Seite aufgerufen
    updateTimestamp();

    // Timestamp aktuallisieren
    setInterval(updateTimestamp,1000);
});