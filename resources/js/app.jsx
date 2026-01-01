import './bootstrap';
import { createRoot } from 'react-dom/client';
import '../css/custom.css';
import treeBankIcon from '../images/frontEnd/treeBankIcon.png';
import { BrowserRouter, Routes, Route, NavLink, Navigate } from 'react-router-dom';
import { Link } from 'react-router-dom';

function Footer() {
  return (
    <footer className="bg-[#1b5e20] text-white">
      <div className="max-w-7xl mx-auto px-6 py-16 grid grid-cols-1 md:grid-cols-3 gap-8 text-center md:text-left">
        <div className="flex flex-col gap-4">
          <h3 className="font-bold text-xl flex items-center justify-center md:justify-start gap-2 text-[#81c784]">
            <i class="fas fa-tree"></i> Tree Bank
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
            <i class="fas fa-map-marker-alt"></i> Sambrial, Sialkot, Pakistan
          </p>
          <p className="flex items-center gap-2">
            <i class="fas fa-phone"></i> 0333-8663963
          </p>
          <p className="flex items-center gap-2">
            <i class="fas fa-envelope"></i> treebank.pk@gmail.com
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
            <h2 className="text-[2.5rem] font-bold text-green-800 mt-14 text-center">
                Why Tree Plantation Matters
            </h2>

            <div className="w-20 h-1 bg-green-600 mt-4 mb-2 rounded-full mx-auto"></div>

            <p className='text-center'>
                Discover the crucial benefits of planting trees for our planet and communities
            </p>

            <div className="max-w-7xl mx-auto px-6 mt-10">
                <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                    <div className="bg-white rounded-2xl p-8 text-center shadow-md border-t-2 hover:-translate-y-1 duration-150">
                        <div className="text-green-600 text-4xl mb-4"><i class="fas fa-wind"></i></div>
                        <h3 className="text-xl font-semibold text-green-800 mb-3">
                        Reduces Air Pollution
                        </h3>
                        <p className="text-gray-600">
                        Trees absorb harmful pollutants and release clean oxygen, improving air quality for all.
                        </p>
                    </div>
                    <div className="bg-white rounded-2xl p-8 text-center shadow-md border-t-2 hover:-translate-y-1 duration-150">
                        <div className="text-green-600 text-4xl mb-4"><i class="fas fa-water"></i></div>
                        <h3 className="text-xl font-semibold text-green-800 mb-3">
                        Controls Floods & Erosion
                        </h3>
                        <p className="text-gray-600">
                        Tree roots hold soil together, preventing erosion and reducing flood risks.
                        </p>
                    </div>
                    <div className="bg-white rounded-2xl p-8 text-center shadow-md border-t-2 hover:-translate-y-1 duration-150">
                        <div className="text-green-600 text-4xl mb-4"><i class="fas fa-leaf"></i></div>
                        <h3 className="text-xl font-semibold text-green-800 mb-3">
                        Provides Oxygen & Shade
                        </h3>
                        <p className="text-gray-600">
                        One tree produces enough oxygen for 4 people and provides cooling shade.
                        </p>
                    </div>
                    <div className="bg-white rounded-2xl p-8 text-center shadow-md border-t-2 hover:-translate-y-1 duration-150">
                        <div className="text-green-600 text-4xl mb-4"><i class="fas fa-dove"></i></div>
                        <h3 className="text-xl font-semibold text-green-800 mb-3">
                        Supports Wildlife
                        </h3>
                        <p className="text-gray-600">
                        Trees provide habitat and food for countless bird and animal species.
                        </p>
                    </div>
                    <div className="bg-white rounded-2xl p-8 text-center shadow-md border-t-2 hover:-translate-y-1 duration-150">
                        <div className="text-green-600 text-4xl mb-4"><i class="fas fa-seedling"></i></div>
                        <h3 className="text-xl font-semibold text-green-800 mb-3">
                        Strengthens Ecosystems
                        </h3>
                        <p className="text-gray-600">
                        Healthy forests create balanced ecosystems that support biodiversity.
                        </p>
                    </div>
                    <div className="bg-white rounded-2xl p-8 text-center shadow-md border-t-2 hover:-translate-y-1 duration-150">
                        <div className="text-green-600 text-4xl mb-4"><i class="fas fa-heart"></i></div>
                        <h3 className="text-xl font-semibold text-green-800 mb-3">
                        Healthy Communities
                        </h3>
                        <p className="text-gray-600">
                        Green spaces improve mental health and create cleaner living environments.
                        </p>
                    </div>
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
                <h2 className="text-[2.5rem] font-bold text-green-800 mt-14 text-center">
                    About Tree Bank
                </h2>
                <div className="w-20 h-1 bg-green-600 mt-4 mb-2 rounded-full mx-auto"></div>
                <p className='text-center'>
                    Learn about our Mission, Vision, and Values
                </p>
                <div className="py-12 px-4">
                    <div className="max-w-3xl mx-auto space-y-12">
                        <div className="bg-white rounded-xl p-6 shadow-sm">
                            <div className="flex items-center gap-3 mb-3">
                                <i class="fas fa-users text-green-600"></i>
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
                                <i class="fas fa-bullseye text-green-600"></i>
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
                                <i class="fas fa-eye text-green-600"></i>
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
                                <i class="fas fa-heart text-green-600"></i>
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
                                    <i class="fas fa-check text-green-600"></i>
                                    <span className="text-gray-700">{value}</span>
                                </li>
                                ))}
                            </ul>
                        </div>
                        <div className="bg-white rounded-xl p-6 shadow-sm">
                            <div className="flex items-center gap-3 mb-6">
                                <i class="fas fa-tasks text-green-600"></i>
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
                        <h2 className="text-[2.5rem] font-bold text-green-800 mt-14 text-center">
                            Our Projects
                        </h2>
                        <div className="w-20 h-1 bg-green-600 mt-4 mb-2 rounded-full mx-auto"></div>
                        <p className='text-center'>
                            Explore our ongoing environmental initiatives
                        </p>
                        <div className="max-w-7xl mx-auto px-6 mt-10">
                            <div className="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8">
                                <div className="bg-white rounded-2xl shadow-md hover:-translate-y-1 transition-transform duration-150">
                                    <div className="bg-[#4caf50] rounded-t-2xl px-6 py-4">
                                        <h3 className="text-lg font-semibold text-white flex items-center justify-center gap-2">
                                            🌱 School Plantation Drives
                                        </h3>
                                    </div>
                                    <div className="p-6 text-center">
                                        <p className="text-gray-600 leading-relaxed">
                                            We partner with government and private schools to conduct plantation
                                            activities, engage students, and teach environmental responsibility.
                                        </p>
                                    </div>
                                </div>
                                <div className="bg-white rounded-2xl shadow-md hover:-translate-y-1 transition-transform duration-150">
                                    <div className="bg-[#4caf50] rounded-t-2xl px-6 py-4">
                                        <h3 className="text-lg font-semibold text-white flex items-center justify-center gap-2">
                                            🌱 School Plantation Drives
                                        </h3>
                                    </div>
                                    <div className="p-6 text-center">
                                        <p className="text-gray-600 leading-relaxed">
                                            We partner with government and private schools to conduct plantation
                                            activities, engage students, and teach environmental responsibility.
                                        </p>
                                    </div>
                                </div>
                                <div className="bg-white rounded-2xl shadow-md hover:-translate-y-1 transition-transform duration-150">
                                    <div className="bg-[#4caf50] rounded-t-2xl px-6 py-4">
                                        <h3 className="text-lg font-semibold text-white flex items-center justify-center gap-2">
                                            🌱 School Plantation Drives
                                        </h3>
                                    </div>
                                    <div className="p-6 text-center">
                                        <p className="text-gray-600 leading-relaxed">
                                            We partner with government and private schools to conduct plantation
                                            activities, engage students, and teach environmental responsibility.
                                        </p>
                                    </div>
                                </div>
                                <div className="bg-white rounded-2xl shadow-md hover:-translate-y-1 transition-transform duration-150">
                                    <div className="bg-[#4caf50] rounded-t-2xl px-6 py-4">
                                        <h3 className="text-lg font-semibold text-white flex items-center justify-center gap-2">
                                            🌱 School Plantation Drives
                                        </h3>
                                    </div>
                                    <div className="p-6 text-center">
                                        <p className="text-gray-600 leading-relaxed">
                                            We partner with government and private schools to conduct plantation
                                            activities, engage students, and teach environmental responsibility.
                                        </p>
                                    </div>
                                </div>
                                <div className="bg-white rounded-2xl shadow-md hover:-translate-y-1 transition-transform duration-150">
                                    <div className="bg-[#4caf50] rounded-t-2xl px-6 py-4">
                                        <h3 className="text-lg font-semibold text-white flex items-center justify-center gap-2">
                                            🌱 School Plantation Drives
                                        </h3>
                                    </div>
                                    <div className="p-6 text-center">
                                        <p className="text-gray-600 leading-relaxed">
                                            We partner with government and private schools to conduct plantation
                                            activities, engage students, and teach environmental responsibility.
                                        </p>
                                    </div>
                                </div>
                                <div className="bg-white rounded-2xl shadow-md hover:-translate-y-1 transition-transform duration-150">
                                    <div className="bg-[#4caf50] rounded-t-2xl px-6 py-4">
                                        <h3 className="text-lg font-semibold text-white flex items-center justify-center gap-2">
                                            🌱 School Plantation Drives
                                        </h3>
                                    </div>
                                    <div className="p-6 text-center">
                                        <p className="text-gray-600 leading-relaxed">
                                            We partner with government and private schools to conduct plantation
                                            activities, engage students, and teach environmental responsibility.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    <Footer />
                </>
            )
        }
function Register() { return <h1>Register</h1>; }
function TreeCount() { return <h1>Tree Count</h1>; }
function Gallery() { return <h1>Gallery</h1>; }
function Contact() { return <h1>Contact Page</h1>; }

function App() {
  return (
    <BrowserRouter>
      {/* Navigation */}
      <nav className="sticky top-0 z-50 flex flex items-center px-6 py-4 bg-white shadow-md">
        <img src={treeBankIcon} alt="Tree Bank" className="h-10 mr-8 icon" />
        <div className="absolute left-1/2 transform -translate-x-1/2 flex space-x-6">
          {['home','about','projects','register','treeCount','gallery','contact'].map((path) => (
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
        <Route path="/register" element={<Register />} />
        <Route path="/treeCount" element={<TreeCount />} />
        <Route path="/gallery" element={<Gallery />} />
        <Route path="/contact" element={<Contact />} />
      </Routes>
    </BrowserRouter>
  );
}

const container = document.getElementById('root');
createRoot(container).render(<App />);
