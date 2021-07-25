import React from 'react';
import { Link } from 'react-router-dom';
import Ranking from "./Ranking";
import Modal from "./Modal";
import {formatPrice} from "../utils";

export default function ProductItem({ produit }) {
    return (
        <div className="card flex flex-col justify-between p-10 bg-white rounded-lg shadow-xl hover:shadow-2xl h-full">
            <Link to={`/produit/${produit.uuid}`}>
                <div className="prod-title">
                    <p className="text-xl uppercase text-gray-900 font-bold">{produit.title}</p>
                </div>
                <div className="prod-img">
                    <img src="https://unsplash.com/photos/f13HuYnEmxQ/download?force=true"
                         className="w-full object-cover object-center"/>
                </div>
            </Link>
            <div className="prod-info grid gap-10">
                <div className="flex">
                    <Ranking ranking={produit.ranking} />
                </div>
                <div className="flex flex-col md:flex-row justify-between items-center text-gray-900">
                    <p className="font-bold text-xl">{formatPrice(produit.price)} €</p>
                    <Modal button={'Ajouter au panier'} produit={produit} />
                </div>
            </div>
        </div>
    )
}