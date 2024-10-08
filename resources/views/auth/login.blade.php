<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Log In | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/images/favicon.ico">

    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100;300;400;700;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
        <link href="{{asset('admin_dashboard')}}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <link href="{{asset('admin_dashboard')}}/assets/css/app.min.css" rel="stylesheet" type="text/css" id="light-style" />
        {{-- <link href="{{asset('admin_dashboard')}}/assets/css/app-dark.min.css" rel="stylesheet" type="text/css" id="dark-style" /> --}}
    <style>
        * {
            -webkit-box-sizing: border-box;
            -moz-box-sizing: border-box;
            box-sizing: border-box;
        }

        body {
            font-family: "Muli-Regular";
            font-size: 14px;
            margin: 0;
            color: #999;
        }

        input,
        textarea,
        select,
        button {
            font-family: "Muli-Regular";
        }

        p,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        ul {
            margin: 0;
        }

        img {
            max-width: 100%;
        }

        ul {
            padding-left: 0;
            margin-bottom: 0;
        }

        a {
            text-decoration: none;
        }

        :focus {
            outline: none;
        }

        .wrapper {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f6f7fc;
        }
        .inner {
            position: relative;
            width: 435px;
        }

        .image-1 {
            position: absolute;
            bottom: -12px;
            left: -191px;
            z-index: 99;
        }

        .image-2 {
            position: absolute;
            bottom: 0;
            right: -129px;
        }

        form {
            width: 100%;
            position: relative;
            z-index: 9;
            padding: 77px 61px 66px;
            background: #fff;
            box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
            -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
            -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
            -ms-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
            -o-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
        }

        h3 {
            text-transform: uppercase;
            font-size: 25px;
            font-family: "Muli-SemiBold";
            color: #333;
            letter-spacing: 3px;
            text-align: center;
            margin-bottom: 33px;
        }

        .form-holder {
            position: relative;
            margin-bottom: 21px;
        }

        .form-holder span {
            position: absolute;
            left: 0;
            top: 50%;
            transform: translateY(-50%);
            font-size: 15px;
            color: #333;
        }

        .form-holder span.lnr-lock {
            left: 2px;
        }

        .form-control {
            border: none;
            border-bottom: 1px solid #e6e6e6;
            display: block;
            width: 100%;
            height: 38px;
            background: none;
            padding: 3px 42px 0px;
            color: #666;
            font-family: "Muli-SemiBold";
            font-size: 16px;
        }

        .form-control::-webkit-input-placeholder {
            font-size: 14px;
            font-family: "Muli-Regular";
            color: #999;
            transform: translateY(1px);
        }

        .form-control::-moz-placeholder {
            font-size: 14px;
            font-family: "Muli-Regular";
            color: #999;
            transform: translateY(1px);
        }

        .form-control:-ms-input-placeholder {
            font-size: 14px;
            font-family: "Muli-Regular";
            color: #999;
            transform: translateY(1px);
        }

        .form-control:-moz-placeholder {
            font-size: 14px;
            font-family: "Muli-Regular";
            color: #999;
            transform: translateY(1px);
        }

        .form-control:focus {
            border-bottom: 1px solid #accffe;
        }

        button {
            border: none;
            width: 100%;
            height: 49px;
            margin-top: 50px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            background: #99ccff;
            color: #fff;
            text-transform: uppercase;
            font-family: "Muli-SemiBold";
            font-size: 15px;
            letter-spacing: 2px;
            transition: all 0.5s;
            position: relative;
            overflow: hidden;
        }

        button span {
            position: relative;
            z-index: 2;
        }

        button:before,
        button:after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            background-color: rgba(52, 152, 253, 0.25);
            -webkit-transition: all 0.3s;
            -moz-transition: all 0.3s;
            -o-transition: all 0.3s;
            transition: all 0.3s;
            -webkit-transform: translate(-100%, 0);
            transform: translate(-100%, 0);
            -webkit-transition-timing-function: cubic-bezier(0.75, 0, 0.125, 1);
            transition-timing-function: cubic-bezier(0.75, 0, 0.125, 1);
        }

        button:after {
            -webkit-transition-delay: 0.2s;
            transition-delay: 0.2s;
        }

        button:hover:before,
        button:hover:after {
            -webkit-transform: translate(0, 0);
            transform: translate(0, 0);
        }

        @media (max-width: 991px) {
            .inner {
                width: 400px;
                left: 4%;
            }
        }

        @media (max-width: 767px) {
            .inner {
                width: 100%;
                left: 0;
            }

            .image-1,
            .image-2 {
                display: none;
            }

            form {
                padding: 35px;
                box-shadow: none;
                -webkit-box-shadow: none;
                -moz-box-shadow: none;
                -ms-box-shadow: none;
                -o-box-shadow: none;
            }

            .wrapper {
                background: none;
            }
        }

        /*# sourceMappingURL=style.css.map */
    </style>
</head>

<body>

    <div class="wrapper">
        <div class="inner">
            <img src="images/image-1.png" alt="" class="image-1">
            <form action="">
                <h3> Log In</h3>
                <div class="form-holder">
                    <span class="lnr lnr-user"></span>
                    <input type="text" class="form-control" placeholder="Username">
                </div>
                <div class="mb-2">
                    <div class="input-group flex-nowrap">
                        <span class="input-group-text" id="basic-addon1"><i class="mdi mdi-instagram text-warning"></i></span>
                        <input type="text" name="insta"
                        class="form-control @error('insta') is-invalid @enderror"
                         required>
                   
                    </div>
                </div>
                <div class="form-holder">
                    <span class="lnr lnr-envelope"></span>
                    <input type="text" class="form-control" placeholder="Mail">
                </div>
                <div class="form-holder">
                    <i class="bx bx-lock"></i>
                    <input type="password" class="form-control" placeholder="Password">
                </div>
                <div class="form-holder">
                    <span class="lnr lnr-lock"></span>
                    <input type="password" class="form-control" placeholder="Confirm Password">
                </div>
                <button>
                    <span>Register</span>
                </button>
            </form>
            <img src="images/image-2.png" alt="" class="image-2">
        </div>

    </div>
    <script>
        < script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity = "sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin = "anonymous" >
    </script>
    </script>
</body>

</html>
