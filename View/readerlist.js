
//help
console.log("meowwww");
var readerSelect = document.getElementById("readerSelect");//refering to the html element to be able to do number 2

function showReaderList() {
    for (var i = 0; i < readerList.length; i++) {
        var option = document.createElement("option");//select then option , كود بديهى لأى حد عمل اى صفحه قبل كدا
        option.text = readerList[i];
        option.value = i + 1; // Set the option value as the reader number
        readerSelect.add(option);//this is number 2
    }
    
}
showReaderList(); // Call the function to show the reader list automatically
