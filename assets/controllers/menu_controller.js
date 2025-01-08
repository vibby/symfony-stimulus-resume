import { Controller } from '@hotwired/stimulus';
export default class extends Controller {
    togglePhoneMenu(event) {
        document.getElementById('menu').classList.toggle('hidden');
    }
}
