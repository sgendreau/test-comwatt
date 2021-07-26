import React, {Component} from "react";
import CartItem from "./CartItem";
import {formatPrice} from "../utils";

class Cart extends Component
{
    constructor(props) {
        super(props);
        this.state = {numberCart: props.numberCart }
    }

    componentDidUpdate(prevProps) {
        if(prevProps.numberCart !== this.props.numberCart) {
            this.setState({numberCart: this.props.numberCart});
        }
    }

    getProduct(uuid) {
        return this.props._products.find((product) => product.uuid === uuid);
    }

    getTotalCart() {
        return this.props.productsCart.reduce((total, productCart) => {
            return (this.getProduct(productCart.uuid).price * productCart.quantity) +total;
        }, 0);
    }

    render() {
        return (
            <div className="flex justify-center my-1">
                <div
                    className="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg pin-r pin-y md:w-4/5 lg:w-4/5">
                    <div className="flex-1">
                        <table className="w-full text-sm lg:text-base" cellSpacing="0">
                            <thead>
                            <tr className="h-12 uppercase">
                                <th className="hidden md:table-cell"></th>
                                <th className="text-left">Produit</th>
                                <th className="lg:text-right text-left pl-5 lg:pl-0">
                                    <span className="lg:hidden" title="Quantity">Qte</span>
                                    <span className="hidden lg:inline">Quantité</span>
                                </th>
                                <th className="hidden text-right md:table-cell">Prix</th>
                                <th className="text-right">Total</th>
                            </tr>
                            </thead>
                            <tbody>
                            {this.props.numberCart > 0 ? (
                                <>
                                    {this.props.productsCart.map((product) =>
                                        (<CartItem product={this.getProduct(product.uuid)} quantity={product.quantity} key={product.uuid} {...this.props} />)
                                    )}
                                </>
                            ) : (
                                <tr><td></td><td className="p-4">Aucun article dans votre panier</td></tr>
                            )}
                            </tbody>
                        </table>
                        <hr className="pb-6 mt-6" />
                        <div className="lg:px-2 lg:w-1/2 ml-auto">
                            <div className="p-4">
                                <div className="flex justify-between pt-4 border-b">
                                    <div
                                        className="lg:px-4 lg:py-2 m-2 text-lg lg:text-xl font-bold text-center text-gray-800">
                                        Total
                                    </div>
                                    <div className="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">
                                        {formatPrice(this.getTotalCart())} €
                                    </div>
                                </div>
                                <a href="#">
                                    <button
                                        className="flex justify-center w-full px-6 py-2 mt-5 transition ease-in duration-200 uppercase rounded-full text-green-800 hover:bg-green-500 hover:text-white border-2 border-green-800 hover:border-green-300 focus:outline-none">
                                        <svg aria-hidden="true" data-prefix="far" data-icon="credit-card"
                                             className="w-8" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                            <path fill="currentColor"
                                                  d="M527.9 32H48.1C21.5 32 0 53.5 0 80v352c0 26.5 21.5 48 48.1 48h479.8c26.6 0 48.1-21.5 48.1-48V80c0-26.5-21.5-48-48.1-48zM54.1 80h467.8c3.3 0 6 2.7 6 6v42H48.1V86c0-3.3 2.7-6 6-6zm467.8 352H54.1c-3.3 0-6-2.7-6-6V256h479.8v170c0 3.3-2.7 6-6 6zM192 332v40c0 6.6-5.4 12-12 12h-72c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h72c6.6 0 12 5.4 12 12zm192 0v40c0 6.6-5.4 12-12 12H236c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h136c6.6 0 12 5.4 12 12z"/>
                                        </svg>
                                        <span className="ml-2 mt-5px">Paiement</span>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        )
    }
}

export default Cart;