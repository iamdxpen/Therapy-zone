<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="{{asset('front/assets/libs/parsleyjs/parsley.min.js?v='.env('FILE_VERSION'))}}"></script>
<script>
    $(function(){
        'use strict'

        $('#nav-icon1,#nav-icon2,#nav-icon3,#nav-icon4').click(function(){
            $(this).toggleClass('open');
        });
    });
</script>