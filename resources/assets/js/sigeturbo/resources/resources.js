import axios from 'axios';

let token = document.head.querySelector('meta[name="csrf-token"]');
let sigeturboToken = document.querySelector('#sigeturboToken').getAttribute('data-token');

export const HTTP = axios.create({
    headers: {
        'X-Requested-With': 'XMLHttpRequest',
        'Authorization': 'Bearer ' + sigeturboToken,
        'X-CSRF-TOKEN': token.content
    }
});