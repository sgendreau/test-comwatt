import React, {Component} from 'react';
import {Route, Switch, Redirect} from "react-router-dom";
import Nav from "./Nav";
import NavItem from "./NavItem";
import Products from "./Products";
import Product from "./Product";
import ShoppingCart from "./ShoppingCart";
import { connect } from "react-redux";
import {actionFetchAllProductsRequest, actionFetchCartRequest} from "./actions";

class Home extends Component {

    constructor(props) {
        super(props);
    }

    componentDidMount(){
        this.props.actionFetchAllProductsRequest();
        this.props.actionFetchCartRequest();
    }


    render() {
        return(
            <div>
                <Nav title={'rEARding'}>
                    <ShoppingCart
                        numberCart={this.props.numberCart}
                        productsCart={this.props.productsCart}
                        products={this.props._products}
                    />
                    <NavItem link={'/'} text={'Produits'} />
                </Nav>
                <Switch>
                    <Redirect exact from={"/produits"} to={"/"} />
                    <Route exact path={"/"} component={Products} />
                    <Route path="/produit/:uuid" component={Product} />
                </Switch>
            </div>
        )
    }
}

const mapStateToProps = state => {
    return {
        numberCart: state._todoApp.numberCart,
        productsCart: state._todoApp.productsCart,
        _products: state._todoApp._products
    }
}

function mapDispatchToProps(dispatch) {
    return {
        actionFetchAllProductsRequest:() => dispatch(actionFetchAllProductsRequest()),
        actionFetchCartRequest:() => dispatch(actionFetchCartRequest())
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Home);