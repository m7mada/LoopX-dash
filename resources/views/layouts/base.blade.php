<!DOCTYPE html>
<html lang='en' dir="{{ Route::currentRouteName() == 'rtl' ? 'rtl' : '' }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('assets') }}/img/apple-icon.png">
    <link rel="icon" type="image/png" href="{{ asset('assets') }}/img/favicon.png">
    <title>
        Aaref is here
    </title>

    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css"
        href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700,900|Roboto+Slab:400,700" />
    <!-- Nucleo Icons -->
    <link href="{{ asset('assets') }}/css/nucleo-icons.css" rel="stylesheet" />
    <link href="{{ asset('assets') }}/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/03cef1aeeb.js" crossorigin="anonymous"></script>
    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Round" rel="stylesheet">
    <!-- CSS Files -->
    <link id="pagestyle" href="{{ asset('assets') }}/css/material-dashboard.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <link href="{{ asset('assets') }}/css/wizard.css" rel="stylesheet"/>

    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <link href="{{asset('assets')}}/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <link href="{{asset('assets/css/custome.css')}}" rel="stylesheet">

    <style>

     
        :root {
            --color: #6d72e0;
            --color-hover: #5f64dd;
            --color-o50: #5f64dd80;
        }
        body.g-sidenav-show.bg-gray-200{
            margin-top: 0px;
        }
         .bg-gradient-primary{
            background-image: linear-gradient(195deg, var(--color), var(--color)) !important; 
        }
        .container-fluid .shadow-primary{
            box-shadow: 0 4px 20px 0 var(--color), 0 7px 10px -5px var(--color) !important;
        }
        .btn-primary{
            background-color: var(--color);
        }
        .badge.bg-primary {
            background: var(--color);

        }
        .bg-primary{
            background-color: var(--color) !important;
  
        }

        .table-list .avatar-sm {
            width: 30px !important;
            height: 30px !important;
            margin-top: 6px;
        }

        .btn-primary:hover, .btn.bg-gradient-primary:hover, .shadow-primary {
            box-shadow: 0 4px 20px 0 #00000024, 0 7px 10px -5px #6d72e066 !important;
        }

        .text-primary {
            color: var(--color) !important;
        }

        .btn-primary, .btn.bg-gradient-primary {
            box-shadow: 0 3px 3px 0 #00000024, 0 3px 1px -2px #6d72e066, 0 1px 5px 0 #6d72e066;
        }

        .text-gradient.text-primary {
            background-image: linear-gradient(195deg, var(--color), var(--color));
        }

        .form-check:not(.form-switch) .form-check-input[type=checkbox]:checked {
            background: var(--color);
        }

        .form-check:not(.form-switch) .form-check-input[type=checkbox]:checked, .form-check:not(.form-switch) .form-check-input[type=radio]:checked {
            border-color: var(--color);
        }
        .btn-primary:hover, .btn.bg-gradient-primary:hover, .btn-check:focus+.btn-primary, .btn-primary:focus, .btn-primary:hover {
            background-color: var(--color-hover);
            border-color: var(--color-hover);
        }
        .btn-primary:not(:disabled):not(.disabled).active, .btn-primary:not(:disabled):not(.disabled):active, .btn.bg-gradient-primary:not(:disabled):not(.disabled).active, .btn.bg-gradient-primary:not(:disabled):not(.disabled):active, .show>.btn-primary.dropdown-toggle, .show>.btn.bg-gradient-primary.dropdown-toggle {
            background-color: var(--color-hover);
            color: #fff
        }
        .btn-check:focus+.btn-primary, .btn-primary:focus {
            box-shadow: 0 0 0 .2rem var(--color-o50);
        }
               
        

            /* width */
            ::-webkit-scrollbar {
                width: 7px;
            }

            /* Track */
            ::-webkit-scrollbar-track {
               background: #ffffff00;
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
               background: #afaeae;
                border-radius: 8px;
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
                background: #555;
            }

            .stop-icon {
                color: var(--color) !important;
            }

            .chat-message{
                border: 1px;
            }

            .chat-message div + div{
                    position: relative;
                    border-radius: 18px !important;
                    max-width: 500px;
                }
            .chat-message-data{
                position: absolute;
                right: 20px;
                bottom: -25px;
                width: 215px;
                text-align: right;
                font-size: 12px;
            }

            .chat-message-left .chat-message-data {
                text-align: left;
                left: 20px;
                right: initial;
            }

            .chat-message-right div + div {
                background-color: #6a75dc !important;
                color: #fff;
            }

            .chat-message-right  .chat-message-data {
                color: #7b809a;
            }

    </style>
    @livewireStyles
</head>
<body class="g-sidenav-show {{ Route::currentRouteName() == 'rtl' ? 'rtl' : '' }} {{ Route::currentRouteName() == 'register' || Route::currentRouteName() == 'static-sign-up' ? '' : 'bg-gray-200' }}">

{{ $slot }}

<script src="{{ asset('assets') }}/js/core/popper.min.js"></script>
<script src="{{ asset('assets') }}/js/core/bootstrap.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/perfect-scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/js/plugins/smooth-scrollbar.min.js"></script>
<script src="{{ asset('assets') }}/js/multistep-form.js"></script>
<script src="{{ asset('assets') }}/js/dropzone.min.js"></script>

@stack('js')
<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
        var options = {
            damping: '0.5'
        }
        Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }


    window.addEventListener('selectConversation', function () {
        console.log('Selecting conversation');
         $('#chat-messages').animate({ scrollTop: document.getElementById("chat-messages").scrollHeight }, 100);
    });


    window.addEventListener('focusMessageInput', function () {
        console.log('Focusing message input');
        $('#inbutMessageToSendToUser').focus();
        console.log(document.getElementById("chat-messages").scrollHeight)
        $('#chat-messages').animate({ scrollTop: document.getElementById("chat-messages").scrollHeight }, 100);
    });


    var showLogsFilter = false;

    $('#show-hide-logs-filter').click(() => {
        if(showLogsFilter) {
            $('#logs-filter').css({ left: '-25%' });
        }else {
            $('#logs-filter').css({ left: '0' });
        }
        showLogsFilter = !showLogsFilter;
    })

    $('#done-logs-filter').click(() => {
        $('#logs-filter').css({ left: '-25%' });
        $('#logs-filter').toggle();
        showLogsFilter = false;
        $("#search_conversation_id").val($("#searchConversationInput").val());
    })
  


</script>




<!-- Github buttons -->
<script async defer src="https://buttons.github.io/buttons.js"></script>
<!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
<script src="{{ asset('assets') }}/js/material-dashboard.min.js?v=3.0.0"></script>
@yield('script')
@livewireScripts


<script>
    function copyText(event, id) {
        console.log(event);
        event.stopPropagation();
                var $temp = $("<div>");
        $("body").append($temp);
        $temp.attr("contenteditable", true)
            .html($("#botpress_conversation_id_" + id).html()).select()
            .on("focus", function () { document.execCommand('selectAll', false, null); })
            .focus();
        document.execCommand("copy");
        $temp.remove();
    }
</script>
</body>
</html>
