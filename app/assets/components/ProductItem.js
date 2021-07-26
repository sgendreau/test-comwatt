import React from 'react';
import { Link } from 'react-router-dom';
import Ranking from "./Ranking";
import Modal from "./Modal";

export default function ProductItem({ product, ...props }) {
    return (
        <div className="card flex flex-col justify-between p-10 bg-white rounded-lg shadow-xl hover:shadow-2xl h-full">
            <Link to={`/product/${product.uuid}`}>
                <div className="prod-title">
                    <p className="text-xl uppercase text-gray-900 font-bold">{product.title}</p>
                </div>
                <div className="prod-img">
                    <img src="https://unsplash.com/photos/f13HuYnEmxQ/download?force=true"
                         className="w-full object-cover object-center"/>
                </div>
            </Link>
            <div className="prod-info grid gap-10">
                <div className="flex">
                    <Ranking ranking={product.ranking} />
                </div>
                <div className="flex flex-col md:flex-row justify-between items-center text-gray-900">
                    <p className="font-bold text-xl">{product.price.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})} €</p>
                    <Modal button={'Ajouter au panier'} product={product} {...props} />
                </div>
            </div>
        </div>
    )
}