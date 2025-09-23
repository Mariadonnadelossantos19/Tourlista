<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

   <!-- SEO Meta Tags -->
   <meta name="description" content="Tourism Live Inventory and Statistics of Tourist Arrivals - A comprehensive web-based system for analyzing and assessing tourist arrivals in MIMAROPA region">
   <meta name="author" content="Allan G. Acosta">
   <meta name="keywords" content="tourism, statistics, MIMAROPA, tourist arrivals, accommodation establishments, tourist attractions">

   <!-- OG Meta Tags for social media sharing -->
   <meta property="og:site_name" content="Tourism Live Inventory and Statistics of Tourist Arrivals">
   <meta property="og:site" content="https://tourlista.dostmimaropa.ph">
   <meta property="og:title" content="tourLISTA - Tourism Live-Inventory and Statistics of Tourist Arrivals">
   <meta property="og:description" content="A web-based information system features to analyze and assess tourist arrivals in MIMAROPA.">
   <meta property="og:image" content="https://tourlista.dostmimaropa.ph/assets/images/tourlista.png">
   <meta property="og:url" content="https://tourlista.dostmimaropa.ph">
   <meta property="og:type" content="website">

   <!-- Twitter Card Meta Tags -->
   <meta name="twitter:card" content="summary_large_image">
   <meta name="twitter:title" content="tourLISTA - Tourism Live-Inventory and Statistics of Tourist Arrivals">
   <meta name="twitter:description" content="A web-based information system features to analyze and assess tourist arrivals in MIMAROPA.">
   <meta name="twitter:image" content="https://tourlista.dostmimaropa.ph/assets/images/tourlista.png">

   <!-- Website Title -->
   <title>tourLISTA - Tourism Live-Inventory and Statistics of Tourist Arrivals</title>

   <!-- Performance and SEO Optimizations -->
   <link rel="canonical" href="https://tourlista.dostmimaropa.ph/">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <meta name="theme-color" content="#0aa9a4">
   <meta name="robots" content="index,follow">
   <meta name="format-detection" content="telephone=no">

   <!-- Critical CSS - Load fonts first for better performance -->
   <link href="https://fonts.googleapis.com/css?family=Raleway:400,400i,600,700,700i&display=swap" rel="stylesheet">
   
   <!-- Stylesheets with proper loading order -->
   <link href="assets/css/bootstrap.css" rel="stylesheet">
   <link href="assets/css/fontawesome-all.css" rel="stylesheet">
   <link href="assets/css/swiper.css" rel="stylesheet">
   <link href="assets/css/magnific-popup.css" rel="stylesheet">
   <link href="assets/css/styles.css" rel="stylesheet">
   
   <!-- Preload critical resources -->
   <link rel="preload" as="image" href="assets/images/header-teamwork.svg">
   <link rel="preload" as="image" href="assets/images/tourlista.png">

   <style>
      /* Enhanced visual polish and performance optimizations */
      .navbar-custom {
         transition: background-color 0.3s ease, box-shadow 0.3s ease;
         will-change: background-color, box-shadow;
      }
      .navbar-custom.scrolled {
         background: #0aa9a4;
         box-shadow: 0 6px 18px rgba(0,0,0,0.08);
      }
      
      /* Improved navbar layout and accessibility */
      .navbar-custom .navbar-collapse {
         justify-content: center;
      }
      .navbar-custom .navbar-nav {
         display: flex;
         align-items: center;
         gap: 28px;
      }
      .navbar-custom .nav-link {
         font-size: 1.05rem;
         padding: 0.5rem 0.75rem;
         font-weight: 600;
         letter-spacing: 0.2px;
         transition: color 0.2s ease;
      }
      .navbar-custom .nav-link:hover,
      .navbar-custom .nav-link:focus {
         color: #ffffff !important;
         text-decoration: none;
      }
      .navbar-custom .social-icons {
         margin-left: 32px;
         display: flex;
         gap: 10px;
      }
      
      /* Enhanced card interactions */
      .cards-1 .card,
      .cards-2 .card {
         transition: transform 0.2s ease, box-shadow 0.2s ease;
         will-change: transform, box-shadow;
      }
      .cards-1 .card:hover,
      .cards-2 .card:hover {
         transform: translateY(-6px);
         box-shadow: 0 20px 35px rgba(0,0,0,0.12);
      }
      
      /* Improved back-to-top button */
      .back-to-top {
         position: fixed;
         right: 16px;
         bottom: 16px;
         width: 48px;
         height: 48px;
         border-radius: 50%;
         background: #0aa9a4;
         color: #fff;
         display: none;
         align-items: center;
         justify-content: center;
         box-shadow: 0 8px 24px rgba(10,169,164,0.4);
         z-index: 999;
         border: none;
         cursor: pointer;
         transition: all 0.3s ease;
      }
      .back-to-top:hover {
         background: #088a85;
         transform: translateY(-2px);
      }
      .back-to-top.show {
         display: flex;
      }
      
      /* Enhanced button interactions */
      .btn-solid-lg {
         transition: transform 0.15s ease, box-shadow 0.15s ease;
      }
      .btn-solid-lg:hover {
         transform: translateY(-2px);
         box-shadow: 0 4px 12px rgba(0,0,0,0.15);
      }
      
      /* Focus indicators for accessibility */
      .nav-link:focus,
      .btn:focus,
      .back-to-top:focus {
         outline: 2px solid #ffffff;
         outline-offset: 2px;
      }
      
      /* Reduced motion support */
      @media (prefers-reduced-motion: reduce) {
         .navbar-custom,
         .cards-1 .card,
         .cards-2 .card,
         .btn-solid-lg,
         .back-to-top {
            transition: none;
         }
      }
   </style>

   <!-- Favicon with multiple sizes for better compatibility -->
   <link rel="icon" type="image/png" sizes="32x32" href="assets/images/tl.png">
   <link rel="apple-touch-icon" href="assets/images/tl.png">

   <!-- Global site tag (gtag.js) - Google Analytics with improved loading -->
   <script async src="https://www.googletagmanager.com/gtag/js?id=G-SS0DD608WQ"></script>
   <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-SS0DD608WQ', {
         'anonymize_ip': true,
         'cookie_flags': 'SameSite=None;Secure'
      });
   </script>

