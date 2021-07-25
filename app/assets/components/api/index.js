
const API_URL = 'http://localhost:3001/api';

export default function callApi(endpoint = '', method = 'GET', headers = new Headers(), body = null) {
    return fetch(`${API_URL}${endpoint}`,
        {
            method: method,
            headers: headers,
            data: body
        }
    )
    .then(response => response.json())
    .catch(err => {
        console.log(err);
    })
}
