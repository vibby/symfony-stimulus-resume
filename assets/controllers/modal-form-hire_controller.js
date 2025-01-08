import { Controller } from '@hotwired/stimulus';
export default class extends Controller {
    openModal(event) {
        document.getElementById('modal-form-hire').classList.remove('hidden');
    }
    closeModal(event) {
        document.getElementById('modal-form-hire').classList.add('hidden');
    }
    submitForm(event) {
        event.preventDefault();
        document.getElementById('modal-form-hire').classList.add('hidden');
    }
}
