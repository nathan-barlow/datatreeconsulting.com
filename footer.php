        <footer class="thefooter">
            <section class="footer-top">
                <a class="center" href="/">
                    <img class="footer-image" src="/wp-content/themes/datatreeconsulting.com/images/logo.png" alt="site logo">
                </a>
                <article class="footer-widget">
                    <?php dynamic_sidebar('footer'); ?>
                </article>
            </section>
            <section class="footer-bottom">
                <a href="/">&copy; <?php echo date('Y'); ?> Data Tree Consulting, LLC</a>
                <a href="https://natebarlow.me" target="_blank">Website Designed and Developed By <u>Nate Barlow</u></a>
            </section>
        </footer>
        <?php
        wp_footer();
        ?>
    </body>
</html>
