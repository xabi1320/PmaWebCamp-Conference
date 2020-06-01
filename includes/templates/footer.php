<footer class="site-footer">
        <div class="container clearfix">
            <div class="info-footer">
                <h3>Sobre <span>PmaWebCamp</span></h3>

                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent convallis fringilla nisl, ac luctus ex tempor vel. Nunc luctus porttitor odio. Nunc ut congue est. Ut dignissim ornare felis sit amet ultricies. Vestibulum vel tincidunt
                    dui. Curabitur pharetra orci id justo elementum sagittis. Aenean pretium quis purus maximus congue.
                </p>
            </div>

            <div class="last-tweets">
                <h3>Ultimos <span>Tweets</span></h3>
                <a class="twitter-timeline" data-height="400" href="https://twitter.com/youyuxi?ref_src=twsrc%5Etfw">Tweets by youyuxi</a> <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
            </div>

            <div class="menu">
                <h3>Redes <span>Sociales</span></h3>

                <nav class="social-network">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-twitter-square"></i></a>
                    <a href="#"><i class="fab fa-pinterest-p"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                </nav>

            </div>
        </div>
        <p class="copyright">Todos los derechos Reservados PMAWEBCAMP 2020. <span>&copy</span></p>

        <!-- Begin Mailchimp Signup Form -->
        <link href="//cdn-images.mailchimp.com/embedcode/classic-10_7.css" rel="stylesheet" type="text/css">
        <style type="text/css">
            #mc_embed_signup{background:#fff; clear:left; font:14px Helvetica,Arial,sans-serif; }
            /* Add your own Mailchimp form style overrides in your site stylesheet or in this style block.
            We recommend moving this block and the preceding CSS link to the HEAD of your HTML file. */
        </style>
        <div style="display:none;"">
            <div id="mc_embed_signup">
            <form action="https://gmail.us19.list-manage.com/subscribe/post?u=74885bd4dfab9852438d8be8f&amp;id=56ec5b745d" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate>
                <div id="mc_embed_signup_scroll">
                <h2>Suscribete al Newsletter y no te pierdas nada de este evento</h2>
            <div class="indicates-required"><span class="asterisk">*</span> Es obligatorio</div>
            <div class="mc-field-group">
                <label for="mce-EMAIL">Correo Electronico  <span class="asterisk">*</span>
            </label>
                <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL">
            </div>
                <div id="mce-responses" class="clear">
                    <div class="response" id="mce-error-response" style="display:none"></div>
                    <div class="response" id="mce-success-response" style="display:none"></div>
                </div>    <!-- real people should not fill this in and expect good things - do not remove this or risk form bot signups-->
                <div style="position: absolute; left: -5000px;" aria-hidden="true"><input type="text" name="b_74885bd4dfab9852438d8be8f_56ec5b745d" tabindex="-1" value=""></div>
                <div class="clear"><input type="submit" value="Suscribirse" name="subscribe" id="mc-embedded-subscribe" class="button"></div>
                </div>
            </form>
            </div>
            <script type='text/javascript' src='//s3.amazonaws.com/downloads.mailchimp.com/js/mc-validate.js'></script><script type='text/javascript'>(function($) {window.fnames = new Array(); window.ftypes = new Array();fnames[0]='EMAIL';ftypes[0]='email';fnames[1]='FNAME';ftypes[1]='text';fnames[2]='LNAME';ftypes[2]='text';fnames[3]='ADDRESS';ftypes[3]='address';fnames[4]='PHONE';ftypes[4]='phone';fnames[5]='BIRTHDAY';ftypes[5]='birthday';}(jQuery));var $mcj = jQuery.noConflict(true);</script>
            <!--End mc_embed_signup-->
        </div>
    </footer>

    <script src="js/vendor/modernizr-3.8.0.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.4.1.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script>
        window.jQuery || document.write('<script src="js/vendor/jquery-3.4.1.min.js"><\/script>')
    </script>
    <script src="js/plugins.js"></script>
    <script src="js/jquery.animateNumber.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/jquery.lettering.js"></script>

    <?php  
        $file = basename($_SERVER['PHP_SELF']);
        $page = str_replace(".php","",$file);
        if($page == 'invitados' || $page == 'index'){
            echo '<script src="js/jquery.colorbox-min.js"></script>';
        }else if($page == 'conferencias'){
            echo '<script src="js/lightbox.js"></script>';
        }
    ?>
    
    <script src="https://unpkg.com/leaflet@1.6.0/dist/leaflet.js"></script>
    <script src="js/main.js"></script>
    <script src="js/cotizador.js"></script>


    <!-- Google Analytics: change UA-XXXXX-Y to be your site's ID. -->
    <script>
        window.ga = function() {
            ga.q.push(arguments)
        };
        ga.q = [];
        ga.l = +new Date;
        ga('create', 'UA-XXXXX-Y', 'auto');
        ga('set', 'transport', 'beacon');
        ga('send', 'pageview')
    </script>
    <script src="https://www.google-analytics.com/analytics.js" async></script>
    <script type="text/javascript" src="//downloads.mailchimp.com/js/signup-forms/popup/unique-methods/embed.js" data-dojo-config="usePlainJson: true, isDebug: false"></script><script type="text/javascript">window.dojoRequire(["mojo/signup-forms/Loader"], function(L) { L.start({"baseUrl":"mc.us19.list-manage.com","uuid":"74885bd4dfab9852438d8be8f","lid":"56ec5b745d","uniqueMethods":true}) })</script>
</body>

</html>