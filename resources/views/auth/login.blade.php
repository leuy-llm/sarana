<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <title>Log In | Hyper - Responsive Bootstrap 5 Admin Dashboard</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <!-- App favicon -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Hanuman:wght@100;300;400;700;900&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
        rel="stylesheet">
    </style>
    <style>
        body {
            background: url('https://images.pexels.com/photos/3682238/pexels-photo-3682238.jpeg?auto=compress&cs=tinysrgb&w=1260&h=750&dpr=1');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            /* font-family: 'Roboto', sans-serif; */
            font-family: "Hanuman", sans-serif;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100%;
            width: 100%;
        }

        form {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0px 5px 10px rgba(0, 0, 0, 0.1);
            padding: 30px 20px;
        }

        .input-group {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <section class="wrapper ">
        <div class="container">
            <div class="col-sm-8  offset-sm-2 col-lg-6  offset-lg-3 col-xl-4 offset-xl-4 text-center">
                <form action="{{ route('submit_login') }}" method="POST" class="rounded">
                    @csrf
                    <div class="logo mb-5">
                        <img src="https://www.sinakaangkorhotel.com/wp-content/uploads/2022/12/cropped-sinaka-logo-300x243.png"
                            style="width: 100px">
                    </div>
                     @if ($errors->any())
                        <div>
                            <ul class="list-none" style="list-style-type: none">
                                @foreach ($errors->all() as $error)
                                    <li class="list-none">{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <div class="input-group mb-4 mt-3">
                        <span class="input-group-text">
                            <i class='bx bx-user'></i>
                        </span>
                        <input type="text" name="name" value="{{ old('name') }}" required
                            class="form-control shadow-none form-control-lg fs-6" placeholder="Username">
                    </div>

                    <div class="input-group mb-4">
                        <span class="input-group-text">
                            <i class='bx bx-lock-alt'></i>
                        </span>
                        <input type="password" required name="password" class="form-control  shadow-none form-control-lg fs-6"
                            placeholder="Password">
                    </div>
                    <div class="input-group mb-4">
                        <div class="form-check">
                            <input type="checkbox" id="form-check-input  shadow-none" class="form-check-input">
                            <label for="form-check-input" class="form-check-label text-secondary"><small>Remember
                                    Me</small></label>
                        </div>
                    </div>
                    <button type="submit" class="btn w-100 shadow-none text-white mt-5" style="background: #e0962d">Log
                        In</button>
                </form>
            </div>
        </div>
    </section>
    <script>
        < script src = "https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity = "sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin = "anonymous" >
    </script>
    </script>
</body>

</html>
