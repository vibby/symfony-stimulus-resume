import { Controller } from '@hotwired/stimulus';
export default class extends Controller {

    initialize() {
        if (window.matchMedia && !window.matchMedia('(prefers-color-scheme: dark)').matches) {
            document.getElementsByTagName('html')[0].classList.remove('dark');
        }
    }

    toggleDarkMode() {
        document.getElementsByTagName('html')[0].classList.toggle('dark');
    }
    scrollToTop() {
        window.scrollTo(0, 0);
    }
    toggleScrollToTop() {
        if (window.scrollY > 100) {
            document.getElementById('scroll-to-top').classList.remove('hidden');
        } else {
            document.getElementById('scroll-to-top').classList.add('hidden');
        }
    }
}
