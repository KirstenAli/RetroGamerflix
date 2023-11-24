const newElement = document.createElement('div');
newElement.innerHTML = `<div class="modal fade text-color" id="message-modal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteConfirmationModalLabel">Message</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="message-modal-body">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">ok</button>
                </div>
            </div>
        </div>
    </div>`;

document.body.appendChild(newElement);

const messageModal= initModal('message-modal');


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

export async function sendData(url, verb, showMessage, data, headers) {
    try {
        const response = await fetch(url, { method: verb, headers, body: data });

        if (!response.ok) {
            if(showMessage){
                showModal(response.status);
            }
        }

        const { message, game } = await response.json();

        if (message) {
            if(showMessage){
                showModal(message);
            }
        }

        if (game) {
            return game;
        }

        return message;
    } catch (error) {
        if(showMessage){
            showModal('An Error has Occurred');
        }
        console.error('Error:', error.message);
    }
}

function showModal(message){
    const element = document.getElementById('message-modal-body');
    element.innerHTML = message;
    messageModal.show();
}

export function initModal(id){
    return new bootstrap.Modal(document.getElementById(id), {backdrop: 'static'});
}

