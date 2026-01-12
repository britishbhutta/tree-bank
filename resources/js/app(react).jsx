import './bootstrap';
import { createRoot } from 'react-dom/client';
import '../css/custom.css';
import treeBankIcon from '../images/frontEnd/treeBankIcon.png';
import { BrowserRouter, Routes, Route, NavLink, Navigate } from 'react-router-dom';
import { Link } from 'react-router-dom';
import CountUp from "react-countup";
import { useState } from "react";
import Home1 from "./frontEnd/home1.jsx"
import Login from "./Pages/Auth/Login.jsx"
import Register from "./Pages/Auth/Register.jsx"

function Hero(props){
    return(
        <>
            <h2 className="text-[2.5rem] font-bold text-green-800 mt-14 text-center">
                {props.heroTitle}
            </h2>

            <div className="w-20 h-1 bg-green-600 mt-4 mb-2 rounded-full mx-auto"></div>

            <p className='text-center'>
                {props.HeroDescription}
            </p>
        </>
    );
}
function HomeCard(props){
    return(
        <>
            <div className="bg-white rounded-2xl p-8 text-center shadow-md border-t-2 hover:-translate-y-1 duration-150">
                <div className="text-green-600 text-4xl mb-4"><i className={`fas ${props.homeCardIcon} `}></i></div>
                <h3 className="text-xl font-semibold text-green-800 mb-3">
                    {props.homeCardTitle}
                </h3>
                <p className="text-gray-600">
                    {props.homeCardDescription}
                </p>
            </div>
        </>
    );
}
function ProjectCard(props){
    return(
            <>
                <div className="bg-white rounded-2xl shadow-md hover:-translate-y-1 transition-transform duration-500">
                    <div className="bg-[#4caf50] rounded-t-2xl px-6 py-4">
                        <h3 className="text-lg font-semibold text-white flex items-center justify-center gap-2">
                            {props.projectCardTitle}
                        </h3>
                    </div>
                    <div className="p-6 text-center">
                        <p className="text-gray-600 leading-relaxed">
                            {props.projectCardDescription}
                        </p>
                    </div>
                </div>
            </>
    )
}
function Footer() {
  return (
    <footer className="bg-[#1b5e20] text-white">
      <div className="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
        <div className="flex flex-col gap-4">
          <h3 className="font-bold text-xl flex items-center justify-center md:justify-start gap-2 text-[#81c784]">
            <i className="fas fa-tree"></i> Tree Bank
          </h3>
          <p>
            Saving the Earth, One Tree at a Time. Join our movement for a greener Pakistan.
          </p>
          <div className="flex justify-center md:justify-start gap-3 mt-2">
            <a href="#" className="hover:text-green-300"><i className="fab fa-facebook-f"></i></a>
            <a href="#" className="hover:text-green-300"><i className="fab fa-twitter"></i></a>
            <a href="#" className="hover:text-green-300"><i className="fab fa-instagram"></i></a>
            <a href="#" className="hover:text-green-300"><i className="fab fa-youtube"></i></a>
            <a href="#" className="hover:text-green-300"><i className="fab fa-whatsapp"></i></a>
          </div>
        </div>
        <div className="flex flex-col gap-2">
          <h3 className="font-bold text-xl mb-2 text-[#81c784]">Quick Links</h3>
          <ul className="space-y-1">
            <li><Link to="/home" className="hover:text-green-300">Home</Link></li>
            <li><Link to="/about" className="hover:text-green-300">About Us</Link></li>
            <li><Link to="/projects" className="hover:text-green-300">Projects</Link></li>
            <li><Link to="/register" className="hover:text-green-300">Register</Link></li>
            <li><Link to="/contact" className="hover:text-green-300">Contact</Link></li>
          </ul>
        </div>
        <div className="flex flex-col gap-2">
          <h3 className="font-bold text-xl mb-2 text-[#81c784]">Contact Info</h3>
          <p className="flex items-center gap-2">
            <i className="fas fa-map-marker-alt"></i> Sambrial, Sialkot, Pakistan
          </p>
          <p className="flex items-center gap-2">
            <i className="fas fa-phone"></i> 0333-8663963
          </p>
          <p className="flex items-center gap-2">
            <i className="fas fa-envelope"></i> treebank.pk@gmail.com
          </p>
        </div>
      </div>

      <div className="border-t border-green-900 text-center text-sm py-4 mt-2 text-gray-400">
        <p className='mt-3'>© 2024 Tree Bank. All rights reserved. | Dedicated to a Greener Pakistan</p>
        <p className='mt-3'>Website created with ❤️ for environmental conservation</p>
      </div>
    </footer>
  )
}
function Home() {
  return (
    <>
        <div className="bg-[url('/FrontEnd/Images/homeTree.png')] bg-cover bg-center h-96 flex flex-col items-center justify-center text-white text-center gap-4 px-6">
            <h1 className="text-4xl font-bold text-[3.5rem] mb-8">
                Saving the Earth, One Tree at a Time
            </h1>
            <p className="max-w-2xl text-[1.2rem]">
                Tree Bank is a community-based green initiative dedicated to tree plantation,
                environmental protection, and awareness in Pakistan.
            </p>
            <div className="flex gap-4 mt-4">
                <Link
                to="/register"
                className="bg-green-600 px-6 py-2 rounded-full border border-transparent font-semibold
                            hover:bg-transparent hover:border hover:border-green-600
                            transition duration-500 ease-out hover:-translate-y-1
                            h-12 flex items-center justify-center"
                >
                Register As Volunteer
                </Link>
                <Link
                to="/about"
                className="border border-white px-6 py-2 rounded-full font-semibold
                            transition duration-500 ease-out hover:-translate-y-1
                            h-12 flex items-center justify-center"
                >
                Learn More
                </Link>
            </div>
        </div>
        <section className="py-10">
            <Hero 
                heroTitle='Why Tree Plantation Matters' 
                HeroDescription = 'Discover the crucial benefits of planting trees for our planet and communities'
            />
            <div className="max-w-7xl mx-auto px-6 mt-10">
                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <HomeCard 
                        homeCardTitle = 'Reduces Air Pollution'
                        homeCardDescription = 'Trees absorb harmful pollutants and release clean oxygen, improving air quality for all.'
                        homeCardIcon = 'fa-wind'
                    />
                    <HomeCard 
                        homeCardTitle = 'Controls Floods & Erosion'
                        homeCardDescription = 'Tree roots hold soil together, preventing erosion and reducing flood risks.'
                        homeCardIcon = 'fa-water'
                    />
                    <HomeCard 
                        homeCardTitle = 'Provides Oxygen & Shade'
                        homeCardDescription = 'One tree produces enough oxygen for 4 people and provides cooling shade.'
                        homeCardIcon = 'fa-leaf'
                    />
                    <HomeCard 
                        homeCardTitle = 'Supports Wildlife'
                        homeCardDescription = 'Trees provide habitat and food for countless bird and animal species.'
                        homeCardIcon = 'fa-dove'
                    />
                    <HomeCard 
                        homeCardTitle = 'Strengthens Ecosystems'
                        homeCardDescription = 'Healthy forests create balanced ecosystems that support biodiversity.'
                        homeCardIcon = 'fa-seedling'
                    />
                    <HomeCard 
                        homeCardTitle = 'Healthy Communities'
                        homeCardDescription = 'Green spaces improve mental health and create cleaner living environments..'
                        homeCardIcon = 'fa-heart'
                    />
                </div>
            </div>
        </section>
        <div className="bg-[#2e7d32] bg-cover bg-center h-80 flex flex-col items-center justify-center text-white text-center gap-4 px-6">
            <h3 className="text-4xl font-bold text-[1.5rem] mb-2 text-green-900 mt-5">
                Join Our Green Movement
            </h3>
            <p className="max-w-5xl text-[1.2rem]">
                Become a volunteer and contribute to a sustainable Pakistan. Your one step can bring a big change.
            </p>
            <div className="flex gap-4 mt-4">
                <Link
                to="/register"
                className="bg-green-600 px-6 py-2 rounded-full border border-transparent font-semibold
                            hover:bg-transparent hover:border hover:border-green-600
                            transition duration-500 ease-out hover:-translate-y-1
                            h-12 flex items-center justify-center"
                >
                Join Now
                </Link>
            </div>
        </div>
        <Footer />
    </>
  );
}
function About() { 
    return( 
        <>
            <section className="py-10">
                <Hero 
                    heroTitle='About Tree Bank' 
                    HeroDescription = 'Learn about our Mission, Vision, and Values'
                />
                <div className="py-12 px-4">
                    <div className="max-w-3xl mx-auto space-y-12">
                        <div className="bg-white rounded-xl p-6 shadow-sm">
                            <div className="flex items-center gap-3 mb-3">
                                <i className="fas fa-users text-green-600"></i>
                                <h2 className="text-xl font-bold text-green-800">
                                    Who We Are
                                </h2>
                            </div>
                            <p className="leading-relaxed">
                                Tree Bank is a non-profit, community-driven environmental initiative that encourages and facilitates tree plantation across Pakistan. We work with schools, local communities, volunteers, and environmental partners to restore greenery and promote climate awareness.
                            </p>
                        </div>
                        <div className="bg-white rounded-xl p-6 shadow-sm">
                            <div className="flex items-center gap-3 mb-3">
                                <i className="fas fa-bullseye text-green-600"></i>
                                <h2 className="text-xl font-bold text-green-800">
                                    Our Mission
                                </h2>
                            </div>
                            <p className="leading-relaxed">
                                To plant, grow, and protect trees to create a sustainable, clean, and green environment for future generations.
                            </p>
                        </div>
                        <div className="bg-white rounded-xl p-6 shadow-sm">
                            <div className="flex items-center gap-3 mb-3">
                                <i className="fas fa-eye text-green-600"></i>
                                <h2 className="text-xl font-bold text-green-800">
                                    Our Vision
                                </h2>
                            </div>
                            <p className="leading-relaxed">
                                A Pakistan where every individual participates in environmental
                                conservation, and every community becomes green and self-sustaining.
                            </p>
                        </div>
                        <div className="bg-white rounded-xl p-6 shadow-sm">
                            <div className="flex items-center gap-3 mb-4">
                                <i className="fas fa-heart text-green-600"></i>
                                <h2 className="text-xl font-bold text-green-800">
                                    Our Values
                                </h2>
                            </div>
                            <ul className="divide-y">
                                {[
                                "Sustainability",
                                "Community Empowerment",
                                "Transparency",
                                "Environmental Responsibility",
                                "Long-term Impact",
                                ].map((value, index) => (
                                <li key={index} className="flex items-center gap-3 py-3">
                                    <i className="fas fa-check text-green-600"></i>
                                    <span className="text-gray-700">{value}</span>
                                </li>
                                ))}
                            </ul>
                        </div>
                        <div className="bg-white rounded-xl p-6 shadow-sm">
                            <div className="flex items-center gap-3 mb-6">
                                <i className="fas fa-tasks text-green-600"></i>
                                <h2 className="text-xl font-bold text-green-800">
                                What We Do
                                </h2>
                            </div>
                            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                                {[
                                "Plantation Drives",
                                "Tree Distribution",
                                "Environmental Workshops",
                                "Adoption of Trees",
                                "School Awareness Activities",
                                "Urban Forest Development",
                                ].map((item, index) => (
                                <div
                                    key={index}
                                    className="bg-[#F8FFF8] border-l-4 border-green-600 rounded-lg p-5 shadow-sm"
                                >
                                    <h3 className="font-semibold text-green-700">
                                    {item}
                                    </h3>
                                </div>
                                ))}
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <Footer />
        </>
    );
}
function Projects() {
    return (
                <>
                    <section className="py-10">
                        <Hero 
                            heroTitle='Our Projects' 
                            HeroDescription = 'Explore our ongoing environmental initiatives'
                        />
                        <div className="max-w-7xl mx-auto px-6 mt-10">
                            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                                <ProjectCard
                                    projectCardTitle = '🌱 School Plantation Drives'
                                    projectCardDescription= 'We partner with government and private schools to conduct plantation activities, engage students, and teach environmental responsibility.'
                                />
                                <ProjectCard
                                    projectCardTitle = '🌳 Community Tree Distribution'
                                    projectCardDescription= 'We provide free and subsidized plants to households, farmers, and local groups who wish to grow trees in their areas.'
                                />
                                <ProjectCard
                                    projectCardTitle = '🌲 Urban Forest Initiatives'
                                    projectCardDescription= 'We aim to convert unused community spaces into green mini-forests to improve biodiversity and reduce heat.'
                                />
                                <ProjectCard
                                    projectCardTitle = '🌾 Adopt-a-Tree Program'
                                    projectCardDescription= 'Volunteers can adopt a tree, take care of it, and upload growth photos every month.'
                                />
                                <ProjectCard
                                    projectCardTitle = '🌍 Awareness Workshops'
                                    projectCardDescription= 'We conduct awareness sessions on climate change, importance of trees, sustainable living, and waste management.'
                                />
                                <ProjectCard
                                    projectCardTitle = '🌿 Emergency Plantation Support'
                                    projectCardDescription= 'During floods, we plant trees in risk areas to strengthen soil and prevent erosion.'
                                />
                            </div>
                        </div>
                    </section>
                    <Footer />
                </>
            )
        }
