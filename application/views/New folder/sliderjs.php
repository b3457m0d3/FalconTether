<script type="text/javascript" src="slides.min.jquery.js"></script>
        <script type="text/javascript">
            $(function(){
                $('#slider').slides({
                    preload: true,
                    preloadImage: '/assets/images/loading.gif',
                    play: 5000,
                    pause: 2500,
                    auto: 2000,
                    hoverPause: true,
                    animationComplete: function(current){
                        $('.caption').animate({
                            bottom:0
                        },200);
                    },
                    slidesLoaded: function() {
                        $('.caption').animate({
                            bottom:0
                        },200);
                    }
                });
            });
        </script>