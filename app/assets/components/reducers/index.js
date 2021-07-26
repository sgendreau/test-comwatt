import {ADD_CART, DELETE_CART, GET_ALL_PRODUCTS, GET_CART, GET_NUMBER_CART, UPDATE_CART} from "../actions";
import {combineReducers} from "redux";

const initApp = {
    numberCart: 0,
    productsCart: [],
    _products: [],
}

function todoApp(state = initApp, action) {
    switch(action.type) {
        case GET_ALL_PRODUCTS:
            return {
                ...state,
                _products: action.payload
            }
        case GET_CART:
            let cart = Object.entries(action.payload).map(([uuid, quantity]) => ({uuid, quantity}));

            let nbProducts = cart.reduce((total, cart) => total + cart.quantity, 0);

            return {
                ...state,
                numberCart: nbProducts,
                productsCart: cart
            }
        case GET_NUMBER_CART:
            return {
                ...state,
            }
        case ADD_CART:
            return {
                ...state,
            }
        case UPDATE_CART:
            return {
                ...state,
            }
        case DELETE_CART:
            return {
                ...state,
            }
        default:
            return {
                ...state
            };
    }
}

const CartApp = combineReducers({
    _todoApp: todoApp
})

export default CartApp;