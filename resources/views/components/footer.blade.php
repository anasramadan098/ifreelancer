<footer>
    <div class="cols">
        <div class="col">
            <img src="{{asset('imgs/logo.png')}}" alt="Logo">
            <p>Dotem eiusmod tempor incune utnaem labore etdolore maigna aliqua enim poskina ilukita ylokem lokateise ination voluptate velit esse cillum dolore eu fugiat nulla pariatur lokaim urianewce
            </p>
            <ul class="social">
                <li>
                    <a href="#" style="--icon-color:#1877F2;">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                </li>
                <li>
                    <a href="#" style="--icon-color:#CD201F;">
                        <i class="fa-brands fa-youtube"></i>
                    </a>
                </li>
                <li>
                    <a href="#" style="--icon-color:#E4405F;">
                        <i class="fa-brands fa-instagram"></i>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col">
            <h6>Company</h6>
            <a href="#">About Us</a>
            <a href="#">About Us</a>
            <a href="#">About Us</a>
            <a href="#">About Us</a>
            <a href="#" class="view">View All</a>
        </div>
        <div class="col">
            <h6>Explore More</h6>
            <a href="#">About Us</a>
            <a href="#">About Us</a>
            <a href="#">About Us</a>
            <a href="#">About Us</a>
            <a href="#" class="view">View All</a>
        </div>
    </div>
    <p class="copyright">
        <span class="copy">Copyright</span> © <span class="date"></span>
        , All Right Reserved <span>ifreelancer</span>
    </p>
</footer>

<script>

    //   Uptade Date
    const date = new Date();
    document.querySelector('footer span.date').textContent = date.getFullYear();
</script>