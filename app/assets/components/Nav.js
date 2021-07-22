import React from 'react';
import { Link } from 'react-router-dom';

export default function Nav({ title, children }) {
    return (
        <nav
            className="font-sans flex flex-col text-center sm:flex-row sm:text-left sm:justify-between py-4 px-6 bg-white shadow sm:items-baseline w-full">
            <div className="mb-2 sm:mb-0">
                <Link to="/" className="text-2xl no-underline text-grey-darkest hover:text-blue-dark">{title}</Link>
            </div>
            <div>
                {children}
            </div>
        </nav>
    )
}