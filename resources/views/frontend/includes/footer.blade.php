<style>
    .footer {
         /* background-color: #1a237e; */
         background: #1c2331;
         color: white;
         padding: 60px 0 30px;
     }
     
     .footer-content {
         margin-bottom: 30px;
     }
     
     .social-links a {
         transition: all 0.3s ease;
     }
     
     .social-links a:hover {
         transform: translateY(-3px);
         opacity: 0.8;
     }
     
     .useful-links, .contact-info {
         text-align: center;
     }
    
     
     .useful-links a {
         text-decoration: none;
         transition: color 0.3s ease;
         display: inline-block;
         font-family: 'Oswald', sans-serif;
         
     }
     
     .useful-links a:hover {
         color: #90caf9 !important;
     }
     
     .contact-info i {
         width: 30px;
         margin-right: 10px;
         color: white;
         
     }
     
     .contact-info p {
         display: flex;
         align-items: center;
         justify-content: center;
         margin: 8px 0;
         color: white;
         font-family: 'Oswald', sans-serif;
     }
     
     .logo-section img {
         max-width: 200px;
         margin-bottom: 20px;
     }
     
     .divider {
         border-top: 1px solid rgba(255, 255, 255, 0.1);
         margin: 30px 0;
     }

     .section-title {
         text-align: center;
         margin-bottom: 20px;
         font-family: 'Oswald', sans-serif;
     }
 </style>
<footer class="footer no-print">
 <div class="container">
     <div class="row footer-content">
         <!-- Logo and Social Media Section -->
         <div class="col-md-4 mb-4">
             <div class="logo-section">
                 @foreach ($settings as $data)
                     <img src="{{ asset('storage/' . $data->site_logo) }}" alt="Logo" class="mb-3">
                 @endforeach
             </div>
             <div class="social-section">
                 <div class="mb-3">
                     <span style="font-family: 'Oswald', sans-serif;">Get connected with us on social media:</span>
                 </div>
                 <div class="social-links">
                     <a href="" class="text-white me-4" style="margin-right: 10px;">
                         <i class="fab fa-facebook fa-lg" style="font-size: 1.5rem;"></i>
                     </a>
                     <a href="" class="text-white me-4" style="margin-right: 10px;">
                         <i class="fab fa-telegram fa-lg" style="font-size: 1.5rem;"></i>
                     </a>
                     <a href="" class="text-white me-4" style="margin-right: 10px;">
                         <i class="fab fa-instagram fa-lg" style="font-size: 1.5rem;"></i>
                     </a>
                     <a href="" class="text-white me-4" style="margin-right: 10px;">
                         <i class="fas fa-envelope fa-lg" style="font-size: 1.5rem;"></i>
                     </a>
                 </div>
             </div>
         </div>

         <!-- Useful Links Section -->
         <div class="col-md-4 mb-4">
             <div class="useful-links">
                 <h6 class="text-uppercase fw-bold text-white section-title">Useful links</h6>
                 <p><a href="#" class="text-white">Home</a></p>
                 <p><a href="#" class="text-white">Service</a></p>
                 <p><a href="#" class="text-white">Facilities</a></p>
                 <p><a href="#" class="text-white">Gallery</a></p>
                 <p><a href="#" class="text-white">Contact</a></p>
             </div>
         </div>

         <!-- Contact Section -->
         <div class="col-md-4 mb-4">
             <div class="contact-info">
                 <h6 class="text-uppercase fw-bold text-white section-title">Contact</h6>
                 @foreach ($contact as $contact)
                 <p>
                     <i class="fas fa-home"></i>
                     {{ $contact->address }}
                 </p>
                 <p>
                     <i class="fas fa-envelope text-white"></i>
                     {{ $contact->email }}
                 </p>
                 <p>
                     <i class="fas fa-phone"></i>
                     {{ $contact->pn1 }}
                 </p>
                 <p>
                     <i class="fas fa-phone"></i>
                     {{ $contact->pn2 }}
                 </p>
                 <p>
                     <i class="fas fa-phone"></i>
                     {{ $contact->pn3 }}
                 </p>
                 @endforeach
             </div>
         </div>
     </div>

     <div class="divider"></div>

     <!-- Copyright Section -->
     <div class="text-center">
         <p style="color: rgb(213, 156, 14);font-family: 'Oswald', sans-serif;">© 2025 Sinaka Angkor Hotel. All rights reserved.</p>
     </div>
 </div>
</footer>