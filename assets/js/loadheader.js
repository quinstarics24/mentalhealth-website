
  // Fetch and insert header content dynamically
  async function loadHeader() {
    const headerContainer = document.createElement('div');
    try {
      const response = await fetch('../static/header.html');
      if (response.ok) {
        const headerHTML = await response.text();
        headerContainer.innerHTML = headerHTML;
        document.body.insertBefore(headerContainer.firstElementChild, document.body.firstChild);

        // Activate the hamburger menu after loading the header
        const hamburger = document.querySelector('.hamburger');
        const navLinks = document.querySelector('.nav-links');
        if (hamburger && navLinks) {
          hamburger.addEventListener('click', () => {
            navLinks.classList.toggle('active');
          });
        }
      } else {
        console.error('Failed to load header:', response.status);
      }
    } catch (error) {
      console.error('Error loading header:', error);
    }
  }

  loadHeader();