function Register1() {
    return(
            <>
                <section className="py-10">
                    <Hero 
                        heroTitle='Register for Tree Plantation' 
                        HeroDescription = 'Join our green movement and make a difference'
                    />
                    <div className="py-10 px-4">
                        <div className="max-w-3xl mx-auto bg-white rounded-xl shadow-sm p-8">
                            <p className="text-center text-gray-700 mb-8">
                                Want to plant trees in your home, school, or area? Register now to
                                receive plants and join our plantation community.
                            </p>
                            <form className="space-y-6">
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">
                                    Full Name <span className="text-red-500">*</span>
                                    </label>
                                    <input
                                    type="text"
                                    className="w-full rounded-md border border-gray-300 px-4 py-2 focus:border-green-500 focus:ring-green-500"
                                    />
                                </div>
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">
                                    Contact Number <span className="text-red-500">*</span>
                                    </label>
                                    <input
                                    type="tel"
                                    className="w-full rounded-md border border-gray-300 px-4 py-2 focus:border-green-500 focus:ring-green-500"
                                    />
                                </div>
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">
                                    Complete Address <span className="text-red-500">*</span>
                                    </label>
                                    <textarea
                                    rows="3"
                                    className="w-full rounded-md border border-gray-300 px-4 py-2 focus:border-green-500 focus:ring-green-500"
                                    ></textarea>
                                </div>
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">
                                    Number of Trees Required <span className="text-red-500">*</span>
                                    </label>
                                    <input
                                    type="number"
                                    className="w-full rounded-md border border-gray-300 px-4 py-2 focus:border-green-500 focus:ring-green-500"
                                    />
                                </div>
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">
                                    Type of Trees Preferred
                                    </label>
                                    <select className="w-full rounded-md border border-gray-300 px-4 py-2 focus:border-green-500 focus:ring-green-500">
                                    <option>Select tree type</option>
                                    <option>Fruit Trees</option>
                                    <option>Shade Trees</option>
                                    <option>Medicinal Trees</option>
                                    <option>Ornamental Trees</option>
                                    </select>
                                </div>
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">
                                    Plantation Purpose <span className="text-red-500">*</span>
                                    </label>
                                    <select className="w-full rounded-md border border-gray-300 px-4 py-2 focus:border-green-500 focus:ring-green-500">
                                    <option>Select purpose</option>
                                    <option>Home</option>
                                    <option>School</option>
                                    <option>Community</option>
                                    <option>Commercial</option>
                                    </select>
                                </div>
                                <div>
                                    <label className="block text-sm font-medium text-gray-700 mb-1">
                                    Additional Information
                                    </label>
                                    <textarea
                                    rows="3"
                                    placeholder="Any special requirements or questions..."
                                    className="w-full rounded-md border border-gray-300 px-4 py-2 focus:border-green-500 focus:ring-green-500"
                                    ></textarea>
                                </div>
                                <div className="pt-4">
                                    <button
                                    type="submit"
                                    className="w-full bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 rounded-full transition h-14 hover:-translate-y-1"
                                    >
                                    Submit Request
                                    </button>
                                </div>
                            </form>
                            <p className='mt-3 flex justify-center'>We'll contact you within 48 hours to confirm your registration</p>
                            <h3 className='text-[1.5rem] font-bold flex justify-center text-green-800 mt-12'>Or use Google Form</h3>
                            <p className='mt-2 flex justify-center'>You can also register using our Google Form</p>
                            <div className='flex justify-center mt-6'>
                                <a
                                    href="https://forms.google.com" target="_blank" rel="noopener noreferrer"
                                    className="w-60 bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 rounded-full transition h-14 flex justify-center items-center hover:-translate-y-1">
                                    <i className="fab fa-google mr-2"></i>
                                    Open Google Form
                                </a>
                            </div>
                        </div>
                    </div>
                </section>
                <Footer />
            </>
        )
    }
