// Landing Page JavaScript
document.addEventListener('DOMContentLoaded', function() {
    
    // Smooth Scrolling for Navigation Links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const offsetTop = target.offsetTop - 80;
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
            }
        });
    });

    // Navbar Scroll Effect
    const navbar = document.querySelector('.custom-navbar');
    let lastScroll = 0;
    
    window.addEventListener('scroll', function() {
        const currentScroll = window.pageYOffset;
        
        if (currentScroll > 50) {
            navbar.classList.add('scrolled');
        } else {
            navbar.classList.remove('scrolled');
        }
        
        lastScroll = currentScroll;
    });

    // Counter Animation Function
    function animateCounter(element, target, duration = 2000) {
        if (!element || isNaN(target) || target <= 0) return;
        
        const start = 0;
        const isDecimal = target % 1 !== 0;
        const startTime = Date.now();
        
        function updateCounter() {
            const elapsed = Date.now() - startTime;
            const progress = Math.min(elapsed / duration, 1);
            
            // Easing function for smooth animation
            const easeOutQuart = 1 - Math.pow(1 - progress, 4);
            const current = start + (target - start) * easeOutQuart;
            
            if (progress >= 1) {
                // Final value
                if (isDecimal) {
                    element.textContent = target.toFixed(1);
                } else {
                    element.textContent = Math.floor(target).toString();
                }
            } else {
                // Animated value
                if (isDecimal) {
                    element.textContent = current.toFixed(1);
                } else {
                    element.textContent = Math.floor(current).toString();
                }
                requestAnimationFrame(updateCounter);
            }
        }
        
        updateCounter();
    }

    // Initialize Counter Animation
    function startCounterAnimation() {
        const statNumbers = document.querySelectorAll('.stat-number[data-target]');
        
        statNumbers.forEach((stat) => {
            if (stat.classList.contains('counted')) return;
            
            const target = parseFloat(stat.getAttribute('data-target'));
            if (!isNaN(target) && target > 0) {
                // Check if element is in viewport
                const rect = stat.getBoundingClientRect();
                const isInView = rect.top < window.innerHeight && rect.bottom > 0;
                
                if (isInView) {
                    stat.classList.add('counted');
                    setTimeout(() => {
                        animateCounter(stat, target);
                    }, 200);
                }
            }
        });
    }

    // Intersection Observer for Counter Animation on Scroll
    const counterObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting && !entry.target.classList.contains('counted')) {
                const target = parseFloat(entry.target.getAttribute('data-target'));
                if (!isNaN(target) && target > 0) {
                    entry.target.classList.add('counted');
                    setTimeout(() => {
                        animateCounter(entry.target, target);
                    }, 200);
                }
            }
        });
    }, {
        threshold: 0.2,
        rootMargin: '0px'
    });

    // Setup observers and initial check
    function setupCounters() {
        const statNumbers = document.querySelectorAll('.stat-number[data-target]');
        statNumbers.forEach(stat => {
            counterObserver.observe(stat);
        });
        
        // Also check immediately for elements already in view
        startCounterAnimation();
    }

    // Initialize immediately
    setupCounters();
    
    // Also run after delays to ensure everything is loaded
    setTimeout(() => {
        setupCounters();
        startCounterAnimation();
    }, 500);
    
    setTimeout(() => {
        startCounterAnimation();
    }, 1500);
    
    // Also trigger on window load
    window.addEventListener('load', function() {
        setTimeout(startCounterAnimation, 300);
    });
    
    // Force trigger after 2 seconds regardless
    setTimeout(() => {
        const statNumbers = document.querySelectorAll('.stat-number[data-target]');
        statNumbers.forEach(stat => {
            if (!stat.classList.contains('counted')) {
                const target = parseFloat(stat.getAttribute('data-target'));
                if (!isNaN(target) && target > 0) {
                    stat.classList.add('counted');
                    animateCounter(stat, target);
                }
            }
        });
    }, 2000);

    // Fade in on scroll animation
    const fadeObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });

    // Observe all cards and sections
    document.querySelectorAll('.feature-card, .testimonial-card, .learning-card, .why-card, .pricing-card, .referral-card').forEach(card => {
        card.style.opacity = '0';
        card.style.transform = 'translateY(30px)';
        card.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        fadeObserver.observe(card);
    });

    // Referral Code Handler
    window.getReferralCode = function() {
        const email = document.getElementById('referral-email').value;
        const displayDiv = document.getElementById('referral-code-display');
        
        if (!email || !email.includes('@')) {
            displayDiv.innerHTML = '<div style="color: #ef4444; font-size: 0.9rem;">Please enter a valid email address</div>';
            displayDiv.style.display = 'block';
            return;
        }
        
        displayDiv.innerHTML = '<div style="color: #667eea;">Generating your referral code...</div>';
        displayDiv.style.display = 'block';
        
        const formData = new FormData();
        formData.append('action', 'get_referral_code');
        formData.append('email', email);
        
        fetch('referral_handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                displayDiv.innerHTML = `
                    <div style="margin-bottom: 0.5rem; font-size: 0.9rem; color: #10b981;">${data.message}</div>
                    <div style="font-size: 1.5rem; font-weight: 800; letter-spacing: 2px; color: #667eea;">${data.referral_code}</div>
                    <button onclick="copyReferralCode('${data.referral_code}')" style="margin-top: 0.75rem; padding: 0.5rem 1rem; background: #667eea; color: white; border: none; border-radius: 8px; cursor: pointer; font-weight: 600;">
                        <i class="fas fa-copy"></i> Copy Code
                    </button>
                `;
            } else {
                displayDiv.innerHTML = `<div style="color: #ef4444; font-size: 0.9rem;">${data.message}</div>`;
            }
        })
        .catch(error => {
            displayDiv.innerHTML = '<div style="color: #ef4444; font-size: 0.9rem;">Error generating referral code. Please try again.</div>';
        });
    };

    // Copy Referral Code
    window.copyReferralCode = function(code) {
        navigator.clipboard.writeText(code).then(function() {
            alert('Referral code copied to clipboard!');
        }, function() {
            // Fallback for older browsers
            const textArea = document.createElement('textarea');
            textArea.value = code;
            document.body.appendChild(textArea);
            textArea.select();
            document.execCommand('copy');
            document.body.removeChild(textArea);
            alert('Referral code copied to clipboard!');
        });
    };

    // Feedback Form Handler
    const feedbackForm = document.getElementById('feedback-form');
    if (feedbackForm) {
        feedbackForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(feedbackForm);
            const messageDiv = document.getElementById('feedback-message');
            
            messageDiv.style.display = 'none';
            messageDiv.className = 'feedback-message';
            
            fetch('feedback_handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    messageDiv.className = 'feedback-message success';
                    messageDiv.textContent = data.message;
                    messageDiv.style.display = 'block';
                    feedbackForm.reset();
                    
                    // Hide message after 5 seconds
                    setTimeout(() => {
                        messageDiv.style.display = 'none';
                    }, 5000);
                } else {
                    messageDiv.className = 'feedback-message error';
                    messageDiv.textContent = data.message;
                    messageDiv.style.display = 'block';
                }
            })
            .catch(error => {
                messageDiv.className = 'feedback-message error';
                messageDiv.textContent = 'Error submitting feedback. Please try again.';
                messageDiv.style.display = 'block';
            });
        });
    }

    // Add parallax effect to hero section
    window.addEventListener('scroll', function() {
        const scrolled = window.pageYOffset;
        const heroImage = document.querySelector('.hero-image-container');
        if (heroImage && scrolled < window.innerHeight) {
            heroImage.style.transform = `translateY(${scrolled * 0.5}px)`;
        }
    });

    // Button hover animations
    document.querySelectorAll('.btn-hero-primary, .btn-hero-secondary, .btn-pricing, .btn-referral-code, .btn-feedback-submit, .btn-footer-cta, .btn-referral-cta-1, .btn-referral-cta-2').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-5px) scale(1.05)';
        });
        
        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Card hover effects
    document.querySelectorAll('.feature-card, .testimonial-card, .learning-card, .why-card, .pricing-card, .referral-card').forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transition = 'all 0.3s ease';
        });
    });

    // Smooth reveal animation for sections
    const sectionObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1
    });

    document.querySelectorAll('section').forEach(section => {
        section.style.opacity = '0';
        section.style.transform = 'translateY(30px)';
        section.style.transition = 'opacity 0.8s ease, transform 0.8s ease';
        sectionObserver.observe(section);
    });

    // Initialize first section immediately
    const firstSection = document.querySelector('section');
    if (firstSection) {
        firstSection.style.opacity = '1';
        firstSection.style.transform = 'translateY(0)';
    }

});
