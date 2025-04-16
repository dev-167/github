document.addEventListener("DOMContentLoaded", function () {

// greeting clock function
    function greeting_clock()
    {
        const hour = new Date().getHours();

        if(hour >= 6 && hour <= 12)
        {
            return "Guten Morgen, ";
        }
        else if(hour >= 12 && hour < 17)
        {
            return "Hi, ";
        }
        else
        {
            return "Guten Abend, ";
        }
    }

 // dashboard.php 
 const path = window.location.pathname;
 
 // Prüfe, ob der aktuelle Pfad "dashboard" ist.  
 if(path.includes("dashboard"))
{
    document.getElementById("greeting_clock").textContent = greeting_clock();
}
    });