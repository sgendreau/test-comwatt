import React, {Component} from 'react';
import {Route, Switch, Redirect, withRouter} from "react-router-dom";
import Nav from "./Nav";
import NavItem from "./NavItem";
import Produits from "./Produits";
import Produit from "./Produit";

class Home extends Component {

    render() {
        return(
            <div>
                <Nav title={'rEARding'}>
                    <NavItem link={'/'} text={'Produits'} />
                </Nav>
                <Switch>
                    <Redirect exact from={"/produits"} to={"/"} />
                    <Route path={"/"} component={Produits} />
                    <Route path="/produit/:uuid" handler={Produit} />
                </Switch>
            </div>
        )
    }
}

export default Home;