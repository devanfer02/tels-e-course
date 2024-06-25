import 'bootstrap';
import 'iconify-icon';

document.getElementById('copyButton').addEventListener('click', function() {
  const iconify = document.getElementById('copy-icon')
  const text = document.getElementById('paste').innerText

  navigator.clipboard.writeText(text).then(function(){
    console.log("OK")
    iconify.icon = 'mingcute:check-fill'
    setTimeout(function(){
      iconify.icon = 'icon-park-solid:copy'
    }, 1000)
  }).catch(function(err) {

  })
})
