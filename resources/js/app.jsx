import "./bootstrap";

import React from "react";
import ReactDom from "react-dom/client";
import { BrowserRouter } from "react-router-dom";

import App from "./components/App";

import Swal from 'sweetalert2/dist/sweetalert2.js'
import 'sweetalert2/dist/sweetalert2.css'

window.Swal=Swal
const toast=Swal.mixin({
    toast:true,
    position:'top-end',
    showConfirmButton:false,
    timer:3000,
    timeProgressBar:true,
})

window.toast=toast

ReactDom.createRoot(document.getElementById("app")).render(
    <BrowserRouter>
        <App />
    </BrowserRouter>
);
