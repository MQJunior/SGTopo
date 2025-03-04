// app/fetchData.js
export async function fetchFormData(data) {
    const response = await fetch('http://localhost/SGPadrao/api/', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: new URLSearchParams(data)
    });
    return response.json();
}
