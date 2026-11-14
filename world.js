document.addEventListener("DOMContentLoaded", () => {
   const looker = document.getElementById("lookup");
   const CitButton = document.getElementById("cities")
    const country = document.getElementById("country");
    const result = document.getElementById("result");
    
    looker.addEventListener("click", async () => {
        const url = `world.php?country=${encodeURIComponent(country.value)}`;
        const response = await fetch(url);
        const data = await response.text();
        result.innerHTML = data;
    })

CitButton.addEventListener("click", async () => {
    const url = `world.php?country={encodeURIComponent(country.value)}&lookup=cities`;
    const response = await fetch(url);
    result.innerHTML = await response.text();

})
});