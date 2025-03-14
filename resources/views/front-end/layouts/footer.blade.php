<footer id="footer">
    <div class="container d-lg-flex py-4">

        <div class="me-lg-auto text-center text-lg-start">
            <div class="copyright">
                &copy; Copyright <strong><span><?=$settings->name ?? ''?></span></strong>. All Rights Reserved
            </div>
        </div>
        <div class="social-links text-center text-lg-right pt-3 pt-lg-0">
            <a href=<?=$settings->social_links['whatsapp'] ?? '' ?> class="whatsapp"><i class="bx bxl-whatsapp"></i></a>
            <a href=<?=$settings->social_links['twitter'] ?? '' ?> class="twitter"><i class="bx bxl-twitter"></i></a>
            <a href=<?=$settings->social_links['facebook'] ?? '' ?> class="facebook"><i class="bx bxl-facebook"></i></a>
            <a href=<?=$settings->social_links['instagram'] ?? '' ?> class="instagram"><i class="bx bxl-instagram"></i></a>
        </div>
    </div>
</footer>