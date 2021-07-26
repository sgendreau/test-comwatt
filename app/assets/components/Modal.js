import React, { Fragment, useState } from "react";
import { Dialog, Transition } from '@headlessui/react';
import Ranking from "./Ranking";
import {formatPrice} from "../utils";

export default function Modal({ button, product, ...props }) {
    let [isOpen, setIsOpen] = useState(false);
    let [nbProduct, setNbProduct] = useState(1);

    function closeModal() {
        setIsOpen(false);
    }
    function openModal() {
        setIsOpen(true);
    }

    async function addToCart() {
        const data = new FormData();
        data.append('json', JSON.stringify({
            product: product.uuid,
            quantity: nbProduct
        }));

        props.AddCart(data).then(() => {
            props.actionFetchCartRequest();
        });

        setIsOpen(false);
    }

    return (
      <>
          <button
              onClick={openModal}
              className="flex ml-auto px-6 py-2 transition ease-in duration-200 uppercase rounded-full hover:bg-yellow-500 hover:text-white border-2 border-yellow-800 hover:border-yellow-300 focus:outline-none">
              {button}
          </button>
          <Transition appear show={isOpen} as={Fragment}>
              <Dialog
                  as="div"
                  className="fixed inset-0 z-10 overflow-y-auto"
                  onClose={closeModal}
              >
                  <div className="px-4 text-center">
                      <Transition.Child
                          as={Fragment}
                          enter="ease-out duration-300"
                          enterFrom="opacity-0"
                          enterTo="opacity-100"
                          leave="ease-in duration-200"
                          leaveFrom="opacity-100"
                          leaveTo="opacity-0"
                      >
                          <Dialog.Overlay className="fixed inset-0 bg-gray-900 bg-opacity-75 transition-opacity" />
                      </Transition.Child>

                      {/* This element is to trick the browser into centering the modal contents. */}
                      <span
                          className="inline-block h-screen align-middle"
                          aria-hidden="true"
                      >
                          &#8203;
                        </span>
                      <Transition.Child
                          as={Fragment}
                          enter="ease-out duration-300"
                          enterFrom="opacity-0 scale-95"
                          enterTo="opacity-100 scale-100"
                          leave="ease-in duration-200"
                          leaveFrom="opacity-100 scale-100"
                          leaveTo="opacity-0 scale-95"
                      >
                          <div className="inline-block w-full max-w-lg p-6 my-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-xl rounded-xl">
                              <Dialog.Title
                                  as="h3"
                                  className="text-lg font-medium leading-6 text-gray-900"
                              >
                                  {product.title}
                              </Dialog.Title>
                              <div className="mt-2 flex flex-wrap">
                                  <img src="https://unsplash.com/photos/f13HuYnEmxQ/download?force=true"
                                       className="w-1/3 object-cover object-center rounded border border-gray-200"/>
                                  <div className="w-1/2 ml-3 text-sm">
                                      <div className="flex flex-wrap ">
                                          <Ranking ranking={product.ranking} />
                                          <div className="ml-auto flex text-lg">{product.price.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})} €</div>
                                      </div>
                                      <div className="flex mb-4">
                                          <span className="flex ml-2 pl-3=2 py-2">
                                            <span className="text-gray-600 ml-1">{product.genres} de {product.year}</span>
                                        </span>
                                          <span className="flex ml-2 pl-2 py-2 border-l-2 border-gray-200">
                                                    <span className="text-gray-600 ml-1">{product.product_type}</span>
                                              </span>
                                      </div>
                                      <div className="flex flex-wrap">
                                              <label htmlFor="quantite" className="text-gray-600 ">Quantité</label>
                                              <input
                                                  id="quantite"
                                                  className="w-full rounded border appearance-none border-gray-200 py-2 focus:outline-none focus:border-gray-500 text-base pl-3 pr-1"
                                                  placeholder="Quantité"
                                                  type="number"
                                                  min="1"
                                                  value={nbProduct}
                                                  onChange={(e) => {
                                                      setNbProduct(e.target.value);
                                                  }}
                                              />
                                      </div>
                                  </div>
                              </div>

                              <div className="mt-4 flex flex-row">
                                  <div className="flex w-1/2 items-center">
                                      <span className="mr-auto text-md">
                                          Total : {formatPrice(product.price * nbProduct)} €
                                      </span>
                                  </div>
                                  <button
                                      type="button"
                                      className="flex ml-auto px-6 py-2 transition ease-in duration-200 uppercase rounded-full hover:bg-yellow-500 hover:text-white border-2 border-yellow-800 hover:border-yellow-300 focus:outline-none"
                                      onClick={addToCart}
                                  >
                                      Ajouter {nbProduct} article{nbProduct > 1 && 's'}
                                  </button>
                              </div>
                          </div>
                      </Transition.Child>
                  </div>
              </Dialog>
          </Transition>
      </>
    );
}