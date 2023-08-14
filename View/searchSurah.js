
function searchSurah() {
   // Get input value
   var input = document.getElementById("searchInput").value;
   // Get the surahSelect dropdown element
   var dropdown = document.getElementById("surahSelect");
   // Loop through all options and hide/show based on search value
   for (var i = 0; i < dropdown.options.length; i++) {
      var surah = dropdown.options[i].text;
      if (surah.indexOf(input) > -1) {
         dropdown.options[i].style.display = "";//show all the surahs that includes the wanted search
      } else {
         dropdown.options[i].style.display = "none";//if the index not found , it will return -1 
      }
   }
}