function TreeCount() { 
    return(   
            <> 
                <section className="py-10">
                    <Hero 
                        heroTitle='Live Tree Counter' 
                        HeroDescription = 'Track our impact in real-time'
                    />
                    <div className="py-12 px-4">
                        <div className="max-w-4xl mx-auto bg-white rounded-2xl shadow-md p-8 text-center space-y-8">
                            <div className="space-y-2">
                            <div className="flex justify-center items-center gap-2 text-green-700 font-medium mb-4">
                                <i className="fas fa-seedling"></i> <span className='text-2xl'>Total Trees Planted</span>
                            </div>
                            <h2 className="text-8xl font-bold text-green-700">
                                 <CountUp end={15782} duration={2.5} separator="," />
                            </h2>
                            <div className='mt-4'>
                                <p className="text-sm text-gray-500 mt-5">
                                    Last updated: January 2026
                                </p>
                            </div>
                            </div>
                            <div className="grid grid-cols-1 sm:grid-cols-3 gap-6">
                            <div className="bg-[#F6FFF6] rounded-xl py-6">
                                <h3 className="text-2xl font-bold text-green-600">1,245</h3>
                                <p className="text-sm text-gray-600 mt-1">Trees This Month</p>
                            </div>

                            <div className="bg-[#F6FFF6] rounded-xl py-6">
                                <h3 className="text-2xl font-bold text-green-600">856</h3>
                                <p className="text-sm text-gray-600 mt-1">Volunteers Registered</p>
                            </div>

                            <div className="bg-[#F6FFF6] rounded-xl py-6">
                                <h3 className="text-2xl font-bold text-green-600">4</h3>
                                <p className="text-sm text-gray-600 mt-1">Cities Active</p>
                            </div>
                            </div>
                            <div className="space-y-4">
                            <h3 className="font-semibold text-green-700">
                                Top Plantation Areas
                            </h3>

                            <div className="flex flex-wrap justify-center gap-3">
                                <span className="bg-green-600 text-white px-5 py-2 rounded-full text-sm font-medium">
                                Sialkot
                                </span>
                                <span className="bg-green-300 text-white px-5 py-2 rounded-full text-sm font-medium">
                                Sambrial
                                </span>
                                <span className="bg-green-300 text-white px-5 py-2 rounded-full text-sm font-medium">
                                Daska
                                </span>
                                <span className="bg-green-300 text-white px-5 py-2 rounded-full text-sm font-medium">
                                Pasrur
                                </span>
                            </div>
                            </div>
                            <div className="bg-[#F1FAF1] rounded-xl px-6 py-4 text-sm text-gray-600 flex items-start gap-2">
                            <p>
                                <i className="fas fa-info-circle mr-2 text-green-600"></i>
                                This counter updates automatically through our Google Sheets
                                integration. Real-time data ensures accurate tracking of our
                                plantation efforts.
                            </p>
                            </div>

                        </div>
                    </div>
                </section>
                <Footer />
            </>
        )
     }
