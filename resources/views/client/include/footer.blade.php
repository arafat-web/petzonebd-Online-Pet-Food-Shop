<!-- ══════════ NEWSLETTER ══════════ -->
<div class="newsletter">
    <div class="container-xl">
        <div class="section-eyebrow" style="color: rgba(250,247,242,.6); justify-content:center; display:flex;">Stay Updated</div>
        <h2>Get Exclusive <em style="font-style:italic; color:var(--sand)">Deals</em> & Pet Tips</h2>
        <p>Join 50,000+ pet parents receiving weekly nutrition tips and exclusive discounts.</p>
        <div class="newsletter-form">
            <input type="email" placeholder="your@email.com" />
            <button>Subscribe</button>
        </div>
        <p class="mt-3" style="font-size:.75rem; color:rgba(250,247,242,.4)">No spam, ever. Unsubscribe any time.</p>
    </div>
</div>

<!-- ══════════ FOOTER ══════════ -->
<footer>
    <div class="container-xl">
        <div class="row g-5">
            <div class="col-lg-4">
                <div class="footer-brand">Pet<span>Zone</span></div>
                <p class="footer-desc">Bangladesh's leading online pet food destination. Premium nutrition delivered to your door, because your pet deserves the best.</p>
                <div class="footer-social">
                    <a href="#"><i class="bi bi-facebook"></i></a>
                    <a href="#"><i class="bi bi-instagram"></i></a>
                    <a href="#"><i class="bi bi-twitter-x"></i></a>
                    <a href="#"><i class="bi bi-youtube"></i></a>
                </div>
            </div>
            <div class="col-6 col-lg-2">
                <div class="footer-heading">Quick Links</div>
                <ul class="footer-links">
                    <li><a href="{{route('index')}}">Home</a></li>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Products</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-2">
                <div class="footer-heading">Categories</div>
                <ul class="footer-links">
                    @foreach($categories as $category)
                        <li><a href="{{route('products', ['category'=>$category->slug])}}">{{$category->name}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-6 col-lg-2">
                <div class="footer-heading">Policies</div>
                <ul class="footer-links">
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Return Policy</a></li>
                    <li><a href="#">Shipping Info</a></li>
                    <li><a href="#">Terms of Use</a></li>
                    <li><a href="#">FAQ</a></li>
                </ul>
            </div>
            <div class="col-6 col-lg-2">
                <div class="footer-heading">Contact</div>
                <ul class="footer-links">
                    <li><a href="#">Dhaka, Bangladesh</a></li>
                    <li><a href="tel:+8801700000000">+880 1700-000000</a></li>
                    <li><a href="mailto:hello@petzone.com">hello@petzone.com</a></li>
                    <li style="margin-top:.75rem; color:rgba(250,247,242,.3); font-size:.75rem;">Mon–Sat: 9am – 6pm</li>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="row align-items-center">
                <div class="col-md-6">© 2025 PetZone. All rights reserved.</div>
                <div class="col-md-6 text-md-end mt-2 mt-md-0" style="font-size:.78rem; color:rgba(250,247,242,.3)">
                    Designed with ♥ for pet lovers in Bangladesh
                </div>
            </div>
        </div>
    </div>
</footer>

<script>
  // Wishlist toggle
  document.querySelectorAll('.product-wishlist').forEach(btn => {
    btn.addEventListener('click', function() {
      const icon = this.querySelector('i');
      if(icon.classList.contains('bi-heart')) {
        icon.classList.replace('bi-heart', 'bi-heart-fill');
        this.style.color = '#E8521A';
      } else {
        icon.classList.replace('bi-heart-fill', 'bi-heart');
        this.style.color = '';
      }
    });
  });

  // Add to cart feedback
  document.querySelectorAll('.btn-add-cart').forEach(btn => {
    btn.addEventListener('click', function(e) {
      const orig = this.innerHTML;
      this.innerHTML = '<i class="bi bi-check-lg"></i>';
      this.style.background = 'var(--sage)';
      setTimeout(() => {
        this.innerHTML = orig;
        this.style.background = '';
      }, 1200);
    });
  });

  // Fade-in on scroll
  const observer = new IntersectionObserver((entries) => {
    entries.forEach(e => {
      if(e.isIntersecting) {
        e.target.style.opacity = '1';
        e.target.style.transform = 'translateY(0)';
      }
    });
  }, { threshold: 0.1 });

  document.querySelectorAll('.product-card, .cat-card').forEach(card => {
    card.style.opacity = '0';
    card.style.transform = 'translateY(20px)';
    card.style.transition = 'opacity .5s ease, transform .5s ease, box-shadow .25s, border-color .25s';
    observer.observe(card);
  });
</script>

