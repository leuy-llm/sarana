<!-- Bootstrap Registration Modal -->
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

    .btn {
        font-family: "Coda", system-ui;
    }

    .invalid-feedback {
        margin-top: -1rem;
        margin-bottom: 1rem;
    }
    
    .alert-danger{
        font-family: "Coda", system-ui;
        }
</style>
<div class="modal fade custom-modal @if ($errors->any()) show @endif" style="z-index: 9999" id="loginModal"
    tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false"
    @if ($errors->any()) style="display: block" @endif>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center " style="background:#661f1f;">
                {{-- <div style="display: flex; justify-content: space-between;align-items: center">
                    <img src="{{ asset('hotel') }}/image/woman.png" class="welcome-image" style="max-width: 50px;margin-top: 0px" >
                    <h3 class="modal-title text-white" style="margin:auto;" id="registerModalLabel">Sinaka Sign In</h3>
                </div> --}}
                <h3 class="modal-title text-white" id="registerModalLabel">Sinaka Sign In</h3>
                <button type="button" class=" border-0 close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Registration Form -->
                @if ($errors->loginErrors->has('login'))
                    <div class="alert text-center alert-danger">
                        {{ $errors->loginErrors->first('login') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('guest.login') }}">
                    @csrf
                    <div class="bottom">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email', 'loginErrors') is-invalid @enderror"
                            name="email" required>
                        @error('email', 'loginErrors')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="bottom">
                        <label for="password" class="form-label">Password</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password', 'loginErrors') is-invalid @enderror" name="password" id="password" required>
                            <div class="input-group-append">
                                <span class="input-group-text" id="togglePassword" style="cursor: pointer;">
                                    <i class="fas fa-eye" id="eyeIcon"></i>
                                </span>
                            </div>
                        </div>
                        
                        @error('password', 'loginErrors')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" id="loginButton" class="btn mt-3 px-4 btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // JavaScript to trigger modal reopening when there are validation errors
    // @if ($errors->any())
    //     $(document).ready(function() {
    //         $('#loginModal').modal('show');
    //     });
    // @endif

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
