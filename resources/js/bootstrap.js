import axios from "axios";
import Dropzone from "dropzone";

window.Dropzone = Dropzone;
window.axios = axios;

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";
