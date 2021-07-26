import React, { useState } from "react";
import {formatPrice} from "../utils";
import { Link } from 'react-router-dom';

export default function CartItem ({product = {}, quantity = 0, ...props}) {

    async function updateCart(nbProduct) {
        console.log(nbProduct);
        if(nbProduct === 0) {
            deleteCart();
        } else {
            let data = new FormData();
            data.append('json', JSON.stringify({
                product: product.uuid,
                quantity: nbProduct
            }));

            props.UpdateCart(data).then(() => {
                props.actionFetchCartRequest();
            });
        }
    }

    async function deleteCart() {
        let data = new FormData();
        data.append('json', JSON.stringify({
            product: product.uuid
        }));

        props.DeleteCart(data).then(() => {
            props.actionFetchCartRequest();
        });
    }

    return (
        <tr>
            <td className="hidden pb-4 md:table-cell">
                <Link to={`/product/${product.uuid}`} className="flex w-3/4 justify-center">
                    <img
                        src="https://unsplash.com/photos/f13HuYnEmxQ/download?force=true"
                        className="w-20 rounded" alt="Thumbnail" />
                </Link>
            </td>
            <td>
                <Link to={`/product/${product.uuid}`}>
                    <div className="mb-2 md:ml-4 uppercase">{product.title}</div>
                    <div className="mb-2 md:ml-4 text-gray-500">{product.genres} | {product.product_type}</div>
                </Link>
            </td>
            <td className="justify-center md:justify-end md:flex mt-6">
                <div className="w-20 h-10">
                    <div className="relative flex flex-row w-full h-8">
                        <input type="number"
                               defaultValue={quantity}
                               onChange={(e) => {
                                   let nbProduct = e.target.value;
                                   if(nbProduct.length && !isNaN(nbProduct)) {
                                       updateCart(parseInt(e.target.value));
                                   }
                                }}
                               className="w-full font-semibold text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black"/>
                        <button className="text-gray-700 md:ml-4"
                                onClick={() => {
                                    deleteCart()
                                }}>
                            <svg aria-hidden="true" data-prefix="far" data-icon="trash-alt"
                                 className="w-4 text-red-600 hover:text-red-800"
                                 xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512">
                                <path fill="currentColor"
                                      d="M268 416h24a12 12 0 0012-12V188a12 12 0 00-12-12h-24a12 12 0 00-12 12v216a12 12 0 0012 12zM432 80h-82.41l-34-56.7A48 48 0 00274.41 0H173.59a48 48 0 00-41.16 23.3L98.41 80H16A16 16 0 000 96v16a16 16 0 0016 16h16v336a48 48 0 0048 48h288a48 48 0 0048-48V128h16a16 16 0 0016-16V96a16 16 0 00-16-16zM171.84 50.91A6 6 0 01177 48h94a6 6 0 015.15 2.91L293.61 80H154.39zM368 464H80V128h288zm-212-48h24a12 12 0 0012-12V188a12 12 0 00-12-12h-24a12 12 0 00-12 12v216a12 12 0 0012 12z"/>
                            </svg>
                        </button>
                    </div>

                </div>
            </td>
            <td className="hidden text-right md:table-cell">
              <span className="text-sm lg:text-base font-medium">
                {formatPrice(product.price)} €
              </span>
            </td>
            <td className="text-right">
              <span className="text-sm lg:text-base font-medium">
                {formatPrice(product.price * quantity)} €
              </span>
            </td>
        </tr>
    )
}