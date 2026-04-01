<?php
require_once __DIR__ . '/../src/helpers.php';
startSession();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rehan School - Empowering Education with Innovation</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light fixed-top custom-navbar">
        <div class="container">
            <a class="navbar-brand" href="#home">
                <img src="../assets/img/rehan-logo.svg" alt="Rehan School" class="navbar-logo">
                <span class="brand-text">Rehan School</span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#home">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                    <li class="nav-item"><a class="nav-link" href="#features">Features</a></li>
                    <li class="nav-item"><a class="nav-link" href="#pricing">Pricing</a></li>
                    <li class="nav-item"><a class="nav-link" href="#referral">Referral</a></li>
                    <li class="nav-item"><a class="nav-link" href="#feedback">Feedback</a></li>
                    <li class="nav-item ms-2">
                        <a href="login.php" class="btn btn-outline-primary btn-sm">Login</a>
                    </li>
                    <li class="nav-item ms-2">
                        <a href="signup.php" class="btn btn-primary btn-sm">Sign Up</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="home" class="hero-section">
        <div class="animated-bg"></div>
        <div class="container">
            <div class="row align-items-center min-vh-100">
                <div class="col-lg-6 hero-content">
                    <h1 class="hero-title animate-fade-in">
                        Empowering Education<br>
                        <span class="gradient-text">with Innovation</span>
                    </h1>
                    <p class="hero-description animate-fade-in-delay">
                        Rehan School leverages cutting-edge modern technology to provide accessible, 
                        comprehensive, and innovative education management solutions for all students, 
                        teachers, and administrators. Our platform transforms traditional learning 
                        environments into dynamic, interactive ecosystems that foster academic excellence, 
                        personal growth, and professional development. Through AI-driven personalized 
                        learning paths, real-time progress tracking, and seamless collaboration tools, 
                        we empower educational institutions to deliver exceptional learning experiences 
                        that prepare students for success in an ever-evolving digital world.
                    </p>
                    <div class="hero-buttons animate-fade-in-delay-2">
                        <a href="#pricing" class="btn btn-hero-primary">
                            <span>Get Started</span>
                            <i class="fas fa-arrow-right"></i>
                        </a>
                        <a href="#forms" class="btn btn-hero-secondary">
                            <i class="fas fa-file-alt"></i>
                            <span>All Forms</span>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 hero-image-wrapper">
                    <div class="hero-image-container">
                        <img src="https://i.postimg.cc/zBCXp3Bm/Whats-App-Image-2020-10-02-at-8-28-08-AM-768x1024-removebg-preview.png" 
                             alt="Rehan School" class="hero-image">
                        <div class="floating-shapes">
                            <div class="shape shape-1"></div>
                            <div class="shape shape-2"></div>
                            <div class="shape shape-3"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About Our System -->
    <section id="about" class="about-section">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">About Our System</h2>
                <p class="section-subtitle">
                    Rehan School Management System is revolutionizing education through AI-driven learning programs, 
                    comprehensive management tools, and global accessibility. Our innovative platform combines 
                    artificial intelligence, cloud computing, and user-centric design to create an unparalleled 
                    educational experience that adapts to individual learning styles, streamlines administrative 
                    processes, and connects educational communities worldwide.
                </p>
            </div>
            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h3 class="feature-title">AI-Driven Learning</h3>
                        <p class="feature-description">
                            Experience personalized learning journeys powered by advanced artificial intelligence 
                            that adapts to each student's unique learning style, pace, and preferences. Our AI 
                            algorithms analyze learning patterns, identify strengths and areas for improvement, 
                            and deliver customized content recommendations, practice exercises, and assessment 
                            strategies that maximize comprehension and retention.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-globe"></i>
                        </div>
                        <h3 class="feature-title">Global Accessibility</h3>
                        <p class="feature-description">
                            Access the system from anywhere in the world, at any time, with our robust cloud-based 
                            platform designed for maximum accessibility and reliability. Whether you're a student 
                            studying from home, a teacher conducting remote classes, or an administrator managing 
                            multiple campuses, our platform ensures seamless connectivity, data synchronization, 
                            and uninterrupted access to all educational resources.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <h3 class="feature-title">Cost Effective</h3>
                        <p class="feature-description">
                            Comprehensive school management at a fraction of traditional costs, making quality 
                            education accessible to everyone. Our scalable pricing model eliminates expensive 
                            infrastructure investments, reduces administrative overhead, and provides enterprise-level 
                            features without enterprise-level pricing, ensuring that educational excellence is 
                            within reach for institutions of all sizes.
                        </p>
                    </div>
                </div>
            </div>
            <div class="stats-section mt-5">
                <div class="row g-4">
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon stat-icon-1">
                                <i class="fas fa-users"></i>
                            </div>
                            <div class="stat-number" data-target="1000">0</div>
                            <div class="stat-label">Students Enrolled</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon stat-icon-2">
                                <i class="fas fa-globe"></i>
                            </div>
                            <div class="stat-number" data-target="20">0</div>
                            <div class="stat-label">Countries Served</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon stat-icon-3">
                                <i class="fas fa-chart-line"></i>
                            </div>
                            <div class="stat-number" data-target="99.9">0</div>
                            <div class="stat-label">Success Rate</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="stat-card">
                            <div class="stat-icon stat-icon-4">
                                <i class="fas fa-award"></i>
                            </div>
                            <div class="stat-number" data-target="150">0</div>
                            <div class="stat-label">Businesses Started</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What Our Users Say -->
    <section id="testimonials" class="testimonials-section">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">What Our Users Say</h2>
                <p class="section-subtitle">
                    Hear from students, teachers, and administrators who have transformed their educational 
                    experience with our system. Discover how Rehan School Management System has revolutionized 
                    learning, teaching, and administrative processes across diverse educational institutions worldwide.
                </p>
            </div>
            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="testimonial-quote">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="testimonial-text">
                            "Rehan School Management System transformed our school's operations completely. 
                            The AI-driven features help us personalize learning for every student, while the 
                            comprehensive dashboard provides real-time insights into student progress, attendance, 
                            and performance. Our teachers love the intuitive interface, and our students are more 
                            engaged than ever before."
                        </p>
                        <div class="testimonial-author">
                            <div class="author-initials">SJ</div>
                            <div class="author-info">
                                <div class="author-name">Sarah Johnson</div>
                                <div class="author-role">Principal, Greenfield School</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="testimonial-quote">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="testimonial-text">
                            "As a teacher, the comprehensive dashboard and student management tools have made 
                            my job so much more efficient and effective. I can easily track assignments, monitor 
                            student progress, communicate with parents, and access all the resources I need in 
                            one centralized platform. The time-saving features allow me to focus more on teaching 
                            and less on administrative tasks."
                        </p>
                        <div class="testimonial-author">
                            <div class="author-initials">MT</div>
                            <div class="author-info">
                                <div class="author-name">Michael Thompson</div>
                                <div class="author-role">Mathematics Teacher</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="testimonial-card">
                        <div class="testimonial-quote">
                            <i class="fas fa-quote-left"></i>
                        </div>
                        <p class="testimonial-text">
                            "The parent portal gives me complete visibility into my child's progress. I can track 
                            assignments, grades, attendance, and communicate with teachers seamlessly. The real-time 
                            notifications keep me informed about important updates, and the detailed analytics help 
                            me understand my child's strengths and areas for improvement. It's an invaluable tool 
                            for staying involved in my child's education."
                        </p>
                        <div class="testimonial-author">
                            <div class="author-initials">AM</div>
                            <div class="author-info">
                                <div class="author-name">Aisha Mohammed</div>
                                <div class="author-role">Parent</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- What You'll Learn in Level 1 -->
    <section id="features" class="learning-section">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">What You'll Learn in Level 1</h2>
                <p class="section-subtitle">
                    Master the skills that will shape your future career. Our comprehensive Level 1 program 
                    provides a solid foundation in technical skills, personal development, and career preparation, 
                    setting you on the path to success in the digital age.
                </p>
            </div>
            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="learning-card">
                        <div class="learning-icon learning-icon-1">
                            <i class="fas fa-code"></i>
                        </div>
                        <h3 class="learning-title">Technical Skills</h3>
                        <p class="learning-description">
                            Learn <span class="highlight">graphic design</span>, <span class="highlight">coding</span>, 
                            <span class="highlight">programming</span> and <span class="highlight">web development</span> 
                            with hands-on projects and real-world applications. Our curriculum covers HTML5, CSS3, JavaScript, 
                            responsive design principles, UI/UX fundamentals, and modern development frameworks. You'll 
                            build practical projects that showcase your skills and create a professional portfolio that 
                            demonstrates your technical expertise to potential employers.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="learning-card">
                        <div class="learning-icon learning-icon-2">
                            <i class="fas fa-brain"></i>
                        </div>
                        <h3 class="learning-title">Confidence Building</h3>
                        <p class="learning-description">
                            Develop <span class="highlight">unshakeable confidence</span> through expert mentorship, 
                            public speaking workshops, and leadership training. Our confidence-building program includes 
                            presentation skills, communication techniques, networking strategies, and personal branding. 
                            You'll learn to articulate your ideas clearly, present with authority, and lead with conviction, 
                            preparing you for success in any professional environment.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="learning-card learning-card-featured">
                        <div class="learning-icon learning-icon-3">
                            <i class="fas fa-briefcase"></i>
                        </div>
                        <h3 class="learning-title">Career Opportunities</h3>
                        <p class="learning-description">
                            Get access to <span class="highlight">internships</span>, <span class="highlight">podcast earning 
                            opportunities</span>, and startup guidance to launch your career early. Our career development 
                            program connects you with industry professionals, provides internship placement assistance, 
                            offers mentorship from successful entrepreneurs, and guides you through the process of building 
                            your own startup or securing positions at leading tech companies.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Why Choose Our Level 1 Program -->
    <section class="why-choose-section">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Why Choose Our Level 1 Program?</h2>
                <p class="section-subtitle">
                    Designed specifically for students to excel in the digital age. Our comprehensive program 
                    combines structured learning, practical application, and career-focused training to ensure 
                    your success in today's competitive job market.
                </p>
            </div>
            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="why-card">
                        <div class="why-icon why-icon-1">
                            <i class="fas fa-graduation-cap"></i>
                        </div>
                        <h3 class="why-title">Structured Learning Path</h3>
                        <p class="why-description">
                            Complete <span class="highlight-blue">6 comprehensive levels</span> with flexible pace - 
                            <span class="highlight-blue">1 year for each level</span> to master skills thoroughly. 
                            Our structured curriculum ensures progressive skill development, with each level building 
                            upon the previous one. You'll have access to comprehensive learning materials, video tutorials, 
                            interactive exercises, and regular assessments to track your progress and ensure mastery 
                            of each concept before moving forward.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="why-card">
                        <div class="why-icon why-icon-2">
                            <i class="fas fa-tasks"></i>
                        </div>
                        <h3 class="why-title">Task Upload System</h3>
                        <p class="why-description">
                            Upload your assignments and projects directly through our portal. Get 
                            <span class="highlight-blue">personalized feedback</span> from expert mentors who review 
                            your work, provide constructive criticism, and offer actionable suggestions for improvement. 
                            Our feedback system includes detailed code reviews, design critiques, and performance 
                            evaluations that help you refine your skills and produce professional-quality work.
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="why-card">
                        <div class="why-icon why-icon-3">
                            <i class="fas fa-certificate"></i>
                        </div>
                        <h3 class="why-title">Certification & Portfolio</h3>
                        <p class="why-description">
                            Earn recognized certificates and build a professional portfolio that impresses employers 
                            and universities. Upon completion of each level, you'll receive industry-recognized 
                            certifications that validate your skills. Our portfolio-building program helps you create 
                            a stunning showcase of your work, including project case studies, code samples, design 
                            mockups, and client testimonials that demonstrate your expertise and professionalism.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Simple, Transparent Pricing -->
    <section id="pricing" class="pricing-section">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Simple, Transparent Pricing</h2>
                <p class="section-subtitle">
                    Invest in your future today with our flexible payment options. Choose the plan that best 
                    fits your learning goals and career aspirations. All plans include lifetime access to course 
                    materials and ongoing support from our expert team.
                </p>
            </div>
            <div class="row g-4 mt-5 justify-content-center">
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-card">
                        <div class="pricing-header pricing-header-basic">
                            <h3 class="pricing-tier">LEVEL 1 BASIC</h3>
                            <div class="pricing-price">
                                <span class="currency">PKR</span>
                                <span class="amount">30,000</span>
                            </div>
                            <p class="pricing-tagline">For Complete Level One Program</p>
                        </div>
                        <div class="pricing-body">
                            <ul class="pricing-features">
                                <li><i class="fas fa-check"></i> 2 Months Live Training</li>
                                <li><i class="fas fa-check"></i> Complete Self-Learning Material</li>
                                <li><i class="fas fa-check"></i> Live Zoom Group Sessions</li>
                                <li><i class="fas fa-check"></i> Personal Mentor Guidance</li>
                                <li><i class="fas fa-check"></i> Task Upload & Feedback System</li>
                                <li><i class="fas fa-check"></i> Peer Collaboration Platform</li>
                                <li><i class="fas fa-check"></i> Priority Technical Support</li>
                            </ul>
                            <a href="#pricing" class="btn btn-pricing btn-pricing-basic">
                                <i class="fas fa-shopping-cart"></i>
                                Enroll Now
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-card pricing-card-popular">
                        <div class="popular-badge">MOST POPULAR</div>
                        <div class="pricing-header pricing-header-premium">
                            <h3 class="pricing-tier">LEVEL 1 PREMIUM</h3>
                            <div class="pricing-price">
                                <span class="currency">PKR</span>
                                <span class="amount">200,000</span>
                            </div>
                            <p class="pricing-tagline">Complete Package with Advanced Features</p>
                        </div>
                        <div class="pricing-body">
                            <p class="pricing-includes">Everything in Basic Plus:</p>
                            <ul class="pricing-features">
                                <li><i class="fas fa-check"></i> App Development Masterclass</li>
                                <li><i class="fas fa-check"></i> Web Development Pro Course</li>
                                <li><i class="fas fa-check"></i> Startup Guidance & Mentorship</li>
                                <li><i class="fas fa-check"></i> 1-on-1 Expert Sessions</li>
                                <li><i class="fas fa-check"></i> Certification & Portfolio Building</li>
                                <li><i class="fas fa-check"></i> Internship Placement Assistance</li>
                                <li><i class="fas fa-check"></i> Lifetime Access to Updates</li>
                            </ul>
                            <a href="#pricing" class="btn btn-pricing btn-pricing-premium">
                                <i class="fas fa-crown"></i>
                                Get Premium
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="pricing-card">
                        <div class="pricing-header pricing-header-pro">
                            <h3 class="pricing-tier">LEVEL 1 PRO</h3>
                            <div class="pricing-price">
                                <span class="currency">PKR</span>
                                <span class="amount">500,000</span>
                            </div>
                            <p class="pricing-tagline">Elite Package for Serious Learners</p>
                        </div>
                        <div class="pricing-body">
                            <p class="pricing-includes">Everything in Premium Plus:</p>
                            <ul class="pricing-features">
                                <li><i class="fas fa-check"></i> AI & Machine Learning Course</li>
                                <li><i class="fas fa-check"></i> Blockchain Development</li>
                                <li><i class="fas fa-check"></i> Business Development Training</li>
                                <li><i class="fas fa-check"></i> Guaranteed Internship Placement</li>
                                <li><i class="fas fa-check"></i> Job Placement Assistance</li>
                                <li><i class="fas fa-check"></i> Startup Funding Guidance</li>
                                <li><i class="fas fa-check"></i> Exclusive Mastermind Group</li>
                            </ul>
                            <a href="#pricing" class="btn btn-pricing btn-pricing-pro">
                                <i class="fas fa-rocket"></i>
                                Go Pro
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Referral Rewards Program -->
    <section id="referral" class="referral-section">
        <div class="container">
            <div class="section-header text-center">
                <div class="referral-header-icon">
                    <i class="fas fa-gift"></i>
                </div>
                <h2 class="section-title">Referral Rewards Program</h2>
                <p class="section-subtitle">
                    Earn free weeks by inviting friends to join Rehan School. Share the gift of quality education 
                    and get rewarded for every successful referral. The more friends you refer, the more benefits 
                    you unlock!
                </p>
            </div>
            <div class="row g-4 mt-4">
                <div class="col-md-4">
                    <div class="referral-card">
                        <div class="referral-icon referral-icon-1">
                            <i class="fas fa-user-plus"></i>
                        </div>
                        <h3 class="referral-card-title">Get Your Referral Code</h3>
                        <p class="referral-card-description">
                            Sign up to receive your unique referral code that you can share with friends, family, 
                            and colleagues. Your referral code is your gateway to earning free weeks and exclusive 
                            rewards. Simply enter your email below to generate your personalized referral code.
                        </p>
                        <div class="referral-code-form">
                            <input type="email" id="referral-email" class="form-control" placeholder="Enter your email">
                            <button class="btn btn-referral-code" onclick="getReferralCode()">
                                <i class="fas fa-code"></i>
                                Get My Referral Code
                            </button>
                        </div>
                        <div id="referral-code-display" class="referral-code-display"></div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="referral-card">
                        <div class="referral-icon referral-icon-2">
                            <i class="fas fa-coins"></i>
                        </div>
                        <h3 class="referral-card-title">Earn Free Weeks</h3>
                        <p class="referral-card-description">
                            Each successful referral gives you <strong>+1 free week</strong> of access to premium features. 
                            The rewards keep growing with every friend you bring to Rehan School.
                        </p>
                        <ul class="referral-benefits">
                            <li><i class="fas fa-check-circle"></i> Friend joins: You get 1 week free</li>
                            <li><i class="fas fa-check-circle"></i> Friend gets 1 week free too</li>
                            <li><i class="fas fa-check-circle"></i> No limit on referrals!</li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="referral-card">
                        <div class="referral-icon referral-icon-3">
                            <i class="fas fa-trophy"></i>
                        </div>
                        <h3 class="referral-card-title">Big Bonus Rewards</h3>
                        <p class="referral-card-description">
                            Invite 8 friends and get <strong>2 months portal access FREE!</strong> Unlock exclusive 
                            rewards and recognition for being a top referrer.
                        </p>
                        <div class="special-achievement">
                            <div class="achievement-title">Special Achievement:</div>
                            <div class="achievement-description">
                                Top referrers get featured on our leaderboard and win exclusive prizes!
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="referral-cta mt-5">
                <a href="#pricing" class="btn btn-referral-cta-1">
                    <i class="fas fa-play"></i>
                    Join Live Classes
                </a>
                <a href="#pricing" class="btn btn-referral-cta-2">
                    <i class="fas fa-calendar-check"></i>
                    Get 7 Days Free Trial
                </a>
            </div>
        </div>
    </section>

    <!-- Share Your Feedback -->
    <section id="feedback" class="feedback-section">
        <div class="container">
            <div class="section-header text-center">
                <h2 class="section-title">Share Your Feedback</h2>
                <p class="section-subtitle">
                    We value your opinion! Help us improve by sharing your thoughts, suggestions, and experiences. 
                    Your feedback helps us enhance our platform and provide better services to our community.
                </p>
            </div>
            <div class="row justify-content-center mt-4">
                <div class="col-lg-8">
                    <div class="feedback-card">
                        <form id="feedback-form">
                            <div class="mb-3">
                                <label for="full_name" class="form-label">Full Name</label>
                                <input type="text" class="form-control" id="full_name" name="full_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="feedback_type" class="form-label">Feedback Type</label>
                                <select class="form-select" id="feedback_type" name="feedback_type" required>
                                    <option value="">Choose...</option>
                                    <option value="general">General Feedback</option>
                                    <option value="suggestion">Suggestion</option>
                                    <option value="bug_report">Bug Report</option>
                                    <option value="feature_request">Feature Request</option>
                                    <option value="complaint">Complaint</option>
                                    <option value="compliment">Compliment</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                            <div class="mb-4">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-feedback-submit">
                                <i class="fas fa-paper-plane"></i>
                                Submit Feedback
                            </button>
                            <div id="feedback-message" class="feedback-message mt-3"></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer CTA Section -->
    <section class="footer-cta-section">
        <div class="container">
            <div class="footer-cta-content">
                <h2 class="footer-cta-title">Ready to Transform Your School?</h2>
                <p class="footer-cta-description">
                    Join thousands of schools already using Rehan School Management System to streamline their 
                    operations and enhance learning outcomes. Experience the future of education management today.
                </p>
                <a href="#pricing" class="btn btn-footer-cta">
                    <i class="fas fa-rocket"></i>
                    Get Started Today
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h5 class="footer-title">Rehan School</h5>
                    <p class="footer-description">
                        Empowering education through innovative technology and comprehensive management solutions. 
                        We're committed to transforming the way educational institutions operate, teach, and learn.
                    </p>
                </div>
                <div class="col-md-4">
                    <h5 class="footer-title">Quick Links</h5>
                    <ul class="footer-links">
                        <li><a href="login.php">Login</a></li>
                        <li><a href="#forms">Forms</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#pricing">Pricing</a></li>
                        <li><a href="#referral">Referral Program</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5 class="footer-title">Contact</h5>
                    <p class="footer-contact">
                        <i class="fas fa-envelope"></i>
                        Email: info@rehanschool.com
                    </p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?php echo date('Y'); ?> Rehan School. All rights reserved.</p>
            </div>
        </div>
    </footer>    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../assets/js/app.js"></script>
    <script src="../assets/js/landing.js"></script>
</body>
</html>
