<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>{{env('APP_NAME')}}</title>
    <meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
    <link rel="icon" href="{{asset('vendor/starterkit/img/icon.ico')}}" type="image/x-icon" />
    <script src="{{asset('vendor/starterkit/js/webfont.min.js?v='.date('YmdHis'))}}"></script>
    <script>
        WebFont.load({
            google: {
                "families": ["Lato:300,400,700,900"]
            },
            custom: {
                "families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands", "simple-line-icons"
                ],
                urls: ["{{asset('vendor/starterkit/css/fonts.min.css ')}}"]
            },
            active: function () {
                sessionStorage.fonts = true;
            }
        });

    </script>
    <style>
        :root {
            /* color */
            --admin-sidebar-color: {{s_config('admin_sidebar_color')}} !important;
        }
        /*  */

    </style>
    <link rel="stylesheet" href="{{asset('vendor/starterkit/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/starterkit/css/atlantis.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/starterkit/css/fabric-icons.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/starterkit/css/sumoselect.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/starterkit/css/jquery.timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/starterkit/css/lightpick.css')}}">
    <link rel="stylesheet" href="{{asset('vendor/starterkit/css/custom.css?v='.date('YmdHis'))}}">
    <link rel="stylesheet" href="{{asset('vendor/starterkit/css/admin.css?v='.date('YmdHis'))}}">
</head>
