import React, {Component, Fragment} from "react";
import { Popover, Transition } from '@headlessui/react'
import ShoppingCartItem from "./ShoppingCartItem";

class ShoppingCart extends Component {

    constructor(props) {
        super(props);
    }

    getProduct(uuid) {
        return this.props.products.find((product) => product.uuid === uuid);
    }

    render() {
        return (
            <div className=" mx-5">
                <Popover className="">
                    {({ open }) => (
                        <>
                            <Popover.Button
                                className={`${open ? '' : 'text-opacity-100'}` }
                            >
                                <div className="flex flex-row-reverse ml-2 w-full">
                                    <div slot="icon" className="relative">
                                        <div
                                            className="absolute text-xs rounded-full -mt-1 -mr-2 px-1 font-bold top-0 right-0 bg-red-700 text-white">
                                            {this.props.numberCart}
                                        </div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100%" height="100%" fill="none"
                                             viewBox="0 0 24 24" stroke="currentColor" strokeWidth="2"
                                             strokeLinecap="round" strokeLinejoin="round"
                                             className="feather feather-shopping-cart w-6 h-6 mt-2">
                                            <circle cx="9" cy="21" r="1"></circle>
                                            <circle cx="20" cy="21" r="1"></circle>
                                            <path
                                                d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                        </svg>
                                    </div>
                                </div>
                            </Popover.Button>
                            <Transition
                                as={Fragment}
                                enter="transition ease-out duration-200"
                                enterFrom="opacity-0 translate-y-1"
                                enterTo="opacity-100 translate-y-0"
                                leave="transition ease-in duration-150"
                                leaveFrom="opacity-100 translate-y-0"
                                leaveTo="opacity-0 translate-y-1"
                            >
                                <Popover.Panel className="absolute z-10 w-screen max-w-sm px-4 mt-3 transform  right-0 sm:px-0 lg:max-w-md">
                                    <div className="overflow-hidden rounded-lg shadow-lg ring-1 ring-black ring-opacity-5">
                                        <div className="relative grid bg-white p-7">
                                            {this.props.numberCart > 0 ? (
                                                <>
                                                    {this.props.productsCart.map((product) =>
                                                        (<ShoppingCartItem product={this.getProduct(product.uuid)} quantity={product.quantity} />)
                                                    )}
                                                </>
                                            ) : (
                                                <div className="p-4 justify-center flex bg-white border-b border-gray-100">Aucun article dans votre panier</div>
                                            )}
                                        </div>
                                        <div className="p-4 justify-center flex bg-white">
                                            <button className="text-base hover:scale-110 focus:outline-none flex justify-center px-4 py-2 rounded font-bold cursor-pointer
                                            hover:bg-green-700 hover:text-green-100 bg-green-100 text-green-700 border duration-200 ease-in-out border-green-600 transition">
                                                Panier
                                            </button>
                                        </div>
                                    </div>
                                </Popover.Panel>
                            </Transition>
                        </>
                    )}
                </Popover>
            </div>
        )
    }
}

export default ShoppingCart;