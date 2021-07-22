import React, {Component} from "react";
import axios from "axios";
import ProduitItem from "./ProduitItem";

class Produits extends Component {
    constructor() {
        super();
        this.state = { produits: [], loading: true, value: '' };
    }

    componentDidMount() {
        this.getProduits();
    }

    getProduits() {
        axios.get('http://localhost:3001/api/produits').then(
            produits => {
                this.setState({ ...this.state, produits: produits.data, loading: false })
            }
        )
    }

    changeSearch(event) {
        this.setState({...this.state, value: event.target.value});
    }
    render() {
        const loading = this.state.loading;

        return (
            <div>
                {loading ? (
                    <div>
                        Chargement...
                    </div>
                ) : (
                    <div className="w-full">
                        <div className="flex flex-row py-4">
                                <span className="flex items-center bg-grey-lighter rounded rounded-r-none px-3 font-bold text-grey-darker">
                                  <svg xmlns="http://www.w3.org/2000/svg" className="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                      <path strokeLinecap="round" strokeLinejoin="round" strokeWidth={2} d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                </span>
                            <input
                                value={this.state.value || ""}
                                onChange={(e) => {
                                    this.changeSearch(e);
                                }}
                                placeholder="Rechercher"
                                className="text-sm italic text-greyblue-300 ml-3 w-full outline-none"
                            />
                        </div>
                            <div className="flex flex-col md:flex-rowjustify-between items-center">
                                <div className="grid grid-cols md:grid-cols-4">
                                    {this.state.produits.filter(
                                        item => item['title'].toLowerCase().includes(this.state.value.toLowerCase())
                                    ).map((produit) => (
                                        <ProduitItem produit={produit} key={produit.uuid} />
                                    ))}
                                </div>
                            </div>
                    </div>
                )}
            </div>
        )
    }
}

export default Produits;