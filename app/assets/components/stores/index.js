import CartApp from "../reducers";
import { createStore, applyMiddleware } from "redux";
import thunkMiddleware from 'redux-thunk';

const store = createStore( CartApp, applyMiddleware(thunkMiddleware) );

export default store;