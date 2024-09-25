// Light and Dark Mode

const toggleButton = document.getElementById('toggle-button');

let isDarkMode = true;

toggleButton.addEventListener('click', () => {
    if (isDarkMode) {
        document.documentElement.style.setProperty('--bg-color', '#000000');
        document.documentElement.style.setProperty('--second-bg-color', '#161616');
        document.documentElement.style.setProperty('--text-color', '#ffffff');
        document.documentElement.style.setProperty('--main-color', '#7b4bb7');
        toggleButton.textContent = 'Dark Mode';
    } else {
        document.documentElement.style.setProperty('--bg-color', '#ffffff');
        document.documentElement.style.setProperty('--second-bg-color', '#f0f0f0');
        document.documentElement.style.setProperty('--text-color', '#000000');
        document.documentElement.style.setProperty('--main-color', '#4bb77b');
        toggleButton.textContent = 'Light Mode';
    }

    isDarkMode = !isDarkMode;

});

// smooth scrolling
document.querySelectorAll('nav a').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});

// scroll animation
document.addEventListener('DOMContentLoaded', function () {
    const sections = document.querySelectorAll('.home, .info');
    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate');
            } else {
                entry.target.classList.remove('animate');
            }
        });
    });

    sections.forEach(section => {
        observer.observe(section);
    });
});

// Ajax function
function showSuggestion(str) {
    if (str.length == 0) { 
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      var xmlhttp = new XMLHttpRequest();
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          document.getElementById("txtHint").innerHTML = this.responseText;
        }
      }
      xmlhttp.open("GET", "gethint.php?q="+str, true);
      xmlhttp.send();
    }
  }
