import { Link, usePage } from '@inertiajs/react';
import treeBankIcon from '../../images/frontEnd/treeBankIcon.png';

export default function Navbar() {
    const { url } = usePage();

    const links = [
        { name: 'Home', href: route('home') },
        { name: 'About', href: route('about') },
        { name: 'Projects', href: route('projects') },
        { name: 'Register', href: route('register') },
        { name: 'Tree Count', href: route('treeCount') },
        { name: 'Gallery', href: route('gallery') },
        { name: 'Contact', href: route('contact') },
        { name: 'Login', href: route('login') },
    ];

    return (
        <nav className="sticky top-0 z-50 flex items-center px-6 py-4 bg-white shadow-md">
            <Link href={route('home')}>
                <img
                    src={treeBankIcon}
                    alt="Tree Bank"
                    className="h-10 mr-8"
                />
            </Link>

            <div className="absolute left-1/2 transform -translate-x-1/2 flex space-x-6">
                {links.map(link => (
                    <Link
                        key={link.name}
                        href={link.href}
                        className={`px-3 py-2 rounded font-semibold text-green-800 hover:bg-[#81c784] hover:text-white ${
                            url === link.href ? 'font-bold underline' : ''
                        }`}
                    >
                        {link.name}
                    </Link>
                ))}
            </div>
        </nav>
    );
}
