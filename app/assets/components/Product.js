import React, {Component} from "react";
import Ranking from "./Ranking";
import {Link} from "react-router-dom";

class Product extends Component {
    constructor(props) {
        super(props);
        console.log(props.match.params.uuid)
        this.state = { produit: [], loading: true, uuid: props.match.params.uuid };
    }

    componentDidMount() {
       this.getProduit();
    }

    getProduit() {
        fetch(`http://localhost:3001/api/product/${this.state.uuid}`, {method: 'GET'})
            .then(response => response.json())
            .then(
                produit => {
                    console.log(produit);
                    this.setState({...this.state, produit: produit, loading: false})
                }
            )
    }

    render() {
        const loading = this.state.loading;
        const produit = this.state.produit;

        return (
            <div>
                {loading ? (
                    <div className={'flex item-center'}>
                        <div>
                            Chargement...
                        </div>
                    </div>
                ) : (
                    <div className="w-full">
                        <div className="container mx-auto mt-1">
                        <section className="text-gray-700 body-font overflow-hidden bg-white">
                            <div className="container px-5 py-24 mx-auto">
                                <Link to={"/"} className=" mr-auto px-6 py-2 transition ease-in duration-200 uppercase rounded hover:bg-gray-800 hover:text-white border-2 border-gray-900 focus:outline-none">Retour</Link>
                                <div className="lg:w-4/5 mx-auto flex flex-wrap">
                                    <img alt="ecommerce"
                                         className="lg:w-1/2 w-full object-cover object-center rounded border border-gray-200"
                                         src="https://unsplash.com/photos/f13HuYnEmxQ/download?force=true" />
                                        <div className="lg:w-1/2 w-full lg:pl-10 lg:py-6 mt-6 lg:mt-0">
                                            {produit.country !== 'FRA' &&
                                                <h2 className="text-sm title-font text-gray-500 tracking-widest">{produit.original_title} ({produit.country_libelle})</h2>
                                            }
                                            <h1 className="text-gray-900 text-3xl title-font font-medium mb-1">{produit.title}</h1>
                                            <div className="flex mb-4">
                                              <span className="flex items-center">
                                                <Ranking ranking={produit.ranking} />
                                              </span>
                                                <span className="flex ml-3 pl-3 py-2 border-l-2 border-gray-200">
                                                    <span className="text-gray-600 ml-3">{produit.genres} de {produit.year}</span>
                                                </span>
                                                <span className="flex ml-3 pl-3 py-2 border-l-2 border-gray-200">
                                                    <span className="text-gray-600 ml-3">{produit.product_type}</span>
                                              </span>
                                            </div>
                                            <div
                                                className="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">
                                                <p className="leading-relaxed">{produit.description}</p>
                                            </div>
                                            <div className="flex">
                                                <span
                                                    className="title-font font-medium text-2xl text-gray-900">{produit.price.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})} €</span>
                                                <button
                                                    className="flex ml-auto px-6 py-2 transition ease-in duration-200 uppercase rounded-full hover:bg-yellow-500 hover:text-white border-2 border-yellow-900 focus:outline-none">Ajouter au panier
                                                </button>
                                            </div>
                                        </div>
                                </div>
                            </div>
                        </section>
                    </div>
                    </div>
                )}
            </div>
        )
    }
}

export default Product;