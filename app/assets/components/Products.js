import React, {Component} from "react";
import ProductItem from "./ProductItem";

class Products extends Component {
    constructor(props) {
        super(props);
        this.state = { value: '' };
    }

    changeSearch(event) {
        this.setState({...this.state, value: event.target.value});
    }
    render() {
        return (
            <div className="w-full">
                <div className="flex flex-row py-4">
                    <span className="flex items-center bg-grey-lighter rounded rounded-r-none px-3 font-bold t text-gray-500">
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
                        className="text-sm italic text-gray-500 text-lg ml-3 w-full bg-gray-100 focus:outline-none"
                    />
                </div>
                <div className="container mx-auto pb-5">
                    <div className="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-5">
                        {this.props._products.filter(
                            item => item['title'].toLowerCase().includes(this.state.value.toLowerCase())
                        ).map((product) => (
                            <ProductItem product={product} key={product.uuid} {...this.props} />
                        ))}
                    </div>
                </div>
            </div>
        )
    }
}

export default Products;