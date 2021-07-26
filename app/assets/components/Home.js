import React, {Component} from 'react';
import {Route, Switch} from "react-router-dom";
import Nav from "./Nav";
import NavItem from "./NavItem";
import Products from "./Products";
import Product from "./Product";
import ShoppingCart from "./ShoppingCart";
import Cart from "./Cart";
import { connect } from "react-redux";
import {
    actionAddCartRequest,
    actionUpdateCartRequest,
    actionDeleteCartRequest,
    actionFetchAllProductsRequest,
    actionFetchCartRequest
} from "./actions";

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
                    <ShoppingCart {...this.props} />
                    <NavItem link={'/'} text={'Produits'} />
                </Nav>
                <Switch>
                    <Route exact path={"/"} component={(props) => <Products {...this.props} {...props} />} />
                    <Route exact path="/product/:uuid" component={(props) => <Product {...this.props} {...props} />} />
                    <Route exact path="/cart" component={(props) => <Cart {...this.props} {...props} />} />
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
        actionFetchAllProductsRequest: () => dispatch(actionFetchAllProductsRequest()),
        actionFetchCartRequest: () => dispatch(actionFetchCartRequest()),
        AddCart: (product) => dispatch(actionAddCartRequest(product)),
        UpdateCart: (product) => dispatch(actionUpdateCartRequest(product)),
        DeleteCart: (product) => dispatch(actionDeleteCartRequest(product)),
    }
}

export default connect(mapStateToProps, mapDispatchToProps)(Home);