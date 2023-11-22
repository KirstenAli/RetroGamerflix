export async function fetchJSON(url) {
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error('Failed to fetch data');
        }

        return await response.json();

    } catch (error) {
        console.error('Error fetching data:', error.message);
    }
}

export async function sendData(url, verb, headers) {
    try {
        let response = await fetch(url, {
            method: verb,
            headers: headers,
        });

        if (!response.ok) {
            console.log(response.status);
            return response.status;
        }

        response = await response.json();

        if(response.message) {
            console.log();
            return response.message;
        }
        return response;


    } catch (error) {
        console.error('Error:', error.message);
        return error.message;
    }
}
