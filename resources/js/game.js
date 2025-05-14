// Mengirim ping ke server setiap 30 detik untuk keep-alive session
setInterval(function() {
  fetch('/ping')
      .then(response => response.json())
      .catch(error => console.error('Ping Error:', error));
}, 30000);  // 30 detik
