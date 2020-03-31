import $ from "jquery";

let crud = $.crud();

export const ServiceUrl = $('base').attr('href') + 'services/';

crud.config(config => {

    config.baseUrl = ServiceUrl

    return config;
})

export const $crud = crud;
