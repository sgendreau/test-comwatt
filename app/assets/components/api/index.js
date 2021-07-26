
const API_URL = 'http://localhost:3001/api';

export default async function callApi(endpoint = '', method = 'GET', body = null, headers = new Headers()) {
    const request = new Request(`${API_URL}${endpoint}`, {
        method: method,
        headers: headers,
        body: body
    });
    return await fetch(request)
    .then(response => response.json())
    .catch((err) => {
        console.log(err);
    })
}
