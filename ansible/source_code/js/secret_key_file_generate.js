function make_key(length){

    var charPos;
            var pwChar;
            var pwLength = length;  // Change for shorter or longer password

            // 1) You can add special characters like "@" to the following string if desired
            // 2) You can even include characters more than once to increase their likelihood of appearing!
            var availChars = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+=-";
            var pw = "";
            for (i = 0; i < pwLength; i++) {
                charPos = Math.floor(Math.random() * availChars.length);
                pwChar = availChars.charAt(charPos);
                pw = pw + pwChar;
            }
            

    return pw;
}

function generate_key() {
    var pom = document.createElement('a');
    
    var key = make_key(3072);
    pom.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(key));
    pom.setAttribute('download', 'key');

    if (document.createEvent) {
        var event = document.createEvent('MouseEvents');
        event.initEvent('click', true, true);
        pom.dispatchEvent(event);
    }
    else {
        pom.click();
    }
}
