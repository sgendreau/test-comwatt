import React, {Component} from 'react';
import {Route, Switch, Redirect, withRouter} from "react-router-dom";
import Nav from "./Nav";
import NavItem from "./NavItem";
import Products from "./Products";
import Product from "./Product";

class Home extends Component {

    render() {
        return(
            <div>
                <Nav title={'rEARding'}>
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

export default Home;