function Gallery() {
    const filters = [
            "All",
            "School Drives",
            "Community",
            "Volunteer Events",
            "Urban Forests",
            ];

            const photos = [
            {
                src: "/FrontEnd/Images/Gallery/1.jpg",
                category: "School Drives",
            },
            {
                src: "/FrontEnd/Images/Gallery/2.jpg",
                category: "School Drives",
            },
            {
                src: "/FrontEnd/Images/Gallery/3.jpg",
                category: "Community",
            },
            {
                src: "/FrontEnd/Images/Gallery/4.jpg",
                category: "Community",
            },
            {
                src: "/FrontEnd/Images/Gallery/5.jpg",
                category: "Volunteer Events",
            },
            {
                src: "/FrontEnd/Images/Gallery/6.jpg",
                category: "Volunteer Events",
            },
            {
                src: "/FrontEnd/Images/Gallery/7.jpg",
                category: "Urban Forests",
            },
            ];
            const [activeFilter, setActiveFilter] = useState("All");
            const filteredPhotos =
                activeFilter === "All"
                ? photos
            : photos.filter((photo) => photo.category === activeFilter);
    return(
            <>
                <section className="py-10">
                    <Hero 
                        heroTitle='Plantation Gallery' 
                        HeroDescription = 'Moments from our plantation drives and community projects'
                    />
                    <div className="flex flex-wrap justify-center gap-4 mb-10 mt-9">
                        {filters.map((filter) => (
                        <button
                            key={filter}
                            onClick={() => setActiveFilter(filter)}
                            className={`px-6 py-2 rounded-full border text-sm font-medium transition shadow-md hover:-translate-y-1
                            ${
                                activeFilter === filter
                                ? "bg-green-500 text-white border-green-500"
                                : "text-green-600 border-green-400"
                            }`}
                        >
                            {filter}
                        </button>
                        ))}
                    </div>
                    <div className="max-w-7xl mx-auto grid gap-6 sm:grid-cols-2 lg:grid-cols-4">
                        {filteredPhotos.map((photo, index) => (
                        <div
                            key={index}
                            className="overflow-hidden rounded-xl bg-white shadow-sm"
                        >
                            <img
                            src={photo.src}
                            alt={photo.category}
                            className="h-56 w-full object-cover transition-transform duration-300 hover:scale-105"
                            />
                        </div>
                        ))}
                    </div>
                    <p className="text-center text-gray-600 mt-12">
                        More photos coming soon from our recent plantation drives!
                    </p>
                </section>
                <Footer />
            </>
        )
    }
