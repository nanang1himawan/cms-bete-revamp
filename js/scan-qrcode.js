const scanner = new Html5QrcodeScanner("reader", {
  qrbox: {
    width: 350,
    height: 350,
  },
  fps: 30,
});
scanner.render(success, error);

function success(result) {


  console.log("halooooo");
  var url = 'index-welcome.php';
  var form = $('<form name="guest" action="' + url + '" method="GET">' +
    '<input type="text" name="id_guest" value="' + result + '" />' +
    '<input type="text" name="id_event" value="' + nameEvent + '" />' +
    '</form>');
  $('body').append(form);
  form.submit();


  // document.getElementById("result").innerHTML = `
  //   <p><a href="${result}">${result}</a></p>
  //   `;
  scanner.clear();
  document.getElementById("reader").remove();
}

function error(err) {
  // console.error(err);
}