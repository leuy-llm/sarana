
<style>
    .close {
        color: white !important;
        opacity: 1 !important;
        text-shadow: none !important;
        border: none !important;
        outline: none !important;
        font-bold: 900 !important;
        font-family: "Coda", system-ui;

    }

    .modal-content h3 {
        font-family: "Coda", system-ui;
    }

    .form-control:focus {
        border-color: #a38354;
        box-shadow: none;
    }

    .modal-body .bottom {
        margin-bottom: -0.5rem;
    }
    .btn{
        font-family: "Coda", system-ui;
        }
        .invalid-feedback{
            margin-top: -1rem;
            margin-bottom: 1rem;
        }
        .form-row{
            font-family: "Coda", system-ui;
            display: flex;
            justify-content: space-between
        }
</style>
<div class="modal fade custom-modal @if ($errors->any()) show @endif" id="registerModal" style="z-index: 9999"
    tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false"
    @if ($errors->any()) style="display: block" @endif>
    {{-- <div id="modal-loading-spinner" class="" style="position: absolute; top: 50%; left: 50%; z-index: 10000; transform: translate(-50%, -50%); display: none;">
        <div class="spinner-border text-danger" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> --}}
    {{-- <div id="loading" style="display:none; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 10;">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> --}}
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center" style="background:#661f1f; text-align: center">
                <h3 class="modal-title text-white text-center" id="registerModalLabel">Sinaka Registration</h3>
                <button type="button" class=" border-0 close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Registration Form -->
                <form id="guestRegisterForm" method="POST" action="">
                    @csrf
                    <div class="bottom">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" value="{{ old('name') }}" class="form-control @error('name', 'registerErrors') is-invalid @enderror" id="name" name="name" required>
                        @error('name', 'registerErrors')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="bottom">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" value="{{ old('email') }}" class="form-control @error('email', 'registerErrors') is-invalid @enderror" id="email" name="email" required>
                        @error('email', 'registerErrors')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <div class="bottom">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="number" value="{{ old('mobile') }}" class="form-control @error('mobile', 'registerErrors') is-invalid @enderror" id="mobile" name="mobile" required>
                        @error('mobile', 'registerErrors')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    
                    <!-- Repeat similar structure for other fields in the registration form -->
                    
                    <div class="bottom">
                        <label for="address" style="" class="form-label">Address</label>
                        <input type="text" value="{{old('address')}}" class="form-control @error('address', 'registerErrors') is-invalid @enderror"
                            id="address" name="address">
                            @error('address', 'registerErrors')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="bottom">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password', 'registerErrors') is-invalid @enderror" id="password" name="password" required>
                        @error('password', 'registerErrors')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="bottom">
                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                        <input type="password"  class="form-control  @error('password_confirmation','registerErrors') is-invalid @enderror " id="password_confirmation"
                            name="password_confirmation" required>
                            @error('password_confirmation', 'registerErrors')
                                <span class="invalid-feedback">{{ $message }}</span>
                            @enderror
                    </div>
                    <div class="form-row">
                        <button type="submit" id="registerButton" class="btn btn-primary">Register</button>
                        <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#loginModal" >Do you already have an account?</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@include('auth.logins')
<script>
    // JavaScript to trigger modal reopening when there are validation errors
    $(document).ready(function() {
        // Show the registration modal if there are errors in the register form
        @if ($errors->registerErrors->any())
            $('#registerModal').modal('show');
        @endif

        // Show the login modal if there are errors in the login form
        @if ($errors->loginErrors->any())
            $('#loginModal').modal('show');
        @endif
    });

    

    

</script>
