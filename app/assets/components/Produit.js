import React, {Component} from "react";
import axios from "axios";

class Produit extends Component {
    constructor() {
        super();
        this.state = { produit: [], loading: true };
    }

    componentDidMount() {
        this.getProduit();
    }

    getProduit() {
        axios.get('http://localhost:3001/api/produit/'+this.props.uuid).then(
            produit => {
                this.setState({ ...this.state, produit: produit.data, loading: false })
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
                    <div className="w-full">
                        <div className="flex flex-col md:flex-rowjustify-between items-center">
                            <div className="grid grid-cols md:grid-cols-4">
                                <ProduitItem produit={produit} />
                            </div>
                        </div>
                    </div>
                )}
            </div>
        )
    }
}

export default Produit;