</head>
<body data-spy="scroll" data-target=".fixed-top">

    <!-- Preloader -->
	<div class="spinner-wrapper">
        <div class="spinner">
            <div class="bounce1"></div>
            <div class="bounce2"></div>
            <div class="bounce3"></div>
        </div>
    </div>
    <!-- end of preloader -->


   <!-- Navigation -->
   <nav class="navbar navbar-expand-lg navbar-dark navbar-custom fixed-top" role="navigation" aria-label="Main navigation">
      <!-- Image Logo with improved accessibility -->
      <div class="navbar-brand">
         <img src="assets/images/tourlista.png" height="75" width="190" alt="tourLISTA - Tourism Live-Inventory and Statistics of Tourist Arrivals" loading="lazy" decoding="async">
      </div>

      <!-- Mobile Menu Toggle Button with improved accessibility -->
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation menu">
         <span class="navbar-toggler-awesome fas fa-bars" aria-hidden="true"></span>
         <span class="navbar-toggler-awesome fas fa-times" aria-hidden="true"></span>
      </button>
      <!-- end of mobile menu toggle button -->

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
         <ul class="navbar-nav ml-auto" role="menubar">
            <li class="nav-item" role="none">
               <a class="nav-link page-scroll" href="#header" role="menuitem" aria-current="page">Home</a>
            </li>
            <li class="nav-item" role="none">
               <a class="nav-link page-scroll" href="#services" role="menuitem">Services</a>
            </li>
            <li class="nav-item" role="none">
               <a class="nav-link page-scroll" href="#features" role="menuitem">Features</a>
            </li>
            <li class="nav-item" role="none">
               <a class="nav-link page-scroll" href="#request" role="menuitem">Request</a>
            </li>
            <li class="nav-item" role="none">
               <a class="nav-link page-scroll" href="#contact" role="menuitem">Contact</a>
            </li>
         </ul>
         <div class="nav-item social-icons" role="complementary" aria-label="Social media links">
            <span class="fa-stack">
               <a href="https://www.facebook.com/groups/tourlista" aria-label="Visit our Facebook group" target="_blank" rel="noopener noreferrer">
                  <i class="fas fa-circle fa-stack-2x facebook" aria-hidden="true"></i>
                  <i class="fab fa-facebook-f fa-stack-1x" aria-hidden="true"></i>
               </a>
            </span>
            <span class="fa-stack">
               <a href="#your-link" aria-label="Follow us on Twitter" target="_blank" rel="noopener noreferrer">
                  <i class="fas fa-circle fa-stack-2x twitter" aria-hidden="true"></i>
                  <i class="fab fa-twitter fa-stack-1x" aria-hidden="true"></i>
               </a>
            </span>
         </div>
      </div>
   </nav> <!-- end of navbar -->
   <!-- end of navigation -->


   <!-- Header -->
   <header id="header" class="header" role="banner">
      <div class="header-content">
         <div class="container">
            <div class="row">
               <div class="col-lg-6">
                  <div class="text-container">
                     <h1><span class="turquoise">tourLISTA</span><br>Analyzing Tourism</h1>
                     <p class="p-large"><strong>TourLISTA</strong> or the <strong>T</strong>ourism <strong>L</strong>ive - <strong>I</strong>nventory and <strong>S</strong>tatistics of <strong>T</strong>ourist <strong>A</strong>rrivals
                     is a web-based tool for analyzing and assessing tourist arrivals, offering real-time updates,
                     advanced data visualization tools, and comprehensive inventory and statistics to empower tourism stakeholders.</p>
                     <a class="btn-solid-lg page-scroll" href="#services" role="button" aria-label="Discover our services">DISCOVER</a>
                  </div> <!-- end of text-container -->
               </div> <!-- end of col -->
               <div class="col-lg-6">
                  <div class="image-container">
                     <img class="img-fluid" src="assets/images/header-teamwork.svg" alt="Team collaboration illustration showing tourism data analysis" loading="lazy" decoding="async">
                  </div> <!-- end of image-container -->
               </div> <!-- end of col -->
            </div> <!-- end of row -->
         </div> <!-- end of container -->
      </div> <!-- end of header-content -->
   </header> <!-- end of header -->
   <!-- end of header -->
   <!-- Services -->
   <section id="services" class="cards-1" role="region" aria-labelledby="services-heading">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <h2 id="services-heading">Services and Operations</h2>
               <p class="p-heading p-large">Services and Operations of the tourLISTA Information System</p>
            </div> <!-- end of col -->
         </div> <!-- end of row -->
         <div class="row">
            <div class="col-lg-12">

               <!-- Card -->
               <article class="card" role="article">
                  <img class="card-image" src="assets/images/services-icon-1.svg" alt="Population analysis icon" loading="lazy" decoding="async">
                  <div class="card-body">
                     <h3 class="card-title">Analyzing Population</h3>
                     <p>Designed to evaluate the influx of visitors to AEs and TAs, the system provides comprehensive analysis of the tourist population.</p>
                  </div>
               </article>
               <!-- end of card -->

               <!-- Card -->
               <article class="card" role="article">
                  <img class="card-image" src="assets/images/services-icon-2.svg" alt="Operation assessment icon" loading="lazy" decoding="async">
                  <div class="card-body">
                     <h3 class="card-title">Assessing Operation</h3>
                     <p>TourLISTA streamlines reporting transactions by evaluating the daily encoding operations of accommodation establishments and tourist attractions.</p>
                  </div>
               </article>
               <!-- end of card -->

               <!-- Card -->
               <article class="card" role="article">
                  <img class="card-image" src="assets/images/services-icon-3.svg" alt="Tourism tracking icon" loading="lazy" decoding="async">
                  <div class="card-body">
                     <h3 class="card-title">Tracking Tourism</h3>
                     <p>By tracking the flow of tourism, government managers can identify priority areas for tourism development plans and projects.</p>
                  </div>
               </article>
               <!-- end of card -->

            </div> <!-- end of col -->
         </div> <!-- end of row -->
      </div> <!-- end of container -->
   </section> <!-- end of cards-1 -->
   <!-- end of services -->


   <!-- Details 1 -->
   <section class="basic-1" role="region" aria-labelledby="details-1-heading">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">
               <div class="text-container">
                  <h2 id="details-1-heading">Start populating your database NOW!</h2>
                  <p>TourLISTA's Content Management System enables users to encode, update, and populate tourism data with different access controls and privileges according to their respective user levels.</p>
                  <!--<a class="btn-solid-reg popup-with-move-anim" href="#details-lightbox-1">POPULATE</a>-->
               </div> <!-- end of text-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6">
               <div class="image-container">
                  <img class="img-fluid" src="assets/images/details-1-office-worker.svg" alt="Office worker using computer for data entry" loading="lazy" decoding="async">
               </div> <!-- end of image-container -->
            </div> <!-- end of col -->
         </div> <!-- end of row -->
      </div> <!-- end of container -->
   </section> <!-- end of basic-1 -->
   <!-- end of details 1 -->


   <!-- Details Lightbox 1 -->
   <div id="details-lightbox-1" class="lightbox-basic zoom-anim-dialog mfp-hide" role="dialog" aria-labelledby="lightbox-1-title" aria-hidden="true">
      <div class="container">
         <div class="row">
            <button title="Close (Esc)" type="button" class="mfp-close x-button" aria-label="Close dialog">×</button>
            <div class="col-lg-8">
               <div class="image-container">
                  <img src="assets/images/details-lightbox-2.svg" alt="Security module interface illustration" loading="lazy" decoding="async">
               </div> <!-- end of image-container -->
            </div> <!-- end of col -->
            <div class="col-lg-4">
               <h3 id="lightbox-1-title">Security Module</h3>
               <hr>
               <h4>Sign-in Features</h4>
               <p>The security module help this information system prevent possible cyber attack and/or hacking.</p>
               <ul class="list-unstyled li-space-lg" role="list">
                  <li class="media" role="listitem">
                     <i class="fas fa-check" aria-hidden="true"></i><div class="media-body">Identity Checker</div>
                  </li>
                  <li class="media" role="listitem">
                     <i class="fas fa-check" aria-hidden="true"></i><div class="media-body">Mobile Verification</div>
                  </li>
                  <li class="media" role="listitem">
                     <i class="fas fa-check" aria-hidden="true"></i><div class="media-body">Email Verification</div>
                  </li>
                  <li class="media" role="listitem">
                     <i class="fas fa-check" aria-hidden="true"></i><div class="media-body">Undefined Signin process</div>
                  </li>
                  <li class="media" role="listitem">
                     <i class="fas fa-check" aria-hidden="true"></i><div class="media-body">Auto-generated new Password</div>
                  </li>
               </ul>
               <a class="btn-solid-reg mfp-close page-scroll" href="#request" role="button">REQUEST</a> 
               <a class="btn-outline-reg mfp-close as-button" href="#screenshots" role="button">BACK</a>
            </div> <!-- end of col -->
         </div> <!-- end of row -->
      </div> <!-- end of container -->
   </div> <!-- end of lightbox-basic -->
   <!-- end of details lightbox 1 -->


   <!-- Details 2 -->
   <section class="basic-2" role="region" aria-labelledby="details-2-heading">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">
               <div class="image-container">
                  <img class="img-fluid" src="assets/images/details-2-office-team-work.svg" alt="Team collaboration for data updates illustration" loading="lazy" decoding="async">
               </div> <!-- end of image-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6">
               <div class="text-container">
                  <h2 id="details-2-heading">Update your tourism arrival data TODAY!</h2>
                  <p>Get started on updating your tourist arrival transactions at your accommodation establishment or tourist attraction today by clicking on the user-friendly "update" button.</p>
                  <!-- <a class="btn-solid-reg popup-with-move-anim" href="#details-lightbox-2">UPDATE</a> -->
               </div> <!-- end of text-container -->
            </div> <!-- end of col -->
         </div> <!-- end of row -->
      </div> <!-- end of container -->
   </section> <!-- end of basic-2 -->
   <!-- end of details 2 -->


   <!-- Details Lightbox 2 -->
   <div id="details-lightbox-2" class="lightbox-basic zoom-anim-dialog mfp-hide" role="dialog" aria-labelledby="lightbox-2-title" aria-hidden="true">
      <div class="container">
         <div class="row">
            <button title="Close (Esc)" type="button" class="mfp-close x-button" aria-label="Close dialog">×</button>
            <div class="col-lg-8">
               <div class="image-container">
                  <img src="assets/images/details-lightbox-2.svg" alt="Security module interface illustration" loading="lazy" decoding="async">
               </div> <!-- end of image-container -->
            </div> <!-- end of col -->
            <div class="col-lg-4">
               <h3 id="lightbox-2-title">Security Module</h3>
               <hr>
               <h4>Sign-in Features</h4>
               <p>The security module help this information system prevent possible cyber attack and/or hacking.</p>
               <ul class="list-unstyled li-space-lg" role="list">
                  <li class="media" role="listitem">
                     <i class="fas fa-check" aria-hidden="true"></i><div class="media-body">Identity Checker</div>
                  </li>
                  <li class="media" role="listitem">
                     <i class="fas fa-check" aria-hidden="true"></i><div class="media-body">Mobile Verification</div>
                  </li>
                  <li class="media" role="listitem">
                     <i class="fas fa-check" aria-hidden="true"></i><div class="media-body">Email Verification</div>
                  </li>
                  <li class="media" role="listitem">
                     <i class="fas fa-check" aria-hidden="true"></i><div class="media-body">Undefined Signin process</div>
                  </li>
                  <li class="media" role="listitem">
                     <i class="fas fa-check" aria-hidden="true"></i><div class="media-body">Auto-generated new Password</div>
                  </li>
               </ul>
               <a class="btn-solid-reg mfp-close page-scroll" href="#request" role="button">REQUEST</a> 
               <a class="btn-outline-reg mfp-close as-button" href="#screenshots" role="button">BACK</a>
            </div> <!-- end of col -->
         </div> <!-- end of row -->
      </div> <!-- end of container -->
   </div> <!-- end of lightbox-basic -->
   <!-- end of details lightbox 2 -->


   <!-- Features -->
   <section id="features" class="cards-2" role="region" aria-labelledby="features-heading">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <h2 id="features-heading">Public Features</h2>
               <p class="p-heading p-large">With just one click, discover, explore, and analyze accommodation establishments and tourism attractions with ease.</p>
            </div> <!-- end of col -->
         </div> <!-- end of row -->
         <div class="row">
            <div class="col-lg-12">

               <!-- Card-->
               <article class="card" role="article">
                  <div class="card-body">
                     <h3 class="card-title">SEARCH</h3>
                     <p class="card-subtitle">for accredited accommodation establishment</p>
                     <hr class="cell-divide-hr">
                     <div class="price">
                        <img src="assets/images/search.png" height="250" width="250" alt="Search functionality icon" loading="lazy" decoding="async">
                     </div>
                     <div class="button-wrapper">
                        <a class="btn-solid-reg page-scroll" target="_blank" rel="noopener noreferrer" href="#" role="button" aria-label="Launch search application">LAUNCH APP</a>
                     </div>
                  </div>
               </article> <!-- end of card -->

               <!-- Card-->
               <article class="card" role="article">
                  <div class="card-body">
                     <h3 class="card-title">EXPLORE</h3>
                     <p class="card-subtitle">the map for nearest attractions and establishments</p>
                     <hr class="cell-divide-hr">
                     <div class="price">
                        <img src="assets/images/map.png" height="250" width="250" alt="Map exploration icon" loading="lazy" decoding="async">
                     </div>
                     <div class="button-wrapper">
                        <a class="btn-solid-reg page-scroll" target="_blank" rel="noopener noreferrer" href="#" role="button" aria-label="Launch map exploration application">LAUNCH APP</a>
                     </div>
                  </div>
               </article> <!-- end of card -->

               <!-- Card-->
               <article class="card" role="article">
                  <div class="card-body">
                     <h3 class="card-title">ANALYZE</h3>
                     <p class="card-subtitle">tourism data in your place and learn new opportunities</p>
                     <hr class="cell-divide-hr">
                     <div class="price">
                        <img src="assets/images/analyze.png" height="250" width="250" alt="Data analysis icon" loading="lazy" decoding="async">
                     </div>
                     <div class="button-wrapper">
                        <a class="btn-solid-reg page-scroll" target="_blank" rel="noopener noreferrer" href="#" role="button" aria-label="Launch data analysis application">LAUNCH APP</a>
                     </div>
                  </div>
               </article> <!-- end of card -->

            </div> <!-- end of col -->
         </div> <!-- end of row -->
      </div> <!-- end of container -->
   </section> <!-- end of cards-2 -->
   <!-- end of features -->


   <!-- Request -->
   <section id="request" class="form-1" role="region" aria-labelledby="request-heading">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">
               <div class="text-container">
                  <h2 id="request-heading">Fill The Following Form To Have An Access</h2>
                  <p>Unleash the full potential of your tourism establishment or attraction with tourLISTA - the easy-to-use, feature-packed information system designed to take your business to the next level.</p>
                  <ul class="list-unstyled li-space-lg" role="list">
                     <li class="media" role="listitem">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        <div class="media-body"><strong class="blue">Search</strong> for the accredited accommodation establishment</div>
                     </li>
                     <li class="media" role="listitem">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        <div class="media-body"><strong class="blue">Explore</strong> for the nearest establishment and tourism attractions</div>
                     </li>
                     <li class="media" role="listitem">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        <div class="media-body"><strong class="blue">Analyze</strong> information and data related to tourism in your area</div>
                     </li>
                     <li class="media" role="listitem">
                        <i class="fas fa-check" aria-hidden="true"></i>
                        <div class="media-body"><strong class="blue">Generate</strong> report relevant to your planning and development</div>
                     </li>
                  </ul>
               </div> <!-- end of text-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6">

               <!-- Request Form -->
               <div class="form-container">
                  <form action="signin/crud/sendRequest.php" method="POST" role="form" aria-labelledby="request-heading" novalidate>
                     <div class="form-group">
                        <input type="text" class="form-control-input" id="rname" name="rname" required aria-describedby="rname-error" autocomplete="name">
                        <label class="label-control" for="rname">Full name</label>
                        <div class="help-block with-errors" id="rname-error"></div>
                     </div>
                     <div class="form-group">
                        <input type="email" class="form-control-input" id="remail" name="remail" required aria-describedby="remail-error" autocomplete="email">
                        <label class="label-control" for="remail">Email</label>
                        <div class="help-block with-errors" id="remail-error"></div>
                     </div>
                     <div class="form-group">
                        <input type="tel" class="form-control-input" id="rphone" name="rphone" required aria-describedby="rphone-error" autocomplete="tel">
                        <label class="label-control" for="rphone">Phone</label>
                        <div class="help-block with-errors" id="rphone-error"></div>
                     </div>
                     <div class="form-group">
                        <select class="form-control-select" id="ruser" name="ruser" required aria-describedby="ruser-error">
                           <option class="select-option" value="" disabled selected>I Am a...</option>
                           <option class="select-option" value="AE Coordinator">AE Coordinator</option>
                           <option class="select-option" value="TA Coordinator">TA Coordinator</option>
                           <option class="select-option" value="City/Mun User">Municipal/City Tourism Officer</option>
                           <option class="select-option" value="Provincial User">Provincial Tourism Officer</option>
                           <option class="select-option" value="Regional User">Regional User</option>
                        </select>
                        <div class="help-block with-errors" id="ruser-error"></div>
                     </div>
                     <div class="form-group checkbox">
                        <input type="checkbox" id="rterms" value="Agreed-to-Terms" name="rterms" required aria-describedby="rterms-error">
                        <label for="rterms">I agree with tourLISTA stated <a href="#" target="_blank" rel="noopener noreferrer">Privacy Policy</a> and <a href="#" target="_blank" rel="noopener noreferrer">Terms & Conditions</a></label>
                        <div class="help-block with-errors" id="rterms-error"></div>
                     </div>
                     <div class="form-group">
                        <button type="submit" class="form-control-submit-button" aria-describedby="rmsgSubmit">REQUEST ACCESS</button>
                     </div>
                     <div class="form-message">
                        <div id="rmsgSubmit" class="h3 text-center hidden" role="status" aria-live="polite"></div>
                     </div>
                  </form>
               </div> <!-- end of form-container -->
               <!-- end of request form -->

            </div> <!-- end of col -->
         </div> <!-- end of row -->
      </div> <!-- end of container -->
   </section> <!-- end of form-1 -->
   <!-- end of request -->


   <!-- Video -->
   <section class="basic-3" role="region" aria-labelledby="video-heading">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <h2 id="video-heading">Check Out The Video</h2>
            </div> <!-- end of col -->
         </div> <!-- end of row -->
         <div class="row">
            <div class="col-lg-12">

               <!-- Video Preview -->
               <div class="image-container">
                  <div class="video-wrapper">
                     <a class="popup-youtube" href="https://www.youtube.com/watch?v=W65oeuXAHMY" data-effect="fadeIn" aria-label="Play tourLISTA demonstration video">
                        <img class="img-fluid" src="assets/images/video-frame.svg" alt="Video thumbnail showing tourLISTA system demonstration" loading="lazy" decoding="async">
                        <span class="video-play-button" aria-hidden="true">
                           <span></span>
                        </span>
                     </a>
                  </div> <!-- end of video-wrapper -->
               </div> <!-- end of image-container -->
               <!-- end of video preview -->

               <p>This video will show you features and techniques how to use and generate data from the tourLISTA information system.</p>
            </div> <!-- end of col -->
         </div> <!-- end of row -->
      </div> <!-- end of container -->
   </section> <!-- end of basic-3 -->
   <!-- end of video -->


   <!-- Testimonials -->
   <section class="slider-2" role="region" aria-labelledby="testimonials-heading">
      <div class="container">
         <div class="row">
            <div class="col-lg-6">
               <div class="image-container">
                  <img class="img-fluid" src="assets/images/testimonials-2-men-talking.svg" alt="People discussing tourism documentation" loading="lazy" decoding="async">
               </div> <!-- end of image-container -->
            </div> <!-- end of col -->
            <div class="col-lg-6">
               <h2 id="testimonials-heading">Issuances</h2>

               <!-- Card Slider -->
               <div class="slider-container">
                  <div class="swiper-container card-slider" role="region" aria-label="Issuances carousel">
                     <div class="swiper-wrapper">

                        <!-- Slide -->
                        <div class="swiper-slide">
                           <article class="card" role="article">
                              <img class="card-image" src="assets/images/testimonial-1.svg" alt="Accomplishment reports icon" loading="lazy" decoding="async">
                              <div class="card-body">
                                 <p class="testimonial-text">Accomplishment Reports from the Tourist Attractions and Accommodation Establishments</p>
                                 <p class="testimonial-author">Accomplishment Reports</p>
                              </div>
                           </article>
                        </div> <!-- end of swiper-slide -->

                        <!-- Slide -->
                        <div class="swiper-slide">
                           <article class="card" role="article">
                              <img class="card-image" src="assets/images/testimonial-2.svg" alt="Memorandum circular icon" loading="lazy" decoding="async">
                              <div class="card-body">
                                 <p class="testimonial-text">Circulars related to the implementation of the TourLISTA and submission of accomplishment reports</p>
                                 <p class="testimonial-author">Memorandum Circular</p>
                              </div>
                           </article>
                        </div> <!-- end of swiper-slide -->

                        <!-- Slide -->
                        <div class="swiper-slide">
                           <article class="card" role="article">
                              <img class="card-image" src="assets/images/testimonial-3.svg" alt="Guidelines icon" loading="lazy" decoding="async">
                              <div class="card-body">
                                 <p class="testimonial-text">Policies, Guidelines and related regulation relative to the tourism management and implementation</p>
                                 <p class="testimonial-author">Guidelines</p>
                              </div>
                           </article>
                        </div> <!-- end of swiper-slide -->

                     </div> <!-- end of swiper-wrapper -->

                     <!-- Add Arrows -->
                     <button class="swiper-button-next" aria-label="Next slide"></button>
                     <button class="swiper-button-prev" aria-label="Previous slide"></button>
                     <!-- end of add arrows -->

                  </div> <!-- end of swiper-container -->
               </div> <!-- end of slider-container -->
               <!-- end of card slider -->

            </div> <!-- end of col -->
         </div> <!-- end of row -->
      </div> <!-- end of container -->
   </section> <!-- end of slider-2 -->
   <!-- end of testimonials -->


   <!-- About -->
   <section id="about" class="basic-4" role="region" aria-labelledby="about-heading">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <h2 id="about-heading">Agency Partnership</h2>
               <p class="p-heading p-large">Discover the two National Government Agencies behind the development of tourLISTA Information System and learn how their joint efforts are revolutionizing the tourism industry.</p>
            </div> <!-- end of col -->
         </div> <!-- end of row -->
         <div class="row">
            <div class="col-lg-12">

               <!-- Team Member -->
               <article class="team-member" role="article">
                  <div class="image-wrapper">
                     <img class="img-fluid" src="assets/images/dost1.png" alt="Department of Science and Technology logo" loading="lazy" decoding="async">
                  </div> <!-- end of image-wrapper -->
                  <p class="p-large"><strong>Department of Science and Technology</strong></p>
                  <div class="social-icons" role="complementary" aria-label="DOST social media links">
                     <span class="fa-stack">
                        <a href="#" aria-label="Visit DOST Facebook page" target="_blank" rel="noopener noreferrer">
                           <i class="fas fa-circle fa-stack-2x facebook" aria-hidden="true"></i>
                           <i class="fab fa-facebook-f fa-stack-1x" aria-hidden="true"></i>
                        </a>
                     </span>
                     <span class="fa-stack">
                        <a href="#" aria-label="Follow DOST on Twitter" target="_blank" rel="noopener noreferrer">
                           <i class="fas fa-circle fa-stack-2x twitter" aria-hidden="true"></i>
                           <i class="fab fa-twitter fa-stack-1x" aria-hidden="true"></i>
                        </a>
                     </span>
                  </div> <!-- end of social-icons -->
               </article> <!-- end of team-member -->

               <!-- Team Member -->
               <article class="team-member" role="article">
                  <div class="image-wrapper">
                     <img class="img-fluid" src="assets/images/dot1.png" alt="Department of Tourism logo" loading="lazy" decoding="async">
                  </div> <!-- end of image wrapper -->
                  <p class="p-large"><strong>Department of <br />Tourism</strong></p>
                  <div class="social-icons" role="complementary" aria-label="DOT social media links">
                     <span class="fa-stack">
                        <a href="#" aria-label="Visit DOT Facebook page" target="_blank" rel="noopener noreferrer">
                           <i class="fas fa-circle fa-stack-2x facebook" aria-hidden="true"></i>
                           <i class="fab fa-facebook-f fa-stack-1x" aria-hidden="true"></i>
                        </a>
                     </span>
                     <span class="fa-stack">
                        <a href="#" aria-label="Follow DOT on Twitter" target="_blank" rel="noopener noreferrer">
                           <i class="fas fa-circle fa-stack-2x twitter" aria-hidden="true"></i>
                           <i class="fab fa-twitter fa-stack-1x" aria-hidden="true"></i>
                        </a>
                     </span>
                  </div> <!-- end of social-icons -->
               </article> <!-- end of team-member -->

            </div> <!-- end of col -->
         </div> <!-- end of row -->
      </div> <!-- end of container -->
   </section> <!-- end of basic-4 -->
   <!-- end of about -->


   <!-- Contact -->
   <section id="contact" class="form-2" role="region" aria-labelledby="contact-heading">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <h2 id="contact-heading">Contact Information</h2>
               <ul class="list-unstyled li-space-lg" role="list">
                  <li class="address" role="listitem">Don't hesitate to give us a call or send us a contact form message</li>
                  <li role="listitem"><i class="fas fa-map-marker-alt" aria-hidden="true"></i>G/F 351 Sen. Gil Puyat Avenue, Makati City</li>
                  <li role="listitem"><i class="fas fa-phone" aria-hidden="true"></i><a class="turquoise" href="tel:+63284595200">(02) 845 95200</a></li>
                  <li role="listitem"><i class="fas fa-envelope" aria-hidden="true"></i><a class="turquoise" href="mailto:info@tourlista.dostmimaropa.ph">info@tourlista.dostmimaropa.ph</a></li>
               </ul>
            </div> <!-- end of col -->
         </div> <!-- end of row -->
         <div class="row">
            <div class="col-lg-6">
               <div class="map-responsive">
                  <iframe data-src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d6320865.830724669!2d117.17483731619066!3d12.879721336233456!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x331bd0dd7b9f2eeb%3A0x2389fc10c033d2c0!2sPhilippines!5e0!3m2!1sen!2sph!4v1685965012345!5m2!1sen!2sph" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen="" loading="lazy" title="Philippines map" aria-label="Interactive map showing Philippines location"></iframe>
               </div>
            </div> <!-- end of col -->
            <div class="col-lg-6">

               <!-- Contact Form -->
               <form id="contactForm" data-toggle="validator" data-focus="false" role="form" aria-labelledby="contact-heading" novalidate>
                  <div class="form-group">
                     <input type="text" class="form-control-input" id="cname" required aria-describedby="cname-error" autocomplete="name">
                     <label class="label-control" for="cname">Name</label>
                     <div class="help-block with-errors" id="cname-error"></div>
                  </div>
                  <div class="form-group">
                     <input type="email" class="form-control-input" id="cemail" required aria-describedby="cemail-error" autocomplete="email">
                     <label class="label-control" for="cemail">Email</label>
                     <div class="help-block with-errors" id="cemail-error"></div>
                  </div>
                  <div class="form-group">
                     <textarea class="form-control-textarea" id="cmessage" required aria-describedby="cmessage-error"></textarea>
                     <label class="label-control" for="cmessage">Your message</label>
                     <div class="help-block with-errors" id="cmessage-error"></div>
                  </div>
                  <div class="form-group checkbox">
                     <input type="checkbox" id="cterms" value="Agreed-to-Terms" required aria-describedby="cterms-error">
                     <label for="cterms">I have read and agree with tourLISTA stated <a href="privacy-policy.html" target="_blank" rel="noopener noreferrer">Privacy Policy</a> and <a href="terms-conditions.html" target="_blank" rel="noopener noreferrer">Terms Conditions</a></label>
                     <div class="help-block with-errors" id="cterms-error"></div>
                  </div>
                  <div class="form-group">
                     <button type="submit" class="form-control-submit-button" aria-describedby="cmsgSubmit">SUBMIT MESSAGE</button>
                  </div>
                  <div class="form-message">
                     <div id="cmsgSubmit" class="h3 text-center hidden" role="status" aria-live="polite"></div>
                  </div>
               </form>
               <!-- end of contact form -->

            </div> <!-- end of col -->
         </div> <!-- end of row -->
      </div> <!-- end of container -->
   </section> <!-- end of form-2 -->
   <!-- end of contact -->


   <!-- Footer -->
   <footer class="footer" role="contentinfo">
      <div class="container">
         <div class="row">
            <div class="col-md-4">
               <div class="footer-col">
                  <h4>About tourLISTA</h4>
                  <p>We really appreciate your help in sending us your feedback about this tourLISTA system.</p>
               </div>
            </div> <!-- end of col -->
            <div class="col-md-4">
               <div class="footer-col middle">
                  <h4>Important Links</h4>
                  <ul class="list-unstyled li-space-lg" role="list">
                     <li class="media" role="listitem">
                        <i class="fas fa-square" aria-hidden="true"></i>
                        <div class="media-body">Our MOA <a class="turquoise" href="#" target="_blank" rel="noopener noreferrer">Memorandum of Agreements</a></div>
                     </li>
                     <li class="media" role="listitem">
                        <i class="fas fa-square" aria-hidden="true"></i>
                        <div class="media-body">Read our <a class="turquoise" href="#" target="_blank" rel="noopener noreferrer">Terms of Reference</a></div>
                     </li>
                  </ul>
               </div>
            </div> <!-- end of col -->
            <div class="col-md-4">
               <div class="footer-col last">
                  <h4>Social Media</h4>
                  <div class="social-icons" role="complementary" aria-label="Social media links">
                     <span class="fa-stack">
                        <a href="#" aria-label="Visit our Facebook page" target="_blank" rel="noopener noreferrer">
                           <i class="fas fa-circle fa-stack-2x" aria-hidden="true"></i>
                           <i class="fab fa-facebook-f fa-stack-1x" aria-hidden="true"></i>
                        </a>
                     </span>
                     <span class="fa-stack">
                        <a href="#" aria-label="Follow us on Twitter" target="_blank" rel="noopener noreferrer">
                           <i class="fas fa-circle fa-stack-2x" aria-hidden="true"></i>
                           <i class="fab fa-twitter fa-stack-1x" aria-hidden="true"></i>
                        </a>
                     </span>
                  </div>
               </div>
            </div> <!-- end of col -->
         </div> <!-- end of row -->
      </div> <!-- end of container -->
   </footer> <!-- end of footer -->
   <!-- end of footer -->


   <!-- Copyright -->
   <div class="copyright" role="contentinfo">
      <div class="container">
         <div class="row">
            <div class="col-lg-12">
               <p class="p-small">Copyright © <?php echo date("Y"); ?> DOST-MIMAROPA by <a href="#" target="_blank" rel="noopener noreferrer">Management Information Systems Unit</a></p>
            </div> <!-- end of col -->
         </div> <!-- end of row -->
      </div> <!-- end of container -->
   </div> <!-- end of copyright -->
   <!-- end of copyright -->


   <!-- Scripts -->
   <script src="assets/js/jquery.min.js"></script> <!-- jQuery for Bootstrap's JavaScript plugins -->
   <script src="assets/js/popper.min.js"></script> <!-- Popper tooltip library for Bootstrap -->
   <script src="assets/js/bootstrap.min.js"></script> <!-- Bootstrap framework -->
   <script src="assets/js/jquery.easing.min.js"></script> <!-- jQuery Easing for smooth scrolling between anchors -->
   <script src="assets/js/swiper.min.js"></script> <!-- Swiper for image and text sliders -->
   <script src="assets/js/jquery.magnific-popup.js"></script> <!-- Magnific Popup for lightboxes -->
   <script src="assets/js/validator.min.js"></script> <!-- Validator.js - Bootstrap plugin that validates forms -->
   <script src="assets/js/scripts.js"></script> <!-- Custom scripts -->
   
   <script>
      // Enhanced navbar background on scroll with performance optimization
      (function(){
         const nav = document.querySelector('.navbar-custom');
         if (!nav) return;
         
         let ticking = false;
         function updateNavbar() {
            if (window.pageYOffset > 10) {
               nav.classList.add('scrolled');
            } else {
               nav.classList.remove('scrolled');
            }
            ticking = false;
         }
         
         function onScroll() {
            if (!ticking) {
               requestAnimationFrame(updateNavbar);
               ticking = true;
            }
         }
         
         window.addEventListener('scroll', onScroll, {passive: true});
         updateNavbar(); // Initial check
      })();

      // Enhanced lazy-load Google Map with error handling
      (function(){
         const iframe = document.querySelector('.map-responsive iframe');
         if (!iframe) return;
         
         // Fallback for browsers without IntersectionObserver
         if (!('IntersectionObserver' in window)) {
            if (iframe.dataset.src && !iframe.src) {
               iframe.src = iframe.dataset.src;
            }
            return;
         }
         
         const io = new IntersectionObserver(function(entries) {
            entries.forEach(function(entry) {
               if (entry.isIntersecting) {
                  if (iframe.dataset.src && !iframe.src) {
                     iframe.src = iframe.dataset.src;
                     iframe.removeAttribute('data-src');
                  }
                  io.disconnect();
               }
            });
         }, {
            rootMargin: '50px 0px',
            threshold: 0.1
         });
         
         io.observe(iframe);
      })();

      // Enhanced back-to-top button with keyboard support
      (function(){
         const btn = document.getElementById('toTop');
         if (!btn) return;
         
         let ticking = false;
         function updateButton() {
            if (window.pageYOffset > 400) {
               btn.classList.add('show');
               btn.setAttribute('aria-hidden', 'false');
            } else {
               btn.classList.remove('show');
               btn.setAttribute('aria-hidden', 'true');
            }
            ticking = false;
         }
         
         function onScroll() {
            if (!ticking) {
               requestAnimationFrame(updateButton);
               ticking = true;
            }
         }
         
         window.addEventListener('scroll', onScroll, {passive: true});
         
         btn.addEventListener('click', function() {
            window.scrollTo({
               top: 0,
               behavior: 'smooth'
            });
         });
         
         // Keyboard support
         btn.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' || e.key === ' ') {
               e.preventDefault();
               btn.click();
            }
         });
         
         updateButton(); // Initial check
      })();

      // Enhanced form validation with better error handling
      (function(){
         const forms = document.querySelectorAll('form[novalidate]');
         forms.forEach(function(form) {
            form.addEventListener('submit', function(e) {
               if (!form.checkValidity()) {
                  e.preventDefault();
                  e.stopPropagation();
                  
                  // Focus first invalid field
                  const firstInvalid = form.querySelector(':invalid');
                  if (firstInvalid) {
                     firstInvalid.focus();
                  }
               }
               form.classList.add('was-validated');
            });
         });
      })();

      // Enhanced accessibility for lightboxes
      (function(){
         const lightboxes = document.querySelectorAll('[role="dialog"]');
         lightboxes.forEach(function(lightbox) {
            const closeBtn = lightbox.querySelector('.mfp-close');
            if (closeBtn) {
               closeBtn.addEventListener('click', function() {
                  lightbox.setAttribute('aria-hidden', 'true');
               });
            }
         });
      })();
   </script>
   
   <button id="toTop" class="back-to-top" aria-label="Back to top" aria-hidden="true">
      <i class="fas fa-arrow-up" aria-hidden="true"></i>
   </button>
</body>
</html>
