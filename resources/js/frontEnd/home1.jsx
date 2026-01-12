import { Link } from 'react-router-dom';

function Home1() {
  return (
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
  );
}

export default Home1;