function Contact() {
    const [form, setForm] = useState({
        name: "",
        email: "",
        subject: "",
        message: "",
    });
    const [errors, setErrors] = useState({});
    const [success, setSuccess] = useState("");
    const [loading, setLoading] = useState(false);
    const validate = () => {
        let newErrors = {};
        if (!form.name.trim()) newErrors.name = "Name is required";
        else if (form.name.length < 3)
        newErrors.name = "Name must be at least 3 characters";
        if (!form.email.trim()) newErrors.email = "Email is required";
        else if (!/\S+@\S+\.\S+/.test(form.email))
        newErrors.email = "Invalid email format";
        if (!form.message.trim())
        newErrors.message = "Message is required";
        else if (form.message.length < 10)
        newErrors.message = "Message must be at least 10 characters";
        setErrors(newErrors);
        return Object.keys(newErrors).length === 0;
    };
    const handleChange = (e) => {
        setForm({ ...form, [e.target.name]: e.target.value });
    };
    const handleSubmit = async (e) => {
        e.preventDefault();
        setSuccess("");
        if (!validate()) return;
        setLoading(true);
        try {
        const csrfToken = document
            .querySelector('meta[name="csrf-token"]')
            .getAttribute("content");

        const response = await axios.post("/storeContactUs", form, {
            headers: {
            "X-CSRF-TOKEN": csrfToken,
            },
        });
        if (response.data.success) {
            setSuccess(response.data.message);
            setForm({ name: "", email: "", subject: "", message: "" });
            setErrors({});
        }
        } catch (error) {
        if (error.response?.status === 422) {
            setErrors(error.response.data.errors);
        }
        } finally {
        setLoading(false);
        }
    };
    return(
            <>
                <section className="py-10">
                    <Hero 
                        heroTitle='Contact Tree Bank' 
                        HeroDescription = 'Get in touch with our team'
                    />
                    <div className="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8">
                        <div className="bg-white rounded-2xl shadow-sm p-8 mt-9">
                            <h2 className="text-green-700 text-xl font-semibold mb-6">
                                Contact Information
                            </h2>

                            <div className="flex items-start gap-4 mb-5">
                                <div className="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                <i className="fas fa-map-marker-alt"></i>
                                </div>
                                <div>
                                <h4 className="font-semibold text-green-700">Office Location</h4>
                                <p className="text-gray-600 text-sm">
                                    Sambrial, District Sialkot, Punjab, Pakistan
                                </p>
                                </div>
                            </div>

                            <div className="flex items-start gap-4 mb-5">
                                <div className="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                <i className="fas fa-phone"></i>
                                </div>
                                <div>
                                <h4 className="font-semibold text-green-700">Phone Number</h4>
                                <p className="text-gray-600 text-sm">0333-8663963</p>
                                </div>
                            </div>

                            <div className="flex items-start gap-4 mb-8">
                                <div className="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center text-green-600">
                                <i className="fas fa-envelope"></i>
                                </div>
                                <div>
                                <h4 className="font-semibold text-green-700">Email Address</h4>
                                <p className="text-gray-600 text-sm">treebank.pk@gmail.com</p>
                                </div>
                            </div>

                            <div className="mb-8">
                                <h4 className="font-semibold text-green-700 mb-2">Office Hours</h4>
                                <p className="text-gray-600 text-sm">Monday - Friday: 9:00 AM - 5:00 PM</p>
                                <p className="text-gray-600 text-sm">Saturday: 10:00 AM - 2:00 PM</p>
                                <p className="text-gray-600 text-sm">Sunday: Closed</p>
                            </div>

                            <div>
                                <h4 className="font-semibold text-green-700 mb-3">Reach Out For</h4>
                                <ul className="space-y-2 text-sm text-gray-700">
                                <li className="flex items-center gap-2">✅ Plantation drives</li>
                                <li className="flex items-center gap-2">✅ Volunteer registration</li>
                                <li className="flex items-center gap-2">✅ Free plants</li>
                                <li className="flex items-center gap-2">✅ Awareness programs</li>
                                <li className="flex items-center gap-2">✅ Collaborations</li>
                                </ul>
                            </div>
                        </div>
                            <div className="bg-white rounded-2xl shadow-sm p-8 mt-9">
                            <h2 className="text-green-700 text-xl font-semibold mb-6">
                                Send Us a Message
                            </h2>
                            <form onSubmit={handleSubmit} className="space-y-5">
                                {success && (
                                    <div className="bg-green-100 text-green-700 px-4 py-3 rounded-lg">
                                    {success}
                                    </div>
                                )}
                                <div>
                                    <label className="block text-sm font-medium mb-1">
                                    Your Name <span className="text-red-500">*</span>
                                    </label>
                                    <input
                                    name="name"
                                    value={form.name}
                                    onChange={handleChange}
                                    className={`w-full rounded-lg border px-4 py-2 focus:ring-2
                                        ${errors.name ? "border-red-500 focus:ring-red-400" : "border-gray-300 focus:ring-green-400"}
                                    `}
                                    />
                                    {errors.name && (
                                    <p className="text-red-500 text-sm mt-1">{errors.name}</p>
                                    )}
                                </div>
                                <div>
                                    <label className="block text-sm font-medium mb-1">
                                    Email Address <span className="text-red-500">*</span>
                                    </label>
                                    <input
                                    type="email"
                                    name="email"
                                    value={form.email}
                                    onChange={handleChange}
                                    className={`w-full rounded-lg border px-4 py-2 focus:ring-2
                                        ${errors.email ? "border-red-500 focus:ring-red-400" : "border-gray-300 focus:ring-green-400"}
                                    `}
                                    />
                                    {errors.email && (
                                    <p className="text-red-500 text-sm mt-1">{errors.email}</p>
                                    )}
                                </div>
                                <div>
                                    <label className="block text-sm font-medium mb-1">Subject</label>
                                    <input
                                    name="subject"
                                    value={form.subject}
                                    onChange={handleChange}
                                    className="w-full rounded-lg border border-gray-300 px-4 py-2 focus:ring-2 focus:ring-green-400"
                                    />
                                </div>
                                <div>
                                    <label className="block text-sm font-medium mb-1">
                                    Message <span className="text-red-500">*</span>
                                    </label>
                                    <textarea
                                    name="message"
                                    rows="4"
                                    value={form.message}
                                    onChange={handleChange}
                                    className={`w-full rounded-lg border px-4 py-2 focus:ring-2
                                        ${errors.message ? "border-red-500 focus:ring-red-400" : "border-gray-300 focus:ring-green-400"}
                                    `}
                                    ></textarea>
                                    {errors.message && (
                                    <p className="text-red-500 text-sm mt-1">{errors.message}</p>
                                    )}
                                </div>

                                <button
                                    disabled={loading}
                                    className="w-full bg-green-600 hover:bg-green-700 text-white font-semibold py-3 rounded-full transition disabled:opacity-50 hover:-translate-y-1"
                                >
                                    {loading ? "Sending..." : "Send Message"}
                                </button>
                            </form>

                            <div className="text-center mt-6 text-sm text-gray-600">
                                Prefer Google Form?
                            </div>

                            <div className="flex justify-center mt-4">
                                <a
                                    href="https://forms.google.com" target="_blank" rel="noopener noreferrer"
                                    className="w-60 bg-green-600 hover:bg-green-700 text-white font-medium py-2.5 rounded-full transition h-14 flex justify-center items-center hover:-translate-y-1 duration-300">
                                    <i className="fab fa-google mr-2"></i>
                                    Use Contact Us Form
                                </a>
                            </div>
                        </div>

                    </div>
                </section>
                <Footer />
            </>
            
    )
}

