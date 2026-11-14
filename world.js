document.addEventListener("DOMContentLoaded", () => {
   const looker = document.getElementById("lookup");
    const country = document.getElementById("country");
    const result = document.getElementById("result");

    looker.addEventListener("click", async () => {
        const url = `world.php?country=${encodeURIComponent(country.value)}`;
        const response = await fetch(url);
        const data = await response.text();
        result.innerHTML = data;
    })
});