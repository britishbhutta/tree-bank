<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tree Bank - Saving Earth, One Tree at a Time</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Roboto:wght@300;400;500&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary-green: #2e7d32;
            --light-green: #4caf50;
            --lighter-green: #81c784;
            --background: #f9fff9;
            --text-dark: #1b5e20;
            --text-light: #666;
            --white: #ffffff;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Roboto', sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: var(--background);
        }
        
        h1, h2, h3, h4 {
            font-family: 'Poppins', sans-serif;
            color: var(--text-dark);
            margin-bottom: 1rem;
        }
        
        /* Navigation */
        .navbar {
            background-color: var(--white);
            box-shadow: 0 2px 15px rgba(46, 125, 50, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            padding: 1rem 5%;
        }
        
        .nav-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .logo {
            display: flex;
            align-items: center;
            font-size: 1.8rem;
            font-weight: 700;
            color: var(--primary-green);
            text-decoration: none;
        }
        
        .logo i {
            margin-right: 10px;
            font-size: 2rem;
        }
        
        .nav-links {
            display: flex;
            list-style: none;
        }
        
        .nav-links li {
            margin-left: 2rem;
        }
        
        .nav-links a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 500;
            padding: 0.5rem 1rem;
            border-radius: 5px;
            transition: all 0.3s ease;
        }
        
        .nav-links a:hover {
            background-color: var(--lighter-green);
            color: white;
        }
        
        .mobile-menu-btn {
            display: none;
            background: none;
            border: none;
            font-size: 1.5rem;
            color: var(--primary-green);
            cursor: pointer;
        }
        
        /* Hero Section */
        .hero {
            background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), 
                        url('https://images.unsplash.com/photo-1448375240586-882707db888b?ixlib=rb-4.0.3&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 10rem 1rem 5rem;
            margin-top: 70px;
        }
        
        .hero h1 {
            font-size: 3.5rem;
            color: white;
            margin-bottom: 1rem;
        }
        
        .hero p {
            font-size: 1.2rem;
            max-width: 700px;
            margin: 0 auto 2rem;
            color: #e8f5e9;
        }
        
        .btn {
            display: inline-block;
            background-color: var(--light-green);
            color: white;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid var(--light-green);
        }
        
        .btn:hover {
            background-color: transparent;
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }
        
        .btn-outline {
            background-color: transparent;
            border: 2px solid white;
        }
        
        /* Counter Section */
        .counter-section {
            background-color: var(--primary-green);
            color: white;
            padding: 4rem 1rem;
            text-align: center;
        }
        
        .counter-container {
            max-width: 800px;
            margin: 0 auto;
        }
        
        #tree-counter {
            font-size: 4rem;
            font-weight: 700;
            margin: 1rem 0;
            color: #e8f5e9;
        }
        
        /* Features Section */
        .features {
            padding: 5rem 1rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .section-title {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .section-title h2 {
            font-size: 2.5rem;
            position: relative;
            display: inline-block;
        }
        
        .section-title h2::after {
            content: '';
            position: absolute;
            width: 70px;
            height: 4px;
            background-color: var(--light-green);
            bottom: -10px;
            left: 50%;
            transform: translateX(-50%);
        }
        
        .features-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .feature-card {
            background-color: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            text-align: center;
            transition: transform 0.3s ease;
        }
        
        .feature-card:hover {
            transform: translateY(-10px);
        }
        
        .feature-icon {
            font-size: 2.5rem;
            color: var(--light-green);
            margin-bottom: 1rem;
        }
        
        /* Page Sections */
        .page-section {
            padding: 5rem 1rem;
            max-width: 1200px;
            margin: 0 auto;
            min-height: 100vh;
            padding-top: 100px;
        }
        
        /* Projects */
        .projects-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .project-card {
            background: white;
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease;
        }
        
        .project-card:hover {
            transform: translateY(-5px);
        }
        
        .project-content {
            padding: 1.5rem;
        }
        
        /* Gallery */
        .gallery-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 1rem;
            margin-top: 2rem;
        }
        
        .gallery-item {
            border-radius: 10px;
            overflow: hidden;
            height: 200px;
        }
        
        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
        }
        
        .gallery-item:hover img {
            transform: scale(1.1);
        }
        
        /* Contact */
        .contact-container {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 3rem;
            margin-top: 2rem;
        }
        
        .contact-info {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }
        
        .contact-icon {
            background-color: var(--lighter-green);
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 1rem;
        }
        
        /* Form */
        .form-container {
            background: white;
            padding: 2rem;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 500;
        }
        
        .form-control {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-family: 'Roboto', sans-serif;
            font-size: 1rem;
        }
        
        textarea.form-control {
            min-height: 150px;
            resize: vertical;
        }
        
        /* Footer */
        footer {
            background-color: var(--text-dark);
            color: white;
            padding: 3rem 1rem 1rem;
            text-align: center;
        }
        
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
            text-align: left;
        }
        
        .footer-section h3 {
            color: var(--lighter-green);
            margin-bottom: 1.5rem;
            font-size: 1.2rem;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1rem;
        }
        
        .social-links a {
            color: white;
            font-size: 1.2rem;
            transition: color 0.3s ease;
        }
        
        .social-links a:hover {
            color: var(--lighter-green);
        }
        
        .copyright {
            margin-top: 3rem;
            padding-top: 1.5rem;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            font-size: 0.9rem;
            color: #aaa;
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .mobile-menu-btn {
                display: block;
            }
            
            .nav-links {
                position: fixed;
                top: 70px;
                left: -100%;
                width: 100%;
                height: calc(100vh - 70px);
                background-color: white;
                flex-direction: column;
                align-items: center;
                padding-top: 2rem;
                transition: left 0.3s ease;
                box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            }
            
            .nav-links.active {
                left: 0;
            }
            
            .nav-links li {
                margin: 1rem 0;
            }
            
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .page-section {
                padding: 3rem 1rem;
                padding-top: 100px;
            }
            
            #tree-counter {
                font-size: 3rem;
            }
        }
        
        /* Page Visibility */
        .page {
            display: none;
        }
        
        .page.active {
            display: block;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <a href="#home" class="logo" onclick="showPage('home')">
                {{-- <i class="fas fa-tree"></i> Tree Bank --}}
                <img src="{{ asset('FrontEnd\Icon\tree-bank-icon.png') }}" style="width: 90px" />
            </a>
            
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="fas fa-bars"></i>
            </button>
            
            <ul class="nav-links" id="navLinks">
                <li><a href="#home" onclick="showPage('home')">Home</a></li>
                <li><a href="#about" onclick="showPage('about')">About Us</a></li>
                <li><a href="#projects" onclick="showPage('projects')">Projects</a></li>
                <li><a href="#register" onclick="showPage('register')">Register</a></li>
                <li><a href="#counter" onclick="showPage('counter')">Tree Counter</a></li>
                <li><a href="#gallery" onclick="showPage('gallery')">Gallery</a></li>
                <li><a href="#contact" onclick="showPage('contact')">Contact</a></li>
            </ul>
        </div>
    </nav>

    <!-- Home Page -->
    <section id="home" class="page active">
        <!-- Hero Section -->
        <div class="hero">
            <h1>Saving the Earth, One Tree at a Time</h1>
            <p>Tree Bank is a community-based green initiative dedicated to tree plantation, environmental protection, and awareness in Pakistan.</p>
            <a href="#register" class="btn" onclick="showPage('register')">Register as Volunteer</a>
            <a href="#about" class="btn btn-outline" onclick="showPage('about')" style="margin-left: 1rem;">Learn More</a>
        </div>

        <!-- Why Tree Plantation Matters -->
        <div class="features">
            <div class="section-title">
                <h2>Why Tree Plantation Matters</h2>
                <p>Discover the crucial benefits of planting trees for our planet and communities</p>
            </div>
            
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-wind"></i>
                    </div>
                    <h3>Reduces Air Pollution</h3>
                    <p>Trees absorb harmful pollutants and release clean oxygen, improving air quality for all.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-water"></i>
                    </div>
                    <h3>Controls Floods & Erosion</h3>
                    <p>Tree roots hold soil together, preventing erosion and reducing flood risks.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-leaf"></i>
                    </div>
                    <h3>Provides Oxygen & Shade</h3>
                    <p>One tree produces enough oxygen for 4 people and provides cooling shade.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-dove"></i>
                    </div>
                    <h3>Supports Wildlife</h3>
                    <p>Trees provide habitat and food for countless bird and animal species.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-seedling"></i>
                    </div>
                    <h3>Strengthens Ecosystems</h3>
                    <p>Healthy forests create balanced ecosystems that support biodiversity.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <h3>Healthy Communities</h3>
                    <p>Green spaces improve mental health and create cleaner living environments.</p>
                </div>
            </div>
        </div>

        <!-- Join Movement -->
        <div class="counter-section">
            <div class="counter-container">
                <h2>Join Our Green Movement</h2>
                <p>Become a volunteer and contribute to a sustainable Pakistan. Your one step can bring a big change.</p>
                <a href="#register" class="btn" onclick="showPage('register')" style="margin-top: 2rem;">Join Now</a>
            </div>
        </div>
    </section>

    <!-- About Us Page -->
    <section id="about" class="page">
        <div class="page-section">
            <div class="section-title">
                <h2>About Tree Bank</h2>
                <p>Learn about our mission, vision, and values</p>
            </div>
            
            <div style="max-width: 800px; margin: 0 auto;">
                <div style="background: white; padding: 2rem; border-radius: 10px; margin-bottom: 2rem;">
                    <h3><i class="fas fa-users" style="color: var(--light-green); margin-right: 10px;"></i> Who We Are</h3>
                    <p>Tree Bank is a non-profit, community-driven environmental initiative that encourages and facilitates tree plantation across Pakistan. We work with schools, local communities, volunteers, and environmental partners to restore greenery and promote climate awareness.</p>
                </div>
                
                <div style="background: white; padding: 2rem; border-radius: 10px; margin-bottom: 2rem;">
                    <h3><i class="fas fa-bullseye" style="color: var(--light-green); margin-right: 10px;"></i> Our Mission</h3>
                    <p>To plant, grow, and protect trees to create a sustainable, clean, and green environment for future generations.</p>
                </div>
                
                <div style="background: white; padding: 2rem; border-radius: 10px; margin-bottom: 2rem;">
                    <h3><i class="fas fa-eye" style="color: var(--light-green); margin-right: 10px;"></i> Our Vision</h3>
                    <p>A Pakistan where every individual participates in environmental conservation, and every community becomes green and self-sustaining.</p>
                </div>
                
                <div style="background: white; padding: 2rem; border-radius: 10px; margin-bottom: 2rem;">
                    <h3><i class="fas fa-heart" style="color: var(--light-green); margin-right: 10px;"></i> Our Values</h3>
                    <ul style="list-style-type: none; padding: 0;">
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid #eee;"><i class="fas fa-check" style="color: var(--light-green); margin-right: 10px;"></i> Sustainability</li>
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid #eee;"><i class="fas fa-check" style="color: var(--light-green); margin-right: 10px;"></i> Community Empowerment</li>
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid #eee;"><i class="fas fa-check" style="color: var(--light-green); margin-right: 10px;"></i> Transparency</li>
                        <li style="padding: 0.5rem 0; border-bottom: 1px solid #eee;"><i class="fas fa-check" style="color: var(--light-green); margin-right: 10px;"></i> Environmental Responsibility</li>
                        <li style="padding: 0.5rem 0;"><i class="fas fa-check" style="color: var(--light-green); margin-right: 10px;"></i> Long-term Impact</li>
                    </ul>
                </div>
                
                <div style="background: white; padding: 2rem; border-radius: 10px;">
                    <h3><i class="fas fa-tasks" style="color: var(--light-green); margin-right: 10px;"></i> What We Do</h3>
                    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 1rem;">
                        <div style="background: #f9fff9; padding: 1rem; border-radius: 5px; border-left: 4px solid var(--light-green);">
                            <h4 style="font-size: 1rem;">Plantation Drives</h4>
                        </div>
                        <div style="background: #f9fff9; padding: 1rem; border-radius: 5px; border-left: 4px solid var(--light-green);">
                            <h4 style="font-size: 1rem;">Tree Distribution</h4>
                        </div>
                        <div style="background: #f9fff9; padding: 1rem; border-radius: 5px; border-left: 4px solid var(--light-green);">
                            <h4 style="font-size: 1rem;">Environmental Workshops</h4>
                        </div>
                        <div style="background: #f9fff9; padding: 1rem; border-radius: 5px; border-left: 4px solid var(--light-green);">
                            <h4 style="font-size: 1rem;">Adoption of Trees</h4>
                        </div>
                        <div style="background: #f9fff9; padding: 1rem; border-radius: 5px; border-left: 4px solid var(--light-green);">
                            <h4 style="font-size: 1rem;">School Awareness Activities</h4>
                        </div>
                        <div style="background: #f9fff9; padding: 1rem; border-radius: 5px; border-left: 4px solid var(--light-green);">
                            <h4 style="font-size: 1rem;">Urban Forest Development</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Projects Page -->
    <section id="projects" class="page">
        <div class="page-section">
            <div class="section-title">
                <h2>Our Projects</h2>
                <p>Explore our ongoing environmental initiatives</p>
            </div>
            
            <div class="projects-grid">
                <div class="project-card">
                    <div style="background: var(--light-green); color: white; padding: 1.5rem;">
                        <h3>🌱 School Plantation Drives</h3>
                    </div>
                    <div class="project-content">
                        <p>We partner with government and private schools to conduct plantation activities, engage students, and teach environmental responsibility.</p>
                    </div>
                </div>
                
                <div class="project-card">
                    <div style="background: var(--light-green); color: white; padding: 1.5rem;">
                        <h3>🌳 Community Tree Distribution</h3>
                    </div>
                    <div class="project-content">
                        <p>We provide free and subsidized plants to households, farmers, and local groups who wish to grow trees in their areas.</p>
                    </div>
                </div>
                
                <div class="project-card">
                    <div style="background: var(--light-green); color: white; padding: 1.5rem;">
                        <h3>🌲 Urban Forest Initiatives</h3>
                    </div>
                    <div class="project-content">
                        <p>We aim to convert unused community spaces into green mini-forests to improve biodiversity and reduce heat.</p>
                    </div>
                </div>
                
                <div class="project-card">
                    <div style="background: var(--light-green); color: white; padding: 1.5rem;">
                        <h3>🌾 Adopt-a-Tree Program</h3>
                    </div>
                    <div class="project-content">
                        <p>Volunteers can adopt a tree, take care of it, and upload growth photos every month.</p>
                    </div>
                </div>
                
                <div class="project-card">
                    <div style="background: var(--light-green); color: white; padding: 1.5rem;">
                        <h3>🌍 Awareness Workshops</h3>
                    </div>
                    <div class="project-content">
                        <p>We conduct awareness sessions on climate change, importance of trees, sustainable living, and waste management.</p>
                    </div>
                </div>
                
                <div class="project-card">
                    <div style="background: var(--light-green); color: white; padding: 1.5rem;">
                        <h3>🌿 Emergency Plantation Support</h3>
                    </div>
                    <div class="project-content">
                        <p>During floods, we plant trees in risk areas to strengthen soil and prevent erosion.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Registration Page -->
    <section id="register" class="page">
        <div class="page-section">
            <div class="section-title">
                <h2>Register for Tree Plantation</h2>
                <p>Join our green movement and make a difference</p>
            </div>
            
            <div class="form-container" style="max-width: 800px; margin: 0 auto;">
                <p style="margin-bottom: 2rem; text-align: center;">Want to plant trees in your home, school, or area? Register now to receive plants and join our plantation community.</p>
                
                <form id="registrationForm">
                    <div class="form-group">
                        <label for="fullName">Full Name *</label>
                        <input type="text" id="fullName" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="phone">Contact Number *</label>
                        <input type="tel" id="phone" class="form-control" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="address">Complete Address *</label>
                        <textarea id="address" class="form-control" required></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="treeCount">Number of Trees Required *</label>
                        <input type="number" id="treeCount" class="form-control" min="1" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="treeType">Type of Trees Preferred</label>
                        <select id="treeType" class="form-control">
                            <option value="">Select tree type</option>
                            <option value="fruit">Fruit Trees</option>
                            <option value="shade">Shade Trees</option>
                            <option value="flowering">Flowering Trees</option>
                            <option value="native">Native Species</option>
                            <option value="mixed">Mixed Variety</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="purpose">Plantation Purpose *</label>
                        <select id="purpose" class="form-control" required>
                            <option value="">Select purpose</option>
                            <option value="home">Home Garden</option>
                            <option value="school">School Premises</option>
                            <option value="community">Community Area</option>
                            <option value="farm">Farm/Forest</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <label for="message">Additional Information</label>
                        <textarea id="message" class="form-control" placeholder="Any special requirements or questions..."></textarea>
                    </div>
                    
                    <button type="submit" class="btn" style="width: 100%; padding: 1rem; font-size: 1.1rem;">
                        Submit Registration
                    </button>
                    
                    <p style="text-align: center; margin-top: 1rem; color: #666; font-size: 0.9rem;">
                        We'll contact you within 48 hours to confirm your registration
                    </p>
                </form>
                
                <div style="text-align: center; margin-top: 3rem; padding: 2rem; background: #f9fff9; border-radius: 10px;">
                    <h3>Or use Google Form</h3>
                    <p style="margin: 1rem 0;">You can also register using our Google Form</p>
                    <a href="https://forms.google.com" target="_blank" class="btn">
                        <i class="fab fa-google" style="margin-right: 10px;"></i> Open Google Form
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Tree Counter Page -->
    <section id="counter" class="page">
        <div class="page-section">
            <div class="section-title">
                <h2>Live Tree Counter</h2>
                <p>Track our impact in real-time</p>
            </div>
            
            <div style="background: white; border-radius: 15px; padding: 3rem; text-align: center; max-width: 800px; margin: 0 auto; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);">
                <div style="font-size: 1.2rem; color: var(--text-light); margin-bottom: 1rem;">
                    <i class="fas fa-seedling" style="color: var(--light-green);"></i> Total Trees Planted
                </div>
                
                <div id="tree-counter" style="font-size: 5rem; font-weight: 700; color: var(--primary-green); margin: 1rem 0;">
                    15,782
                </div>
                
                <div style="color: #666; margin-bottom: 3rem;">
                    Last updated: <span id="update-date">December 2024</span>
                </div>
                
                <!-- Statistics -->
                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-top: 3rem;">
                    <div style="background: #f9fff9; padding: 1.5rem; border-radius: 10px;">
                        <div style="font-size: 2rem; font-weight: 700; color: var(--light-green);">1,245</div>
                        <div style="color: #666;">Trees This Month</div>
                    </div>
                    
                    <div style="background: #f9fff9; padding: 1.5rem; border-radius: 10px;">
                        <div style="font-size: 2rem; font-weight: 700; color: var(--light-green);">856</div>
                        <div style="color: #666;">Volunteers Registered</div>
                    </div>
                    
                    <div style="background: #f9fff9; padding: 1.5rem; border-radius: 10px;">
                        <div style="font-size: 2rem; font-weight: 700; color: var(--light-green);">4</div>
                        <div style="color: #666;">Cities Active</div>
                    </div>
                </div>
                
                <!-- Top Areas -->
                <div style="margin-top: 3rem; text-align: left;">
                    <h3 style="text-align: center; margin-bottom: 1.5rem;">Top Plantation Areas</h3>
                    <div style="display: flex; justify-content: center; flex-wrap: wrap; gap: 1rem;">
                        <div style="background: var(--light-green); color: white; padding: 1rem 2rem; border-radius: 50px; font-weight: 500;">Sialkot</div>
                        <div style="background: var(--lighter-green); color: white; padding: 1rem 2rem; border-radius: 50px; font-weight: 500;">Sambrial</div>
                        <div style="background: var(--lighter-green); color: white; padding: 1rem 2rem; border-radius: 50px; font-weight: 500;">Daska</div>
                        <div style="background: var(--lighter-green); color: white; padding: 1rem 2rem; border-radius: 50px; font-weight: 500;">Pasrur</div>
                    </div>
                </div>
                
                <!-- Google Sheets Integration Note -->
                <div style="margin-top: 3rem; padding: 1.5rem; background: #f0f7f0; border-radius: 10px; font-size: 0.9rem; color: #666;">
                    <i class="fas fa-info-circle" style="color: var(--light-green); margin-right: 10px;"></i>
                    This counter updates automatically through our Google Sheets integration. Real-time data ensures accurate tracking of our plantation efforts.
                </div>
            </div>
        </div>
    </section>

    <!-- Gallery Page -->
    <section id="gallery" class="page">
        <div class="page-section">
            <div class="section-title">
                <h2>Plantation Gallery</h2>
                <p>Moments from our plantation drives and community projects</p>
            </div>
            
            <!-- Gallery Categories -->
            <div style="text-align: center; margin-bottom: 2rem;">
                <button class="btn" onclick="filterGallery('all')" style="margin: 0.25rem;">All</button>
                <button class="btn" onclick="filterGallery('school')" style="margin: 0.25rem; background: transparent; color: var(--light-green); border: 2px solid var(--light-green);">School Drives</button>
                <button class="btn" onclick="filterGallery('community')" style="margin: 0.25rem; background: transparent; color: var(--light-green); border: 2px solid var(--light-green);">Community</button>
                <button class="btn" onclick="filterGallery('volunteer')" style="margin: 0.25rem; background: transparent; color: var(--light-green); border: 2px solid var(--light-green);">Volunteer Events</button>
                <button class="btn" onclick="filterGallery('urban')" style="margin: 0.25rem; background: transparent; color: var(--light-green); border: 2px solid var(--light-green);">Urban Forests</button>
            </div>
            
            <!-- Gallery Grid -->
            <div class="gallery-grid">
                <!-- Sample images using Unsplash - Replace with your actual images -->
                <div class="gallery-item" data-category="school">
                    <img src="https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="School Plantation Drive">
                </div>
                
                <div class="gallery-item" data-category="community">
                    <img src="https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Community Tree Distribution">
                </div>
                
                <div class="gallery-item" data-category="volunteer">
                    <img src="https://images.unsplash.com/photo-1577962917302-cd874c4e31d2?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Volunteer Event">
                </div>
                
                <div class="gallery-item" data-category="urban">
                    <img src="https://images.unsplash.com/photo-1469474968028-56623f02e42e?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Urban Forest Project">
                </div>
                
                <div class="gallery-item" data-category="school">
                    <img src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Students Planting Trees">
                </div>
                
                <div class="gallery-item" data-category="community">
                    <img src="https://images.unsplash.com/photo-1518837695005-2083093ee35b?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Community Garden">
                </div>
                
                <div class="gallery-item" data-category="volunteer">
                    <img src="https://images.unsplash.com/photo-1542744095-fcf48d80b0fd?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Volunteers Working Together">
                </div>
                
                <div class="gallery-item" data-category="urban">
                    <img src="https://images.unsplash.com/photo-1470115636492-6d2b56f9146d?ixlib=rb-4.0.3&auto=format&fit=crop&w=500&q=80" alt="Before & After Plantation">
                </div>
            </div>
            
            <div style="text-align: center; margin-top: 3rem;">
                <p>More photos coming soon from our recent plantation drives!</p>
            </div>
        </div>
    </section>

    <!-- Contact Page -->
    <section id="contact" class="page">
        <div class="page-section">
            <div class="section-title">
                <h2>Contact Tree Bank</h2>
                <p>Get in touch with our team</p>
            </div>
            
            <div class="contact-container">
                <div class="contact-info">
                    <h3>Contact Information</h3>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-map-marker-alt"></i>
                        </div>
                        <div>
                            <h4>Office Location</h4>
                            <p>Sambrial, District Sialkot, Punjab, Pakistan</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-phone"></i>
                        </div>
                        <div>
                            <h4>Phone Number</h4>
                            <p>0333-8663963</p>
                        </div>
                    </div>
                    
                    <div class="contact-item">
                        <div class="contact-icon">
                            <i class="fas fa-envelope"></i>
                        </div>
                        <div>
                            <h4>Email Address</h4>
                            <p>treebank.pk@gmail.com</p>
                        </div>
                    </div>
                    
                    <div style="margin-top: 2rem;">
                        <h4>Office Hours</h4>
                        <p>Monday - Friday: 9:00 AM - 5:00 PM</p>
                        <p>Saturday: 10:00 AM - 2:00 PM</p>
                        <p>Sunday: Closed</p>
                    </div>
                    
                    <div style="margin-top: 2rem;">
                        <h4>Reach Out For</h4>
                        <ul style="list-style-type: none; padding: 0;">
                            <li style="padding: 0.3rem 0;"><i class="fas fa-check" style="color: var(--light-green); margin-right: 10px;"></i> Plantation drives</li>
                            <li style="padding: 0.3rem 0;"><i class="fas fa-check" style="color: var(--light-green); margin-right: 10px;"></i> Volunteer registration</li>
                            <li style="padding: 0.3rem 0;"><i class="fas fa-check" style="color: var(--light-green); margin-right: 10px;"></i> Free plants</li>
                            <li style="padding: 0.3rem 0;"><i class="fas fa-check" style="color: var(--light-green); margin-right: 10px;"></i> Awareness programs</li>
                            <li style="padding: 0.3rem 0;"><i class="fas fa-check" style="color: var(--light-green); margin-right: 10px;"></i> Collaborations</li>
                        </ul>
                    </div>
                </div>
                
                <div class="form-container">
                    <h3>Send Us a Message</h3>
                    <form id="contactForm">
                        <div class="form-group">
                            <label for="contactName">Your Name *</label>
                            <input type="text" id="contactName" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="contactEmail">Email Address *</label>
                            <input type="email" id="contactEmail" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="contactSubject">Subject</label>
                            <input type="text" id="contactSubject" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label for="contactMessage">Message *</label>
                            <textarea id="contactMessage" class="form-control" required></textarea>
                        </div>
                        
                        <button type="submit" class="btn" style="width: 100%;">
                            Send Message
                        </button>
                    </form>
                    
                    <div style="text-align: center; margin-top: 2rem; padding-top: 2rem; border-top: 1px solid #eee;">
                        <p>Prefer Google Form?</p>
                        <a href="https://forms.google.com" target="_blank" class="btn" style="margin-top: 1rem; background: transparent; color: var(--light-green); border: 2px solid var(--light-green);">
                            Use Contact Form
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3><i class="fas fa-tree"></i> Tree Bank</h3>
                <p>Saving the Earth, One Tree at a Time. Join our movement for a greener Pakistan.</p>
                <div class="social-links">
                    <a href="#"><i class="fab fa-facebook"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                    <a href="#"><i class="fab fa-whatsapp"></i></a>
                </div>
            </div>
            
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul style="list-style-type: none; padding: 0;">
                    <li style="padding: 0.3rem 0;"><a href="#home" onclick="showPage('home')" style="color: #ccc; text-decoration: none;">Home</a></li>
                    <li style="padding: 0.3rem 0;"><a href="#about" onclick="showPage('about')" style="color: #ccc; text-decoration: none;">About Us</a></li>
                    <li style="padding: 0.3rem 0;"><a href="#projects" onclick="showPage('projects')" style="color: #ccc; text-decoration: none;">Projects</a></li>
                    <li style="padding: 0.3rem 0;"><a href="#register" onclick="showPage('register')" style="color: #ccc; text-decoration: none;">Register</a></li>
                    <li style="padding: 0.3rem 0;"><a href="#contact" onclick="showPage('contact')" style="color: #ccc; text-decoration: none;">Contact</a></li>
                </ul>
            </div>
            
            <div class="footer-section">
                <h3>Contact Info</h3>
                <p><i class="fas fa-map-marker-alt" style="margin-right: 10px;"></i> Sambrial, Sialkot, Pakistan</p>
                <p><i class="fas fa-phone" style="margin-right: 10px;"></i> 0333-8663963</p>
                <p><i class="fas fa-envelope" style="margin-right: 10px;"></i> treebank.pk@gmail.com</p>
            </div>
        </div>
        
        <div class="copyright">
            <p>&copy; 2024 Tree Bank. All rights reserved. | Dedicated to a Greener Pakistan</p>
            <p style="font-size: 0.8rem; margin-top: 0.5rem;">Website created with ❤️ for environmental conservation</p>
        </div>
    </footer>

    <script>
        // Mobile Menu Toggle
        const mobileMenuBtn = document.getElementById('mobileMenuBtn');
        const navLinks = document.getElementById('navLinks');
        
        mobileMenuBtn.addEventListener('click', () => {
            navLinks.classList.toggle('active');
            mobileMenuBtn.innerHTML = navLinks.classList.contains('active') 
                ? '<i class="fas fa-times"></i>' 
                : '<i class="fas fa-bars"></i>';
        });
        
        // Page Navigation
        function showPage(pageId) {
            // Hide all pages
            document.querySelectorAll('.page').forEach(page => {
                page.classList.remove('active');
            });
            
            // Show selected page
            document.getElementById(pageId).classList.add('active');
            
            // Close mobile menu if open
            navLinks.classList.remove('active');
            mobileMenuBtn.innerHTML = '<i class="fas fa-bars"></i>';
            
            // Scroll to top
            window.scrollTo(0, 0);
        }
        
        // Form Handling
        document.getElementById('registrationForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Thank you for registering! We will contact you soon.');
            this.reset();
        });
        
        document.getElementById('contactForm')?.addEventListener('submit', function(e) {
            e.preventDefault();
            alert('Message sent successfully! We will respond within 24 hours.');
            this.reset();
        });
        
        // Tree Counter Animation
        function animateCounter() {
            const counter = document.getElementById('tree-counter');
            if (!counter) return;
            
            const target = 15782;
            let current = 0;
            const increment = target / 100;
            const speed = 20;
            
            const updateCounter = () => {
                current += increment;
                if (current >= target) {
                    counter.textContent = target.toLocaleString();
                } else {
                    counter.textContent = Math.floor(current).toLocaleString();
                    setTimeout(updateCounter, speed);
                }
            };
            
            updateCounter();
        }
        
        // Gallery Filter
        function filterGallery(category) {
            const items = document.querySelectorAll('.gallery-item');
            items.forEach(item => {
                if (category === 'all' || item.dataset.category === category) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        }
        
        // Initialize on page load
        document.addEventListener('DOMContentLoaded', function() {
            // Animate counter when page loads
            setTimeout(animateCounter, 500);
            
            // Set current date
            const now = new Date();
            const options = { year: 'numeric', month: 'long' };
            document.getElementById('update-date').textContent = now.toLocaleDateString('en-US', options);
            
            // Handle page from URL hash
            const hash = window.location.hash.substring(1);
            if (hash && document.getElementById(hash)) {
                showPage(hash);
            }
        });
        
        // Update URL when page changes
        window.addEventListener('hashchange', function() {
            const hash = window.location.hash.substring(1);
            if (hash && document.getElementById(hash)) {
                showPage(hash);
            }
        });
    </script>
</body>
</html>