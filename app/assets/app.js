/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.scss';

// start the Stimulus application
import './bootstrap';

import React from 'react';
import ReactDom from 'react-dom';
import {BrowserRouter as Router } from 'react-router-dom';
import {Provider} from 'react-redux';
import store from './components/stores';
import Home from "./components/Home";


ReactDom.render((
    <Provider store = {store}>
        <Router><Home /></Router>
    </Provider>
    ),
    document.querySelector('#app')
)
