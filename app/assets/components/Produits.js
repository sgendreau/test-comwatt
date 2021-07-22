import React, {Component} from "react";
import axios from "axios";

class Produits extends Component {
    constructor() {
        super();
        this.state = { produits: [], loading: true };
    }

    componentDidMount() {
        this.getProduits();
    }

    getProduits() {
        axios.get('http://localhost:3001/api/produits').then(
            produits => {
                this.setState({ produits: produits.data, loading: false })
            }
        )
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
                    <div>
                    {produits.map((produit) => (
                            <span>{produit.title}</span>
                        ))}
                    </div>
                )}
            </div>
        )
    }
}

export default Produits;