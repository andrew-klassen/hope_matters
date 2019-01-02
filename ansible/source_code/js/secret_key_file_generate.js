function make_key(length) {

	const valid_chars = 'abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ!@#$%^&*()_+=-';
	let array = new Uint8Array(length);
	window.crypto.getRandomValues(array);
	array = array.map(x => valid_chars.charCodeAt(x % valid_chars.length));
	const random_state = String.fromCharCode.apply(null, array);
	return random_state;

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
