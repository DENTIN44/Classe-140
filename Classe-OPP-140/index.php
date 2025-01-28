
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>My Shop</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="frontend/css/STYLES.css">
</head>
<body>
  <div id="content">
    <nav>
      <h3><a href="#" class="shop-button">My Shop</a></h3>

      <form action="" class="search-bar" id="search-form">
        <input type="search" placeholder="Search..." />
        <button type="submit">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="25" height="25">
            <path d="M9 2C5.1458514 2 2 5.1458514 2 9C2 12.854149 5.1458514 16 9 16C10.747998 16 12.345009 15.348024 13.574219 14.28125L14 14.707031L14 16L20 22L22 20L16 14L14.707031 14L14.28125 13.574219C15.348024 12.345009 16 10.747998 16 9C16 5.1458514 12.854149 2 9 2 z M 9 4C11.773268 4 14 6.2267316 14 9C14 11.773268 11.773268 14 9 14C6.2267316 14 4 11.773268 4 9C4 6.2267316 6.2267316 4 9 4 z" fill="#fff" />
          </svg>
        </button>
      </form>

      <ul>
        <li><a href="#Sobre">Sobre</a></li>
        <li><a href="#Parceiros">Parceiros</a></li>
        <li><a href="#Fotos">Fotos</a></li>
        <li><a href="login.php">Login</a></li>
      </ul>
    </nav>

    <div class="main-content">
      <section id="first">
        <p>What's going on?</p>
      </section>

      <aside id="secondary">
        <p>What's up!</p>
      </aside>
    </div>

    <section class="partnership">
      <p>ABOUT content goes here</p>
    </section>

    <section class="images">
      <a href="#"><img src="images/blue_background.jpg" alt="Blue Background" /></a>
      <a href="#"><img src="images/green-background.jpg" alt="Green Background" /></a>
      <a href="#"><img src="images/R.jpeg" alt="Image R" /></a>
    </section>

    <section class="photos">
      <a href="#"><img src="images/OIP.jpeg" alt="Photo 1" /></a>
      <a href="#"><img src="images/OIP.jpeg" alt="Photo 2" /></a>
      <a href="#"><img src="images/OIP.jpeg" alt="Photo 3" /></a>
    </section>
  </div>

  <div class="footer-container">
    <!-- Footer sections -->
    <?php for ($i = 0; $i < 3; $i++): ?>
      <div>
        <h3>Suporte</h3>
        <ul>
          <li><a href="#">Segurança</a></li>
          <li><a href="#">Segurança</a></li>
          <li><a href="#">Segurança</a></li>
          <li><a href="#">Segurança</a></li>
        </ul>
      </div>
    <?php endfor; ?>

    <div class="box">
      <h3>Newsletter</h3>
      <form action="">
        <input type="email" placeholder="Email Address" required />
        <button type="submit">Inscreva-se</button>
      </form>
    </div>
  </div>

  <footer>
    <p>© 2024 My Shop. All rights reserved.</p>
  </footer>

  <div class="back-btn"><i class="fas fa-arrow-up"></i></div>

  <script>
    // Add/remove shadow on search form
    const searchForm = document.getElementById('search-form');
    document.addEventListener('click', (e) => {
      if (searchForm.contains(e.target)) {
        searchForm.classList.add('shadow-active');
      } else {
        searchForm.classList.remove('shadow-active');
      }
    });

    // Back to Top button logic
    const backBtn = document.querySelector('.back-btn');
    window.addEventListener('scroll', () => {
      backBtn.classList.toggle('active', window.scrollY > 100);
    });

    backBtn.addEventListener('click', () => {
      window.scrollTo({ top: 0, behavior: 'smooth' });
    });
  </script>
</body>
</html>

<!-- User table section -->


<?php require 'footer.php'; ?>
