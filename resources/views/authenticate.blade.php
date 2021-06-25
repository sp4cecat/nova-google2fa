<!DOCTYPE html>
<html lang="en" class="h-full font-sans">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ Nova::name() }}</title>

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('app.css', 'vendor/nova') }}">

    <style>
        body {
            font-family: "Montserrat", sans-serif !important;
        }

        .btn,
        .form-input,
        .rounded-lg {
            border-radius: 0 !important;
        }
    </style>
    <script>
        function checkAutoSubmit(el) {
            if (el.value.length === 6) {
                document.getElementById('authenticate_form').submit();
            }
        }

    </script>
</head>
<body class="bg-40 text-black h-full">
<div class="h-full">
    <div class="px-view py-view mx-auto">
        <div class="mx-auto py-8 max-w-sm text-center text-90">
            @include('nova::partials.logo')
        </div>

        <form id="authenticate_form"
              class="bg-white shadow rounded-lg p-8 max-w-lg mx-auto" method="POST"
              style="border-radius: 6px !important;"
              action="/los/2fa/authenticate">
            @csrf
            <h2 class="p-2 text-center">Two Factor Authentication</h2>

            <p class="p-2 text-center">Two factor authentication (2FA) strengthens security by requiring two methods (factors) to verify your identity.
                2FA protects against phishing and password attacks and secures your logins from attackers. We use an Authenticator as the second factor.</p>
            <p class="p-2 text-center">Some 2FA app options include:</p>
            <p class="p-2 text-center">Google Authenticator, Microsoft Authenticator, Authy</p>

            <div class="text-center pt-3">
                <div class="mb-6 w-1/2" style="display:inline-block">
                    @if (isset($error))
                        <p id="error_text" class="text-center font-semibold text-danger my-3">
                            {{  $error }}
                            <button
                                    onclick="
                                        document.getElementById('secret_div').style.display = 'none';
                                        document.getElementById('error_text').style.display = 'none';
                                        document.getElementById('recover_div').style.display = 'block';
                                    "
                                    class="w-1/4 btn btn-default btn-primary hover:bg-primary-dark"
                                    style="border-radius: 6px !important;"
                                    type="button">
                                Recover
                            </button>
                        </p>
                    @endif
                    <div id="secret_div">
                        <input type="checkbox"
                               class="mt-4 mb-4"
                               id="remember-device"
                               name="remember-device"
                               value="">
                        <label for="remember-device">Before entering code, check to remember on this device</label>
                        <label class="block font-bold mb-2" for="co">Enter the pin from your authenticator app:</label>
                        <input class="form-control form-input form-input-bordered w-full" id="secret" type="number"
                               style="border-radius: 6px !important;"
                               name="secret" value="" onkeyup="checkAutoSubmit(this)" autofocus="">
                    </div>
                    <div id="recover_div" style="display: none;">
                        <label class="block font-bold mb-2" for="co">Recovery code</label>
                        <input class="form-control form-input form-input-bordered w-full" id="recover" type="text"
                               style="border-radius: 6px !important;"
                               name="recover" value="" autofocus="">
                    </div>
                </div>
                <button class="w-1/2 btn btn-default btn-primary hover:bg-primary-dark"
                        style="border-radius: 6px !important;"
                        type="submit">
                    Authenticate
                </button>
            </div>
        </form>
    </div>
</div>
</body>
</html>
