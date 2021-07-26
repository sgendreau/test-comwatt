import React from "react";
import {formatPrice} from "../utils";
import { Link } from 'react-router-dom';

export default function ShoppingCartItem ({product = {}, quantity = 0, ...props}) {

    return (
        <div className="p-2 flex bg-white hover:bg-gray-100 cursor-pointer border-b border-gray-100 w-full">
            <Link to={`/product/${product.uuid}`} className="flex w-3/4">
                <div className="p-2 w-12"><img
                    src="https://unsplash.com/photos/f13HuYnEmxQ/download?force=true"
                    alt="img product" /></div>
                <div className="flex-auto text-sm w-32">
                    <div className="font-bold uppercase">{product.title}</div>
                    <div className="truncate text-gray-500">{product.genres} | {product.product_type}</div>
                    <div className="text-gray-400">Qt: {quantity}</div>
                </div>
            </Link>
            <div className="flex flex-col w-18 font-medium items-end">
                {formatPrice(product.price * quantity)} €
            </div>
        </div>
    )
}