import React from 'react';
import { Link } from "react-router-dom"

export default function NavItem({ link, text }) {
    return (
        <div>
            <Link to={link}
                  className={'text-lg no-underline text-grey-darkest hover:text-blue-dark ml-2'}>
                {text}
            </Link>
        </div>

    )
}