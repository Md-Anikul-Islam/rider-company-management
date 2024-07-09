<!DOCTYPE html>
<html lang="en">
<!--begin::Head-->
<head>
    <title>Drive On</title>
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{{ asset('backend/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('backend/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .show_icon {
            top: 32px;
        }
        .input-container {
            position: relative;
        }

        .input-container .form-control {
            width: 100%;
            padding-right: 30px; /* Adjust this to make space for the icon */
        }

        .input-container .show_icon {
            position: absolute;
            top: 50%;
            right: 10px; /* Adjust this for spacing between the icon and the input field */
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body id="kt_body" class="auth-bg bgi-size-cover bgi-attachment-fixed bgi-position-center">
<div class="d-flex flex-column flex-root">
    <style>body { background-image: url('backend/media/auth/bg10.jpeg'); } [data-bs-theme="dark"] body { background-image: url('backend/media/auth/bg10-dark.jpeg'); }</style>
    <div class="d-flex flex-column flex-lg-row flex-column-fluid">
        <div class="d-flex flex-lg-row-fluid">
            <div class="d-flex flex-column flex-center pb-0 pb-lg-10 p-10 w-100 sign_in_probashi_bondho_Heading">
				<div class="logo mb-10">
					<img class="img-fluid" src="{{ asset('assets/media/logos/logo.png') }}" alt="">
				</div>
                <img class="theme-light-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset('backend/media/auth/agency.png') }}" alt="" />
                <img class="theme-dark-show mx-auto mw-100 w-150px w-lg-300px mb-10 mb-lg-20" src="{{ asset('backend/media/auth/agency-dark.png') }}" alt="" />
                <h1 class="text-gray-800 fs-2qx fw-bold text-center mb-7">Drive On</h1>
            </div>
        </div>


        <!-- Toaster Messages -->
        @if (session('success'))
            <script>
                toastr.success("{{ session('success') }}");
            </script>
        @endif
        @if (session('error'))
            <script>
                toastr.error("{{ session('error') }}");
            </script>
        @endif
        <div class="d-flex flex-column-fluid flex-lg-row-auto justify-content-center justify-content-lg-end p-12">
            <div class="bg-body d-flex flex-column flex-center rounded-4 w-md-600px p-10">
                <div class="d-flex flex-center flex-column align-items-stretch h-lg-100">
                    <div class="d-flex flex-center flex-column flex-column-fluid">
                        <form action="{{route('company.register.store')}}" method="post" enctype="multipart/form-data">
                            @csrf
                             <div class="text-center mb-11">
                                <h1 class="text-dark fw-bolder mb-3">
                                    Join Drive On
                                </h1>
                            </div>


                            <div class="fv-row mb-4">
                                <label for="contact_name">Company Name<span style="color: red;">*</span></label>
                                <input type="text" placeholder="Enter Company Name" name="name" id="name" autocomplete="off" class="form-control bg-transparent" required/>
                            </div>

                            <div class="fv-row mb-4">
                                <label for="email">Company Email<span style="color: red;">*</span></label>
                                <input type="email" placeholder="Enter Email Address" name="email" id="email" autocomplete="off" class="form-control bg-transparent" required/>
                            </div>

                            <div class="fv-row mb-4">
                                <label for="designation">Company Mobile No</label>
                                <input type="text" placeholder="Enter Phone" name="phone" id="phone" autocomplete="off" class="form-control bg-transparent" required/>
                            </div>

                            <div class="fv-row mb-4">
                                <label for="designation">Company Address</label>
                                <input type="text" placeholder="Enter Address" name="address" id="phone" autocomplete="off" class="form-control bg-transparent" required/>
                            </div>


                            <div class="fv-row mb-4">
                                <label for="trade_license">Trade License<span style="color: red;">*</span></label>
                                <input type="file" name="trade_license" id="trade_license" autocomplete="off" class="form-control bg-transparent" required/>
                            </div>

                            <div class="fv-row mb-4">
                                <label for="recruiting_license">Company Logo<span style="color: red;">*</span></label>
                                <input type="file" name="logo" id="logo" autocomplete="off" class="form-control bg-transparent" required/>
                            </div>


                            <div class="fv-row mb-4 password_show_hide">
                                <label for="business_card">Password<span style="color: red;">*</span></label>
                                <div class="input-container">
                                    <input type="password" name="password" placeholder="Enter Password" id="password" autocomplete="off" class="form-control bg-transparent">
                                    <span class="fa fa-eye show_icon register_password"></span>
                                </div>
                            </div>

                            <div class="d-grid mb-7">
                                <button type="submit" class="btn btn-primary">
                                    <span class="indicator-label">Submit</span>
                                </button>
                            </div>

                            <div class="text-gray-500 text-center fw-semibold fs-6 mb-10">Already registered?
                                <a href="{{ route('login') }}" class="link-primary">Sign In</a></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('backend/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('backend/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('backend/js/custom/authentication/register.js') }}"></script>
<script>
    {{-- Password Show/Hide --}}
    const triggerPasswordRegister = document.querySelector('.register_password');
    const triggerPasswordRegisterConfirm = document.querySelector('.register_confirm_password');
    const showPassword = trigger => {
        trigger.addEventListener('click', () => {
            if(trigger.previousElementSibling.getAttribute('type') === 'password'){
                trigger.previousElementSibling.setAttribute('type', 'text');
                trigger.classList.remove('fa-eye');
                trigger.classList.add('fa-eye-slash');
            }else if(trigger.previousElementSibling.getAttribute('type') === 'text'){
                trigger.previousElementSibling.setAttribute('type', 'password');
                trigger.classList.remove('fa-eye-slash');
                trigger.classList.add('fa-eye');
            }
        });
    }
    showPassword(triggerPasswordRegister);
    showPassword(triggerPasswordRegisterConfirm);

    // Get references to password and re-password fields
    const passwordField = document.getElementById('password');
    const rePasswordField = document.getElementById('repassword');

    // Get the form and submit button
    const form = document.querySelector('form');
    const submitButton = form.querySelector('button[type="submit"]');

    // Function to check if passwords match
    function checkPasswordsMatch() {
        if (passwordField.value !== rePasswordField.value) {
            rePasswordField.setCustomValidity("Passwords do not match");
        } else {
            rePasswordField.setCustomValidity('');
        }
    }

    // Add event listeners to password and re-password fields
    passwordField.addEventListener('input', checkPasswordsMatch);
    rePasswordField.addEventListener('input', checkPasswordsMatch);

    // Disable submit button on form submission if passwords don't match
    form.addEventListener('submit', function(event) {
        if (passwordField.value !== rePasswordField.value) {
            event.preventDefault();
            checkPasswordsMatch();
        }
    });
</script>



</body>
</html>
