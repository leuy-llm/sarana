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
    .btn{
        font-family: "Coda", system-ui;
        }
        .invalid-feedback{
            margin-top: -1rem;
            margin-bottom: 1rem;
        }
</style>
<div class="modal fade custom-modal @if ($errors->any()) show @endif" style="z-index: 9999" id="loginModal" 
    tabindex="-1" aria-labelledby="registerModalLabel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false"
    @if ($errors->any()) style="display: block" @endif>
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header text-center" style="background:#661f1f; text-align: center">
                <h3 class="modal-title text-white text-center" id="registerModalLabel">Sinaka Sign In</h3>
                <button type="button" class=" border-0 close text-white" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Registration Form -->
                <form id="guestRegisterForm" method="POST" action="{{ route('guest.login') }}">
                    @csrf
                    <div class="bottom" >
                        <label for="email" class="form-label">Email</label>
                        <input type="email"  class="form-control @error('email') is-invalid @enderror " id="email"
                            name="email" required>
                        @error('email')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                   
                    <div class="bottom">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror " id="password" name="password" required>
                        @error('password')
                            <span class="invalid-feedback">{{ $message }}</span>
                        @enderror
                    </div>
                    <button type="submit" class="btn mt-2 btn-primary">Login</button>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    // JavaScript to trigger modal reopening when there are validation errors
    @if ($errors->any())
        $(document).ready(function() {
            $('#loginModal').modal('show');
        });
    @endif

    

    
</script>
