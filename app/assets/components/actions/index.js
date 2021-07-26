import callApi from "../api";

export const GET_ALL_PRODUCTS = 'GET_ALL_PRODUCTS';
export const GET_CART = 'GET_CART';
export const GET_NUMBER_CART = 'GET_NUMBER_CART';
export const ADD_CART = 'ADD_CART';
export const UPDATE_CART = 'UPDATE_CART';
export const DELETE_CART = 'DELETE_CART';

export const actionFetchAllProductsRequest = () => {
    return (dispatch) => {
        return callApi('/products').then(response => {
            dispatch(GetAllProducts(response));
        })
    }
}

export const actionFetchCartRequest = () => {
    return (dispatch) => {
        return callApi(`/cart`).then(response => {
            dispatch(GetCart(response));
        })
    }
}

export const actionAddCartRequest = (data) => {
    return dispatch => {
        return callApi('/cart/add', 'POST', data).then(response => {
            dispatch(AddCart(response));
        })
    }
}

export const actionUpdateCartRequest = (data) => {
    return dispatch => {
        return callApi('/cart/update', 'POST', data).then(response => {
            console.log(response)
            dispatch(UpdateCart(response));
        })
    }
}

export const actionDeleteCartRequest = (data) => {
    return dispatch => {
        return callApi('/cart/delete', 'POST', data).then(response => {
            dispatch(DeleteCart(response));
        })
    }
}

/*
 * Récupérer les produits
 */
export function GetAllProducts(payload){
    return {
        type: 'GET_ALL_PRODUCTS',
        payload
    }
}

/*
 * Gestion du panier
 */

export function GetCart(payload) {
    return {
        type: 'GET_CART',
        payload
    }
}

export function getNumberCart() {
    return {
        type: 'GET_NUMBER_CART',
    }
}

export function AddCart(payload){
    return {
        type:'ADD_CART',
        payload
    }
}
export function UpdateCart(payload){
    return {
        type:'UPDATE_CART',
        payload
    }
}
export function DeleteCart(payload){
    return{
        type:'DELETE_CART',
        payload
    }
}
