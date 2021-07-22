import React from 'react';
import { Link } from 'react-router-dom';
import Ranking from "./Ranking";

export default function ProduitItem({ produit }) {
    return (
            <div className="container mx-auto max-w-sm w-full p-4">
                <div className="card flex flex-col md:flex-none justify-center p-10 bg-white rounded-lg shadow-xl hover:shadow-2xl">
                    <div className="prod-title">
                        <p className="text-xl uppercase text-gray-900 font-bold">{produit.title}</p>
                    </div>
                    <div className="prod-img">
                        <img src="https://unsplash.com/photos/f13HuYnEmxQ/download?force=true"
                             className="w-full object-cover object-center"/>
                    </div>
                    <div className="prod-info grid gap-10">
                        <div className="flex">
                            <Ranking ranking={produit.ranking} />
                        </div>
                        <div className="flex flex-col md:flex-row justify-between items-center text-gray-900">
                            <p className="font-bold text-xl">{produit.price.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})} €</p>
                            <Link to={'produit/'+produit.uuid}
                                className="px-6 py-2 transition ease-in duration-200 uppercase rounded-full hover:bg-gray-800 hover:text-white border-2 border-gray-900 focus:outline-none">Voir
                            </Link>
                        </div>
                    </div>
                </div>
            </div>
    )
}