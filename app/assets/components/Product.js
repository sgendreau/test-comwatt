import React, {PureComponent} from "react";
import Ranking from "./Ranking";
import {Link} from "react-router-dom";
import Modal from "./Modal";
import callApi from "./api";

class Product extends PureComponent {
    constructor(props) {
        super(props);
        this.state = { product: this.getProduct(props.match.params.uuid), uuid: props.match.params.uuid };
    }

    componentDidMount() {
       this.getProduct();
    }

    componentDidUpdate(prevProps) {
        if (prevProps.location.pathname !== this.props.location.pathname) {
            this.setState({...this.state, product: this.getProduct(this.props.match.params.uuid), uuid: this.props.match.params.uuid});
        }
    }

    getProduct(uuid) {
        return this.props._products.find((product) => product.uuid === uuid);
    }

    render() {
        const product = this.state.product;

        return (
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
                                    {product.country !== 'FRA' &&
                                        <h2 className="text-sm title-font text-gray-500 tracking-widest uppercase">{product.original_title} ({product.country_libelle})</h2>
                                    }
                                    <h1 className="text-gray-900 text-3xl title-font font-medium mb-1 uppercase">{product.title}</h1>
                                    <div className="flex mb-4">
                                      <span className="flex items-center">
                                        <Ranking ranking={product.ranking} />
                                      </span>
                                        <span className="flex ml-3 pl-3 py-2 border-l-2 border-gray-200">
                                            <span className="text-gray-600 ml-3">{product.genres} de {product.year}</span>
                                        </span>
                                        <span className="flex ml-3 pl-3 py-2 border-l-2 border-gray-200">
                                            <span className="text-gray-600 ml-3">{product.product_type}</span>
                                      </span>
                                    </div>
                                    <div
                                        className="flex mt-6 items-center pb-5 border-b-2 border-gray-200 mb-5">
                                        <p className="leading-relaxed">{product.description}</p>
                                    </div>
                                    <div className="flex">
                                        <span
                                            className="title-font font-medium text-2xl text-gray-900">{product.price.toLocaleString(undefined, {minimumFractionDigits:2, maximumFractionDigits:2})} €</span>
                                        <Modal button={'Ajouter au panier'} product={product} {...this.props} />
                                    </div>
                                </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
        )
    }
}

export default Product;