function App() {
  return (
    <BrowserRouter>
      <nav className="sticky top-0 z-50 flex flex items-center px-6 py-4 bg-white shadow-md">
        <Link to={"/home"}>
            <img src={treeBankIcon} alt="Tree Bank" className="h-10 mr-8 icon" />
        </Link>
        <div className="absolute left-1/2 transform -translate-x-1/2 flex space-x-6">
          {/* {['home','about','projects','treeCount','gallery','contact','register','login','Registration'].map((path) => ( */}
          {['home','about','projects','treeCount','gallery','contact','login','register'].map((path) => (
            <NavLink
              key={path}
              to={`/${path}`}
              end={path === 'home'}
              className={({ isActive }) =>
                `px-3 py-2 rounded font-roboto font-semibold ${
                  isActive ? 'font-bold text-green-800' : 'text-green-800'
                } hover:bg-[#81c784] hover:text-white`
              }
            >
              {path.charAt(0).toUpperCase() + path.slice(1).replace(/([A-Z])/g, ' $1')}
            </NavLink>
          ))}
        </div>
      </nav>

      {/* Routes */}
      <Routes>
        <Route path="/react" element={<Navigate to="/home" replace />} />
        <Route path="/home" element={<Home />} />
        <Route path="/about" element={<About />} />
        <Route path="/projects" element={<Projects />} />
        {/* <Route path="/register" element={<Register1 />} /> */}
        <Route path="/treeCount" element={<TreeCount />} />
        <Route path="/gallery" element={<Gallery />} />
        <Route path="/contact" element={<Contact />} />
        <Route path="/login" element={
            <>
                <Hero 
                    heroTitle='Login to Tree Plantation' 
                    HeroDescription = 'Access your account and track your impact'
                />
                <Login />
            </>
            
            } 
        />
        <Route path="/register" element={
            <>
                <Hero 
                    heroTitle='Register for Tree Plantation' 
                    HeroDescription = 'Join our green movement and make a difference'
                />
                <Register />
            </>
        } 
        />
      </Routes>
    </BrowserRouter>
  );
}


const container = document.getElementById('root');
createRoot(container).render(<App />);
