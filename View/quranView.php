<?php
require_once '../models/quran.php';
// Get the selected surah from the URL parameter
$sura = isset($_GET['sura']) ? $_GET['sura'] : 1;
//$quran =new Quran("localhost", "root", "123456", "quran");
$dbHost = "localhost";
$dbUser = "root";
$dbPassword = "1234";
$dbName = "quran";
$quran = Quran::getInstance($dbHost, $dbUser, $dbPassword, $dbName);
$data = $quran->getSurahText($sura);
$tafsir = $quran->getSurahTafsir($sura);
$readers=$quran->getReaderNames();
function convertNumbers($str) {
    $arabicNumbers = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $englishNumbers = range(0, 9);
    return str_replace($englishNumbers, $arabicNumbers, $str);
}

?>

<html>
    <head>
        <title>Quran</title>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../../style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="icon" href="images/Mosque-logo.png">
        <link rel="stylesheet" href="style-quran.css">
    </head>

    <body style="background-color: rgb(40, 40, 40);">        
        
        <header>      
            <div class= "ic">
                <!--<i class="fa-solid fa-bars"></i>-->
<!--                <a href="countries.html">Home</a>-->
            </div>
        </header>
<!--        <aside class= "asida">
            <nav>
                <a href=""class= "logo"><img src="../Mosque-logo.ico" alt=""></a>

                <a href="http://localhost/project2/" class= "nav-link">
                    <i class="fa-regular fa-clock"></i>
                    <span id= "active-span">Prayer times</span>
                </a>

                <a href="http://localhost/project2/Eldeep-work/View/index.php" class= "nav-link">
                    <i class="fa-solid fa-book-quran"></i>
                    <span id= "active-span">Quran</span>
                </a>

                <a href="" class= "nav-link">
                    <i class="fa-solid fa-kaaba"></i>
                    <span id= "active-span">Qipla</span>
                </a>

                <a href="" class= "nav-link">
                    <i class="fa-solid fa-calendar-days"></i>
                    <span id= "active-span">Hijri date</span>
                </a>

                <a href="" class= "nav-link">
                    <i class="fa-solid fa-calculator"></i>
                    <span id= "active-span">Zakat calculator</span>
                </a>

                <a href="" class= "nav-link">
                    <i class="fa-solid fa-user"></i>
                    <span id= "active-span">Important people</span>
                </a>
                

                <a href="" class= "nav-link">
                    <i class="fa-duotone fa-book-quran"></i>
                    <span id= "active-span">Azkar</span>
                </a>

                <a href="" class= "nav-link">
                    <i class="fa-duotone fa-book-quran"></i>
                    <span id= "active-span">Dua</span>
                </a>

                <a href="" class= "nav-link">
                    <i class="fa-duotone fa-book-quran"></i>
                    <span id= "active-span">hadith</span>
                </a>

                <a href="" class= "nav-link">
                    <i src= "images/beads.ico"></i>
                    <span id= "active-span">Sibha</span>
                </a>

                <a href="" class= "nav-link">
                    <i class="fa-solid fa-location-dot"></i>
                    <span id= "active-span">Locations</span>
                </a>

            </nav>
        </aside>-->
        <div id="surahListContainer">
            <input type="text" id="searchInput" placeholder="Search for a surah"  onkeyup="searchSurah()"><!-- whenever the user tries to enter any value , the function searchsurah is being called ... -->
            <select id="surahSelect" onchange="location = 'quranview.php?sura=' + this.value;"></select> <!-- whenever the user clicks on any surah , we go to the link of the selected surah on the list (following user clicks) -->

            <script>
                //showing 4 elements at once whenever the user clicks on the input-section...
                document.getElementById("searchInput").addEventListener("click", function () {
                    document.getElementById("surahSelect").setAttribute("size", "4");
                    //showing only 1 element when the user clicks on anything else
                    document.getElementById("searchInput").addEventListener("blur", function () {
    document.getElementById("surahSelect").setAttribute("size", "1");
});

                });
            </script>
            <select id="readerSelect"></select><!-- creating list to show the readers on it -->
        </div>
        <script>
            //getting the reader values from the database
            //getting the reader name from the database between two ' '  then adding , to make the readerlist variable be an array of database elements
   var readerList = [
    <?php 
        foreach ($readers as $row) {
            echo "'" . $row['name'] . "', ";
        }
    ?>
];

    </script>
    <script src="readerlist.js?v=2"></script><!-- done filtering and commenting -->
        <script src="suralist.js?v=3"></script><!-- semi done filtering and commenting -->
        <script src="searchSurah.js?v=5"></script><!-- done ya ba4a -->
        <script>
                // Set the selected surah in the dropdown
                //to update the value of the sura with the already choosen sura from the url 
                document.getElementById('surahSelect').value = '<?php echo $sura; ?>';
        </script>
        
        <div id="buttonContainer">
            <button onclick="playAudio()">Play</button>
            <button id="playPauseButton" onclick="togglePlayPause()">Pause</button>
        </div>

        <div id="audioBar" style="height: 10%">
            <audio id="audioElement" ontimeupdate="updateAudioBar()"></audio>
            <progress id="audioProgress" value="0" max="100" onclick="seekAudio(event)"></progress>
            <script src="audiobar.js?v=2"></script><!-- semi-done -->
        </div>
        <div class="area">
            <div class="quran"> 
                <h4>سورة 
                    <script>
                        //getting what's the sura name based on the surahlist..
                            document.write(surahList[<?php echo $sura - 1; ?>].replace(/[0-9\-]/g, ''));
                    </script>
                </h4>

                <div>
                    <?php foreach ($data as $row) { 
                         echo $row['text']; ?>
                        <span class="aya-number"><?php echo convertNumbers($row['aya']); ?></span> <?php echo '  '; ?></span>

                    <?php } ?>
                    <span class="sheat" >ه</span>
                </div>
            </div>

            <div class="quran"> 
                <h4>تفسير سورة 
                    <script>
                        if (selectedSurah === -1) {
                            document.write(surahList[<?php echo $sura - 1; ?>].replace(/[0-9\-]/g, ''));
                        } else {
                            document.write(surahList[<?php echo $sura - 1; ?>].replace(/[0-9\-]/g, ''));
                        }
                    </script>
                </h4>
                <div>
                    <?php foreach ($tafsir as $row) { 
                         echo $row['text']; ?>
                        <span class="aya-number"><?php echo convertNumbers($row['aya']); ?></span>

                    <?php } ?><span class="sheat" >ه</span>
                </div>
            </div>
        </div>
    </body>
</html>
