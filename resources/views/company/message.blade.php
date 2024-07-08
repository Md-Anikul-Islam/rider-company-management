<!DOCTYPE html>
<html lang="en">
<head>
    <title>Drive On</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="utf-8" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon.ico') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <style>
    * {
                    margin: 0;
                    padding: 0;
                    box-sizing: border-box
                }

                body {
                    font-family: Inter,sans-serif;
                    background-color: #f8f9fa
                }

                .approval_status_section_area {
                    width: 100%;
                    max-width: 600px;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100vh;
                    margin: 0 auto;
                    text-align: center;
                    padding: 0 15px
                }

                .approval_status_box {
                    background-color: #f1416c17;
                    padding: 1.5rem;
                    border: 1px dashed #f1416c
                }

                .approval_status_box svg {
                    color: #f1416c;
                    width: 60px;
                    height: 60px;
                    margin-bottom: 10px
                }

                .approval_status_box h4 {
                    display: inline-block;
                    border: 1px dashed #f1416c;
                    padding: 2px 10px;
                    border-radius: 50px;
                    color: #f1416c;
                    margin-bottom: 20px;
                    font-size: 14px
                }

                .approval_status_box h3 {
                    font-size: 20px;
                    margin-bottom: 10px;
                    line-height: 28px;
                    color: #071437
                }

                .approval_status_box p {
                    font-size: 16px;
                    line-height: 24px;
                    color: #4b5675;
                    margin-bottom: 10px;
                }

                .approval_status_box a {
                    text-decoration: none;
                    color: #009ef7;
                    font-weight: 700
                }
       </style>
</head>
<body>
<section class="approval_status_section_area">
    <div class="approval_status_box">
        <svg viewBox="0 0 22 19" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd" clip-rule="evenodd" d="M3.81397 17.4369H18.197C19.779 17.4369 20.772 15.7269 19.986 14.3529L12.8 1.78793C12.009 0.404933 10.015 0.403933 9.22297 1.78693L2.02497 14.3519C1.23897 15.7259 2.23097 17.4369 3.81397 17.4369Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M11.0024 10.4149V7.31494" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M10.995 13.5001H11.005" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        <div>
            <h4>Rejected</h4>
            <h3>Oops! Your company profile has been rejected.</h3>
            <p>Please check the details. You are disable now please contact to your Administrator.</p>
            <a style="color: red" href="{{ route('login') }}">Back to Login</a>
        </div>
    </div>
</section>
</body>
</html>
