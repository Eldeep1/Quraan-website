//script for playing an audio auto.
//not auto .... but anyway it works 
//-----------------------------------------------------------

console.log('somebody help me');
//            
var audioElement = document.getElementById("audioElement");
function playAudio() {
    console.log(selectedSurah);

    console.log('somebody help me');

    var audioFilePath = "http://localhost/islameiat/" + readerSelect.value + "/" + selectedSurah + ".mp3";
    console.log(audioFilePath);
//to not reload the audio if it's already playing 
    if (audioElement.src !== audioFilePath) {
        // If the audio source has changed, update the source and load the new audio file
        audioElement.src = audioFilePath;
        audioElement.load();
    }

    // Play the audio
    audioElement.play();

    // Update the play/pause button text
}
function updateAudioBar() {
    var audioProgress = document.getElementById("audioProgress");
    var progress = (audioElement.currentTime / audioElement.duration) * 100; // Calculate the progress in percentage

    // Check if progress is a finite number before setting the value
    if (isFinite(progress)) {
        audioProgress.value = progress;
    } else {
        audioProgress.value = 0; // Set to 0 if progress is not a finite number
    }
}

function togglePlayPause() {
//    var playPauseButton = document.getElementById("playPauseButton");
//    if (audioElement.paused) {
////        audioElement.play();
//        playPauseButton.innerText = "Pause";
//    } else {
//        audioElement.pause();
////        playPauseButton.innerText = "Play";
//    }
audioElement.pause();
}

function seekAudio(event) {
    //event.offsetX gives the X-coordinate of the mouse pointer relative to the audio progress bar
    //audioProgress.offsetWidth gives the total width of the audio progress bar.
//(event.offsetX / audioProgress.offsetWidth) gives the ratio of the click position to the total width of the audio progress bar.
    var audioProgress = document.getElementById("audioProgress");
    var seekTime = (event.offsetX / audioProgress.offsetWidth) * audioElement.duration; // Calculate the seek time based on click position
    //updating the current time with the clicked time :
    audioElement.currentTime = seekTime;
}